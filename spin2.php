<?php 
error_reporting(0);
if (!isset($_SESSION)) {
  session_start();
}
if($_SESSION["phone"] == "") {
  echo " <script> window.location = './login';</script>";
}

require 'config/config.php';
// include 'api_betflix.php';

$actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

$sql = "SELECT * FROM member WHERE phone='".$_SESSION["phone"]."'";

$result = $server->query($sql);
$row = mysqli_fetch_assoc($result);

if($row["affliliate_percen"] != "") {
  echo " <script> window.location = './affiliate/member';</script>";
}



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

if ($row["bank_name"]=='ทหารไทย') {
 $sql="UPDATE `member` SET bank_name='ทหารไทยธนชาติ' WHERE phone='".$_SESSION["phone"]."'";
 if ($server->query($sql) === TRUE) {}
}

if ($row["bank_name"]=='ธนชาติ') {
 $sql="UPDATE `member` SET bank_name='ทหารไทยธนชาติ' WHERE phone='".$_SESSION["phone"]."'";
 if ($server->query($sql) === TRUE) {}
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
	if ($value=="ทหารไทยธนชาติ") {
		return 'tmb';
	}
	if ($value=="กรุงศรีฯ") {
		return 'kma';
	}
	if ($value=="ไทยพาณิชย์") {
		return 'scb';
	}
}

$bank_svg = bank_img($row["bank_name"]);

$promotion = "";
$query_promotion = $server->query('SELECT * FROM `history_promotion` where phone = "'.$row['phone'].'"  and status_turnover = 1 order by id desc limit 1');
$check_promotion = $query_promotion->num_rows;
if ($check_promotion >=1) {
    while ($row_promotion = mysqli_fetch_assoc($query_promotion)) {
        $promotion = "ติดโปร ".$row_promotion['name'];
    }
}else{
    $promotion = "ไม่รับโบนัส";
}


$sql_website = "SELECT * FROM website";
$result_website = $server->query($sql_website);
$row_website = mysqli_fetch_assoc($result_website);



include('dashboard_header.php'); 

?>


<!-- เรียกใช้ Sidebar--------------------------- -->
<!-- <?php //include('navbar.php'); ?> -->
<!-- <div class="wrapermenucon">
   <button class="wrapper-menu  sidebarCollapse"  aria-label="Main Menu">
   <svg width="40" height="40" viewBox="0 0 100 100">
   <path class="line line1" d="M 20,29.000046 H 80.000231 C 80.000231,29.000046 94.498839,28.817352 94.532987,66.711331 94.543142,77.980673 90.966081,81.670246 85.259173,81.668997 79.552261,81.667751 75.000211,74.999942 75.000211,74.999942 L 25.000021,25.000058" />
   <path class="line line2" d="M 20,50 H 80" />
   <path class="line line3" d="M 20,70.999954 H 80.000231 C 80.000231,70.999954 94.498839,71.182648 94.532987,33.288669 94.543142,22.019327 90.966081,18.329754 85.259173,18.331003 79.552261,18.332249 75.000211,25.000058 75.000211,25.000058 L 25.000021,74.999942" />
   </svg>
   </button>
   </div> -->
<!-- เรียกใช้ Sidebar--------------------------- -->



