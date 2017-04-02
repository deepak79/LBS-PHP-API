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

    public function insert_user()
    {
    
    $sql1 = "SELECT * FROM categories";

    $result1 = mysqli_query($this->connection,$sql1);
    
    if($result1)
    {
        $response["categories"] = array();

        while ($rows= mysqli_fetch_array($result1))
        {
            $product = array();
            
            $product["catid"] = $rows["cid"];
            $product["catname"] = $rows["cname"];
            $product["catlogo"] = $rows["cthumb"];
            
            array_push($response["categories"],$product);
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
    $key = $_POST['key'];

    if(!empty($key))
    {
    	if($key == 'lbs#123')
    	{
    		$user->insert_user();
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
