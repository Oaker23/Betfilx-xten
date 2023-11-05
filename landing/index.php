<?php
include '../config/config.php';


header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");

if (!isset($_SESSION)) {
	session_start();
}
if (@$_SESSION["phone"] != "") {
	header("location: https://qbabet-th.com/login");
}


require '../config/config.php';

$sql = "SELECT * FROM `website`";
$result = $server->query($sql);
$row = mysqli_fetch_assoc($result);
$logo = $row['logo'];
$title = $row['title'];
$keyword = $row['keyword'];
$name = $row['name'];
$line = $row['line_id'];

$sql = "SELECT * FROM `promotion` WHERE `p_name`='โปร สมาชิกใหม่' or `p_name`='ฝากครั้งแรกของวัน' or `p_name`='รับทุกครั้งที่ฝากเงิน'";

$result = $server->query($sql);
$res=[];
foreach ($result as  $value) {
	array_push($res, $value);

}


?>

<!DOCTYPE html>
<html lang="th" class="">

<head>
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css">
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta name="robots" content="noodp">
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
	<title><?php echo $title; ?></title>
	<meta name="keywords" content="<?php echo $keyword; ?>">
	<link rel="apple-touch-icon" sizes="57x57" href="build/web/ufacoder/img/apple-icon-57x57.png">
	<link rel="apple-touch-icon" sizes="60x60" href="build/web/ufacoder/img/apple-icon-60x60.png">
	<link rel="apple-touch-icon" sizes="72x72" href="build/web/ufacoder/img/apple-icon-72x72.png">
	<link rel="apple-touch-icon" sizes="76x76" href="build/web/ufacoder/img/apple-icon-76x76.png">
	<link rel="apple-touch-icon" sizes="114x114" href="build/web/ufacoder/img/apple-icon-114x114.png">
	<link rel="apple-touch-icon" sizes="120x120" href="build/web/ufacoder/img/apple-icon-120x120.png">
	<link rel="apple-touch-icon" sizes="144x144" href="build/web/ufacoder/img/apple-icon-144x144.png">
	<link rel="apple-touch-icon" sizes="152x152" href="build/web/ufacoder/img/apple-icon-152x152.png">
	<link rel="apple-touch-icon" sizes="180x180" href="build/web/ufacoder/img/apple-icon-180x180.png">
	<link rel="manifest" href="build/web/ufacoder/img/manifest.js">
	<meta name="msapplication-TileColor" content="#ffffff">
	<meta name="msapplication-TileImage" content="/build/web/ufacoder/img/ms-icon-144x144.png">
	<meta name="theme-color" content="#ffffff">
	<meta name="format-detection" content="telephone=no">
	<link rel="stylesheet" href="releases/v5-8-1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
	<link rel="stylesheet" href="build/web/ufacoder/style.806eb46c.css">
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
	<link rel="stylesheet" href="css/jquery.loadingModal.css">

<!-- End Meta Pixel Code -->

	<script type="text/javascript">
		window['gif64'] = 'data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7';
		window['Bonn'] = {
			boots: [],
			inits: []
		};
	</script>
	<script type="application/ld+json">
		{
			"@context": "http://schema.org",
			"@type": "WebPage",
			"image": [
			"/build/web/ufacoder/img/meta-1x1.jpg",
			"/build/web/ufacoder/img/meta-4x3.jpg",
			"/build/web/ufacoder/img/meta-16x9.jpg"
			],
			"name": "บาคาร่า เสือมังกร คาสิโนออนไลน์ ได้เงินจริง แอพบาคาร่า",
			"url": ""
		}
	</script>

	<script>
		window.__lc = window.__lc || {};
		window.__lc.license = 12950511;;
		(function(n, t, c) {
			function i(n) {
				return e._h ? e._h.apply(null, n) : e._q.push(n)
			}
			var e = {
				_q: [],
				_h: null,
				_v: "2.0",
				on: function() {
					i(["on", c.call(arguments)])
				},
				once: function() {
					i(["once", c.call(arguments)])
				},
				off: function() {
					i(["off", c.call(arguments)])
				},
				get: function() {
					if (!e._h) throw new Error("[LiveChatWidget] You can't use getters before load.");
					return i(["get", c.call(arguments)])
				},
				call: function() {
					i(["call", c.call(arguments)])
				},
				init: function() {
					var n = t.createElement("script");
					n.async = !0, n.type = "text/javascript", n.src = "https://cdn.livechatinc.com/tracking.js", t.head.appendChild(n)
				}
			};
			!n.__lc.asyncInit && e.init(), n.LiveChatWidget = n.LiveChatWidget || e
		}(window, document, [].slice))
	</script>

	<noscript><a href="https://www.livechatinc.com/chat-with/12767466/" rel="nofollow">Chat with us</a>, powered by <a href="https://www.livechatinc.com/?welcome" rel="noopener nofollow" target="_blank">LiveChat</a></noscript>
</head>

