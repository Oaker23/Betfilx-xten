<?php
error_reporting(0);
if (!isset($_SESSION)) {
	session_start();
}

if($_SESSION["phone"] == "") {
	echo " <script> window.location = './login';</script>";
}
require 'config/config.php';

date_default_timezone_set("Asia/Bangkok");
$date_now = date("d/m/Y");


$sql_website = "SELECT * FROM website";
$result_website = $server->query($sql_website);
$row_website = mysqli_fetch_assoc($result_website);

$sql = "SELECT * FROM member WHERE phone='" . $_SESSION["phone"] . "'";
$result = $server->query($sql);
$row = mysqli_fetch_assoc($result);





$sql_pro = "SELECT * FROM history_promotion WHERE phone='" . $_SESSION["phone"] . "' ORDER BY id DESC";
$result_pro = $server->query($sql_pro);
$row_pro = mysqli_fetch_assoc($result_pro);
$turnover=$row_pro['turnover'];

$status_turnover=$row_pro['status_turnover'];
$id_pro=$row_pro['id'];

if ($status_turnover=="") {
	$status_turnover=1;
}




function bank_img($value){

	if ($value=="กรุงเทพ") {
		return 'bbl';
	}

	if ($value=="กสิกรไทย") {
		return 'kbank';
	}
	if ($value=="กรุงไทย") {
		return 'ktb';
	}
	if ($value=="กสิกรไทย") {
		return 'bbl';
	}
	if ($value=="ทหารไทย") {
		return 'tmb';
	}
	if ($value=="กรุงศรีฯ") {
		return 'kma';
	}
	if ($value=="ไทยพาณิชย์") {
		return 'scb';
	}
}
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
		<link rel="stylesheet" href="css/jquery.loadingModal.css">

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

		$total_turnover_result=$api->Turnover($row['username_game']);	


		$total_turnover_result=str_replace(",","",	$total_turnover_result);
		$turnover=str_replace(",","",	$turnover);
		if ($status_turnover==0) {
			if ($total_turnover_result<$turnover) {
				$statuswd=1;
			}else{
				$statuswd=0;
				$sql="UPDATE `history_promotion` SET `status_turnover`='1' WHERE id='".$id_pro."'";
				if ($server->query($sql) === TRUE) {}
			}
	}



	?>
	<section class="slide">
		<div class="slide-img d-none d-md-block"><img src="public/images/slide-imgx.jpg?v=1" alt=""></div>
		<div class="slide-img d-block d-md-none"><img src="public/images/slide-img-mobile.jpg?v=1" alt=""></div>
	</section>

	<div id="app">
		<main role="main">
			<div class="container content" v-cloak>

				<current-credit value="<?php echo $amount; ?>" link></current-credit>
				
				<div class="col-12" style="text-align: -webkit-center;">
					<label style="color:red;font-size: 30px;font-weight: bold;">*ยอดเทริน์ยังเหลืออยู่อีก <?php echo $row['turnover'] ?> บาทจึงจะทำการถอนเงินได้</label>
				</div>

				<section class="user-bank">
					<div class="card">
						<h5 class="card-header">ถอนเงินเข้าบัญชีธนาคาร</h5>
						<div class="card-body">
							<div class="bank-user-logo">
								<img src="./bank_img/<?php echo bank_img($row['bank_name']); ?>.webp">
							</div>
							<div class="bank-user-info">
								<p id="bank-user-bankname">ธนาคาร: <?php echo $row['bank_name']; ?></p>
								<p id="bank-user-name">ชื่อบัญชี: <?php
								if ($row['fname'] == "") {
									echo "<span style='color: red;'>ยืนยัน บัญชีธนาคาร !หากไม่ยืนยันจะไม่สามารถถอนเงินได้</span>";
								} else {
									echo $row['fname'];
								}
							?></p>
							<p id="bank-user-number">เลขบัญชี: <?php echo $row['bank_number']; ?></p>
							<p><button class="btn-warning btn-lg" data-toggle="modal" data-target="#myModal" <?php
							if ($row['fname'] != "") {
								echo "style='display: none;'";
							}
						?>>ยืนยัน</button></p>
					</div>
				</div>
			</div>
		</section>


		<div class="form-group mt-3">

			<input type="number" class="form-control form-control-lg" id="amount" aria-describedby="ยอดเงิน" placeholder="<?php echo number_format($row_website['minimum_withdraw'],2) ?>" value="">

			<label <?php if ($status_turnover==1) { echo "style='display: none;'";} ?>> <span style="color:red">ยอดเทิร์นของคุณ</span> <?php echo $total_turnover_result.'/'.$turnover;  ?> </label><br>
			<button class="btn-red btn-lg btn-block mt-2" onclick="withdraw()"><i class="fas fa-dollar-sign fa-sm"></i>
			ถอนเงิน </button>






			<section class="history-link mt-3">
				<div class="row">
					<div class="col-12 text-center">
						<a class="history-link-text" href="history">ดูประวัติการถอนเงิน<i class="fal fa-list-alt"></i></a>
					</div>
				</div>
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


