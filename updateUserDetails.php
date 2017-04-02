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
        function generateRandomString($length = 8) 
        {
            $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ123456789';
            $charactersLength = strlen($characters);
            $randomString = '';
            for ($i = 0; $i < $length; $i++) 
            {
                $randomString .= $characters[rand(0, $charactersLength - 1)];
            }
            return $randomString;
        }

        $profile       = $_POST['profile'];
        $mobileno       = $_POST['mobileno'];
        $uid       = $_POST['uid'];
        $ip       = $_POST['ip'];

        $nums = generateRandomString();
        $path = "profile/$nums.png";
        $profilepath = $ip."profile/$nums.png";


        if($profile != null && $mobileno != null && $uid != null && $ip != null)
        {
           $sql = "UPDATE `users` SET `uprofile`='$profilepath', `umobileno` = '$mobileno' WHERE `uid` = '$uid' ";
            $result = mysqli_query($this->connection,$sql);   
            if($result)
            {
                file_put_contents($path,base64_decode($profile));    
                $json['pass'] = "User details has been updated successfully!";
            }
            else
            {
                $json['fail']= "Failed to update user details, Please try again!";
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
