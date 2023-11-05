<?php

date_default_timezone_set("Asia/Bangkok");
//DB
try{
    /* DATABASE SETTING */
    $config['mysqlHost'] = 'localhost';
    $config['mysqlUser'] = 'mbetnet_betflix';
    $config['mysqlPass'] = 'h2zByC2E5bQC';
    $config['mysqlDB'] = 'mbetnet_betflix';

        $server = new PDO("mysql:host=".$config['mysqlHost'].";dbname=".$config['mysqlDB'].";charset=utf8", $config['mysqlUser'], $config['mysqlPass']);
}catch (PDOException $e) {
    echo "Error : " . $e->getMessage() . "<br/>";
    die();
}	