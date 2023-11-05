<?php
if (!isset($_SESSION)) {
	session_start();
}

include("../config/config.php");

if($_SESSION["username"] == "") {

	echo " <script> window.location = './login';</script>";
	exit();
}



$query = $server->query('SELECT * FROM withdraw WHERE status = 1');
$alert = $query->num_rows;

$query = $server->query('SELECT * FROM `refill` WHERE phone=""');
$alert1 = $query->num_rows;

$sql = 'SELECT * FROM  `admin` where username="'.$_SESSION["username"].'"';
$result = $server->query($sql);
$row = mysqli_fetch_assoc($result);
$catogory=$row['category'];
$status_admin=$row['status'];
$catogory_arr = explode (",", $catogory);

// print_r($catogory);
// preg_match('/1(?=,)/', $catogory, $output_array);
// print_r($output_array);

function catogory_search($page_id,$catogory_arr){
	foreach ($catogory_arr as $key => $value) {
		if($value == $page_id){
			return true;
		}
	}
	return false;
}

if($_GET['page']=='dashboard'){
	if(!catogory_search(1,$catogory_arr)){
		header( "location: ./main.php" );
	}
}

?>


<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>ระบบจัดการ หลังบ้าน</title>
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
	<link rel="stylesheet" href="css/custom.css?v=1.02">
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
	<!-- Favicon-->
	<link rel="shortcut icon" href="img/favicon.png">
	<link rel="stylesheet" href="css/jquery.loadingModal.css">
	<link rel="stylesheet" type="text/css" href="include/loading.css" />
	<link rel="stylesheet" href="css/jquery.loadingModal.css">
	<link rel="stylesheet" href="dist/css/picker.min.css">


</head>

