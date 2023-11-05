<?php
if (!isset($_SESSION)) {
	session_start();
}


include("../config/config.php");
include("../config/config_data.php");

if($_SESSION["username"] == "") {

  echo " <script> window.open('./login');</script>";

  exit();
}

$id=$_GET['id'];
$sql = 'SELECT * FROM `member` WHERE id="'.$id.'"';
$result = $server->query($sql);
$row = mysqli_fetch_assoc($result);
$phone=$row['phone'];
$username_game=$row['username_game'];


$sql_website = "SELECT * FROM website";

$result_website = $server->query($sql_website);
$row_website = mysqli_fetch_assoc($result_website);
$agent_username=$row_website['agent_username'];

$percen=$row['affliliate_percen'];

if ($percen=="") {
	$percen=$row_website['affliliate_percen'];
}



$page=$_GET['page'];

if ($page=='info') {
include 'api_betflix.php';
$data = json_decode($api->get_balance($row['username_game']),true);
$amount=$data['data']['balance'];
$amount =str_replace(",","", $amount);

$date_now=date('Y-m-d');
$refund=$api->Winlose($row['username_game'],$date_now,$date_now);
if ($refund=="") {
	$refund='0.00';
}


}




$sql_user="SELECT * FROM  `member` WHERE `refid`='" . $row['username_game'] . "' and phone!='" . $phone . "'";
$result_user = $server->query($sql_user);
$res_user=[];
$json=[];
$memberall=[];
date_default_timezone_set('Asia/Bangkok');
$date_now=date("Y-m-d");
foreach ($result_user as  $value) {
	array_push($res_user,$value);
	$check_date= $value['date_refund'];
	if ($check_date!=$date_now) {
		array_push($json, array("username_game" => $value['username_game'] ));
	}

  array_push($memberall, $value);

}

$ref_total=count($res_user);



$sql_aff = "SELECT * FROM log_affliliate WHERE phone='".$phone."' ORDER by id DESC";
$result_aff = $server->query($sql_aff);
$res_aff=[];
foreach ($result_aff as  $value) {
	array_push($res_aff, $value);

}

$check_aff=count($res_aff);



$sql_rfid = "SELECT * FROM refill WHERE phone='".$phone."' or username_game = '".$username_game."'  ORDER by id DESC";
$result_rfid = $server->query($sql_rfid);
$res=[];
$res_bydate=[];
$res_all_amount=0;
$index_add_bydate= 0;
foreach ($result_rfid as  $value) {
	array_push($res, $value);

	//add res_bydate
	if(count($res_bydate) > 0){
		// foreach ($res_bydate as $value2) {
			if($res_bydate[$index_add_bydate]['date_check'] == $value['date_check']){
				$res_bydate[$index_add_bydate]['amount'] += $value['amount'];
			}else{
				$bydate = array("date_check" => $value['date_check'],"amount" => $value['amount']);
				array_push($res_bydate, $bydate);
				$index_add_bydate++;
			}
		// }
	}else{
		$bydate = array("date_check" => $value['date_check'],"amount" => $value['amount']);
		array_push($res_bydate, $bydate);
	}

	//sum
	$res_all_amount += $value['amount'];
}

$check_deposit=count($res);

$sql_rfid1 = "SELECT * FROM withdraw WHERE phone='".$phone."' ORDER by id DESC";
// $sql_rfid1 = "SELECT * FROM withdraw WHERE phone='".$_SESSION['phone']."' and status='0' ORDER by id DESC limit 5";
$result_rfid1 = $server->query($sql_rfid1);
$res1=[];
foreach ($result_rfid1 as  $value1) {
  array_push($res1, $value1);
  
}

$check1_withdraw=count($res1);


$sql_rfid2 = "SELECT * FROM history_promotion WHERE phone='".$phone."' ORDER by id DESC";
$result_rfid2 = $server->query($sql_rfid2);
$res2=[];
foreach ($result_rfid2 as  $value2) {
  array_push($res2, $value2);
  
}
$check_bonus=count($res2);


