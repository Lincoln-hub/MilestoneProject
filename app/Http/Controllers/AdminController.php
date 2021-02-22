<?php

namespace App\Http\Controllers;
use App\services\business\SecurityService;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    
    //returns the manageUsers view
    public function ManageUsers()
    {
        //request all songs from bs and dao
        $users = new SecurityService();
        $results = $users->findAllUsers();
        
        //return results accordingly
        if ($results != null){
            return view('manageUsers')->with('users', $results);
        } else {
            return view('manageUsers')->with('msg','There are no Users yet.');
        }
    }
    
    //return the profile view
    public function viewUser(Request $request)
    {
        //request all songs from bs and dao
        $users = new SecurityService();
        $id = $request->input('userid');
        
        $result = $users->viewUser($id);
        
        if($result != null)
        {
            return view('profile')->with('users',$result);
        }
        else
        {
            return view('profile')->with('msg',"User has no profile");
        }   
    }
    
    //deletes the user and returns the Manage users page
    public function deleteUser(Request $request)
    {
        //request all songs from bs and dao
        $users = new SecurityService();
        $id = $request->input('userid');
        $users->deleteUser($id);
       
        $a = $this->ManageUsers($request);
        return $a;
      
    }
    
    //suspends the user and returns the ManageUsers page
    public function suspendUser(Request $request)
    {
        //request all songs from bs and dao
        $users = new SecurityService();
        $id = $request->input('userid');
        $results = $users->suspendUser($id);
        
        $a = $this->ManageUsers($request);
        //return results accordingly
        if ($results ){
            return $a;
        } else {
            return view('manageUsers')->with('msg',' User did not get suspended.');
        }
    }
}