<body>

	<audio id="audio" src="./mixkit-security-facility-breach-alarm-994.wav"></audio>

	<div class="loader-wrapper">
		<span class="loader"><span class="loader-inner"></span></span>
	</div>
	<!-- navbar-->
	<header class="header">
		<nav class="navbar navbar-expand-lg px-4 py-2 bg-white shadow"><a class="sidebar-toggler text-gray-500 me-4 me-lg-5 lead" href="#"><i class="fas fa-align-left"></i></a><a class="navbar-brand fw-bold text-uppercase text-base" href="index.html"><span class="d-none d-brand-partial">ระบบ </span><span class="d-none d-sm-inline">หลังบ้าน</span></a>
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
			<h6 class="sidebar-heading"><?php echo "ADMIN ".$_SESSION["username"]; ?> </h6>
			<ul class="list-unstyled">
				<li 		<?php
				if (catogory_search(1,$catogory_arr)) {

					echo "style='display:block;'";
				}else{
					echo "style='display:none;'";
				}

			?> class="sidebar-list-item"><a class="sidebar-link text-muted <?php  if($_GET['page']=='dashboard'){ echo "active"; } ?> " href="main.php?page=dashboard">
				<i class="fas fa-chart-pie fa-lg"></i>
				<span class="sidebar-link-title"> &nbsp;&nbsp;รายงานผลรวม</span></a>
			</li>

			<li		<?php
			if (catogory_search(2,$catogory_arr)) {

				echo "style='display:block;'";
			}else{
				echo "style='display:none;'";
			} ?> 
			class="sidebar-list-item act"><a class="sidebar-link text-muted <?php  if($_GET['page']=='admin'){ echo "active"; } ?> " href="main.php?page=admin">
				<i class="fas fa-user-shield fa-lg"></i>
				<span class="sidebar-link-title"> &nbsp;&nbsp;จัดการ ผู้ดูแล</span></a>
			</li>


			<li 		<?php 
			if (catogory_search(3,$catogory_arr)) {

				echo "style='display:block;'";
			}else{
				echo "style='display:none;'";
			}
		?> class="sidebar-list-item"><a class="sidebar-link text-muted <?php  if($_GET['page']=='member'){ echo "active"; } ?> " href="main.php?page=member">
			<i class="fas fa-users-cog fa-lg"></i>
			<span class="sidebar-link-title "> &nbsp;&nbsp;จัดการ สมาชิก</span></a>
		</li>

		<li 		<?php 
		if (catogory_search(4,$catogory_arr)) {

			echo "style='display:block;'";
		}else{
			echo "style='display:none;'";
		} ?> class="sidebar-list-item"><a class="sidebar-link text-muted <?php  if($_GET['page']=='bonus'){ echo "active"; } ?>" href="main.php?page=bonus">
			<i class="fas fa-gift fa-lg"></i>
			<span class="sidebar-link-title"> &nbsp;&nbsp;จัดการ โปรโมชั่น</span></a>
		</li>

		<li		<?php
		if (catogory_search(5,$catogory_arr)) {

			echo "style='display:block;'";
		}else{
			echo "style='display:none;'";
		} ?> class="sidebar-list-item"><a class="sidebar-link text-muted <?php  if($_GET['page']=='website'){ echo "active"; } ?>" href="main.php?page=website">
			<i class="fas fa-cogs fa-lg"></i>
			<span class="sidebar-link-title">&nbsp;&nbsp;จัดการ ข้อมูลเว็บ</span></a>
		</li>

		<li 		<?php 
		if (catogory_search(6,$catogory_arr)) {

			echo "style='display:block;'";
		}else{
			echo "style='display:none;'";
		} ?>class="sidebar-list-item"><a class="sidebar-link text-muted <?php  if($_GET['page']=='line'){ echo "active"; } ?>" href="main.php?page=line">
			<i class="fab fa-line fa-lg"></i>
			<span class="sidebar-link-title">&nbsp;&nbsp;จัดการ LINE Alert</span></a>
		</li>

		<li 		<?php 
		if (catogory_search(7,$catogory_arr)) {

			echo "style='display:block;'";
		}else{
			echo "style='display:none;'";
		} ?> class="sidebar-list-item"><a class="sidebar-link text-muted <?php  if($_GET['page']=='bankinfo'){ echo "active"; } ?>" href="main.php?page=bankinfo">
			<i class="fas fa-piggy-bank fa-lg"></i>
			<span class="sidebar-link-title">&nbsp;&nbsp;จัดการ ธนาคาร</span></a>
		</li>


		<li 		<?php 
		if (catogory_search(8,$catogory_arr)) {

			echo "style='display:block;'";
		}else{
			echo "style='display:none;'";
		} ?>class="sidebar-list-item"><a class="sidebar-link text-muted <?php  if($_GET['page']=='reportdeposit'){ echo "active"; } ?>" href="main.php?page=reportdeposit">
			<i class="fas fa-comments-dollar fa-lg"></i>
			<span class="sidebar-link-title">&nbsp;&nbsp;รายการ ฝากเงิน</span></a>
		</li>

		<li 		<?php 
		if (catogory_search(9,$catogory_arr)) {

			echo "style='display:block;'";
		}else{
			echo "style='display:none;'";
		} ?>class="sidebar-list-item"><a class="sidebar-link text-muted <?php  if($_GET['page']=='reportwithdraw'){ echo "active"; } ?>" href="main.php?page=reportwithdraw">
			<i class="fas fa-hand-holding-usd fa-lg"></i>
			<span class="sidebar-link-title">&nbsp;&nbsp;รายการ ถอนเงิน</span></a>
		</li>



		<li 		<?php 
		if (catogory_search(10,$catogory_arr)) {

			echo "style='display:block;'";
		}else{
			echo "style='display:none;'";
		} ?>class="sidebar-list-item"><a class="sidebar-link text-muted <?php  if($_GET['page']=='depositalert'){ echo "active"; } ?>" href="main.php?page=depositalert">
			<i class="fas fa-bomb fa-lg"></i>
			<span class="sidebar-link-title">ยอดฝาก ไม่สำเร็จ</span>&nbsp;&nbsp; <span id="depositalert" class="badge bg-danger"><?php echo $alert1; ?></span></a>

		</li>

		<li 		<?php 
		if (catogory_search(11,$catogory_arr)) {

			echo "style='display:block;'";
		}else{
			echo "style='display:none;'";
		} ?> class="sidebar-list-item"><a class="sidebar-link text-muted <?php  if($_GET['page']=='withdraw'){ echo "active"; } ?>" href="main.php?page=withdraw">
			<i class="fas fa-bell fa-lg"></i>
			<span  class="sidebar-link-title">&nbsp;ลูกค้าแจ้ง ถอนเงิน</span>&nbsp;&nbsp; <span id="withdraw_alert" class="badge bg-danger"><?php echo $alert; ?></span></a>

		</li>

		<li 		<?php 
		if (catogory_search(12,$catogory_arr)) {

			echo "style='display:block;'";
		}else{
			echo "style='display:none;'";
		} ?>class="sidebar-list-item"><a class="sidebar-link text-muted <?php  if($_GET['page']=='code'){ echo "active"; } ?>" href="main.php?page=code">
			<i class="fas fa-code fa-lg"></i>
			<span class="sidebar-link-title"> &nbsp;สร้างโค้ด แจกเครดิต</span></a>
		</li>
		
		<li        <?php
		if (catogory_search(13,$catogory_arr)) {

			echo "style='display:block;'";
		}else{
			echo "style='display:none;'";
		} ?>class="sidebar-list-item"><a class="sidebar-link text-muted <?php  if($_GET['page']=='playwheel'){ echo "active"; } ?>" href="main.php?page=playwheel">
			<i class="fas fa-code fa-lg"></i>
					<span class="sidebar-link-title">&nbsp;&nbsp;สมาชิก หมุนวงล้อ</span></a>
		</li>

