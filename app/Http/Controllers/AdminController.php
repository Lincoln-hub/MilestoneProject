<?php

namespace App\Http\Controllers;
use App\services\business\SecurityService;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    //
    public function index()
    {
        return view('admin.index');
    }
    
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
    
    public function deleteUser(Request $request)
    {
        //request all songs from bs and dao
        $users = new SecurityService();
        $id = $request->input('userid');
        $results = $users->deleteUser($id);
        //return results accordingly
        if ($results ){
            return view('manageUsers');
        } else {
            return view('manageUsers')->with('msg',' User did not get deleted.');
        }
    }
    
    public function suspendUser(Request $request)
    {
        //request all songs from bs and dao
        $users = new SecurityService();
        $id = $request->input('userid');
        $results = $users->suspendUser($id);
        //return results accordingly
        if ($results ){
            return view('manageUsers');
        } else {
            return view('manageUsers')->with('msg',' User did not get suspended.');
        }
    }
}
