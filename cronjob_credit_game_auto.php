<?php
error_reporting(0);
require 'config/config.php';
include_once "config/config_data.php";
include 'api_betflix.php';

// เพิ่มเครดิตให้ยูสเมื่อยูสเล่นจนมีเครดิตน้อยกว่า 5 ทำงานทุก 10.00 และ 17.00 วันละ 1 ครั้ง โดยจะได้เครดิตตามยอดเล่นเสียในวันนั้น คำนวนกับเปอร์เซ็นที่ตั้งค่าได้จากหลังบ้าน

$dateAdd1Day = strtotime("+1 day");
$datenow = date('Y-m-d');
$dateto = date('Y-m-d',$dateAdd1Day);
$game_percen = $row_website['game_percen'];

// echo "game_percen=".$game_percen;echo "<br>";
// echo "datenow=".$datenow;echo "<br>";
// echo "dateto=".$dateto;echo "<br>";

//mock
// $datenow = "2022-07-20";
// $dateto = "2022-07-21";

$sql_member = "SELECT DISTINCT username_game
			   FROM `member` a 
			   LEFT JOIN `report_game` b on (b.username = CONCAT('".$agent_config."',a.username_game))
			   WHERE a.credit < 5 AND b.created_at > '".$datenow."' AND b.created_at < '".$dateto."'
			   ";
echo $sql_member;echo "<br>";

$result_member = $server->query($sql_member);
while($row_member = mysqli_fetch_assoc($result_member)) {
	$username_game = $agent_config.$row_member["username_game"];
	echo "username_game=".$username_game;echo "<br>";

	$sql_allnegative = "SELECT SUM(winloss) as allnegative FROM `report_game` where username ='" . $username_game . "' and winloss < 0 AND created_at > '".$datenow."' AND created_at < '".$dateto."'";
	// echo "sql_allnegative=".$sql_allnegative;echo "<br>";
	$result_allnegative = $server->query($sql_allnegative);
	$row_allnegative = mysqli_fetch_assoc($result_allnegative);
	$allnegative = $row_allnegative["allnegative"];
	echo "allnegative1=".$allnegative;echo "<br>";

	$allnegative = str_replace("-", "",	$allnegative);
	$allnegative = str_replace(",", "",	$allnegative);
	echo "allnegative2=".$allnegative;echo "<br>";
	$game_percen = str_replace("-", "",	$game_percen);
	echo "game_percen=".$game_percen;echo "<br>";

	$add_credit = $allnegative * $game_percen / 100;
	echo "add_credit=".$add_credit;echo "<br>";
	$add_credit = ceil($add_credit);
	echo "add_credit=".$add_credit;echo "<br>";

	//mock
	// $datenow = "2022-07-21";
	// $dateto = "2022-07-22";

	//เช็คเงื่อนไขวันละ 1 ครั้ง
	$sql_log_game_auto = "SELECT * FROM `log_game_auto` WHERE create_date > '".$datenow."' AND create_date < '".$dateto."' ";
	// echo $sql_log_game_auto;echo "<br>";   
	$result_log_game_auto = $server->query($sql_log_game_auto);
	$query = $server->query($sql);
	$check = $result_log_game_auto->num_rows;
	if ($check == 0) { 
		echo "log_game_auto add=";echo "<br>";

		$sql = "SELECT * FROM `member` where username_game='" . $row_member["username_game"] . "'";
		$result = $server->query($sql);
		$row = mysqli_fetch_assoc($result);
		$credit_user = $row['credit'];
		$phone = $row['phone'];
		$point_user = $row['point'];
		$fname = $row['fname'];
		$date_check = date("Y-m-d");
		$time_check = date('H:i:s');

		$sum = $credit_user + $add_credit;

		$sql = "INSERT INTO `refill`(`id`, `date_check`, `time_check`, `amount`, `buyerBank`, `phone`, `info`, `status`, `username_game`) 
		VALUES (null,'" . $date_check . "','" . $time_check . "','" . $add_credit . "','คืนยอดเสียออโต้','" . $phone . "','GAME AUTO','1','" . $row['username_game'] . "')";

		$status = json_decode($api->deposit($row['username_game'], $add_credit), true);
		if ($status['msg'] == 'Not enough credit.') {
			echo "Not enough credit";echo "<br>";
			exit();
		}
		echo "<br>";
		print_r($status);
		echo "<br>";
		$status = $status['status'];
		if ($status == 'success') {
			if ($server->query($sql) === TRUE) {
				// $data = array('msg' => "ทำรายการ สำเร็จ!", 'status' => 200);
				// echo json_encode($data);
				echo "success!";echo "<br>";
				$sql = "UPDATE `member` SET `credit`='" . $sum . "' WHERE phone='" . $phone . "'";
				if ($server->query($sql) === TRUE) {
					echo "member update success=";echo "<br>";
				}

				$sql = "INSERT INTO `log_game_auto`(username, allnegative, game_percen, add_credit, create_date) 
						VALUES ('".$username_game."','".$allnegative."','".$game_percen."','".$add_credit."',NOW())";
				if ($server->query($sql) === TRUE) {
					echo "log_game_auto add success=";echo "<br>";
				}
				exit(); // ต้องหยุดการทำงานไว้ถ้าทำไวเกินข้อมูลจะเบิ้ล
			}
		} else {
			echo "Not success!";echo "<br>";
			exit();
		}
	}else{
		echo "received 1 time =".$username_game;echo "<br>";
	}
}
exit();

?>