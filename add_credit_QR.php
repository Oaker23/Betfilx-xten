<?php
error_reporting(0);
require 'config/config.php';

$sql = "SELECT * FROM `website`";
$result = $server->query($sql);
$row = mysqli_fetch_assoc($result);
$turnover_when_deposit = $row['turnover_when_deposit'];
$turnover_when_deposit_multiply = $row['turnover_when_deposit_multiply'];

date_default_timezone_set('Asia/Bangkok');
$date_check=date("Y-m-d");
$time_check=date('H:i:s');

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

$sql = 'SELECT * FROM `wait_refill` WHERE date_check="'.$date_check.'"';
$result = $server->query($sql);

foreach ($result as  $value) {
	
	$ref=$value['ref'];
	$price=$value['price'];
	$phone=$value['phone'];


	$price=str_replace(",","",$price);
	$query = $server->query('SELECT * FROM `refill` WHERE `description`="'.$ref.'" and status="0"');
	$username_check = $query->num_rows;
	$account = $query->fetch_assoc();

	if($username_check == 1){
		$sql = "SELECT * FROM member WHERE phone='".$phone."'";
		$result = $server->query($sql);
		$row1 = mysqli_fetch_assoc($result);
		$price1=str_replace(",","",$row1['credit']);
		$sum=$price1+$price;
		$fname=$row1['fname'];
		$username_game = $row1['username_game'];
		$deposit=$price;
		$oldPoint=$row1['point'];


		include 'api_betflix.php';
		$status = json_decode($api->deposit($row1['username_game'],$price),true);
		$status=$status['status'];

		if ($status=='success') {

			$sql = "DELETE FROM wait_refill WHERE `phone`='".$phone."'";
			if ($server->query($sql) === TRUE) {}

				$sql="UPDATE `refill` SET `status`='1',`phone`='".$phone."',`username_game`='".$username_game."' WHERE description='".$ref."'";


			if ($server->query($sql) === TRUE) {}

				// $sql="UPDATE `member` SET `credit`='".$sum."'  WHERE phone='".$phone."'";
				// $sql="UPDATE `member` SET `credit`='".$sum."', `turnover`='".($deposit*2)."',`turnover_struck` = turnover_struck+".($turnover_when_deposit == 1 ? $deposit*$turnover_when_deposit_multiply : 0).", `status_promotion`= ".($turnover_when_deposit == 1 ? 1 : 'status_promotion')."  WHERE `phone`='".$phone."'";
				$sql="UPDATE `member` SET `credit`='".$sum."', `turnover`='".($deposit*2)."',`turnover_struck` ='".($deposit*2)."', `status_promotion`= ".($turnover_when_deposit == 1 ? 1 : 'status_promotion')."  WHERE `phone`='".$phone."'";

			if ($server->query($sql) === TRUE) {}

				//ถ้าฝากเงินทุกๆ 300 จะได้ 20 พ้อย
				if($price >= 300){
					$countPoint = 0;
					$countPrice = 0;
					$countPrice = $countPrice + $price;
			
					do {
						$countPoint++;
						$countPrice = $countPrice - 300;
					} while ($countPrice >= 300);

					$sumPoint = (20 * $countPoint) + $oldPoint;
					$sql_point="UPDATE `member` SET `point`='".$sumPoint."'  WHERE phone='".$phone."'";
					if ($server->query($sql_point) === TRUE) {}
				}




				$token = getTokenFromDB("deposit");
			// $msg = 'สมาชิก '.$phone.' ทำรายการฝากเงิน QR จำนวน '.number_format($price,2).' บาท';
			$msg = "\nสมาชิกชื่อ: ".$fname."\nเบอร์: ".$phone."\nทำรายการฝากเงิน QR จำนวน ".number_format($price,2)." บาท";
			$res = lineAlert($token,$msg);


		}

	}else{
		echo "ไม่มีขอมูลอัพเดท";
		print"<br>";
	}

}


