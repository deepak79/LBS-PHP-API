<?php
include_once 'connection.php';

class User 
{

    private $db;
    private $connection;

    function __construct()
    {    
        $this->db = new DB_Connection();
        $this->connection = $this->db-> getConnection();
    }

    public function a()
    {
        $offerid       = $_POST['offerid'];

        if($offerid != null)
        {
            $sql = "UPDATE `offers` SET `clicks`= `clicks` + 1 WHERE `oid` = '$offerid' ";
            $result = mysqli_query($this->connection,$sql);   
            if($result)
            {    
                $json['pass'] = "Successfully added!";
            }
            else
            {
                $json['fail']= "Failed to update!";
            }
        }        
        else
        {
            $json['fail']= "Unauthorized access1";
        }
        echo json_encode($json);
        mysqli_close($this->connection);
    }
}
    $user = new User();
    $user->a();
?>
