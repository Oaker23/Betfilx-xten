<?php

class scb {
	private $accountFrom;
	private $pin;
	private $deviceId;
	private $encrypt;
	private $tilesVersion='41';
	private $useragent='Android/11;FastEasy/3.50.0/5423';
	private $host;
	private $user;
	private $pass;
	private $db;
	private $has_key;

	public function __construct($deviceId, $accountFrom, $pin,$encrypt,$host,$user,$pass,$db,$has_key)
	{
		$this->deviceId = $deviceId;
		$this->accountFrom = $accountFrom;
		$this->pin = $pin;
		$this->encrypt = $encrypt;
		$this->host = $host;
		$this->user = $user;
		$this->pass = $pass;
		$this->db = $db;
		$this->has_key = $has_key;
	}

	public function Curl($method, $url, $data,$header)	{

		if ($url=='https://fasteasy.scbeasy.com/v3/login/preloadandresumecheck' or $url=='https://fasteasy.scbeasy.com/v1/fasteasy-login') {
			$check_header=1;
		}else{
			$check_header=0;
		}

		$curl = curl_init();
		curl_setopt_array($curl, array(
			CURLOPT_URL => $url,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => '',
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_HEADER=> $check_header,
			CURLOPT_TIMEOUT => 10,
			CURLOPT_FOLLOWLOCATION => true,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => $method,
			CURLOPT_POSTFIELDS => $data,
			CURLOPT_HTTPHEADER => $header,));
		$response = curl_exec($curl);
		curl_close($curl);
		return $response;
		
	}

