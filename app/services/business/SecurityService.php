<?php 
namespace App\services\business;

use App\Http\Models\User;
use App\services\data\SecurityDAO;


class SecurityService
{
    private $verifyCred;
    private $reg;
    private $users;
    
    
    public function login(User $credentials)
    {
        //instantiate the data access layer
        $this->verifyCred = new SecurityDAO();
        
        //return true or false by passing the credentials to the object
        return $this->verifyCred->fingByUser($credentials);
    }
    
    public function Register(User $user)
    {
        $this->reg = new SecurityDAO();
        
        return $this->reg->Register($user);
    }
    
    public function findAllUsers()
    {
        $this->users = new SecurityDAO();
        
        return $this->users->findAllUsers();
    }
    
    public function deleteUser($id)
    {
        $this->users = new SecurityDAO();
        
        return $this->users->deleteUser($id);
    }
    
    public function suspendUser($id)
    {
        $this->users = new SecurityDAO();
        
        return $this->users->suspendUser($id);
    }
    
    
    
}