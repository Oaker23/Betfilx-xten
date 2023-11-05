<?php
error_reporting(0);
if (!isset($_SESSION)) {
	session_start();
}

if($_SESSION["phone"] == "") {

	echo " <script> window.location = './login';</script>";
}
require 'config/config.php';
require 'genTextQR.php';
date_default_timezone_set('Asia/Bangkok');
$date_check=date("Y-m-d");
$time_check=date('H:i:s');


function ran(){ return mt_rand(10000000,99999999);}


$sql_user = "SELECT * FROM member WHERE phone='".$_SESSION["phone"]."'";

$result_user = $server->query($sql_user);
$row_user = mysqli_fetch_assoc($result_user);
$credit_user=$row_user['credit'];
$fname=$row_user['fname'];
$banknumber=$row_user['banknumber'];
$bankname=$row_user['bankname'];





if ($_GET["amount"]!="") {
	

	

	$ref='YAI1'.ran();
	$sql = "SELECT * FROM wait_refill WHERE ref='" .$ref. "'";
	$query = $server->query($sql);
	$check = $query->num_rows;
	$row_check = mysqli_fetch_assoc($query);

	

	if ($check != 1) {
		$sql = "INSERT INTO `wait_refill`(`id`,`date_check`,`ref`,`price`,`phone`) VALUES (null,'".$date_check."','".$ref."','".$_GET["amount"]."','".$_SESSION["phone"]."')";

		
		if ($server->query($sql) === TRUE) {
			$img=trim('https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl='.genTextQR($_GET["amount"],$ref).'&choe=UTF-8');


		}
	}

}




$sql1 = 'SELECT * FROM  `scb_info` where status=1';
$result1 = $server->query($sql1);
$row1 = mysqli_fetch_assoc($result1);


$sql_website = "SELECT * FROM website";
$result_website = $server->query($sql_website);
$row_website = mysqli_fetch_assoc($result_website);

$popup=@$_GET["popup"];
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
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css">
		<!-- core CSS -->
		<link href="public/css/bootstrap.min.css" rel="stylesheet">
		<link href="public/css/hover.css" rel="stylesheet">
		<link href="public/css/animate.css" rel="stylesheet">
		<link href="public/icons/icon.min.css" rel="stylesheet">
		<link href="public/css/thbank/thbanklogos.css" rel="stylesheet">
		<link href="public/css/thbank/thbanklogos-colors.css" rel="stylesheet">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.0-beta/css/bootstrap-select.min.css" />

		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Kanit:300">
		<!-- Custom styles -->
		<link href="public/css/style-dashboardv6.css?v=1.04" rel="stylesheet">

		<style type="text/css">
		body
		{

			font-family:"Kanit", sans-serif;
		}

	</style>

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
		<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
		<header class="header">
			<div class="navbar">
				<div class="container d-flex justify-content-between">
					<div class="col-2 p-0">
						<div class="top-nav">
							<ul>
								<li>
									<a href="./dashboard"
									><i class="far fa-home"></i>
									<p>หน้าแรก</p></a
									>
								</li>
							</ul>
						</div>
					</div>
					<?php 
					$sqlInfo = "SELECT * FROM website";

					$resultInfo = $server->query($sqlInfo);
					$rowInfo = mysqli_fetch_assoc($resultInfo);
					?>
					<div class="col-8 text-center">
						<img style="margin-top: -20px;"
						class="header-logo"
						src="./manager/<?php echo $rowInfo['logo']; ?>"
						alt=""
						width="50%"
						/>
					</div>
					<div class="col-2 p-0"<?php if ($_SESSION["phone"]=="") {echo "style='display: none;'";}?>>

						<div class="top-nav">
							<ul>
								<li>
									<a href="./action.php?logout"
									><i class="far fa-power-off"></i>
									<p>ออกจากระบบ</p></a
									>
								</li>
							</ul>
						</div>
					</div>

					<div class="col-2 p-0"<?php
					if ($_SESSION["phone"]=="") {
						echo "style='block:'";
					}else{
						echo "style='display: none;'";

					}?>>

					<div class="top-nav">
						<ul>
							<li>
								<a href="./register"
								><i class="far fa-user-plus fa-sm"></i>
								<p>สมัครสมาชิก</p></a
								>
							</li>
						</ul>
					</div>
				</div>

			</div>
		</div>
	</header>
	<section class="slide">
		<div class="slide-img d-none d-md-block"><img src="public/images/slide-imgx.jpg?v=1" alt=""></div>
		<div class="slide-img d-block d-md-none"><img src="public/images/slide-img-mobile.jpg?v=1" alt=""></div>
	</section>

	<div id="app">
		<main role="main">
			<div class="container content" v-cloak>

				<current-credit id="show_credit" value="<?php echo number_format($credit_user,2); ?>" link></current-credit>
				<section class="depositChanel mt-4 mb-4">

					<div class="clearfix"></div>
				</section>

				<section class="bank-info animated fadeIn" id="bank" style="display: block;">
					<ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
					<!--	 <li class="nav-other-button">
							<a class="nav-link active btn-dark-tri hvr-buzz-out other-list" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">
								<i class="fa fa-qrcode" aria-hidden="true"></i>
								<p>สแกน QR CODE</p>
							</a>
						</li> -->
						<li class="nav-other-button" style="margin-left: 0%;">
							<a class="nav-link btn-dark-tri hvr-buzz-out other-list" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">
								<i class="fa fa-credit-card" aria-hidden="true"></i>

								<p>โอนเอง</p>
							</a>
						</li>

					</ul>
					<h2>
						<div class="tab-content" id="pills-tabContent">
							<div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">


								<div align="center" class="row mt-3">
									<div  class="col-12 bank-info-copy">
										<img
										<?php
										if ($img=="") {
											echo "style='display: none;'";
										}

										?>

										src="<?php echo $img; ?>">
									</div>
								</div>


								<div class="row">

									<div class="col-12 bank-info-copy ">
										<?php
										if ($_GET["amount"]=="") {
											?>
											<!-- <div class="card my-4">
												<div class="card-header text-white bg-danger">
													ขั้นตอนการโอนเงิน
												</div>
												<div class="card-body">
													<p style="font-size:26px">1.ใส่ยอดเงิน ที่ต้องการฝาก</p>
													<p style="font-size:26px">2.บันทึกQR CODEไว้ในเครื่อง</p>
													<p style="font-size:26px">3.เปิดแอ๊ปธนาคาร ไปที่สแกน</p>
													<p style="font-size:26px">4.เลือกรูปที่บันทึกไว้ โอนเสร็จเงินเข้าทันที</p>
													<p style="font-size:26px" class="text-danger"><i class="fas fa-exclamation-triangle"></i> หากไม่ข้าใจดู วิดีโอ ข้างล่าง <i class="far fa-hand-point-down"></i></p>
												</div>
											</div> -->
											<?php
										}

										?>



									<!--	<input type="number" class="form-control form-control-lg" id="amount" placeholder="0.00">
										<a class="btn-block btn-zinc copy-button text-center" onclick=" genTextQR()">
											<p> <i class="far fa-copy"></i> สร้าง QR CODE</p>
										</a>
									</div>
								</div>


								<div align="center" class="card bank-info mt-4">
									<h5 class="card-header"><i class="fab fa-youtube fa-sm"></i> สอนการใช้งาน</h5>
									<div class="card-body">
										<video width="320" height="240" controls>
											<source src="help.mp4" type="video/mp4">

												Your browser does not support the video tag.
											</video>
											
										</div>
									</div>

								</div>
