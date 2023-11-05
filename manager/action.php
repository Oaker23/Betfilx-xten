<?php

error_reporting(0);
if (!isset($_SESSION)) {
	session_start();
}


include '../config/config.php';
include_once "../config/config_data.php";






date_default_timezone_set("Asia/Bangkok");
$date_check = date("Y-m-d");
$time_check = date('H:i:s');



function encrypt($string, $key)
{
	$result = '';
	for ($i = 0; $i < strlen($string); $i++) {
		$char = substr($string, $i, 1);
		$keychar = substr($key, ($i % strlen($key)) - 1, 1);
		$char = chr(ord($char) + ord($keychar));
		$result .= $char;
	}
	return base64_encode($result);
}



function decrypt($string, $key)  //ถอดรหัส
{
	$result = '';
	$string = base64_decode($string);
	for ($i = 0; $i < strlen($string); $i++) {
		$char = substr($string, $i, 1);
		$keychar = substr($key, ($i % strlen($key)) - 1, 1);
		$char = chr(ord($char) - ord($keychar));
		$result .= $char;
	}
	return $result;
}






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
	curl_setopt($chOne, CURLOPT_URL, "https://notify-api.line.me/api/notify");
	curl_setopt($chOne, CURLOPT_SSL_VERIFYHOST, 0);
	curl_setopt($chOne, CURLOPT_SSL_VERIFYPEER, 0);
	curl_setopt($chOne, CURLOPT_POST, 1);
	curl_setopt($chOne, CURLOPT_POSTFIELDS, "message=" . $sMessage);
	$headers = array('Content-type: application/x-www-form-urlencoded', 'Authorization: Bearer ' . $sToken . '',);
	curl_setopt($chOne, CURLOPT_HTTPHEADER, $headers);
	curl_setopt($chOne, CURLOPT_RETURNTRANSFER, 1);
	curl_exec($chOne);
	curl_close($chOne);
}

function getTokenFromDB($type)
{
	include("../config/config.php");

	$sqlNotify = "SELECT * FROM notify ";
	$resulNotify = $server->query($sqlNotify);
	$arrNotify = array();
	while ($rowNotify = mysqli_fetch_assoc($resulNotify)) {
		// print_r($rowWheel);
		$arrNotify[] = $rowNotify;
	}
	if ($type == "register") {
		return $arrNotify[0]['token'];
	} elseif ($type == "deposit") {
		return $arrNotify[1]['token'];
	} elseif ($type == "withdraw") {
		return $arrNotify[3]['token'];
	} elseif ($type == "refund") {
		return $arrNotify[4]['token'];
	} elseif ($type == "bonus") {
		return $arrNotify[5]['token'];
	} elseif ($type == "addcode") {
		return $arrNotify[6]['token'];
	} elseif ($type == "affiliate") {
		return $arrNotify[7]['token'];
	}
}

