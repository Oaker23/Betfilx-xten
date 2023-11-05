<?php
error_reporting(0);
date_default_timezone_set("Asia/Bangkok");
include 'api_mamanee.php';
require 'config/config.php';
include_once "config/config_data.php";

function encrypt($string, $key) 
{
	$result = '';
	for($i=0; $i<strlen($string); $i++) {
		$char = substr($string, $i, 1);
		$keychar = substr($key, ($i % strlen($key))-1, 1);
		$char = chr(ord($char)+ord($keychar));
		$result.=$char;
	}
	return base64_encode($result);
}



function decrypt($string, $key)  //ถอดรหัส
{
	$result = '';
	$string = base64_decode($string);
	for($i=0; $i<strlen($string); $i++) {
		$char = substr($string, $i, 1);
		$keychar = substr($key, ($i % strlen($key))-1, 1);
		$char = chr(ord($char)-ord($keychar));
		$result.=$char;
	}
	return $result;
}




$sql_bank = "SELECT * FROM `scb_info` WHERE banknumber='8162697814'";
$result_bank = $server->query($sql_bank);
$row_bank = mysqli_fetch_assoc($result_bank);

$api = new mamanee(decrypt($row_bank['deviceid'], $has_key),$row_bank['banknumber'], $walletId,decrypt($row_bank['pin'], $has_key),$encrypt,$host,$user,$pass,$db,$has_key);


$data = json_decode($api->transactions(),true);


$res=$data['data']['walletList'][0]['transactions']['list'];

foreach ($res as $value) {



	$sql_checkid = "SELECT * FROM refill WHERE refill_id='" .$value['id']. "'";
	$query = $server->query($sql_checkid);
	$check = $query->num_rows;
	$row = mysqli_fetch_assoc($query);
	$data=explode("T",$value['timestamp']);
	$time_result=str_replace(".000Z","",$data[1]);
	$date_result=date_format(date_create($data[0]),"Y/m/d");
	$deposit=str_replace(",","",$value['amount']);


	$time = date('H:i:s', strtotime($time_result.'+7 hour'));


	
	if ($check != 1) {
		$sql = "INSERT INTO `refill`(`id`, `refill_id`, `date_check`, `time_check`, `amount`, `description`, `buyerBank`, `buyerName`) VALUES (null,'".$value['id']."','".$date_result."','".$time."','".$deposit."','".$value['description']."','".$value['buyerBank']."','".$value['buyerName']."')";

		if ($server->query($sql) === TRUE) {echo "save success .";print"<br>";}

		// echo "sql=".$sql;
		// print"<br>";
		// print_r($value);
		// print"<br>";


	}else{
		echo "working.";
		print"<br>";
	}
}



?>

