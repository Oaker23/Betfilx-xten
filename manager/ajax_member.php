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

	$searchQuery = " and (fname like '%".$useWord."%' or 
    username_game like '%".$useWord."%' or 
    bank_number like '%".$useWord."%' or 
    bank_name like '%".$useWord."%' or 
    credit like '%".$useWord."%' or 
    phone like'%".$useWord."%' ) ";
}


## Total number of records without filtering
$sel = mysqli_query($server,"select count(*) as allcount from member WHERE username_game !=''");
$records = mysqli_fetch_assoc($sel);
$totalRecords = $records['allcount'];

## Total number of records with filtering
$sel = mysqli_query($server,"select count(*) as allcount from member WHERE 1 AND  username_game !=''".$searchQuery);
$records = mysqli_fetch_assoc($sel);
$totalRecordwithFilter = $records['allcount'];





## Fetch records
$empQuery = "select * from member WHERE 1 ".$searchQuery." order by ".$columnName." ".$columnSortOrder." limit ".$row.",".$rowperpage;
$empRecords = mysqli_query($server, $empQuery);
$data = array();
$i = 1;
while ($row = mysqli_fetch_assoc($empRecords)) {
    if($row['fname']==""){
     $status="ยังไม่ยืนยัน ธนาคาร";
 }else{
     $status=$row['fname'];
 }
 if ($row['username_game']=="") {
    $user_game="ยังไม่เติมเงิน";
}else{
    $user_game= $row_website['agent_username'].$row['username_game'];
}

$date_check=date("d/m/Y");

$query = $server->query('SELECT * FROM `code_itme` WHERE `phone`= "'.$row['phone'].'"');
$check = $query->num_rows;
if ($check >=1) {
  $color='black';
   // $status=' ไม่รับเครดิตฟรี';
}else{
    // $status=' รับเครดิตฟรี';
    $color='red';
}

$promotion = "";
$query_promotion = $server->query('SELECT * FROM `history_promotion` where phone = "'.$row['phone'].'" and status_turnover = 1 order by id desc limit 1');
$check_promotion = $query_promotion->num_rows;
if ($check_promotion >=1) {
    while ($row_promotion = mysqli_fetch_assoc($query_promotion)) {
        $promotion = "ติดโปร ".$row_promotion['name'];
    }
}else{
    $promotion = "ติดโปรธรรมดา";
}

$data[] = array(
    "No"=>$i++,
    "id"=>$row['id'],
    "date_check"=>$row['date_check'],
    "time_check"=>$row['time_check'],
    "username_game"=> $user_game,
    "password_game"=>$row['password_game'],
    "password"=>$row['password'],
    "fname"=>$status,
    "bank_number"=>$row['bank_number'],
    "bank_name"=>$row['bank_name'],
    "phone"=>$row['phone'],
    "credit"=>number_format($row['credit'],2),
    "point"=>$row['point'],
    "credit_refund"=>$row['credit_refund'],
    "pro_turnover"=>$row['pro_turnover'],
    "last_turnover"=>$row['last_turnover'],
    "last_withdraw"=>$row['last_withdraw'],
    "last_refund"=>$row['last_refund'],
    "last_login"=>$row['last_login'],
    "refid"=>$row['refid'],
    "commission_credit"=>$row['commission_credit'],
    "last_commission"=>$row['last_commission'],
    "date_commission"=>$row['date_commission'],
    "status_turnover"=>$row['status_turnover'],
    "status_user"=>$row['status_user'],

    "turnover"=>$row['turnover'],
    "turnover_struck"=>$row['turnover_struck'],
    "status_promotion"=>$promotion,
    // "status_promotion"=>$row['status_promotion'],

 "color"=> $color
  // "status"=> $status

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
