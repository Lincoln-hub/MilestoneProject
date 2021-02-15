<?php

namespace App\Http\Controllers;

use Carbon\Exceptions\Exception;
use App\Http\Models\User;
use Illuminate\Http\Request;
use App\services\business\SecurityService;

class UserController extends Controller
{
    //
    public function index(Request $request)
    {
        // trys to validate throws validation error if failed rules
     
        
         try {
             $credentials = new User($request->get('first_name'), $request->get('last_name'), $request->get('user_name'), $request->get('user_age'), $request->get('user_email'), $request->get('user_password'));
             
             
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
            $credentials = new User(null, null, $request->get('user_name'), null, null, $request->get('user_password'));
            
            
            $serviceregister = new SecurityService();
            
            //pass the credentials to the business layer
            $serviceregister->login($credentials);
            
        } catch (Exception $e2) {
            throw $e2;
        }
        return view('home');
    }
}
