<?php
header('Content-type: application/json; charset=UTF-8');

include_once 'connection.php';
$db = mysqli_connect(hostname, user, password, db_name);
	
if (isset($_POST['uid']) && !empty($_POST['uid']))
{
	$uid = intval($_POST['uid']);
	$query = mysqli_query($db,"SELECT * FROM users WHERE `uid` = '$uid'");
	while($row = mysqli_fetch_array($query,MYSQLI_ASSOC))
	{
		$data[] = $row;
	}
	$json["data"] = $data;
	echo json_encode($json);
	exit;
}	
?>