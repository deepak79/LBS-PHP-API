<?php
header('Content-type: application/json; charset=UTF-8');
require_once 'config.php';
$db = mysqli_connect(hostname, user, password, db_name);

if (isset($_POST['vid']) && !empty($_POST['vid']))
{
	$vid = intval($_POST['vid']);
	$query = mysqli_query($db,"SELECT * FROM `offers` WHERE `vid` = '$vid' ");
	$data = array();
	while($row = mysqli_fetch_array($query))
	{
		$data[] = $row;
	}
	$json["data"] = $data;
	echo json_encode($json);
	exit;
}
?>