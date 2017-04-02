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

    public function insert_user($catid,$ulat,$ulng)
    {

    	function distance($lat1,$lon1,$lat2,$lon2,$unit)
        {
            $theta = $lon1 - $lon2;
            $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) + cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
            $dist = acos($dist);
            $dist = rad2deg($dist);
            $miles = $dist * 60 * 1.1515;
            $unit = strtoupper($unit);

            if($unit == "K")
            {
                return ($miles * 1.609344);
            }
        }
    
	$date = date('d/m/Y');

    $sql1 = "SELECT * FROM offers WHERE str_to_date(`offerexpierson`,'%d/%m/%y') >= str_to_date('$date','%d/%m/%y') AND `catid` = '$catid'";

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
            $slat = $rows["slat"];
            $slng = $rows["slng"];
            $product["slat"] = $rows["slat"];
            $product["slng"] = $rows["slng"];
            $product["distance"] = round(distance($slat,$slng,$ulat,$ulng,"K"),2);
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
    $catid = $_POST['catid'];
    $ulat = $_POST['ulat'];
    $ulng = $_POST['ulng'];

    if($catid != null && $ulat != null && $ulng != null)
    {
        $user->insert_user($catid,$ulat,$ulng);
    }
    else
    {
        $error['fail'] = 'Unauthorized access';
        echo json_encode($error);
    }
?>
