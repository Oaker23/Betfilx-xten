<?php
require '../config/config.php';
$sql = "SELECT * FROM `notify` where id=10";
$result = $server->query($sql);
$row = mysqli_fetch_assoc($result);
date_default_timezone_set("Asia/Bangkok");


 $date=date('Y-m-d');


$GLOBALS["report"]=trim($row['token']);

class LineNotify
{
    public function __construct($sToken)
    {
        $this->sToken = $sToken;
    }

    public function SendMessage($msg = "\nTest")
    {
        $chOne = curl_init();
        curl_setopt($chOne, CURLOPT_URL, "https://notify-api.line.me/api/notify");
        curl_setopt($chOne, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($chOne, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($chOne, CURLOPT_POST, 1);
        curl_setopt($chOne, CURLOPT_POSTFIELDS, "message=" . $msg);
        $headers = array('Content-type: application/x-www-form-urlencoded', 'Authorization: Bearer ' . $this->sToken . '',);
        curl_setopt($chOne, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($chOne, CURLOPT_RETURNTRANSFER, 1);
        $result = curl_exec($chOne);
        //Result error 
        if (curl_error($chOne)) {
            return curl_error($chOne);
        } else {
            $result_ = json_decode($result, true);
            return $result_;
        }
        curl_close($chOne);
    }
}


$sql_membertoday="SELECT COUNT(*) AS total__membertoday FROM member WHERE `date_check`='".$date."' and username_game!=''";
$result_membertoday = $server->query($sql_membertoday);
$row_membertoday = mysqli_fetch_assoc($result_membertoday);
$total__membertoday=$row_membertoday['total__membertoday'];


//  //สมาขิกวันนี้


$sql_sum1 = "SELECT SUM(amount) as total_all FROM refill WHERE amount>0 and phone!=''  and `date_check`='".$date."'";
$result_sum1 = $server->query($sql_sum1);
$row__sum1 = mysqli_fetch_assoc($result_sum1);
$total_all=$row__sum1['total_all']; 




// //ยอดฝาก


$sql_sum6 = "SELECT SUM(credit) as total_all FROM withdraw where status=0  and `date_withdraw`='".$date."'";
$result_sum6 = $server->query($sql_sum6);
$row__sum6 = mysqli_fetch_assoc($result_sum6);
$total_all_withdraw=$row__sum6['total_all']; 

// //ยอดถอนวันนี้


$sql_promotion = "SELECT COUNT(DISTINCT phone) total_bonus_new FROM history_promotion WHERE `name`='โปร สมาชิกใหม่' and `date_check`='".$date."'";
$result_promotion = $server->query($sql_promotion);
$row__promotion = mysqli_fetch_assoc($result_promotion);
$total_promotion=$row__promotion['total_bonus_new'];


// //ยอดรับโปรสมาชิกให่วันนี้

$sql_promotion1 = "SELECT COUNT(DISTINCT phone) total_bonus_today FROM history_promotion WHERE `name`='ฝากครั้งแรกของวัน' and `date_check`='".$date."'";
$result_promotion1 = $server->query($sql_promotion1);
$row__promotion1 = mysqli_fetch_assoc($result_promotion1);
$total_promotion1=$row__promotion1['total_bonus_today'];



// //ฝากครั้งแรกของวัน


$sql_promotion2 = "SELECT SUM(credit) as sum_bonus FROM history_promotion WHERE `date_check`='".$date."'";
$result_promotion2 = $server->query($sql_promotion2);
$row__promotion2 = mysqli_fetch_assoc($result_promotion2);
$total_promotion2=$row__promotion2['sum_bonus'];

// //เครดิตโบนัส รวม

$sql_promotion3 = "SELECT SUM(credit) as sum_bonus_new FROM history_promotion WHERE `name`='โปร สมาชิกใหม่' and `date_check`='".$date."'";
$result_promotion3 = $server->query($sql_promotion3);
$row__promotion3 = mysqli_fetch_assoc($result_promotion3);
$sum_bonus_new=$row__promotion3['sum_bonus_new'];

$sql_promotion4 = "SELECT SUM(credit) as sum_bonus_today FROM history_promotion WHERE `name`='ฝากครั้งแรกของวัน' and `date_check`='".$date."'";
$result_promotion4 = $server->query($sql_promotion4);
$row__promotion4 = mysqli_fetch_assoc($result_promotion4);
$sum_bonus_today=$row__promotion4['sum_bonus_today'];

$sql_code="SELECT COUNT(DISTINCT phone) total_code FROM code_itme WHERE  `phone`!=''  and `date_give`='".$date."'";
$result_code = $server->query($sql_code);
$row_code = mysqli_fetch_assoc($result_code);
$total_code=$row_code['total_code'];



$sql_sum_code = "SELECT SUM(credit) as sum_code FROM code_itme WHERE phone!=''  and `date_give`='".$date."'";
$result_sum_code = $server->query($sql_sum_code);
$row__sum_code = mysqli_fetch_assoc($result_sum_code);
$sum_code=$row__sum_code['sum_code'];



$free_total= $total_promotion+$sum_code;

$profit=$total_all-$total_all_withdraw-$free_total;


$sql_member="SELECT COUNT(DISTINCT phone) total_member_deposit  FROM refill where date_check='".$date."'";
$result_member = $server->query($sql_member);
$row_member = mysqli_fetch_assoc($result_member);
$total_member_deposit=$row_member['total_member_deposit'];

$sql_member0="SELECT COUNT(*) as total_withdraw_list FROM withdraw WHERE date_withdraw='".$date."'";
$result_member0 = $server->query($sql_member0);
$row_member0 = mysqli_fetch_assoc($result_member0);
$total_member_deposit0=$row_member0['total_withdraw_list'];




$sql_member7="SELECT COUNT(*) as total_deposit_list FROM refill WHERE date_check='".$date."'";
$result_member7 = $server->query($sql_member7);
$row_member7 = mysqli_fetch_assoc($result_member7);
$total_member_deposit7=$row_member7['total_deposit_list'];

$sql_member8="SELECT SUM(credit) as refund FROM history_refund WHERE date_check='".$date."'";
$result_member8 = $server->query($sql_member8);
$row_member8 = mysqli_fetch_assoc($result_member8);
$total_member_deposit8=$row_member8['refund'];



$sql_member15="SELECT SUM(credit) as commission FROM log_affliliate WHERE date_check='".$date."'";
$result_member15 = $server->query($sql_member15);
$row_member15 = mysqli_fetch_assoc($result_member15);
$total_member_deposit15=$row_member15['commission'];

if ($total_member_deposit15=="") {
   $total_member_deposit15=0;
}


// while (true) {
// $status = json_decode($api->balance(),true);
//     if ($status['result']!="") {

// $Line = new LineNotify($GLOBALS["report"]);
// $send = $Line->SendMessage(" QBA\n -----------------------\n ฝากวันนี้ : " . number_format($total_all, 2) . 
//     "\n ถอนวันนี้ : " . number_format($total_all_withdraw, 2) . 
//     "\n กำไร/ขาดทุน : " . $profit . 
//     "\n -----------------------\n ฝากวันนี้ : " . $total_member_deposit7 . 
//     " ครั้ง \n ถอนวันนี้ : " . $total_member_deposit0 . 
//     " ครั้ง\n -----------------------\n สมัครวันนี้ : " . $total__membertoday . 
//     "\n จำนวนยูสฝากเงินวันนี้ : " . $total_member_deposit . 
//     "\n -----------------------\n คืนยอดเสีย : " . number_format($total_member_deposit8,2) . 
//     "\n แนะนำเพื่อน : " . number_format($total_member_deposit15,2) . "\n -----------------------\n ยอดเงิน SCB : " .number_format($status['result'],2). 
//     " บาท\n -----------------------\n เวลา : " . date("d/m/Y H:i:s") . "");
// print_r($send);

// break;
//     }
    
// }


$Line = new LineNotify($GLOBALS["report"]);
$send = $Line->SendMessage(" QBA\n -----------------------\n ฝากวันนี้ : " . number_format($total_all, 2) . 
    "\n ถอนวันนี้ : " . number_format($total_all_withdraw, 2) . 
    "\n กำไร/ขาดทุน : " . $profit . 
    "\n -----------------------\n ฝากวันนี้ : " . $total_member_deposit7 . 
    " ครั้ง \n ถอนวันนี้ : " . $total_member_deposit0 . 
    " ครั้ง\n -----------------------\n สมัครวันนี้ : " . $total__membertoday . 
    "\n จำนวนยูสฝากเงินวันนี้ : " . $total_member_deposit . 
    "\n -----------------------\n คืนยอดเสีย : " . number_format($total_member_deposit8,2) . 
    "\n แนะนำเพื่อน : " . number_format($total_member_deposit15,2) . "\n -----------------------\n "." -----------------------\n เวลา : " . date("d/m/Y H:i:s") . "");

print_r($send);
// exit();