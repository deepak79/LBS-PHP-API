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
        $sname       = $_POST['sname'];
        $saddress       = $_POST['saddress'];
        $smobile       = $_POST['smobile'];
        $status       = $_POST['status'];
        $sid       = $_POST['sid'];
        $slat       = $_POST['slat'];
        $slng       = $_POST['slng'];

        if($sname != null && $saddress != null && $smobile != null && $status != null && $sid != null && $slat != null && $slng != null)
        {
            $sql = "UPDATE `shops` SET `sname`='$sname',`saddress`='$saddress',`slat`='$slat',`slng`='$slng',`smobileno`='$smobile',`status`='$status' WHERE `sid` = '$sid' ";
            $result = mysqli_query($this->connection,$sql);   
            if($result)
            {    
                $json['pass'] = "Shop details has been updated successfully!";
            }
            else
            {
                $json['fail']= "Failed to update shop information, Please try again!";
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