<!-- Cantainer all content----------------------------------------------- -->
<div class="containall">
   <div data-aos="fade-right" class="contentmain boxcolor">









      <!-- ส่วนหัว /ข้อมูลส่วนตัว----------------------------------------------- -->
      <div class="headmain">
         <table width="100%">
            <tr>
               <td style="width: 15%;text-align: center; padding-left: 15px;  ">
                  <img src="images/logo/logo.png" width="50px">
               </td>
               <td style="width: 50%;text-align: left; font-size: 18px;">
                  <i class="fas fa-user" style="font-size: 16px;color: #fad275;"></i> <?php echo $row['fname']; ?><br>
                  <img src="images/bank/<?php echo $bank_svg; ?>.svg?v=1" width="17px"> <span><?php echo $row['phone']; ?></span>
               </td>
               <td style="width: 15%;text-align: right; ">
                  <table align="right">
                     <tr>
                        <td  class="righttopmain">
                           <span class="bglangbtn">
                           <img onclick="opentab(event, 'language')" class="languagebtn" src="images/language/translatearcha1682.svg?v=1">
                           </span>
                        </td>
                        <td class="paddinglefttop">
                           <button class="logoutbtn" onclick="location.href='./action.php?logout'"><i class="fal fa-power-off"></i></button>
                        </td>
                     </tr>
                  </table>
               </td>
            </tr>
         </table>
      </div>
      <div class="containmoney">
         <table width="100%">
            <tr>
               <td width="50%" style="padding-left: 20px;">
                  <i  onclick="opentab(event, 'section01')" id="opensection01" style="cursor: pointer;" class="fal fa-wallet"></i>
               </td>
               <td width="50%" style="text-align: right;">
                  <span style="font-size: 17px;"><i class="fad fa-coin"></i> ยอดเครดิตของคุณ </span>
                  <br>
                  <span style="color:#ecc568; font-size: 35px;"> <?php echo number_format($row['credit'],2); ?>
                  <span style="font-size: 15px;">บาท</span>
                  </span>
               </td>
            </tr>
         </table>
         <hr style="margin: 5px; border-top:1px solid #68635c;">
         <div style="padding-left: 20px;margin-top: 10px; margin-bottom: 15px;">
            <i class="fad fa-gift" style="color:#fad275;"></i> โปรโมชั่น : <?php echo $promotion; ?>
         </div>
         <table width="100%">
            <tr>
               <td width="50%" style="text-align: center;">
                  <button class="btnfriend mcolor" onclick="opentab(event, 'friend')"><i class="fal fa-users-medical"></i> แนะนำเพื่อน</button>
               </td>
               <td width="50%" style="text-align: center;">
                  <button class="btncommis bkcolor" onclick="opentab(event, 'comis')"><i class="fal fa-hands-usd"></i> คอมมิชชั่น</button>
               </td>
            </tr>
         </table>
      </div>
      <!-- END  ส่วนหัว /ข้อมูลส่วนตัว----------------------------------------------- -->

















      <!-- Main menu select01 -->
      <i onclick="opentab(event, 'section01')" id="defaultOpen"  hidden class="fal fa-plus tablinks"></i>
      <div id="section01" class="tabcontent mainsection">
         <div class="headerprocess">M4BET</div>
         <div class="menucontain">
			 
		<div id="app">
			<main role="main">
				<div class="container" v-cloak>
					<section class="user-infor text-center">
						<!--Show on Desktop-->
						<div class="user-info-desktop d-none d-md-block">


						</div>
						<!--Show on Mobile-->
						<div class="user-info-mobile d-block d-sm-block d-md-none">

						</div>
					</section>

						 <section class="credit">
							<div class="credit-box">
									<div class="amount-box float-left">
										<small>พอยท์คงเหลือ</small> 
										<small class="float-right mr-3">
											<i title="อัพเดทยอดเงิน" class="fas fa-sync-alt refresh pointer animated"></i>
									</small> <p class="amount"><?php echo number_format($row['point'],2) ?></p></div> 
								<div class="button-box float-left">
									<a href="./deposit" class="btn-block btn-gold"><i class="fal fa-wallet"></i> ฝากเงิน</a> 
									<a href="./withdraw" class="btn-block btn-silver"><i class="fal fa-hand-holding-usd"></i> ถอนเงิน</a>
								</div> 
								<div class="clearfix"></div>
							</div>
						</section>

					<section class="navigation">
						<div class="card">
							<h5 class="card-header">กิจกรรม สุ่มวงล้อ</h5>
							<div class="card-body">

									<div class="row justify-content-md-center">
										<div class="col-12">
											<div class="spinners"></div>
											<button type="button" class="mt-2 btn btn-danger btn-block spin-button"><i class="fa fa-gamepad"></i>&nbsp;สุ่มวงล้อ (  <?= $wheel['bet'] ?> Point )</button>
										</div>
									</div>
									<!-- <div class="row justify-content-md-center">
										<div class="col-md-7">
											<button type="button" class="mt-2 btn btn-danger btn-block spin-button"><i class="fa fa-gamepad"></i>&nbsp;สุ่มวงล้อ (  <?= $wheel['bet'] ?> Point )</button>
										</div>
									</div> -->
								<!-- <h3></h3> -->


							</div>
						</div>
						
					</section>

					<popup-announcement />
				</div>
			</main>

		</div>

	<link href="public/css/bootstrap.min.css" rel="stylesheet" />
	<link href="public/css/hover.css" rel="stylesheet" />
	<link href="public/css/animate.css" rel="stylesheet" />
	<link href="public/icons/icon.min.css" rel="stylesheet" />
	<link href="public/css/thbank/thbanklogos.css" rel="stylesheet" />
	<link href="public/css/thbank/thbanklogos-colors.css" rel="stylesheet" />
	<link rel="stylesheet" href="api_spin/wheel.css">
        
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
			<script src="api_spin/wheel.js"></script>
			<script>
			$(window).on("load",function(){
			$(".loader-wrapper").fadeOut("slow");
			});
			var items = [
			<?php 
			$items = [
				['id'=>"0",'image'=>$wheel['unlucky']['image'],'name'=>'ไม่ได้รับรางวัล'],
			    ['id'=>"1",'image'=>$wheel['item'][1]['image'],'name'=>$wheel['item'][1]['name']],
			    ['id'=>"2",'image'=>$wheel['item'][2]['image'],'name'=>$wheel['item'][2]['name']],
			    ['id'=>"3",'image'=>$wheel['unlucky']['image'],'name'=>'ไม่ได้รับรางวัล'],
			    ['id'=>"4",'image'=>$wheel['item'][4]['image'],'name'=>$wheel['item'][4]['name']],
			    ['id'=>"5",'image'=>$wheel['item'][5]['image'],'name'=>$wheel['item'][5]['name']],
			];

			foreach($items as $key => $value){
			    ?>
			    { 	name: "<img src='<?= $value['image'] ?>' class='show-spin'></img>",
			        color: "#ed616f",
			        message: "คุณได้รับ <?= $value['name'] ?>",
			        id: "<?= $key ?>"
			    },
			    <?php

			}
			?>
			];
			var markercolor = "#ab1b2a";
			var centerlinecolor = "#dc3545";
			var slicelinecolor = "#dc3545";
			var outerlinecolor = "#dc3545";


			jQuery(document).ready(function() {
			tick = new Audio('css/tick.mp3');
			var lose = false;
			$('.spinners').easyWheel({
			    items: items,
			    duration: 8000,
			    rotates: 8,
			    frame: 1,
			    easing: "easyWheel",
			    rotateCenter: true,
			    type: "spin",
			    markerAnimation: true,
			    centerClass: 0,
			    width: 500,
			    fontSize: 13,
			    textOffset: 10,
			    letterSpacing: 0,
			    textLine: "v",
			    textArc: false,
			    shadowOpacity: 0,
			    sliceLineWidth: 1,
			    outerLineWidth: 5,
			    centerWidth: 40,
			    centerLineWidth: 3,
			    centerImageWidth: 25,
			    textColor: "#fff",
			    markerColor: markercolor,
			    centerLineColor: centerlinecolor,
			    centerBackground: "transparent",
			    centerImage: '<?= $wheel['center'] ?>',
			    centerWidth: 30,
			    centerImageWidth: 20,
			    sliceLineColor: slicelinecolor,
			    outerLineColor: outerlinecolor,
			    shadow: "#000",
			    selectedSliceColor: "rgb(66, 66, 66)",
			    button: '.spin-button',
			    frame: 1,
			    ajax: {
			        url: '',
			        type: 'POST',
			        nonce: true,
			        success: function(msg) {
			            if(msg.lose == true){
			                lose = true;
			            }else{
			                lose = false;
			            }
			        },
			        error: function(msg) {
			            res = msg.responseJSON;
			            alert(res.message)
			        }
			    },
			    onStart: function(results, spinCount, now) {},
			    onStep: function(results, slicePercent, circlePercent) {
			        if (typeof tick.currentTime !== 'undefined')
			            tick.currentTime = 0;
			        tick.play();
			    },
			    onProgress: function(results, spinCount, now) {
			        $(".spin-button").attr("disabled", true);
			        $(".spin-button").html("รอสักครู่...");
			    },
			    onComplete: function(results, count, now) {
			        $(".spin-button").attr("disabled", false);
			        $(".spin-button").html('<i class="fa fa-gamepad"></i>&nbsp;สุ่มวงล้อ (  <?= $wheel['bet'] ?> Point )');
			        if(lose == true){
			            Swal.fire({
			                title: 'แย่จัง',
			                icon: 'error',
			                html:
			                '<u class="text-danger">คุณไม่ได้รับรางวัล</u>',
			                confirmButtonText:'ตกลง',
			                confirmButtonColor:'#dc3545',
			            }).then(function(){
						location.reload();
						});
			        }else{
			            // console.log(results);
			            Swal.fire({
			                title: 'ยินดีด้วย',
			                icon: 'success',
			                html:
			                '<u class="text-success">'+results.message+'</u>',
			                confirmButtonText:'ตกลง',
			                confirmButtonColor:'#dc3545',
			            }).then(function(){
						location.reload();
						});
			        }
				
				
			    },
			    onFail: function(results, spinCount, now) {
			        Swal.fire({
			            title: 'ผิดพลาด',
			            icon: 'error',
			            html:
			            '<u class="text-danger">เครดิตไม่เพียงพอ</u>',
			            confirmButtonText:'ตกลง',
			            confirmButtonColor:'#dc3545',
			        })
			    },
			
			});
			});


		</script>


         </div>
      </div>
      <!-- end Section 1 main -->






















      <!-- ถ้าเรียกใช้แท็บ >> กลับหน้าหลัก -->
      <div class="backtohome button-resize-1" >
		<a href="/dashboard2">
         <span id="backtohome" style="cursor: pointer;">
         <i class="fas fa-home-lg-alt homebtn"></i> <i class="fal fa-long-arrow-left" style="font-weight: bold; color:#c5c5c5;">
         </i> กลับหน้าหลัก</span>
		</a>
      </div>
      <!-- ------------------------ -->


















      <!-- Deposit section -->
      <div  id="deposit" class="tabcontent">
         <div class="accordion-div">
            <div class="pdingaccord">
               <button class="accordion"><img  src="images/bank/bank.svg" height="50px" > &nbsp; 
               ธนาคาร
               </button>
               <div class="panel">
                  <div style="padding-top: 20px; padding-bottom: 20px;">
                     <div align="center" class="tabletruewallet">
                           <div style="text-align: center; width: 100%; font-size: 13px; padding: 5px;">
                              <img src="images/bank/scb.svg" width="70px" style="margin-bottom: 5px;"><br>
                              ธนาคารไทยพาณิชย์
                              <br>
                              418-1-17553-6<br>
                              อนุวัตร พิมสาร <br>
                              <button onclick="myAlertTop()" class="copybtn mcolor">คัดลอก<span hidden="">418-1-17553-6</span></button>
                           </div>
                           <!-- <div style="text-align: center; width: 100%; font-size: 13px; padding: 5px;">
                              <img src="images/bank/kbank.svg" width="70px"  style="margin-bottom: 5px;"><br>
                              กสิกรไทย
                              <br>
                              861-2-16048-2<br>
                              จีรพล มุสิกบุญเลิศ<br>
                              <button onclick="myAlertTop()" class="copybtn mcolor">คัดลอก<span hidden="">861-2-16048-2</span></button>
                           </div> -->
                     </div>
                  </div>
               </div>
            </div>
            <!-- <div class="pdingaccord">
               <button class="accordion" style="font-size: 20px;"><img src="images/bank/truewallet.png" height="30px"> &nbsp;<span style="color: #ed1c24;">true</span><span style="color: #f38020">money</span><span style="color: #fff"> wallet</span></button>
               <div class="panel">
                  <div style="padding-top: 10px; padding-bottom: 10px;">
                     <div align="center" class="tabletruewallet">
                       
                           <div style="text-align: center; width: 100%; font-size: 13px; padding: 5px;">
                              <img src="images/bank/truewallet.svg" width="70px" style="margin-bottom: 5px;"><br>
                              ทรูมันนี่วอลเล็ท
                              <br>
                              062-546-2593<br>
                              จีรพล มุสิกบุญเลิศ<br>
                              <button onclick="myAlertTop()" class="copybtn mcolor">คัดลอก<span hidden="">062-546-2593</span></button>
                           </div>
                           <div style="text-align: center; width: 100%; font-size: 13px; padding: 5px;">
                              <img src="images/bank/truewallet.svg" width="70px" style="margin-bottom: 5px;"><br>
                              ทรูมันนี่วอลเล็ท
                              <br>
                              062-539-8783<br>
                              จีรพล มุสิกบุญเลิศ<br>
                              <button onclick="myAlertTop()" class="copybtn mcolor">คัดลอก<span hidden="">062-539-8783</span></button>
                           </div>
                           <div style="text-align: center; width: 100%; font-size: 13px; padding: 5px;">
                              <img src="images/bank/truewallet.svg" width="70px" style="margin-bottom: 5px;"><br>
                              ทรูมันนี่วอลเล็ท
                              <br>
                              062-539-8783<br>
                              จีรพล มุสิกบุญเลิศ<br>
                              <button onclick="myAlertTop()" class="copybtn mcolor">คัดลอก<span hidden="">062-539-8783</span></button>
                           </div>
                        
                     </div>
                  </div>
               </div>
            </div> -->
         </div>
      </div>
      <!-- End Deposit section -->


















      <!-- Withdraw section -->
      <div id="withdraw" class="tabcontent">
         <div class="headerprocess"><i class="fal fa-minus-circle"></i> ถอนเงิน</div>
         <div style="padding: 20px;">
            <table class="tablewd01" align="center">
               <tr>
                  <td style="text-align: left;">
                     <span style="font-size: 20px; font-weight: bold;">ถอนเงินเข้าบัญชีธนาคาร</span> <br>
                     ชื่อ : <?php echo $row['fname']; ?> <br>
                     เลขที่บัญชี : <?php echo $row['bank_number']; ?> <br>
                     ธนาคาร<?php echo $row['bank_name']; ?>
                  </td>
                  <td style="text-align: center;">
                     <img src="images/bank/<?php echo $bank_svg; ?>.svg?v=1" width="70px">
                  </td>
               </tr>
            </table>
         </div>
         <div style="padding: 0px 25px;">
            <div class="wdsec02">
               <table class="tablewd01" align="center">
                  <tr>
                     <td> จำนวนเงินที่ถอนได้</td>
                     <td style="text-align: right;"> ยอดถอนขั้นต่ำ</td>
                  </tr>
                  <tr>
                     <td>฿ <?php echo number_format($row['credit'],2); ?>
                     </td>
                     <td style="text-align: right;"> ฿ 100.00</td>
                  </tr>
               </table>
            </div>
         </div>
         <div class="tablewd01" style=" margin: 10px auto;">
            <div style="padding: 20px;">
               <div>
                  <span>
                     <label style="color:red;font-size: 17px;font-weight: bold;">*ยอดเทริน์ยังเหลืออยู่อีก <?php echo $row['turnover'] ?> บาทจึงจะทำการถอนเงินได้</label>
                  </span>
               </div>
               <div class="form-group">
                  <span style="font-size: 15px;">
                  จำนวนเงินที่ต้องการถอน
                  </span>
                  <input type="text" id="amount" class="form-control loginform01 number" placeholder="฿ 0.00" style="padding: 10px; margin-top: 10px;" >
               </div>
            </div>
         </div>
         <div style="text-align: center; margin-top: -10px;  padding:0px 30px;">
            <button class="mcolor colorbtn01" onclick="withdraw()"><i class="fal fa-hand-holding-usd"></i> ยืนยันการถอน</button>
         </div>
      </div>
      <!-- End Withdraw section -->

   
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


















      <!-- password section -->
      <div  id="password" class="tabcontent">
         <div class="headerprocess"><i class="fal fa-lock" style="font-size: 30px;"></i> เปลี่ยนรหัสผ่าน</div>
         <div class="containprocess " style="padding: 0 30px;">
            <!-- <form> -->
               <div style="margin-top: 10px;">
                  <label for="exampleInputEmail1">รหัสผ่านใหม่</label>
                  <div class="iconlogin">
                     <i class="fal fa-lock" style="font-size: 20px;"></i>
                  </div>
                  <input type="password" class="form-control loginform01" id="newpass" name="newpass" placeholder="กรอกรหัสผ่านใหม่">
               </div>
               <div style="margin-top: 20px;">
                  <label for="exampleInputEmail1">ยืนยันรหัสผ่านใหม่</label>
                  <div class="iconlogin">
                     <i class="fal fa-lock" style="font-size: 20px;"></i>
                  </div>
                  <input type="password" class="form-control loginform01" id="confrim" name="confrim" placeholder="ยืนยันรหัสผ่านใหม่">
               </div>
               <div class="text-center mt-4">
                  <button class="mcolor colorbtn01" onclick="chnag_pass()"><i class="fal fa-sign-in"></i> เข้าสู่ระบบ</button>
               </div>
            <!-- </form> -->
         </div>
      </div>
      <!-- End password section -->

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












