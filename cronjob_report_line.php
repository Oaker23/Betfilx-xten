<?php
error_reporting(0);
require 'config/config.php';

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
	}elseif ($type == "report") {
		return $arrNotify[8]['token'];
	}
}


$date=date('Y-m-d');

//ยอดฝาก
$sql_refill = "SELECT SUM(amount) as total_all FROM refill WHERE amount>0 and phone!=''  and `date_check`='".$date."'";
$result_refill = $server->query($sql_refill);
$row_refill = mysqli_fetch_assoc($result_refill);
$refill_all=$row_refill['total_all']; 

//ยอดถอน
$sql_withdraw = "SELECT SUM(credit) as total_all FROM withdraw where status=0  and `date_withdraw`='".$date."'";
$result_withdraw = $server->query($sql_withdraw);
$row__withdraw = mysqli_fetch_assoc($result_withdraw);
$withdraw_all=$row__withdraw['total_all']; 

//ยอดเงินในบัญชี ฝาก มี
$sql_sum = "SELECT SUM(amount) as total_today FROM refill WHERE date_check='".$date."' and amount>0  and phone!=''";
// echo "sql_sum=".$sql_sum;exit();

$result_sum = $server->query($sql_sum);
$row_sum = mysqli_fetch_assoc($result_sum);
$total_today1=$row_sum['total_today'];

//ยอดเงินในบัญชี ถอน มี
$sql_sum = "SELECT SUM(credit) as total_today FROM withdraw WHERE date_withdraw='".$date."'  and status=0";
$result_sum = $server->query($sql_sum);
$row_sum = mysqli_fetch_assoc($result_sum);
$total_today2=$row_sum['total_today'];


$token = getTokenFromDB("report");
$msg = "\nสรุปยอดวันนี้";
$msg = $msg."\nฝากมาทั้งหมด: ".$refill_all." บาท";
$msg = $msg."\nถอนทั้งหมด: ".$withdraw_all." บาท";
$msg = $msg."\nยอดเงินในบัญชี ฝาก มี: ".$total_today1." บาท";
$msg = $msg."\nยอดเงินในบัญชี ถอน มี: ".$total_today2." บาท";
echo "msg=".$msg;
$res = lineAlert($token,$msg);

 echo "lineAlert test=";
 print_r($res);
//  exit();






?>