<?php 
namespace App\services\business;

use App\Http\Models\Jobs;
use App\Http\Models\Portfolio;
use App\Http\Models\User;
use App\services\data\SecurityDAO;
use Symfony\Component\HttpKernel\EventListener\SaveSessionListener;


class SecurityService
{
    private $verifyCred;
    private $reg;
    private $users;
    private $potfolio;
    
    //login
    public function login(User $credentials)
    {
        //instantiate the data access layer
        $this->verifyCred = new SecurityDAO();
        
        //return true or false by passing the credentials to the object
        return $this->verifyCred->fingByUser($credentials);
    }
    
    //register
    public function Register(User $user)
    {
        $this->reg = new SecurityDAO();
        
        return $this->reg->Register($user);
    }
    
    //find all users in the database
    public function findAllUsers()
    {
        $this->users = new SecurityDAO();
        
        return $this->users->findAllUsers();
    }
    
    //delte a user for the databse
    public function deleteUser($id)
    {
        $this->users = new SecurityDAO();
        
        return $this->users->deleteUser($id);
    }
    
    //suspend a user
    public function suspendUser($id)
    {
        $this->users = new SecurityDAO();
        
        return $this->users->suspendUser($id);
    }
    
    //view the user's information
    public function viewUser($id)
    {
        $this->users = new SecurityDAO();
        
        return $this->users->viewUser($id);
    }
    
    //find the role of the user
    public function findRole($username)
    {
        $this->users = new SecurityDAO();
        
        return $this->users->findRole($username);
    }
    
    //find the role of the user
    public function Role($username)
    {
        $this->users = new SecurityDAO();
        
        return $this->users->Role($username);
    }
    
    //Adding a bew job post
    public function JobOpening(Jobs $job)
    {
        $this->job = new SecurityDAO();
        
        return $this->job->JobOpening($job);
    }
    
    public function updateJob(Jobs $job)
    {
        $this->job = new SecurityDAO();
        
        return $this->job->updateJob($job);
    }
    
    public function deleteJob($id)
    {
        $this->job = new SecurityDAO();
        
        return $this->job->deleteJob($id);
    }
    
    //return all the jobs in the database
    public function findAllJobs()
    {
        $this->jobs = new SecurityDAO();
        
        return $this->jobs->findAllJobs();
    }
    
    public function Portfolio(Portfolio $port)
    {
        $this->potfolio = new SecurityDAO();
        
        return $this->potfolio->Portfolio($port);
    }
    
    public function findPortfolio($id)
    {
        $this->potfolio = new SecurityDAO();
        
        return $this->potfolio->findPortfolio($id);
    }
}