<?php

namespace App\Http\Controllers;
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
    
    //
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
            return view('job')->with('jobs', $results);
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
            return view('jobUsers')->with('jobs', $results);
        } else {
            return view('jobUsers')->with('msg','There are no Jobs yet.');
        }
    }
    
    
    
}
