<?php
error_reporting(0);

// if (!isset($_SESSION)) {
//     session_start();
// }
// if($_SESSION["phone"]== "") {
//     header( "location: login.php" );
// }
// include 'db.php';
// include("config/config.php");
// include("api_betflix.php");
$username = $_SESSION["phone"];
$sqlUser = "SELECT * FROM member WHERE phone='".$username."'";

$resultUser = $server->query($sqlUser);
$user = mysqli_fetch_assoc($resultUser);

$sqlWheel = "SELECT * FROM config_wheel ";
$resulWheel = $server->query($sqlWheel);
$arrWheel = array();
while($rowWheel = mysqli_fetch_assoc($resulWheel)) {
    // print_r($rowWheel);
    $arrWheel[] = $rowWheel;
}


date_default_timezone_set("Asia/Bangkok");
$date_check=date("d/m/Y");
$time_check=date("H:s:i");
// $username = 'poomttc';
// ดึงข้อมูลผู้ใช้ 
// $user = $server->prepare("SELECT * FROM member WHERE phone = ?");
// $user->execute(array($username));
// $user = $user->fetch(PDO::FETCH_ASSOC);
// print_r($arrWheel[0]['percent']);


$wheel['bet'] = $arrWheel[5]['point']; // จำนวนพ้อยที่หักตอนกดเล่น
$wheel['center'] = ''; // รูปไอค่อนกลางวงล้อ
// ไม่ได้รับรางวัล
$wheel['unlucky']['image'] = 'wheel/img/none_v2.png'; 
$wheel['unlucky']['percent'] = $arrWheel[0]['percent']; 

// print_r($arrWheel);

// ของชิ้นที่ 1
$wheel['item'][1]['name'] = $arrWheel[1]['type']; 
$wheel['item'][1]['point'] = $arrWheel[1]['point']; 
$wheel['item'][1]['image'] = 'wheel/img/credit_v2.png'; 
$wheel['item'][1]['percent'] = $arrWheel[1]['percent'];
// ของชิ้นที่ 2
$wheel['item'][2]['name'] = $arrWheel[2]['type']; 
$wheel['item'][2]['point'] = $arrWheel[2]['point']; 
$wheel['item'][2]['image'] = 'wheel/img/credit_v2.png'; 
$wheel['item'][2]['percent'] = $arrWheel[2]['percent']; 
// ของชิ้นที่ 3
$wheel['item'][4]['name'] = $arrWheel[3]['type']; 
$wheel['item'][4]['point'] = $arrWheel[3]['point']; 
$wheel['item'][4]['image'] = 'wheel/img/credit_v2.png';
$wheel['item'][4]['percent'] = $arrWheel[3]['percent'];
// ของชิ้นที่ 4
$wheel['item'][5]['name'] = $arrWheel[4]['type'];
$wheel['item'][5]['point'] = $arrWheel[4]['point'];
$wheel['item'][5]['image'] = 'wheel/img/credit_v2.png';
$wheel['item'][5]['percent'] = $arrWheel[4]['percent'];




    function Win($number,$message="")
    {
        $data['selector'] = 'id';
        $data['winner'] = strval($number);
        $data['nonce'] = $_REQUEST['nonce'];
        $data['lose'] = false;
        $data['message'] = $message;
        return json_encode($data);
    }

    function Lose($number)
    {
        $data['selector'] = 'id';
        $data['winner'] = $number;
        $data['nonce'] = $_REQUEST['nonce'];
        $data['lose'] = true;
        return json_encode($data);
    }

    function Logs($item, $s)
    {

    }

    function Random($item, $change)
    {
        if (count($item) != count($change)) {
            return null;
        }

        $sum = array_sum($change) * 100;
        $rand = mt_rand(1, $sum);

        foreach ($change as $i => $w) {
            $change[$i] = $w * 100 + ($i > 0 ? $change[$i - 1] : 0);
            if ($rand <= $change[$i]) {return $item[$i];}
        }
    }

    function GetResult($items)
    {
        $miss = [];
        $chance = [];
        $win = [];
        $main = [];

        foreach ($items as $key => $value) {
            if ($value->method == "miss") {
                array_push($miss, $key);
            } else {
                array_push($chance, $value->percent);
                array_push($win, $key);
            }
        }

        $rand = mt_rand(1, 10000) / 150;

        if ($rand >= (100 - $items['percent'])) {
            //$rand_items = mt_rand(0, 10000) / 100;
            $win = Random($win, $chance);
            
            return Win($win);
        } else {
            $lose = $miss[array_rand($miss)];
            return Lose($lose);
        }
    }

    function insertHistory($username_game_only, $date_check_now, $time_check_now, $phone, $bet, $credit, $status,$server)
    {
        // require_once("../config/config.php");
        $sql_history_wheel="INSERT INTO `history_wheel`(`date_check`, `time_check`, `phone`, `bet`, `credit`, `status`, `username_game`) VALUES ('".$date_check_now."','".$time_check_now."','".$phone."', '".$bet."','".$credit."','".$status."','".$username_game_only."')";
        // echo "sql history_wheel===".$sql;
        $server->query($sql_history_wheel);
    }

