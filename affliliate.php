<?php
error_reporting(0);
if (!isset($_SESSION)) {
	session_start();
}
if($_SESSION["phone"] == "") {

	echo " <script> window.location = './login';</script>";
}

require 'config/config.php';


$sql = "SELECT * FROM member WHERE phone='" . $_SESSION["phone"] . "'";

$result = $server->query($sql);
$row = mysqli_fetch_assoc($result);
$date_commission = $row['date_commission'];
$last_commission = $row['last_commission'];
$username_game = $row['username_game'];
$date_register=$row['date_check'];
$balance_affliliate=$row['balance_affliliate'];

$actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

$sql_website = "SELECT * FROM website";
$result_website = $server->query($sql_website);
$row_website = mysqli_fetch_assoc($result_website);

$sql_user="SELECT * FROM  `member` WHERE `refid`='" . $username_game . "' and phone!='" . $_SESSION["phone"] . "'";
$result_user = $server->query($sql_user);
$res=[];
$json=[];
date_default_timezone_set('Asia/Bangkok');
$date_now=date("Y-m-d");
foreach ($result_user as  $value) {
	array_push($res,$value);
	$check_date= $value['date_affliliate'];
	if ($check_date!=$date_now) {
		array_push($json, array("username_game" => $value['username_game'] ));
	}



}

$ref_total=count($res);

?>


<!DOCTYPE html>
<html lang="th">

<head>
	<?php include("template/info.php"); ?>

	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Kanit:300">
	<!-- core CSS -->
	<link href="public/css/bootstrap.min.css" rel="stylesheet" />
	<link href="public/css/hover.css" rel="stylesheet" />
	<link href="public/css/animate.css" rel="stylesheet" />
	<link href="public/icons/icon.min.css" rel="stylesheet" />
	<link href="public/css/thbank/thbanklogos.css" rel="stylesheet" />
	<link href="public/css/thbank/thbanklogos-colors.css" rel="stylesheet" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.0-beta/css/bootstrap-select.min.css" />
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
	<!-- Custom styles -->
	<link href="public/css/style-dashboardv6.css?v=1.01" rel="stylesheet" />
	<link rel="stylesheet" href="css/jquery.loadingModal.css">
	<style>
	.share-list i {
		color: #212529;
	}
</style>
<style type="text/css">
body {

	font-family: "Kanit", sans-serif;
}
</style>
<script>
	window.siteUrl = "";
