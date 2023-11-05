
<?php
error_reporting(0);
$host = "localhost";
$user = "root"; //db user
$pass = ""; //db pass
$db = "betflixff_betflik"; //db


$server = mysqli_connect($host,$user,$pass,$db);
if(!$server){
	die("เชื่อมต่อฐานข้อมูลไม่สำเร็จ!" .mysqli_connect_error());  
} 
mysqli_set_charset($server,"utf8");

date_default_timezone_set("Asia/Bangkok");
// $date_now=date("d/m/Y");

$sql_website = "SELECT * FROM `website`";
$result_website = $server->query($sql_website);
$row_website = mysqli_fetch_assoc($result_website);
$agent_config = $row_website['agent_username'];

?>

