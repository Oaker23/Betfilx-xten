<?php
error_reporting(0);
if (!isset($_SESSION)) {
  session_start();
}
include "config/config_data.php";
require 'config/config.php';

if($_SESSION["phone"] == "") {
  echo " <script> window.location = './login';</script>";
}




$sql = "SELECT * FROM member WHERE phone='".$_SESSION["phone"]."'";

$result = $server->query($sql);
$row = mysqli_fetch_assoc($result);


// $sql = "UPDATE `member` SET `status_deposit`='0'  WHERE phone='" . $_SESSION["phone"] . "'";
// if ($server->query($sql) === TRUE) {}



$sql_website = "SELECT * FROM website";
$result_website = $server->query($sql_website);
$row_website = mysqli_fetch_assoc($result_website);





$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://api.bfx.fail/v4/play/login',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS => 'username='.$agent.$_GET['username_game'],
  CURLOPT_HTTPHEADER =>$key_betflix,
));

$response = curl_exec($curl);
curl_close($curl);
$data = json_decode($response,true);



$login_token=$data['data']['login_token'];
 
echo " <script> window.location = 'https://www.betflik.com/login/apilogin/".trim($login_token)."';</script>";


exit(0);


?>