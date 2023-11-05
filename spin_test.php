<?php
error_reporting(0);
if (!isset($_SESSION)) {
	session_start();
}
if($_SESSION["phone"] == "") {
	echo " <script> window.location = './login';</script>";
   }
require 'config/config.php';
include("api_spin/api.php");

$sql_website = "SELECT * FROM website LIMIT 1";
$result_website = $server->query($sql_website);
$row_website = mysqli_fetch_assoc($result_website);
if($row_website['enable_webpage'] != 1){
	// header("location: maintenance");
}

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
	<link href="public/css/style-dashboardv6.css?v1.06" rel="stylesheet" />
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Kanit:300">
	<link rel="stylesheet" href="api_spin/wheel.css?v1.06">
	<!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"> -->

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
				<img src="" alt="" />
			</div>
			<div class="slide-img d-block d-md-none">
				<img src="" alt="" />
			</div>
		</section>

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

					     <!-- <current-credit value="<?php echo $amount; ?>" link></current-credit>  -->
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


	</script>

      <!-- Bootstrap core JavaScript
      	================================================== -->
      	<!-- Placed at the end of the document so the pages load faster -->
      	<!-- <script
      	src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
      	integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
      	crossorigin="anonymous"
      	></script> -->
		  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
		<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script> -->
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
		</script>
<script>
var items = [
<?php 


$items = [
    // ['id'=>"0",'image'=>$wheel['unlucky']['image'],'name'=>'ไม่ได้รับรางวัล'],
    // ['id'=>"1",'image'=>$wheel['item'][1]['image'],'name'=>$wheel['item'][1]['name']],
    // ['id'=>"2",'image'=>$wheel['item'][2]['image'],'name'=>$wheel['item'][2]['name']],
    // ['id'=>"3",'image'=>$wheel['unlucky']['image'],'name'=>'ไม่ได้รับรางวัล'],
    // ['id'=>"4",'image'=>$wheel['item'][4]['image'],'name'=>$wheel['item'][4]['name']],
    // ['id'=>"5",'image'=>$wheel['item'][5]['image'],'name'=>$wheel['item'][5]['name']],
	['id'=>"0",'image'=>$wheel['unlucky']['image'],'name'=>'ไม่ได้รับรางวัล'],
    ['id'=>"1",'image'=>$wheel['item'][1]['image'],'name'=>$wheel['item'][1]['name']],
    ['id'=>"2",'image'=>$wheel['item'][2]['image'],'name'=>$wheel['item'][2]['name']],
    ['id'=>"3",'image'=>$wheel['unlucky']['image'],'name'=>'ไม่ได้รับรางวัล'],
    ['id'=>"4",'image'=>$wheel['item'][4]['image'],'name'=>$wheel['item'][4]['name']],
    ['id'=>"5",'image'=>$wheel['item'][5]['image'],'name'=>$wheel['item'][5]['name']],
];

// $items = [
//     // ['id'=>"0",'image'=>$wheel['unlucky']['image'],'name'=>'ไม่ได้รับรางวัล'],
//     // ['id'=>"1",'image'=>$wheel['item'][1]['image'],'name'=>$wheel['item'][1]['name']],
//     // ['id'=>"2",'image'=>$wheel['item'][2]['image'],'name'=>$wheel['item'][2]['name']],
//     // ['id'=>"3",'image'=>$wheel['unlucky']['image'],'name'=>'ไม่ได้รับรางวัล'],
//     // ['id'=>"4",'image'=>$wheel['item'][4]['image'],'name'=>$wheel['item'][4]['name']],
//     // ['id'=>"5",'image'=>$wheel['item'][5]['image'],'name'=>$wheel['item'][5]['name']],
// 	['image'=>$wheel['unlucky']['image'],'name'=>'ไม่ได้รับรางวัล'],
//     ['image'=>$wheel['item'][1]['image'],'name'=>$wheel['item'][1]['name']],
//     ['image'=>$wheel['item'][2]['image'],'name'=>$wheel['item'][2]['name']],
//     ['image'=>$wheel['unlucky']['image'],'name'=>'ไม่ได้รับรางวัล'],
//     ['image'=>$wheel['item'][4]['image'],'name'=>$wheel['item'][4]['name']],
//     ['image'=>$wheel['item'][5]['image'],'name'=>$wheel['item'][5]['name']],
// ];

foreach($items as $key => $value){
    ?>
    { 	name: "<img src='<?= $value['image'] ?>' class='show-spinv2'></img><p class='p-spinv2'><?= $value['name'] ?></p>",
        color: "#ed616f",
        message: "<?= $value['name'] ?>",
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

console.log("ccc=",items);

// var ss = [
//     {
//       name    : "<img src='wheel/img/none_v2.png' class='show-spinv2'></img>คุณไม่ได้รับรางวัล",
//       color   : '#ed616f'
//     },{
//       name    : "<img src='wheel/img/credit_v2.png' class='show-spinv2'></img>คุณได้รับ พ้อยท์ 15",
//       color   : '#ed616f'
//     },{
//       name    : "<img src='wheel/img/credit_v2.png' class='show-spinv2'></img>คุณได้รับ พ้อยท์ 50",
//       color   : '#ed616f'
//     },{
//       name    : 'Lose',
//       message : 'You Lose :(',
//       color   : '#3498db'
//     },{
//       name    : '40% OFF',
//       message : 'You win 40% off',
//       color   : '#ffc107'
//     },{
//       name    : 'Nothing',
//       message : 'You get Nothing :(',
//       color   : '#f44336'
//     }
//   ];
//   console.log("ccc2=",ss);


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
             console.log("success msg=",msg);
            if(msg.lose == true){
                lose = true;
            }else{
                lose = false;
            }
        },
        error: function(msg) {
             console.log("error msg=",msg);
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
             console.log("onComplete results=",results);
             console.log("count=",count);
             console.log("now=",now);
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

</body>
</html>
