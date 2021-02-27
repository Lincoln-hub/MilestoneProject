<?php 
namespace App\services\data;
use Carbon\Exceptions\Exception;
use Illuminate\Support\Facades\DB;
use App\Http\Models\Portfolio;
use App\Http\Models\User;
use App\Http\Models\Jobs;
class SecurityDAO
{
    //Define the connection string
    private $conn;
    private $severname = "localhost";
    private $username = "root";
    private $password = "root";
    private $dbname = "dbmilestone";
    private $port ="";
    private $dbQuery;
    private $dbQuery1;
    
    
    //constuctor that creates a connection with the database
    public function __construct()
    {
        //create a connection to the database
        $this->conn = mysqli_connect($this->severname,$this->username,$this->password,$this->dbname);
        
        //test the connection
        
    }
    
    //function to check if the user is in the database
    public function fingByUser(User $credentials)
    {
        try 
        {
           //define the query to search the database for the credentials
           $this->dbQuery = "SELECT * FROM  user
                                WHERE USERNAME = '{$credentials->getUsername()}'
                                    AND PASSWORD ='{$credentials->getPassword()}'";
           
          
          
           //if the selected query returns a resultset
           $result = mysqli_query($this->conn,$this->dbQuery);
           
           if(mysqli_num_rows($result) >0)
           {
               $resultUser = $result->fetch_object();
               $returnedUser = new User($resultUser->ID, $resultUser->FIRSTNAME, $resultUser->LASTNAME,$resultUser->USERNAME, $resultUser->AGE, $resultUser->EMAIL, $resultUser->PASSWORD,$resultUser->ROLE);
               return $returnedUser;
               
              /* $resultUser = 
               mysqli_free_result($result);
               mysqli_close($this->conn);
               return true;*/
           }
           else
           {
               mysqli_free_result($result);
               mysqli_close($this->conn);
               return false;
           }
        } catch (Exception $e) 
        {
            echo $e->getMessage();
        }
        
    }
    
    //function to insert the user information in the databse
    public function Register(User $user)
    {
        
        if ($this->conn-> connect_errno) {
            echo "Failed to connect to MySQL: ";
        }
        
        $this->conn->autocommit(TRUE);
        try 
        {
            
           $this->dbQuery = "INSERT INTO user
                                (FIRSTNAME, LASTNAME, USERNAME, AGE, EMAIL,PASSWORD)
                                VALUES
                                ('{$user->getFirstName()}', '{$user->getLastName()}', 
                                    '{$user->getUsername()}', '{$user->getAge()}', 
                                    '{$user->getEmail()}', '{$user->getPassword()}')";
            
            
            if(mysqli_query($this->conn,$this->dbQuery))
            {
                
                mysqli_close($this->conn);
                return true;
            }
            else
            {
                
                mysqli_close($this->conn);
                return false;
            }
            
        } catch (Exception $e) 
        {
            echo $e->getMessage();
        }
    }
    

   //function to find all the users in the database
   public function findAllUsers()
    {
        try
        {
        
            if ($this->conn-> connect_errno) {
                echo "Failed to connect to MySQL: ";
            }
            
            
             $this->dbQuery = "SELECT * FROM user";
            //if the selected query returns a resultset
            $result = mysqli_query($this->conn,$this->dbQuery);
            
            
            if(mysqli_num_rows($result) >0)
            {
           
                return  $result;
            }
            else
            {
                mysqli_free_result($result);
                mysqli_close($this->conn);
                return false;
            }
    } catch (Exception $e)
        {
            echo $e->getMessage();
        }
        
    }
    
    //function to get information of a user form the databse
    public function viewUser($id)
    {
        try
        {
            
            if ($this->conn-> connect_errno) {
                echo "Failed to connect to MySQL: ";
            }
            
            
            $this->dbQuery = "SELECT * FROM user WHERE ID = $id";
            //if the selected query returns a resultset
            $result = mysqli_query($this->conn,$this->dbQuery);
            
            //$result->execute();
            
            if(mysqli_num_rows($result) >0)
            {

                return  $result;
            }
            else
            {
                mysqli_free_result($result);
                mysqli_close($this->conn);
                return false;
            }
        } catch (Exception $e)
        {
            echo $e->getMessage();
        }
        
    }
    
    //function to delete a user form the database
    public function deleteUser($id)
    {
        try {
            // delete song based on id
            $this->dbQuery = "DELETE FROM user WHERE ID = $id ";
            
            
            $result = mysqli_query($this->conn,$this->dbQuery);
            // return bool if row was deleted
            return $result;
        } catch (Exception $e2) {
            throw $e2;
        }
    }
    
    //function to suspend a user, change their Role to suspended in the database
    public function suspendUser($id)
    {
        try {
            // update playlist based on param playlist
            $this->dbQuery = "UPDATE user SET ROLE = 'suspended' WHERE ID = $id";
            $result =mysqli_query($this->conn,$this->dbQuery);
            
            if($result)
            {
                return true;
            }else
            {
                return false;
            }
            
        } catch (Exception $e2) {
            throw $e2;
        }
    }
    
