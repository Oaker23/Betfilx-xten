<?php

session_start();

if($_SESSION["phone"] == "") {

   header( "location: ./login" );

}



$host = "localhost";
$user = "betflixff_betflik"; //db user
$pass = "g8reZ0TipJ"; //db pass
$db = "betflixff_betflik"; //db





$server = mysqli_connect($host,$user,$pass,$db);

if(!$server){

   die("&#1072;&#8470;&#1026;&#1072;&#1105;&#1033;&#1072;&#1105;·&#1072;&#8470;€&#1072;&#1105;­&#1072;&#1105;&#1038;&#1072;&#1105;•&#1072;&#8470;€&#1072;&#1105;­&#1072;&#1105;&#1106;&#1072;&#1105;&#1030;&#1072;&#1105;™&#1072;&#1105;‚&#1072;&#8470;‰&#1072;&#1105;­&#1072;&#1105;&#1038;&#1072;&#1105;&#8470;&#1072;&#1105;&#1168;&#1072;&#8470;„&#1072;&#1105;&#1038;&#1072;&#8470;€&#1072;&#1105;&#1028;&#1072;&#1105;&#1110;&#1072;&#8470;&#1026;&#1072;&#1105;&#1032;&#1072;&#8470;‡&#1072;&#1105;€!" .mysqli_connect_error());

}

mysqli_set_charset($server,"utf8");



date_default_timezone_set("Asia/Bangkok");



include 'api_betflix.php';



$sql = "SELECT * FROM member WHERE phone='".$_SESSION["phone"]."'";

$result = $server->query($sql);

$row = mysqli_fetch_assoc($result);





$_POST = json_decode(file_get_contents('php://input'), true);



if(isset($_POST["provider"]) && $_POST["gamecode"]) {

    $api = new imi($agent,$key_betflix);







    preg_match('/jili|km|aws/', $_POST["gamecode"], $output_array);

    $status=count($output_array[0]);





    if ($status==1) {

        $gamecode = strtoupper($_POST["gamecode"]);

    }else{

     $gamecode = $_POST["gamecode"];

 }





 $provider = strtolower($_POST["provider"]);



if ($_POST["provider"]!='gamatron') {

 preg_match('/1x2|hak|bpg|bng|hab|kgl|rlx|ygg|red|qs|ids|tk|mav|ds|nlc|ga|png|pug|fng|nge/', $_POST["provider"], $output_array1);

 $check=count($output_array1[0]);

 if ($check==1) {

    $provider='qtech';

    preg_match('/-.+/', $gamecode, $output_array_gamecode);

    preg_match('/.*?(?=\-)/', $gamecode, $output_array_gamecode1);

    $gamecode=strtoupper($output_array_gamecode1[0]).$output_array_gamecode[0];

}



}



if ($output_array1[0]=='1x2') {

   $gamecode=strtolower($gamecode);

}



if ($_POST["provider"]=='fc') {

   $gamecode=strtoupper($gamecode);

}









$play=$api->play($row['username_game'], $provider, $gamecode,'thai','true',urlencode(""));

$play = json_decode($play,true);

echo json_encode($play);

} else {

    echo array("status" => "failed");

}



mysqli_close($server);



?>