<body class="">

	<nav class="x-header navbar bg-transparent navbar-expand-lg -anon">
		<div class="container align-items-center">
			<div id="headerBrand" style="margin-top: -40px;">
				<a class="navbar-brand">
					<img style="width: 170px; height: 85px;" class="-logo mt-1 mt-md-0" src="../manager/<?php echo $logo; ?>" alt="">
				</a>
			</div>

			<div id="headerContent">
				<ul class="navbar-nav ml-auto">
					<div class="d-flex">

						
						<button type="button" class="-header-login-btn btn btn-primary px-4 px-lg-5 mt-lg-3" onclick="login()">
							เข้าสู่ระบบ
						</button>
						
					</div>
				</ul>
			</div>
		</div>
	</nav>


	<div id="main__content" class="x-main-content-container">
		<section class="x-index-top-container">
			<div class="-bg-container">
				<img src="build/web/ufacoder/img/bg-allcasino-1.png" alt="icon chip" class="-bg-1">
				<img src="build/web/ufacoder/img/bg-allcasino-2.png" alt="icon chip" class="-bg-2">
				<img src="build/web/ufacoder/img/bg-allcasino-3.png" alt="icon chip" class="-bg-3">
			</div>

			<div class="x-contact-us 1">
				<div class="-line-container">
					<a href="http://line.me/ti/p/~<?php echo $line ?>" target="_blank">
						<img src="build/web/ufacoder/img/ic_line.png" alt="ติดต่อเรา" class="-img-default">
						<img src="build/web/ufacoder/img/ic_line_hover.png" alt="ติดต่อเรา" class="-img-hover">
					</a>
				</div>
				<div class="-line-detail-container">
					<a href="http://line.me/ti/p/~<?php echo $line ?>" target="_blank">
						Line : https://lin.ee/<?php echo $line; ?>
					</a>
				</div>
			</div>


			<div class="container -inner-wrapper">
				<div class="d-flex align-items-end justify-content-center animated fadeInUp" data-animatable="fadeInUp" data-delay="500">
					<div class="-logo-wrapper text-center" style="margin-top: -50px;">
						<img style="width: 400px; height: 200px;" src="./logo/QBABET_PNG.png" alt="goodgame365 logo text" class="-logo-title">

					</div>
				</div>
				<div>
					<div style="margin-top: -60px;">
						<h2 data-animatable="fadeInUp" data-delay="500" class="text-white mt-2 mb-0 h5 -sub-title text-center font-weight-normal animated fadeInUp"><b style="color: white;">ระบบออโต้ ฝาก-ถอน 30วิ มีแอดมินดูแลตลอด 24ชม.</b></h2>
					</div>

					<!-- 	<div class="d-flex flex-column m-auto" data-toggle="modal" data-target="#get_otpModal">
						<a class="x-btn-image -hoverable -btn-glow x-btn-register d-lg-block" data-toggle="modal" data-target="#get_otpModal">
							<img class="-default" src="https://www.goodgame365.com/build/web/goodgame365/img/button-register.png" style="height:64px; ; width: 200px;" data-toggle="modal" data-target="#get_otpModal">

						</a>
					</div> -->

					<div class="row mt-3 -btn-actions justify-content-center animated fadeInUp" data-animatable="fadeInUp" data-delay="700">
						<div class="col-7 col-sm-5 col-lg-3">

							<!-- <img class="-default" src="https://www.goodgame365.com/build/web/goodgame365/img/button-register.png" style="height:64px; ; width: 200px;" data-toggle="modal" data-target="#get_otpModal"> -->
							<button type="button" class="btn btn-primary btn-block -register-button" onclick="register()"> สมัครสมาชิก</span>
							</button>
						</div>

					</div>

				</div>
				<br><br>

				<div class="x-service-wrapper mt-3">

					<div class="row container m-auto">
						<div class="col-md-4 text-center -box d-flex align-items-start d-md-block -box">
							<a href="#0" class="d-flex flex-md-column flex-row" data-toggle="modal" data-target="#registerModal">
								<div class="-ic-wrapper mb-2">
									<img src="https://www.goodgame365.com/build/web/goodgame365/img/ic_step_deposit15.png" alt="icon register" class="-ic">
								</div>
								<div class="text-left text-md-center">
									<h3><span class="d-inline-block d-md-none">1.</span> ฝาก-ถอน 30 วิ</h3>
									<hr class="x-hr-border-glow">

									<span class="d-none d-lg-block text-muted-lighter f-5">รวดเร็วด้วยระบบอัตโนมัติ</span>
									<span class="d-block d-lg-none text-muted-lighter f-5">รวดเร็วด้วยระบบอัตโนมัติ</span>
								</div>
							</a>
						</div>

						<div class="col-md-4 text-center -box d-flex align-items-start d-md-block -box">
							<div class="-ic-wrapper mb-2">
								<img src="https://www.goodgame365.com/build/web/goodgame365/img/ic_step_deposit_service.png" alt="icon register" class="-ic">
							</div>
							<div class="text-left text-md-center">
								<h3><span class="d-inline-block d-md-none">2.</span> บริการลูกค้า</h3>
								<hr class="x-hr-border-glow">

								<span class="d-none d-lg-block text-muted-lighter f-5">รับประกันงานบริการพร้อมดูแล 24 ชั่วโมง</span>
								<span class="d-block d-lg-none text-muted-lighter f-5">รับประกันงานบริการพร้อมดูแล 24 ชั่วโมง</span>
							</div>
						</div>

						<div class="col-md-4 text-center -box d-flex align-items-start d-md-block -box">
							<div class="-ic-wrapper mb-2">
								<img src="https://www.goodgame365.com/build/web/goodgame365/img/ic_step_deposit_secure.png" alt="icon register" class="-ic">
							</div>
							<div class="text-left text-md-center">
								<h3><span class="d-inline-block d-md-none">3.</span> ความมั่นคง</h3>
								<hr class="x-hr-border-glow">

								<span class="d-none d-lg-block text-muted-lighter f-5">ถอนสูงสุดวันละ ล้าน/บัญชี แทงสูงสุด ไม้ละ 200,000</span>
								<span class="d-block d-lg-none text-muted-lighter f-5">ถอนสูงสุดวันละ ล้าน/บัญชี แทงสูงสุด ไม้ละ 200,000</span>
							</div>
						</div>

					</div>
				</div>

			</section>
			<section>
				<div class="x-index-tab-container">
					<div class="container">
						<ul class="nav nav-tabs x-tab py-3">
							<img src="build/web/ufacoder/img/line-long-glow.png" alt="Line long glow png" class="-line-glow">

							<li class="nav-item  active -index js-tab-scrolled" id="tab-index">
								<a
								data-toggle="tab"
								href="#tab-content-index"
								class="nav-link active">
								<img src="build/web/ufacoder/img/tab_index.png" alt="logo_index" class="-ic"><br>
								<span class="d-sm-none d-inline-block mt-2 text-gray-lighter">qbabet</span>
								<span class="d-sm-inline-block d-none mt-2 text-gray-lighter">Qbabet</span>
								<hr class="x-hr-border-glow mb-0">
							</a>
						</li>


						<li class="nav-item   -promotion js-tab-scrolled" id="tab-promotion">
							<a data-toggle="tab" href="#tab-content-promotion" class="nav-link ">
								<img src="build/web/ufacoder/img/tab_promotion.png" alt="logo_promotion" class="-ic"><br>
								<span class="d-sm-none d-inline-block mt-2 text-gray-lighter">โปรโมชั่น</span>
								<span class="d-sm-inline-block d-none mt-2 text-gray-lighter">โปรโมชั่น</span>
								<hr class="x-hr-border-glow mb-0">
							</a>
						</li>

						<li class="nav-item   -manual js-tab-scrolled" id="tab-manual">
							<a data-toggle="tab" href="#tab-content-manual" class="nav-link ">
								<img src="build/web/ufacoder/img/tab_manual.png" alt="logo_manual" class="-ic"><br>
								<span class="d-sm-none d-inline-block mt-2 text-gray-lighter">แนะนำ</span>
								<span class="d-sm-inline-block d-none mt-2 text-gray-lighter">แนะนำการใช้งาน</span>
								<hr class="x-hr-border-glow mb-0">
							</a>
						</li>
						<li class="nav-item   -event js-tab-scrolled" id="tab-event">
							<a data-toggle="tab" href="#tab-content-event" class="nav-link ">
								<img src="build/web/ufacoder/img/tab_event.png" alt="logo_event" class="-ic"><br>
								<span class="d-sm-none d-inline-block mt-2 text-gray-lighter">กิจกรรม</span>
								<span class="d-sm-inline-block d-none mt-2 text-gray-lighter">กิจกรรม</span>
								<hr class="x-hr-border-glow mb-0">
							</a>
						</li>
					</ul>
				</div>

				<div class="tab-content">
					<div class="tab-pane active" id="tab-content-index">

						<div class="x-tab-index">
							<div class="container mt-5 mb-3">
								<div class="-notice-box -top">
									<div class="-title" style="margin-top: -30px;">
										<img style="width:100%" src="../manager/<?php echo $logo; ?>" alt="Goodgame365 logo">
									</div>
									<div class="-description">
										<div class="row m-0 py-5">
											<div class="col-lg-12 text-white position-relative">
												<div class="x-footer-lobby-logo">
													<div class="container">
														<div class="-casino-wrapper">
															<div class="row">
																<div class="col-6 col-md-3"><img width="100%" src="./images/game/1.1.png"></div>
																<div class="col-6 col-md-3"><img width="100%" src="./images/game/1.2.png"></div>
																<div class="col-6 col-md-3"><img width="100%" src="./images/game/1.3.png"></div>
																<div class="col-6 col-md-3"><img width="100%" src="./images/game/1.4.png"></div>
																<div class="col-6 col-md-3"><img width="100%" src="./images/game/1.5.png"></div>
																<div class="col-6 col-md-3"><img width="100%" src="./images/game/1.6.png"></div>
																<div class="col-6 col-md-3"><img width="100%" src="./images/game/1.7.png"></div>
																<div class="col-6 col-md-3"><img width="100%" src="./images/game/1.8.png"></div>
																<div class="col-6 col-md-3"><img width="100%" src="./images/game/1.9.png"></div>
																<div class="col-6 col-md-3"><img width="100%" src="./images/game/1.10.png"></div>
																<div class="col-6 col-md-3"><img width="100%" src="./images/game/1.11.png"></div>
																<div class="col-6 col-md-3"><img width="100%" src="./images/game/1.12.png"></div>
															</div>

														</div>


													</div>
												</div>

											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="container mt-4">
								<div class="-notice-box">
									<div class="-description text-center">
										<div class="row m-0 py-3">
											<div class="col-lg-12 text-white position-relative">
												<h3 class="text-primary mb-0"><?php echo $name; ?></h3>
												<hr class="x-hr-border-glow">
												<p class="f-6 f-lg-5 px-4"><b>Qbabet</b> เราคือผู้ให้บริการคาสิโนออนไลน์ รวมเว็บชั้นนำไว้ในที่เดียว ครบวงจร ฝาก-ถอน ด้วยระบบอัตโนมัติ ไม่เกิน 5 วินาที คุณก็สามารถเป็นส่วนหนึ่งและสนุกไปกับเราได้แล้ววันนี้เราจะเป็นผู้ให้บริการที่ดีที่สุด ด้วยพนักงานที่คอยดูแล การันตรีการแก้ปัญหาได้ 100% และพร้อมให้บริการตลอด24ชั่วโมง</p>
												<p class="f-6 f-lg-5 pt-3 px-4">วันนี้เข้ามาในไทยร่วม 10 ปี ที่ไม่หยุดพัฒนาเพื่อประสบการณ์ต่อผู้เล่น ที่สะดวก เสถียรที่สุด รองรับทั้งมือถือ และ คอมพิวเตอร์ โดยไม่ต้องดาวน์โหลดใดๆ อีกทั้งยังมีระบบฝากถอนออโต้ เจ้าเดียวที่ใช้ได้จริง ทำให้ Qba เป็นที่นิยมแพร่หลายจนถึงทุกวันนี้ ซึ่งหากผู้ใดอยากจะเดิมพันคาสิโน เกม บาคาร่า ไฮโล ป็อกเด้ง เสือ-มังกร หรือรูเล็ตแล้ว คงต้องนึกถึง <b>Qbabet</b> เป็นเว็บแรก</p>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="-bottom py-3" style="background: url('/build/web/goodgame365/img/tab_index_bottom_bg.png')">
								<div class="container">
									<div class="x-footer-logo-lobby-in-used">
										<ul class="navbar-nav">
											<li class="nav-item -logo-white" style="background-image: url('/build/web/shared/img/footer-all-netent.png')"></li>
											<li class="nav-item -logo-white" style="background-image: url('/build/web/shared/img/footer-all-wm.png')"></li>
											<li class="nav-item -logo-white" style="background-image: url('/build/web/shared/img/footer-all-dream-gaming.png')"></li>
											<li class="nav-item -logo-white" style="background-image: url('/build/web/shared/img/footer-all-pinnacle.png')"></li>
											<li class="nav-item -logo-white" style="background-image: url('/build/web/shared/img/footer-all-sp.png')"></li>
											<li class="nav-item -logo-white" style="background-image: url('/build/web/shared/img/footer-all-ps.png')"></li>
											<li class="nav-item -logo-white" style="background-image: url('/build/web/shared/img/footer-all-evo-play.png')"></li>
											<li class="nav-item -logo-white" style="background-image: url('/build/web/shared/img/footer-all-skill-game.png')"></li>
											<li class="nav-item -logo-white" style="background-image: url('/build/web/shared/img/footer-all-habanero.png')"></li>
											<li class="nav-item -logo-white" style="background-image: url('/build/web/shared/img/footer-all-joker.png')"></li>
											<li class="nav-item -logo-white" style="background-image: url('/build/web/shared/img/footer-all-sexy-bac.png')"></li>
										</ul>
									</div>
								</div>
							</div>
						</div>

					</div>



					<div class="tab-pane " id="tab-content-manual">
						<div class="container text-center py-3">
							<h3 class="text-white">แนะนำการใช้งาน</h3>
							<div class="row justify-content-center mt-4">

								<div class="x-tab-manual">

									<div class="container -container-wrapper pt-0">
										<ul class="nav nav-tabs -tabs d-flex justify-content-center -video-tab-wrapper">
											<li class="nav-item  active -register" id="tab-register">
												<a data-toggle="tab" href="#tab-content-register" class="nav-link active">
													วิธีการสมัคร
												</a>
											</li>
											<li class="nav-item   -deposit" id="tab-deposit">
												<a data-toggle="tab" href="#tab-content-deposit" class="nav-link">
													วิธีการฝากเงิน
												</a>
											</li>
											<li class="nav-item   -withdraw" id="tab-withdraw">
												<a data-toggle="tab" href="#tab-content-withdraw" class="nav-link">
													วิธีการถอนเงิน
												</a>
											</li>
										</ul>

										<div class="tab-content text-center mt-2">
											<div class="tab-pane x-video-container active" id="tab-content-register">
												<div class="x-service-wrapper mt-2 pt-2">

													<div class="row justify-content-center mt-4">
														<div class="col-11 col-sm-9 col-md-4 text-center -box d-flex align-items-start d-md-block -box">
															<a href="#0" class="d-flex flex-md-column flex-row" data-toggle="modal" data-target="#registerModal">
																<div class="-ic-wrapper mb-2">
																	<img src="https://www.goodgame365.com/build/web/goodgame365/img/ic_register.png" alt="icon register" class="-ic-register">
																</div>
																<div class="text-left text-md-center">
																	<h3><span class="d-inline-block d-md-none">1.</span> สมัครสมาชิก</h3>
																	<hr class="x-hr-border-glow">

																	<span class="d-none d-lg-block text-muted-lighter f-5">กรอกเบอร์โทรศัพท์มือถือ ของคุณให้ถูกต้อง</span>
																	<span class="d-block d-lg-none text-muted-lighter f-5">กรอกเบอร์โทรศัพท์มือถือ ของคุณให้ถูกต้อง</span>
																</div>
															</a>
														</div>

														<div class="col-11 col-sm-9 col-md-4 text-center -box d-flex align-items-start d-md-block -box">
															<div class="-ic-wrapper mb-2">
																<img src="https://www.goodgame365.com/build/web/goodgame365/img/ic_otp.png" alt="icon register" class="-ic-otp">
															</div>
															<div class="text-left text-md-center">
																<h3><span class="d-inline-block d-md-none">2.</span> รอรับ SMS ยืนยัน</h3>
																<hr class="x-hr-border-glow">

																<span class="d-none d-lg-block text-muted-lighter f-5">กรอกเลข OTP ให้ถูกต้อง พร้อมตั้งรหัสเข้าเล่น</span>
																<span class="d-block d-lg-none text-muted-lighter f-5">กรอกเลข OTP ให้ถูกต้อง พร้อมตั้งรหัสเข้าเล่น</span>
															</div>
														</div>

														<div class="col-11 col-sm-9 col-md-4 text-center -box d-flex align-items-start d-md-block -box">
															<div class="-ic-wrapper mb-2">
																<img src="https://www.goodgame365.com/build/web/goodgame365/img/ic_bank.png" alt="icon register" class="-ic-bank">
															</div>
															<div class="text-left text-md-center">
																<h3><span class="d-inline-block d-md-none">3.</span> ใส่เลขบัญชีและชื่อบัญชี</h3>
																<hr class="x-hr-border-glow">

																<span class="d-none d-lg-block text-muted-lighter f-5">กรอกเลขบัญชีของคุณพร้อมชื่อให้ถูกต้อง เข้าร่วมสนุกกับ <?php echo $name; ?> ได้ทันที !</span>
																<span class="d-block d-lg-none text-muted-lighter f-5">กรอกเลขบัญชีของคุณพร้อมชื่อให้ถูกต้อง เข้าร่วมสนุกกับ <?php echo $name; ?> ได้ทันที !</span>
															</div>
														</div>

													</div>

													<!-- <div class="-video-outer-wrapper js-video-loaded" data-source="/build/web/goodgame365/videos/register.mp4"> -->

														<!-- <div class="-video-wrapper"><div class="-loaded"><video controls="" autoplay="" width="498"><source src="/build/web/goodgame365/videos/register.mp4" type="video/mp4">Your browser does not support the video</video></div></div> -->


															<!-- </div> -->
														</div>

													</div>
													<div class="tab-pane x-video-container" id="tab-content-deposit">
														<div class="x-service-wrapper mt-2 pt-2">

															<div class="row justify-content-center mt-4">
																<div class="col-11 col-sm-9 col-md-4 text-center -box d-flex align-items-start d-md-block -box">
																	<a href="#0" class="d-flex flex-md-column flex-row" data-toggle="modal" data-target="#depositModal">
																		<div class="-ic-wrapper mb-2">
																			<img src="https://www.goodgame365.com/build/web/goodgame365/img/ic_step_deposit.png" alt="icon register" class="-ic">
																		</div>
																		<div class="text-left text-md-center">
																			<h3><span class="d-inline-block d-md-none">1.</span> กด "ฝากเงิน"</h3>
																			<hr class="x-hr-border-glow">

																			<span class="d-none d-lg-block text-muted-lighter f-5">กรอกจำนวนเงิน กด "ต้องการรับโปรโมชั่น"<br class="d-none d-lg-block">เพื่อรับโบนัสที่ต้องการ กด "ยืนยัน"</span>
																			<span class="d-block d-lg-none text-muted-lighter f-5">กรอกจำนวนเงิน กด "ต้องการรับโปรโมชั่น"<br class="d-none d-lg-block">เพื่อรับโบนัสที่ต้องการ กด "ยืนยัน"</span>
																		</div>
																	</a>
																</div>

																<div class="col-11 col-sm-9 col-md-4 text-center -box d-flex align-items-start d-md-block -box">
																	<div class="-ic-wrapper mb-2">
																		<img src="https://www.goodgame365.com/build/web/goodgame365/img/ic_step_deposit_add.png" alt="icon register" class="-ic">
																	</div>
																	<div class="text-left text-md-center">
																		<h3><span class="d-inline-block d-md-none">2.</span> โอนเงิน</h3>
																		<hr class="x-hr-border-glow">

																		<span class="d-none d-lg-block text-muted-lighter f-5">กด "คัดลอกเลขบัญชี"<br class="d-none d-lg-block">หรือแสกน QR Code เพื่อโอนเงิน</span>
																		<span class="d-block d-lg-none text-muted-lighter f-5">กด "คัดลอกเลขบัญชี"<br class="d-none d-lg-block">หรือแสกน QR Code เพื่อโอนเงิน</span>
																	</div>
																</div>

																<div class="col-11 col-sm-9 col-md-4 text-center -box d-flex align-items-start d-md-block -box">
																	<div class="-ic-wrapper mb-2">
																		<img src="https://www.goodgame365.com/build/web/goodgame365/img/ic_step_deposit_done.png" alt="icon register" class="-ic">
																	</div>
																	<div class="text-left text-md-center">
																		<h3><span class="d-inline-block d-md-none">3.</span> กด"โอนแล้ว"</h3>
																		<hr class="x-hr-border-glow">

																		<span class="d-none d-lg-block text-muted-lighter f-5">ส่งรายการฝาก ระบบจะทำการ<br class="d-none d-lg-block">ตรวจสอบเงิน และเติมเงินให้ทันที</span>
																		<span class="d-block d-lg-none text-muted-lighter f-5">ส่งรายการฝาก ระบบจะทำการ<br class="d-none d-lg-block">ตรวจสอบเงิน และเติมเงินให้ทันที</span>
																	</div>
																</div>

															</div>
													<!-- 
											<div class="-video-outer-wrapper js-video-loaded" data-source="/build/web/goodgame365/videos/deposit.mp4">
												<img src="https://www.goodgame365.com/build/web/goodgame365/img/video_deposit_bg.png" alt="deposit-background" class="img-fluid -video-bg">
												<div class="-video-wrapper"></div>
											</div> -->
										</div>

									</div>
									<div class="tab-pane x-video-container" id="tab-content-withdraw">
										<div class="x-service-wrapper mt-2 pt-2">

											<div class="row justify-content-center mt-4">
												<div class="col-11 col-sm-9 col-md-4 text-center -box d-flex align-items-start d-md-block -box">
													<a href="#0" class="d-flex flex-md-column flex-row" data-toggle="modal" data-target="#withdrawModal">
														<div class="-ic-wrapper mb-2">
															<img src="https://www.goodgame365.com/build/web/goodgame365/img/ic_step_withdraw.png" alt="icon register" class="-ic">
														</div>
														<div class="text-left text-md-center">
															<h3><span class="d-inline-block d-md-none">1.</span> กด "ถอนเงิน"</h3>
															<hr class="x-hr-border-glow">

															<span class="d-none d-lg-block text-muted-lighter f-5">กด "ถอนเงิน"</span>
															<span class="d-block d-lg-none text-muted-lighter f-5">กด "ถอนเงิน"</span>
														</div>
													</a>
												</div>

												<div class="col-11 col-sm-9 col-md-4 text-center -box d-flex align-items-start d-md-block -box">
													<div class="-ic-wrapper mb-2">
														<img src="https://www.goodgame365.com/build/web/goodgame365/img/ic_step_withdraw_add.png" alt="icon register" class="-ic">
													</div>
													<div class="text-left text-md-center">
														<h3><span class="d-inline-block d-md-none">2.</span> กรอกจำนวนเงิน</h3>
														<hr class="x-hr-border-glow">

														<span class="d-none d-lg-block text-muted-lighter f-5">กรอกจำนวนเงินที่ต้องการถอน</span>
														<span class="d-block d-lg-none text-muted-lighter f-5">กรอกจำนวนเงินที่ต้องการถอน</span>
													</div>
												</div>

												<div class="col-11 col-sm-9 col-md-4 text-center -box d-flex align-items-start d-md-block -box">
													<div class="-ic-wrapper mb-2">
														<img src="https://www.goodgame365.com/build/web/goodgame365/img/ic_step_withdraw_done.png" alt="icon register" class="-ic">
													</div>
													<div class="text-left text-md-center">
														<h3><span class="d-inline-block d-md-none">3.</span> ยืนยัน</h3>
														<hr class="x-hr-border-glow">

														<span class="d-none d-lg-block text-muted-lighter f-5">กด "ยืนยัน" ระบบจะทำการถอนเงินให้ทันที</span>
														<span class="d-block d-lg-none text-muted-lighter f-5">กด "ยืนยัน" ระบบจะทำการถอนเงินให้ทันที</span>
													</div>
												</div>

											</div>
													<!-- 
											<div class="-video-outer-wrapper js-video-loaded" data-source="/build/web/goodgame365/videos/withdraw.mp4">
												<img src="https://www.goodgame365.com/build/web/goodgame365/img/video_withdraw_bg.png" alt="withdraw-background" class="img-fluid -video-bg">
												<div class="-video-wrapper"></div>
											</div> -->
										</div>

									</div>
								</div>
							</div>
						</div>

					</div>
				</div>
			</div>

			<div class="tab-pane " id="tab-content-promotion">
				<div class="container text-center py-3">
					<h3 class="text-white">โปรโมชั่น</h3>

					<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
						<ol class="carousel-indicators">
							<li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
							<li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
							<li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
						</ol>
						<div class="carousel-inner">
							<?php $i=1; foreach ($res as $key => $value) {?>
								<div class="carousel-item active">
									<img class="d-block w-100" src="../manager/<?=$value['image']; ?>" alt="First slide">
								</div>
								<?php $i++; }  ?>



							</div>
							<a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
								<span class="carousel-control-prev-icon" aria-hidden="true"></span>
								<span class="sr-only">Previous</span>
							</a>
							<a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
								<span class="carousel-control-next-icon" aria-hidden="true"></span>
								<span class="sr-only">Next</span>
							</a>
						</div>


					</div>
				</div>



				<div class="tab-pane " id="tab-content-event">
					<div class="container text-center py-3">
						<h3 class="text-white">กิจกรรม</h3>
						<span class="text-white">ยังไม่มีข้อมูลในส่วนนี้</span>
					</div>
				</div>


			</div>
		</div>

	</section>

	<div class="x-modal modal" id="alertModal" tabindex="-1" role="dialog" aria-hidden="true" data-loading-container=".js-modal-content" data-ajax-modal-always-reload="true">
		<div class="modal-dialog -modal-size " role="document">
			<div class="modal-content -modal-content">
				<img src="build/web/ufacoder/img/border-modal.png" class="img-fluid d-lg-block d-none -border-top-modal" alt="">
				<button type="button" class="close f-1" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<div class="modal-header border-bottom-0 mt-3 pb-0 d-flex flex-column-reverse">
					<h3 class="x-title-modal font-weight-normal d-inline-block m-auto text-white">
						<span>แจ้งเตือน</span>
						<hr class="x-hr-border-glow">
					</h3>
				</div>
				<div class="modal-body">
					<div class="text-center mb-3">
						<img src="build/web/ufacoder/img/ic_check.png" alt="SUCCESS" width="90px" class="js-ic-success img-fluid">
						<img src="build/web/ufacoder/img/ic_cross.png" alt="FAIL" width="90px" class="js-ic-fail img-fluid">
					</div>
					<div class="js-modal-content text-primary text-center f-4">
					</div>
				</div>
				<img src="build/web/ufacoder/img/border-modal.png" class="img-fluid d-lg-block d-none -border-bottom-modal" alt="">
			</div>
		</div>
	</div>





	<div class="x-modal modal" id="loginModal" tabindex="-1" role="dialog" aria-hidden="true" data-loading-container=".js-modal-content" data-ajax-modal-always-reload="true">
		<div class="modal-dialog -modal-size " role="document">
			<div class="modal-content -modal-content">
				<img src="build/web/ufacoder/img/border-modal.png" class="img-fluid d-lg-block d-none -border-top-modal" alt="">
				<button type="button" class="close f-1" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<div class="modal-header border-bottom-0 mt-3 pb-0 d-flex flex-column-reverse">
					<h3 class="m-auto text-white d-inline-block">
						เข้าสู่ระบบ
						<hr class="x-hr-border-glow">
					</h3>
				</div>
				<div class="modal-body">
					<div class="x-login-form">
						<div data-animatable="fadeInModal" data-offset="0" class="-animatable-container">
							<form action="login-json-check.html" class="js-login-form x-header-login-form">
								<div class="-x-input-icon mb-3 flex-column">
									<img src="build/web/ufacoder/img/ic_phone.png" class="-icon" alt="login" width="12">
									<input type="text" id="phone" name="phone" pattern="[0-9]*" autofocus class="form-control x-form-control" placeholder="เบอร์โทรศัพท์">
								</div>
								<div class="-x-input-icon flex-column">
									<img src="build/web/ufacoder/img/ic_lock_input.png" class="-icon" alt="password" width="13">
									<input type="password" id="password" name="password" class="form-control x-form-control" placeholder="รหัสผ่าน">
								</div>

								<div class="text-center">
									<button type="button" class="btn btn-primary -submit my-lg-3 my-0 f-5 f-lg-6" onclick="login()">
										<span>เข้าสู่ระบบ</span>
									</button>
									<span class="x-text-with-link-component">
										<label class="-text-message mt-2">หากคุณไม่สามารเข้าระบบได้</label>
										<a href="#" class="-link-message" onclick="reset_input_phone()">
											<span>ลืมรหัสผ่าน</span>
										</a>
									</span>
								</div>
							</form>
							<div class="x-admin-contact ">
								<span class="x-text-with-link-component">
									<label class="-text-message ">พบปัญหา</label>
									<a href="http://line.me/ti/p/~<?php echo $line ?>" target="_blank">
										<span>ติดต่อฝ่ายบริการลูกค้า</span>
									</a>
								</span>
							</div>
						</div>
					</div>
				</div>
				<img src="build/web/ufacoder/img/border-modal.png" class="img-fluid d-lg-block d-none -border-bottom-modal" alt="">
			</div>
		</div>
	</div>



	<div class="x-modal modal" id="get_otpModal" tabindex="-1" role="dialog" aria-hidden="true" data-loading-container=".js-modal-content" data-ajax-modal-always-reload="true">
		<div class="modal-dialog -modal-size " role="document">
			<div class="modal-content -modal-content">
				<img src="build/web/ufacoder/img/border-modal.png" class="img-fluid d-lg-block d-none -border-top-modal" alt="">
				<button type="button" class="close f-1" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<div class="modal-header border-bottom-0 mt-3 pb-0 d-flex flex-column-reverse">

					<div class="col">
						<center>
							<h3 class="m-auto text-white">
								เบอร์โทรศัพท์มือถือ
								<hr class="x-hr-border-glow">
							</h3>

						</center>


					</div>


				</div>
				<div class="modal-body">
					<div class="x-login-form">
						<div data-animatable="fadeInModal" data-offset="0" class="-animatable-container">


							<div class="-x-input-icon mb-3 flex-column">
								<img src="build/web/ufacoder/img/phone.png" class="-icon" alt="login" width="20">
								<input type="text" id="phone_otp" name="phone_otp" class="form-control x-form-control" placeholder="เบอร์มือถือ">
							</div>
							<div class="form-group">
								<div style="min-height:78px;">
									<div class="row justify-content-center">
										<div class="g-recaptcha" data-sitekey="6LdgoT4aAAAAANeKrUcO8hc_1upN_j1Yn37zD9Dp" data-theme="light" data-type="image" data-size="normal"></div>
										<script>
											var grecaptchaSetting = true;
										</script>
									</div>
									<script type="text/javascript" src="https://www.google.com/recaptcha/api.js?render=onload&hl=th" async defer></script>
								</div>
							</div>


							<div class="text-center">
								<button type="button" class="btn btn-primary -submit my-lg-3 my-0 f-5 f-lg-6" id="registerBTN" onclick="get_otp()">
									<span>ถัดไป</span>
								</button>
							</div>


							<div class="x-admin-contact ">
								<span class="x-text-with-link-component">
									<label class="-text-message ">พบปัญหา</label>
									<a href="http://line.me/ti/p/~<?php echo $line ?>" target="_blank">
										<span>ติดต่อฝ่ายบริการลูกค้า</span>
									</a>
								</span>
							</div>
						</div>
					</div>
				</div>
				<img src="build/web/ufacoder/img/border-modal.png" class="img-fluid d-lg-block d-none -border-bottom-modal" alt="">
			</div>
		</div>
	</div>

	<div class="x-modal modal" id="get_bank" tabindex="-1" role="dialog" aria-hidden="true" data-loading-container=".js-modal-content" data-ajax-modal-always-reload="true">
		<div class="modal-dialog -modal-size " role="document">
			<div class="modal-content -modal-content">
				<img src="build/web/ufacoder/img/border-modal.png" class="img-fluid d-lg-block d-none -border-top-modal" alt="">
				<button type="button" class="close f-1" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<div class="modal-header border-bottom-0 mt-3 pb-0 d-flex flex-column-reverse">
					<h3 class="m-auto text-white d-inline-block">
						กรอก เลขบัญชีธนาคาร
						<hr class="x-hr-border-glow">
					</h3>
				</div>
				<div class="modal-body">
					<div class="x-login-form">
						<div data-animatable="fadeInModal" data-offset="0" class="-animatable-container">


							<div class="-x-input-icon mb-3 flex-column">
								<img src="build/web/ufacoder/img/phone.png" class="-icon" alt="login" width="20">
								<input type="text" id="bank_number" name="bank_number" class="form-control x-form-control" placeholder="เลขบัญชีธนาคาร">
							</div>

							<select id="select" class="form-control">
								<option selected>เลือก ธนาคาร</option>
								<option value="ไทยพาณิชย์">ไทยพาณิชย์</option>
								<option value="กรุงเทพ">กรุงเทพ</option>
								<option value="กสิกรไทย">กสิกรไทย</option>
								<option value="กรุงไทย">กรุงไทย</option>
								<option value="ทหารไทย">ทหารไทย</option>
								<option value="กรุงศรีฯ">กรุงศรีฯ</option>
								<option value="ออมสิน">ออมสิน</option>
								<option value="ธนชาติ">ธนชาติ</option>
								<option value="ธนชาติ">ธกส</option>
							</select>


							<div class="text-center">
								<button type="button" class="btn btn-primary -submit my-lg-3 my-0 f-5 f-lg-6" id="get_name" onclick="get_name()">
									<span>ถัดไป</span>
								</button>
							</div>


							<div class="x-admin-contact ">
								<span class="x-text-with-link-component">
									<label class="-text-message ">พบปัญหา</label>
									<a href="http://line.me/ti/p/~<?php echo $line ?>" target="_blank">
										<span>ติดต่อฝ่ายบริการลูกค้า</span>
									</a>
								</span>
							</div>
						</div>
					</div>
				</div>
				<img src="build/web/ufacoder/img/border-modal.png" class="img-fluid d-lg-block d-none -border-bottom-modal" alt="">
			</div>
		</div>
	</div>



	<div class="x-modal modal" id="reset_get_otpModal" tabindex="-1" role="dialog" aria-hidden="true" data-loading-container=".js-modal-content" data-ajax-modal-always-reload="true">
		<div class="modal-dialog -modal-size " role="document">
			<div class="modal-content -modal-content">
				<img src="build/web/ufacoder/img/border-modal.png" class="img-fluid d-lg-block d-none -border-top-modal" alt="">
				<button type="button" class="close f-1" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<div class="modal-header border-bottom-0 mt-3 pb-0 d-flex flex-column-reverse">
					<h3 class="m-auto text-white d-inline-block">
						กรอก เบอร์มือถือ
						<hr class="x-hr-border-glow">
					</h3>
				</div>
				<div class="modal-body">
					<div class="x-login-form">
						<div data-animatable="fadeInModal" data-offset="0" class="-animatable-container">


							<div class="-x-input-icon mb-3 flex-column">
								<img src="build/web/ufacoder/img/phone.png" class="-icon" alt="login" width="20">
								<input type="text" id="phone_reset" name="phone_reset" class="form-control x-form-control" placeholder="เบอร์มือถือ">
							</div>


							<div class="text-center">
								<button type="button" class="btn btn-primary -submit my-lg-3 my-0 f-5 f-lg-6" id="reset_phone" onclick="reset_get_otp()">
									<span>ถัดไป</span>
								</button>
							</div>


							<div class="x-admin-contact ">
								<span class="x-text-with-link-component">
									<label class="-text-message ">พบปัญหา</label>
									<a href="http://line.me/ti/p/~<?php echo $line ?>" target="_blank">
										<span>ติดต่อฝ่ายบริการลูกค้า</span>
									</a>
								</span>
							</div>
						</div>
					</div>
				</div>
				<img src="build/web/ufacoder/img/border-modal.png" class="img-fluid d-lg-block d-none -border-bottom-modal" alt="">
			</div>
		</div>
	</div>





	<div class="x-modal modal" id="confirm_otpModal" tabindex="-1" role="dialog" aria-hidden="true" data-loading-container=".js-modal-content" data-ajax-modal-always-reload="true">
		<div class="modal-dialog -modal-size " role="document">
			<div class="modal-content -modal-content">
				<img src="build/web/ufacoder/img/border-modal.png" class="img-fluid d-lg-block d-none -border-top-modal" alt="">
				<button type="button" class="close f-1" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<div class="modal-header border-bottom-0 mt-3 pb-0 d-flex flex-column-reverse">
					<h3 class="m-auto text-white d-inline-block">
						กรอก เลข OTP 6 หลัก
						<hr class="x-hr-border-glow">
					</h3>
				</div>
				<div class="modal-body">
					<div class="x-login-form">
						<div data-animatable="fadeInModal" data-offset="0" class="-animatable-container">
							<div class="-x-input-icon mb-3 flex-column">
								<img src="build/web/ufacoder/img/phone.png" class="-icon" alt="login" width="20">
								<input type="text" id="confirm_otp" name="confirm_otp" class="form-control x-form-control" placeholder="OTP xxx">
							</div>


							<div class="text-center">
								<button type="button" class="btn btn-primary -submit my-lg-3 my-0 f-5 f-lg-6" onclick="confirm_otp()">
									<span>ถัดไป</span>
								</button>
							</div>


							<div class="x-admin-contact ">
								<span class="x-text-with-link-component">
									<label class="-text-message ">พบปัญหา</label>
									<a href="http://line.me/ti/p/~<?php echo $line ?>" target="_blank">
										<span>ติดต่อฝ่ายบริการลูกค้า</span>
									</a>
								</span>
							</div>
						</div>
					</div>
				</div>
				<img src="build/web/ufacoder/img/border-modal.png" class="img-fluid d-lg-block d-none -border-bottom-modal" alt="">
			</div>
		</div>
	</div>

	<div class="x-modal modal" id="reset_confirm_otpModal" tabindex="-1" role="dialog" aria-hidden="true" data-loading-container=".js-modal-content" data-ajax-modal-always-reload="true">
		<div class="modal-dialog -modal-size " role="document">
			<div class="modal-content -modal-content">
				<img src="build/web/ufacoder/img/border-modal.png" class="img-fluid d-lg-block d-none -border-top-modal" alt="">
				<button type="button" class="close f-1" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<div class="modal-header border-bottom-0 mt-3 pb-0 d-flex flex-column-reverse">
					<h3 class="m-auto text-white d-inline-block">
						กรอก เลข OTP 6 หลัก
						<hr class="x-hr-border-glow">
					</h3>
				</div>
				<div class="modal-body">
					<div class="x-login-form">
						<div data-animatable="fadeInModal" data-offset="0" class="-animatable-container">
							<div class="-x-input-icon mb-3 flex-column">
								<img src="build/web/ufacoder/img/phone.png" class="-icon" alt="login" width="20">
								<input type="text" id="reset_confirm_otp" name="reset_confirm_otp" class="form-control x-form-control" placeholder="OTP xxx">
							</div>


							<div class="text-center">
								<button type="button" class="btn btn-primary -submit my-lg-3 my-0 f-5 f-lg-6" onclick="reset_confirm_otp()">
									<span>ถัดไป</span>
								</button>
							</div>


							<div class="x-admin-contact ">
								<span class="x-text-with-link-component">
									<label class="-text-message ">พบปัญหา</label>
									<a href="http://line.me/ti/p/~<?php echo $line ?>" target="_blank">
										<span>ติดต่อฝ่ายบริการลูกค้า</span>
									</a>
								</span>
							</div>
						</div>
					</div>
				</div>
				<img src="build/web/ufacoder/img/border-modal.png" class="img-fluid d-lg-block d-none -border-bottom-modal" alt="">
			</div>
		</div>
	</div>


	<div class="x-modal modal" id="chang_pass" tabindex="-1" role="dialog" aria-hidden="true" data-loading-container=".js-modal-content" data-ajax-modal-always-reload="true">
		<div class="modal-dialog -modal-size " role="document">
			<div class="modal-content -modal-content">
				<img src="build/web/ufacoder/img/border-modal.png" class="img-fluid d-lg-block d-none -border-top-modal" alt="">
				<button type="button" class="close f-1" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<div class="modal-header border-bottom-0 mt-3 pb-0 d-flex flex-column-reverse">
					<h3 class="m-auto text-white d-inline-block">
						รหัสต้องการเปลี่ยน
						<hr class="x-hr-border-glow">
					</h3>
				</div>
				<div class="modal-body">
					<div class="x-login-form">
						<div data-animatable="fadeInModal" data-offset="0" class="-animatable-container">
							<div class="-x-input-icon mb-3 flex-column">
								<img src="build/web/ufacoder/img/phone.png" class="-icon" alt="login" width="20">
								<input type="password" id="update_password" name="update_password" class="form-control x-form-control" placeholder="รหัสผ่าน">
							</div>


							<div class="text-center">
								<button type="button" class="btn btn-primary -submit my-lg-3 my-0 f-5 f-lg-6" onclick="chang_pass()">
									<span>ยืนยัน</span>
								</button>
							</div>


							<div class="x-admin-contact ">
								<span class="x-text-with-link-component">
									<label class="-text-message ">พบปัญหา</label>
									<a href="http://line.me/ti/p/~<?php echo $line ?>" target="_blank">
										<span>ติดต่อฝ่ายบริการลูกค้า</span>
									</a>
								</span>
							</div>
						</div>
					</div>
				</div>
				<img src="build/web/ufacoder/img/border-modal.png" class="img-fluid d-lg-block d-none -border-bottom-modal" alt="">
			</div>
		</div>
	</div>

	<div class="x-modal modal" id="register_Modal" tabindex="-1" role="dialog" aria-hidden="true" data-loading-container=".js-modal-content" data-ajax-modal-always-reload="true">
		<div class="modal-dialog -modal-size " role="document">
			<div class="modal-content -modal-content">
				<img src="build/web/ufacoder/img/border-modal.png" class="img-fluid d-lg-block d-none -border-top-modal" alt="">
				<button type="button" class="close f-1" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<div class="modal-header border-bottom-0 mt-3 pb-0 d-flex flex-column-reverse">
					<h3 class="m-auto text-white d-inline-block">
						สมัครสมาชิก
						<hr class="x-hr-border-glow">
					</h3>
				</div>
				<div class="modal-body">
					<div class="x-login-form">
						<div data-animatable="fadeInModal" data-offset="0" class="-animatable-container">
							<div class="-x-input-icon mb-3 flex-column">
								<img src="build/web/ufacoder/img/user.png" class="-icon" alt="login" width="20">
								<input type="text" id="fname" name="fname" class="form-control x-form-control" placeholder="ชื่อ">
							</div>



							<div class="-x-input-icon mb-3 flex-column">
								<img src="build/web/ufacoder/img/password.png" class="-icon" alt="login" width="20">
								<input type="password" id="r_password" name="r_password" placeholder="รหัสผ่าน" class="form-control x-form-control">
							</div>


							<div class="-x-input-icon mb-3 flex-column">
								<img src="build/web/ufacoder/img/gift.png" class="-icon" alt="login" width="20">
								<select id="select_promotion" class="form-control">

									<option selected>ไม่รับโปรโมชั่น</option>
									<?php $i = 1;
									foreach ($res as $key => $value) { ?>
										<option value="<?= $value['p_id'] ?>">ฝาก <?= $value['p_deposit'] ?> รับเพิ่ม <?= $value['p_credit'] ?> เทิร์น <?= $value['p_deposit'] * $value['turnover'] ?></option>
										<?php $i++;
									}  ?>

								</select>
							</div>

							<div class="text-center">
								<button type="button" class="btn btn-primary -submit my-lg-3 my-0 f-5 f-lg-6" onclick="register()">
									<span>ยืนยัน</span>
								</button>
							</div>


							<div class="x-admin-contact ">
								<span class="x-text-with-link-component">
									<label class="-text-message ">พบปัญหา</label>
									<a href="http://line.me/ti/p/~<?php echo $line ?>" target="_blank">
										<span>ติดต่อฝ่ายบริการลูกค้า</span>
									</a>
								</span>
							</div>
						</div>
					</div>
				</div>
				<img src="build/web/ufacoder/img/border-modal.png" class="img-fluid d-lg-block d-none -border-bottom-modal" alt="">
			</div>
		</div>
	</div>



		<!-- <img style="width: 100px; padding: .12rem;
