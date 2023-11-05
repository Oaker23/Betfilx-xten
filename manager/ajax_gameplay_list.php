<?php


include("../config/config.php");



## Read value

$phone = $_GET['phone'];



$draw = $_GET['draw'];

$row = $_GET['start'];

$rowperpage = $_GET['length']; // Rows display per page

$columnIndex = $_GET['order'][0]['column']; // Column index

$columnName = $_GET['columns'][$columnIndex]['data']; // Column name

$columnSortOrder = $_GET['order'][0]['dir']; // asc or desc



$getusername = "SELECT username_game FROM `member` WHERE phone = '".$phone."' ";
    $query = $server->query($getusername);
    $memberid = $query->fetch_row();


$getagent = "SELECT agent_username FROM `website` WHERE id=1";

$query1 = $server->query($getagent);
$agentName = $query1->fetch_row();


$searchQuery = "and (username = '".$agentName[0].$memberid[0]."') ";



//  print_r($memberid);exit();


## Total number of records without filtering

$sel = mysqli_query($server,"select count(*) as allcount from report_game WHERE 1 ".$searchQuery);

$records = mysqli_fetch_assoc($sel);

$totalRecords = $records['allcount'];



## Total number of records with filtering

$sel = mysqli_query($server,"select count(*) as allcount from report_game WHERE 1 ".$searchQuery);

$records = mysqli_fetch_assoc($sel);

$totalRecordwithFilter = $records['allcount'];











## Fetch records
$empQuery = mysqli_query($server,"select * from report_game WHERE 1 ".$searchQuery." ORDER BY created_at DESC limit ".$row.",".$rowperpage." ");

    //  echo "select * from report_game WHERE 1 ".$searchQuery." ORDER BY created_at DESC limit ".$row.",".$rowperpage." ";exit();
    //  print_r($getagent);exit();



$data = array();

$i = 1;




while ($row = mysqli_fetch_assoc($empQuery)) {
    
    $row["created_at"] = DateThai($row['created_at']);

    

$data[] = array(

    "created_at"=>$row['created_at'],
    
    "provider"=>$row['provider'],

    "turnover"=>$row['turnover'],

    "winloss"=>$row['winloss'],

);

}



## Response
if(count($empQuery) <= 0){
    $data[] = array(

        "created_at"=>"-",
        
        "provider"=>"-",
    
        "turnover"=>"0",
    
        "winloss"=>"0",
    
    );
    $response = array(

        "draw" => 1,
    
        "iTotalRecords" => 0,
    
        "iTotalDisplayRecords" => 0,
    
        "aaData" => $data
    
    );
}else{
    $response = array(

        "draw" => intval($draw),
    
        "iTotalRecords" => $totalRecords,
    
        "iTotalDisplayRecords" => $totalRecordwithFilter,
    
        "aaData" => $data
    
    );
}


function DateThai($strDate)
{
		$strYear = date("Y",strtotime($strDate))+543;
		$strMonth= date("n",strtotime($strDate));
		$strDay= date("j",strtotime($strDate));
		$strHour= date("H",strtotime($strDate));
		$strMinute= date("i",strtotime($strDate));
		$strSeconds= date("s",strtotime($strDate));
		$strMonthCut = Array("","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
		$strMonthThai=$strMonthCut[$strMonth];
		return "$strDay $strMonthThai $strYear, $strHour:$strMinute";
}


echo json_encode($response);


