<?php
namespace App\Http\Models;

class DTO implements \JsonSerializable 
{
    
    private $errorCode;
    private $errorMassage;
    private $data;
    
    
    public function __construct($errorCode,$errorMassage,$data)
    {
        $this->errorMassage = $errorCode;
        $this->errorCode = $errorMassage;
        $this->data = $data;
    }
    public function jsonSerialize()
    {
        return get_object_vars($this);
    }
    /**
     * @return string
     */
    public function getErrorCode()
    {
        return $this->errorCode;
    }

    /**
     * @return string
     */
    public function getErrorMassage()
    {
        return $this->errorMassage;
    }

    /**
     * @return string
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @param string $errorCode
     */
    public function setErrorCode($errorCode)
    {
        $this->errorCode = $errorCode;
    }

    /**
     * @param string $errorMassage
     */
    public function setErrorMassage($errorMassage)
    {
        $this->errorMassage = $errorMassage;
    }

    /**
     * @param string $data
     */
    public function setData($data)
    {
        $this->data = $data;
    }


 
}