$sql_rfid3 = "SELECT * FROM history_refund WHERE phone='".$phone."' ORDER by id DESC";
$result_rfid3 = $server->query($sql_rfid3);
$res3=[];
foreach ($result_rfid3 as  $value3) {
  array_push($res3, $value3);
  
}
$check_refund3=count($res3);

$sql_rfid4 = "SELECT * FROM code_itme WHERE phone='".$phone."' ORDER by id DESC";
$result_rfid4 = $server->query($sql_rfid4);
$res4=[];
foreach ($result_rfid4 as  $value4) {
  array_push($res4, $value4);
  
}
$check_code4=count($res4);

$start=date("Y-m-d", strtotime("first day of this month"));
$end=date("Y-m-d", strtotime("last day of this month"));
$date_now=date('Y-m-d');

$deposit_all=0;
$wd_all=0;
foreach ($memberall as  $value) {
	$user_game=$value['username_game'];
	$sql_sum1 = "SELECT SUM(amount) as total_all FROM refill WHERE `username_game`='" . $user_game. "' AND amount>0 and phone!='' and date_check between '".$start."' and '".$end."'";
	$result_sum1 = $server->query($sql_sum1);
	$row__sum1 = mysqli_fetch_assoc($result_sum1);
  $total_all=$row__sum1['total_all']; //ยอดฝาก

  $deposit_all=$deposit_all+$total_all;


  $sql_totalwd_all = "SELECT SUM(credit) as totalwd_all FROM withdraw WHERE `username_game`='" . $user_game. "' AND credit>0 and phone!='' and date_withdraw between '".$start."' and '".$end."'";
  $result_totalwd_all = $server->query($sql_totalwd_all);
  $row_totalwd_all = mysqli_fetch_assoc($result_totalwd_all);
  $totalwd_all=$row_totalwd_all['totalwd_all'];
  $wd_all=$wd_all+$totalwd_all;



}

$sum=$deposit_all-$totalwd_all;
$profit=$sum*$percen/100;
preg_match('/-/', $profit, $output_array);

$check=$output_array[0];
if ($check=='-') {
	$profit=0;
}


$sql_pro = "SELECT * FROM refill WHERE phone='".$phone."' ORDER BY id DESC";
$result_pro = $server->query($sql_pro);
$row_pro = mysqli_fetch_assoc($result_pro);
$status_bonus=$row_pro['status_bonus'];
$id_pro=$row_pro['id'];

if ($status_bonus=="") {
$status_bonus=0;
}

?>



<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>ข้อมูล ผู้ใช้งาน <?php echo $phone; ?></title>
	<meta name="description" content="">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="robots" content="all,follow">
	<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> -->
	<!-- Google fonts - Popppins for copy-->
	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;700&amp;display=swap" rel="stylesheet">
	<!-- Prism Syntax Highlighting-->
	<link rel="stylesheet" href="vendor/prismjs/plugins/toolbar/prism-toolbar.css">
	<link rel="stylesheet" href="vendor/prismjs/themes/prism-okaidia.css">
	<!-- The Main Theme stylesheet (Contains also Bootstrap CSS)-->
	<link rel="stylesheet" href="css/style.default.css" id="theme-stylesheet">
	<!-- Custom stylesheet - for your changes-->
	<link rel="stylesheet" href="css/custom.css">
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
	<!-- Favicon-->
	<link rel="shortcut icon" href="img/favicon.png">
	<link rel="stylesheet" href="css/jquery.loadingModal.css">
	<link rel="stylesheet" type="text/css" href="include/loading.css" />
</head>

