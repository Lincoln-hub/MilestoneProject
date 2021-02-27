<?php
namespace App\Http\Models;

class Portfolio
{
    private $education;
    private $workHistory;
    private $skills;
    private $userid;
    
    
    /**
     * @return mixed
     */
    public function getUserid()
    {
        return $this->userid;
    }

    /**
     * @param mixed $userid
     */
    public function setUserid($userid)
    {
        $this->userid = $userid;
    }

    /**
     * @return mixed
     */
    public function getEducation()
    {
        return $this->education;
    }

    /**
     * @return mixed
     */
    public function getWorkHistory()
    {
        return $this->workHistory;
    }

    /**
     * @return mixed
     */
    public function getSkills()
    {
        return $this->skills;
    }

    /**
     * @param mixed $education
     */
    public function setEducation($education)
    {
        $this->education = $education;
    }

    /**
     * @param mixed $workHistory
     */
    public function setWorkHistory($workHistory)
    {
        $this->workHistory = $workHistory;
    }

    /**
     * @param mixed $skills
     */
    public function setSkills($skills)
    {
        $this->skills = $skills;
    }

    public function __construct($education,$workHistory,$skills,$userid)
    {
        $this->education = $education;
        $this->workHistory = $workHistory;
        $this->skills = $skills;
        $this->userid = $userid;
    }
}