position: fixed;
top: 75%;
right: 0;
z-index: 2;
overflow: unset;
bottom: unset;
margin-right: -15px;
margin-top: -50px;
" src="https://qbabet.com/member/livechat.png" usemap="#image-map">
-->
<script type="text/javascript">


</script>

<map name="image-map">
	<!-- <area target="" alt="" title="" coords="91,101,12,13" shape="rect" onclick="livechat()"> -->
	<area target="" alt="" title="" href="javascript:LiveChatWidget.call('maximize')" coords="91,101,12,13" shape="rect">
	<area target="" alt="" title="" coords="15,103,95,193" shape="rect" onclick="line()">
</map>

<script type="text/javascript">
	function line() {
		var line = "<?php echo $line ?>"
		window.open('http://line.me/ti/p/~' + line, '_blank');
	}

	function livechat() {
		alert('livechat')
	}
</script>

<footer class="x-footer py-3">
	<div class="-inner-wrapper pt-4">
		<div class="x-footer-bank-logo">
			<div class="container">
				<div class="-wrapper">
					<div class="-ic -ic-1" style="background: url('build/web/ufacoder/img/ic-bank-logo.png')"></div>
					<div class="-ic -ic-2" style="background: url('build/web/ufacoder/img/ic-bank-logo.png')"></div>
					<div class="-ic -ic-3" style="background: url('build/web/ufacoder/img/ic-bank-logo.png')"></div>
					<div class="-ic -ic-4" style="background: url('build/web/ufacoder/img/ic-bank-logo.png')"></div>
					<div class="-ic -ic-5" style="background: url('build/web/ufacoder/img/ic-bank-logo.png')"></div>
					<div class="-ic -ic-6" style="background: url('build/web/ufacoder/img/ic-bank-logo.png')"></div>
					<div class="-ic -ic-7" style="background: url('build/web/ufacoder/img/ic-bank-logo.png')"></div>
					<div class="-ic -ic-8" style="background: url('build/web/ufacoder/img/ic-bank-logo.png')"></div>
					<div class="-ic -ic-9" style="background: url('build/web/ufacoder/img/ic-bank-logo.png')"></div>
					<div class="-ic -ic-10" style="background: url('build/web/ufacoder/img/ic-bank-logo.png')"></div>
					<div class="-ic -ic-11" style="background: url('build/web/ufacoder/img/ic-bank-logo.png')"></div>
					<div class="-ic -ic-12" style="background: url('build/web/ufacoder/img/ic-bank-logo.png')"></div>
				</div>
			</div>
		</div>
		<div class="text-center mt-4">
			<div>
				<a href="#" class="text-warning">Term and condition</a>
			</div>
			<p class="mb-0">
				Copyright © 2020 <?php echo $name; ?>. All Rights Reserved.
			</p>
		</div>
	</div>
