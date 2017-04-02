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

        $uid       = $_POST['uid'];
        $password       = $_POST['password'];

        if($uid != null && $password != null)
        {
            $sql = "UPDATE `users` SET `upassword` = '$password' WHERE `uid` = '$uid' ";
            $result = mysqli_query($this->connection,$sql);   
            if($result)
            { 
                $json['pass'] = "Password has been successfully changed!";
            }
            else
            {
                $json['fail']= "Failed to update password, Please try again!";
            }
        }        
        else
        {
            $json['fail']= "Unauthorized access";
        }
        echo json_encode($json);
        mysqli_close($this->connection);
    }
}
    $user = new User();
    $user->a();
?>