</script>
<style>
.fontsuay {
	font-size: 70px;
	/* margin-bottom: -18px; */
	margin-top: -35px;
	background: -webkit-linear-gradient(#fdf68f, #d18b31);
	-webkit-background-clip: text;
	-webkit-text-fill-color: transparent;
}
</style>


</head>

<body class="animated fadeIn fast">
	<div>
		<?php
		require 'header.php';
		?>
		<section class="slide">
			<div class="slide-img d-none d-md-block">
				<img src="public/images/slide-imgx.jpg?v=1" alt="" />
			</div>
			<div class="slide-img d-block d-md-none">
				<img src="public/images/slide-img-mobile.jpg?v=1" alt="" />
			</div>
		</section>

		<div id="app">
			<main role="main">
				<div class="container content" v-cloak>
					<section class="user-infor text-center">
						<!--Show on Desktop-->
						<div class="user-info-desktop d-none d-md-block">


						</div>
						<!--Show on Mobile-->
						<div class="user-info-mobile d-block d-sm-block d-md-none">

						</div>
					</section>

					<current-credit value="<?php echo $amount; ?>" link></current-credit>

					<section class="navigation">
						<div class="card">
							<h5 class="card-header"> สร้างรายได้จากยอดเสีย <?php echo $row_website['affliliate_percen']; ?></h5>
							<div class="card-body">
								<div class="alert alert-danger text-center mt-3" role="alert">
									แนะนำเพื่อน ขั้นต่ำ <?php echo $row_website['min_affliliate']; ?> บาท จึงจะสามารถถอนได้ 
								</div>
								<div class="alert alert-warning text-center mt-3" role="alert">
									อัพเดทวันต่อวัน หากสมาชิกไม่กดรับ ยอดจะหายไปเลย เวลา 23.00 ให้เข้ามาอัพเดทยอดแล้วถอนเงิน
								</div>

								<div class="form-group mt-3">

									<input type="text" class="form-control form-control-lg" id="url" value="<?php echo str_replace("affliliate", "", $actual_link); ?>register?ref=<?php 
									if($row['username_game']==""){echo "xxx"; }else{echo $row['username_game'];};
								?>" disabled>
								<br>
								<button class="btn-success btn-lg btn-block mt-2" onclick="copyToClipboard(url)"><i class="fas fa-copy fa-sm"></i>
								คัดลอก </button>

							</div>
							<div class="form-group mt-3">

								<div class="text-center" style="background: rgb(56, 56, 56);border-radius: 15px;">
									<small style="font-size: 28px;color: #fff;">ยอดรวมของท่าน</small>
									<p class="fontsuay"><?php echo number_format($row['balance_affliliate'],2); ?></p>
								</div>
								<!-- <button  class="btn-warning btn-lg btn-block mt-2" onclick="commission_update()"><i class="fas fa-sync-alt fa-sm"></i> 
								อัพเดยอด </button> -->
								<button class="btn-red btn-lg btn-block mt-2" onclick="commission()"><i class="fas fa-dollar-sign fa-sm"></i>
								ถอนเงิน </button>
							</div>

						</div>
					</div>
					<br>
					<div class="card" align="center">
						<h5  style="color:black" class="card-header">สมาชิกที่แนะนำ ทั้งหมด <?php
						if ($ref_total==0) {
							echo "0";
						}else{
							echo $ref_total;
						}
					?> คน</h5>
					<div class="card-body">
						<table class="table table-striped" id="tableRefund">
							<thead  style="color:black;"> 
								<tr>
									<th>ลำดับ</th>
									<th>วันที่สมัคร</th>
									<th>ชื่อผู้ใช้</th>
									<th>ฝากวันนี้</th>
									
								</tr>
							</thead>
							<tbody>
								<?php $i=1; foreach ($res as $key => $value) {?>
									<tr>
										<td><?=$i ?></td>
										<td><?=$value['date_check']; ?></td>

										<td><?=$value ['username_game']; ?></td>
										<td>
											<?php
											date_default_timezone_set('Asia/Bangkok');
											$date_now=date("Y-m-d");
											$sql_total_refill="SELECT SUM(amount) as total_refill
											FROM refill WHERE `username_game`='" . $value ['username_game']. "' and `date_check`='" . $date_now. "'";
											$result_total_refill = $server->query($sql_total_refill);
											$row_total_refill = mysqli_fetch_assoc($result_total_refill);
											echo number_format($row_total_refill['total_refill'],2);

											?>
										</td>

									</tr>
									<?php $i++; }  ?>
								</tbody>
							</table>

						</div>
					</div>
				</section>

				<popup-announcement />
			</div>
		</main>


		<?php
		require 'footer.php';
		?>
	</div>
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script>
		window.jQuery ||
		document.write(
			'<script src="assets/js/vendor/jquery-slim.min.js"><\/script>'
			);
		</script>
		<script src="public/js/vendor/popper.min.js"></script>
		<script src="public/js/bootstrap.min.js"></script>
		<script src="public/js/vendor/holder.min.js"></script>
		<script src="public/js/v20/app.js"></script>

		<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.0-beta/js/bootstrap-select.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.6.0/slick.js"></script>

		<!-- <script src="https://code.jquery.com/jquery-3.5.1.js"></script> -->
		<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
		<script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap4.min.js"></script>
		<script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
		<script src="https://cdn.datatables.net/responsive/2.2.9/js/responsive.bootstrap4.min.js"></script>
		<script src="js/jquery.loadingModal.js"></script>

		<script>

			$(function () {
				let ref=<?php echo trim(json_encode($json)); ?>;
				let phone="<?php echo $_SESSION["phone"] ?>";
				console.log(ref);

				ref.forEach((v, k) => {
					console.log(v.username_game);
					setTimeout(function() {
						var username = v.username_game;
						$.ajax({
							url: 'action.php?update_aff',
							type: 'POST',
							data: {
								ref: username,
								phone:phone
							},
							success: function(data) {
								console.log(data)
							}
						})
					}, k * 3000);
				});

			});



			function commission() {
				var phone = "<?php echo $_SESSION["phone"] ?>";
				var amount="<?php echo $balance_affliliate; ?>";
				var min_affliliate = "<?php echo $row_website['min_affliliate']; ?>";
				if (parseInt(amount) < parseInt(min_affliliate)) {
					Swal.fire({
						icon: 'error',
						title: 'แจ้งเตือน...',
						text: 'ถอนขั้นต่ำ '+min_affliliate

					})
					return false
				}


				if (amount < 1) {
					Swal.fire({
						icon: 'error',
						title: 'แจ้งเตือน...',
						text: 'จำนวนเงินของคุณไม่พอ'

					})
					return false
				}


				showModal();
				$.ajax({
					url: 'action.php?commission',
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


			function login_game() {
				var username_game = "<?php echo $row["username_game"]; ?>";
				window.open("login_game.php?username_game=" + username_game);
			}

			function copyToClipboard(containerid) {
				const range = document.createRange();
				range.selectNode(containerid); //changed here
				window.getSelection().removeAllRanges();
				window.getSelection().addRange(range);
				document.execCommand("copy");
				window.getSelection().removeAllRanges();

				Swal.fire(
					'สำเร็จ!',
					'คัดลอก สำเร็จ',
					'success'
					)

			}
		</script>

		<link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap4.min.css">
		<script async src="https://www.googletagmanager.com/gtag/js?id=UA-155235476-1"></script>
		<script>
			$(window).on("load",function(){
				$(".loader-wrapper").fadeOut("slow");
			});
		</script>
		<script>
			window.dataLayer = window.dataLayer || [];

			function gtag() {
				dataLayer.push(arguments);
			}
			gtag("js", new Date());

			gtag("config", "UA-155235476-1");
		</script>

		<script>
			$(document).ready(function() {
				$('#tableAffliliate').DataTable({
					"lengthChange": false,
					"searching": false,
					"pageLength": 5,
					"language": {
						"sEmptyTable": "ไม่มีข้อมูลในตาราง",
						"sInfo": "แสดง _START_ ถึง _END_ จาก _TOTAL_ แถว",
						"sInfoEmpty": "แสดง 0 ถึง 0 จาก 0 แถว",
						"sInfoFiltered": "(กรองข้อมูล _MAX_ ทุกแถว)",
						"sInfoThousands": ",",
						"sLengthMenu": "แสดง _MENU_ แถว",
						"sLoadingRecords": "กำลังโหลดข้อมูล...",
						"sProcessing": "กำลังดำเนินการ...",
						"sSearch": "ค้นหา: ",
						"sZeroRecords": "ไม่พบข้อมูล",
						"oPaginate": {
							"sFirst": "หน้าแรก",
							"sPrevious": "ก่อนหน้า",
							"sNext": "ถัดไป",
							"sLast": "หน้าสุดท้าย"
						},
						"oAria": {
							"sSortAscending": ": เปิดใช้งานการเรียงข้อมูลจากน้อยไปมาก",
							"sSortDescending": ": เปิดใช้งานการเรียงข้อมูลจากมากไปน้อย"
						}
					}
				});
			});

				function showModal() {
		$('body').loadingModal({text: 'กำหลังโหลด...'});
		var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
		var time = 2000;
		delay(time)
	}
		</script>
	</div>
</body>

</html>