<?php
error_reporting(0);
if (!isset($_SESSION)) {
	session_start();
}

if($_SESSION["phone"] == "") {

	echo " <script> window.location = './login';</script>";
}

require 'config/config.php';


$sql_user = "SELECT * FROM member WHERE phone='".$_SESSION["phone"]."'";

$result_user = $server->query($sql_user);
$row_user = mysqli_fetch_assoc($result_user);
$credit_user=$row_user['credit'];
$fname=$row_user['fname'];
$banknumber=$row_user['banknumber'];
$bankname=$row_user['bankname'];
$balance_refund=$row_user['balance_refund'];
$date_refund=$row_user['date_refund'];
$date_check=$row_user['date_check'];


$sql_website = "SELECT * FROM website";
$result_website = $server->query($sql_website);
$row_website = mysqli_fetch_assoc($result_website);





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
		$date_check=date("Y-m-d");
		$time_check=date('H:i:s');

		$query = $server->query('SELECT * FROM history_refund WHERE phone = "'.$_SESSION["phone"].'" AND date_check= "'.$date_check.'"');
		$check = $query->num_rows;
		if($check ==0){

			$date_now=date('Y-m-d');
			$refund=$api->Winlose($row['username_game'],$date_now,$date_now);




			preg_match('/-/', $refund, $output_array);
			$check_refund=$output_array[0];
			if ($check_refund=='-') {
				$refund_credit= str_replace("-","",$refund);
				$refund_percen= str_replace("%","",$row_website['refund_percen']);
				$refund_sum=$refund_credit*$refund_percen/100;

			}else{
				$refund_sum=0;
			}

		}else{
			$refund_sum=0;
		}


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
							<h5 class="card-header">รับเงินคืน จากยอดเสีย <?php echo $row_website['refund_percen']; ?></h5>
							<div class="card-body">


								<div class="form-group mt-3">
									<input type="number" class="form-control form-control-lg" id="amount" aria-describedby="ยอดเงิน" value="<?php
									echo number_format($refund_sum,2);
								?>" placeholder="0.00" disabled >
								<br>
						<!-- 	<button  class="btn-warning btn-lg btn-block mt-2" onclick="update_refund()"><i class="fas fa-sync-alt fa-sm"></i> 
						อัพเดยอด </button> -->
						<button  class="btn-red btn-lg btn-block mt-2" onclick="refund()"><i class="fas fa-dollar-sign fa-sm"></i> 
						รับเงินคืน </button>
                                       <!--  <button  class="btn btn-primary btn-lg btn-block mt-2" onclick="update_refund()"><i class="fas fa-spinner"></i> 
                                        อัพเดทยอด </button>
                                      -->
                                    </div>
                                    <div class="alert alert-danger text-center mt-3" role="alert">
                                    	รับเงินคืนขั้นต่ำ <?php echo $row_website['min_refund']; ?> บาท จึงจะสามารถถอนได้  (รับได้วันละครั้ง เท่านั้น)
                                    </div>
                                    <div class="alert alert-warning text-center mt-3" role="alert">
                                    	อัพเดทวันต่อวัน หากสมาชิกไม่กดรับ ยอดจะหายไปเลย 
                                    </div>
                                  </div>
                                </div>
                                <br >

                                <?php 

                                $sql_rfid = "SELECT * FROM history_refund WHERE phone='".$_SESSION['phone']."'ORDER by id DESC limit 5";
                                $result_rfid = $server->query($sql_rfid);
                                $res_refund=[];
                                foreach ($result_rfid as  $value) {
                                	array_push($res_refund, $value);

                                }
                                ?>
                                
                                <div class="card">
                                	<h5 class="card-header">ประวัติ รับเงินคืน</h5>
                                	<div class="card-body" align="center">
								<!-- <?php
								if ($check<=0) {
									echo "ไม่มีข้อมุล";

								}
								?>
								<div class="container"
								<?php
								if ($check<=0) {
									echo "style='display: none'";

								}
								?>    
								> -->
								<div class="container">
									<table class="table table-striped" id="tableRefund">
										<thead>
											<tr>
												<th>ลำดับ</th>
												<th>วัน/เวลา</th>
												<th>ยอดเงิน</th>

											</tr>
										</thead>
										<tbody>
											<?php $i=1; foreach ($result_rfid as $key => $value) {?>
												<tr>
													<td><?=$i ?></td>
													<td><?=$value['date_check']; ?> <?=$value['time_check']; ?></td>
													<td><?=number_format($value ['credit'],2); ?></td>

												</tr>
												<?php $i++; }  ?>
											</tbody>
										</table>
									</div>

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
					window.onload = function() {


					}


					function refund(){
						var phone="<?php echo $_SESSION["phone"] ?>";
						var credit="<?php echo $refund_sum ?>";
						var amount=credit.replace(/,/g, "");

						var min_refund = "<?php echo $row_website['min_refund']; ?>";


						if (parseInt(amount)<parseInt(min_refund)) {
							Swal.fire({
								icon: 'error',
								title: 'แจ้งเตือน...',
								text: 'ถอนขั้นต่ำ '+min_refund

							})
							return false
						}



						if (amount<1) {
							Swal.fire({
								icon: 'error',
								title: 'แจ้งเตือน...',
								text: 'จำนวนเงินของคุณไม่พอ'

							})
							return false
						}

						showModal();

						$.ajax({
							url:'action.php?refund',
							type:'POST',
							data:{
								phone:phone,
								amount:amount
							},

							success:function(data){

								if (data!="") {
									var obj = JSON.parse(data);
									var msg=obj.msg
									var status=obj.status
									if (status==200) {
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


									}else{
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


					function login_game(){
						var username_game="<?php echo $row["username_game"]; ?>";
						window.open("login_game.php?username_game="+username_game);
					}
				</script>


		<!-- Bootstrap core JavaScript
			================================================== -->
			<!-- Placed at the end of the document so the pages load faster -->

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
			// $(document).ready(function(){
			// 	$('#tableMember').DataTable({
			// 		'processing': true,
			// 		'serverSide': true,
			// 		'serverMethod': 'post',
			// 		'ajax': {
			// 		'url':'ajax_affliliate.php'
			// 		},
			// 		'columns': [
			// 		{data: "id" , render : function ( data, type, row, meta ) {
			// 		return row.No;
			// 		}},
			// 			{ data: 'id' },
			// 			{ data: 'credit' },
			// 			{ data: 'phone' },
			// 		]
			// 		});
			// });

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