<?php
include_once 'connection.php';

class User 
{

    private $db;
    private $connection;

    function __construct() 
    {    
        $this -> db = new DB_Connection();
        $this -> connection = $this -> db -> getConnection();
    }

    public function insert_user($code)
    {
    	$sql = "SELECT vstatus FROM vendors WHERE code = '$code' ";
    	$insert = mysqli_query($this->connection, $sql);
    	$rows = mysqli_num_rows($insert);
    	
    	if($rows == 1)
    	{
            $row = $insert->fetch_assoc();
            $status = $row['status'];
            if($status == "1")
            {
                $json['fail'] = 'Your account is already activated!';
            }
            else if($status == "0")
            {
                $sql = "UPDATE vendors SET vstatus = '1' WHERE code = '$code'";
                $insert = mysqli_query($this->connection, $sql);
                if($insert)
                {
                    $json['pass'] = 'Your account has been activated!';
                }
            }
    	}
    	else
    	{
    		$json['fail'] = 'Unauthorized access';
    	}
        echo json_encode($json);
        mysqli_close($this -> connection);
    }

}
    $user=new User();
    
    $code=$_GET['code'];
    
    $user->insert_user($code);
?>
