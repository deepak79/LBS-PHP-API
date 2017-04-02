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



        $title       = $_POST['title'];
        $desc       = $_POST['desc'];
        $cat       = $_POST['cat'];
        $catname       = $_POST['catname'];
        $discounttype       = $_POST['discounttype'];
        $discount       = $_POST['discount'];
        $couponcode       = $_POST['couponcode'];
        $color       = $_POST['color'];
        $link       = $_POST['link'];
        $offerstart       = $_POST['offerstart'];
        $offerexpire       = $_POST['offerexpire'];
        $priority       = $_POST['priority'];
        $offerimage       = $_POST['offerimage'];
        $sid       = $_POST['sid'];
        $sname       = $_POST['sname'];
        $slat       = $_POST['slat'];
        $slng       = $_POST['slng'];
        $vid       = $_POST['vid'];       
        $status       = $_POST['status'];
        $couponqr       = $_POST['couponqr'];
        $vlogo       = $_POST['vlogo'];
        $ip       = $_POST['ip'];
        $saddress       = $_POST['saddress'];
        $scontactno       = $_POST['scontactno'];

        if($title != null && $desc != null && $cat != null && $discounttype != null && $discount != null && $couponcode != null && $slat != null && $slng != null && $color != null && $link != null  && $sname != null && $vlogo != null && $offerstart != null && $offerexpire != null && $priority != null && $offerimage != null && $couponqr != null && $ip != null && $saddress != null && $scontactno != null)
        {
            $nums = generateRandomString();
            $path = "offerimage/$nums.png";
            $offerimagepath = $ip."offerimage/$nums.png";

            if (!is_dir('qrcodes/'.$vid)) {
                mkdir('qrcodes/'.$vid, 0777, true);
            }

            if (!is_dir('qrcodes/'.$vid.'/'.$sid)) {
                mkdir('qrcodes/'.$vid.'/'.$sid, 0777, true);
            }

            $nums1 = generateRandomString();
            $path1 = "qrcodes/$vid/$sid/$nums1.png";
            $qrimagepath = $ip."qrcodes/$vid/$sid/$nums1.png";

            file_put_contents($path,base64_decode($offerimage));
            file_put_contents($path1,base64_decode($couponqr));

            $sql = "INSERT INTO `offers`(`oid`, `vid`, `sid`,`sname`,`slat`,`slng`,`saddress`,`scontactno`,`vlogo`,`vtitle`, `vdesc`, `catid`, `catname`, `discounttype`, `discount`, `coupon`,`couponqr`, `color`, `link`, `offerlogo`, `offerstartfrom`, `offerexpierson`, `priority`,`status`,`clicks`,`ocreatedon`) VALUES (NULL,'$vid','$sid','$sname','$slat','$slng','$saddress','$scontactno','$vlogo','$title','$desc','$cat','$catname','$discounttype','$discount','$couponcode','$qrimagepath','$color','$link','$offerimagepath','$offerstart','$offerexpire','$priority','$status','0',DEFAULT)";
            $result = mysqli_query($this->connection,$sql);   
            if($result)
            {    
                $json['pass'] = "New Offer has been added successfully!";
            }
            else
            {
                $json['fail']= "Failed to add shop, Please try again!".mysqli_error($this->connection);
            }
        }        
        else
        {
            $json['fail']= "Unauthorized access ".$vlogo;
        }
        echo json_encode($json);
        mysqli_close($this->connection);
    }
}
    $user = new User();
    $user->a();
?>
