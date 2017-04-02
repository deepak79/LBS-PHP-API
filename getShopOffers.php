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

    public function insert_user($sid)
    {

    $sql1 = "SELECT * FROM offers WHERE `sid` = '$sid' ";

    $result1 = mysqli_query($this->connection,$sql1);
    
    if($result1)
    {
        $response["offers"] = array();

        while ($rows= mysqli_fetch_array($result1))
        {
            $product = array();
            
            $product["oid"] = $rows["oid"];
            $product["vid"] = $rows["vid"];
            $product["sid"] = $rows["sid"];
            $product["sname"] = $rows["sname"];
            $product["slat"] = $rows["slat"];
            $product["slng"] = $rows["slng"];
            $product["vlogo"] = $rows["vlogo"];
            $product["vtitle"] = $rows["vtitle"];
            $product["vdesc"] = $rows["vdesc"];
            $product["catid"] = $rows["catid"];
            $product["catname"] = $rows["catname"];
            $product["discounttype"] = $rows["discounttype"];
            $product["discount"] = $rows["discount"];
            $product["coupon"] = $rows["coupon"];
            $product["couponqr"] = $rows["couponqr"];
            $product["color"] = $rows["color"];
            $product["link"] = $rows["link"];
            $product["saddress"] = $rows["saddress"];
            $product["scontactno"] = $rows["scontactno"];
            $product["offerlogo"] = $rows["offerlogo"];
            $product["offerstartfrom"] = $rows["offerstartfrom"];
            $product["offerexpierson"] = $rows["offerexpierson"];
            $product["priority"] = $rows["priority"];
            $product["status"] = $rows["status"];
            $product["clicks"] = $rows["clicks"];
            $product["ocreatedon"] = $rows["ocreatedon"];
            
            array_push($response["offers"],$product);
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
    $sid = $_POST['sid'];

    if($sid != null)
    {
        $user->insert_user($sid);
    }
    else
    {
        $error['fail'] = 'Unauthorized access';
        echo json_encode($error);
    }
?>
