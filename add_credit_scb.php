<?php
error_reporting(0);
require 'config/config.php';

$sql = "SELECT * FROM `website`";
$result = $server->query($sql);
$row = mysqli_fetch_assoc($result);
$turnover_when_deposit = $row['turnover_when_deposit'];
$turnover_when_deposit_multiply = $row['turnover_when_deposit_multiply'];

$date_check=date("Y-m-d");

function lineAlert($token, $msg)
{
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);
	date_default_timezone_set("Asia/Bangkok");

	// $sToken = "kuFx34n4S4WyxJ86Ee7PAATEcsp1gflmRTNkwc4daiL";
	// $sMessage = "มีรายการสั่งซื้อเข้าจ้า....";

	$sToken = $token;
	$sMessage = $msg;

	
	$chOne = curl_init(); 
	curl_setopt( $chOne, CURLOPT_URL, "https://notify-api.line.me/api/notify"); 
	curl_setopt( $chOne, CURLOPT_SSL_VERIFYHOST, 0); 
	curl_setopt( $chOne, CURLOPT_SSL_VERIFYPEER, 0); 
	curl_setopt( $chOne, CURLOPT_POST, 1); 
	curl_setopt( $chOne, CURLOPT_POSTFIELDS, "message=".$sMessage); 
	$headers = array( 'Content-type: application/x-www-form-urlencoded', 'Authorization: Bearer '.$sToken.'', );
	curl_setopt($chOne, CURLOPT_HTTPHEADER, $headers); 
	curl_setopt( $chOne, CURLOPT_RETURNTRANSFER, 1); 
	curl_exec( $chOne ); 
	curl_close( $chOne );
}

function getTokenFromDB($type)
{
	require 'config/config.php';
	$sqlNotify = "SELECT * FROM notify ";
	$resulNotify = $server->query($sqlNotify);
	$arrNotify = array();
	while($rowNotify = mysqli_fetch_assoc($resulNotify)) {
		// print_r($rowWheel);
		$arrNotify[] = $rowNotify;
	}
	if ($type == "register") {
		return $arrNotify[0]['token'];
	}elseif ($type == "deposit") {
		return $arrNotify[1]['token'];
	}elseif ($type == "withdraw") {
		return $arrNotify[3]['token'];
	}elseif ($type == "refund") {
		return $arrNotify[4]['token'];
	}elseif ($type == "bonus") {
		return $arrNotify[5]['token'];
	}elseif ($type == "addcode") {
		return $arrNotify[6]['token'];
	}elseif ($type == "affiliate") {
		return $arrNotify[7]['token'];
	}
}


$sql = "SELECT * FROM `refill` where status=0";
$result = $server->query($sql);

include 'api_betflix.php';