<?php
   $sql= "SELECT * FROM `promotion` WHERE `p_name`='โปร สมาชิกใหม่' or `p_name`='ฝากครั้งแรกของวัน' or `p_name`='รับทุกครั้งที่ฝากเงิน'";
   $result = $server->query($sql);
   $res=[];
   foreach ($result as  $value) {
     array_push($res, $value);
   
   }

?>


      <!-- promotion section -->
      <div  id="promotion" class="tabcontent">
         <div class="headerprocess"><i class="fal fa-gift"></i> โปรโมชั่น</div>
         <div class="containprocess containpromotion">
            <div class="swiper-container">
               <div class="swiper-wrapper">
                  <?php $i=1; foreach ($res as $key => $value) {?>
                     <div class="swiper-slide" style="background-image:url('manager/<?=$value['image']; ?>')">
                        <div class="detailpro">
                           <i class="fad fa-circle-notch"></i> <?=$value['description']; ?> <br>
                           <i class="fad fa-circle-notch"></i> หากทีมงานตรวจสอบพบรายการลูกค้าเข้าค่ายการล่าโปร ขอระงับการจ่ายเงินทุกกรณี
                           <br>
                           <div style="text-align: center;">
                              <button class="btnbonus mcolor" onclick="give('<?=$value['p_id']; ?>')">รับโบนัส</button>
                           </div>
                        </div>
                     </div>
                  <?php $i++; }  ?>   
                  <!-- <div class="swiper-slide" style="background-image:url('images/promotion/2.jpg')">
                     <div class="detailpro">
                        <i class="fad fa-circle-notch"></i> สมัครใหม่ รับโบนัสฟรี 30%  <br>
                        <i class="fad fa-circle-notch"></i> ฟรีสูงสุด 2,000 เครดิต ถอนไม่อั้น
                        <br>
                        <div style="text-align: center;">
                           <button class="btnbonus mcolor">รับโบนัส</button>
                        </div>
                     </div>
                  </div>
                  <div class="swiper-slide" style="background-image:url('images/promotion/4.jpg')">
                     <div class="detailpro">
                        <i class="fad fa-circle-notch"></i> รับโบนัสจุใจตลอดทั้งวัน 10% ถอนไม่อั้น <br>
                        <i class="fad fa-circle-notch"></i> ทำเทิร์น 1 เท่า
                        <br>
                        <div style="text-align: center;">
                           <button class="btnbonus mcolor">รับโบนัส</button>
                        </div>
                     </div>
                  </div>
                  <div class="swiper-slide" style="background-image:url('images/promotion/3.jpg')">
                     <div class="detailpro">
                        <i class="fad fa-circle-notch"></i> ไม่รับโบนัส <br>
                        <i class="fad fa-circle-notch"></i> ได้เสียเท่าไหร่ถอนได้ทันที
                        <br>
                        <div style="text-align: center;">
                           <button class="btnbonus mcolor">รับโบนัส</button>
                        </div>
                     </div>
                  </div> -->
               </div>
               <!-- Add Pagination -->
            </div>
            <button class="btnnext bkcolor"><i class="fad fa-chevron-right"></i></button>
            <button class="btnprev bkcolor"><i class="fad fa-chevron-left"></i></button>
         </div>
      </div>
      <!-- End promotion section -->