    //function to find the role of the user
    public function findRole($username)
    {
        try
        {
            
            if ($this->conn-> connect_errno) {
                echo "Failed to connect to MySQL: ";
            }
            
            
            $this->dbQuery = "SELECT * FROM user WHERE ROLE = 'suspended' AND USERNAME = '$username'";
            //if the selected query returns a resultset
            $result = mysqli_query($this->conn,$this->dbQuery);
            
            //$result->execute();
            
            if(mysqli_num_rows($result) >0)
            {
                // $userResults = $this->dbQuery->fetchAll();
                //mysqli_free_result($result);
                // mysqli_close($this->conn);
                return  true;
            }
            else
            {
                //mysqli_free_result($result);
                mysqli_close($this->conn);
                return false;
            }
        } catch (Exception $e)
        {
            echo $e->getMessage();
        }
        
    }
    
    //function to find the role of the user
    public function Role($username)
    {
        try
        {
            
            if ($this->conn-> connect_errno) {
                echo "Failed to connect to MySQL: ";
            }
            
            
            $this->dbQuery = "SELECT * FROM user WHERE ROLE = 'Admin' AND USERNAME = '$username'";
            
            //if the selected query returns a resultset
            $result = mysqli_query($this->conn,$this->dbQuery);

            if(mysqli_num_rows($result) >0)
            {
   
                return  true;
            }
            else
            {

                return false;
            }
        } catch (Exception $e)
        {
            echo $e->getMessage();
        }
        
    }
    
    
    //function to insert the user information in the databse
    public function JobOpening(Jobs $job)
    {
        
        if ($this->conn-> connect_errno) {
            echo "Failed to connect to MySQL: ";
        }
        
        $this->conn->autocommit(TRUE);
        try
        {
            
            $this->dbQuery = "INSERT INTO job
                                (DESCRIPTION)
                                VALUES
                                ('{$job->getJobDescription()}')";
            
            
            if(mysqli_query($this->conn,$this->dbQuery))
            {
                
                mysqli_close($this->conn);
                return true;
            }
            else
            {
                
                mysqli_close($this->conn);
                return false;
            }
            
        } catch (Exception $e)
        {
            echo $e->getMessage();
        }
    }
    
    //Edit Job opening
    public function updateJob(Jobs $job)
    {
        try {
            // update playlist based on param playlist
           // $this->dbQuery = "UPDATE job SET DESCRIPTION = ':jobD' WHERE ID = :id";
           
            
            $this->dbQuery = $this->conn->prepare("UPDATE job SET DESCRIPTION = ? WHERE ID = ?");
            
            $jobDes = $job->getJobDescription();
            $jobID = $job->getId();
            
            $this->dbQuery->bind_param("si",$jobDes, $jobID);
            
            $result = $this->dbQuery->execute();
            if($result)
            {
                return true;
            }else
            {
                return false;
            }
            
        } catch (Exception $e2) {
            throw $e2;
        }
    }
    
    //function to delete job from the database
    public function deleteJob($id)
    {
        try {
            // delete song based on id
            $this->dbQuery = "DELETE FROM job WHERE ID = $id ";
            
            
            $result = mysqli_query($this->conn,$this->dbQuery);
            // return bool if row was deleted
            return $result;
        } catch (Exception $e2) {
            throw $e2;
        }
    }
    
    //function to find all the jos in the database
    public function findAllJobs()
    {
        try
        {
            
            if ($this->conn-> connect_errno) {
                echo "Failed to connect to MySQL: ";
            }
            
            
            $this->dbQuery = "SELECT * FROM job";
            //if the selected query returns a resultset
            $result = mysqli_query($this->conn,$this->dbQuery);
            
            
            if(mysqli_num_rows($result) >0)
            {
                
                return  $result;
            }
            else
            {
                mysqli_free_result($result);
                mysqli_close($this->conn);
                return false;
            }
        } catch (Exception $e)
        {
            echo $e->getMessage();
        }
        
    }
    
    //function to insert the user information in the databse
    public function Portfolio(Portfolio $port)
    {
        
        if ($this->conn-> connect_errno) {
            echo "Failed to connect to MySQL: ";
        }
        
        $this->conn->autocommit(TRUE);
        try
        {
            
            $this->dbQuery = "INSERT INTO portfolio
                                (EDUCATION, WORKHISTORY,SKILLS, USERID)
                                VALUES
                                ('{$port->getEducation()}','{$port->getWorkHistory()}',
                                    '{$port->getSkills()}','{$port->getUserid()}')";
            
            
            if(mysqli_query($this->conn,$this->dbQuery))
            {
                
                mysqli_close($this->conn);
                return true;
            }
            else
            {
                
                mysqli_close($this->conn);
                return false;
            }
            
        } catch (Exception $e)
        {
            echo $e->getMessage();
        }
    }
    
    public function findPortfolio($id)
    {
        try
        {
            
            if ($this->conn-> connect_errno) {
                echo "Failed to connect to MySQL: ";
            }
            
            
            $this->dbQuery = "SELECT * FROM portfolio WHERE USERID = '$id'";
            

            //if the selected query returns a resultset
            $result = mysqli_query($this->conn,$this->dbQuery);
            
            
            if(mysqli_num_rows($result) >0)
            {
                
                return  $result;
            }
            else
            {
                //mysqli_free_result($result);
                mysqli_close($this->conn);
                return false;
            }
        } catch (Exception $e)
        {
            echo $e->getMessage();
        }
    }
    
    public function findWork()
    {
        
    }
    
    public function findSkills()
    {
        
    }
}