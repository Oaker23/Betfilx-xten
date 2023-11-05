<?php
error_reporting(0);
if (!isset($_SESSION)) {
	session_start();
}

if(@$_SESSION["phone"] != "") {
	echo " <script> window.location = './dashboard';</script>";
}

require 'config/config.php';

$phone = @$_GET['ref'];

$sql = 'SELECT * FROM  `website`';
$result = $server->query($sql);
$row = mysqli_fetch_assoc($result);

function get_client_ip() {
	$ipaddress = '';
	if (getenv('HTTP_CLIENT_IP'))
		$ipaddress = getenv('HTTP_CLIENT_IP');
	else if(getenv('HTTP_X_FORWARDED_FOR'))
		$ipaddress = getenv('HTTP_X_FORWARDED_FOR');
	else if(getenv('HTTP_X_FORWARDED'))
		$ipaddress = getenv('HTTP_X_FORWARDED');
	else if(getenv('HTTP_FORWARDED_FOR'))
		$ipaddress = getenv('HTTP_FORWARDED_FOR');
	else if(getenv('HTTP_FORWARDED'))
		$ipaddress = getenv('HTTP_FORWARDED');
	else if(getenv('REMOTE_ADDR'))
		$ipaddress = getenv('REMOTE_ADDR');
	else
		$ipaddress = 'UNKNOWN';
	return $ipaddress;
}



?>

<!doctype html>
	<html lang="th">

	<head>
		<?php include("template/info.php"); ?>
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css">
		<!-- core CSS -->
		<link href="public/css/bootstrap.min.css" rel="stylesheet">
		<link href="public/css/hover.css" rel="stylesheet">
		<link href="public/css/animate.css" rel="stylesheet">
		<link href="public/icons/icon.min.css" rel="stylesheet">
		<link href="public/css/thbank/thbanklogos.css" rel="stylesheet">
		<link href="public/css/thbank/thbanklogos-colors.css" rel="stylesheet">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.0-beta/css/bootstrap-select.min.css" />

		<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
		<!-- Custom styles -->
		<link href="public/css/style-dashboardv6.css?v=1.01" rel="stylesheet">




		<style>
		.share-list i {
			color: #212529;
		}
	</style>

	<script>
		window.siteUrl = '';
	</script>

</head>

<body class="animated fadeIn fast">

	<div>
		<div>
			<?php 
			require 'header.php';
			?>
			<section class="slide">
				<div class="slide-img d-none d-md-block"><img src="" alt=""></div>
				<div class="slide-img d-block d-md-none"><img src="" alt=""></div>
			</section>

			<div id="app">
				<main role="main">
					<div class="container content" v-cloak>
						<section class="user-bank">
							<div class="card">

								<h5 class="card-header"><i class="fas fa-user-lock fa-sm"></i> เข้าสู่ระบบ</h5>

								<div class="card-body" align="center">

									<div class="form-group">
										<label class="float-left">เบอร์มือถือ</label>
										<input type="text" class="form-control form-control-lg" id="phone" aria-describedby="เบอร์มือถือ" placeholder="เบอร์มือถือ">
									</div>
									<div class="form-group">
									<!-- <a href="https://betflix.com/contact" class="float-right forgot">ลืมรหัสผ่าน??</a>
										<label class="float-left">รหัสผ่าน</label> -->
										<label class="float-left">รหัสผ่าน</label>
										<input type="password" class="form-control form-control-lg" id="password" placeholder="รหัสผ่าน">
									</div>
									<div class="form-check">
										<input type="checkbox" class="form-check-input" id="exampleCheck1">
										<label class="form-check-label " for="exampleCheck1">จดจำฉัน</label>
									</div>
									<div class="form-group"><button  class="btn-red btn-lg btn-block" onclick="login()"><i class="fas fa-sign-in-alt fa-sm"></i> 
									เข้าสู่ระบบ </button></div>
									<div class="form-group"><button  class="btn-success btn-lg btn-block" onclick="location.href='./register';"><i class="far fa-user-plus fa-sm"></i> 
									สมัครสมาชิก </button></div>


								</div>
							</div>

						</section>

					</div>
				</main>

				<?php 
				require 'footer.php';
				?>
			</div>
			<div class="loader-wrapper">
				<span class="loader"><span class="loader-inner"></span></span>
			</div>

			<script>

				window.onload = function(){
					var affiliate = localStorage.getItem("aff");
					console.log(affiliate)
					


					localStorage.setItem("ref", '<?php echo $phone; ?>');
					var ref = localStorage.getItem("ref");

					document.getElementById('phone').value =localStorage.getItem('phone');
					document.getElementById('password').value =localStorage.getItem('password');
				}


				function save_username(){
					var username=$("#phone").val();
					localStorage.setItem("phone", username);

				}

				function save_password(){
					var password=$("#password").val();
					localStorage.setItem("password", password);
				}



				function login() {
					var affiliate = localStorage.getItem("aff");

					console.log(affiliate)
					save_username()
					save_password()
					var phone=$("#phone").val();
					var password=$("#password").val();

					if (phone=="") {
						Swal.fire({
							icon: 'error',
							title: 'แจ้งเตือน...',
							text:'กรุณากรอก เบอร์โทรศัพท์'

						})
						return false
					} else if (password=="") {
						Swal.fire({
							icon: 'error',
							title: 'แจ้งเตือน...',
							text:'กรุณากรอก รหัสผ่าน'

						})
						return false
					}

					$.ajax({
						url:'action.php?login',
						type:'POST',
						data:{
							phone:phone,
							password:password
						},

						success:function(data){
						// console.log(data);
						if (data!="") {
							var obj = JSON.parse(data);
							var msg=obj.msg
							var status=obj.status
							if (status==200) {
								if (affiliate==1) {
									location.replace("./affiliate/manager.php");
									return false
								}
								location.replace("./dashboard");
							}else{
								Swal.fire({
									icon: 'error',
									title: msg,
									// text: "ชื่อผู้ใช้ หรือ รหัสผ่านไม่ถูกต้อง"

								})
							}

						}


					}

				});
				}


			</script>

			<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
			<script>
				window.jQuery || document.write('<script src="assets/js/vendor/jquery-slim.min.js"><\/script>')
			</script>
			<script src="public/js/vendor/popper.min.js"></script>
			<script src="public/js/bootstrap.min.js"></script>
			<script src="public/js/vendor/holder.min.js"></script>
			<script src="public/js/v20/app.js"></script>
			<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.0-beta/js/bootstrap-select.min.js"></script>
			<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.6.0/slick.js"></script>
			<script async src="https://www.googletagmanager.com/gtag/js?id=UA-155235476-1"></script>
			<script>
				$(window).on("load",function(){
					$(".loader-wrapper").fadeOut("slow");
				});
			</script>

		</body>

		</html>