<!-- 		<li 		<?php 
		if (catogory_search(14,$catogory_arr)) {

			echo "style='display:block;'";
		}else{
			echo "style='display:none;'";
		} ?>class="sidebar-list-item"><a class="sidebar-link text-muted " href="main.php?page=popup">
			<i class="fas fa-bell-slash fa-lg"></i>
			<span class="sidebar-link-title"> &nbsp;ตั้งค่าป๊อปอัพ popup</span></a>
		</li>
	-->

	<li 		<?php 
	if (catogory_search(14,$catogory_arr)) {

		echo "style='display:block;'";
	}else{
		echo "style='display:none;'";
	} ?>class="sidebar-list-item"><a class="sidebar-link text-muted <?php  if($_GET['page']=='cronjob'){ echo "active"; } ?>" href="main.php?page=cronjob">
		<i class="fas fa-sliders-h fa-lg"></i>
		<span class="sidebar-link-title"> &nbsp;  cronjob</span></a>
	</li>

	<li 		<?php
	if (catogory_search(18,$catogory_arr)) {
		echo "style='display:block;'";
	}else{
		echo "style='display:none;'";
	} ?>class="sidebar-list-item"><a class="sidebar-link text-muted <?php  if($_GET['page']=='slider'){ echo "active"; } ?>" href="main.php?page=slider">
		<i class="fas fa-cogs fa-lg"></i>
		<span class="sidebar-link-title"> &nbsp;จัดการ slider</span></a>
	</li>

	<!-- <li 		<?php
	if (catogory_search(20,$catogory_arr)) {
		echo "style='display:block;'";
	}else{
		echo "style='display:none;'";
	} ?>class="sidebar-list-item"><a class="sidebar-link text-muted <?php  if($_GET['page']=='gamesetting'){ echo "active"; } ?>" href="main.php?page=gamesetting">
		<i class="fa fa-fw fa-gamepad"></i>
		<span class="sidebar-link-title"> &nbsp;ตั้งค่าเกม</span></a>
	</li> -->

	<li 		<?php
	if (catogory_search(19,$catogory_arr)) {
		echo "style='display:block;'";
	}else{
		echo "style='display:none;'";
	} ?>class="sidebar-list-item"><a class="sidebar-link text-muted <?php  if($_GET['page']=='log_admin'){ echo "active"; } ?>" href="main.php?page=log_admin">
		<i class="fas fa-chart-bar fa-lg"></i>
		<span class="sidebar-link-title"> &nbsp;ประวัติแอดมิน</span></a>
	</li>

	<li 		<?php
	if (catogory_search(21,$catogory_arr)) {
		echo "style='display:block;'";
	}else{
		echo "style='display:none;'";
	} ?>class="sidebar-list-item"><a class="sidebar-link text-muted <?php  if($_GET['page']=='log_member'){ echo "active"; } ?>" href="main.php?page=log_member">
		<i class="fas fa-chart-bar fa-lg"></i>
		<span class="sidebar-link-title"> &nbsp;ประวัติผู้ใช้</span></a>
	</li>


