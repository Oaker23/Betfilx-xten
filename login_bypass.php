<?php 
error_reporting(0);
session_start();
require_once 'config/config.php';

if(isset($_GET['phone'])) {

	$phone = mysqli_real_escape_string($server, $_GET["phone"]);  
	$phone = preg_replace("/[^a-z\d]/i", '', $phone);
	// echo 'SELECT * FROM `member` WHERE `phone`="'.$phone.'" ';
	// exit();
	$query = $server->query('SELECT * FROM `member` WHERE `phone`="'.$phone.'" ');

	$username_check = $query->num_rows;
	$account = $query->fetch_assoc();
	if($username_check == 0){
		$data = array ('msg'=>' ชื่อผู้ใช้ หรือ รหัสผ่านไม่ถูกต้อง','status'=>500);
		echo json_encode($data);
		exit();
	}else {

		$data = array ('msg'=>'เข้าระบบ สำเร็จ!','status'=>200);
		echo json_encode($data);

		$_SESSION["phone"]=$account["phone"];
		session_write_close();


	}
	exit();
}
