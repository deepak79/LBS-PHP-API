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
        $oid       = $_POST['oid'];
        $uid       = $_POST['uid'];

        if($oid != null && $uid != null)
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
                    unset($fav1[$key]);
                }

                $fav2 = implode(",", $fav1);

                $sql = "UPDATE `users` SET `fav`= '$fav2' WHERE `uid` = '$uid' ";
                $result = mysqli_query($this->connection,$sql);   
                if($result)
                {    
                    $json['pass'] = "Removed from favourites!";
                }
                else
                {
                    $json['fail']= "Failed to remove from favourites!";
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
