<?php 
namespace App\services\business;

use App\Http\Models\User;
use App\services\data\SecurityDAO;


class SecurityService
{
    private $verifyCred;
    private $reg;
    
    
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
}