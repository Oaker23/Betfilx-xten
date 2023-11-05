<?php

include("../config/config.php");
$date_now=date('Y-m-d');
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
    buyerBank like '%".$searchValue."%' or 
    buyerName like '%".$searchValue."%' or 
    refill_id like'%".$searchValue."%' ) ";
}

## Total number of records without filtering
$sel = mysqli_query($server,"select count(*) as allcount from refill WHERE phone ='' ");
$records = mysqli_fetch_assoc($sel);
$totalRecords = $records['allcount'];

## Total number of records with filtering
$sel = mysqli_query($server,"select count(*) as allcount from refill WHERE 1 AND phone ='' ".$searchQuery);
$records = mysqli_fetch_assoc($sel);
$totalRecordwithFilter = $records['allcount'];

## Fetch records
$empQuery = "select * from refill WHERE 1  AND buyerBank!='เติมมือ' and status=0 ".$searchQuery." order by ".$columnName." ".$columnSortOrder." limit ".$row.",".$rowperpage;
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

    if ($bank_info=="CIMB") {
        $bank_info='ทรูมันนี่';
    }


    if ($bank_info=="SCB") {
        $bank_info='ไทยพาณิชย์';
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



    $data[] = array(
        "No"=>$i++,
        "id"=>$row['id'],
        "refill_id"=>$row['refill_id'],
        "date_check"=>$row['date_check'].' '.$row['time_check'],
        "amount"=>number_format($row['amount'],2),
        "description"=>$row['description'],
       "buyerBank"=>$bank_info,
        "buyerName"=>$row['buyerName'],
        "phone"=>$row['phone'],
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