<body>
	<div class="loader-wrapper">
		<span class="loader"><span class="loader-inner"></span></span>
	</div>
	<!-- navbar-->
	<header class="header">
		<nav class="navbar navbar-expand-lg px-4 py-2 bg-white shadow"><a class="sidebar-toggler text-gray-500 me-4 me-lg-5 lead" href="#"><i class="fas fa-align-left"></i></a><a class="navbar-brand fw-bold text-uppercase text-base" href="index.html"><span class="d-none d-brand-partial">ข้อมูล </span><span class="d-none d-sm-inline">ผู้ใช้งาน <?php echo $phone; ?></span></a>
			<ul class="ms-auto d-flex align-items-center list-unstyled mb-0">
				<li class="nav-item">
					<form class="ms-auto d-none d-lg-block" id="searchForm">
						<div class="form-group position-relative mb-0">
							<button class="position-absolute bg-white border-0 p-0" type="submit" style="top: -3px; left: 0;"><i class="o-search-magnify-1 text-gray-500 text-lg"></i></button>

						</div>
					</form>
				</li>


				<li class="nav-item dropdown ms-auto"><a class="nav-link pe-0" id="userInfo" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img class="avatar p-1" src="img/avatar-6.jpg" alt="Jason Doe"></a>
					<div class="dropdown-menu dropdown-menu-end" aria-labelledby="userInfo">

						<div class="dropdown-divider"></div><a class="dropdown-item" href="./action.php?logout">ออกจากระบบ</a>
					</div>
				</li>
			</ul>
		</nav>
	</header>
	<div class="d-flex align-items-stretch">
		<div class="sidebar py-3" id="sidebar">
			
			<ul class="list-unstyled">

				<li 		 class="sidebar-list-item"><a class="sidebar-link text-muted <?php  if($_GET['page']=='info'){ echo "active"; } ?> " href="member_data.php?page=info&id=<?php echo $id; ?>">
					<i class="fas fa-user-tie fa-lg"></i>
					<span class="sidebar-link-title"> &nbsp;&nbsp;ข้อมูลสมาชิก</span></a>
				</li>


				<li 		 class="sidebar-list-item"><a class="sidebar-link text-muted <?php  if($_GET['page']=='deposit'){ echo "active"; } ?> " href="member_data.php?page=deposit&id=<?php echo $id; ?>">
					<i class="fas fa-coins fa-lg"></i>
					<span class="sidebar-link-title"> &nbsp;&nbsp;สมาชิก ฝากเงิน</span></a>
				</li>

				<li		 class="sidebar-list-item act"><a class="sidebar-link text-muted <?php  if($_GET['page']=='withdraw'){ echo "active"; } ?> " href="member_data.php?page=withdraw&id=<?php echo $id; ?>">
					<i class="fas fa-hand-holding-usd fa-lg"></i>
					<span class="sidebar-link-title"> &nbsp;&nbsp;สมาชิก ถอนเงิน</span></a>
				</li>


				<li  class="sidebar-list-item"><a class="sidebar-link text-muted <?php  if($_GET['page']=='bonus'){ echo "active"; } ?> " href="member_data.php?page=bonus&id=<?php echo $id; ?>">
					<i class="fas fa-donate fa-lg"></i>
					<span class="sidebar-link-title "> &nbsp;&nbsp;สมาชิก รับโบนัส</span></a>
				</li>

				<li  class="sidebar-list-item"><a class="sidebar-link text-muted <?php  if($_GET['page']=='refund'){ echo "active"; } ?> " href="member_data.php?page=refund&id=<?php echo $id; ?>">
					<i class="fas fa-search-dollar fa-lg"></i>
					<span class="sidebar-link-title "> &nbsp;&nbsp;สมาชิก รับยอดเสีย</span></a>
				</li>

				<li  class="sidebar-list-item"><a class="sidebar-link text-muted <?php  if($_GET['page']=='code'){ echo "active"; } ?> " href="member_data.php?page=code&id=<?php echo $id; ?>">
					<i class="fas fa-comments-dollar fa-lg"></i>
					<span class="sidebar-link-title"> &nbsp;&nbsp;สมาชิก รับเครดิตฟรี</span></a>
				</li>

				
				<li  class="sidebar-list-item"><a class="sidebar-link text-muted <?php  if($_GET['page']=='affliliate'){ echo "active"; } ?> " href="member_data.php?page=affliliate&id=<?php echo $id; ?>">
					<i class="fas fa-comment-dollar fa-lg"></i>
					<span class="sidebar-link-title"> &nbsp;&nbsp;สมาชิก แนะนำเพื่อน</span></a>
				</li>


	<li  class="sidebar-list-item"><a class="sidebar-link text-muted <?php  if($_GET['page']=='affliliate_withdraw'){ echo "active"; } ?> " href="member_data.php?page=affliliate_withdraw&id=<?php echo $id; ?>">
					<i class="fas fa-comment-dollar fa-lg"></i>
					<span class="sidebar-link-title"> &nbsp;&nbsp;ถอนเงิน แนะนำเพื่อน</span></a>
				</li>

			</div>



			<!-- conten-->
			<?php

			
			if ($_GET["page"] == '') {
				include 'member_info.php';
			} elseif ($_GET["page"] == 'info') {
				include 'member_info.php';
			} elseif ($_GET["page"] == 'deposit') {
				include 'member_deposit.php';
			} elseif ($_GET["page"] == 'withdraw') {
				include 'member_withdraw.php';
			} elseif ($_GET["page"] == 'bonus') {
				include 'member_bonus.php';
			} elseif ($_GET["page"] == 'code') {
				include 'member_code.php';
			} elseif ($_GET["page"] == 'refund') {
				include 'member_refund.php';
			} elseif ($_GET["page"] == 'affliliate') {
				include 'member_affliliate.php';
					} elseif ($_GET["page"] == 'affliliate_withdraw') {
				include 'member_affliliate_withdraw.php';
			} else {

			}
			?>

			<!-- end-->
			

		</div>

		<script type="text/javascript">
			
		</script> 
		<!-- JavaScript files-->
		<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/js-cookie@2/src/js.cookie.min.js"></script>

		<script src="vendor/chart.js/Chart.min.js"></script>

		<script src="js/chartjs-dashboard.js"></script>
		<script src="js/chartjs-dashboard_bar.js"></script>



		<script src="js/theme.js"></script>
		<!-- Prism for syntax highlighting-->
		<script src="vendor/prismjs/prism.js"></script>
		<script src="vendor/prismjs/plugins/normalize-whitespace/prism-normalize-whitespace.min.js"></script>
		<script src="vendor/prismjs/plugins/toolbar/prism-toolbar.min.js"></script>
		<script src="vendor/prismjs/plugins/copy-to-clipboard/prism-copy-to-clipboard.min.js"></script>
		<script>
			$(window).on("load",function(){
				$(".loader-wrapper").fadeOut("slow");
			});
		</script>
		<script type="text/javascript">
			
			Prism.plugins.NormalizeWhitespace.setDefaults({
				'remove-trailing': true,
				'remove-indent': true,
				'left-trim': true,
				'right-trim': true,
			});


			function showModal() {
				$('body').loadingModal({text: 'กำหลังโหลด...'});
				var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
				var time = 2000;
				delay(time)
			}


		</script>
		<script>
			
			function injectSvgSprite(path) {

				var ajax = new XMLHttpRequest();
				ajax.open("GET", path, true);
				ajax.send();
				ajax.onload = function(e) {
					var div = document.createElement("div");
					div.className = 'd-none';
					div.innerHTML = ajax.responseText;
					document.body.insertBefore(div, document.body.childNodes[0]);
				}
			}
			
			injectSvgSprite('https://demo.bootstrapious.com/bubbly/1-0/icons/orion-svg-sprite.57a86639.svg');
		</script>

		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

	</body>

	</html>