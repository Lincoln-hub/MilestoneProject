<?php

namespace App\Http\Models;

class AffinityModel
{
    private $id;
    Private $name;
    
    //constructo to initialize data
    public function __construct($id, $name)
    {
        $this->id=$id;
        $this->name=$name;
    }
    
    
    //getters and setter for the properties
    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

 
}