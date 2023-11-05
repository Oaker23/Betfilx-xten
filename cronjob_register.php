<?php
error_reporting(0);
require 'config/config.php';
date_default_timezone_set("Asia/Bangkok");
$date_check=date("d/m/Y");
$time_check=date("H:s:i");

function generateRandomString($length = 4) {
	$characters = '0123456789abcdefghijklmnopqrstuvwxyz';
	$charactersLength = strlen($characters);
	$randomString = '';
	for ($i = 0; $i < $length; $i++) {
		$randomString .= $characters[rand(0, $charactersLength - 1)];
	}
	return $randomString;
}

function generateRandomString1($length = 6) {
	$characters = '0123456789';
	$charactersLength = strlen($characters);
	$randomString = '';
	for ($i = 0; $i < $length; $i++) {
		$randomString .= $characters[rand(0, $charactersLength - 1)];
	}
	return $randomString;
}



$query = $server->query('SELECT * FROM `user_stock`');

$username_check = $query->num_rows;
$account = $query->fetch_assoc();


if($username_check < 20){
	include 'api_betflix.php';
	$username=generateRandomString();
	$password='Aa'.generateRandomString1();
	$status=$api->register($username,'uknow',$password,$phone);


	$data=json_decode($status,true);
print_r($status);


	$status=$data['error_code'];



	if ($status==0) {

		$sql="INSERT INTO `user_stock`(`id`, `username`, `password`) VALUES (null,'".$username."','".$password."')";
		if ($server->query($sql) === TRUE) {
			echo "member register successfully";

		}

	}else{
		echo "ไม่สำเร็จ";
	}
}else{
	echo "สต็อกเต็มแล้ว";	
}


?>