-->
								<div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
									<section class="depositChanel mt-4 mb-4">

										<div class="clearfix">

										</div>
									</section>
									<section id="bank" class="bank-info animated fadeIn" style="display: block;">
										<center>
											<!-- <div class="alert alert-warning">
												True Money Wallet ต้องทำรายการผ่าน QR CODE เท่านั้น
											</div><br><br> -->

											<img src="public/images/bank/scb_banner.jpg" alt="" width="100%">
											<br>

										</center>
										<div class="row">
											<div class="col-sm-6 bank-info-text text-center">
												<small>ชื่อบัญชี</small>
												<p class="bank-acc-name  my-1"><b><?php echo $row1['fname'] ?></b></p>
											</div>
											<div class="col-sm-6 bank-info-text text-center">
												<small>เลขบัญชีธนาคาร</small>
												<b>  <p id="account-73" class="bank-acc-name  my-1"><?php echo $row1['banknumber'] ?></p></b>
											</div>
										</div>
										<div class="row mt-3">
											<div onclick="copyToClipboard('account-73')" class="col-12 bank-info-copy">
												<a class="btn-block btn-zinc copy-button text-center">
													<p><i class="far fa-copy">
													</i> คัดลอกเลขบัญชี</p>
												</a>
											</div>
										</div> 
										<div class="card bank-info mt-4">
											<h5 class="card-header">ใช้บัญชีด้านล่างสำหรับการฝากเงินเท่านั้น</h5>
											<div class="card-body">
												<div class="bank-user-logo">
													<img src="./bank_img/<?php echo bank_img($row_user['bank_name']); ?>.webp"> 

												</div> 
												<div class="bank-user-info">
													<p id="bank-user-bankname" class="my-1">ธนาคาร: <b><?php echo $row_user['bank_name'] ?></b></p> 
													<p id="bank-user-name" class="my-1">ชื่อบัญชี: <b><?php echo $row_user['fname']; ?></b></p>
													<p id="bank-user-number" class="my-1">เลขบัญชี: <b><?php echo $row_user['bank_number'] ?></b></p>
												</div>
											</div>
										</div>
									</section>
									<!-- <div class="alert alert-warning mt-3 text-center">
									** แนะนำให้ลูกค้าใช้ สแกน QR CODE ระบบจะมีความรวดเร็วที่สุด ** </div> -->


								</div>
							</div>
						</h2>

					</section>
					<!--Bank Infomation -->

					<!--Wallet Infomation-->
					<section class="true-wallet animated fadeIn" id="wallet" style="display: none;">
					</section>
  

					<section class="history-link mt-3">
						<div class="row">
							<div class="col-12 text-center">
								<a class="history-link-text" href="history">ดูประวัติการฝากเงิน <i class="fal fa-list-alt"></i></a>
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

	<div class="modal fade" id="popupModal" style="margin-top: 200px;">
		<div class="modal-dialog">
			<div class="modal-content">


				<!-- Modal body -->
				<div class="modal-body">
					<div id="swal2-content" style="display: block;">
						<img src="https://cdn.slotgame6666.com/storage/app/public/announcement/24iq4gKcupUfszf2Koo1L7MZMkkhrUEpX1k5nKHx.gif" style="width:100%">

						<div align="center" class="mt-2 mb-4">
							<br>
							<h1 class="ql-align-center">
								<a  rel="noopener noreferrer" target="_blank" style="background-color: rgb(230, 0, 0); color: rgb(255, 255, 255);"> &nbsp;&nbsp;กรูณาฝากเงิน ก่อน!</a>
							</h1>

							<button type="button" class="swal2-confirm swal2-styled" aria-label="" style="display: inline-block; border-left-color: rgb(48, 133, 214); border-right-color: rgb(48, 133, 214);" data-dismiss="modal" style="margin-top: -200px;">OK</button>
						</div>
					</div>
				</div>



			</div>
		</div>
	</div>