</div>

<!-- conten-->
<?php


if ($_GET["page"] == '') {
	// include 'dashboard.php';
} elseif ($_GET["page"] == 'member') {
	include 'member.php';
} elseif ($_GET["page"] == 'bonus1') {
	include 'bonus1.php';
} elseif ($_GET["page"] == 'admin') {
	include 'admin.php';
} elseif ($_GET["page"] == 'dashboard') {
	include 'dashboard.php';
} elseif ($_GET["page"] == 'code') {
	include 'code.php';
} elseif ($_GET["page"] == 'bonus') {
	include 'bonus.php';
} elseif ($_GET["page"] == 'website') {
	include 'website.php';
} elseif ($_GET["page"] == 'line') {
	include 'line.php';
} elseif ($_GET["page"] == 'reportdeposit') {
	include 'reportdeposit.php';
} elseif ($_GET["page"] == 'reportwithdraw') {
	include 'reportwithdraw.php';
} elseif ($_GET["page"] == 'withdraw') {
	include 'withdraw.php';
} elseif ($_GET["page"] == 'reportbonus') {
	include 'reportbonus.php';
} elseif ($_GET["page"] == 'reportrefund') {
	include 'reportrefund.php';
} elseif ($_GET["page"] == 'reportaffliliate') {
	include 'reportaffliliate.php';
} elseif ($_GET["page"] == 'bankinfo') {
	include 'bankinfo.php';
} elseif ($_GET["page"] == 'depositalert') {
	include 'depositalert.php';
} elseif ($_GET["page"] == 'playwheel') {
	include 'playwheel.php';
} elseif ($_GET["page"] == 'cronjob') {
	include 'cronjob.php';
} elseif ($_GET["page"] == 'popup') {
	include 'popup.php';
} elseif ($_GET["page"] == 'slider') {
	include 'slider.php';
} elseif ($_GET["page"] == 'log_admin') {
	include 'log_admin.php';
} elseif ($_GET["page"] == 'log_member') {
	include 'log_member.php';
} elseif ($_GET["page"] == 'gamesetting') {
	include 'gamesetting.php';
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
<script src="dist/js/picker.min.js"></script>



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

	
	function play() {
		var audio = new Audio('https://qbabet-th.com/manager/notification.mp3');
		audio.play();
	}


	setInterval(function(){
		$.ajax({
			url:'action.php?withdraw_alert',
			success:function(data){
				if (data!="") {
					var obj = JSON.parse(data);
					var status=obj.status
					var msg=obj.msg
					if (msg>=1) {
						console.log(data)
						play()
					}

				}

			}

		});

	}, 3000);



	Prism.plugins.NormalizeWhitespace.setDefaults({
		'remove-trailing': true,
		'remove-indent': true,
		'left-trim': true,
		'right-trim': true,
	});





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

	function showModal() {
		$('body').loadingModal({text: 'กำหลังโหลด...'});
		var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
		var time = 2000;
		delay(time)
	}
</script>

<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
<script src="js/jquery.loadingModal.js"></script>
</body>

</html>