if(isset($_POST['nonce'])){
    include("api_betflix.php");
	header('Content-Type: text/json');



    if(empty($user))
    {
        echo json_encode([
            'status' => false,
            'type' => 'login'
        ]);
        exit();
    }

    if($user['point'] < $wheel['bet'])
		{
            echo json_encode([
                'status' => false,
                'type' => 'credit'
            ]);
			exit();
		}
	
    $rand = mt_rand(1, 10000) / 150;

    if ($rand >= $wheel['unlucky']['percent']) {
        

        $items = [
            $wheel['item'][1],$wheel['item'][2],$wheel['item'][4],$wheel['item'][5],$wheel['unlucky']
        ];
        $chance = [
            $wheel['item'][1]['percent'],$wheel['item'][2]['percent'],$wheel['item'][4]['percent'],$wheel['item'][5]['percent'],$wheel['unlucky']['percent']
        ];
        $win = Random($items, $chance);
        $k = array_search($win,$wheel['item']);
        
        echo Win($k,$wheel['item'][$k]['name']);
        // exit();
        
        $credit = $wheel['item'][$k]['point'];
        // echo "credit===".$credit;
        // print_r($credit);
        // var_dump($credit);
        // รันในส่วน Query แอดเครดิต
        // query("UPDATE testMember SET point = point + ? WHERE username = ?",array($point,$user['username']));
        // $updatePoint = $server->prepare("UPDATE member SET credit = credit + $credit WHERE phone = ?");
        // $updatePoint->execute([$user['phone']]);

        $sqlUser = "SELECT * FROM member WHERE phone='".$username."'";
        $resultUser = $server->query($sqlUser);
        $user = mysqli_fetch_assoc($resultUser);

        $userPhone = $user['phone'];
        $sumCredit = $user['credit'] + $credit;
        $username_game_only = $user['username_game'];
        $sql = "UPDATE `member` SET `credit`= '".$sumCredit."' WHERE phone='".$userPhone."'";
        // echo "sql===".$sql;
        $server->query($sql);
        $bet = $wheel['bet'];
        $status = json_decode($api->deposit($username_game_only,$credit),true);
	    $status=$status['status'];
        if ($status == 'success') {
            insertHistory($username_game_only, $date_check, $time_check, $userPhone, $bet, $credit, "ได้รางวัล",$server);
        }




    }else{
        $miss = ['0','3'];
        $lose = $miss[array_rand($miss)];
        echo Lose($lose);
        $userPhone = $user['phone'];
        $bet = $wheel['bet'];
        // $status = json_decode($api->deposit($user['username_game'],$credit),true);
        $username_game_only = $user['username_game'];
        insertHistory($username_game_only, $date_check, $time_check, $userPhone, $bet, 0, "ไม่ได้รางวัล",$server);
    }
    // หักเครดิต
        // $updateP = $server->prepare("UPDATE member SET credit = credit - $credit WHERE phone = ?");
        // $updateP->execute([$user['phone']]);

        // $status = json_decode($api->withdraw($user['username_game'],$wheel['bet']),true);
        // $status=$status['status'];
        // if ($status=='success') {
        //     $sqlUser = "SELECT * FROM member WHERE phone='".$username."'";
        //     $resultUser = $server->query($sqlUser);
        //     $user = mysqli_fetch_assoc($resultUser);
    
        //     $userPhone = $user['phone'];
        //     $sumbet = $user['credit'] - $wheel['bet'];
        //     $sqlbet = "UPDATE `member` SET `credit`= '".$sumbet."' WHERE phone='".$userPhone."'";
        //     $server->query($sqlbet);
        // }
        $sqlUser = "SELECT * FROM member WHERE phone='".$username."'";
        $resultUser = $server->query($sqlUser);
        $user = mysqli_fetch_assoc($resultUser);

        $userPhone = $user['phone'];
        $sumbet = $user['point'] - $wheel['bet'];
        $sqlbet = "UPDATE `member` SET `point`= '".$sumbet."' WHERE phone='".$userPhone."'";
        $server->query($sqlbet);
        exit();

}
