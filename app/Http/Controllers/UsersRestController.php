<?php

namespace App\Http\Controllers;

use Illuminate\Auth\Access\Response;
use Illuminate\Http\Request;
use App\services\business\SecurityService;
use App\Http\Models\DTO;

class UsersRestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    //returns all jobs for the API
     function getJobs()
    {
        $this->service = new SecurityService();
        
        $results = $this->service->findAllJobs();
        $res = [];
        
        while ($r = $results->fetch_array(MYSQLI_ASSOC)) {
            $res[] = $r;
        }
       // return $res; 
        
        $this->dto = new DTO("Erro 2021", "This is a new error", $res);
        return json_encode($this->dto->getData());
    }
    
    //returns a portfolio by user ID
    function getPortfolio($id)
    {
        $this->service = new SecurityService();
        
        $results = $this->service->findPortfolio($id);
        $res = [];
        
        while ($r = $results->fetch_array(MYSQLI_ASSOC)) {
            $res[] = $r;
        }
        
        
        $this->dto = new DTO("Erro 2021", "This is a new error", $res);
        return json_encode($this->dto->getData());
    }

    //returns a job by ID
    function getJob($id)
    {
        $this->service = new SecurityService();
        
        $results = $this->service->jobDetails($id);
        $res = [];
        
        while ($r = $results->fetch_array(MYSQLI_ASSOC)) {
            $res[] = $r;
        }
        
        
        $this->dto = new DTO("Erro 2021", "This is a new error", $res);
        return json_encode($this->dto->getData());
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
   /* public function show($id)
    {
        $this->service = new SecurityService();
        
        $this->service->getUser($id);
       // $datta =file_get_contents('php://input');
        $this->dto = new DTO("Erro 2030", "This is a error", $this->service->getUser($id));
        return json_encode($this->dto);
    }*/


}
