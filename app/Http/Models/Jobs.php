<?php
namespace App\Http\Models;

class Jobs
{
    private $id;
    private $jobDescription;
    
    public function __construct($id,$jobdescription)
    {
        $this->id = $id;
        $this->jobDescription =$jobdescription;
    }
    
    public function getId()
    {
        return $this->id;
    }
    
    public function getJobDescription()
    {
        return $this->jobDescription;
    }
    
    public function setId($id)
    {
        $this->id = $id;
    }
    
    public function setJobDescription($jobDescription)
    {
        $this->jobDescription = $jobDescription;
    }
    
}