</footer>
</div>



<script>
	window.onload = function() {
		localStorage.setItem("ref", '<?php echo $phone; ?>');
		var ref = localStorage.getItem("ref");
	}

	function reset_input_phone() {
		$('#reset_get_otpModal').modal('show');
		$('#loginModal').modal('hide');
		var phone = $("#phone_reset").val();
	}

	function reset_get_otp() {
		var phone = $("#phone_reset").val();
		if (phone == "") {
			Swal.fire({
				icon: 'error',
				title: 'แจ้งเตือน...',
				text: 'กรุณากรอ เบอรืมือถือ 10 หลัก'

			})
			return false
		}
		showModal()
		$.ajax({
			url: 'action.php?reset_get_otp',
			type: 'POST',
			data: {
				phone: phone
			},

			success: function(data) {
				if (data != "") {
					var obj = JSON.parse(data);
					var msg = obj.msg
					var status = obj.status
					if (status == 200) {
						$('body').loadingModal('hide');
						$('body').loadingModal('destroy');
						$('#reset_get_otpModal').modal('hide');
						$('#reset_confirm_otpModal').modal('show');
					} else {
						$('body').loadingModal('hide');
						$('body').loadingModal('destroy');
						Swal.fire({
							icon: 'error',
							title: 'แจ้งเตือน...',
							text: msg

						})

					}

				}

				$('body').loadingModal('hide');
				$('body').loadingModal('destroy');
			}

		});
	}

	function login() {
		location.replace("https://qbabet-th.com/login");
	}

	function register() {
		location.replace("https://qbabet-th.com/register");
	}

	function showModal() {
		$('body').loadingModal({
			text: 'กำลังทำรายการ...'
		});
		var delay = function(ms) {
			return new Promise(function(r) {
				setTimeout(r, ms)
			})
		};
		var time = 2000;
		delay(time)
	}

	Bonn.boots.push(function() {
		$('.js-simple-play-sidebar').click(function(e) {
			e && e.preventDefault();
			const selector = $('.x-simple-play-sidebar-container');
			selector.addClass('show');
		});
		$('.js-close-simple-play-sidebar').click(function(e) {
			e && e.preventDefault();
			const selector = $('.x-simple-play-sidebar-container');
			selector.removeClass('show');
		});
	});
