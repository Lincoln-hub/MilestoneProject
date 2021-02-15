<?php 
namespace App\services\data;
use Carbon\Exceptions\Exception;
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
    
}