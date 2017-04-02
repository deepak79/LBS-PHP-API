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
        $email       = $_POST['email'];
        $password       = $_POST['password'];

        if($email != null && $password != null)
        {
            $sql = "SELECT * FROM users WHERE uemail = '$email'";
            $result = mysqli_query($this->connection,$sql);   
            if(mysqli_num_rows($result) > 0)
            {    
                $row = $result->fetch_assoc();
                $upassword = $row['upassword'];
                $ugender = $row['ugender'];
                $uname = $row['uname'];
                $status = $row['status'];

                if($status == "1")
                {
                    if($upassword != $password)
                    {
                        $json['fail']= "Wrong password!";
                    }
                    else if($upassword == $password)
                    {
                        $json["pass"] = array();

                        $product = array();

                        $product["uid"] = $row["uid"];
                        $product["uname"] = $row["uname"];
                        $product["uprofile"] = $row["uprofile"];
                        $product["upassword"] = $row["upassword"];
                        $product["ugender"] = $row["ugender"];
                        $product["umobileno"] = $row["umobileno"];
                        $product["uemail"] = $row["uemail"];
                        $product["ucity"] = $row["ucity"];
                        $product["udob"] = $row["udob"];
                        $product["status"] = $row["status"];
                        $product["creationdate"] = $row["creationdate"];
                        $product["fav"] = $row["fav"];

                        array_push($json["pass"],$product); 
                    }
                }
                else
                {
                    $json['fail']= "Please verify your account log in!";
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
