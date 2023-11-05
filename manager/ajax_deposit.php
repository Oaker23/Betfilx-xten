<?php

include("../config/config.php");

// function fname($data){
// 	$sql = "SELECT * FROM member where `username_game`='".$data."'";
// 	$result = $server->query($sql);
// 	$row = mysqli_fetch_assoc($result);
// 	return $sql_user;
// }

// function bank_number($data){
// 	$sql_user = "SELECT * FROM member where `username_game`='".trim($data)."'";
// 	$result_user = $server->query($sql_user);
// 	$row_user = mysqli_fetch_assoc($result_user);	
// 	return  $row_user['bank_number'];
// }


$sql_website = "SELECT * FROM website";
$result_website = $server->query($sql_website);
$row_website = mysqli_fetch_assoc($result_website);

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
	buyerBank like '%".$useWord."%' or 
	username_game like '%".$useWord."%' or 
	buyerName like '%".$useWord."%' or 
	date_check like '%".$useWord."%' or 
	time_check like '%".$useWord."%' or 
	refill_id like'%".$useWord."%' ) ";
}

## Total number of records without filtering
$sel = mysqli_query($server,"select count(*) as allcount from refill WHERE phone !='' ");
$records = mysqli_fetch_assoc($sel);
$totalRecords = $records['allcount'];

## Total number of records with filtering
$sel = mysqli_query($server,"select count(*) as allcount from refill WHERE 1 AND phone !='' ".$searchQuery);
$records = mysqli_fetch_assoc($sel);
$totalRecordwithFilter = $records['allcount'];

## Fetch records
$empQuery = "select * from refill WHERE 1 AND phone !='' and status=1 ".$searchQuery." order by ".$columnName." ".$columnSortOrder." limit ".$row.",".$rowperpage;
$empRecords = mysqli_query($server, $empQuery);
$data = array();
$i = 1;
while ($row = mysqli_fetch_assoc($empRecords)) {
	

	$info=$row['description'];
	$bank_info=$row['buyerBank'];
	if ($info=="") {
		$info='Bank';
	}else{
		$info='QR';
	}

	$sql = "SELECT * FROM member where `phone`='".trim($row['phone'])."'";
	$result = $server->query($sql);
	$row1 = mysqli_fetch_assoc($result);
	$fname=$row1['fname'];

	if ($fname=="") {
		$fname="ไม่มีข้อมูล";
	}
	$bank_number=$row1['bank_number'];
	if ($bank_info=="CIMB") {
		$bank_info='ทรูมันนี่';
	}


	

	if ($bank_info=="KBANK") {
		$bank_info='กสิกรไทย';
	}

	if ($bank_info=="KTB") {
		$bank_info='กรุงไทย';
	}
	if ($bank_info=="GSB") {
		$bank_info='ออมสิน';
	}


	if ($bank_info=="BAY") {
		$bank_info='กรุงศรี';
	}

	if ($bank_info=="BBL") {
		$bank_info='กรุงเทพ';
	}

	// if ($bank_info!="CIMB" and $bank_info!="KBANK" and $bank_info!="KTB" and $bank_info!="GSB"and $bank_info!="BBL") {
	// 	$bank_info='ไทยพาณิชย์';
	// }


	$data[] = array(
		"No"=>$i++,
		"id"=>$row['id'],
		"refill_id"=>$row['refill_id'],
		"username_game"=> $row_website['agent_username'].$row1['username_game'],
		"date_check"=>$row['date_check'].' '.$row['time_check'],
		"amount"=>number_format($row['amount'],2),
		"fname"=>$fname,
		"banknumber"=>$bank_number,
		"description"=>$info,
		"buyerBank"=>$bank_info,
		"buyerName"=>$row['buyerName'],
		"phone"=>$row['phone'],
		"info"=>$row['info'],
		"status"=>$row['status'],
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
