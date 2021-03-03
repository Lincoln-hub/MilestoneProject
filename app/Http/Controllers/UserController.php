<?php

namespace App\Http\Controllers;

use Carbon\Exceptions\Exception;
use App\Http\Models\Portfolio;
use App\Http\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\services\business\SecurityService;

class UserController extends Controller
{
    
    public function index(Request $request)
    {
        // trys to validate throws validation error if failed rules
     
        
         try {
             $credentials = new User(null,$request->get('first_name'), $request->get('last_name'), $request->get('user_name'), $request->get('user_age'), $request->get('user_email'), $request->get('user_password'),null);
             
             
             $serviceregister = new SecurityService();
             
             //pass the credentials to the business layer
             $serviceregister->Register($credentials);  
             
        } catch (Exception $e2) {
            throw $e2;
        }
        return view('login');
    }
    
    public function login(Request $request)
    {
        // trys to validate throws validation error if failed rules
        
        
        try {
            //flush session
            $request->session()->flush();
            Session::flush();
           
            $credentials = new User(null,null, null, $request->get('login_name'), null, null, $request->get('login_password'),null);
            
            
            $servicelogin= new SecurityService();
            
            //pass the credentials to the business layer
            $servicelogin->login($credentials);
            $result = $servicelogin->login($credentials);
            
            
            //pass the credentials to the business layer
            $isValid = $servicelogin->login($credentials);
            $checkRole = $servicelogin->findRole($request->get('login_name'));
            $role = $servicelogin->Role($request->get('login_name'));
          
            //determine which view to display
            if($isValid)
            {
                if($checkRole)
                {
                    return view('login')->with('msg',"Your account is suspended");
                }
                if($role)
                {
                    $servicelogin = new AdminController();
                    Session::put('adminID',$result->getId());
                    
                    $a = $servicelogin->findAllJobs();
                    return $a;
                }
                else
                { 
                    Session::put('userid',$result->getId());
                    return $this->findPortfolio();
                }
            }
            else
            {
                return view('loginFailed');
            }
            
        } catch (Exception $e2) {
            throw $e2;
        }
        
    }
    
    public function Portfolio(Request $request)
    {
        $work = $request->input('education');
        $education = $request->input('workhistory');
        $skills = $request->input('skills');
        $userid = Session::get('userid');
        
        $port = new Portfolio($education, $work, $skills,$userid);
        
        $port1 = new SecurityService();
        
        $results = $port1->Portfolio($port);
        
        $a = new UserController();
        $b = $a->findPortfolio();
        if($results)
        {
            return $b;
        }
        else echo"There is a problem";
        
    }
    
    public function findPortfolio()
    {
        $userid = Session::get('userid');
        
        $port = new SecurityService();
        
        $results = $port->findPortfolio($userid);
            
        $result = $port->findAllGroups();
        
        if ($results != null){
            return view('portfolio')->with('portfolio', $results)->with('groups',$result);
        } else {
            return view('portfolio')->with('msg','Your Port Folio is empty');
        }
    }
    
    //add users to group
    public function  addToGroup(Request $requset)
    {
        $userid = Session::get('userid');
        
        $groupID = $requset->get('groupID');
        
        
        $newUser = new SecurityService();
        
        $result = $newUser->addToGroup($groupID, $userid);
        
        if ($result){
            return $this->viewGroup($requset);
        } else {
            echo "Something went wrong!!!!!!!";
        }    
    }
    
    //remove user from group
    public function removeFromGroup(Request $requset)
    {
        $userid = Session::get('userid');
        
        $groupID = $requset->get('groupID');
        $newUser = new SecurityService();
        
        $result = $newUser->removeFromGroup($groupID, $userid);
        
        if ($result){
            return $this->viewGroup($requset);
        } else {
            echo "something went wrong";
        }    
    }
    
    //view group
    public function viewGroup(Request $requset)
    {
        $groupID = $requset->get('groupID');
        $group = new SecurityService();
        
        $result = $group->viewGroup($groupID);
        $userid = Session::get('userid');
        
        if ($result){
            return view('viewGroup')->with('users',$result)->with('gID',$groupID)->with('userid',$userid);
        } else {
            return view('viewGroup')->with('msg',"There are no users in this group yet!")->with('gID',$groupID);
        }
        
        
            
    }
    
    //find all groups
    public function findAllGroups()
    {
        $groups = new SecurityService();
        
        
        $result = $groups->findAllGroups();
        
        //return results accordingly
        if ($result != null){
            return view('portfolio')->with('groups',$result);
        } else {
            echo "something is wrong";
        }
    }
    
    
    //logs out the user
    public function logout(Request $request) 
    {
        try {
            Session::flush();
            $request->session()->flush();
            return redirect('/');
        } catch (Exception $e2) {
            throw $e2;
        }
        
    }
    
    public function reg(Request $request) {
        
        return redirect('register');
    }
}
