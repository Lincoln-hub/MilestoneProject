<?php
//Authors: Lincoln Munago, Adrian.
namespace App\Http\Models;

class Jobs
{
    private $id;
    private $jobDescription;
    
    //parameterized constructor
    public function __construct($id,$jobdescription)
    {
        $this->id = $id;
        $this->jobDescription =$jobdescription;
    }
    
    //gettters and setters for model properties
    
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