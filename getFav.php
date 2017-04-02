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
        $uid       = $_POST['uid'];
        $oid       = $_POST['oid'];

        if($uid != null && $oid != null)
        {
            $s = "SELECT `fav` FROM `users` WHERE `uid` = '$uid' ";
            $r = mysqli_query($this->connection,$s);

            $num = mysqli_num_rows($r);
            if($num > 0)
            {
                $row = mysqli_fetch_array($r,MYSQLI_ASSOC);
                $fav = $row["fav"];
                $fav1 = explode(",", $fav);
                if(($key = array_search($oid, $fav1)) !== false) {
                    $json['pass'] = "1";
                } 
                else
                {    
                    $json['pass'] = "0";
                }
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
