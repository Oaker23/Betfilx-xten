<?php

include '../config/config.php';



if(isset($_GET['addGive'])) {

    foreach ($_POST['arrFormGive'] as $key => $value) {

        date_default_timezone_set("Asia/Bangkok");
        $date_check=date("Y-m-d");
        $time_check=date('H:i:s');

        $Credit = $value['Credit'];
        $TurnOver = $value['TurnOver']; 
        $genKey = $value['genKey'];
        $date_check = $date_check;
        // echo json_encode($id);

        $query = $server->query('SELECT * FROM `code_itme` WHERE `code`= "'.$genKey.'"');
        $check = $query->num_rows;
        if ($check >0) {
            $data = array ('msg'=>'โค้ดซ้ำกรุณากดใหม่ '.$genKey,'status'=>500);
            echo json_encode($data);
            exit();
        }


        $sql="INSERT INTO `code_itme`(`date_check`, `code`, `credit`, `turnover`) VALUES ('".$date_check."','".$genKey."','".$Credit."','".$TurnOver."')";
        $ex = $server->query($sql);



    }
    if ($ex === TRUE) {
        $data = array ('msg'=>'อัพเดท ข้อมูล !สำเร็จ','status'=>200);
        echo json_encode($data);
        exit();
    }else{
        $data = array ('msg'=>'อัพเดท ข้อมูล !ไม่สำเร็จ','status'=>500);
        echo json_encode($data);
        exit();
    }

}

if(isset($_GET['update_credit_deposit_alert'])) {
    include '../api_betflix.php';
    $id = $_POST['id_credit'];
    $phone = $_POST['phone'];
    $sql2 = "SELECT * FROM refill WHERE id = '".$id."'";
    $result2 = $server->query($sql2);
    $row2 = mysqli_fetch_assoc($result2);
    $amount = $row2['amount'];

    $sqlMember = "SELECT * FROM member WHERE phone = '".$phone."'";
    $resultMember = $server->query($sqlMember);
    $rowMember = mysqli_fetch_assoc($resultMember);
    $username_game = $rowMember['username_game'];


    $status = json_decode($api->deposit($username_game,$amount),true);
    // print_r($status);exit();
     $status_msg=$status['msg'];
     $status=$status['status'];
    if ($status=='success') {
        $sql_status="UPDATE `refill` SET `phone`= '".$phone."',`status`='1' WHERE id='".$id."'";
        $ex = $server->query($sql_status);
        if ($ex === TRUE) {
            $data = array ('msg'=>'เติมเครดิต !สำเร็จ','status'=>200);
            echo json_encode($data);

            if($_SESSION['username'] != null && $_SESSION['username'] != ""){ // เช็คว่าไม่ใช่ cronjob
                $refill_data=implode(" | ",$row2);
                $sql_log_admin = "INSERT INTO `log_admin` (user_admin,user_member,detail_code,create_date,value1,value2,value3,value4) VALUES 
                ('".$_SESSION['username']."','".$username_game."','AC',NOW(),'".$amount."','".$refill_data."','','')";
                $server->query($sql_log_admin);
            }

        }else{
            $data = array ('msg'=>'เติมเครดิตสำเร็จ !ไม่สำเร็จ','status'=>500);
            echo json_encode($data);
        }
    }else{
    //  $data = array ('msg'=>'ไม่พบ username','status'=>500);
     $data = array ('msg'=> $status_msg,'status'=>500);
     echo json_encode($data);
 }






}


?>

