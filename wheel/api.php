<?php
include 'db.php';
$username = $_SESSION["phone"];
// $username = 'poomttc';
// ดึงข้อมูลผู้ใช้ 
$user = $server->prepare("SELECT * FROM member WHERE phone = ?");
$user->execute(array($username));
$user = $user->fetch(PDO::FETCH_ASSOC);
// print_r($user);

$wheel['bet'] = 20; // จำนวนพ้อยที่หักตอนกดเล่น
$wheel['center'] = ''; // รูปไอค่อนกลางวงล้อ
// ไม่ได้รับรางวัล
$wheel['unlucky']['image'] = 'img/none.png'; 
$wheel['unlucky']['percent'] = '0'; 



// ของชิ้นที่ 1
$wheel['item'][1]['name'] = 'พ้อยท์ 20'; 
$wheel['item'][1]['point'] = '20'; 
$wheel['item'][1]['image'] = 'img/credit.png'; 
$wheel['item'][1]['percent'] = '100';
// ของชิ้นที่ 2
$wheel['item'][2]['name'] = 'พ้อยท์ 50'; 
$wheel['item'][2]['point'] = '50'; 
$wheel['item'][2]['image'] = 'img/credit.png'; 
$wheel['item'][2]['percent'] = '0'; 
// ของชิ้นที่ 3
$wheel['item'][4]['name'] = 'พ้อยท์ 150'; 
$wheel['item'][4]['point'] = '150'; 
$wheel['item'][4]['image'] = 'img/credit.png';
$wheel['item'][4]['percent'] = '0';
// ของชิ้นที่ 4
$wheel['item'][5]['name'] = 'พ้อยท์ 300';
$wheel['item'][5]['point'] = '300';
$wheel['item'][5]['image'] = 'img/credit.png';
$wheel['item'][5]['percent'] = '0';




    function Win($number)
    {
        $data['selector'] = 'id';
        $data['winner'] = strval($number);
        $data['nonce'] = $_REQUEST['nonce'];
        $data['lose'] = false;
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

if(isset($_POST['nonce'])){
	header('Content-Type: text/json');

    if(empty($user))
    {
        echo json_encode([
            'status' => false,
            'type' => 'login'
        ]);
        exit();
    }

    if($user['credit'] < $wheel['bet'])
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
            $wheel['item'][1],$wheel['item'][2],$wheel['item'][4],$wheel['item'][5]
        ];
        $chance = [
            $wheel['item'][1]['percent'],$wheel['item'][2]['percent'],$wheel['item'][4]['percent'],$wheel['item'][5]['percent']
        ];
        $win = Random($items, $chance);
        $k = array_search($win,$wheel['item']);
        
        echo Win($k);
        
        $credit = $wheel['item'][$k]['credit'];
        // รันในส่วน Query แอดเครดิต
        // query("UPDATE testMember SET point = point + ? WHERE username = ?",array($point,$user['username']));
        $updatePoint = $server->prepare("UPDATE member SET credit = credit + $credit WHERE phone = ?");
        $updatePoint->execute([$user['phone']]);

    }else{
        $miss = ['0','3'];
        $lose = $miss[array_rand($miss)];
        echo Lose($lose);
    }
    // หักเครดิต
        $updateP = $server->prepare("UPDATE member SET credit = credit - $credit WHERE phone = ?");
        $updateP->execute([$user['phone']]);
        exit();

}
