<?php
error_reporting(0);
require 'config/config.php';
include 'api_betflix.php';

    $get_last_id = "SELECT betflik_lastedID FROM `report_game` order by id desc limit 1";
    $query = $server->query($get_last_id);
    $row = $query->fetch_row();

    //  print_r($row);

    $get_max_date= "SELECT MAX(created_at) FROM `report_game`";
    $query_max_date = $server->query($get_max_date);
    $row_max_date = $query_max_date->fetch_row();
    // 2022-03-31 23:59:00
    $timestamp = strtotime($row_max_date[0]);
    $max_date = date("m", $timestamp);
    // echo (int)$max_date;exit();

    $lastid = 0;
    if(count($query->num_rows)>0 && (int)$max_date == (int)date('m')){
        if($row[0]){
            $lastid = $row[0]+1;
        }
    }
    // echo "lastid=".$lastid;exit();
    // $lastid = 3180676;
    $data = $api->report_game($lastid,date('m'),1000);
    // print_r($data);exit();
    $decode = json_decode($data,true);

    $sql_website = "SELECT * FROM `website`";
    $result_website = $server->query($sql_website);
    $row_website = mysqli_fetch_assoc($result_website);
    $agent_username = $row_website['agent_username'];

    foreach ($decode['data'] as $key => $value) {
       
        $sql_update_report_game = "INSERT INTO `report_game` VALUES (null,'betflik',".$value['lastedID'].",'".$value['username']."','".$value['ref']."','".$value['provider']."','".$value['type']."',".$value['turnover'].",".$value['valid_amount'].",".$value['winloss'].",".$value['total'].",'".$value['bettime']."','".$value['caltime']."','".$value['hash']."', null) ";
      
        $query = $server->query($sql_update_report_game);
        if($query == true){
            echo 'ดึงข้อมูลสำเร็จ <br>';

            $username_game = explode($agent_username, $value['username']);
            if(count($username_game) > 0){
                $sql_member = "SELECT * FROM `member` WHERE `username_game`='".$username_game[1]."' ";
                $query_member = $server->query($sql_member);
                $row_member = mysqli_fetch_assoc($query_member);
                $turnover = (int)$row_member['turnover'] - (int)$value['turnover'];
                if($turnover > 0){
                    $sql="UPDATE `member` SET `turnover`='".$turnover."' WHERE `username_game`='".$username_game[1]."' ";
                    if ($server->query($sql) === TRUE) {
                        echo 'อัพเดท turnover1 สำเร็จ '.$turnover.'|'.$username_game[1].' <br>';
                    }
                }else{
                    $sql="UPDATE `member` SET `turnover`='0' WHERE `username_game`='".$username_game[1]."' ";
                    if ($server->query($sql) === TRUE) {
                        echo 'อัพเดท turnover2 สำเร็จ 0|'.$username_game[1].' <br>';
                    }
                }
            }


        }else{
            echo 'ไม่สำเร็จ'.$sql_update_report_game.'<br>';
        }
    }
?>