</script>

<script>
	Bonn.boots.push(function() {
		setTimeout(function() {
			$('#bankInfoModal').modal('show');
		}, 500);
	});

	let InputPass = document.getElementById("password_r");
	let letter = document.getElementById("letter");
	let capital = document.getElementById("capital");
	let number = document.getElementById("number");
	let length = document.getElementById("length");
	let registerBTN = document.getElementById("registerBTN");

	InputPass.onfocus = function() {
		document.getElementById("message").style.display = "block";
	}
	InputPass.onblur = function() {
		document.getElementById("message").style.display = "none";
	}
		// registerBTN.disabled = true;
		InputPass.onkeyup = function() {
			let stringPass = /[A-Za-z]/;
			if (InputPass.value.match(stringPass)) {
				letter.classList.remove("invalid");
				letter.classList.add("valid");
				registerBTN.disabled = false;
			} else {
				letter.classList.remove("valid");
				letter.classList.add("invalid");
				registerBTN.disabled = true;
			}

			let numbers = /[0-9]/g;
			if (InputPass.value.match(numbers)) {
				number.classList.remove("invalid");
				number.classList.add("valid");
				registerBTN.disabled = false;
			} else {
				number.classList.remove("valid");
				number.classList.add("invalid");
				registerBTN.disabled = true;
			}

			if (InputPass.value.length >= 8) {
				length.classList.remove("invalid");
				length.classList.add("valid");
				registerBTN.disabled = false;
			} else {
				length.classList.remove("valid");
				length.classList.add("invalid");
				registerBTN.disabled = true;
			}
		}
	</script>
	<style>
	#message {
		display: none;
		background: #f1f1f1;
		color: #000;
		position: relative;
		padding: 40px;
	}

	#message p {
		padding: 2px 15px;
		font-size: 18px;
	}

	.valid {
		color: green;
	}

	.valid:before {
		position: relative;
		left: -35px;
		content: "✔";
	}

	.invalid {
		color: red;
	}

	.invalid:before {
		position: relative;
		left: -35px;
		content: "✖";
	}
</style>
</style>
<script>
	var IS_ANDROID = false;
</script>
<script src="build/runtime.1ba6bf05.js"></script>
<script src="build/0.9a86198d.js"></script>
<script src="build/3.02782841.js"></script>
<script src="build/web/ufacoder/app.0e2313e3.js"></script>
<script src="js/jquery.loadingModal.js"></script>
</body>

</html>