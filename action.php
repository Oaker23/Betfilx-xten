<?php
error_reporting(0);

session_start();
require_once 'config/config.php';
require_once 'config/config_data.php';
require_once 'manager/test.php';
date_default_timezone_set('Asia/Bangkok');
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


$date_now = date("Y-m-d");
// include("api_betflix.php");
function get_client_ip()
{
	$ipaddress = '';
	if (getenv('HTTP_CLIENT_IP'))
		$ipaddress = getenv('HTTP_CLIENT_IP');
	else if (getenv('HTTP_X_FORWARDED_FOR'))
		$ipaddress = getenv('HTTP_X_FORWARDED_FOR');
	else if (getenv('HTTP_X_FORWARDED'))
		$ipaddress = getenv('HTTP_X_FORWARDED');
	else if (getenv('HTTP_FORWARDED_FOR'))
		$ipaddress = getenv('HTTP_FORWARDED_FOR');
	else if (getenv('HTTP_FORWARDED'))
		$ipaddress = getenv('HTTP_FORWARDED');
	else if (getenv('REMOTE_ADDR'))
		$ipaddress = getenv('REMOTE_ADDR');
	else
		$ipaddress = 'UNKNOWN';
	return $ipaddress;
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

if (isset($_GET['login'])) {

	$username = mysqli_real_escape_string($server, $_POST["phone"]);
	$password = mysqli_real_escape_string($server, md5($_POST["password"]));

	$username = preg_replace("/[^a-z\d]/i", '', $username);

	$query = $server->query('SELECT * FROM `member` WHERE `phone`="' . $username . '" and password="' . $password . '"');

	$username_check = $query->num_rows;
	$account = $query->fetch_assoc();
	if ($username_check == 0) {
		$data = array('msg' => ' ชื่อผู้ใช้ หรือ รหัสผ่านไม่ถูกต้อง', 'status' => 500);
		echo json_encode($data);
		exit();
	} else {

		$data = array('msg' => 'เข้าระบบ สำเร็จ!', 'status' => 200);
		echo json_encode($data);

		$_SESSION["phone"] = $account["phone"];
		session_write_close();

		$user_ip = getUserIP();
		$sql_log_admin = "INSERT INTO `log_member` (user_member,detail_code,create_date,value1,value2,value3,value4) VALUES 
		('".$account["phone"]."','LIN',NOW(),'".$user_ip."','','','')";
		$server->query($sql_log_admin);
	}
	exit();
}

if (isset($_GET['logout'])) {
	$user_ip = getUserIP();
	$sql_log_admin = "INSERT INTO `log_member` (user_member,detail_code,create_date,value1,value2,value3,value4) VALUES 
	('".$_SESSION["phone"]."','LOT',NOW(),'".$user_ip."','','','')";
	$server->query($sql_log_admin);
	session_destroy();
	echo '<meta http-equiv="refresh" content="0;url=login" />';
}

function resAlert($msg, $status)
{
	$data = array('msg' => $msg, 'status' => $status);
	echo json_encode($data);
}

function extract_int($str)
{
	preg_match('/[^0-9]*([0-9]+)[^0-9]*/', $str, $regs);
	return (intval($regs[1]));
}

function getTokenFromDB($type)
{
	require 'config/config.php';
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


if (isset($_GET['register'])) {
	require_once 'manager/test.php';
	$password = mysqli_real_escape_string($server, md5($_POST["password"]));
	$bank_number = $_POST["bank_number"];
	$bank_name = $_POST["bank_name"];
	$phone = preg_replace('/\D+/', '', $_POST["phone"]);
	$refid = $_POST["ref"];
	$confirm_code = $_POST["confirm_code"];


	$sql_bank = "SELECT * FROM `scb_info` WHERE description='ฝาก'";
	$result_bank = $server->query($sql_bank);
	$row_bank = mysqli_fetch_assoc($result_bank);


	$api = new scb(decrypt($row_bank['deviceid'], $has_key), $row_bank['banknumber'], decrypt($row_bank['pin'], $has_key), $encrypt, $host, $user, $pass, $db, $has_key);


	$name_data = $api->verification($bank_number, $bank_name);
	if ($name_data != null) {
		$fname = $name_data;
	} else {
		$fname = $_POST["fname"];
	}

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
		$data = array('msg' => 'ยุสหมดสต๊อค กรุณาติดต่อแอดมิน', 'status' => 500);
		echo json_encode($data);
		exit();
	}

	if ($fname == "ไม่พบเลขบัญชีของคุณ") {
		$data = array('msg' => $fname . " <br>กรุณากรอกหมายเลขบัญชีธนาคารให้ถูกต้อง", 'status' => 500);
		echo json_encode($data);
		exit();
	}

	if ($confirm_code != "1") {
		$data = array('msg' => $fname, 'status' => 202);
		echo json_encode($data);
		exit();
	}


	$sql = "INSERT INTO `member`(`id`, `date_check`, `time_check`, `password`, `bank_number`, `bank_name`, `phone`,`refid`,`fname`,`username_game`,`password_game`) VALUES (null,'" . $date_check . "','" . $time_check . "','" . $password . "','" . $bank_number . "','" . $bank_name . "','" . $phone . "','" . $refid . "','" . trim($fname) . "','" . $username_game . "','" . $password_game . "')";


	// echo $sql;
	// 	exit();

	if ($server->query($sql) === TRUE) {
		$token = getTokenFromDB("register");
		// $msg = "สมาชิก ".$phone." สมัครสำเร็จ";
		// $msg = "สมาชิกชื่อ: น.ส. กัญยลักษณ์ บุญส่ง เบอร์: 0616674221 บัญชีธนาคาร: 0722324315 กสิกรไทย username: 9cycu สมัครสำเร็จ";
		$msg = "\nสมาชิกชื่อ: " . trim($fname) . "\nเบอร์: " . $phone . "\nบัญชีธนาคาร: " . $bank_number . " " . $bank_name . "\nusername: " . $username_game . "\nสมัครสำเร็จ";

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


if ($_SESSION["phone"] == "") {

	echo " <script> window.location = './login';</script>";
	exit();
}

if (isset($_GET['turnover'])) {

	$phone = $_POST['phone'];
	//echo $phone;
	$sql = "SELECT * FROM member WHERE phone='" . $phone . "'";
	$result = $server->query($sql);
	$row = mysqli_fetch_assoc($result);
	$user_betflix = $row['username_game'];
	// $username=$row['username_game'];
	$cre = $row['turnOver'];

	// $sql = "SELECT * FROM `website`";
	// $result = $server->query($sql);
	// $row = mysqli_fetch_assoc($result);
	// $ag_betflix=$row['agent_username'];
	// $user_ufa=$row['agent_username'].$username;


	// echo $username;


	include 'api_betflix.php';
	$turn = Turnover($user_betflix);
	$turn = json_decode($turn, true)['turnover'];
	//  require '../cronjob/Ufa.php';
	//  $turn_ufa=$api->turnover($user_ufa);
	//  $turn_ufa = json_decode($turn_ufa,true)['win_lose'];
	//   $all_turn=$turn+$turn_ufa;
	$all_turn = $turn;


	// echo $all_turn;

	$sql = 'UPDATE `member` SET `turnover`="' . $all_turn . '" WHERE  phone="' . $phone . '"';
	if ($server->query($sql) === TRUE) {
		if ($all_turn != "") {
			$data = array('msg' => $all_turn, 'status' => 200);
			echo json_encode($data);
		} else {
			$data = array('msg' => "0.00", 'status' => 200);
			echo json_encode($data);
		}
	}
}

if (isset($_GET['promotion'])) {
	$phone = $_POST['phone'];
	$promotion = $_POST['promotion'];
	date_default_timezone_set("Asia/Bangkok");
	$date_now = date("d/m/Y");
	$time = date("h:i:s");
	$query = $server->query("SELECT * FROM `history_promotion` WHERE `status`='0' AND `phone`='" . $phone . "'");
	$sql_check = $query->num_rows;


	$query2 = $server->query("SELECT * FROM `history_promotion` WHERE `date_time`='' AND `phone`='" . $phone . "'");
	$sql_check2 = $query2->num_rows;

	if ($sql_check <= 0) {
		preg_match('/(?<=รับ ).(.*?)(?= )/', $promotion, $output_array);
		$promotion_credit = $output_array[0];
		preg_match('/(?<=เทิน ).+/', $promotion, $turnover);
		$turnover = $turnover[0];

		if ($promotion == "คุณรับโปรไปเเล้ว หรือไม่มีโปรโมชั่น") {
			exit();
		}
		if ($promotion != "ไม่รับโปรโมชั่น") { //บันทึกโปรโมชั่น



			$sql = "INSERT INTO `history_promotion`(`id`, `date_time`,`time`, `phone`, `promotion`, `credit`, `turnover`, `status`) VALUES (null,'" . $date_check . "','" . $time . "','" . $phone . "','" . $promotion . "','" . $promotion_credit . "','" . $turnover . "','0')";
			if ($server->query($sql) === TRUE) {
			}
			$sql_update_promotion = "UPDATE `member` SET `status_promotion`='1' WHERE phone='" . $phone . "'";
			if ($server->query($sql_update_promotion) === TRUE) {
			}
		} else {
			// $sql_update_promotion="UPDATE `member` SET `status_promotion`='0' WHERE phone='".$phone."'";
			//  if ($server->query($sql_update_promotion) === TRUE) {}
		}
	}
}


if (isset($_GET['update_aff'])) {
	$username = $_POST["ref"];
	$phone = $_POST["phone"];
	$sql = "SELECT * FROM member WHERE username_game='" . $username . "'";
	$result = $server->query($sql);
	$row = mysqli_fetch_assoc($result);



	include 'api_betflix.php';
	$date_now = date('Y-m-d');
	$refund = $api->Winlose($row['username_game'], $date_now, $date_now);


	$sql_website = "SELECT * FROM website";
	$result_website = $server->query($sql_website);
	$row_website = mysqli_fetch_assoc($result_website);
	$affliliate_percen = $row_website['affliliate_percen'];

	$refund = str_replace("-", "",	$refund);
	$refund = str_replace(",", "",	$refund);
	$affliliate_percen = str_replace("-", "",	$affliliate_percen);

	$total = $refund * $affliliate_percen / 100;

	$sql = "SELECT * FROM member WHERE phone='" . $phone . "'";
	$result = $server->query($sql);
	$row = mysqli_fetch_assoc($result);
	$credit_user = $row['balance_affliliate'];

	$credit_user = str_replace(",", "",	$credit_user);
	$total = str_replace(",", "",	$total);

	$sum = $credit_user + $total;

	$sql = "UPDATE `member` SET `balance_affliliate`='" . $sum . "' WHERE phone='" . $phone . "'";
	if ($server->query($sql) === TRUE) {
	}

	$sql = "UPDATE `member` SET `date_affliliate`='" . $date_check . "' WHERE username_game='" . $username . "'";
	if ($server->query($sql) === TRUE) {
	}

	$data = array('msg' => $total, 'status' => 200);
	echo json_encode($data);
}


if (isset($_GET['update_balance'])) {
	$phone = $_POST["phone"];

	$sql = "SELECT * FROM member WHERE phone='" . $phone . "'";
	$result = $server->query($sql);
	$row = mysqli_fetch_assoc($result);
	$phone = $row['phone'];


	include 'api_betflix.php';
	$result = $api->get_balance($row['username_game']);

	echo $result;
}








if (isset($_GET['reset_turn'])) {

	$phone = $_POST['phone'];
	$sql = "SELECT * FROM `member` where phone='" . $phone . "'";
	$result = $server->query($sql);
	$row = mysqli_fetch_assoc($result);
	$username_game = $row['username_game'];

	include 'api_betflix.php';

	$status = json_decode($api->get_balance($row["username_game"], $phone), true);

	$balance = $status['data']['balance'];

	if ($status['status'] == 'success') {
		if ($balance < 5) {

			$sql = "UPDATE `member` SET `status_turnover`='1' WHERE phone='" . $phone . "'";
			if ($server->query($sql) === TRUE) {
			}

			$data = array('msg' => 'ทำรายการ สำเร็จ', 'status' => 200);
			echo json_encode($data);
		} else {
			$data = array('msg' => 'ยอดเงินต้องต่ำกว่า 5บาท', 'status' => 500);
			echo json_encode($data);
		}
	} else {
		$data = array('msg' => 'ทำรายการ ไม่สำเร็จ', 'status' => 500);
		echo json_encode($data);
	}
}


if (isset($_GET['uodate_profile'])) {

	include 'api_betflix.php';



	$phone = $_POST["phone"];

	$sql = "SELECT * FROM member WHERE phone='" . $phone . "'";

	$result = $server->query($sql);
	$row = mysqli_fetch_assoc($result);

	if ($row['username_game'] != "" and $row['fname'] != "") {

		$status = $api->edit($row["username_game"], $row["fname"], $phone);
		print_r($status);


		// $sql_member='UPDATE `member` SET `turnover`="0"';
		// 	if ($server->query($sql_member) === TRUE) {
		// 		echo "update turnover=0 success";
		// 	}

		// $sql_all = "SELECT * FROM member";
		// $result_all = $server->query($sql_all);
		// while($row_all = mysqli_fetch_assoc($result_all)) {
		// 	$phone_all = $row_all['phone'];
		// 	$turnover_betflix = $api->Turnover($row_all['username_game']); // ดูยอดเงินสมาชิก
		// 	// print_r($turnover_betflix);
		// 	$turnover_betflix = json_decode($turnover_betflix,true);
		// 	//  echo "turnover_betflix=";
		// 	//  print_r($turnover_betflix);
		// 	// $turnover_betflix = $turnover_betflix['turnover'];
		// 	//  echo "turnover_betflix".$turnover_betflix;
		// 	$sql_member='UPDATE `member` SET `turnover`="'.$turnover_betflix.'" WHERE  phone="'.$phone_all.'"';
		// 	if ($server->query($sql_member) === TRUE) {
		// 		echo "update turnover_betflix success".$phone_all."  ";
		// 	}else{
		// 		echo "update turnover_betflix fail".$phone_all."  ";
		// 	}
		// }

		// $turnover_betflix = $api->Turnover($row['username_game']); // ดูยอดเงินสมาชิก
		// // print_r($turnover_betflix);
		// $turnover_betflix = json_decode($turnover_betflix,true);
		// //  echo "turnover_betflix=";
		// //  print_r($turnover_betflix);
		// // $turnover_betflix = $turnover_betflix['turnover'];
		// //  echo "turnover_betflix".$turnover_betflix;
		// $sql_member='UPDATE `member` SET `turnover`="'.$turnover_betflix.'" WHERE  phone="'.$phone.'"';
		// if ($server->query($sql_member) === TRUE) {
		// 	echo "update turnover_betflix success";
		// }else{
		// 	echo "update turnover_betflix fail";
		// }


	}
}





if (isset($_GET['credit_user'])) {
	$phone = $_POST["phone"];

	$phone = $_POST['phone'];
	$sql = "SELECT * FROM member WHERE phone='" . $phone . "'";



	$result = $server->query($sql);
	$row = mysqli_fetch_assoc($result);
	$credit = $row['credit'];

	if ($credit == "") {
		$credit = '0.00';
	}

	$data = array('msg' => $credit, 'status' => 200);
	echo json_encode($data);
}


if (isset($_GET['card_random'])) {

	$sql_member = "SELECT * FROM member WHERE phone='" . $_SESSION["phone"] . "'";
	$result_member = $server->query($sql_member);
	$row_member = mysqli_fetch_assoc($result_member);

	$start_time = date("Y-m-d");
	$end_time = date('Y-m-d', strtotime($start_time . "+ 1 day"));
	$sql = "select * from reward_history where date >= '" . $start_time . "' AND date < '" . $end_time . "' and username = '" . $_SESSION["phone"] . "' and reward_type = 'CARD' ";
	$query = $server->query($sql);
	$check = $query->num_rows;
	if ($check > 0) {
		$data = array('msg' => 'วันนี้คุณเปิดไพ่ไปแล้ว', 'status' => 500);
		echo json_encode($data);
		exit();
	}

	$sql = "select * from meta_setting where id = 'card' ";
	$query = $server->query($sql);
	$row = mysqli_fetch_assoc($query);

	$card = json_decode($row['value'], true);
	// print_r($card);
	// echo "<hr>";

	$all_card = array();
	for ($i = 0; $i < count($card['card_percent']); $i++) {
		for ($j = 0; $j < $card['card_percent'][$i]; $j++) {
			array_push($all_card, $i);
		}
	}
	// print_r($all_card);
	// echo "<hr>";

	$random_number = rand(0, count($all_card));
	// echo "random_number=".$random_number;
	// echo "<hr>";

	$random_card = $all_card[$random_number];
	// echo "random_card=".$random_card;
	// echo "<hr>";

	$card_name = $card['card'][$random_card];
	$card_credit = $card['card_credit'][$random_card];
	// echo "card_name=".$card_name;
	// echo "card_credit=".$card_credit;
	// echo "<hr>";

	$sql = "INSERT INTO `reward_history`(`username`, `reward_description`, `reward_type`, `credit`, `date`, `status`) 
			VALUES ('" . $_SESSION["phone"] . "','" . $card_name . "','CARD','" . $card_credit . "',now(),'1')";
	if ($server->query($sql) === TRUE) {
		include 'api_betflix.php';
		$status = json_decode($api->deposit($row_member['username_game'], $card_credit), true);
		$status = $status['status'];
		if ($status == 'success') {
			$data = array('msg' => 'สุ่มแล้ว ได้รับ ' . $card_name, 'status' => 200);
			echo json_encode($data);
			exit();
		} else {
			$data = array('msg' => 'เกิดข้อผิดพลาดที่ api กรุณาติดต่อผู้ดูแล', 'status' => 500);
			echo json_encode($data);
			exit();
		}
	} else {
		$data = array('msg' => 'เพิ่มข้อมูลการเปิดไพ่ไม่สำเร็จ กรุณาลองอีกครั้ง', 'status' => 500);
		echo json_encode($data);
		exit();
	}
}

if (isset($_GET['item_code'])) {

	$code = $_POST["code"];
	$phone = $_POST["phone"];


	$query = $server->query('SELECT * FROM `code_itme` WHERE `code`= "' . $code . '"');
	$check = $query->num_rows;
	if ($check == 0) {
		$data = array('msg' => 'ไม่พบโค้ดของคุณ', 'status' => 500);
		echo json_encode($data);
		exit();
	}


	$query = $server->query('SELECT * FROM `code_itme` WHERE `phone`= "' . $phone . '" AND`date_give`= "' . $date_check . '"');
	$check = $query->num_rows;
	if ($check >= 1) {
		$data = array('msg' => 'คุณ ไม่มีสิทธิ์ รับกิจกรรมนี้แล้ว', 'status' => 500);
		echo json_encode($data);
		exit();
	}





	$sql = "SELECT * FROM `code_itme` WHERE `code`='" . $code . "'";
	$result = $server->query($sql);
	$row = mysqli_fetch_assoc($result);
	$credit_code = $row['credit'];
	$turnover = $row['turnover'];
	$status = $row['status'];
	$id = $row['id'];
	$credit_code = str_replace(",", "", $credit_code);
	if ($status == 1) {
		$data = array('msg' => 'โค้ด ' . $code . ' ถูกใช้งานไปแล้ว', 'status' => 500);
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

		include 'api_betflix.php';


		$status = json_decode($api->deposit($row_credit['username_game'], $credit_code), true);
		$status = $status['status'];

		if ($status == 'success') {



			$token = getTokenFromDB("addcode");
			$msg = 'สมาชิก ' . $phone . ' กดรับ item code ได้รับเงิน ' . number_format($credit_code, 2) . ' บาท';
			$res = lineAlert($token, $msg);



			$data = array('msg' => 'คุณได้รับเงิน ' . number_format($credit_code, 2) . ' บาท', 'status' => 200);
			echo json_encode($data);
			exit();
		}
	}
}



if (isset($_GET['bonus_today'])) {


	if (date('H') >= 23) {
		$data = array('msg' => '23:00 ขึ้นไปทำให้เวลา ธนาคารตัดเป็นวันพรุ่งนี้ กรุณารับโบนัสหลังเที่ยงคืน', 'status' => 500);
		echo json_encode($data);
		exit();
	}


	$id = $_POST["id"];
	$phone = $_POST["phone"];
	$sql = "SELECT * FROM `promotion` WHERE `p_id`='" . $id . "'";
	$result = $server->query($sql);
	$row = mysqli_fetch_assoc($result);
	$p_name = $row['p_name'];
	$deposit = $row['p_deposit'];
	$p_credit = $row['p_credit'];
	$turnover_bonus = $row['turnover'];
	$condition_pro = $row['condition_pro'];
	$maxximum = $row['maxximum'];
	$min_deposit = $row['min_deposit'];
	$p_credit = str_replace(",", "", $p_credit);
	$deposit = str_replace(",", "", $deposit);

	$sql_credit = "SELECT * FROM member WHERE phone='" . $phone . "'";
	$result_credit = $server->query($sql_credit);
	$row_credit = mysqli_fetch_assoc($result_credit);
	$status = $row_credit['status_user'];
	$status_turnover = $row_credit['status_turnover'];
	$amount = $row_credit['credit'];

	if ($amount <= 5) {
		$data = array('msg' => 'กรุณาฝากเงินก่อน', 'status' => 500);
		echo json_encode($data);
		exit();
	}

	$sql_refill = "SELECT * FROM refill WHERE phone='" . $phone . "'  ORDER BY id DESC";
	$result_refill = $server->query($sql_refill);
	$row_refill = mysqli_fetch_assoc($result_refill);
	$id_refill = $row_refill['id'];
	$last_refil = $row_refill['amount'];
	$status_bonus = $row_refill['status_bonus'];
	$last_refil = str_replace(",", "", $last_refil);




	if ($maxximum != "") { //โปรแบบ%

		if ($condition_pro == 'รับทุกครั้งที่ฝากเงิน') {


			if ($status_bonus == 1) {
				$data = array('msg' => 'กรุณาฝากเงินก่อน', 'status' => 500);
				echo json_encode($data);
				exit();
			}

			if ($status_bonus == "") {
				$data = array('msg' => 'กรุณาฝากเงินก่อน', 'status' => 500);
				echo json_encode($data);
				exit();
			}




			if ($last_refil < $min_deposit) {
				$data = array('msg' => 'ฝากขั้นต่ำ ' . $min_deposit . ' บาท', 'status' => 500);
				echo json_encode($data);
				exit();
			}

			$balance = $deposit * $last_refil / 100;

			if ($balance >= $maxximum) {

				$balance = $maxximum;
			}

			$test = $last_refil + $balance;
			$turnover = $test * $turnover_bonus;



			preg_match('/-/', $balance, $output_array);
			$check = $output_array[0];
			if ($check == '-') {
				$data = array('msg' => 'ยอดล่าสุดของคุณติดลบ กรุณาแจ้งแอดมิน!', 'status' => 500);
				echo json_encode($data);
				exit();
			}




			include 'api_betflix.php';


			$status = json_decode($api->deposit($row_credit['username_game'], $balance), true);
			$msg = $status['msg'];

			if ($msg == 'Not enough credit.') {
				$data = array('msg' => 'เครดิตทางเว็บหมด กรุณาแจ้งแอดมิน', 'status' => 500);
				echo json_encode($data);
				exit();
			}

			$status = $status['status'];

			if ($status == 'success') {



				$sql = "UPDATE `member` SET `credit`='" . $balance . "',`status_turnover`='0',`pro_turnover`='" . $turnover . "',`status_user`='3' WHERE phone='" . $phone . "'";
				if ($server->query($sql) === TRUE) {
				}

				$sql = "INSERT INTO `history_promotion`(`id`, `date_check`, `time_check`, `phone`, `promotion`, `credit`, `turnover`, `name`, `username_game`) VALUES (null,'" . $date_check . "','" . $time_check . "','" . $phone . "','" . $deposit . "','" . $balance . "','" . $turnover . "','" . $p_name . "','" . $row_credit['username_game'] . "')";
				if ($server->query($sql) === TRUE) {
				}

				$sql = "UPDATE `refill` SET `status_bonus`='1' WHERE id='" . $id_refill . "'";
				if ($server->query($sql) === TRUE) {
				}


				$token = getTokenFromDB("bonus");
				$msg = 'สมาชิก ' . $phone . ' กดรับ รับโบนัส ของวันนี้ ได้รับเงิน ' . number_format($balance, 2) . ' บาท';
				$res = lineAlert($token, $msg);

				$data = array('msg' => 'คุณได้รับเงิน ' . $balance . ' บาท', 'status' => 200);
				echo json_encode($data);
				exit();
			}
		}




		if ($condition_pro == 'รับวันละครั้งที่ฝากเงิน') {
			$query = $server->query('SELECT * FROM history_promotion WHERE date_check = "' . $date_check . '" and phone="' . $phone . '"');
			$check = $query->num_rows;
			if ($check >= 1) {
				$data = array('msg' => 'คุณรับโบนัส ของวันนี้แล้ว!', 'status' => 500);
				echo json_encode($data);
				exit();
			}


			if ($status_bonus == 1) {
				$data = array('msg' => 'กรุณาฝากเงินก่อน', 'status' => 500);
				echo json_encode($data);
				exit();
			}

			if ($status_bonus == "") {
				$data = array('msg' => 'กรุณาฝากเงินก่อน', 'status' => 500);
				echo json_encode($data);
				exit();
			}



			$query = $server->query('SELECT * FROM refill WHERE date_check = "' . $date_check . '" and phone="' . $phone . '"');
			$check = $query->num_rows;
			if ($check < 1) {
				$data = array('msg' => 'ต้องมีรายการฝาก ของวันนี้ก่อน!', 'status' => 500);
				echo json_encode($data);
				exit();
			}





			if ($last_refil < $min_deposit) {
				$data = array('msg' => 'ฝากขั้นต่ำ ' . $min_deposit . ' บาท', 'status' => 500);
				echo json_encode($data);
				exit();
			}


			$balance = $deposit * $last_refil / 100;

			if ($balance >= $maxximum) {

				$balance = $maxximum;
			}

			$test = $last_refil + $balance;
			$turnover = $test * $turnover_bonus;



			preg_match('/-/', $balance, $output_array);
			$check = $output_array[0];
			if ($check == '-') {
				$data = array('msg' => 'ยอดล่าสุดของคุณติดลบ กรุณาแจ้งแอดมิน!', 'status' => 500);
				echo json_encode($data);
				exit();
			}



			include 'api_betflix.php';


			$status = json_decode($api->deposit($row_credit['username_game'], $balance), true);
			$msg = $status['msg'];

			if ($msg == 'Not enough credit.') {
				$data = array('msg' => 'เครดิตทางเว็บหมด กรุณาแจ้งแอดมิน', 'status' => 500);
				echo json_encode($data);
				exit();
			}

			$status = $status['status'];

			if ($status == 'success') {

				$sql1 = "UPDATE `refill` SET `status_bonus`='1' WHERE id='" . $id_refill . "'";
				if ($server->query($sql1) === TRUE) {
				}

				$sql = "UPDATE `member` SET `credit`='" . $balance . "',`status_turnover`='0',`pro_turnover`='" . $turnover . "',`status_user`='3' WHERE phone='" . $phone . "'";
				if ($server->query($sql) === TRUE) {
				}

				$sql = "INSERT INTO `history_promotion`(`id`, `date_check`, `time_check`, `phone`, `promotion`, `credit`, `turnover`, `name`, `username_game`) VALUES (null,'" . $date_check . "','" . $time_check . "','" . $phone . "','" . $deposit . "','" . $balance . "','" . $turnover . "','" . $p_name . "','" . $row_credit['username_game'] . "')";

				if ($server->query($sql) === TRUE) {
				}
				$token = getTokenFromDB("bonus");
				$msg = 'สมาชิก ' . $phone . ' กดรับ รับโบนัส ของวันนี้ ได้รับเงิน ' . number_format($balance, 2) . ' บาท';
				$res = lineAlert($token, $msg);

				$data = array('msg' => 'คุณได้รับเงิน ' . $balance . ' บาท', 'status' => 200);
				echo json_encode($data);
				exit();
			}
		}
	} else { //แบบ ตั้งเทิร์น

		if ($condition_pro == 'รับทุกครั้งที่ฝากเงิน') {


			if ($status_bonus == 1) {
				$data = array('msg' => 'กรุณาฝากเงินก่อน', 'status' => 500);
				echo json_encode($data);
				exit();
			}

			if ($status_bonus == "") {
				$data = array('msg' => 'กรุณาฝากเงินก่อน', 'status' => 500);
				echo json_encode($data);
				exit();
			}

			$deposit = str_replace(",", "", $deposit);

			$sql_credit = "SELECT * FROM member WHERE phone='" . $phone . "'";
			$result_credit = $server->query($sql_credit);
			$row_credit = mysqli_fetch_assoc($result_credit);
			$status = $row_credit['status_user'];
			$username_game = $row_credit['username_game'];

			$amount = $row_credit['credit'];
			$amount = str_replace(",", "", $amount);
			$p_credit = str_replace(",", "", $p_credit);
			$sum = $amount + $p_credit;




			if ($deposit != $last_refil) {
				$data = array('msg' => 'ยอดเงินไม่ตรงกับโปรโมชั่น ยอดเงินลูกค้า' . $last_refil . ' บาท', 'status' => 500);
				echo json_encode($data);
				exit();
			}

			include 'api_betflix.php';


			$status = json_decode($api->deposit($username_game, $p_credit), true);
			$status = $status['status'];

			if ($status == 'success') {
				$sql1 = "UPDATE `refill` SET `status_bonus`='1' WHERE id='" . $id_refill . "'";
				if ($server->query($sql1) === TRUE) {
				}
				$sql = "UPDATE `member` SET `credit`='" . $sum . "',`status_turnover`='0',`pro_turnover`='" . $turnover_bonus . "',`status_user`='3' WHERE phone='" . $phone . "'";
				if ($server->query($sql) === TRUE) {
				}

				$sql = "INSERT INTO `history_promotion`(`id`, `date_check`, `time_check`, `phone`, `promotion`, `credit`, `turnover`, `name`, `username_game`) VALUES (null,'" . $date_check . "','" . $time_check . "','" . $phone . "','" . $deposit . "','" . $p_credit . "','" . $turnover_bonus . "','" . $p_name . "','" . $username_game . "')";

				if ($server->query($sql) === TRUE) {
				}

				$token = getTokenFromDB("bonus");
				$msg = 'สมาชิก ' . $phone . ' รับโบนัสใหม่ ได้รับเงิน ' . number_format($p_credit, 2) . ' บาท';
				$res = lineAlert($token, $msg);

				$data = array('msg' => 'คุณได้รับเงิน ' . $p_credit . ' บาท', 'status' => 200);
				echo json_encode($data);
				exit();
			}
		}





		if ($condition_pro == 'รับวันละครั้งที่ฝากเงิน') {
			$query = $server->query('SELECT * FROM history_promotion WHERE date_check = "' . $date_check . '" and phone="' . $phone . '"');
			$check = $query->num_rows;
			if ($check >= 1) {
				$data = array('msg' => 'คุณรับโบนัส ของวันนี้แล้ว!', 'status' => 500);
				echo json_encode($data);
				exit();
			}

			if ($status_bonus == 1) {
				$data = array('msg' => 'กรุณาฝากเงินก่อน', 'status' => 500);
				echo json_encode($data);
				exit();
			}

			if ($status_bonus == "") {
				$data = array('msg' => 'กรุณาฝากเงินก่อน', 'status' => 500);
				echo json_encode($data);
				exit();
			}


			$deposit = str_replace(",", "", $deposit);

			$sql_credit = "SELECT * FROM member WHERE phone='" . $phone . "'";
			$result_credit = $server->query($sql_credit);
			$row_credit = mysqli_fetch_assoc($result_credit);
			$status = $row_credit['status_user'];
			$username_game = $row_credit['username_game'];

			$amount = $row_credit['credit'];
			$amount = str_replace(",", "", $amount);
			$p_credit = str_replace(",", "", $p_credit);
			$sum = $amount + $p_credit;


			if ($deposit != $last_refil) {
				$data = array('msg' => 'ยอดเงินไม่ตรงกับโปรโมชั่น ยอดเงินลูกค้า' . $last_refil . ' บาท', 'status' => 500);
				echo json_encode($data);
				exit();
			}


			include 'api_betflix.php';


			$status = json_decode($api->deposit($username_game, $p_credit), true);
			$status = $status['status'];

			if ($status == 'success') {

				$sql1 = "UPDATE `refill` SET `status_bonus`='1' WHERE id='" . $id_refill . "'";
				if ($server->query($sql1) === TRUE) {
				}

				$sql = "UPDATE `member` SET `credit`='" . $sum . "',`status_turnover`='0',`pro_turnover`='" . $turnover_bonus . "',`status_user`='3' WHERE phone='" . $phone . "'";
				if ($server->query($sql) === TRUE) {
				}

				$sql = "INSERT INTO `history_promotion`(`id`, `date_check`, `time_check`, `phone`, `promotion`, `credit`, `turnover`, `name`, `username_game`) VALUES (null,'" . $date_check . "','" . $time_check . "','" . $phone . "','" . $deposit . "','" . $p_credit . "','" . $turnover_bonus . "','" . $p_name . "','" . $username_game . "')";

				if ($server->query($sql) === TRUE) {
				}

				$token = getTokenFromDB("bonus");
				$msg = 'สมาชิก ' . $phone . ' รับโบนัสใหม่ ได้รับเงิน ' . number_format($p_credit, 2) . ' บาท';
				$res = lineAlert($token, $msg);

				$data = array('msg' => 'คุณได้รับเงิน ' . $p_credit . ' บาท', 'status' => 200);
				echo json_encode($data);
				exit();
			}
		}
	}
}




if (isset($_GET['bonus_new'])) {
	$id = $_POST["id"];
	$phone = $_POST["phone"];

	// if (date('H') >= 23) {
	// 	$data = array ('msg'=>'23:00 ขึ้นไปทำให้เวลา ธนาคารตัดเป็นวันพรุ่งนี้ กรุณารับโบนัสหลังเที่ยงคืน','status'=>500);
	// 	echo json_encode($data);
	// 	exit();
	// }

	$query = $server->query('SELECT * FROM history_promotion WHERE status_turnover="1" and phone="' . $phone . '"');
	$check = $query->num_rows;
	if ($check >= 1) {
		$data = array('msg' => 'คุณติดโปรอยู่ กรุณาเคลียร์โปรก่อนจึงจะสามารถกดรับได้', 'status' => 500);
		echo json_encode($data);
		exit();
	}

	if ($condition_pro == 'เฉพาะสมาชิกใหม่') {
		$query = $server->query('SELECT * FROM history_promotion WHERE name="โปร สมาชิกใหม่" and phone="' . $phone . '"');
		$check = $query->num_rows;
		if ($check >= 1) {
			$data = array('msg' => 'คุณรับโบนัส นี้แล้ว!', 'status' => 500);
			echo json_encode($data);
			exit();
		}
	}

	$sql = "SELECT * FROM `promotion` WHERE `p_id`='" . $id . "'";
	$result = $server->query($sql);
	$row = mysqli_fetch_assoc($result);
	$p_name = $row['p_name'];
	$deposit = $row['p_deposit'];
	$p_credit = $row['p_credit'];
	$turnover_bonus = $row['turnover'];
	$min_deposit = $row['min_deposit'];
	$condition_pro = $row['condition_pro'];
	$maxximum = $row['maxximum'];
	$p_credit = str_replace(",", "", $p_credit);
	$deposit = str_replace(",", "", $deposit);

	$sql_user = "SELECT * FROM member WHERE phone='" . $phone . "'";
	$result_user = $server->query($sql_user);
	$row_user = mysqli_fetch_assoc($result_user);
	$status = $row_user['status_user'];
	$status_turnover = $row_user['status_turnover'];
	$amount = $row_user['credit'];

	if ($amount <= 5) {
		$data = array('msg' => 'กรุณาฝากเงินก่อน', 'status' => 500);
		echo json_encode($data);
		exit();
	}


	$sql_refill = "SELECT * FROM refill WHERE phone='" . $phone . "'  ORDER BY id DESC";
	$result_refill = $server->query($sql_refill);
	$row_refill = mysqli_fetch_assoc($result_refill);
	$id_refill = $row_refill['id'];
	$last_refil = $row_refill['amount'];
	$status_bonus = $row_refill['status_bonus'];
	$last_refil = str_replace(",", "", $last_refil);


	if ($condition_pro == 'รับวันละครั้งที่ฝากเงิน') {
		if ($row_refill['date_check'] != $date_check) {
			$data = array('msg' => 'วันนี้คุณยังไม่ได้ทำการฝากเงิน กรุณาฝากเงินก่อน!', 'status' => 500);
			echo json_encode($data);
			exit();
		}

		$query = $server->query('SELECT * FROM history_promotion WHERE name="ฝากครั้งแรกของวัน" and phone="' . $phone . '" and date_check="' . $date_check . '"');
		$check = $query->num_rows;
		if ($check >= 1) {
			$data = array('msg' => 'คุณรับโบนัส นี้แล้ว!', 'status' => 500);
			echo json_encode($data);
			exit();
		}
	}


	if ($maxximum != "") { //โปรแบบ%



		if ($status_bonus == 1) {
			$data = array('msg' => 'กรุณาฝากเงินก่อน', 'status' => 500);
			echo json_encode($data);
			exit();
		}

		if ($status_bonus == "") {
			$data = array('msg' => 'กรุณาฝากเงินก่อน', 'status' => 500);
			echo json_encode($data);
			exit();
		}


		// if ($condition_pro=='เฉพาะสมาชิกใหม่') {

		if ($last_refil < $min_deposit) {
			$data = array('msg' => 'ฝากขั้นต่ำ ' . $min_deposit . ' บาท', 'status' => 500);
			echo json_encode($data);
			exit();
		}

		$balance = $deposit * $last_refil / 100;

		if ($balance >= $maxximum) {

			$balance = $maxximum;
		}


		$test = $last_refil + $balance;
		$turnover = $test * $turnover_bonus;

		// $data = array ('msg'=>'test='.$test.',last_refil='.$last_refil.',balance='.$balance.',turnover='.$turnover.',turnover_bonus='.$turnover_bonus,'status'=>500);
		// echo json_encode($data);
		// exit();

		preg_match('/-/', $balance, $output_array);
		$check = $output_array[0];
		if ($check == '-') {
			$data = array('msg' => 'ยอดล่าสุดของคุณติดลบ กรุณาแจ้งแอดมิน!', 'status' => 500);
			echo json_encode($data);
			exit();
		}

		include 'api_betflix.php';

		$status = json_decode($api->deposit($row_user['username_game'], $balance), true);
		$msg = $status['msg'];

		if ($msg == 'This user not found.') {
			$data = array('msg' => 'ไม่พบชื่อผู้ใช้ในเกมส์', 'status' => 500);
			echo json_encode($data);
			exit();
		}

		if ($msg == 'Not enough credit.') {
			$data = array('msg' => 'เครดิตทางเว็บหมด กรุณาแจ้งแอดมิน', 'status' => 500);
			echo json_encode($data);
			exit();
		}

		$status = $status['status'];

		if ($status == 'success') {



			// $sql="UPDATE `member` SET `credit`='".$balance."',`status_turnover`='0',`pro_turnover`='".$turnover."',`status_user`='3' WHERE phone='".$phone."'";
			$sql = "UPDATE `member` SET `credit`='" . ($amount + $balance) . "',`turnover`='" . $turnover . "',`turnover_struck`='" . $turnover . "' WHERE phone='" . $phone . "'";
			if ($server->query($sql) === TRUE) {
			}


			$sql1 = "UPDATE `refill` SET `status_bonus`='1' WHERE id='" . $id_refill . "'";
			if ($server->query($sql1) === TRUE) {
			}




			$sql = "INSERT INTO `history_promotion`(`id`, `date_check`, `time_check`, `phone`, `promotion`, `credit`, `turnover`, `name`, `username_game`, `status_turnover`) VALUES (null,'" . $date_check . "','" . $time_check . "','" . $phone . "','" . $deposit . "','" . $balance . "','" . $turnover . "','" . $p_name . "','" . $row_user['username_game'] . "',1)";

			// echo $sql1;
			// exit();

			if ($server->query($sql) === TRUE) {
			}

			$token = getTokenFromDB("bonus");
			$msg = 'สมาชิก ' . $phone . ' กดรับ รับโบนัส ของวันนี้ ได้รับเงิน ' . number_format($balance, 2) . ' บาท';
			$res = lineAlert($token, $msg);

			$data = array('msg' => 'คุณได้รับเงิน ' . $balance . ' บาท', 'status' => 200);
			echo json_encode($data);
			exit();
		}



		// }




	} else { //แบบ ตั้งเทิร์น



		// if ($condition_pro=='เฉพาะสมาชิกใหม่') {

		// $query = $server->query('SELECT * FROM history_promotion WHERE name="โปร สมาชิกใหม่" and phone="'.$phone.'"');
		// $check = $query->num_rows;
		// if($check >= 1){
		// 	$data = array ('msg'=>'คุณรับโบนัส นี้แล้ว!','status'=>500);
		// 	echo json_encode($data);
		// 	exit();
		// }



		$deposit = str_replace(",", "", $deposit);



		$amount = $row_user['credit'];
		$amount = str_replace(",", "", $amount);
		$p_credit = str_replace(",", "", $p_credit);
		$sum = $amount + $p_credit;

		$turnover = $sum * $turnover_bonus;

		if ($deposit != $last_refil) {
			$data = array('msg' => 'ยอดเงินไม่ตรงกับโปรโมชั่น ยอดเงินลูกค้า' . $last_refil . ' บาท', 'status' => 500);
			echo json_encode($data);
			exit();
		}



		include 'api_betflix.php';


		$status = json_decode($api->deposit($row_user['username_game'], $p_credit), true);
		$msg = $status['msg'];

		if ($msg == 'This user not found.') {
			$data = array('msg' => 'ไม่พบชื่อผู้ใช้ในเกมส์', 'status' => 500);
			echo json_encode($data);
			exit();
		}

		if ($msg == 'Not enough credit.') {
			$data = array('msg' => 'เครดิตทางเว็บหมด กรุณาแจ้งแอดมิน', 'status' => 500);
			echo json_encode($data);
			exit();
		}

		$status = $status['status'];

		if ($status == 'success') {

			$sql1 = "UPDATE `refill` SET `status_bonus`='1' WHERE id='" . $id_refill . "'";
			if ($server->query($sql1) === TRUE) {
			}

			// $sql="UPDATE `member` SET `credit`='".$sum."',`status_turnover`='0',`pro_turnover`='".$turnover_bonus."',`status_user`='3' WHERE phone='".$phone."'";
			$sql = "UPDATE `member` SET `credit`='" . $sum . "',`turnover`='" . $turnover . "',`turnover_struck`='" . $turnover . "' WHERE phone='" . $phone . "'";
			if ($server->query($sql) === TRUE) {
			}

			$sql = "INSERT INTO `history_promotion`(`id`, `date_check`, `time_check`, `phone`, `promotion`, `credit`, `turnover`, `name`, `username_game`, `status_turnover`) VALUES (null,'" . $date_check . "','" . $time_check . "','" . $phone . "','" . $deposit . "','" . $p_credit . "','" . $turnover_bonus . "','" . $p_name . "','" . $row_user['username_game'] . "',1)";

			if ($server->query($sql) === TRUE) {
			}

			$token = getTokenFromDB("bonus");
			$msg = 'สมาชิก ' . $phone . ' รับโบนัสใหม่ ได้รับเงิน ' . number_format($p_credit, 2) . ' บาท';
			$res = lineAlert($token, $msg);

			$data = array('msg' => 'คุณได้รับเงิน ' . $p_credit . ' บาท', 'status' => 200);
			echo json_encode($data);
			exit();
		}


		// }

	}
}





if (isset($_GET['chnag_pass'])) {

	$phone = $_POST["phone"];
	$confrim = mysqli_real_escape_string($server, md5($_POST["confrim"]));

	$sql = "UPDATE `member` SET `password`='" . $confrim . "' WHERE phone='" . $phone . "'";

	if ($server->query($sql) === TRUE) {

		$data = array('msg' => 'ทำรายการ สำเร็จ', 'status' => 200);
		echo json_encode($data);
		exit();
	}
}

if (isset($_GET['commission'])) {
	$phone = $_POST["phone"];
	$amount = $_POST["amount"];
	$amount = str_replace(",", "", $amount);
	$sql = "SELECT * FROM member WHERE phone='" . $phone . "'";
	$result = $server->query($sql);
	$row1 = mysqli_fetch_assoc($result);
	$balance_affliliate = str_replace(",", "", $row1['balance_affliliate']);



	if ($balance_affliliate < 1) {
		$data = array('msg' => 'ยอดเงินของคุณไม่พอ', 'status' => 500);
		echo json_encode($data);
		exit();
	}


	$query = $server->query('SELECT * FROM log_affliliate WHERE phone = "' . $phone . '" AND date_check= "' . $date_check . '"');
	$check = $query->num_rows;
	if ($check >= 1) {
		$data = array('msg' => 'คุณสามารถรับได้วันละ 1 ครั้ง', 'status' => 500);
		echo json_encode($data);
		exit();
	}


	include 'api_betflix.php';





	$status = json_decode($api->deposit($row1['username_game'], $row1['balance_affliliate']), true);
	$status = $status['status'];
	if ($status == 'success') {

		$sql = "INSERT INTO `log_affliliate`(`id`, `date_check`, `phone`, `credit`) VALUES (null,'" . $date_check . "','" . $phone . "','" . $row1['balance_affliliate'] . "')";
		if ($server->query($sql) === TRUE) {
		}

		$sql = "UPDATE `member` SET `balance_affliliate`='0' WHERE phone='" . $phone . "'";
		if ($server->query($sql) === TRUE) {
		}

		$token = getTokenFromDB("affiliate");
		$msg = 'สมาชิก ' . $phone . ' ทำรายการรับยอดแนะนำเพื่อน ได้รับเงิน ' . number_format($amount, 2) . ' บาท';
		$res = lineAlert($token, $msg);
		$data = array('msg' => 'ทำรายการ สำเร็จ', 'status' => 200);
		echo json_encode($data);
		exit();
	}
}


if (isset($_GET['refund'])) {
	$phone = $_POST["phone"];
	$amount = $_POST["amount"];
	$amount = str_replace(",", "", $amount);

	$sql = "SELECT * FROM member WHERE phone='" . $phone . "'";
	$result = $server->query($sql);
	$row1 = mysqli_fetch_assoc($result);




	$query = $server->query('SELECT * FROM history_refund WHERE phone = "' . $phone . '" AND date_check= "' . $date_check . '"');
	$check = $query->num_rows;
	if ($check >= 1) {
		$data = array('msg' => 'คุณรับยอดเสียไปแล้ววันนี้', 'status' => 500);
		echo json_encode($data);
		exit();
	}



	include 'api_betflix.php';


	$status = json_decode($api->deposit($row1['username_game'], $amount), true);

	$status = $status['status'];
	if ($status == 'success') {


		$sql = "INSERT INTO `history_refund`(`id`, `date_check`, `time_check`, `credit`, `phone`,`username_game`) VALUES (null,'" . $date_check . "','" . $time_check . "','" . $amount . "','" . $phone . "','" . $row1['username_game'] . "')";
		if ($server->query($sql) === TRUE) {
			$token = getTokenFromDB("refund");
			$msg = 'สมาชิก ' . $phone . ' ทำรายการรับยอดเสีย ได้รับเงิน ' . number_format($amount, 2) . ' บาท';
			$res = lineAlert($token, $msg);
			$data = array('msg' => 'ทำรายการ สำเร็จ', 'status' => 200);
			echo json_encode($data);
			exit();
		}
	}
}



if (isset($_GET['withdraw'])) {
	include 'api_betflix.php';


	$phone = $_POST['phone'];
	$turnover_result = $_POST['turnover_result'];
	$amount = str_replace(",", "", $_POST['amount']);




	$sql = "SELECT * FROM member WHERE phone='" . $_POST['phone'] . "'";
	$result = $server->query($sql);
	$row = mysqli_fetch_assoc($result);
	$bank_number = $row['bank_number'];
	$bank_name = $row['bank_name'];
	$username_game = $row['username_game'];
	$fname = $row['fname'];
	$turnover = $row['turnover'];

	if ($fname == "") {
		$data = array('msg' => "ไม่สามารถทำรายการได้ กรุณายืนยันบัญชี ธนาคาร", 'status' => 500);
		echo json_encode($data);
		exit();
	}

	if ((int)$turnover > 0) {
		$data = array('msg' => "ไม่สามารถทำรายการได้ คุณยังมียอดเทิร์นอยู่อีก " . $turnover . " บาท", 'status' => 500);
		echo json_encode($data);
		exit();
	}




	$data = json_decode($api->get_balance($row['username_game']), true);
	$credit = $data['data']['balance'];
	$credit = str_replace(",", "", $credit);


	$query = $server->query('SELECT * FROM withdraw WHERE  phone= "' . $phone . '" AND status=1');

	$check = $query->num_rows;
	if ($check >= 1) {
		$data = array('msg' => "คุณมีรายการถอนเงิน ค้างอยู่", 'status' => 500);
		echo json_encode($data);
		exit();
	}

	if ($amount > $credit) {
		$data = array('msg' => "ยอดเงินของคุณไม่พอ มีอยู่ " . number_format($credit, 2), 'status' => 500);
		echo json_encode($data);
		exit();
	}

	if ($amount != $credit) {
		$data = array('msg' => "กรุณาถอนเงินที่มีอยู่ทั้งหมด " . number_format($credit, 2), 'status' => 500);
		echo json_encode($data);
		exit();
	}

	if ($credit < 1) {
		$data = array('msg' => 'คุณไม่เหลือเงินในบัญชี', 'status' => 500);
		echo json_encode($data);
		exit();
	}



	$status = json_decode($api->withdraw($row['username_game'], $amount), true);
	$status = $status['status'];
	if ($status == 'success') {

		$sql_withdraw = "INSERT INTO `withdraw`(id, `phone`,time_withdraw,date_withdraw,credit,bank_number,bank_name,username_game) VALUES (null,'" . $_POST['phone'] . "','" . $time_check . "','" . $date_check . "','" . $amount . "','" . $bank_number . "','" . $row['bank_name'] . "','" . $username_game . "')";
		if ($server->query($sql_withdraw) === TRUE) {

			$token = getTokenFromDB("withdraw");
			// $msg = 'สมาชิก '.$phone.' ทำรายการถอนเงิน ได้รับเงิน '.number_format($amount,2).' บาท';
			$msg = "\nสมาชิกชื่อ: " . $fname . "\nเบอร์: " . $phone . "\nทำรายการถอนเงิน ได้รับเงิน " . number_format($amount, 2) . " บาท";

			$res = lineAlert($token, $msg);

			$data = array('msg' => "ทำรายการ สำเร็จ!", 'status' => 200);
			echo json_encode($data);

			$sum = $credit - $amount;



			$sql = "UPDATE `member` SET `credit`='" . $sum . "',`status_user`='3',`status_turnover`='1' WHERE phone='" . $_POST['phone'] . "'";
			if ($server->query($sql) === TRUE) {
			}

			$sql = "UPDATE `history_promotion` SET `status_turnover`='0' WHERE phone='" . $_POST['phone'] . "'";
			if ($server->query($sql) === TRUE) {
			}

			exit();
		}
	} else {
		$data = array('msg' => "ทำรายการ ไม่สำเร็จ!", 'status' => 500);
		echo json_encode($data);
	}
}
