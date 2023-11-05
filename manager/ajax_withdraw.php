<?php

include("../config/config.php");


$sql_website = "SELECT * FROM website";
$result_website = $server->query($sql_website);
$row_website = mysqli_fetch_assoc($result_website);

function status($value){
	if($value==0){
		return "สำเร็จ";
	}
	if($value==1){
		return "รอ";
	}
	if($value==2){
		return "ยกเลิก";
	}
}

## Read value
$draw = $_POST['draw'];
$row = $_POST['start'];
$rowperpage = $_POST['length']; // Rows display per page
$columnIndex = $_POST['order'][0]['column']; // Column index
$columnName = $_POST['columns'][$columnIndex]['data']; // Column name
$columnSortOrder = $_POST['order'][0]['dir']; // asc or desc
$searchValue = mysqli_real_escape_string($server,$_POST['search']['value']); // Search value

## Search 
$searchQuery = " ";


if($searchValue != ''){
    $textAgent=$row_website['agent_username'];
    $useWord = "";
    $expoldeWord = explode($textAgent, $searchValue);

    $agentWord = "";
    $userWord = "";

    $agentWord = $expoldeWord[0];
    $userWord = $expoldeWord[1];
    
    $useWord = $searchValue;
    if(count($expoldeWord) != 1) {
        $useWord = $userWord;
    }

    
    $searchQuery = " and (phone like '%".$useWord."%' or 
    bank_number like '%".$useWord."%' or 
    username_game like '%".$useWord."%' or 
    bank_name like '%".$useWord."%' or 
    time_withdraw like '%".$useWord."%' or 
    date_withdraw like '%".$useWord."%' or 
    description like'%".$useWord."%' ) ";
}

## Total number of records without filtering
$sel = mysqli_query($server,"select count(*) as allcount from withdraw ");
$records = mysqli_fetch_assoc($sel);
$totalRecords = $records['allcount'];

## Total number of records with filtering
$sel = mysqli_query($server,"select count(*) as allcount from withdraw WHERE 1 ".$searchQuery);
$records = mysqli_fetch_assoc($sel);
$totalRecordwithFilter = $records['allcount'];

## Fetch records
$empQuery = "select * from withdraw WHERE 1 ".$searchQuery." order by ".$columnName." ".$columnSortOrder." limit ".$row.",".$rowperpage;
$empRecords = mysqli_query($server, $empQuery);
$data = array();
$i = 1;
while ($row = mysqli_fetch_assoc($empRecords)) {
    $sql = "SELECT * FROM member where `username_game`='".$row['username_game']."'";
    $result = $server->query($sql);
    $row1 = mysqli_fetch_assoc($result);
    $fname=$row1['fname'];
    
    
    $data[] = array(
        "No"=>$i++,
        "id"=>$row['id'],
        "phone"=>$row['phone'],
        "username_game"=>$row_website['agent_username'].$row['username_game'],
        "time_withdraw"=>$row['time_withdraw'],
        "date_withdraw"=>$row['date_withdraw'],
        "credit"=>number_format($row['credit'],2),
        "fname"=>$fname,
        "status"=>status($row['status']),
        "bank_number"=>$row['bank_number'],
        "bank_name"=>$row['bank_name'],
        "description"=>$row['description'],
        "info"=>$row['info']
    );
}

## Response
$response = array(
    "draw" => intval($draw),
    "iTotalRecords" => $totalRecords,
    "iTotalDisplayRecords" => $totalRecordwithFilter,
    "aaData" => $data
);

echo json_encode($response);
