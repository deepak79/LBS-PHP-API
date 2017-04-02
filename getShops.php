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

    public function insert_user($vid)
    {
    
    $sql1 = "SELECT * FROM shops WHERE vid = '$vid'";

    $result1 = mysqli_query($this->connection,$sql1);


    $sql = "SELECT * FROM colors";

    $result = mysqli_query($this->connection,$sql);

    if($result)
    {
        $response["colors"] = array();

        while ($rows= mysqli_fetch_array($result))
        {
            $product = array();
            
            $product["colorid"] = $rows["colorid"];
            $product["colorcode"] = $rows["colorcode"];
            $product["colorname"] = $rows["colorname"];
            
            array_push($response["colors"],$product);
        }
    }
    
    if($result1)
    {
        $response["shops"] = array();

        while ($rows= mysqli_fetch_array($result1))
        {
            $product = array();
            
            $product["sid"] = $rows["sid"];
            $product["vid"] = $rows["vid"];
            $product["vname"] = $rows["vname"];
            $product["sname"] = $rows["sname"];
            $product["slat"] = $rows["slat"];
            $product["slng"] = $rows["slng"];
            $product["saddress"] = $rows["saddress"];
            $product["smobileno"] = $rows["smobileno"];
            $product["status"] = $rows["status"];
            $product["screatedon"] = $rows["screatedon"];
            
            array_push($response["shops"],$product);
        }
    }
    else
    {
        $response['fail'] = 'Please try again!';
    }
    echo json_encode($response);    
    mysqli_close($this -> connection);

    }

}
    $user = new User();
    $vid = $_POST['vid'];

    if(!empty($vid))
    {
    	if($vid != '')
    	{
    		$user->insert_user($vid);
    	}
    	else
    	{
	    	$error['fail'] = 'Unauthorized access';
	    	echo json_encode($error);
    	}
    }
    else
    {
    	$error['fail'] = 'Unauthorized access';
    	echo json_encode($error);
    }
?>
