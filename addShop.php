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
        $vid       = $_POST['vid'];
        $vname       = $_POST['vname'];
        $slat       = $_POST['slat'];
        $slng       = $_POST['slng'];

        if($sname != null && $saddress != null && $smobile != null && $status != null && $vid != null && $vname != null && $slat != null && $slng != null)
        {
            $sql = "INSERT INTO `shops`(`sid`, `vid`, `vname`, `sname`, `saddress`, `slat`, `slng`, `smobileno`, `status`, `screatedon`) VALUES (NULL,'$vid','$vname','$sname','$saddress','$slat','$slng','$smobile','$status',DEFAULT)";
            $result = mysqli_query($this->connection,$sql);   
            if($result)
            {    
                $json['pass'] = "New Shop has been added successfully!";
            }
            else
            {
                $json['fail']= "Failed to add shop, Please try again!";
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
