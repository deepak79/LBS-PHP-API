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
        $oid       = $_POST['oid'];
        $uid       = $_POST['uid'];

        if($oid != null && $uid != null)
        {
            $sql = "UPDATE `users` SET `fav`= CONCAT(`fav`, ',$oid') WHERE `uid` = '$uid' ";
            $result = mysqli_query($this->connection,$sql);   
            if($result)
            {    
                $json['pass'] = "Added to favourites!";
            }
            else
            {
                $json['fail']= "Failed to update favourites section!";
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
