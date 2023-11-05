<?php

include("../config/config.php");

$sql_website = "SELECT * FROM website";
$result_website = $server->query($sql_website);
$row_website = mysqli_fetch_assoc($result_website);


if(isset($_GET['codeList'])) {
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
        $searchQuery = " and (phone like '%".$searchValue."%' or 
        date_check like '%".$searchValue."%' ) ";
    }

    ## Total number of records without filtering
    $sel = mysqli_query($server,"select count(*) as allcount from code_itme WHERE status=0");
    $records = mysqli_fetch_assoc($sel);
    $totalRecords = $records['allcount'];

    ## Total number of records with filtering
    $sel = mysqli_query($server,"select count(*) as allcount from code_itme WHERE 1 AND status=0".$searchQuery);
    $records = mysqli_fetch_assoc($sel);
    $totalRecordwithFilter = $records['allcount'];

    ## Fetch records
    $empQuery = "select * from code_itme WHERE 1 AND status=0".$searchQuery." order by ".$columnName." ".$columnSortOrder." limit ".$row.",".$rowperpage;
    $empRecords = mysqli_query($server, $empQuery);
    $data = array();
    $i = 1;
    while ($row = mysqli_fetch_assoc($empRecords)) {

        $data[] = array(
            "No"=>$i++,
            "id"=>$row['id'],

            "date_check"=>$row['date_check'],
            "date_give"=>$row['date_give'],
            "code"=>$row['code'],
            "credit"=>number_format($row['credit'],2),
            "phone"=>$row['phone'],
            "turnover"=>$row['turnover'],
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
}


if(isset($_GET['codeUse'])) {
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
 
    username_game like '%".$useWord."%' or 
    date_check like '%".$useWord."%' or 
    date_give like '%".$useWord."%' or 
    code like '%".$useWord."%' or 
    credit like'%".$useWord."%' ) ";
}


    ## Total number of records without filtering
    $sel = mysqli_query($server,"select count(*) as allcount from code_itme WHERE status=1");
    $records = mysqli_fetch_assoc($sel);
    $totalRecords = $records['allcount'];

    ## Total number of records with filtering
    $sel = mysqli_query($server,"select count(*) as allcount from code_itme WHERE 1 AND status=1".$searchQuery);
    $records = mysqli_fetch_assoc($sel);
    $totalRecordwithFilter = $records['allcount'];

    ## Fetch records
    $empQuery = "select * from code_itme WHERE 1 AND status=1".$searchQuery." order by ".$columnName." ".$columnSortOrder." limit ".$row.",".$rowperpage;
    $empRecords = mysqli_query($server, $empQuery);
    $data = array();
    $i = 1;
    while ($row = mysqli_fetch_assoc($empRecords)) {

        $data[] = array(
            "No"=>$i++,
            "id"=>$row['id'],
             "username_game"=> $row_website['agent_username'].$row['username_game'],
            "date_check"=>$row['date_check'],
            "date_give"=>$row['date_give'],
            "code"=>$row['code'],
            "credit"=>number_format($row['credit'],2),
            "phone"=>$row['phone'],
            "turnover"=>$row['turnover'],
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
}