function getUserIP()
{
    // Get real visitor IP behind CloudFlare network
    if (isset($_SERVER["HTTP_CF_CONNECTING_IP"])) {
              $_SERVER['REMOTE_ADDR'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
              $_SERVER['HTTP_CLIENT_IP'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
    }
    $client  = @$_SERVER['HTTP_CLIENT_IP'];
    $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
    $remote  = $_SERVER['REMOTE_ADDR'];

    if(filter_var($client, FILTER_VALIDATE_IP))
    {
        $ip = $client;
    }
    elseif(filter_var($forward, FILTER_VALIDATE_IP))
    {
        $ip = $forward;
    }
    else
    {
        $ip = $remote;
    }

    return $ip;
}



if (isset($_GET['login'])) {

	include '../config/config_data.php';


	if ($_POST['Keylogin'] != $key_login) {

		$data = array('msg' => 'Key ไม่ถูกต้อง', 'status' => 500);
		echo json_encode($data);
		exit();
	}

	$username = mysqli_real_escape_string($server, $_POST["username"]);
	$password = mysqli_real_escape_string($server, md5($_POST["password"]));

	$query = $server->query('SELECT * FROM `admin` WHERE `username`="' . $username . '" and password="' . $password . '"');

	$username_check = $query->num_rows;
	$account = $query->fetch_assoc();


	if ($username_check == 0) {
		$data = array('msg' => ' ชื่อผู้ใช้ หรือ รหัสผ่านไม่ถูกต้อง', 'status' => 500);
		echo json_encode($data);
		exit();
	} else {
		//*** Session
		$_SESSION["username"] = $account["username"];
		session_write_close();

		$user_ip = getUserIP();
		$sql_log_admin = "INSERT INTO `log_admin` (user_admin,user_member,detail_code,create_date,value1,value2,value3,value4) VALUES 
		('" . $_SESSION['username'] . "','','LIN',NOW(),'" . $user_ip . "','','','')";
		$server->query($sql_log_admin);

		$data = array('msg' => 'เข้าระบบ สำเร็จ!', 'status' => 200);
		echo json_encode($data);

		exit();
	}
}


if (isset($_GET['logout'])) {
	$user_ip = getUserIP();
	$sql_log_admin = "INSERT INTO `log_admin` (user_admin,user_member,detail_code,create_date,value1,value2,value3,value4) VALUES 
	('" . $_SESSION['username'] . "','','LOT',NOW(),'" . $user_ip . "','','','')";
	$server->query($sql_log_admin);
	session_destroy();
	echo '<meta http-equiv="refresh" content="0;url=login" />';
}


if ($_SESSION["username"] == "") {

	echo " <script> window.location = './login';</script>";
	exit();
}


if (isset($_GET['update_balance'])) {
	include '../config/config_data.php';
	$banknumber = $_POST["banknumber"];

	$sql_bank = "SELECT * FROM `scb_info` WHERE banknumber='" . $banknumber . "'";
	$result_bank = $server->query($sql_bank);
	$row_bank = mysqli_fetch_assoc($result_bank);



	include 'test.php';
	$api = new scb(decrypt($row_bank['deviceid'], $has_key), $row_bank['banknumber'], decrypt($row_bank['pin'], $has_key), $encrypt, $host, $user, $pass, $db, $has_key);


	$status = $api->balance();

	$data = array('msg' => 'อัพเดท !สำเร็จ คงเหลือ ' . $status, 'status' => 200);
	echo json_encode($data);
	exit();
}


if (isset($_GET['delete_code'])) {

	$sql = "DELETE FROM `code_itme` WHERE `status`=0";

	if ($server->query($sql) === TRUE) {
		$data = array('msg' => 'ลบ ข้อมูล !สำเร็จ', 'status' => 200);
		echo json_encode($data);
		exit();
	} else {
		$data = array('msg' => 'ลบ ข้อมูล !ไม่สำเร็จ', 'status' => 500);
		echo json_encode($data);
		exit();
	}
}




if (isset($_GET['add_code'])) {


	$phone = $_POST["phone"];




	$query = $server->query('SELECT * FROM `code_itme` WHERE `phone`= "' . $phone . '" AND`date_give`= "' . $date_check . '"');
	$check = $query->num_rows;


	if ($check >= 1) {
		$data = array('msg' => 'คุณ ไม่มีสิทธิ์ รับกิจกรรมนี้แล้ว', 'status' => 500);
		echo json_encode($data);
		exit();
	}


	$sql = "SELECT * FROM `code_itme` WHERE `status`=0";
	$result = $server->query($sql);
	$row = mysqli_fetch_assoc($result);
	$credit_code = $row['credit'];
	$turnover = $row['turnover'];
	$status = $row['status'];
	$id = $row['id'];
	$credit_code = str_replace(",", "", $credit_code);

	if ($id == "") {
		$data = array('msg' => 'โค้ดของคุณหมดแล้ว กรุณาสร้างใหม่', 'status' => 500);
		echo json_encode($data);
		exit();
	}



	$sql_credit = "SELECT * FROM member WHERE phone='" . $phone . "'";
	$result_credit = $server->query($sql_credit);
	$row_credit = mysqli_fetch_assoc($result_credit);

	$amount = $row_credit['credit'];
	$amount = str_replace(",", "", $amount);
	$sum = $amount + $credit;

	$sql = "UPDATE `code_itme` SET `date_give`='" . $date_check . "',`phone`='" . $phone . "',`status`='1',`username_game`='" . $row_credit['username_game'] . "' WHERE id='" . $id . "'";



	if ($server->query($sql) === TRUE) {
	}

	include 'api_betflix.php';


	$status = json_decode($api->deposit($row_credit['username_game'], $credit_code), true);


	$status = $status['status'];

	if ($status == 'success') {


		$sql = "UPDATE `member` SET `credit`='" . number_format($sum, 2) . "' WHERE phone='" . $phone . "'";
		if ($server->query($sql) === TRUE) {
		}


		$token = getTokenFromDB("addcode");
		$msg = 'สมาชิก ' . $phone . ' กดรับ item code ได้รับเงิน ' . number_format($credit_code, 2) . ' บาท';
		$res = lineAlert($token, $msg);


		$data = array('msg' => 'คุณได้รับเงิน ' . number_format($credit_code, 2) . ' บาท', 'status' => 200);
		echo json_encode($data);
		exit();
	}
}



if (isset($_GET['update_credit_user'])) {
	$id_credit = $_POST['id_credit'];
	$credit = $_POST['credit'];

	if ($_SESSION["username"] == "") {
		$data = array('msg' => 'ควย', 'status' => 500);
		echo json_encode($data);
		exit();
	}

	$sql = "SELECT * FROM `member` where id='" . $id_credit . "'";
	$result = $server->query($sql);
	$row = mysqli_fetch_assoc($result);
	$credit_user = $row['credit'];
	$phone = $row['phone'];
	$point_user = $row['point'];
	$fname = $row['fname'];
	$credit_user = str_replace(",", "", $credit_user);

	$sum = $credit + $credit_user;

	$token = getTokenFromDB("deposit");
	// $msg = 'สมาชิก '.$phone.' ทำรายการฝากเงิน จำนวน '.number_format($credit,2).' บาท';
	$msg = "\nสมาชิกชื่อ: " . $fname . "\nเบอร์: " . $phone . "\nทำรายการฝากเงิน Bank จำนวน " . number_format($credit, 2) . " บาท ถูกเพิ่มโดยแอดมิน" . $_SESSION["username"];
	$res = lineAlert($token, $msg);


	preg_match('/-/', $credit, $output_array);
	if (@$output_array[0] == '-') {
		$credit_wd = str_replace("-", "", $credit);
		$sql = "INSERT INTO `withdraw`(id, `phone`,time_withdraw,date_withdraw,credit,bank_number,bank_name,username_game,info,description,status) VALUES (null,'" . $phone . "','" . $time_check . "','" . $date_check . "','" . $credit_wd . "','" . $row['bank_number'] . "','" . $row['bank_name'] . "','" . $row['username_game'] . "','" . $_SESSION["username"] . "','ตัดเครดิต','0')";
	} else {
		$sql = "INSERT INTO `refill`(`id`, `date_check`, `time_check`, `amount`, `buyerBank`, `phone`, `info`, `status`, `username_game`) VALUES (null,'" . $date_check . "','" . $time_check . "','" . $credit . "','เติมมือ','" . $phone . "','" . $_SESSION["username"] . "','1','" . $row['username_game'] . "')";
	}

	include 'api_betflix.php';

	$status = json_decode($api->deposit($row['username_game'], $credit), true);


	if ($status['msg'] == 'Not enough credit.') {
		$data = array('msg' => "ไม่มีเครดิตเพียงพอ", 'status' => 500);
		echo json_encode($data);
		exit();
	}
	$status = $status['status'];
	if ($status == 'success') {
		if ($server->query($sql) === TRUE) {
			$data = array('msg' => "ทำรายการ สำเร็จ!", 'status' => 200);
			echo json_encode($data);
			$sql = "UPDATE `member` SET `credit`='" . $sum . "' WHERE phone='" . $phone . "'";
			if ($server->query($sql) === TRUE) {
			}

			if ($credit < 0) {
				// ลบเครดิต
				$sql_log_admin = "INSERT INTO `log_admin` (user_admin,user_member,detail_code,create_date,value1,value2,value3,value4) VALUES 
				('" . $_SESSION['username'] . "','" . $row['username_game'] . "','DCM',NOW(),'" . $credit . "','','','')";
				$server->query($sql_log_admin);
			} else {
				// เพิ่มเครดิต
				$sql_log_admin = "INSERT INTO `log_admin` (user_admin,user_member,detail_code,create_date,value1,value2,value3,value4) VALUES 
				('" . $_SESSION['username'] . "','" . $row['username_game'] . "','ACM',NOW(),'" . $credit . "','','','')";
				$server->query($sql_log_admin);
			}
			exit();
		}
	} else {
		$data = array('msg' => "ทำรายการ ไม่สำเร็จ!", 'status' => 500);
		echo json_encode($data);
		exit();
	}
}


if (isset($_GET['update_point_user'])) {
	$id_point = $_POST['id_point'];
	$point = $_POST['point'];

	if ($_SESSION["username"] == "") {
		$data = array('msg' => 'ควย', 'status' => 500);
		echo json_encode($data);
		exit();
	}

	$sql = "SELECT * FROM `member` where phone='" . $id_point . "'";
	$result = $server->query($sql);
	$row = mysqli_fetch_assoc($result);
	$phone = $row['phone'];
	$point_user = $row['point'];
	$sum = $point + $point_user;

	$sql = "UPDATE `member` SET `point`='" . $sum . "' WHERE phone='" . $phone . "'";
	if ($server->query($sql) === TRUE) {
		$data = array('msg' => "ทำรายการ สำเร็จ!", 'status' => 200);
		echo json_encode($data);
	} else {
		$data = array('msg' => "ทำรายการ ไม่สำเร็จ!", 'status' => 500);
		echo json_encode($data);
	}

	if ($point < 0) {
		// ลบเครดิต
		$sql_log_admin = "INSERT INTO `log_admin` (user_admin,user_member,detail_code,create_date,value1,value2,value3,value4) VALUES 
		('" . $_SESSION['username'] . "','" . $row['username_game'] . "','DPM',NOW(),'" . $point . "','','','')";
		$server->query($sql_log_admin);
	} else {
		// เพิ่มเครดิต
		$sql_log_admin = "INSERT INTO `log_admin` (user_admin,user_member,detail_code,create_date,value1,value2,value3,value4) VALUES 
		('" . $_SESSION['username'] . "','" . $row['username_game'] . "','APM',NOW(),'" . $point . "','','','')";
		$server->query($sql_log_admin);
	}
	exit();
}



if (isset($_GET['withdraw_mannal'])) {



	$id = $_POST['id'];
	$balance = $_POST['balance'];

	$sql1 = "SELECT * FROM `withdraw` WHERE id='" . $id . "'";
	$result1 = $server->query($sql1);
	$row1 = mysqli_fetch_assoc($result1);
	$phone = $row1['phone'];
	$credit = str_replace(",", "", $balance);
	$bank_number = $row1['bank_number'];
	$bank_name = $row1['bank_name'];


	$sql_status = "UPDATE `withdraw` SET `status`=0,`description`='" . $description . "',`time_withdraw`='" . $time_check . "',`credit`='" . $credit . "',`info`='" . $_SESSION["username"] . "' WHERE id='" . $id . "'";
	if ($server->query($sql_status) === TRUE) {

		$token = getTokenFromDB("withdraw");
		$msg = 'แอดมิน ' . $_SESSION["username"] . ' อนุมัติรายการถอนเงิน จำนวน ' . number_format($credit, 2) . ' บาท';
		$res = lineAlert($token, $msg);

		$withdraw_data = implode(" | ", $row1);
		$sql_log_admin = "INSERT INTO `log_admin` (user_admin,user_member,detail_code,create_date,value1,value2,value3,value4) VALUES 
		('" . $_SESSION['username'] . "','" . $row1['username_game'] . "','AW',NOW(),'" . $credit . "','" . $withdraw_data . "','','')";
		$server->query($sql_log_admin);

		$data = array('msg' => "ทำรายการ สำเร็จ!", 'status' => 200);
		echo json_encode($data);
		exit();
	}
}

if (isset($_GET['tranfersto'])) {


	include '../config/config_data.php';

	$bankto = $_POST['bankto'];
	$banknameto = $_POST['banknameto'];
	$balanceto = $_POST['balanceto'];
	$key_tranfer = $_POST['key_tranfer'];



	if ($key_tranfer != $key_withdraw) {
		$data = array('msg' => "ไม่สามารถถอนเงินได้! key ไม่ถูกต้อง", 'status' => 500);
		echo json_encode($data);
		exit();
	}

	$banknumber = $_POST["banknumber"];

	$sql_bank = "SELECT * FROM `scb_info` WHERE banknumber='" . $banknumber . "'";
	$result_bank = $server->query($sql_bank);
	$row_bank = mysqli_fetch_assoc($result_bank);


	include 'test.php';
	$api = new scb(decrypt($row_bank['deviceid'], $has_key), $row_bank['banknumber'], decrypt($row_bank['pin'], $has_key), $encrypt, $host, $user, $pass, $db, $has_key);

	$status = json_decode($api->tranfers($bankto, $banknameto, $balanceto), true)['status']['description'];
	if ($status == 'สำเร็จ') {

		$data = array('msg' => "ทำรายการ สำเร็จ!", 'status' => 200);
		echo json_encode($data);

		$token = getTokenFromDB("withdraw");
		$msg = 'แอดมิน ' . $_SESSION["username"] . ' โอนเงินออก จากบัญชีตัวเอง จำนวน ' . number_format($balanceto, 2) . ' บาท';
		$res = lineAlert($token, $msg);
	} else {
		$data = array('msg' => $status, 'status' => 500);
		echo json_encode($data);
		exit();
	}
}




if (isset($_GET['withdraw_bank'])) {

	include '../config/config_data.php';

	if ($_SESSION["username"] == "") {
		$data = array('msg' => 'ควย', 'status' => 500);
		echo json_encode($data);
		exit();
	}
	//  include 'class_scb.php';

	$id = $_POST['id'];
	$balance = $_POST['balance'];
	$keyinput_adminwd = $_POST['keyinput_adminwd'];



	if ($keyinput_adminwd != $key_adminwd) {
		$data = array('msg' => 'key ไม่ถูกต้อง', 'status' => 500);
		echo json_encode($data);
		exit();
	}



	$sql1 = "SELECT * FROM `withdraw` WHERE id='" . $id . "'";
	$result1 = $server->query($sql1);
	$row1 = mysqli_fetch_assoc($result1);
	$phone = $row1['phone'];
	$credit = str_replace(",", "", $balance);
	$bank_number = $row1['bank_number'];
	$bank_name = $row1['bank_name'];
	$status = $row1['status'];




	if ($status != 1) {
		$data = array('msg' => 'ทำรายการไปแล้ว', 'status' => 500);
		echo json_encode($data);
		exit();
	}
	$banknumber = $_POST["banknumber"];

	$sql_bank = "SELECT * FROM `scb_info` WHERE  description='ถอน'";
	$result_bank = $server->query($sql_bank);
	$row_bank = mysqli_fetch_assoc($result_bank);

	include 'test.php';
	$api = new scb(decrypt($row_bank['deviceid'], $has_key), $row_bank['banknumber'], decrypt($row_bank['pin'], $has_key), $encrypt, $host, $user, $pass, $db, $has_key);
	///echo $row_bank['banknumber'];

	$status = json_decode($api->tranfers($bank_number, $bank_name, $credit), true)['status']['description'];
	if ($status == 'สำเร็จ') {
		$sql_status = "UPDATE `withdraw` SET `status`=0,`description`='" . $description . "',`time_withdraw`='" . $time_check . "',`credit`='" . $credit . "',`info`='" . $_SESSION["username"] . "' WHERE id='" . $id . "'";
		if ($server->query($sql_status) === TRUE) {

			$token = getTokenFromDB("withdraw");
			$msg = 'แอดมิน ' . $_SESSION["username"] . ' อนุมัติรายการถอนเงิน จำนวน ' . number_format($credit, 2) . ' บาท';
			$res = lineAlert($token, $msg);

			$data = array('msg' => "ทำรายการ สำเร็จ!", 'status' => 200);
			echo json_encode($data);
		}
		exit();
	} else {
		$data = array('msg' => $status, 'status' => 500);
		echo json_encode($data);
		exit();
	}
}



if (isset($_GET['cancel'])) {

	$credit = $_POST['credit'];
	$id = $_POST['id'];
	$description = $_POST['description'];

	if ($description == "") {
		$data = array('msg' => "กรุณาใส่ เหตุผล!", 'status' => 500);
		echo json_encode($data);
	}


	$sql1 = "SELECT * FROM `withdraw` WHERE id='" . $id . "'";
	$result1 = $server->query($sql1);
	$row1 = mysqli_fetch_assoc($result1);
	$credit = $row1['credit'];
	$phone = $row1['phone'];
	$credit = str_replace(",", "", $credit);


	$sql = "SELECT * FROM `member` where phone='" . $phone . "'";
	$result = $server->query($sql);
	$row = mysqli_fetch_assoc($result);
	$credit_user = $row['credit'];
	$credit_user = str_replace(",", "", $credit_user);


	$sum = $credit + $credit_user;

	$sql_status = "UPDATE `withdraw` SET `status`=2,`description`='" . $description . "',`info`='" . $_SESSION["username"] . "' WHERE id='" . $id . "'";
	if ($server->query($sql_status) === TRUE) {
		$sql_status = "UPDATE `member` SET `credit`='" . $sum . "' WHERE phone='" . $phone . "'";
		if ($server->query($sql_status) === TRUE) {

			include 'api_betflix.php';




			$status = json_decode($api->deposit($row['username_game'], $credit), true);


			$status = $status['status'];
			if ($status == 'success') {

				$data = array('msg' => "ทำรายการ สำเร็จ!", 'status' => 200);
				echo json_encode($data);

				$withdraw_data = implode(" | ", $row1);
				$sql_log_admin = "INSERT INTO `log_admin` (user_admin,user_member,detail_code,create_date,value1,value2,value3,value4) VALUES 
				('" . $_SESSION['username'] . "','" . $row1['username_game'] . "','DC',NOW(),'" . $row1['credit'] . "','" . $description . "','" . $withdraw_data . "','')";
				$server->query($sql_log_admin);
			}
		}
	}
}


if (isset($_GET['deposit_alert'])) {
	$query = $server->query('SELECT * FROM `refill` WHERE phone=""');
	$check = $query->num_rows;

	$data = array('msg' => $check, 'status' => 200);
	echo json_encode($data);
	exit();
}

if (isset($_GET['withdraw_alert'])) {
	$query = $server->query('SELECT * FROM withdraw WHERE status = 1');
	$check = $query->num_rows;

	$data = array('msg' => $check, 'status' => 200);
	echo json_encode($data);
	exit();
}


if (isset($_GET['update_bank'])) {
	$fname = $_POST['fname'];
	$banknumber = $_POST['banknumber'];
	$status = $_POST['status'];
	$id = $_POST['id'];
	$description = $_POST['description'];


	$sql_bank = "SELECT * FROM `scb_info` WHERE id='" . $id . "'";
	$result_bank = $server->query($sql_bank);
	$row_bank = mysqli_fetch_assoc($result_bank);
	if ($row_bank['deviceid'] != $_POST['deviceid']) {
		$deviceid = encrypt($_POST['deviceid'], $has_key);
		$pin = encrypt($_POST['pin'], $has_key);
		$sql = "UPDATE `scb_info` SET `fname`='" . $fname . "',`banknumber`='" . $banknumber . "',`status`='" . $status . "',`description`='" . $description . "',`deviceid`='" . $deviceid . "',`pin`='" . $pin . "'  WHERE id='" . $id . "'";
	} else {
		$deviceid = $_POST['deviceid'];
		$pin = $_POST['pin'];
		$sql = "UPDATE `scb_info` SET `fname`='" . $fname . "',`banknumber`='" . $banknumber . "',`status`='" . $status . "',`description`='" . $description . "',`deviceid`='" . $deviceid . "',`pin`='" . $pin . "'  WHERE id='" . $id . "'";
	}




	if ($server->query($sql) === TRUE) {
		$data = array('msg' => 'อัพเดท ข้อมูล !สำเร็จ', 'status' => 200);
		echo json_encode($data);
		exit();
	} else {
		$data = array('msg' => 'อัพเดท ข้อมูล !ไม่สำเร็จ', 'status' => 500);
		echo json_encode($data);
		exit();
	}
}

if (isset($_GET['delete_bank'])) {
	$id = $_POST['id'];

	$sql = "DELETE FROM scb_info WHERE id=$id";

	if ($server->query($sql) === TRUE) {
		$data = array('msg' => 'ลบ ข้อมูล !สำเร็จ', 'status' => 200);
		echo json_encode($data);
		exit();
	} else {
		$data = array('msg' => 'ลบ ข้อมูล !ไม่สำเร็จ', 'status' => 500);
		echo json_encode($data);
		exit();
	}
}


if (isset($_GET['update_line'])) {
	$id = $_POST['id'];
	$token = $_POST['token'];


	$sql = "UPDATE `notify` SET `token`='" . $token . "' WHERE id='" . $id . "'";

	if ($server->query($sql) === TRUE) {
		$data = array('msg' => 'อัพเดท ข้อมูล !สำเร็จ', 'status' => 200);
		echo json_encode($data);
		exit();
	} else {
		$data = array('msg' => 'อัพเดท ข้อมูล !ไม่สำเร็จ', 'status' => 500);
		echo json_encode($data);
		exit();
	}
}


if (isset($_GET['menu_setting'])) {
	$id = 'menu_setting';
	$post = json_decode(file_get_contents('php://input'), true);
	// print_r($post);
	// $ss = json_encode($post);
	// echo "ss=", $ss;
	// exit();

	$sql = "SELECT * FROM `meta_setting` WHERE id='" . $id . "' ";
	$result = $server->query($sql);
	$row = mysqli_fetch_assoc($result);
	if ($row != null) {
		$sql = "UPDATE `meta_setting` SET `value`='" . json_encode($post) . "' WHERE id='" . $id . "'";
		if ($server->query($sql) === TRUE) {
			$data = array('msg' => 'อัพเดท ข้อมูล !สำเร็จ', 'status' => 200);
			echo json_encode($data);
			exit();
		} else {
			$data = array('msg' => 'อัพเดท ข้อมูล !ไม่สำเร็จ', 'status' => 500);
			echo json_encode($data);
			exit();
		}
	} else {
		$data = array('msg' => 'ไม่พบข้อมูล', 'status' => 500);
		echo json_encode($data);
		exit();
	}
}


if (isset($_GET['card_setting'])) {
	$id = 'card_setting';
	$post = json_decode(file_get_contents('php://input'), true);
	// print_r($post);
	// echo "enable=", $post['enable'];
	// echo "key_valid=", $post['key_valid'];
	// $ss = json_encode($post);
	// echo "ss=", $ss;
	// exit();

	$sql = "SELECT * FROM `meta_setting` WHERE id='" . $id . "' ";
	$result = $server->query($sql);
	$row = mysqli_fetch_assoc($result);
	if ($row != null) {
		$sql = "UPDATE `meta_setting` SET `value`='" . json_encode($post) . "' WHERE id='" . $id . "'";
		if ($server->query($sql) === TRUE) {
			$data = array('msg' => 'อัพเดท ข้อมูล !สำเร็จ', 'status' => 200);
			echo json_encode($data);
			exit();
		} else {
			$data = array('msg' => 'อัพเดท ข้อมูล !ไม่สำเร็จ', 'status' => 500);
			echo json_encode($data);
			exit();
		}
	} else {
		$data = array('msg' => 'ไม่พบข้อมูล', 'status' => 500);
		echo json_encode($data);
		exit();
	}
}

if (isset($_GET['card'])) {
	$id = 'card';
	$post = json_decode(file_get_contents('php://input'), true);
	// print_r($post);
	// echo "<hr>";

	$card = [];
	$card["key_valid"] = "";
	$card["card"] = array();
	$card["card_credit"] = array();
	$card["card_percent"] = array();
	for ($i = 0; $i < count($post); $i++) {
		$item = $post[$i];
		if ($item['name'] == "key_valid") {
			$card["key_valid"] = $item['value'];
		}
		if ($item['name'] == "card[]") {
			array_push($card["card"], $item['value']);
		}
		if ($item['name'] == "card_credit[]") {
			array_push($card["card_credit"], $item['value']);
		}
		if ($item['name'] == "card_percent[]") {
			array_push($card["card_percent"], $item['value']);
		}
	}

	// print_r($card);
	// $ss = json_encode($card, JSON_UNESCAPED_UNICODE);
	// echo "ss=", $ss;
	// exit();

	$sql = "SELECT * FROM `meta_setting` WHERE id='" . $id . "' ";
	$result = $server->query($sql);
	$row = mysqli_fetch_assoc($result);
	if ($row != null) {
		$sql = "UPDATE `meta_setting` SET `value`='" . json_encode($card, JSON_UNESCAPED_UNICODE) . "' WHERE id='" . $id . "'";
		if ($server->query($sql) === TRUE) {
			$data = array('msg' => 'อัพเดท ข้อมูล !สำเร็จ', 'status' => 200);
			echo json_encode($data);
			exit();
		} else {
			$data = array('msg' => 'อัพเดท ข้อมูล !ไม่สำเร็จ', 'status' => 500);
			echo json_encode($data);
			exit();
		}
	} else {
		$data = array('msg' => 'ไม่พบข้อมูล', 'status' => 500);
		echo json_encode($data);
		exit();
	}
}


if (isset($_GET['get_slider'])) {
	$id = $_POST['id'];
	$sql = "SELECT * FROM `slider` WHERE id='" . $id . "' ";
	$result = $server->query($sql);
	$row = mysqli_fetch_assoc($result);
	if ($row != null) {
		$data = array('msg' => $row, 'status' => 200);
		echo json_encode($data);
		exit();
	} else {
		$data = array('msg' => 'ไม่พบข้อมูล', 'status' => 500);
		echo json_encode($data);
		exit();
	}
}

if (isset($_GET['del_slider'])) {
	$id = $_POST['id'];
	$sql = "UPDATE `slider` SET `is_delete` = true, `update_by` = '" . $_SESSION["username"] . "', `update_date` = NOW() WHERE id='" . $id . "'";
	if ($server->query($sql) === TRUE) {
		$data = array('msg' => 'อัพเดท ข้อมูล !สำเร็จ', 'status' => 200);
		echo json_encode($data);
		exit();
	} else {
		$data = array('msg' => 'อัพเดท ข้อมูล !ไม่สำเร็จ', 'status' => 500);
		echo json_encode($data);
		exit();
	}
}

if (isset($_GET['add_slider'])) {
	if (isset($_FILES['file_data']['name'])) {
		$select_display = $_POST['select_display'];

		$prefix = uniqid();
		$file_ext = '.jpg';
		$file_name = $prefix . $file_ext;
		$location = "upload/img_slider/" . $file_name;
		if (move_uploaded_file($_FILES['file_data']['tmp_name'], $location)) {
			$response = $location;
		}
		$sql = "SELECT MAX(sort) as max_sort  FROM `slider`";
		$result = $server->query($sql);
		$row = mysqli_fetch_assoc($result);
		$max_sort = $row['max_sort'];

		if ($max_sort == null || $max_sort <= 0) {
			$max_sort = 1;
		} else {
			$max_sort++;
		}

		$sql = "INSERT INTO `slider`(`path`, `sort`, `is_hide`, `create_by`, `create_date`) VALUES ('" . $response . "','" . $max_sort . "','" . $select_display . "','" . $_SESSION["username"] . "',NOW())";
		if ($server->query($sql) === TRUE) {
			$data = array('msg' => 'เพิ่มข้อมูล สำเร็จ', 'status' => 200);
			echo json_encode($data);
			exit();
		} else {
			$data = array('msg' => 'เพิ่มข้อมูล ไม่สำเร็จ', 'status' => 500);
			echo json_encode($data);
			exit();
		}
	} else {
		$data = array('msg' => 'ยังไม่ได้เลือกไฟล์', 'status' => 500);
		echo json_encode($data);
		exit();
	}
}

if (isset($_GET['edit_slider'])) {
	$id = $_POST['id'];
	$select_display = $_POST['select_display'];

	if (isset($_FILES['file_data']['name'])) {
		$prefix = uniqid();
		$file_ext = '.jpg';
		$file_name = $prefix . $file_ext;
		$location = "upload/img_slider/" . $file_name;
		if (move_uploaded_file($_FILES['file_data']['tmp_name'], $location)) {
			$response = $location;
		}
		$sql = "SELECT `path` FROM `slider` WHERE id='" . $id . "'";
		$result = $server->query($sql);
		$row = mysqli_fetch_assoc($result);
		$path = $row['path'];
		if ($path != null && $path != "") {
			unlink($path);
		}
		$sql = "UPDATE `slider` SET `path` = '" . $response . "', `update_by` = '" . $_SESSION["username"] . "', `update_date` = NOW() WHERE id='" . $id . "'";
		if ($server->query($sql) === FALSE) {
			$data = array('msg' => 'อัพเดท รูปภาพ !ไม่สำเร็จ', 'status' => 500);
			echo json_encode($data);
			exit();
		}
	}

	$sql = "UPDATE `slider` SET `is_hide` = '" . $select_display . "', `update_by` = '" . $_SESSION["username"] . "', `update_date` = NOW() WHERE id='" . $id . "'";
	if ($server->query($sql) === TRUE) {
		$data = array('msg' => 'อัพเดท ข้อมูล !สำเร็จ', 'status' => 200);
		echo json_encode($data);
		exit();
	} else {
		$data = array('msg' => 'อัพเดท ข้อมูล !ไม่สำเร็จ', 'status' => 500);
		echo json_encode($data);
		exit();
	}
}

if (isset($_GET['sort_slider'])) {
	$onchange_id = $_POST['onchange_id'];
	$id_arr = explode(",", $onchange_id);
	$check_update_all = true;
	for ($i = 0; $i < count($id_arr); $i++) {
		$sql = "UPDATE `slider` SET `sort` = '" . ($i + 1) . "', `update_by` = '" . $_SESSION["username"] . "', `update_date` = NOW() WHERE id='" . $id_arr[$i] . "'";
		if ($server->query($sql) === FALSE) {
			$check_update_all = false;
		}
	}
	if ($check_update_all) {
		$data = array('msg' => 'อัพเดท ข้อมูล !สำเร็จ', 'status' => 200);
		echo json_encode($data);
		exit();
	} else {
		$data = array('msg' => 'อัพเดท ข้อมูล !ไม่สำเร็จ', 'status' => 500);
		echo json_encode($data);
		exit();
	}
	exit();
}



if (isset($_GET['update_website'])) {
	$id = '1';
	$title = $_POST['title'];
	$keyword = $_POST['keyword'];
	$domain = $_POST['domain'];
	$line = $_POST['line'];
	$agent = $_POST['agent'];
	$refund = $_POST['refund'];
	$affliliate = $_POST['affliliate'];
	$minimum_withdraw = $_POST['minimum_withdraw'];
	$minimum_deposit = $_POST['minimum_deposit'];
	$max_withdraw = $_POST['max_withdraw'];
	$min_refund = $_POST['min_refund'];
	$min_affliliate = $_POST['min_affliliate'];
	$enable_webpage = $_POST['enable_webpage'];

	$minimum_withdraw = str_replace(",", "", $minimum_withdraw);
	$minimum_deposit = str_replace(",", "", $minimum_deposit);
	$max_withdraw = str_replace(",", "", $max_withdraw);
	$min_refund = str_replace(",", "", $min_refund);
	$min_affliliate = str_replace(",", "", $min_affliliate);

	$sql = "SELECT * FROM `website` WHERE id='" . $id . "'";
	$result = $server->query($sql);
	$row = mysqli_fetch_assoc($result);
	$logoUrl = $row['logo'];
	$iconUrl = $row['icon'];

	// preg_match('/%/', $affliliate1, $output_array);
	// $check=$output_array[0];


	// if ($check!='%') {
	// 	$data = array ('msg'=>'กรุณาใส่ %','status'=>500);
	// 	echo json_encode($data);
	// 	exit();
	// }


	// echo json_encode($logoUrl);

	if (isset($_FILES['file']['name'])) {
		if (isset($logoUrl) && $logoUrl != "") {
			unlink($logoUrl);
		}

		/* Getting file name */
		$prefix = uniqid();
		$file_ext = '.jpg';
		$file_name = $prefix . $file_ext;
		// $filename = $_FILES['file']['name'];

		/* Location */
		$location = "upload/img_logo/" . $file_name;
		/* Upload file */
		if (move_uploaded_file($_FILES['file']['tmp_name'], $location)) {
			$response = $location;
		}

		$sql = "UPDATE `website` SET `logo`='" . $response . "', `title`='" . $title . "',`keyword`='" . $keyword . "',`domain`='" . $domain . "',`line_id`='" . $line . "',`agent_username`='" . $agent . "',`refund_percen`='" . $refund . "',`affliliate_percen`='" . $affliliate . "',`minimum_deposit`='" . $minimum_deposit . "',`minimum_withdraw`='" . $minimum_withdraw . "',`max_withdraw`='" . $max_withdraw . "',`min_refund`='" . $min_refund . "',`min_affliliate`='" . $min_affliliate . "',`enable_webpage`='" . $enable_webpage . "'  WHERE id='" . $id . "'";
	} else {
		$sql = "UPDATE `website` SET `title`='" . $title . "',`keyword`='" . $keyword . "',`domain`='" . $domain . "',`line_id`='" . $line . "',`agent_username`='" . $agent . "',`refund_percen`='" . $refund . "',`affliliate_percen`='" . $affliliate . "',`minimum_deposit`='" . $minimum_deposit . "',`minimum_withdraw`='" . $minimum_withdraw . "',`max_withdraw`='" . $max_withdraw . "',`min_refund`='" . $min_refund . "',`min_affliliate`='" . $min_affliliate . "',`enable_webpage`='" . $enable_webpage . "'  WHERE id='" . $id . "'";
	}

	if (isset($_FILES['fileIcon']['name'])) {


		if (isset($iconUrl) && $iconUrl != "") {
			unlink($iconUrl);
		}

		// $prefixIcon = uniqid();
		// $file_extIcon = '.ico';
		// $file_nameIcon = $prefixIcon.$file_extIcon;
		$file_nameIcon = $_FILES['fileIcon']['name'];

		/* Location */
		$locationIcon = "upload/img_icon/" . $file_nameIcon;
		/* Upload file */
		if (move_uploaded_file($_FILES['fileIcon']['tmp_name'], $locationIcon)) {
			$responseIcon = $locationIcon;
		}

		$sqlIcon = "UPDATE `website` SET `icon`='" . $responseIcon . "', `title`='" . $title . "',`keyword`='" . $keyword . "',`domain`='" . $domain . "',`line_id`='" . $line . "',`agent_username`='" . $agent . "',`refund_percen`='" . $refund . "',`affliliate_percen`='" . $affliliate . "',`minimum_deposit`='" . $minimum_deposit . "',`minimum_withdraw`='" . $minimum_withdraw . "',`max_withdraw`='" . $max_withdraw . "',`min_refund`='" . $min_refund . "',`min_affliliate`='" . $min_affliliate . "',`enable_webpage`='" . $enable_webpage . "'  WHERE id='" . $id . "'";
		$server->query($sqlIcon);
	} else {
		$sqlIcon = "UPDATE `website` SET `title`='" . $title . "',`keyword`='" . $keyword . "',`domain`='" . $domain . "',`line_id`='" . $line . "',`agent_username`='" . $agent . "',`refund_percen`='" . $refund . "',`affliliate_percen`='" . $affliliate . "',`minimum_deposit`='" . $minimum_deposit . "',`minimum_withdraw`='" . $minimum_withdraw . "',`max_withdraw`='" . $max_withdraw . "',`min_refund`='" . $min_refund . "',`min_affliliate`='" . $min_affliliate . "',`enable_webpage`='" . $enable_webpage . "'  WHERE id='" . $id . "'";
		$server->query($sqlIcon);
	}




	if ($server->query($sql) === TRUE) {
		$data = array('msg' => 'อัพเดท ข้อมูล !สำเร็จ', 'status' => 200);
		echo json_encode($data);
		exit();
	} else {
		$data = array('msg' => 'อัพเดท ข้อมูล !ไม่สำเร็จ', 'status' => 500);
		echo json_encode($data);
		exit();
	}
}


if (isset($_GET['restore_turnover'])) {
	$phone = $_POST['phone'];

	$check_update1 = false;
	$check_update2 = false;

	$sql_member = "SELECT * FROM member WHERE phone='" . $phone . "'";
	$result_member = $server->query($sql_member);
	$row_member = mysqli_fetch_assoc($result_member);

	$sql = "UPDATE `member` SET `turnover`='0',`turnover_struck`='0' WHERE phone='" . $phone . "'";
	if ($server->query($sql) === TRUE) {
		$check_update1 = true;
	} else {
		$data = array('msg' => 'อัพเดท ข้อมูลยูส !ไม่สำเร็จ', 'status' => 500);
		echo json_encode($data);
		exit();
	}

	$sql = "UPDATE `history_promotion` SET `status_turnover`='0' WHERE phone='" . $phone . "'";
	if ($server->query($sql) === TRUE) {
		$check_update2 = true;
	} else {
		$data = array('msg' => 'อัพเดท ข้อมูลประวัติโปรโมชั่น !ไม่สำเร็จ', 'status' => 500);
		echo json_encode($data);
		exit();
	}

	if ($check_update1 && $check_update2) {
		// รีเซ็ตเทิร์น
		$sql_log_admin = "INSERT INTO `log_admin` (user_admin,user_member,detail_code,create_date,value1,value2,value3,value4) VALUES 
		('" . $_SESSION['username'] . "','" . $row_member['username_game'] . "','RET',NOW(),'" . $row_member['turnover'] . "','" . $row_member['turnover_struck'] . "','','')";
		$server->query($sql_log_admin);

		$data = array('msg' => 'อัพเดท ข้อมูล !สำเร็จ', 'status' => 200);
		echo json_encode($data);
		exit();
	} else {
		$data = array('msg' => 'อัพเดท ข้อมูล !ไม่สำเร็จ', 'status' => 500);
		echo json_encode($data);
		exit();
	}

	// $sql_pro = "SELECT * FROM history_promotion WHERE phone='" . $phone . "' ORDER BY id DESC";
	// $result_pro = $server->query($sql_pro);
	// $row_pro = mysqli_fetch_assoc($result_pro);
	// $id_pro=$row_pro['id'];
	// $status_turnover=$row_pro['status_turnover'];

	// if ($status_turnover=="") {
	// 	$data = array ('msg'=>'อัพเดท ข้อมูล !สำเร็จ','status'=>200);
	// 	echo json_encode($data);
	// 	exit();
	// }

	// $sql="UPDATE `history_promotion` SET `status_turnover`='1' WHERE id='".$id_pro."'";
	// if ($server->query($sql) === TRUE) {
	// 	$data = array ('msg'=>'อัพเดท ข้อมูล !สำเร็จ','status'=>200);
	// 	echo json_encode($data);
	// 	exit();
	// }else{
	// 	$data = array ('msg'=>'อัพเดท ข้อมูล !ไม่สำเร็จ','status'=>500);
	// 	echo json_encode($data);
	// 	exit();
	// }


}

if (isset($_GET['update_popup'])) {
	$id = $_POST['id'];
	$description = $_POST['description'];
	$name = $_POST['name'];
	$sql = "SELECT * FROM `popup` WHERE id='" . $id . "'";
	$result = $server->query($sql);
	$row = mysqli_fetch_assoc($result);
	$imageUrl = $row['image'];

	// $url=$_FILE['url'];
	// $url = $_FILES['file']['name'];
	if (isset($_FILES['file']['name'])) {
		if (isset($imageUrl)) {
			unlink($imageUrl);
		}

		/* Getting file name */
		$prefix = uniqid();
		$file_ext = '.jpg';
		$file_name = $prefix . $file_ext;
		// $filename = $_FILES['file']['name'];

		/* Location */
		$location = "upload/img_popup/" . $file_name;
		/* Upload file */
		if (move_uploaded_file($_FILES['file']['tmp_name'], $location)) {
			$response = $location;
		}

		//  echo json_encode($response);

		$deposit = str_replace(",", "", $deposit);
		$credit = str_replace(",", "", $credit);
		$turnover = str_replace(",", "", $turnover);

		// echo json_encode($_POST);

		$sql = "UPDATE `popup` SET `description`='" . $description . "',`image`='" . $response . "',`name`='" . $name . "' WHERE id='" . $id . "'";
	} else {

		$sql = "UPDATE `popup` SET `description`='" . $description . "' ,`name`='" . $name . "' WHERE id='" . $id . "'";
	}
	if ($server->query($sql) === TRUE) {
		$data = array('msg' => 'อัพเดท ข้อมูล !สำเร็จ', 'status' => 200);
		echo json_encode($data);
		exit();
	} else {
		$data = array('msg' => 'อัพเดท ข้อมูล !ไม่สำเร็จ', 'status' => 500);
		echo json_encode($data);
		exit();
	}
}



if (isset($_GET['update_bonus'])) {
	$id = $_POST['id'];
	$deposit = $_POST['deposit'];
	$credit = $_POST['credit'];
	$turnover = $_POST['turnover'];
	$min_deposit = $_POST['min_deposit'];
	$sql = "SELECT * FROM `promotion` WHERE p_id='" . $id . "'";
	$result = $server->query($sql);
	$row = mysqli_fetch_assoc($result);
	$imageUrl = $row['image'];
	$description = $_POST['description'];
	$maxximum = $_POST['maxximum'];
	// $url=$_FILE['url'];
	// $url = $_FILES['file']['name'];
	if (isset($_FILES['file']['name'])) {
		if (isset($imageUrl)) {
			unlink($imageUrl);
		}

		/* Getting file name */
		$prefix = uniqid();
		$file_ext = '.jpg';
		$file_name = $prefix . $file_ext;
		// $filename = $_FILES['file']['name'];

		/* Location */
		$location = "upload/img_bonus/" . $file_name;
		/* Upload file */
		if (move_uploaded_file($_FILES['file']['tmp_name'], $location)) {
			$response = $location;
		}

		//  echo json_encode($response);

		$deposit = str_replace(",", "", $deposit);
		$credit = str_replace(",", "", $credit);
		$turnover = str_replace(",", "", $turnover);

		// echo json_encode($_POST);

		$sql = "UPDATE `promotion` SET `p_deposit`='" . $deposit . "',`p_credit`='" . $credit . "',`turnover`='" . $turnover . "',`min_deposit`='" . $min_deposit . "',`image`='" . $response . "',`description`='" . $description . "',`maxximum`='" . $maxximum . "' WHERE p_id='" . $id . "'";
	} else {

		$sql = "UPDATE `promotion` SET `p_deposit`='" . $deposit . "',`p_credit`='" . $credit . "',`turnover`='" . $turnover . "',`min_deposit`='" . $min_deposit . "',`description`='" . $description . "',`maxximum`='" . $maxximum . "' WHERE p_id='" . $id . "'";
	}

	if ($server->query($sql) === TRUE) {
		$data = array('msg' => 'อัพเดท ข้อมูล !สำเร็จ', 'status' => 200);
		echo json_encode($data);
		exit();
	} else {
		$data = array('msg' => 'อัพเดท ข้อมูล !ไม่สำเร็จ', 'status' => 500);
		echo json_encode($data);
		exit();
	}
}

if (isset($_GET['delete_csv_member'])) {
	unlink("member.csv");
}

if (isset($_GET['delete_csv_refill'])) {
	unlink("refill.csv");
}

if (isset($_GET['delete_csv_withdraw'])) {
	unlink("withdraw.csv");
}

if (isset($_GET['download_refill'])) {

	$sql_website = "SELECT * FROM refill";
	$result_website = $server->query($sql_website);


	$filename = 'refill.csv';


	// file creation

	$file = fopen($filename, "w");

	foreach ($result_website as $value) {
		fputcsv($file, $value);
	}

	$data = array('msg' => 'สำเร็จ', 'status' => 200);
	echo json_encode($data);
	exit();
}


if (isset($_GET['download_withdraw'])) {

	$sql_website = "SELECT * FROM withdraw";
	$result_website = $server->query($sql_website);


	$filename = 'withdraw.csv';



	$file = fopen($filename, "w");

	foreach ($result_website as $value) {
		fputcsv($file, $value);
	}

	$data = array('msg' => 'สำเร็จ', 'status' => 200);
	echo json_encode($data);
	exit();
}


if (isset($_GET['download_member'])) {

	$sql_website = "SELECT * FROM member";
	$result_website = $server->query($sql_website);


	$filename = 'member.csv';



	$file = fopen($filename, "w");

	foreach ($result_website as $value) {
		fputcsv($file, $value);
	}

	$data = array('msg' => 'สำเร็จ', 'status' => 200);
	echo json_encode($data);
	exit();
}

if (isset($_GET['add_bonus'])) {
	$p_name = $_POST['p_name'];
	$deposit = $_POST['deposit'];
	$credit = $_POST['credit'];
	$turnover = $_POST['turnover'];
	$maxximum = $_POST['maxximum'];
	$condition_pro1 = $_POST['condition_pro1'];
	$description = $_POST['description'];
	$min_deposit = $_POST['min_deposit'];
	// $url=$_FILE['url'];
	// $url = $_FILES['file']['name'];
	if (isset($_FILES['file']['name'])) {

		/* Getting file name */
		// $filename = $_FILES['file']['name'];
		$prefix = uniqid();
		$file_ext = '.jpg';
		$file_name = $prefix . $file_ext;

		/* Location */
		$location = "upload/img_bonus/" . $file_name;
		/* Upload file */
		if (move_uploaded_file($_FILES['file']['tmp_name'], $location)) {
			$response = $location;
		}
	}
	//  echo json_encode($response);

	$deposit = str_replace(",", "", $deposit);
	$credit = str_replace(",", "", $credit);
	$turnover = str_replace(",", "", $turnover);



	if ($maxximum == "") {
		$sql = "INSERT INTO `promotion`(`p_name`, `p_deposit`, `p_credit`, `turnover`, `image`,`condition_pro`,`description`,`min_deposit`) VALUES ('" . $p_name . "','" . $deposit . "','" . $credit . "','" . $turnover . "','" . $response . "','" . $condition_pro1 . "','" . $description . "','" . $min_deposit . "')";
	} else {
		preg_match('/%/', $deposit, $output_array);
		$check = $output_array[0];
		if ($check != "%") {
			$data = array('msg' => 'ใส่ % ด้วย', 'status' => 500);
			echo json_encode($data);
			exit();
		}
		$sql = "INSERT INTO `promotion`(`p_name`, `p_deposit`,`turnover`, `image`,`condition_pro`,`maxximum`,`description`,`min_deposit`) VALUES ('" . $p_name . "','" . $deposit . "','" . $turnover . "','" . $response . "','" . $condition_pro1 . "','" . $maxximum . "','" . $description . "','" . $min_deposit . "')";
	}

	// echo $sql;
	// exit();



	if ($server->query($sql) === TRUE) {
		$data = array('msg' => 'เพิ่ม ข้อมูล !สำเร็จ', 'status' => 200);
		echo json_encode($data);
		exit();
	} else {
		$data = array('msg' => 'เพิ่ม ข้อมูล !ไม่สำเร็จ', 'status' => 500);
		echo json_encode($data);
		exit();
	}
}



if (isset($_GET['delete_popup'])) {
	$id = $_POST['id'];



	$sql = "DELETE FROM promotion WHERE id=$id";
	if ($server->query($sql) === TRUE) {
		$data = array('msg' => 'ลบ ข้อมูล !สำเร็จ', 'status' => 200);
		echo json_encode($data);
	} else {
		$data = array('msg' => 'ลบ ข้อมูล !ไม่สำเร็จ', 'status' => 500);
		echo json_encode($data);
	}
}

if (isset($_GET['delete_bonus'])) {
	$id = $_POST['id'];



	$sql = "DELETE FROM promotion WHERE p_id=$id";
	if ($server->query($sql) === TRUE) {
		$data = array('msg' => 'ลบ ข้อมูล !สำเร็จ', 'status' => 200);
		echo json_encode($data);
	} else {
		$data = array('msg' => 'ลบ ข้อมูล !ไม่สำเร็จ', 'status' => 500);
		echo json_encode($data);
	}
}


if (isset($_GET['add_member'])) {

	$password = mysqli_real_escape_string($server, md5($_POST["password"]));
	$bank_number = $_POST["bank_number"];
	$bank_name = $_POST["bank_name"];
	$phone = $_POST["phone"];
	$refid = $_POST["ref"];
	$fname = $_POST["fname"];

	$phone = preg_replace("/[^a-z\d]/i", '', $phone);

	$query = $server->query('SELECT * FROM member WHERE phone = "' . $phone . '" ');
	$check = $query->num_rows;
	if ($check >= 1) {
		$data = array('msg' => 'เบอร์ ' . $phone . ' ถูกใช้งานไปแล้ว ! ติดต่อ ADMIN', 'status' => 500);
		echo json_encode($data);
		exit();
	}

	$query = $server->query('SELECT * FROM member WHERE bank_number = "' . $bank_number . '" ');
	$check = $query->num_rows;
	if ($check >= 1) {
		$data = array('msg' => ' ' . $bank_number . ' เลขบัญชีนี้ ถูกใช้งานไปแล้ว ! ติดต่อ ADMIN', 'status' => 500);
		echo json_encode($data);
		exit();
	}



	$query = $server->query('SELECT * FROM member WHERE fname = "' . $fname . '" ');
	$check = $query->num_rows;
	if ($check >= 1) {
		$data = array('msg' => 'ชื่อนี้ ถูกใช้งานไปแล้ว ! ติดต่อ ADMIN', 'status' => 500);
		echo json_encode($data);
		exit();
	}



	$sql2 = "SELECT * FROM user_stock";
	$result2 = $server->query($sql2);
	$row2 = mysqli_fetch_assoc($result2);
	$username_game = $row2['username'];
	$password_game = $row2['password'];

	if ($username_game == "") {
		$data = array('msg' => 'username game หมดสต็อก กรณาแจ้งADMIN', 'status' => 500);
		echo json_encode($data);
		exit();
	}




	$sql = "INSERT INTO `member`(`id`, `date_check`, `time_check`, `password`, `bank_number`, `bank_name`, `phone`,`refid`,`fname`,`username_game`,`password_game`) VALUES (null,'" . $date_check . "','" . $time_check . "','" . $password . "','" . $bank_number . "','" . $bank_name . "','" . $phone . "','" . $refid . "','" . trim($fname) . "','" . $username_game . "','" . $password_game . "')";



	if ($server->query($sql) === TRUE) {
		$token = getTokenFromDB("register");
		// $msg = "สมาชิก ".$phone." สมัครสำเร็จ";
		$msg = "\n สมาชิกชื่อ: " . trim($fname) . " \n เบอร์: " . $phone . " \n บัญชีธนาคาร: " . $bank_number . " " . $bank_name . " \n username: " . $username_game . "\n สมัครสำเร็จ";
		$res = lineAlert($token, $msg);


		$sql = "DELETE FROM user_stock WHERE username='" . $username_game . "'";
		if ($server->query($sql) === TRUE) {
			$_SESSION["phone"] = $phone;
			session_write_close();

			$data = array('msg' => 'สมัครสมาชิกสำเร็จ', 'status' => 200);
			echo json_encode($data);
			exit();
		}
	}
}

if (isset($_GET['add_bank'])) {
	$addBankname = $_POST['addBankname'];
	$addBanknumber = $_POST['addBanknumber'];
	$addBanktype = $_POST['addBanktype'];
	$deviceid = encrypt($_POST['deviceid'], $has_key);
	$pin = encrypt($_POST['pin'], $has_key);



	$sql = "INSERT INTO `scb_info`(`fname`, `banknumber`, `bankname`, `deviceid`, `pin`) VALUES ('" . $addBankname . "','" . $addBanknumber . "','" . $addBanktype . "','" . $deviceid . "','" . $pin . "')";



	if ($server->query($sql) === TRUE) {
		$data = array('msg' => 'ทำรายการ สำเร็จ', 'status' => 200);
		echo json_encode($data);
		exit();
	} else {
		$data = array('msg' => 'ทำรายการ ไม่สำเร็จ', 'status' => 500);
		echo json_encode($data);
	}
}

if (isset($_GET['add_admin'])) {

	$username = $_POST['username'];
	$fname = $_POST['fname'];
	$category = $_POST['catogory'];
	$password = mysqli_real_escape_string($server, md5($_POST["password"]));

	$result = "";
	foreach ($category as  $value) {
		if ($value != 'เลือกหมวดหมู่:') {
			$result .= $value . ",";
		}
	}
	$category = $result;

	// $sql="INSERT INTO `admin`(`id`, `date_check`, `time_check`, `password`, `phone`, `last_withdraw`, `last_refund`, `date_commission`) VALUES (null,'".$date_check."','".$time_check."','".$password."','".$phone."','".$date_check."','".$date_check."','".$date_check."')";

	$sql = "INSERT INTO `admin`(`id`, `username`, `password`, `fname`, `category`) VALUES (null,'" . $username . "','" . $password . "','" . $fname . "','" . $category . "')";

	if ($server->query($sql) === TRUE) {
		$data = array('msg' => 'ทำรายการ สำเร็จ', 'status' => 200);
		echo json_encode($data);
		exit();
	} else {
		$data = array('msg' => 'ทำรายการ ไม่สำเร็จ', 'status' => 500);
		echo json_encode($data);
	}
}


if (isset($_GET['update_member'])) {

	$id = $_POST['id'];
	$phone = $_POST['phone'];
	$password = $_POST['password'];
	$fname = $_POST['fname'];
	$bank_number = $_POST['bank_number'];
	$bank_name = $_POST['bank_name'];
	$refid = $_POST['refid'];

	if ($_POST['refid'] != "") {
		$sql = "SELECT * FROM `member` where phone='" . $phone . "'";
		$result = $server->query($sql);
		$row = mysqli_fetch_assoc($result);
		$refid = $row['username_game'];

		if ($refid == "") {
			$data = array('msg' => 'ไม่พบชื่อผู้เล่นนี้', 'status' => 500);
			echo json_encode($data);
			exit();
		}
	}

	$e_affliliate_percen = $_POST['e_affliliate_percen'];

	if ($e_affliliate_percen != "") {
		preg_match('/%/', $e_affliliate_percen, $output_array);
		$check = $output_array[0];


		if ($check != '%') {
			$data = array('msg' => 'กรุณาใส่ %', 'status' => 500);
			echo json_encode($data);
			exit();
		}
	}

	$sql = "SELECT * FROM `member` where phone='" . $phone . "'";
	$result = $server->query($sql);
	$row1 = mysqli_fetch_assoc($result);
	$json_member_old = json_encode($row1, JSON_UNESCAPED_UNICODE);
	// $text_member_old = "phone=".$row1['phone'].",fname=".$row1['fname'].",bank_number=".$row1['bank_number'].",bank_name=".$row1['bank_name'].",refid=".$row1['refid'].",e_affliliate_percen=".$row1['e_affliliate_percen'];

	if ($password != "") {

		$sql = "UPDATE `member` SET `phone`='" . $phone . "',`password`='" . mysqli_real_escape_string($server, md5($_POST["password"])) . "',`fname`='" . $fname . "',`bank_number`='" . $bank_number . "',`bank_name`='" . $bank_name . "',`affliliate_percen`='" . $e_affliliate_percen . "',refid='" . $refid . "' WHERE id='" . $id . "'";

		if ($server->query($sql) === TRUE) {
			$data = array('msg' => 'อัพเดท ข้อมูล !สำเร็จ', 'status' => 200);
			echo json_encode($data);

			$sql = "SELECT * FROM `member` where phone='" . $phone . "'";
			$result = $server->query($sql);
			$row = mysqli_fetch_assoc($result);
			$json_member_new = json_encode($row, JSON_UNESCAPED_UNICODE);
			// $text_member_new = "phone=".$row['phone'].",fname=".$row['fname'].",bank_number=".$row['bank_number'].",bank_name=".$row['bank_name'].",refid=".$row['refid'].",e_affliliate_percen=".$row['e_affliliate_percen'];

			$text_member = "";
			if($row1['phone'] != $row['phone']){
				$text_member = $text_member."phone=".$row1['phone']." -> ".$row['phone']."<br>";
			}
			if($row1['fname'] != $row['fname']){
				$text_member = $text_member."fname=".$row1['fname']." -> ".$row['fname']."<br>";
			}
			if($row1['bank_number'] != $row['bank_number']){
				$text_member = $text_member."bank_number=".$row1['bank_number']." -> ".$row['bank_number']."<br>";
			}
			if($row1['bank_name'] != $row['bank_name']){
				$text_member = $text_member."bank_name=".$row1['bank_name']." -> ".$row['bank_name']."<br>";
			}
			if($row1['refid'] != $row['refid']){
				$text_member = $text_member."refid=".$row1['refid']." -> ".$row['refid']."<br>";
			}
			if($row1['e_affliliate_percen'] != $row['e_affliliate_percen']){
				$text_member = $text_member."e_affliliate_percen=".$row1['e_affliliate_percen']." -> ".$row['e_affliliate_percen']."<br>";
			}
			// echo "text_member=".$text_member;
			// exit();
			$sql_log_admin = "INSERT INTO `log_admin` (user_admin,user_member,detail_code,create_date,value1,value2,value3,value4) VALUES 
			('" . $_SESSION['username'] . "','" . $row['username_game'] . "','EDM',NOW(),'" . $text_member . "','" . $json_member_old . "','" . $json_member_new . "','')";
			$server->query($sql_log_admin);

			exit();
		} else {
			$data = array('msg' => 'อัพเดท ข้อมูล !ไม่สำเร็จ', 'status' => 500);
			echo json_encode($data);
			exit();
		}
	} else {
		$sql = "UPDATE `member` SET `phone`='" . $phone . "',`fname`='" . $fname . "',`bank_number`='" . $bank_number . "',`bank_name`='" . $bank_name . "' ,`affliliate_percen`='" . $e_affliliate_percen . "',refid='" . $refid . "' WHERE id='" . $id . "'";

		// exit();

		if ($server->query($sql) === TRUE) {
			$data = array('msg' => 'อัพเดท ข้อมูล !สำเร็จ', 'status' => 200);
			echo json_encode($data);

			$sql = "SELECT * FROM `member` where phone='" . $phone . "'";
			$result = $server->query($sql);
			$row = mysqli_fetch_assoc($result);
			$json_member_new = json_encode($row, JSON_UNESCAPED_UNICODE);
			// $text_member_new = "phone=".$row['phone'].",fname=".$row['fname'].",bank_number=".$row['bank_number'].",bank_name=".$row['bank_name'].",refid=".$row['refid'].",e_affliliate_percen=".$row['e_affliliate_percen'];

			// exit();

			$text_member = "";
			if($row1['phone'] != $row['phone']){
				$text_member = $text_member."phone=".$row1['phone']." -> ".$row['phone']."<br>";
			}
			if($row1['fname'] != $row['fname']){
				$text_member = $text_member."fname=".$row1['fname']." -> ".$row['fname']."<br>";
			}
			if($row1['bank_number'] != $row['bank_number']){
				$text_member = $text_member."bank_number=".$row1['bank_number']." -> ".$row['bank_number']."<br>";
			}
			if($row1['bank_name'] != $row['bank_name']){
				$text_member = $text_member."bank_name=".$row1['bank_name']." -> ".$row['bank_name']."<br>";
			}
			if($row1['refid'] != $row['refid']){
				$text_member = $text_member."refid=".$row1['refid']." -> ".$row['refid']."<br>";
			}
			if($row1['e_affliliate_percen'] != $row['e_affliliate_percen']){
				$text_member = $text_member."e_affliliate_percen=".$row1['e_affliliate_percen']." -> ".$row['e_affliliate_percen']."<br>";
			}
			// echo "text_member=".$text_member;
			// exit();

			$sql_log_admin = "INSERT INTO `log_admin` (user_admin,user_member,detail_code,create_date,value1,value2,value3,value4) VALUES 
			('" . $_SESSION['username'] . "','" . $row['username_game'] . "','EDM',NOW(),'" . $text_member. "','" . $json_member_old . "','" . $json_member_new . "','')";
			$server->query($sql_log_admin);

			exit();
		}
	}
}




if (isset($_GET['delete_member'])) {
	$id = $_POST['id'];

	$sql = "SELECT * FROM `member` where id=" . $id;
	$result = $server->query($sql);
	$row = mysqli_fetch_assoc($result);
	$member_data = implode(" | ", $row);

	$sql = "DELETE FROM member WHERE id=$id";
	if ($server->query($sql) === TRUE) {

		$sql_log_admin = "INSERT INTO `log_admin` (user_admin,user_member,detail_code,create_date,value1,value2,value3,value4) VALUES 
		('" . $_SESSION['username'] . "','" . $row['username_game'] . "','DM',NOW(),'" . $member_data . "','','','')";
		$server->query($sql_log_admin);

		$data = array('msg' => 'ลบ ข้อมูล !สำเร็จ', 'status' => 200);
		echo json_encode($data);
	} else {
		$data = array('msg' => 'ลบ ข้อมูล !ไม่สำเร็จ', 'status' => 500);
		echo json_encode($data);
	}
}




if (isset($_GET['delete_admin'])) {
	$id = $_POST['id'];

	$sql = "SELECT * FROM `admin` where id=" . $id;
	$result = $server->query($sql);
	$row = mysqli_fetch_assoc($result);
	$status = $row['status'];

	if ($status == 1) {
		$data = array('msg' => 'ไม่สามารถลบแอดมิน สูงสุดได้', 'status' => 500);
		echo json_encode($data);
		exit();
	}

	$sql = "DELETE FROM admin WHERE id=$id";
	if ($server->query($sql) === TRUE) {
		$data = array('msg' => 'ลบ ข้อมูล !สำเร็จ', 'status' => 200);
		echo json_encode($data);
	} else {
		$data = array('msg' => 'ลบ ข้อมูล !ไม่สำเร็จ', 'status' => 500);
		echo json_encode($data);
	}
}
if (isset($_GET['update_admin'])) {

	$id = $_POST['id'];
	$username = $_POST['username'];
	$password = $_POST['password'];
	$phone = $_POST['phone'];
	$fname = $_POST['fname'];

	$category = $_POST['category_List'];
	
	$result = "";
	foreach ($category as  $value) {
		if ($value != 'เลือกหมวดหมู่:') {
			$result .= $value . ",";
		}
	}
	$category = $result;


	// print_r($category);
	// exit();

	if ($password != "") {
		$sql = "UPDATE `admin` SET `username`='" . $username . "',`password`='" . mysqli_real_escape_string($server, md5($_POST["password"])) . "',`fname`='" . $fname . "',`category`='" . $category . "' WHERE id='" . $id . "'";


		if ($server->query($sql) === TRUE) {
			$data = array('msg' => 'อัพเดท ข้อมูล !สำเร็จ', 'status' => 200);
			echo json_encode($data);
			exit();
		} else {
			$data = array('msg' => 'อัพเดท ข้อมูล !ไม่สำเร็จ', 'status' => 500);
			echo json_encode($data);
			exit();
		}
	} else {
		$sql = "UPDATE `admin` SET `username`='" . $username . "',`fname`='" . $fname . "',`category`='" . $category . "' WHERE id='" . $id . "'";
		if ($server->query($sql) === TRUE) {
			$data = array('msg' => 'อัพเดท ข้อมูล !สำเร็จ', 'status' => 200);
			echo json_encode($data);
			exit();
		}
	}
}
if (isset($_GET['getallgameplay'])) {
	$phone = $_POST['phone'];
	$getusername = "SELECT username_game FROM `member` WHERE phone = '" . $phone . "' ";
	$query = $server->query($getusername);
	$memberid = $query->fetch_row();

	$getagent = "SELECT agent_username FROM `website` WHERE id=1";
	$query1 = $server->query($getagent);
	$agentName = $query1->fetch_row();

	$userName = $agentName[0] . $memberid[0];

	$sql = "SELECT SUM(turnover) as allturnover FROM `report_game` where username ='" . $userName . "' ";
	$result = $server->query($sql);
	$row = mysqli_fetch_assoc($result);

	$sql2 = "SELECT SUM(winloss) as allpositive FROM `report_game` where username ='" . $userName . "' and winloss > 0";
	$result2 = $server->query($sql2);
	$row2 = mysqli_fetch_assoc($result2);

	$sql3 = "SELECT SUM(winloss) as allnegative FROM `report_game` where username ='" . $userName . "' and winloss < 0";
	$result3 = $server->query($sql3);
	$row3 = mysqli_fetch_assoc($result3);

	$data = array('allturnover' => (isset($row['allturnover']) ? $row['allturnover'] : "0"), 'allpositive' => (isset($row2['allpositive']) ? $row2['allpositive'] : "0"), 'allnegative' => (isset($row3['allnegative']) ? $row3['allnegative'] : "0"), 'status' => 200);

	echo json_encode($data);
	exit();
}


if (isset($_GET['reset_promotion'])) {
	$id = $_POST['id'];
	$sql_update_promotion = "UPDATE `member` SET `status_promotion`='0' WHERE id='" . $id . "'";
	if ($server->query($sql_update_promotion) === TRUE) {
		$data = array('msg' => 'ทำรายการ !สำเร็จ', 'status' => 200);
		echo json_encode($data);
	}
}

if (isset($_GET['get_promotion'])) {
	$id = $_POST['id'];
	$sql_update_promotion = "UPDATE `member` SET `status_promotion`='1' WHERE id='" . $id . "'";
	if ($server->query($sql_update_promotion) === TRUE) {
		$data = array('msg' => 'ทำรายการ !สำเร็จ', 'status' => 200);
		echo json_encode($data);
	}
}
