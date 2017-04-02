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

    public function insert_user($fav)
    {
        $fav1 = explode(",", $fav);
        
        $response["shops"] = array();

        for ($i=0; $i < count($fav1); $i++)
        {
            $sid = preg_replace('/\D/', '', $fav1[$i]);
            $sql1 = "SELECT * FROM shops WHERE sid = '$sid'";

            $result1 = mysqli_query($this->connection,$sql1);

            if($result1)
            {               
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
        }
        echo json_encode($response);    
        mysqli_close($this -> connection);
    }

}
    $user = new User();
    $fav = $_POST['fav'];

    if(!empty($fav))
    {
        if($fav != '')
        {
            $user->insert_user($fav);
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
