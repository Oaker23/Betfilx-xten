<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

function RequestAPI($fileName, $url = "https://betflik.com/games/")  {
    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => $url.$fileName,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_TIMEOUT=> 10,
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
    ));

    $response = curl_exec($curl);
    curl_close($curl);
    return  $response;
}

       /// all extension .txt
$GameCode = [
    "aws", "swg", "kg", "jl", "km", "fc", "funky", 
    "mg", "gamatron", "ep", "pp", "netent", "joker",
    "bpg", "bng", "hab", "kgl", "rlx", "ygg", "red", "qs", "ids", "tk", "mav",
    "ds", "nlc", "ga", "png", "pug", "fng", "nge", "1x2", "hak"
];

$gameList = "";
if(isset($_GET["gameList"])) {
    $gameList = $_GET["gameList"];
    
    if($gameList == "all") {
       $ListOfGame = json_decode(RequestAPI("list.txt"), true);

        $ListGame = array(
            "GameCode" => $GameCode,
            "List" => $ListOfGame
        );
    } else {
        $ListGame = array();
    }
    echo json_encode($ListGame);
}

$requestGame = "";
if(isset($_GET["requestGame"])) {
    $requestGame = $_GET["requestGame"];
    $getGameCode = false;
    foreach ($GameCode as $Gkey => $Gvalue) {
        if($Gvalue == $requestGame) $getGameCode = true;
    }

    $linkRequest = $requestGame;
    if($getGameCode == true) {
        $linkRequest = RequestAPI("{$requestGame}.txt");
    }

    echo json_encode(
        array(
            "listGame" => $getGameCode,
            "list" => $getGameCode == true ? json_decode($linkRequest, true): $requestGame 
            // "list" => $requestGame
        )
    );
}


// $_POST = json_decode(file_get_contents('php://input'), true);
?>