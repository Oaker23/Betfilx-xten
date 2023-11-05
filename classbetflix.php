
<?php
error_reporting(0);
class imi {
	private $timestamp;
	private $agent;
	public function milliseconds() {
		$mt = explode(' ', microtime());
		return ((int)$mt[1]) * 1000 + ((int)round($mt[0] * 1000));
	}

	public function __construct($agent,$key = array()) {
    $this->timestamp=$this->milliseconds(); //ใา่ url ให้ตรง
    $this->agent = $agent;
    $this->key = $key;
  }

  public function Curl($method, $url, $data)  {
  	$curl = curl_init();
  	curl_setopt_array($curl, array(
  		CURLOPT_URL => $url,
  		CURLOPT_RETURNTRANSFER => true,
  		CURLOPT_ENCODING => '',
  		CURLOPT_TIMEOUT=> 10,
  		CURLOPT_MAXREDIRS => 10,
  		CURLOPT_FOLLOWLOCATION => true,
  		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  		CURLOPT_CUSTOMREQUEST => $method,
  		CURLOPT_POSTFIELDS =>$data,
  		CURLOPT_HTTPHEADER => $this->key,
  	));

  	$response = curl_exec($curl);
  	curl_close($curl);
  	return  $response;

  }

  public function register($username,$Fullname,$Password,$Mobile){
  	$data='username='.$username.'&password='.$Password.'&name'.$Fullname.'=&tel'.$Mobile.'=&note=';
  	$res = $this->Curl("POST", 'https://api.bfx.fail/v4/user/register', $data);
  	return $res;
  }

  public function get_balance($username){
  	$data='username='.$this->agent.$username.'';
  	$res = $this->Curl("POST", 'https://api.bfx.fail/v4/user/balance', $data);
  	return $res;
  }

  public function deposit_alert($username,$Amount,$ref){

    
    $Amount=str_replace(",","",$Amount);
    $data='username='.$this->agent.$username.'&amount='.$Amount.'&ref='.$ref.'';
    $res = $this->Curl("POST", 'https://api.bfx.fail/v4/user/transfer', $data);
    return $res;
  }


  public function deposit_aff($username,$Amount,$ref){
    $Amount=str_replace(",","",$Amount);
    $data='username='.$this->agent.$username.'&amount='.$Amount.'&ref='.$ref.'';
    $res = $this->Curl("POST", 'https://api.bfx.fail/v4/user/transfer', $data);
    return $res;
  }

  public function deposit_refund($username,$Amount,$ref){
    $Amount=str_replace(",","",$Amount);
    $data='username='.$this->agent.$username.'&amount='.$Amount.'&ref='.$ref.'';
    $res = $this->Curl("POST", 'https://api.bfx.fail/v4/user/transfer', $data);
    return $res;
  }



  public function deposit_admin($username,$Amount){

  	$ref='admin_'.time().$username;
  	$Amount=str_replace(",","",$Amount);
  	$data='username='.$this->agent.$username.'&amount='.$Amount.'&ref='.$ref.'';
  	$res = $this->Curl("POST", 'https://api.bfx.fail/v4/user/transfer', $data);
  	return $res;
  }

  public function deposit_bonus($username,$Amount,$ref){


    $Amount=str_replace(",","",$Amount);
    $data='username='.$this->agent.$username.'&amount='.$Amount.'&ref='.$ref.'';
    $res = $this->Curl("POST", 'https://api.bfx.fail/v4/user/transfer', $data);
    return $res;
  }


  public function deposit_spin($username,$Amount,$ref){
    $Amount=str_replace(",","",$Amount);
    $data='username='.$this->agent.$username.'&amount='.$Amount.'&ref='.$ref.'';
    $res = $this->Curl("POST", 'https://api.bfx.fail/v4/user/transfer', $data);
    return $res;
  }

