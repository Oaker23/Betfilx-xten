<?php

date_default_timezone_set("Asia/Bangkok");
//DB
try{
    /* DATABASE SETTING */
    $config['mysqlHost'] = 'localhost';
    $config['mysqlUser'] = 'betflixff_betflik';
    $config['mysqlPass'] = 'g8reZ0TipJ';
    $config['mysqlDB'] = 'betflixff_betflik';

        $server = new PDO("mysql:host=".$config['mysqlHost'].";dbname=".$config['mysqlDB'].";charset=utf8", $config['mysqlUser'], $config['mysqlPass']);
}catch (PDOException $e) {
    echo "Error : " . $e->getMessage() . "<br/>";
    die();
}	