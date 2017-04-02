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
        $username       = $_POST['username'];
        $password       = $_POST['password'];

        if($username != null && $password != null)
        {
            $sql = "SELECT * FROM vendors WHERE vusername = '$username'";
            $result = mysqli_query($this->connection,$sql);   
            if(mysqli_num_rows($result) > 0)
            {    
                $row = $result->fetch_assoc();
                $vusername = $row['vusername'];
                $vpassword = $row['vpassword'];
                $vstatus = $row['vstatus'];


                if($vpassword != $password)
                {
                    $json['fail']= "Wrong password!";
                }
                else if($vpassword == $password)
                {
                    if($vstatus == "1")
                    {
                        $json["pass"] = array();

                        $product = array();
                
                        $product["vid"] = $row["vid"];
                        $product["vusername"] = $row["vusername"];
                        $product["vname"] = $row["vname"];
                        $product["vpassword"] = $row["vpassword"];
                        $product["vmobileno"] = $row["vmobileno"];
                        $product["vlogo"] = $row["vlogo"];
                        $product["vclicks"] = $row["vclicks"];

                        array_push($json["pass"],$product);
                    }    
                    else
                    {
                        $json['fail']= "Your account is disabled by administrator!";
                    }
                }               
            }
            else
            {
                $json['fail']= "User not found!";
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
