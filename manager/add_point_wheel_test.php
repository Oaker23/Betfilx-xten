
<?php
include "../config/config.php";

    $phone = '0616674221';
    $Amount = 301;
    $sqlWheel = "SELECT * FROM config_wheel";
    $resulWheel = $server->query($sqlWheel);
    $arrWheel = array();
    while($rowWheel = mysqli_fetch_assoc($resulWheel)) {
        $arrWheel[] = $rowWheel;
    }
    $add_point = $arrWheel[5]['point'];
  
    $count_point = $Amount / 300;
    $count_point = explode('.', $count_point);
    $count_point = $count_point[0];
  
    $add_point = $add_point * $count_point;
  
    $sqlMember = "SELECT * FROM `member` WHERE `phone`='".$phone."'";
    $resulMember = $server->query($sqlMember);
    if($resulMember->num_rows > 0){
    $rowMember = mysqli_fetch_assoc($resulMember);
      $add_point = $add_point + $rowMember['point'];
      $sqlPoint = "UPDATE `member` SET `point`= '".$add_point."' WHERE `phone`='".$phone."' ";
      $server->query($sqlPoint);
    }

?>