  public function credit_free($username,$Amount){

    $ref='credit_free_'.time().'_'.$username;
    $Amount=str_replace(",","",$Amount);
    $data='username='.$this->agent.$username.'&amount='.$Amount.'&ref='.$ref.'';
    $res = $this->Curl("POST", 'https://api.bfx.fail/v4/user/transfer', $data);
    return $res;
  }

  public function deposit_ktb($username,$Amount,$ref){


    $Amount=str_replace(",","",$Amount);
    $data='username='.$this->agent.$username.'&amount='.$Amount.'&ref='.$ref.'';
    $res = $this->Curl("POST", 'https://api.bfx.fail/v4/user/transfer', $data);
    return $res;
  }

  public function deposit_scb($username,$Amount,$ref){


    $Amount=str_replace(",","",$Amount);
    $data='username='.$this->agent.$username.'&amount='.$Amount.'&ref='.$ref.'';
    $res = $this->Curl("POST", 'https://api.bfx.fail/v4/user/transfer', $data);
    return $res;
  }


  public function withdraw($username,$Amount){
   
    $ref='wd-'.time().$username;
    $Amount=str_replace(",","",$Amount);
    $data='username='.$this->agent.$username.'&amount=-'.$Amount.'&ref='.$ref.'';
    $res = $this->Curl("POST", 'https://api.bfx.fail/v4/user/transfer', $data);
    return $res;
  }




  public function Turnover($username){
    date_default_timezone_set("Asia/Bangkok");
    $StartDate=date("Y-m-d");
    $EndDate = date('Y-m-d');

    
    $res = $this->Curl("GET", 'https://api.bfx.fail/v4/report/summary?username='.$this->agent.$username.'&start='.$StartDate.'&end='.$EndDate, $data);
    $data = json_decode($res,true);
    return $data;
     // return $data['data']['turnover'];
  }



  public function Winlose($username,$StartDate){

    $res = $this->Curl("GET", 'https://api.bfx.fail/v4/report/summary?username='.$this->agent.$username.'&start='.$StartDate.'&end='.$StartDate, $data);
     $data = json_decode($res,true);
    return $data;
     // return $data['data']['winloss'];

  }
  
  public function report($username){
  	date_default_timezone_set("Asia/Bangkok");
  	$startDate=date("Y-m-d");
  	$endDate = date('Y-m-d', strtotime("+1 day"));


  	$res = $this->Curl("GET", 'https://api.bfx.fail/v4/report/summary2?username='.$this->agent.trim($username).'&start='.$startDate.'&end='.$endDate, $data);
  	
  	$data = json_decode($res,true);
  	return $data['data'];

  }


  public function report1($username,$startDate){
  	$res = $this->Curl("GET", 'https://api.bfx.fail/v4/report/summary2?username='.$this->agent.trim($username).'&start='.$startDate.'&end='.$startDate, $data);
  	
  	$data = json_decode($res,true);
  	return $data['data'];

  }


  public function edit($username,$name,$tel){
  	$data='username='.$this->agent.$username.'&name='.$name.'&note=&tel='.$tel;
  	$res = $this->Curl("POST", 'https://api.bfx.fail/v4/user/edit', $data);


  	return $res;
  }

  public function play($username,$provider,$gamecode,$language,$openGame,$returnUrl){
    $data='username='.$this->agent.$username.'&provider='.$provider.'&gamecode='.$gamecode.'&language='.$language.'&openGame='.$openGame.'&returnUrl='.$returnUrl;


    $res = $this->Curl("POST", 'https://api.bfx.fail/v4/play/login', $data);
    return   $res;
    
  }

  public function balance_agent(){
    
   $res = $this->Curl("GET", 'https://api.bfx.fail/v4/agent/balance?upline='.$this->agent.$username,null);
   
   $data = json_decode($res,true);
   return $data['data']['total_credit'];
   
 }



}


//echo $api->withdraw('g5fd5','2');
// echo $api->Turnover('59ct9');

