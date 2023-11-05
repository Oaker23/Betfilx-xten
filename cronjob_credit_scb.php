<?php
error_reporting(0);
require_once 'config/config.php';
require_once 'config/config_data.php';
require_once 'manager/test.php';
date_default_timezone_set("Asia/Bangkok");

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




$sql_bank = "SELECT * FROM `scb_info` WHERE description='ฝาก'";
$result_bank = $server->query($sql_bank);
$row_bank = mysqli_fetch_assoc($result_bank);


$api = new scb(decrypt($row_bank['deviceid'], $has_key),$row_bank['banknumber'],decrypt($row_bank['pin'], $has_key),$encrypt,$host,$user,$pass,$db,$has_key);

$result_transactions=$api->transactions();
// echo $result_transactions;

$result=json_decode($result_transactions,true);



foreach ($result['result'] as  $value) {
	

   $txnCode=$value['txnCode']['description']; //รายการ
$txnDateTime=$value['txnDateTime']; //เวลา
$deposit=$value['txnAmount']; //ยอดเงิน
$txnRemark=$value['txnRemark']; //เลขบัญชี
$name=$value['txnRemark']; //ชื่อ


if ($txnCode=="ฝากเงิน") {


	$deposit=str_replace(",","",$deposit);



	$data=explode("T",$txnDateTime);
	$time_check=str_replace(".000+07:00","",$data[1]);
	$date_check=date_format(date_create($data[0]),"Y-m-d");




	preg_match('/SCB/', $txnRemark, $output_array);
	$check_scb=$output_array[0];
	if ($check_scb=="SCB") {
		preg_match_all('/(?<=x)(.*?)(?= )/', $txnRemark, $output_array);
		$fromAccount=$output_array[0][0];

		preg_match('/(?<=นาย).(.*?)(?= )|(?<=นางสาว).(.*?)(?= )/', $name, $output_array);
		$name=trim($output_array[0]);


	}else{
		preg_match_all('/(?<=X).+/', $txnRemark, $output_array);
		$fromAccount=$output_array[0][0];
		preg_match('/.(.*?)(?= )/', $name, $output_array);
		$name=$output_array[0];

	}

	$sql_check = "SELECT * FROM refill WHERE  date_check='".$date_check."' and time_check='".$time_check."' and buyerName='".$fromAccount."'";

	echo $sql_check;
	print"<br>";

	$query = $server->query($sql_check);
	$check = $query->num_rows;
	if ($check==0 and $fromAccount !="") {

		$sql="INSERT INTO `refill`(`id`, `date_check`, `time_check`, `amount`, `buyerBank`, `buyerName`,`phone`) VALUES (null,'".$date_check."','".$time_check."','".$deposit."','".$name."','".$fromAccount."','')";
		if ($server->query($sql) === TRUE) { 
			echo "save success";
		}

		print"<br>";
		// echo "sql=".$sql;
		// print"<br>";
		// print_r($value);
		// print"<br>";

	}else{

		echo "no update";
		print"<br>";

	}

}

}



?>