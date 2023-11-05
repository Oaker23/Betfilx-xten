<?php
error_reporting(0);
if (!isset($_SESSION)) {
  session_start();
}
if($_SESSION["phone"] == "") {
  echo " <script> window.location = './login';</script>";
}

require 'config/config.php';


$sql = "SELECT * FROM member WHERE phone='".$_SESSION["phone"]."'";

$result = $server->query($sql);
$row = mysqli_fetch_assoc($result);
?>

<!doctype html>
<html lang="th">

<head>
<?php include("template/info.php"); ?>
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
	<!-- core CSS -->
	<link href="public/css/bootstrap.min.css" rel="stylesheet">
	<link href="public/css/hover.css" rel="stylesheet">
	<link href="public/css/animate.css" rel="stylesheet">
	<link href="public/icons/icon.min.css" rel="stylesheet">
	<link href="public/css/thbank/thbanklogos.css" rel="stylesheet">
	<link href="public/css/thbank/thbanklogos-colors.css" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.0-beta/css/bootstrap-select.min.css" />


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
		<?php 
		require 'header.php';
		?>
		<section class="slide">
			<div class="slide-img d-none d-md-block"><img src="public/images/slide-imgx.jpg?v=1" alt=""></div>
			<div class="slide-img d-block d-md-none"><img src="public/images/slide-img-mobile.jpg?v=1" alt=""></div>
		</section>

		<div id="app">
			<main role="main">
				<div class="container content" v-cloak>

				        <current-credit value="<?php echo $amount; ?>" link></current-credit>


					<section class="user-bank">
						<div class="card">
							<h5 class="card-header"><i class="fas fa-key fa-sm"></i> เปลี่ยนรหัสผ่าน</h5>
							<div class="card-body">

								<div class="form-group mt-3">
									
									<input type="text" class="form-control form-control-lg" id="newpass" aria-describedby="ยอดเงิน" placeholder="รหัสผ่านใหม่">
									<br>
									<input type="text" class="form-control form-control-lg" id="confrim" aria-describedby="ยอดเงิน" placeholder="ยืนยันรหัสผ่าน">
									<button  class="btn-danger btn-lg btn-block mt-2" onclick="chnag_pass()"><i class="fas fa-unlock-alt fa-sm"></i> 
									เปลี่ยนรหัสผ่าน </button>


								</div>

							</div>
						</div>
					</section>




					<section class="history-link mt-3">
						<div>
						<a
						href="http://line.me/ti/p/~<?php echo $rowInfo['line_id']; ?>"
						class="btn btn-block btn-line btn-lg mt-3 pt-2"
						>
						<i class="fab fa-line"></i> <br />
						LINE <?php echo $rowInfo['line_id']; ?>
					</a>
				</div>
				</section>


			</div>
		</main>

		
		<?php 
		require 'footer.php';
		?>
	</div>




	<script>

		function chnag_pass() {
			var phone="<?php echo $row['phone']; ?>";
			var newpass=$("#newpass").val();
			var confrim=$("#confrim").val();

			if (newpass!=confrim) {
				Swal.fire({
					icon: 'error',
					title: 'แจ้งเตือน...',
					text:'รหัสผ่านไม่ตรงกัน'

				})
				return false
			}

			if(confrim.length <5){
					Swal.fire({
					icon: 'error',
					title: 'แจ้งเตือน...',
					text:'รหัสผ่านต้อง6ตัวขึ้นไป'

				})
				return false
			}

			$.ajax({
				url:'action.php?chnag_pass',
				type:'POST',
				data:{
					phone:phone,
					confrim:confrim

				}, 

				success:function(data){	

					if (data!="") {
						var obj = JSON.parse(data);
						var msg=obj.msg
						var status=obj.status
						if (status==200) {
							Swal.fire({
								title: 'แจ้งเตือน!',
								text: msg,
								icon: 'success',
								showCancelButton: false,
								confirmButtonColor: '#3085d6',
								cancelButtonColor: '#d33',
								confirmButtonText: 'OK'
							}).then((result) => {
								if (result.value) {
									location.reload();

								}
							});
						}else{
							Swal.fire({
								icon: 'error',
								title: 'แจ้งเตือน...',
								text: msg

							})



						}

					}

				}


			});


		}


	</script>


        <!-- Bootstrap core JavaScript
        	================================================== -->
        	<!-- Placed at the end of the document so the pages load faster -->
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
        <!-- Global site tag (gtag.js) - Google Analytics 
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-154712426-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-154712426-1');
</script>
-->
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-155235476-1"></script>
<script>
	window.dataLayer = window.dataLayer || [];

	function gtag() {
		dataLayer.push(arguments);
	}
	gtag('js', new Date());

	gtag('config', 'UA-155235476-1');
</script>




</div>
<script>
	$(function() {
		$('#form').submit(function() {
			$('#submit').attr('disabled', 'disabled');
		})
	})
</script>
</body>

</html>