foreach ($result as  $value) {

	

	$id_refill=$value['id'];
	$amount=$value['amount'];
	$amount=str_replace(",","",$amount);

	$check_number=strlen($value['buyerName']);

	if ($check_number==4) {
		$sql_checkid = "SELECT * FROM member WHERE bank_number LIKE '%" . $value['buyerName'] . "%' AND `fname`LIKE '%" . $value['buyerBank'] . "%'";
	}else{
		$sql_checkid = "SELECT * FROM member WHERE bank_number LIKE '%" . $value['buyerName'] . "%'";
	}

	echo $sql_checkid;
	print"<br>";

	$query = $server->query($sql_checkid);
	$check = $query->num_rows;
	$row = mysqli_fetch_assoc($query);
	$id=$row['id'];
	$phone=$row['phone'];
	$fname=$row['fname'];
	$credit_user=str_replace(",","",$row['credit']);
 
	$sum=$amount+$credit_user;
	$deposit=$amount;
	$oldPoint=$row['point'];


	if ($check==1) {

		$status = json_decode($api->deposit($row['username_game'],$amount),true);
	 $status=$status['status'];
   //  print_r($status);
		if ($status=='success') {

			$sql="UPDATE `member` SET `credit`='".$sum."' WHERE phone='".$phone."'";
			// $sql="UPDATE `member` SET `credit`='".$sum."', `turnover`='".($deposit*2)."',`turnover_struck` = turnover_struck+".($turnover_when_deposit == 1 ? $deposit*$turnover_when_deposit_multiply : 0).", `status_promotion`= ".($turnover_when_deposit == 1 ? 1 : 'status_promotion')."  WHERE `phone`='".$phone."'";
			// $sql="UPDATE `member` SET `credit`='".$sum."', `turnover`='".($deposit*2)."',`turnover_struck` = '".($deposit*2)."', `status_promotion`= ".($turnover_when_deposit == 1 ? 1 : 'status_promotion')."  WHERE `phone`='".$phone."'";

			// echo "UPDATE=".$sql;
			// print"<br>";

			if ($server->query($sql) === TRUE) {}
				$username_game_update = $row['username_game'];

			$sql1="UPDATE `refill` SET `phone`='".$phone."',`status`='1', `username_game`='".$username_game_update."'  WHERE id='".$id_refill."'";
			if ($server->query($sql1) === TRUE) 	{}

			//ถ้าฝากเงินทุกๆ 300 จะได้ 20 พ้อย
			if($amount >= 300){
				$countPoint = 0;
				$countPrice = 0;
				$countPrice = $countPrice + $amount;
			
				do {
					$countPoint++;
					$countPrice = $countPrice - 300;
				} while ($countPrice >= 300);
			
				$sumPoint = (20 * $countPoint) + $oldPoint;
				$sql_point="UPDATE `member` SET `point`='".$sumPoint."'  WHERE phone='".$phone."'";
				if ($server->query($sql_point) === TRUE) {}
			}

				$token = getTokenFromDB("deposit");
			// $msg = 'สมาชิก '.$phone.' ทำรายการฝากเงิน Bank จำนวน '.number_format($amount,2).' บาท';
			$msg = "\nสมาชิกชื่อ: ".$fname."\nเบอร์: ".$phone."\nทำรายการฝากเงิน Bank จำนวน ".number_format($amount,2)." บาท";
			$res = lineAlert($token,$msg);



			// $sql_log_admin = "INSERT INTO `log_admin` (user_admin,user_member,detail_code,create_date,value1,value2,value3,value4) VALUES 
			// ('','".$phone."','ACM',NOW(),'".$amount."','','','test add point 1')";
			// $server->query($sql_log_admin);

			// //add point
			// $sqlWheel = "SELECT * FROM `config_wheel`";
			// $resulWheel = $server->query($sqlWheel);
			// $arrWheel = array();
			// while($rowWheel = mysqli_fetch_assoc($resulWheel)) {
			// 	$arrWheel[] = $rowWheel;
			// }
			// $add_point = $arrWheel[5]['point'];
		  
			// $count_point = $amount / 300;
			// $count_point = explode('.', $count_point);
			// $count_point = $count_point[0];
		  
			// $add_point = $add_point * $count_point;
		  
			// $sqlMember = "SELECT * FROM `member` WHERE `phone`='".$phone."'";
			// $resulMember = $server->query($sqlMember);
			// if($resulMember->num_rows > 0){
			// $rowMember = mysqli_fetch_assoc($resulMember);
			//   $add_point = $add_point + $rowMember['point'];
			//   $sqlPoint = "UPDATE `member` SET `point`= '".$add_point."' WHERE `phone`='".$phone."' ";
			//   $server->query($sqlPoint);
			// }


			// $sql_log_admin = "INSERT INTO `log_admin` (user_admin,user_member,detail_code,create_date,value1,value2,value3,value4) VALUES 
			// ('','".$phone."','ACM',NOW(),'".$amount."','".$add_point."','','test add point 2')";
			// $server->query($sql_log_admin);

			echo "เพิ่มเครดิตให้= ".$phone." ".$amount." บาท";
			print"<br>";


		}






	}



}


