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
        $vid       = $_POST['vid'];       
        $status       = $_POST['status'];
        $oid       = $_POST['oid'];
        $couponqr       = $_POST['couponqr'];
        $ip       = $_POST['ip'];

        if (!is_dir('qrcodes/'.$vid)) {
                mkdir('qrcodes/'.$vid, 0777, true);
            }

            if (!is_dir('qrcodes/'.$vid.'/'.$sid)) {
                mkdir('qrcodes/'.$vid.'/'.$sid, 0777, true);
            }

            $nums1 = generateRandomString();
            $path1 = "qrcodes/$vid/$sid/$nums1.png";
            $qrimagepath = $ip."qrcodes/$vid/$sid/$nums1.png";

        if($title != null && $desc != null && $cat != null && $discounttype != null && $discount != null && $couponcode != null&& $color != null && $link != null  && $sname != null && $offerstart != null && $offerexpire != null && $priority != null && $offerimage != null)
        {
           $sql = "UPDATE `offers` SET `sname`='$sname',`vtitle`='$title',`vdesc`='$desc',`catid`='$cat',`catname`='$catname',`discounttype`='$discounttype',`discount`='$discount',`coupon`='$couponcode',`couponqr` = '$qrimagepath' ,`color`='$color',`link`='$link',`offerstartfrom`='$offerstart',`offerexpierson`='$offerexpire',`priority`='$priority',`status`='$status',`ocreatedon`= DEFAULT WHERE `oid` = '$oid' ";
            $result = mysqli_query($this->connection,$sql);   
            if($result)
            {
                file_put_contents($path1,base64_decode($couponqr));    
                $json['pass'] = "Offer details has been updated successfully!";
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
