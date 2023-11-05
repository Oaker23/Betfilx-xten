<?php
error_reporting(0);
if (!isset($_SESSION)) {
	session_start();
}

if($_SESSION["phone"] == "") {
	echo " <script> window.location = './login';</script>";
}

require 'config/config.php';


$sql = "SELECT * FROM `code_itme` WHERE phone='".$_SESSION['phone']."' and status=1";
$result = $server->query($sql);
$res=[];
foreach ($result as  $value) {
	array_push($res, $value);
}

$check=count($res[0]);

$sql = "SELECT * FROM member WHERE phone='".$_SESSION["phone"]."'";

$result = $server->query($sql);
$row = mysqli_fetch_assoc($result);


	?>


<!DOCTYPE html>
<html lang="th">
<head>
<?php include("template/info.php"); ?>

	<!-- core CSS -->
	<link href="public/css/bootstrap.min.css" rel="stylesheet" />
	<link href="public/css/hover.css" rel="stylesheet" />
	<link href="public/css/animate.css" rel="stylesheet" />
	<link href="public/icons/icon.min.css" rel="stylesheet" />
	<link href="public/css/thbank/thbanklogos.css" rel="stylesheet" />
	<link href="public/css/thbank/thbanklogos-colors.css" rel="stylesheet" />
	<link
	rel="stylesheet"
	href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.0-beta/css/bootstrap-select.min.css"
	/>
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
	<!-- Custom styles -->
	<link href="public/css/style-dashboardv6.css?v=1.01" rel="stylesheet" />
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Kanit:300">
	<link rel="stylesheet" href="css/jquery.loadingModal.css">
	<style>
		.share-list i {
			color: #212529;
		}
	</style>
	<style type="text/css">
		body
		{

			font-family:"Kanit", sans-serif;
		}

	</style>
	<script>
		window.siteUrl = "";
	</script>


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
							<h5 class="card-header">กิจกรรม โค้ดเติมเงิน</h5>
							<div class="card-body">


								<div class="form-group mt-3">

									<input type="text" class="form-control form-control-lg" id="code" placeholder="8a2125e4843cfb45675567c8b70b40f5" value="">
									<br>
									<button  class="btn-success btn-lg btn-block mt-2" onclick="item_code()"><i class="fas fa-check fa-sm"></i> 
									ยืนยัน </button>
									
								</div>

							</div>
						</div>
						<br >
						<div class="card" align="center">
							<h5 class="card-header">ประวัติการ ทำรายการ</h5>
							<div class="card-body">
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
								<table class="table table-striped" id="tableCard">

									<thead>
										<tr>
											<th>ลำดับ</th>
											<th>วันที่</th>
											<th>ยอดเงิน</th>
											<th>ยอดเทิร์น</th>
										</tr>
									</thead>
									<tbody>
										<?php $i=1; foreach ($res as $key => $value) {?>
											<tr>
												<td><?=$i ?></td>
												<td><?=$value ['date_give']; ?></td>
												<td><?=number_format($value['credit'],2); ?></td>
												<td><?=number_format($value['turnover'],2); ?></td>
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

		<script>

			function item_code(){
				var phone="<?php echo $_SESSION["phone"] ?>";
				var code=$("#code").val();
			

				if (code=="") {
					Swal.fire({
						icon: 'error',
						title: 'แจ้งเตือน...',
						text: 'กรุณาใส่ Code'

					})
					return false
				}


showModal();
				$.ajax({
					url:'action.php?item_code',
					type:'POST',
					data:{
						phone:phone,
						code:code
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
      	<script
      	src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
      	integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
      	crossorigin="anonymous"
      	></script>
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
			$(window).on("load",function(){
			$(".loader-wrapper").fadeOut("slow");
			});
		</script>
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

<script
async
src="https://www.googletagmanager.com/gtag/js?id=UA-155235476-1"
></script>
<script>
	window.dataLayer = window.dataLayer || [];

	function gtag() {
		dataLayer.push(arguments);
	}
	gtag("js", new Date());

	gtag("config", "UA-155235476-1");
</script>
<script>
		// $.extend(true, $.fn.dataTable.defaults, {
		// 	"language": {
		// 		"sEmptyTable":     "ไม่มีข้อมูลในตาราง",
		// 		"sInfo":           "แสดง _START_ ถึง _END_ จาก _TOTAL_ แถว",
		// 		"sInfoEmpty":      "แสดง 0 ถึง 0 จาก 0 แถว",
		// 		"sInfoFiltered":   "(กรองข้อมูล _MAX_ ทุกแถว)",
		// 		"sInfoThousands":  ",",
		// 		"sLengthMenu":     "แสดง _MENU_ แถว",
		// 		"sLoadingRecords": "กำลังโหลดข้อมูล...",
		// 		"sProcessing":     "กำลังดำเนินการ...",
		// 		"sSearch":         "ค้นหา: ",
		// 		"sZeroRecords":    "ไม่พบข้อมูล",
		// 		"oPaginate": {
		// 			"sFirst":    "หน้าแรก",
		// 		"sPrevious": "ก่อนหน้า",
		// 			"sNext":     "ถัดไป",
		// 		"sLast":     "หน้าสุดท้าย"
		// 		},
		// 		"oAria": {
		// 			"sSortAscending":  ": เปิดใช้งานการเรียงข้อมูลจากน้อยไปมาก",
		// 		"sSortDescending": ": เปิดใช้งานการเรียงข้อมูลจากมากไปน้อย"
		// 		}
		// 	}
		// });
		$(document).ready(function() {
			$('#tableCard').DataTable({
				"lengthChange": false,
				"searching": false,
				"pageLength": 5,
				"language": {
					"sEmptyTable":     "ไม่มีข้อมูลในตาราง",
					"sInfo":           "แสดง _START_ ถึง _END_ จาก _TOTAL_ แถว",
					"sInfoEmpty":      "แสดง 0 ถึง 0 จาก 0 แถว",
					"sInfoFiltered":   "(กรองข้อมูล _MAX_ ทุกแถว)",
					"sInfoThousands":  ",",
					"sLengthMenu":     "แสดง _MENU_ แถว",
					"sLoadingRecords": "กำลังโหลดข้อมูล...",
					"sProcessing":     "กำลังดำเนินการ...",
					"sSearch":         "ค้นหา: ",
					"sZeroRecords":    "ไม่พบข้อมูล",
					"oPaginate": {
						"sFirst":    "หน้าแรก",
					"sPrevious": "ก่อนหน้า",
						"sNext":     "ถัดไป",
					"sLast":     "หน้าสุดท้าย"
					},
					"oAria": {
						"sSortAscending":  ": เปิดใช้งานการเรียงข้อมูลจากน้อยไปมาก",
					"sSortDescending": ": เปิดใช้งานการเรียงข้อมูลจากมากไปน้อย"
					}
				}
			});
		} );
</script>
</div>
</body>
</html>
