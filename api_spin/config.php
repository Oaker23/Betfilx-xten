<?php
date_default_timezone_set("Asia/Bangkok");
$date_check=date("d/m/Y");
$time_check=date("h:i");


$host = "localhost"; /* Host name */
$user = "betflixff_betflik"; /* User */
$password = "g8reZ0TipJ"; /* Password */
$dbname = "betflixff_betflik"; /* Database name */


$server = mysqli_connect($host, $user, $password,$dbname);
mysqli_set_charset($server,"utf8");
// Check connection
if (!$server) {
 die("Connection failed: " . mysqli_connect_error());
}