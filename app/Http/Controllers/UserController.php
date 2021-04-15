<?php

namespace App\Http\Controllers;

use Carbon\Exceptions\Exception;
use App\Http\Models\Portfolio;
use App\Http\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use App\services\business\SecurityService;
use App\services\data\Utility\ILoggerService;

class UserController extends Controller
{
    protected $logger;
    
    //singleton for logging
    public function __construct(ILoggerService $logger)
    {
        $this->logger = $logger;
    }
    
    //registers the user form inputs from the form
    public function index(Request $request)
    {
        // trys to validate throws validation error if failed rules
        $this->logger->info("Entering UserController.index()");
        
        try {
            $credentials = new User(null,$request->get('first_name'), $request->get('last_name'), $request->get('user_name'), $request->get('user_age'), $request->get('user_email'), $request->get('user_password'),null);
            
            
            $serviceregister = new SecurityService();
            
            //pass the credentials to the business layer
            $serviceregister->Register($credentials);
            
            
            
            //define who the email is going to
            $to_name = "Lincoln Munago";
            $to_email = $request->get('user_email');
            $to_subject = "Registration was succesful";
            
            //define the from
            $from_name ="Lincoln Munago";
            $from_email = "lincolnmunago55@yahoo.com";
            
            //define the array for the body of the email
            $data = array('name' =>$request->get('first_name'), 'body'=>"You have been successfully registered, you can go back to the site and login.");
            
            //Use the mail class to send the mail out
            //mail is the view we are using//$data is the array defining the body
            //you can pass the nessary variables with the use command
            Mail::send('mail', $data, function($message) use ($to_name, $to_email,$to_subject,
                $from_name,$from_email)
            {
                $message->to($to_email,$to_name)->subject($to_subject);
                $message->from($from_email, $from_name);
            });
            
            
  
            
        } catch (Exception $e2) {
            throw $e2;
        }
        $this->logger->info("Exiting UserController.index()");
        return view('login');
    }
    
