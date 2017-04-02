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

    public function insert_user($vid)
    {

    $sql1 = "SELECT * FROM shops WHERE `vid` = '$vid' ";

    $result1 = mysqli_query($this->connection,$sql1);
    
    if($result1)
    {
        $rows= mysqli_fetch_array($result1);

        $response["data"] = array();

        $product = array();
            
        $product["shops"] = mysqli_num_rows($result1);

        array_push($response["data"],$product);
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
    $vid = $_POST['vid'];

    if($vid != null)
    {
        $user->insert_user($vid);
    }
    else
    {
        $error['fail'] = 'Unauthorized access';
        echo json_encode($error);
    }
?>