</div>


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
        </div>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
        <script>
        	$(window).on("load",function(){
        		$(".loader-wrapper").fadeOut("slow");
        	});
        </script>

        <script>



        	window.onload = function() {

        		var check='<?php echo $_GET["amount"]; ?>'

        		if (check=="") {
              //  alert(check)
              document.getElementById("pills-profile-tab").click();
            }



            var popup='<?php echo $popup; ?>';

            if (popup==1) {
            	$('#popupModal').modal('show');
            }

          }


          setInterval(function(){
          	var phone="<?php echo $_SESSION["phone"]; ?>";
          	var credit_check=document.getElementById("credit_check").value;

          	$.ajax({
          		url:'action.php?credit_user',
          		type:'POST',
          		data:{
          			phone:phone
          		},
          		success:function(data){
          			if (data!="") {
          				var obj = JSON.parse(data);
          				var status=obj.status
          				var msg=obj.msg
          				if (status==200) {
          					var credit=msg;
          					console.log(credit+' '+credit_check)
          					document.getElementsByClassName("amount").value=credit;
          					document.getElementById("show_credit").value=msg;
          					var sum=parseInt(credit)-parseInt(credit_check);
          					document.getElementById("credit_check").value=credit;

          					if (parseInt(credit)>parseInt(credit_check)) {
          						Swal.fire({
          							title: 'สำเร็จ!',
          							text: `ฝากเงิน ${sum}`+' บาท',
          							icon: 'success',
          							showCancelButton: false,
          							confirmButtonColor: '#3085d6',
          							cancelButtonColor: '#d33',
          							confirmButtonText: 'OK'
          						}).then((result) => {
          							if (result.value) {
          								window.location.reload();
          							}
          						});

          					}



          				}

          			}

          		}

          	});

          }, 2000);


          function genTextQR() {
          	var amount=$("#amount").val();
            // console.log(amount);
            if (amount=="") {

            	Swal.fire({
            		icon: 'error',
            		title: 'แจ้งเตือน...',
            		text:'กรุณา ใส่ยอดเงิน'

            	})
            	return false
            }

            if (amount<1) {

            	Swal.fire({
            		icon: 'error',
            		title: 'แจ้งเตือน...',
            		text:'กรุณา ใส่ยอดเงิน'

            	})
            	return false
            }


            location.replace("./deposit?amount="+amount);
          }

          function copyToClipboard(elementId) {
          	var aux = document.createElement("input");
          // var test=document.getElementById(elementId).innerHTML;
          var test="<?php echo $row1['banknumber'] ?>";
          
          aux.setAttribute("value",test );
          document.body.appendChild(aux);
          aux.select();
          document.execCommand("copy");
          document.body.removeChild(aux);
          Swal.fire({
          	type: 'success',
          	title: "คัดลอกแล้ว "+ test,
          	showConfirmButton: false,
          	timer: 1500
          })
        }

        function showBank() {
        	var v = document.getElementById("bank-button");
        	var w = document.getElementById("wallet-button");
        	var x = document.getElementById("bank");
        	var z = document.getElementById("wallet");
        	if (x.style.display === "none") {
        		x.style.display = "block";
        		z.style.display = "none";
        		v.classList.remove("grayscale");
        		w.classList.add("grayscale");
        	} else {

        	}
        }

        function showWallet() {
        	var v = document.getElementById("bank-button");
        	var w = document.getElementById("wallet-button");
        	var x = document.getElementById("bank");
        	var z = document.getElementById("wallet");
        	if (z.style.display === "none") {
        		x.style.display = "none";
        		z.style.display = "block";
        		v.classList.add("grayscale");
        		w.classList.remove("grayscale");
        	} else {

        	}
        }
      </script>
    </body>

    </html>