    //login function 
    public function login(Request $request)
    {
        // trys to validate throws validation error if failed rules
        
        $this->logger->info("Entering UserController.login()");
        try {
            //flush session
            // $request->session()->flush();
            //Session::flush();
            
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
                    $this->logger->info("Suspended user tried to log in. Exiting UserController.login()");
                    return view('login')->with('msg',"Your account is suspended");
                }
                if($role)
                {
                    session()->get('security','enabled');
                    $servicelogin = new AdminController();
                    Session::put('adminID',$result->getId());
                    
                    $a = $servicelogin->findAllJobs();
                    $this->logger->info("Admin logged in. Exiting UserController.login()");
                    return $a;
                }
                else
                {
                    Session::put('userid',$result->getId());
                    $this->logger->info("User logged in. Exiting UserController.login()");
                    return $this->findPortfolio();
                }
            }
            else
            {
                $this->logger->info("Login Failed. Exiting UserController.login()");
                return view('loginFailed');
            }
            
        } catch (Exception $e2) {
            throw $e2;
        }
        
    }
    
    
    //portfolio function calls Portfolio function from the security service to put a user's portfolio in the database
    public function Portfolio(Request $request)
    {
        $this->logger->info("Entering UserController.Portfolio()");
        $work = $request->input('education');
        $education = $request->input('workhistory');
        $skills = $request->input('skills');
        $userid = Session::get('userid');
        
        $port = new Portfolio($education, $work, $skills,$userid);
        
        $port1 = new SecurityService();
        
        $results = $port1->Portfolio($port);
        
        //$a = new UserController();
        //$b = $a->findPortfolio();
        if($results)
        {
            $this->logger->info("Exiting UserController.Portfolio()");
            return $this->findPortfolio();
        }
        else echo"There is a problem";
        
    }
    
    //findPortfolio finds the portfolio of user by ID
    public function findPortfolio()
    {
        $this->logger->info("Entering UserController.findPortfolio()");
        $userid = Session::get('userid');
        
        $port = new SecurityService();
        
        $results = $port->findPortfolio($userid);
        
        $result = $port->findAllGroups();
        
        if ($results != null){
            $this->logger->info("Exiting UserController.findPortfolio()");
            return view('portfolio')->with('portfolio', $results)->with('groups',$result);
        } else {
            $this->logger->info("Exiting UserController.findPortfolio()");
            return view('portfolio')->with('msg','Your Port Folio is empty');
        }
    }
    
    //add users to group
    public function  addToGroup(Request $requset)
    {
        $this->logger->info("Entering UserController.addToGroup()");
        $userid = Session::get('userid');
        
        $groupID = $requset->get('groupID');   
        $newUser = new SecurityService();
        
        $result = $newUser->addToGroup($groupID, $userid);
        
        if ($result){
            $this->logger->info("Exiting UserController.addToGroup()");
            return $this->viewGroup($requset);
        } else {
            echo "Something went wrong!!!!!!!";
        }
    }
    
    //remove user from group
    public function removeFromGroup(Request $requset)
    {
        $this->logger->info("Entering UserController.removeFromGroup()");
        $userid = Session::get('userid');
        
        $groupID = $requset->get('groupID');
        $newUser = new SecurityService();
        
        $result = $newUser->removeFromGroup($groupID, $userid);
        
        if ($result){
            $this->logger->info("Exiting UserController.removeFromGroup()");
            return $this->viewGroup($requset);
        } else {
            echo "something went wrong";
        }
    }
    
    //view group
    public function viewGroup(Request $requset)
    {
        $this->logger->info("Entering UserController.viewFromGroup()");
        $groupID = $requset->get('groupID');
        $group = new SecurityService();
        
        $result = $group->viewGroup($groupID);
        
        if ($result){
            $this->logger->info("Exiting UserController.viewFromGroup()");
            return view('viewGroup')->with('users',$result)->with('gID',$groupID);
        } else {
            $this->logger->info("Exiting UserController.viewFromGroup()");
            return view('viewGroup')->with('msg',"There are no users in this group yet!")->with('gID',$groupID);
        }
        
        
        
    }
    
    //find all groups
    public function findAllGroups()
    {
        $this->logger->info("Entering UserController.findAllGroups()");
        $groups = new SecurityService();
        
        $result = $groups->findAllGroups();
        
        //return results accordingly
        if ($result != null){
            $this->logger->info("Exiting UserController.findAllGroups()");
            return view('portfolio')->with('groups',$result);
        } else {
            echo "something is wrong";
        }
    }
    
    public function searchJob(Request $request)
    {
        $this->logger->info("Entering UserController.searchJob()");
        $this->jobs   = new SecurityService();
        $results = $this->jobs->searchJob($request->get('jobName'));
        
        if ($results != null){
            $this->logger->info("Exiting UserController.searchJob()");
            return view('jobUsers')->with('jobs',$results);
        } else {
            $this->logger->info("Exiting UserController.searchJob()");
            return view('jobUsers')->with('msg',"There are no users in this group yet!");
        }
    }
    
    
    //passes job details to a view.
    public function jobDetails(Request $request)
    {
        $this->logger->info("Entering UserController.jobDetails()");
    
       $this->jobs   = new SecurityService();
       $results = $this->jobs->jobDetails($_GET['jobid_']);
        
        if ($results != null){
            $this->logger->info("Exiting UserController.jobDetails()");
            return view('jobDescription')->with('job',$results);
        } else {
            $this->logger->info("Exiting UserController.jobDetails()");
            return view('jobDescription')->with('msg',"There are no users in this group yet!");
        }
    }
    
    //logs out the user
    public function logout(Request $request)
    {
        $this->logger->info("Entering UserController.logout()");
        try {
            Session::flush();
            $request->session()->flush();
            $this->logger->info("Exiting UserController.logout()");
            return redirect('/');
        } catch (Exception $e2) {
            $this->logger->error("An error occured while trying to logout");
            throw $e2;
        }
        
    }
    
    //registers the user.
    public function reg(Request $request) {
        
        return redirect('register');
    }
}
