<?php 
namespace App\services\data;
use Carbon\Exceptions\Exception;
use Illuminate\Support\Facades\DB;
use App\Http\Models\User;
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
    
    //constuctor that creates a connection with the database
    public function __construct()
    {
        //create a connection to the database
        $this->conn = mysqli_connect($this->severname,$this->username,$this->password,$this->dbname);
        
        //test the connection
        
    }
    
    public function fingByUser(User $credentials)
    {
        try 
        {
           //define the query to search the database for the credentials
           $this->dbQuery = "SELECT Username, Password FROM  user
                                WHERE Username = '{$credentials->getUsername()}'
                                    AND Password ='{$credentials->getPassword()}'";
           //if the selected query returns a resultset
           $result = mysqli_query($this->conn,$this->dbQuery);
           
           if(mysqli_num_rows($result) >0)
           {
               mysqli_free_result($result);
               mysqli_close($this->conn);
               return true;
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
            
            //$result->execute();
            
            if(mysqli_num_rows($result) >0)
            {
               // $userResults = $this->dbQuery->fetchAll();
                //mysqli_free_result($result);
               // mysqli_close($this->conn);
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
                // $userResults = $this->dbQuery->fetchAll();
                //mysqli_free_result($result);
                // mysqli_close($this->conn);
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
    
    public function suspendUser($id)
    {
        try {
            // update playlist based on param playlist
            $this->dbQuery = "UPDATE user SET ROLE = 'Suspened' WHERE ID = $id";
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
    
}