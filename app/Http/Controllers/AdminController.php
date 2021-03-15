<?php

namespace App\Http\Controllers;
use App\Http\Models\AffinityModel;
use App\Http\Models\Jobs;
use App\services\business\SecurityService;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\services\data\SecurityDAO;
use App\Http\Models\Portfolio;

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
    
    //add new job
    public function JobOpening(Request $request)
    {
        $jobDescription = $request->input('jobDes');
        $theJob = new Jobs(null, $jobDescription);
        
        $job = new SecurityService(); 
        $job->JobOpening($theJob);
        
        return $this->findAllJobs();
        
    }
    
    //delete job
    public function deleteJob(Request $request)
    {
        $this->job = new SecurityDAO();
        $id = $request->input('jobID');
        $this->job->deleteJob($id);
        
        return $this->findAllJobs();
    }
    
    //edit job
    public function updateJob(Request $request)
    {
        $jobDescription = $request->input('jobDes');
        $id = $request->input('jobID');
        
        $theJob = new Jobs($id , $jobDescription);
        $this->job = new SecurityDAO();
        //return $this->job->updateJob($theJob);
        
        return view('editJob')->with('job',  $theJob);
    }
    
    //updates the job posting
    public function updateTheJob(Request $request)
    {
        $jobDescription = $request->input('jobDes');
        $id = $request->input('id');
        
        $theJob = new Jobs($id , $jobDescription);
        $this->job = new SecurityDAO();
        
        $this->job->updateJob($theJob);
        
        return $this->findAllJobs();

    }
    
    //return all the jobs in the database
    public function findAllJobs()
    {
        //request all songs from bs and dao
        $jobs = new SecurityService();
        $results = $jobs->findAllJobs();
        
        //return results accordingly
        if ($results != null){
            return view('job');
        } else {
            return view('job')->with('msg','There are no Jobs yet.');
        }
    }
    
    //return all the jobs in the database
    public function findAllJob()
    {
        //request all songs from bs and dao
        $jobs = new SecurityService();
        $results = $jobs->findAllJobs();
        
        //return results accordingly
        if ($results != null){
            return view('jobUsers');
        } else {
            return view('jobUsers')->with('msg','There are no Jobs yet.');
        }
    }
    
    //create a new group
    public function createGroup(Request $request)
    {
        $name = $request->get('groupName');
        $newGroup = new AffinityModel(null, $name);
        
        $group = new SecurityService();
        
        $results = $group->createGroup($newGroup);
        
        //return results accordingly
        if ($results){
            return $this->findAllGroups();
        } else {
            echo "There is an issue";
             
        }        
    }
    
    //update a group
    public function updateGroupView(Request $request)
    {
        $name = $request->get('groupName');
        $id = $request->get('groupID');
        
        $newGroup = new AffinityModel($id, $name);
        
        return view('editGroup')->with('group',$newGroup);
    }
    
    
    //update a group
    public function updateGroup(Request $request)
    {
        $name = $request->get('groupName');
        $id = $request->get('groupID');
        
        $newGroup = new AffinityModel($id, $name);
        
        $group = new SecurityService();
        
        $results = $group->updateGroup($newGroup);
        
        //return results accordingly
        if ($results){
            return $this->findAllGroups();
        } else {
            echo "did not update there is a problem";
        }        
    }
    
    
    //delete group
    public function deleteGroup(Request $request)
    {
        $id = $request->get('groupID');
        
        $group = new SecurityService();
        
        $result = $group->deleteGroup($id);
        
        //return results accordingly
        if ($result){
            return $this->findAllGroups();
        } else {
            echo "Did not delete there is a problem";
        } 
    }
    
    //find all groups
    public function findAllGroups()
    {
        $groups = new SecurityService();
        
        
        $result = $groups->findAllGroups();
        
        //return results accordingly
        if ($result != null){
            return view('createGroup')->with('groups',$result);
        } else {
            return view('createGroup')->with('msg','There are no Jobs yet.');
        } 
    }
    
    
    
}
