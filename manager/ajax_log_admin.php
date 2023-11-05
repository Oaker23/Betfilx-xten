<?php

include("../config/config.php");

## Read value
$draw = $_POST['draw'];
$row = $_POST['start'];
$rowperpage = $_POST['length']; // Rows display per page
$columnIndex = $_POST['order'][0]['column']; // Column index
$columnName = $_POST['columns'][$columnIndex]['data']; // Column name
$columnSortOrder = $_POST['order'][0]['dir']; // asc or desc
$searchValue = mysqli_real_escape_string($server,$_POST['search']['value']); // Search value

$sql_website = "SELECT * FROM website";
$result_website = $server->query($sql_website);
$row_website = mysqli_fetch_assoc($result_website);

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

	$searchQuery = " and (
	a.id like '%".$useWord."%' or 
	a.user_admin like '%".$useWord."%' or 
	b.fname like '%".$useWord."%' or 
	a.user_member like '%".$useWord."%' or 
	c.fname like '%".$useWord."%' or 
	a.detail_code like '%".$useWord."%' or 
	d.name like '%".$useWord."%' or 
	a.value1 like '%".$useWord."%' or 
	a.value2 like '%".$useWord."%' or 
	a.value3 like '%".$useWord."%' or 
	a.value4 like '%".$useWord."%' or 
	a.create_date like'%".$useWord."%' ) ";
}

## Total number of records without filtering
$sel = mysqli_query($server,"select count(*) as allcount from log_admin WHERE 1 ");
$records = mysqli_fetch_assoc($sel);
$totalRecords = $records['allcount'];

## Total number of records with filtering
$sel = mysqli_query($server,"select count(*) as allcount from log_admin a 
							 left join admin b on (a.user_admin = b.username)
							 left join member c on (a.user_member = c.username_game)
							 left join log_detail d on (a.detail_code = d.code) WHERE 1 ".$searchQuery);
$records = mysqli_fetch_assoc($sel);
$totalRecordwithFilter = $records['allcount'];

## Fetch records
// $empQuery = "select * from log_admin WHERE 1 ".$searchQuery." order by ".$columnName." ".$columnSortOrder." limit ".$row.",".$rowperpage;
$empQuery = "select a.id, a.user_admin, b.fname as user_admin_name, a.user_member, c.fname as user_member_name, a.detail_code, d.name as detail_name, a.value1, a.value2, a.value3, a.value4, a.create_date
			 from log_admin a 
			 left join admin b on (a.user_admin = b.username)
			 left join member c on (a.user_member = c.username_game)
			 left join log_detail d on (a.detail_code = d.code) WHERE 1 ".$searchQuery." order by ".$columnName." ".$columnSortOrder." limit ".$row.",".$rowperpage;
$empRecords = mysqli_query($server, $empQuery);
$data = array();
$i = 1;
while ($row = mysqli_fetch_assoc($empRecords)) {
	
	$data[] = array(
		"No"=>$i++,
		"id"=> $row['id'],
		"user_admin"=>$row['user_admin'],
		"user_admin_name"=>$row['user_admin_name'],
		"user_member"=>$row_website['agent_username'].$row['user_member'],
		"user_member_name"=>$row['user_member_name'],
		"detail_code"=> $row['detail_code'],
		"detail_name"=> $row['detail_name'],
		"value1"=> $row['value1'],
		"value2"=> $row['value2'],
		"value3"=> $row['value3'],
		"value4"=> $row['value4'],
		"create_date"=> $row['create_date'],
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
