<?php
error_reporting(0);

class mamanee {

	private $pin;
	private $walletId;
	private $deviceId;
	private $tilesVersion='48';
	private $useragent='Android/10;FastEasy/3.51/5423';
	private $encrypt;
	private $host;
	private $user;
	private $pass;
	private $db;
	private $haskey;
	private $accountFrom;
	public function __construct($deviceId,$accountFrom, $walletId,$pin,$encrypt,$host,$user,$pass,$db,$has_key)
	{
		$this->deviceId = $deviceId;
		$this->accountFrom = $accountFrom;
		$this->walletId = $walletId;
		$this->pin = $pin;
		$this->encrypt = $encrypt;
		$this->host = $host;
		$this->user = $user;
		$this->pass = $pass;
		$this->db = $db;
		$this->has_key = $has_key;
	}


	
	public function Curl($method, $url, $data,$header)	{

		if ($url=='https://fasteasy.scbeasy.com:8443/v3/login/preloadandresumecheck' or $url=='https://fasteasy.scbeasy.com/v3/login') {
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
	$header=array(
		'Accept-Language:      th',
		'scb-channel:  APP',
		'user-agent:'.$this->useragent,
		'Content-Type:  application/json; charset=UTF-8',
		'Hos:  fasteasy.scbeasy.com:8443',
		'Connection:  close',
	);
	$data='{"isLoadGeneralConsent":"1","deviceId":"'.$this->deviceId.'","userMode":"INDIVIDUAL","tilesVersion":"'.$this->tilesVersion.'","jailbreak":"0"}';
	$res = $this->Curl("POST", 'https://fasteasy.scbeasy.com:8443/v3/login/preloadandresumecheck',$data,$header);

	preg_match_all('/(?<=Api-Auth: ).+/', $res, $Auth);
	$Auth=$Auth[0][0];

	if ($Auth=="") {
		$data = array ('msg'=>'ระบบมีปัญหา กรุณาแจ้งแอดมิน Auth error','status'=>500);
		echo json_encode($data);
		exit();
	}

	$header=array(
		'Api-Auth: '.$Auth,
		'Content-Type: application/json',
	);
	$data='{"loginModuleId":"PseudoFE"}';
	$response1 = $this->Curl("POST", 'https://fasteasy.scbeasy.com/isprint/soap/preAuth',$data,$header);

	$data = json_decode($response1,true);

	$hashType=$data['e2ee']['pseudoOaepHashAlgo'];
	$Sid=$data['e2ee']['pseudoSid'];
	$ServerRandom=$data['e2ee']['pseudoRandom'];
	$pubKey=$data['e2ee']['pseudoPubKey'];


	$header=array("Content-Type: application/x-www-form-urlencoded");
	$data="Sid=".$Sid."&ServerRandom=".$ServerRandom."&pubKey=".$pubKey."&pin=".$this->pin."&hashType=".$hashType;
	$response = $this->Curl("POST", $this->encrypt,$data,$header);

	$header=array(
		'Api-Auth: '.$Auth,
		'Content-Type: application/json',
	);
	$data='{"deviceId":"'.$this->deviceId.'","pseudoPin":"'.$response.'","pseudoSid":"'.$Sid.'"}';
	$response_auth = $this->Curl("POST", 'https://fasteasy.scbeasy.com/v3/login',$data,$header);
	preg_match_all('/(?<=Api-Auth:).+/', $response_auth, $Auth_result);
	$Auth1=$Auth_result[0][0];



	if ($Auth1=="") {
		$data = array ('msg'=>'ระบบมีปัญหา กรุณาแจ้งแอดมิน Auth error','status'=>500);
		echo json_encode($data);
		exit();

	}


	$this->insert_sql("UPDATE `scb_info` SET `token`='".$this->encrypt($Auth1)."' WHERE banknumber='".$this->accountFrom."'");



}


public function transactions()  {

	 $Auth1= $this->toekn();
	

	$startDate=date('Y-m-d', strtotime("-1 day"));
	$endDate = date('Y-m-d');

	$data='{"walletList":[{"walletId":"'.$this->walletId.'","endDate":"'.$endDate.'","pageSize":"20","startDate":"'.$startDate.'","pageNumber":"1"}]}';
	$header=array('scb-channel:  APP','Api-Auth: '.$Auth1,'Content-Type: application/json; charset=UTF-8');
	$response = $this->Curl("POST", 'https://fasteasy.scbeasy.com/v1/merchants/transactions',$data, $header);

	$result=json_decode($response,true);
	$status=$result['status']['code'];
	if ($status==1002) {
		$this->login();
		$Auth1= $this->toekn();
		$data='{"walletList":[{"walletId":"'.$this->walletId.'","endDate":"'.$endDate.'","pageSize":"20","startDate":"'.$startDate.'","pageNumber":"1"}]}';
		$header=array('scb-channel:  APP','Api-Auth: '.$Auth1,'Content-Type: application/json; charset=UTF-8');
		$response = $this->Curl("POST", 'https://fasteasy.scbeasy.com/v1/merchants/transactions',$data, $header);
		
	}
	return $response;
}





}



// echo $api->qrCode_generator('00020101021254041.0030770016A000000677010112011501075360001028602150140000040428750315aAw2323203dsfgt53037645802TH63049BBC');


// $api = new mamanee();
//  $data = json_decode($api->genQr('19','ref001'),true);
// print_r($data);
 // $api = new mamanee();

// echo $api->transactions();

?>