	public function insert_sql($data){


		$host = $this->host;
$user = $this->user; //db user
$pass = $this->pass; //db pass
$db = $this->db; //db  


$server = mysqli_connect($host,$user,$pass,$db);
if(!$server){
	die("เชื่อมต่อฐานข้อมูลไม่สำเร็จ!" .mysqli_connect_error());
}
mysqli_set_charset($server,"utf8");


$sql=$data;
if ($server->query($sql) === TRUE) {}

}


public function toekn(){


	$host = $this->host;
$user = $this->user; //db user
$pass = $this->pass; //db pass
$db = $this->db; //db 


$server = mysqli_connect($host,$user,$pass,$db);
if(!$server){
	die("เชื่อมต่อฐานข้อมูลไม่สำเร็จ!" .mysqli_connect_error());
}
mysqli_set_charset($server,"utf8");


$sql="SELECT * FROM `scb_info` WHERE `banknumber`='".$this->accountFrom."'";
$result = $server->query($sql);
$row = mysqli_fetch_assoc($result);


return  $this->decrypt($row['token']);

}

public function encrypt($string){
	$key=$this->has_key;
	$result = '';
	for($i=0; $i<strlen($string); $i++) {
		$char = substr($string, $i, 1);
		$keychar = substr($key, ($i % strlen($key))-1, 1);
		$char = chr(ord($char)+ord($keychar));
		$result.=$char;
	}
	return base64_encode($result);
}

public function decrypt($string){
	$key=$this->has_key;
	$result = '';
	$string = base64_decode($string);
	for($i=0; $i<strlen($string); $i++) {
		$char = substr($string, $i, 1);
		$keychar = substr($key, ($i % strlen($key))-1, 1);
		$char = chr(ord($char)-ord($keychar));
		$result.=$char;
	}
	return $result;
}



public function login(){


	$curl = curl_init();

	curl_setopt_array($curl, array(
		CURLOPT_URL => 'http://103.13.229.169/test_scb/api.php?deviceId='.$this->deviceId.'&pin='.$this->pin.'',
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => '',
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 0,
		CURLOPT_FOLLOWLOCATION => true,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => 'GET',
	));

	$Auth1 = curl_exec($curl);

	

	curl_close($curl);

	preg_match_all('/รหัสของคุณถูกล็อคการใช้งานชั่วคราว/', $Auth1, $check);
	$check=$check[0][0];

	if ($check=='รหัสของคุณถูกล็อคการใช้งานชั่วคราว') {
		$data = array ('msg'=>'รหัสของคุณถูกล็อคการใช้งานชั่วคราว เนื่องจากใส่รหัส PIN ผิดเกินจำนวนครั้งที่กำหนด','status'=>500);
		echo json_encode($data);
		exit();
	}



	if ($Auth1=="") {
		$data = array ('msg'=>'ระบบมีปัญหา กรุณาแจ้งแอดมิน Auth error','status'=>500);
		echo json_encode($data);
		exit();

	}


	$this->insert_sql("UPDATE `scb_info` SET `token`='".$this->encrypt($Auth1)."' WHERE banknumber='".$this->accountFrom."'");



}


public function balance(){
	$Auth1= $this->toekn();


	$header=array(
		'Api-Auth: '.$Auth1,
		'Content-Type: application/json',
	);
	$data='{"depositList":[{"accountNo":"'.$this->accountFrom.'"}],"numberRecentTxn":2,"tilesVersion":"41"}';
	$response = $this->Curl("POST", 'https://fasteasy.scbeasy.com/v2/deposits/summary',$data,$header);


	$result=json_decode($response,true);
	$status=$result['status']['code'];
	

	if ($status==1002 or $status=="") {
		$this->login();
		$Auth1= $this->toekn();
		$header=array(
			'Api-Auth: '.$Auth1,
			'Content-Type: application/json',
		);
		$data='{"depositList":[{"accountNo":"'.$this->accountFrom.'"}],"numberRecentTxn":2,"tilesVersion":"41"}';
		$response = $this->Curl("POST", 'https://fasteasy.scbeasy.com/v2/deposits/summary',$data,$header);
		$result=json_decode($response,true);
		$status=$result['status']['code'];
	}

	
	if ($status==1002 or $status=="") {
		$data = array ('msg'=>'ไม่สามารถทำรายการบัญชีนี้ได้','status'=>500);
		echo json_encode($data);
		exit();

	}
	
	
	$this->insert_sql("UPDATE `scb_info` SET `balance`='".$result['totalAvailableBalance']."' WHERE banknumber='".$this->accountFrom."'");

	return $result['totalAvailableBalance'];


}

public function code($value){
	$value=trim($value);

	if ($value=="ไทยพาณิชย์") {
		return '014';
	}

	if ($value=="กรุงเทพ") {
		return '002';
	}

	if ($value=="กสิกรไทย") {
		return '004';
	}

	if ($value=="กรุงไทย") {
		return '006';
	}

	if ($value=="ทหารไทย") {
		return '011';
	}

	if ($value=="กรุงศรีฯ") {
		return '025';
	}
	if ($value=="ออมสิน") {
		return '030';
	}

	if ($value=="ธนชาติ") {
		return '011';
	}

	if ($value=="ธกส") {
		return '034';
	}

	if ($value=="ทหารไทยธนชาติ") {
		return '011';
	}
}


public function transactions(){
	date_default_timezone_set("Asia/Bangkok");
	$date_now=date("Y-m-d");
	$startDate=$date_now;
	$endDate=$date_now;



	$Auth1= $this->toekn();
	$header=array(
		'Api-Auth:  '.$Auth1,
		'Accept-Language: th',
		'user-agent:'.$this->useragent,
		'Content-Type: application/json; charset=UTF-8'
	);
	$data="{\"accountNo\":\"".$this->accountFrom."\",\"endDate\":\"".$endDate."\",\"pageNumber\":\"1\",\"pageSize\":20,\"productType\":\"2\",\"startDate\":\"".$startDate."\"}";
	$response = $this->Curl("POST", 'https://fasteasy.scbeasy.com/v2/deposits/casa/transactions',$data,$header);

	$result=json_decode($response,true);

	$status=$result['status']['code'];
	if ($status==1002) {
		$this->login();
		$Auth1= $this->toekn();
		$header=array(
			'Api-Auth:  '.$Auth1,
			'Accept-Language: th',
			'user-agent:'.$this->useragent,
			'Content-Type: application/json; charset=UTF-8'
		);
		$data="{\"accountNo\":\"".$this->accountFrom."\",\"endDate\":\"".$endDate."\",\"pageNumber\":\"1\",\"pageSize\":20,\"productType\":\"2\",\"startDate\":\"".$startDate."\"}";
		$response = $this->Curl("POST", 'https://fasteasy.scbeasy.com/v2/deposits/casa/transactions',$data,$header);

		$result=json_decode($response,true);

	}


	// $check=$result['status']['description'];

	$data = array ('result'=>$result['data']['txnList']);
	return json_encode($data);

}

public function verification($accountTo,$accountToBankCode){
	$amount='1';
	$Auth1= $this->toekn();
	$amount=str_replace(",","", $amount);
	$accountToBankCode=$this->code($accountToBankCode);
	$transferType="ORFT";
	if ($accountToBankCode=='014') {
		$transferType="3RD";
	}
	$header=array(
		'Api-Auth:  '.$Auth1,
		'Accept-Language: th',
		'user-agent:'.$this->useragent,
		'Content-Type: application/json; charset=UTF-8'
	);
	$data="{\"accountFrom\":\"".$this->accountFrom."\",\"accountFromType\":\"2\",\"accountTo\":\"".$accountTo."\",\"accountToBankCode\":\"".$accountToBankCode."\",\"amount\":\"".$amount."\",\"annotation\":null,\"transferType\":\"".$transferType."\"}";



	$response = $this->Curl("POST", 'https://fasteasy.scbeasy.com/v2/transfer/verification',$data,$header);
	$result=json_decode($response,true);

	$status=$result['status']['code'];
	if ($status==1002) {
		$this->login();
		$Auth1= $this->toekn();
		
		$header=array(
			'Api-Auth:  '.$Auth1,
			'Accept-Language: th',
			'user-agent:'.$this->useragent,
			'Content-Type: application/json; charset=UTF-8'
		);
		$data="{\"accountFrom\":\"".$this->accountFrom."\",\"accountFromType\":\"2\",\"accountTo\":\"".$accountTo."\",\"accountToBankCode\":\"".$accountToBankCode."\",\"amount\":\"".$amount."\",\"annotation\":null,\"transferType\":\"".$transferType."\"}";



		$response = $this->Curl("POST", 'https://fasteasy.scbeasy.com/v2/transfer/verification',$data,$header);
		$result=json_decode($response,true);

	}


	$check=$result['status']['description'];
	if ($check=="จำนวนเงินในบัญชีไม่เพียงพอ กรุณาเลือกบัญชีอื่น") {
		$result = array ('msg'=>'จำนวนเงินในบัญชีไม่เพียงพอ กรุณาเลือกบัญชีอื่น','status'=>500);
		return json_encode($result);
		exit();
	}
	$result = json_decode($response,true);
	$accountToName= $result['data']['accountToName'];
	if ($accountToName!="") {
		return $accountToName;
	}else{
		$data = array ('msg'=>'ไม่พบเลขบัญชีของคุณ','status'=>500);
		return 'ไม่พบเลขบัญชีของคุณ';
	}

}



public function tranfers($accountTo,$accountToBankCode,$amount){

	$Auth1= $this->toekn();
	$amount=str_replace(",","", $amount);
	$accountToBankCode=$this->code($accountToBankCode);
	$transferType="ORFT";
	if ($accountToBankCode=='014') {
		$transferType="3RD";
	}
	$header=array(
		'Api-Auth:  '.$Auth1,
		'Accept-Language: th',
		'user-agent:'.$this->useragent,
		'Content-Type: application/json; charset=UTF-8'
	);
	$data="{\"accountFrom\":\"".$this->accountFrom."\",\"accountFromType\":\"2\",\"accountTo\":\"".$accountTo."\",\"accountToBankCode\":\"".$accountToBankCode."\",\"amount\":\"".$amount."\",\"annotation\":null,\"transferType\":\"".$transferType."\"}";



	$response = $this->Curl("POST", 'https://fasteasy.scbeasy.com/v2/transfer/verification',$data,$header);
	$result=json_decode($response,true);

	$status=$result['status']['code'];
	if ($status==1002) {
		$this->login();
		$Auth1= $this->toekn();
		
		$header=array(
			'Api-Auth:  '.$Auth1,
			'Accept-Language: th',
			'user-agent:'.$this->useragent,
			'Content-Type: application/json; charset=UTF-8'
		);
		$data="{\"accountFrom\":\"".$this->accountFrom."\",\"accountFromType\":\"2\",\"accountTo\":\"".$accountTo."\",\"accountToBankCode\":\"".$accountToBankCode."\",\"amount\":\"".$amount."\",\"annotation\":null,\"transferType\":\"".$transferType."\"}";



		$response = $this->Curl("POST", 'https://fasteasy.scbeasy.com/v2/transfer/verification',$data,$header);
		$result=json_decode($response,true);

	}


	$check=$result['status']['description'];


	if ($check=="จำนวนเงินในบัญชีไม่เพียงพอ กรุณาเลือกบัญชีอื่น") {
		$data = array ('msg'=>'จำนวนเงินในบัญชีไม่เพียงพอ กรุณาเลือกบัญชีอื่น','status'=>500);

		echo json_encode($data);
		exit();
	}

	$data = json_decode($response,true);


	$totalFee=$data['data']['totalFee'];
	$scbFee=$data['data']['scbFee'];
	$botFee=$data['data']['botFee'];
	$channelFee= $data['data']['channelFee'];
	$accountFromName= $data['data']['accountFromName'];
	$accountTo= $data['data']['accountTo'];
	$accountToName= $data['data']['accountToName'];
	$accountToType= $data['data']['accountToType'];
	$accountToDisplayName= $data['data']['accountToDisplayName'];
	$accountToBankCode= $data['data']['accountToBankCode'];
	$pccTraceNo= $data['data']['pccTraceNo'];
	$transferType= $data['data']['transferType'];
	$feeType= $data['data']['feeType'];
	$terminalNo= $data['data']['terminalNo'];
	$sequence= $data['data']['sequence'];
	$transactionToken= $data['data']['transactionToken'];
	$bankRouting= $data['data']['bankRouting'];
	$fastpayFlag= $data['data']['fastpayFlag'];
	$ctReference= $data['data']['ctReference'];



	if ($transactionToken=="") {
		$data = array ('msg'=>$result['status']['description'],'status'=>500);
		echo json_encode($data);
		
		exit();
	}


	$header=array(
		'Api-Auth:  '.$Auth1,
		'Accept-Language: th',
		'user-agent:'.$this->useragent,
		'Content-Type: application/json; charset=UTF-8'
	);
	$data="{\"accountFrom\":\"$accountTo\",\"accountFromName\":\"" .$accountFromName. "\",\"accountFromType\":\"2\",\"accountTo\":\"" .$accountTo. "\",\"accountToBankCode\":\"" .$accountToBankCode. "\",\"accountToName\":\"" . $accountToName . "\",\"amount\":\"" . $amount . "\",\"botFee\":0.0,\"channelFee\":0.0,\"fee\":0.0,\"feeType\":\"\",\"pccTraceNo\":\"" . $pccTraceNo . "\",\"scbFee\":0.0,\"sequence\":\"" . $sequence. "\",\"terminalNo\":\"" . $terminalNo . "\",\"transactionToken\":\"" . $transactionToken. "\",\"transferType\":\"" . $transferType. "\"}";
	$response = $this->Curl("POST", 'https://fasteasy.scbeasy.com/v3/transfer/confirmation',$data,$header);

	return $response;


}



}
// $api = new scb($deviceId, $accountFrom,$pin,$encrypt,$host,$user,$pass,$db,$has_key);
// echo $api->transactions();

// echo $api->balance();

// echo $api->tranfers('4732082323','กสิกรไทย','0.1');