<script>
  function give(data){
    var id=data;
    var phone="<?php echo $row["phone"]; ?>";
    $.ajax({
      url:'action.php?bonus_new',
      type:'POST',
      data:{
        id:id,
        phone:phone
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













<?php
$sql_rfid = "SELECT * FROM refill WHERE phone='".$_SESSION['phone']."' ORDER by id DESC limit 5";
$result_rfid = $server->query($sql_rfid);
$res_rfid=[];
foreach ($result_rfid as  $value) {
  array_push($res_rfid, $value);
}

$sql_withdraw = "SELECT * FROM withdraw WHERE phone='".$_SESSION['phone']."' ORDER by id DESC limit 5";
$result_withdraw = $server->query($sql_withdraw);
$res_withdraw=[];
foreach ($result_withdraw as  $value1) {
  array_push($res_withdraw, $value1);
  
}
?>


      <!-- history section -->
      <div  id="history" class="tabcontent">
         <div class="headerprocess"><i class="fal fa-history"></i> ประวัติ</div>
         <div class="containprocess " style="margin-top: 10px;">
            <table style="width: 100%;">
               <thead style="text-align: center;">
                  <th class="headdeposit active">
                     <button id="btndeposithis"><i class="fal fa-plus-circle" style="color: #85c185;"></i> ประวัติการฝาก</button>
                  </th>
                  <th class="headwithdraw">
                     <button id="btnwithdrawwhis"><i class="fal fa-minus-circle" style="color: red;"></i> ประวัติการถอน</button>
                  </th>
               </thead>
            </table>
            <div id="deposithis">
               แสดงข้อมูล<span style="color: #9fe7a0;">ฝากเงิน</span> 5 รายการย้อนหลังล่าสุด
               <div class="containloophisdps">
                  <!-- Loop หน้าฝากเงิน -------------------------------------------------------------- -->
                  <!-- <div class="historyofdps">
                     <table width="100%">
                        <tr>
                           <td width="50%" style="padding-top: 7px;">
                              <table>
                                 <tr>
                                    <td style="padding-right: 5px;"> <img class="backlogohis" src="images/bank/scb.svg"></td>
                                    <td style="text-align: left; line-height: 20px;">
                                       <span class="spanofbankhis">ธนาคารไทยพาณิชย์</span>
                                       <br>
                                       <span class="spanofbankhis">859-2-59209-0</span>
                                    </td>
                                 </tr>
                              </table>
                           </td>
                           <td width="50%" style="text-align: right; line-height: 20px;">
                              <div class="statushistory"> <span style="background: #c98e15;">รอดำเนินการ</span></div>
                              <span class="moneyhisdps"> <i class="fal fa-plus-circle plushis"></i> 250,000.00 บาท</span>
                              <br>
                              <span style="font-size: 11px;">15/02/2021 05:50:34</span>
                           </td>
                        </tr>
                     </table>
                  </div> -->
                  <?php $i=1; foreach ($res_rfid as $key => $value) {?>
                  <div class="historyofdps">
                     <table width="100%">
                        <tr>
                           <td width="50%" style="padding-top: 7px;">
                              <!-- <table>
                                 <tr>
                                    <td style="padding-right: 5px;"> <img class="backlogohis" src="images/bank/kbank.svg"></td>
                                    <td style="text-align: left; line-height: 20px;">
                                       <span class="spanofbankhis">ธนาคารกสิกรไทย</span>
                                       <br>
                                       <span class="spanofbankhis">861-2-16048-2</span>
                                    </td>
                                 </tr>
                              </table> -->
                           </td>
                           <td width="50%" style="text-align: right; line-height: 20px;">
                              <div class="statushistory"> <span>สำเร็จ</span></div>
                              <span class="moneyhisdps"> <i class="fal fa-plus-circle plushis"></i> <?=number_format($value['amount'],2); ?> บาท</span>
                              <br>
                              <span style="font-size: 11px;"><?=$value ['date_check']; ?> <?=$value ['time_check']; ?></span>
                           </td>
                        </tr>
                     </table>
                  </div>
                  <?php $i++; }  ?>
                  <!-- <div class="historyofdps">
                     <table width="100%">
                        <tr>
                           <td width="50%" style="padding-top: 7px;">
                              <table>
                                 <tr>
                                    <td style="padding-right: 5px;"> <img class="backlogohis" src="images/bank/truewallet.svg"></td>
                                    <td style="text-align: left; line-height: 20px;">
                                       <span class="spanofbankhis">ทรูมันนี่วอลเลต</span>
                                       <br>
                                       <span class="spanofbankhis">062-546-2593</span>
                                    </td>
                                 </tr>
                              </table>
                           </td>
                           <td width="50%" style="text-align: right; line-height: 20px;">
                              <div class="statushistory"> <span style="background: #db1b1b;">ไม่สำเร็จ</span></div>
                              <span class="moneyhisdps"> <i class="fal fa-plus-circle plushis"></i> 5,000.00 บาท</span>
                              <br>
                              <span style="font-size: 11px;">15/01/2021 05:50:34</span>
                           </td>
                        </tr>
                     </table>
                  </div>
                  <div class="historyofdps">
                     <table width="100%">
                        <tr>
                           <td width="50%" style="padding-top: 7px;">
                              <table>
                                 <tr>
                                    <td style="padding-right: 5px;"> <img class="backlogohis" src="images/bank/scb.svg"></td>
                                    <td style="text-align: left; line-height: 20px;">
                                       <span class="spanofbankhis">ธนาคารไทยพาณิชย์</span>
                                       <br>
                                       <span class="spanofbankhis">859-2-59209-0</span>
                                    </td>
                                 </tr>
                              </table>
                           </td>
                           <td width="50%" style="text-align: right; line-height: 20px;">
                              <div class="statushistory"> <span style="background: #c98e15;">รอดำเนินการ</span></div>
                              <span class="moneyhisdps"> <i class="fal fa-plus-circle plushis"></i> 250,000.00 บาท</span>
                              <br>
                              <span style="font-size: 11px;">15/02/2021 05:50:34</span>
                           </td>
                        </tr>
                     </table>
                  </div>
                  <div class="historyofdps">
                     <table width="100%">
                        <tr>
                           <td width="50%" style="padding-top: 7px;">
                              <table>
                                 <tr>
                                    <td style="padding-right: 5px;"> <img class="backlogohis" src="images/bank/kbank.svg"></td>
                                    <td style="text-align: left; line-height: 20px;">
                                       <span class="spanofbankhis">ธนาคารกสิกรไทย</span>
                                       <br>
                                       <span class="spanofbankhis">861-2-16048-2</span>
                                    </td>
                                 </tr>
                              </table>
                           </td>
                           <td width="50%" style="text-align: right; line-height: 20px;">
                              <div class="statushistory"> <span>สำเร็จ</span></div>
                              <span class="moneyhisdps"> <i class="fal fa-plus-circle plushis"></i> 50,000.00 บาท</span>
                              <br>
                              <span style="font-size: 11px;">09/02/2021 01:50:34</span>
                           </td>
                        </tr>
                     </table>
                  </div>
                  <div class="historyofdps">
                     <table width="100%">
                        <tr>
                           <td width="50%" style="padding-top: 7px;">
                              <table>
                                 <tr>
                                    <td style="padding-right: 5px;"> <img class="backlogohis" src="images/bank/truewallet.svg"></td>
                                    <td style="text-align: left; line-height: 20px;">
                                       <span class="spanofbankhis">ทรูมันนี่วอลเลต</span>
                                       <br>
                                       <span class="spanofbankhis">062-546-2593</span>
                                    </td>
                                 </tr>
                              </table>
                           </td>
                           <td width="50%" style="text-align: right; line-height: 20px;">
                              <div class="statushistory"> <span style="background: #db1b1b;">ไม่สำเร็จ</span></div>
                              <span class="moneyhisdps"> <i class="fal fa-plus-circle plushis"></i> 5,000.00 บาท</span>
                              <br>
                              <span style="font-size: 11px;">15/01/2021 05:50:34</span>
                           </td>
                        </tr>
                     </table>
                  </div> -->
                  <!-- End Loop หน้าฝากเงิน -------------------------------------------------------------- -->
               </div>
            </div>
            <div id="withdrawwhis" >
               แสดงข้อมูล<span style="color: #ff8989;">ถอนเงิน</span> 5 รายการย้อนหลังล่าสุด
               <div class="containloophiswd">
                  <!-- Loop หน้าถอนงิน -------------------------------------------------------------- -->
                  <!-- <div onclick="opentab(event, 'slip')"  class="historyofwd">
                     <table width="100%">
                        <tr>
                           <td width="50%" style="padding-top: 7px;">
                              <table>
                                 <tr>
                                    <td style="padding-right: 5px;"> <img class="backlogohis" src="images/bank/scb.svg"></td>
                                    <td style="text-align: left; line-height: 20px;">
                                       <span class="spanofbankhis">ธนาคารไทยพาณิชย์</span>
                                       <br>
                                       <span class="spanofbankhis">859-2-59209-0</span>
                                    </td>
                                 </tr>
                              </table>
                           </td>
                           <td width="50%" style="text-align: right; line-height: 20px;">
                              <div class="statushistory"> <span style="background: #c98e15;">รอดำเนินการ</span></div>
                              <span class="moneyhisdps"> <i class="fal fa-minus-circle minushis"></i> 250,000.00 บาท</span>
                              <br>
                              <span style="font-size: 11px;">15/02/2021 05:50:34</span>
                           </td>
                        </tr>
                     </table>
                  </div> -->
                  <?php $i=1; foreach ($res_withdraw as $key => $value) {?>
                  <!-- <div onclick="opentab(event, 'slip')" class="historyofwd"> -->
                  <div class="historyofwd">
                     <table width="100%">
                        <tr>
                           <td width="50%" style="padding-top: 7px;">
                              <table>
                                 <tr>
                                    <!-- <td style="padding-right: 5px;"> <img class="backlogohis" src="images/bank/kbank.svg"></td> -->
                                    <td style="text-align: left; line-height: 20px;">
                                       <span class="spanofbankhis"><?=$value ['description']; ?></span>
                                       <!-- <br>
                                       <span class="spanofbankhis">861-2-16048-2</span> -->
                                    </td>
                                 </tr>
                              </table>
                           </td>
                           <td width="50%" style="text-align: right; line-height: 20px;">
                           <?php
                               $status=$value['status'];
                               if ($status==1) {
                                 echo '<div class="statushistory"> <span style="background: #c98e15;">รอดำเนินการ</span></div>';
                               }
                               if ($status==2) {
                                 echo '<div class="statushistory"> <span style="background: #db1b1b;">ไม่สำเร็จ</span></div>';
                               }
                               if ($status==0) {
                                echo '<div class="statushistory"> <span>สำเร็จ</span></div>';
                              }
                           ?>  
                              
                              <span class="moneyhisdps"> <i class="fal fa-minus-circle minushis"></i> <?=number_format($value['credit'],2); ?> บาท</span>
                              <br>
                              <span style="font-size: 11px;"><?=$value ['date_withdraw']; ?> <?=$value ['time_withdraw']; ?></span>
                           </td>
                        </tr>
                     </table>
                  </div>
                  <?php $i++; }  ?>
                  <!-- <div onclick="opentab(event, 'slip')" class="historyofwd">
                     <table width="100%">
                        <tr>
                           <td width="50%" style="padding-top: 7px;">
                              <table>
                                 <tr>
                                    <td style="padding-right: 5px;"> <img class="backlogohis" src="images/bank/truewallet.svg"></td>
                                    <td style="text-align: left; line-height: 20px;">
                                       <span class="spanofbankhis">ทรูมันนี่วอลเลต</span>
                                       <br>
                                       <span class="spanofbankhis">062-546-2593</span>
                                    </td>
                                 </tr>
                              </table>
                           </td>
                           <td width="50%" style="text-align: right; line-height: 20px;">
                              <div class="statushistory"> <span style="background: #db1b1b;">ไม่สำเร็จ</span></div>
                              <span class="moneyhisdps"> <i class="fal fa-minus-circle minushis"></i> 5,000.00 บาท</span>
                              <br>
                              <span style="font-size: 11px;">15/01/2021 05:50:34</span>
                           </td>
                        </tr>
                     </table>
                  </div>
                  <div onclick="opentab(event, 'slip')" class="historyofwd">
                     <table width="100%">
                        <tr>
                           <td width="50%" style="padding-top: 7px;">
                              <table>
                                 <tr>
                                    <td style="padding-right: 5px;"> <img class="backlogohis" src="images/bank/scb.svg"></td>
                                    <td style="text-align: left; line-height: 20px;">
                                       <span class="spanofbankhis">ธนาคารไทยพาณิชย์</span>
                                       <br>
                                       <span class="spanofbankhis">859-2-59209-0</span>
                                    </td>
                                 </tr>
                              </table>
                           </td>
                           <td width="50%" style="text-align: right; line-height: 20px;">
                              <div class="statushistory"> <span style="background: #c98e15;">รอดำเนินการ</span></div>
                              <span class="moneyhisdps"> <i class="fal fa-minus-circle minushis"></i> 250,000.00 บาท</span>
                              <br>
                              <span style="font-size: 11px;">15/02/2021 05:50:34</span>
                           </td>
                        </tr>
                     </table>
                  </div>
                  <div onclick="opentab(event, 'slip')" class="historyofwd">
                     <table width="100%">
                        <tr>
                           <td width="50%" style="padding-top: 7px;">
                              <table>
                                 <tr>
                                    <td style="padding-right: 5px;"> <img class="backlogohis" src="images/bank/kbank.svg"></td>
                                    <td style="text-align: left; line-height: 20px;">
                                       <span class="spanofbankhis">ธนาคารกสิกรไทย</span>
                                       <br>
                                       <span class="spanofbankhis">861-2-16048-2</span>
                                    </td>
                                 </tr>
                              </table>
                           </td>
                           <td width="50%" style="text-align: right; line-height: 20px;">
                              <div class="statushistory"> <span>สำเร็จ</span></div>
                              <span class="moneyhisdps"> <i class="fal fa-minus-circle minushis"></i> 50,000.00 บาท</span>
                              <br>
                              <span style="font-size: 11px;">09/02/2021 01:50:34</span>
                           </td>
                        </tr>
                     </table>
                  </div>
                  <div onclick="opentab(event, 'slip')" class="historyofwd">
                     <table width="100%">
                        <tr>
                           <td width="50%" style="padding-top: 7px;">
                              <table>
                                 <tr>
                                    <td style="padding-right: 5px;"> <img class="backlogohis" src="images/bank/truewallet.svg"></td>
                                    <td style="text-align: left; line-height: 20px;">
                                       <span class="spanofbankhis">ทรูมันนี่วอลเลต</span>
                                       <br>
                                       <span class="spanofbankhis">062-546-2593</span>
                                    </td>
                                 </tr>
                              </table>
                           </td>
                           <td width="50%" style="text-align: right; line-height: 20px;">
                              <div class="statushistory"> <span style="background: #db1b1b;">ไม่สำเร็จ</span></div>
                              <span class="moneyhisdps"> <i class="fal fa-minus-circle minushis"></i> 5,000.00 บาท</span>
                              <br>
                              <span style="font-size: 11px;">15/01/2021 05:50:34</span>
                           </td>
                        </tr>
                     </table>
                  </div> -->
                  <!-- End Loop หน้าถอนเงิน -------------------------------------------------------------- -->
               </div>
            </div>
         </div>
      </div>
      <!-- End history section -->



























      <!-- language section -->
      <div  id="language" class="tabcontent">
         <div class="headerprocess"><i class="fal fa-language"></i> ภาษา / Language</div>
         <div class="containprocess " style="margin-top: 10px;">
            <table width="260px" align="center">
               <tr>
                  <td style="text-align: center; width: 50%;">
                     <img src="images/language/th.svg" width="90px"><br>ไทย
                  </td>
                  <td style="text-align: center; width: 50%;">
                     <img src="images/language/en.svg" width="90px"><br>English
                  </td>
               </tr>
            </table>
         </div>
      </div>
      <!-- End language section -->



























      <!-- playgame section -->
      <div  id="playgame" class="tabcontent">
         <div class="headerprocess"><i class="fal fa-gamepad-alt"></i> เข้าเล่นเกม</div>
         <div class="containprocess " style="padding-top: 20px;">
            <table width="100%">
               <tr>
                  <td class="gameingtd active">
                     <div class="bkcolor tablinkgame" onclick="opengame(event, 'casino')" id="dfgameOpen"><span><i class="fal fa-spade"></i> คาสิโน</span></div>
                  </td>
                  <td class="gameingtd">
                     <div class="bkcolor tablinkgame" onclick="opengame(event, 'slot')"><span><i class="fal fa-dice"></i> สล็อต</span></div>
                  </td>
                  <td class="gameingtd">
                     <div class="bkcolor tablinkgame" onclick="opengame(event, 'game')"><span><i class="fal fa-gamepad-alt"></i> เกม</span></div>
                  </td>
                  <td class="gameingtd">
                     <div class="bkcolor tablinkgame" onclick="opengame(event, 'huay')"><span><i class="fal fa-sort-numeric-up-alt"></i> หวย</span></div>
                  </td>
               </tr>
            </table>
            <div id="casino" class="tabgame">
               <div class="gridofgame">
                  <!-- เกม Casino  -->
                  <div class="ingridgame">
                     <div class="iningridgame"><img src="images/allgame/sexy.png"><br>Sexy</div>
                  </div>
                  <!-- เกม Casino  -->
                  <div class="ingridgame">
                     <div class="iningridgame"><img src="images/allgame/sagaming.png"><br>Sa Gaming</div>
                  </div>
                  <!-- เกม Casino  -->
                  <div class="ingridgame">
                     <div class="iningridgame"><img src="images/allgame/wm_logo_100x87.png"><br>WM</div>
                  </div>
                  <!-- เกม Casino  -->
                  <div class="ingridgame">
                     <div class="iningridgame"><img src="images/allgame/biggaming.png"><br>BG</div>
                  </div>
                  <!-- เกม Casino  -->
                  <div class="ingridgame">
                     <div class="iningridgame"><img src="images/allgame/luckystreak.png"><br>Lucky Streak</div>
                  </div>
                  <!-- เกม Casino  -->
                  <div class="ingridgame">
                     <div class="iningridgame"><img src="images/allgame/venus.png"><br>Venus</div>
                  </div>
               </div>
            </div>
            <div id="slot" class="tabgame">
               <div class="gridofgame">
                  <!-- เกม Slot  -->
                  <div class="ingridgame">
                     <div class="iningridgame"><img src="images/allgame/JDB.png"><br>JDB</div>
                  </div>
                  <!-- เกม Slot  -->
                  <div class="ingridgame">
                     <div class="iningridgame"><img src="images/allgame/joker.png"><br>JOKER</div>
                  </div>
                  <!-- เกม Slot  -->
                  <div class="ingridgame">
                     <div class="iningridgame"><img src="images/allgame/PGlogo2.png"><br>PG</div>
                  </div>
                  <!-- เกม Slot  -->
                  <div class="ingridgame">
                     <div class="iningridgame"><img src="images/allgame/tgp_redt.png"><br>Red Tiger</div>
                  </div>
                  <!-- เกม Slot  -->
                  <div class="ingridgame">
                     <div class="iningridgame"><img src="images/allgame/FC.png"><br>FC</div>
                  </div>
                  <!-- เกม Slot  -->
                  <div class="ingridgame">
                     <div class="iningridgame"><img src="images/allgame/tgp_sg.png"><br>tgp_sg</div>
                  </div>
                  <!-- เกม Slot  -->
                  <div class="ingridgame">
                     <div class="iningridgame"><img src="images/allgame/FG.png"><br>FG</div>
                  </div>
               </div>
            </div>
            <div id="game" class="tabgame">
               <div class="gridofgame">
                  <!-- เกม   -->
                  <div class="ingridgame">
                     <div class="iningridgame"><img src="images/allgame/pok-deng-pok89.png"><br>ป๊อกเด้ง</div>
                  </div>
                  <!-- เกม   -->
                  <div class="ingridgame">
                     <div class="iningridgame"><img src="images/allgame/joker.png"><br>Joker Fishing</div>
                  </div>
                  <!-- เกม   -->
                  <div class="ingridgame">
                     <div class="iningridgame"><img src="images/allgame/kingmaker1010.png"><br>Kingmaker</div>
                  </div>
                  <!-- เกม   -->
                  <div class="ingridgame">
                     <div class="iningridgame"><img src="images/allgame/JDB.png"><br>JDB Fishing</div>
                  </div>
                  <!-- เกม   -->
                  <div class="ingridgame">
                     <div class="iningridgame"><img src="images/allgame/tgp_sg.png"><br>SG Fishing</div>
                  </div>
                  <!-- เกม   -->
                  <div class="ingridgame">
                     <div class="iningridgame"><img src="images/allgame/FG.png"><br>FG Fishing</div>
                  </div>
                  <!-- เกม   -->
                  <div class="ingridgame">
                     <div class="iningridgame"><img src="images/allgame/ameIcon_512.png"><br>BG Fishing</div>
                  </div>
                  <!-- เกม   -->
                  <div class="ingridgame">
                     <div class="iningridgame"><img src="images/allgame/bgfishing.png"><br>BG Xlyou</div>
                  </div>
               </div>
            </div>
            <div id="huay" class="tabgame">
               <div class="iningridgame" style="text-align: center;"><img src="images/allgame/gball.png" width="60%" height="100%"><br>GBall</div>
            </div>
         </div>
      </div>
      <!-- End playgame section -->











































      <!-- friend section -->
      <div  id="friend" class="tabcontent">
         <div class="containfriend">
            <div class="bgcutinfriend">
               <div class="headerprocess"><i class="fal fa-users"></i> พันธมิตร</div>
               <div class="wrapgrid001">
                  <div class="inwrapgrid001">
                     <div class="ininwrapgrid001" onclick="openfriendtab(event, 'allfriend')" id="tabfriendopen">
                        <i class="far fa-handshake"></i><br>
                        ภาพรวม
                     </div>
                  </div>
                  <div class="inwrapgrid001">
                     <div class="ininwrapgrid001 " onclick="openfriendtab(event, 'friendtabs')">
                        <i class="far fa-handshake"></i><br>
                        เพื่อน
                     </div>
                  </div>
                  <div class="inwrapgrid001">
                     <div class="ininwrapgrid001  " onclick="openfriendtab(event, 'moneyfriendtabs')">
                        <i class="far fa-handshake"></i><br>
                        รายได้
                     </div>
                  </div>
                  <div class="inwrapgrid001">
                     <div class="ininwrapgrid001  " onclick="openfriendtab(event, 'withdrawfriendtabs')">
                        <i class="far fa-handshake"></i><br>
                        ถอนรายได้
                     </div>
                  </div>
               </div>
               <div class="moneycontainaf">
                  <table width="100%">
                     <tbody>
                        <tr>
                           <td>
                              <i class="fas fa-users-crown"></i>
                           </td>
                           <td style="text-align: right;">
                              รายได้ปัจจุบัน / รับไปทั้งหมด <br>
                              <span style="font-size: 25px; color: #fddc8c;">0.00 / 0.00</span>
                              <br>
                              <div style="position: relative;">
                                 <span class="countearnmoney">
                                 <i class="fad fa-money-bill"></i>
                                 อัตราส่วนแบ่งรายได้ (2 ชั้น)</span>
                                 <!-- ปุ่มถอนรายได้ form>....... -->
                                 <br> 
                                 <div id="withdrawfriend">
                                    <button  class="btn-grad" type="submit"><i class="fas fa-hand-holding-usd"></i> แจ้งถอนรายได้</button>
                                 </div>
                                 <!-- </from>................ -->
                              </div>
                           </td>
                        </tr>
                     </tbody>
                  </table>
                  <div class="pcfriendback">
                     <table style="width: 100%;">
                        <tbody>
                           <tr>
                              <td class="text-left">
                                 <i class="fad fa-coins" style="font-size: 20px;"></i> <span>ส่วนแบ่งรายได้ชั้นที่ 1</span>
                              </td>
                              <td class="text-right">
                                 <span style="font-size: 20px;">10 %</span>
                              </td>
                           </tr>
                        </tbody>
                     </table>
                     <table style="width: 100%;">
                        <tbody>
                           <tr>
                              <td class="text-left">
                                 <i class="fad fa-coins" style="font-size: 20px;"></i> <span>ส่วนแบ่งรายได้ชั้นที่ 2</span>
                              </td>
                              <td class="text-right">
                                 <span style="font-size: 20px;">5 %</span>
                              </td>
                           </tr>
                        </tbody>
                     </table>
                     <div class="containlinkcopy">
                        ลิงค์แนะนำ
                        <table style="width: 100%;">
                           <tbody>
                              <tr>
                                 <td width="80%" style="text-align: center;">
                                    <input class="friendlink" id="url" type="text" name="link" readonly="" value="<?php echo str_replace("dashboard", "", $actual_link); ?>register?ref=<?php 
									if($row['username_game']==""){echo "xxx"; }else{echo $row['username_game'];};
								?>">
                                 </td>
                                 <td width="20%" style="text-align: right;">
                                    <button onclick="copyToClipboard(url)" class="btnfriendback02">คัดลอกลิงค์</button>
                                 </td>
                              </tr>
                           </tbody>
                        </table>
                     </div>
                  </div>
               </div>
               <div id="allfriend" class="friendcontent" >
                  <div style=" padding:0 30px; padding-top: 10px; text-align: center; ">
                     <span class="detailaf">รายละเอียด</span>
                     <div role="alert" class="indetail">
                        <div class="row" style="padding-top: 5px;">
                           <div class="col-6 text-left">
                              <span>เพื่อนทั้งหมด</span>
                           </div>
                           <div class="col-4 text-right">0</div>
                           <div class="col-2">คน</div>
                        </div>
                        <div class="row" style="padding-top: 5px;">
                           <div class="col-6 text-left">
                              <span>เพื่อนที่ฝาก</span>
                           </div>
                           <div class="col-4 text-right">0</div>
                           <div class="col-2">คน</div>
                        </div>
                        <div class="row" style="padding-top: 5px;">
                           <div class="col-6 text-left">
                              <span>ยอดฝาก</span>
                           </div>
                           <div class="col-4 text-right">0.00</div>
                           <div class="col-2">บาท</div>
                        </div>
                        <div class="row" style="padding-top: 5px;">
                           <div class="col-6 text-left">
                              <span>ยอดแทงเสีย</span>
                           </div>
                           <div class="col-4 text-right">0.00</div>
                           <div class="col-2">C</div>
                        </div>
                     </div>
                  </div>
                  <div class="alert01 mt-1" role="alert01" style="font-size: 11px; text-align: left; color:white;">
                     <span style="font-size: 20px;color: #e8c675;">ระบบพันธมิตร</span> 
                     หารายได้กับเราง่ายๆเพียงแค่ท่านแชร์ลิ้งแนะนำเพื่อนออกไป ท่านก็สามารถรับรายได้จากยอดแทงเสียของเพื่อนไปเลย
                  </div>
               </div>
               <div id="friendtabs" class="friendcontent">
                  <div style="margin-top: 15px; position: relative;text-align: center;">  <span class="detailaf">รายชื่อเพื่อน</span></div>
                  <div class="divoffriends">
                  </div>
               </div>
               <div id="moneyfriendtabs" class="friendcontent">
                  <div style="padding:10px;">เลือกเดือน</div>
                  <div class="divoffriends">
                     <input type="month" id="month" name="month" class="form-control" value="2021-03">
                  </div>
               </div>
               <div id="withdrawfriendtabs" class="friendcontent">
                  <div class="wranningwd" style="padding:10px;"><span class="detailaf">คำอธิบาย</span>รายได้ที่เกิดขึ้นในวันนี้จะสามารถทำการถอนได้ในวันถัดไป</div>
                  <div class="divoffriends">
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- End friend section -->


<script>
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



























      <!-- comis section -->
      <div  id="comis" class="tabcontent">
         <div class="headerprocess"><i class="fal fa-hands-usd"></i> คอมมิชชั่น</div>
         <div class="containprocess" style="padding: 0 20px;">
            <div class="moneyfriend">
               <div style="font-size: 15px; color: #fff;">ยอดทั้งหมด</div>
               <div style="margin-top: 5px;  font-weight: bold;">
                  <table style="width: 100%;">
                     <tbody>
                        <tr>
                           <td class="cashbmoney">
                              ฿ <?php echo number_format($row['balance_affliliate'],2); ?>
                           </td>
                           <td style="width: 50%; text-align: right;">
                              <button class="btncashback02 mcolor" onclick="commission()">ถอนเงิน</button>
                           </td>
                        </tr>
                     </tbody>
                  </table>
               </div>
               <!-- <div class="pccashback">
                  <table width="100%" style="white-space: nowrap;">
                     <tbody>
                        <tr>
                           <td style="width: 33.3%; text-align: center;">
                              ยอดวันนี้ <br> <span style="color: #fff; font-size: 14px;">฿ 3009.00</span>
                           </td>
                           <td style="width: 33.3%; text-align: center;">
                              ที่สามารถรับได้ <br> <span style="color: #fff; font-size: 14px;">฿ 3009.00</span>
                           </td>
                           <td style="width: 33.3%; text-align: center;">
                              จ่ายแล้ว <br> <span style="color: #fff; font-size: 14px;">฿ 3009.00</span>
                           </td>
                        </tr>
                     </tbody>
                  </table>
               </div> -->
            </div>
         </div>
      </div>
      <!-- End comis section -->

<script>
      function commission() {
				var phone = "<?php echo $_SESSION["phone"] ?>";
				var amount="<?php echo $row['balance_affliliate']; ?>";
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






















      <!-- slip section -->
      <div  id="slip" class="tabcontent">
         <div class="headerprocess"><i class="fal fa-minus-circle" style="color: #dd7b7b;"></i> ประวัติการถอนเงิน</div>
         <div class="containprocess" style="padding: 0 20px;">
            <div class="slipimage">
               <div style="padding-bottom: 10px;">
                  <img src="images/logo/logotext.png" height="70px">
               </div>
               <div class="infoslip">
                  <table align="center" style="margin-bottom: 10px;">
                     <tbody>
                        <tr>
                           <td style="padding: 0 5px;">
                              <i class="fas fa-check-circle" style="color: green; font-size:40px;"></i>
                           </td>
                           <td style="text-align: left;">
                              <span style="color: green; font-size: 20px; font-weight: bold; ">
                              ถอนเงินสำเร็จ
                              </span><br>
                              <div style="line-height: 17px;">
                                 <span style="color: black;">
                                 13 กพ 64 12:12 น.
                                 </span>
                                 <br> <span style="color: black; font-size: 12px;">
                                 เลขที่รายการ:       654065</span>
                              </div>
                           </td>
                        </tr>
                     </tbody>
                  </table>
                  <hr style="border-top: 1px solid #f2cf1a; margin: 3px 0; width: 100%;">
                  <table align="center" style="color: black; font-size: 20px;">
                     <tbody>
                        <tr>
                           <td style="height: 20px; vertical-align: top;">
                              จำนวน:  <span style="font-weight: bold;">
                              80,000.00 บาท     </span>
                           </td>
                        </tr>
                     </tbody>
                  </table>
                  <hr style="border-top: 1px solid #f2cf1a; margin: 2px; width: 100%;">
                  <table align="center" style="color: black; width: 100%;">
                     <tbody>
                        <tr>
                           <td>
                              <table>
                                 <tbody>
                                    <tr>
                                       <td style="padding: 10px 0px;">
                                          <img src="images/bank/scb.png" width="30px">
                                       </td>
                                       <td style="padding: 0 10px;">
                                          <i class="fas fa-arrow-right"></i>
                                       </td>
                                       <td>
                                          <img src="images/bank/scb.png" width="30px">
                                       </td>
                                       <td style="font-size: 10px; padding: 0 2px; font-weight: bold;">
                                          SCB<br> 
                                          XXX-X-XXXX8-X
                                       </td>
                                    </tr>
                                    <tr style="border-top: 1px solid #f2cf1a;
                                       border-bottom: 1px solid #f2cf1a; margin: 10px; width: 100%; font-weight: bold;">
                                       <td colspan="4" style="padding: 10px 0px;">USER :ARCXXXXX99999</td>
                                    </tr>
                                 </tbody>
                              </table>
                           </td>
                           <td style="padding:8px;line-height: 9px;">
                              <img  style="width: 90px;"><br>
                              <span style="font-size: 12px;">verified by Archa168</span>
                           </td>
                        </tr>
                     </tbody>
                  </table>
               </div>
            </div>
         </div>
      </div>
      <!-- End slip section -->



























      <!-- slip section -->
      <div  id="account" class="tabcontent">
         <div class="headerprocess"><i class="fal fa-user"></i> ข้อมูลส่วนตัว</div>
         <div class="containprocess" style="padding: 0 20px;">
            <table align="center" class="accountofuser">
               <tr class="trofaccount">
                  <td class="headeraccount"><i class="fal fa-user"></i> คุณ:</td>
                  <td><?php echo $row['fname']; ?></td>
               </tr>
               <tr class="trofaccount">
                  <td class="headeraccount"><i class="fal fa-user-circle"></i> ยูสเซอร์:</td>
                  <td><?php echo $row['username_game']; ?></td>
               </tr>
               <!-- <tr class="trofaccount">
                  <td class="headeraccount"><i class="fal fa-lock"></i> รหัสผ่าน:</td>
                  <td>1234567890</td>
               </tr> -->
               <tr class="trofaccount">
                  <td class="headeraccount"><i class="fal fa-university"></i> ธนาคารของคุณ:</td>
                  <td><img src="images/bank/<?php echo $bank_svg ?>.svg?v=1" width="25px"> <?php echo $row['bank_name']; ?></td>
               </tr>
               <tr class="trofaccount">
                  <td class="headeraccount"><i class="fal fa-gift"></i> โปรโมชั่นของคุณ:</td>
                  <td><?php echo $promotion; ?></td>
               </tr>
               <tr class="trofaccount">
                  <td class="headeraccount"><i class="fal fa-users"></i> ยอดแนะนำเพื่อน:</td>
                  <td><?php echo number_format($row['balance_affliliate'],2); ?> บาท</td>
               </tr>
               </tr>
               <tr class="trofaccount">
                  <td class="headeraccount"><i class="fal fa-sack-dollar"></i> ยอดคอมมิชชั่น:</td>
                  <td>0.00 บาท</td>
               </tr>
            </table>
         </div>
      </div>
      <!-- End slip section -->

















   </div>
</div>
<!-- Cantainer all content----------------------------------------------- -->




<div class="heightmobile"></div>
<?php  include('dashboard_footer.php'); ?>
<script src="js/dashboard_js.js?<?php echo time(); ?>"></script>

