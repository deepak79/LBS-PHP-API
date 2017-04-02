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
        $profile       = $_POST['profile'];
        $name       = $_POST['name'];
        $username       = $_POST['username'];
        $password       = $_POST['password'];
        $mobileno    = $_POST['mobileno'];
        $email    = $_POST['email'];
        $ip    = $_POST['ip'];

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

        if($profile != null && $name != null && $username != null && $password != null && $mobileno != null && $email != null && $ip != null)
        {
            $nums = generateRandomString();
            $path = "profile/$nums.png";
            $profilepath = $ip."profile/$nums.png";

            $salt = sha1($email.time());

            file_put_contents($path,base64_decode($profile));
            $sql = "INSERT INTO `vendors`(`vid`, `vusername`, `vname`,`vpassword`,`vemail`, `vmobileno`, `vlogo`, `vclicks`, `vstatus`,`code`,`vcreatedon`) VALUES (NULL,'$username','$name','$password','$email','$mobileno','$profilepath','0','0','$salt',DEFAULT)";
            $result = mysqli_query($this->connection,$sql);
            if($result)
            {
                $to      = $email;
                $subject = 'Verify email';              
                $message = 'Please click on this link to verify your email http://10.0.3.2/lbs/activation.php?code='.$salt;
                $headers = 'From: webmaster@lbs.in' . "\r\n" .
                    'Reply-To: webmaster@lbs.in' . "\r\n" .
                    'X-Mailer: PHP/' . phpversion();
                
                mail($to, $subject, $message, $headers);

                $json['pass']="You have been registered successfully, Please check your mail for account activation!";
            }
            else
            {
                $json['fail']= "Failed to register, Please try again!";
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