<!-- The Modal -->
<div class="modal fade" id="myModal" style="margin-top: 200px;">
	<div class="modal-dialog">
		<div class="modal-content">

			<!-- Modal Header -->
			<div class="modal-header">
				<h4 class="modal-title"><i class="fas fa-id-card"></i> ยืนยัน บัญชีธนาคาร</h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>

			<!-- Modal body -->
			<div class="modal-body">
				<div class="form-group">
					<label for="exampleInputEmail1">เลขบัญชีธนาคาร</label>
					<input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="<?php echo $row['bank_number']; ?>" disabled>
					<label for="exampleInputEmail1">ชื่อ-นามสกลุ</label>
					<input type="text" class="form-control" id="fname" aria-describedby="emailHelp" value="<?php echo $row['fname']; ?>"
					<?php 
					if ($row['fname']!="") {
						echo "disabled";
					}
					?>
					>
					<label for="exampleInputEmail1">ธนาคาร</label>
					<input type="text" class="form-control" id="exampleInputEmail1" value="<?php echo $row['bank_name']; ?>" aria-describedby="emailHelp" disabled>
				</div>
			</div>

			<!-- Modal footer -->
			<div class="modal-footer">
				<button type="button" class="btn btn-success" onclick="confrim_fname()">ยืนยัน</button>
				<button type="button" class="btn btn-danger" data-dismiss="modal">ปิด</button>
			</div>

		</div>
	</div>
</div>


<script>

	function withdraw() {
		var phone = "<?php echo $_SESSION["phone"] ?>";
		var amount = $("#amount").val();
		var min_withraw = '<?php echo number_format($row_website['minimum_withdraw'],2); ?>'

		var status_turnover='<?php echo $statuswd; ?>'
		var max_withdraw='<?php echo $row_website['max_withdraw']; ?>'

		if (parseInt(amount) >parseInt(max_withdraw)) {
			Swal.fire({
				icon: 'error',
				title: 'แจ้งเตือน...',
				text: 'จำกัดการถอนต่อวันที่ '+max_withdraw

			})
			return false
		}






		if (parseInt(amount) < parseInt(min_withraw)) {
			Swal.fire({
				icon: 'error',
				title: 'แจ้งเตือน...',
				text: 'ถอนขั้นต่ำ '+min_withraw

			})
			return false
		}

		if(status_turnover==1){
			Swal.fire({
				icon: 'error',
				title: 'แจ้งเตือน...',
				text: 'คุณยังทำเทิรนโอเวอร์ ไม่ครบ '

			})
			return false

		}


		if (amount == "") {
			Swal.fire({
				icon: 'error',
				title: 'แจ้งเตือน...',
				text: 'ห้ามเว้นว่าง'

			})
			return false
		}

		if (amount < 1) {
			Swal.fire({
				icon: 'error',
				title: 'แจ้งเตือน...',
				text: 'กรุณาใส่ จำนวนเงิน'

			})
			return false
		}

		showModal();

		$.ajax({
			url: 'action.php?withdraw',
			type: 'POST',
			data: {
				phone: phone,
				amount: amount
			},

			success: function(data) {

				if (data != "") {
					var obj = JSON.parse(data);
					var msg = obj.msg
					var status = obj.status
					if (status == 200) {
						$('body').loadingModal('hide');
						$('body').loadingModal('destroy') ;

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


					} else {

						$('body').loadingModal('hide');
$('body').loadingModal('destroy') ;


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

		function showModal() {
		$('body').loadingModal({text: 'กำหลังโหลด...'});
		var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
		var time = 2000;
		delay(time)
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
			<script src="js/jquery.loadingModal.js"></script>
			<script>
				$(window).on("load",function(){
					$(".loader-wrapper").fadeOut("slow");
				});
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