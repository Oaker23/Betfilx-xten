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



$sql_user = "SELECT * FROM member WHERE phone='".$_SESSION["phone"]."'";



$result_user = $server->query($sql_user);

$row_user = mysqli_fetch_assoc($result_user);

$credit_user=$row_user['credit'];

$fname=$row_user['fname'];

$banknumber=$row_user['banknumber'];

$bankname=$row_user['bankname'];



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



  <!-- Custom styles -->

  <link href="public/css/style-dashboardv6.css?v=1.04" rel="stylesheet" />



  <style>

  .share-list i {

    color: #212529;

  }

</style>





</head>



<body class="animated fadeIn fast">

  <div>

   <?php 

   require 'header.php';

  //  if($refill_check == 0){

  //   edit($row['username_game'],$row['fname'],$row['phone']);

  // }



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

          <div class="user-info-desktop d-md-block">

            <a>รหัสสมาชิกของคุณคือ: <?php echo $row['phone']; ?> (<?php echo $row["username_game"]; ?>)</a><br>

            <a style="color: #aa080b;font-weight: bold;"> สวัสดี <?php echo $row_user['fname']; ?><br>

            <span

            onclick="window.location.href = './password.php';"

            class="reset-password"

            ><i class="far fa-key"></i> เปลี่ยนรหัสผ่าน</span

            >

          </div>

          <!--Show on Mobile-->

          <!-- <div class="user-info-mobile d-block d-sm-block d-md-none">

            <span

            onclick="window.location.href = '#';"

            class="reset-password"

            ><i class="far fa-key"></i> เปลี่ยนรหัสผ่าน</span

            >

          </div> -->

        </section>



        <current-credit value="<?php echo $amount; ?>" link></current-credit>

        <script>

            function setHref() {

                $(".btn-gold").attr("href","./deposit");

                $(".btn-silver").attr("href","./withdraw");

            }

            setTimeout(setHref, 300);

            

        </script>

          <!--Show on Desktop-->

          <div class="row">

            <div class="col-lg-12">

              <div style="text-align: center;margin-top: -45px;padding: 8px 20px;">

                <p style="background-color: #FFFFFF">

               	  ธนาคาร <?php echo $row_user['bank_name'] ?> | เลขบัญชี: <?php echo $row_user['bank_number'] ?>

                </p>

              </div>

            </div>

          </div>



          <!-- <section class="user-infor text-center">

          <div class="user-info-desktop d-none d-md-block">

           	ธนาคาร: <b> <?php echo $row_user['bank_name'] ?> เลขบัญชี: <b><?php echo $row_user['bank_number'] ?></p>

          </section> -->

        <section class="navigation">

          <div class="nav-play-button">

            <a

            href="login_game.php?username_game=<?php echo $row["username_game"]; ?>" target="_blank"

            class="btn-block play-button text-center hvr-buzz-out"

            >

            <i class="far fa-play"></i>

            <p>เข้าเล่นเกมส์</p>

          </a>

        </div>



        <div class="nav-other-button">

          <div class="other-list other-list-full">

            <a href="affliliate" class="btn-dark-tri hvr-buzz-out"

            ><i class="fal fa-users"></i>

            <p>แนะนำเพื่อนรับค่าคอม</p></a

            >

          </div>

          <div class="other-list other-list-1">

            <a href="./bonusnew" class="btn-dark-tri hvr-buzz-out"

            ><i class="fal fa-gift"></i>

            <p>โบนัส สมัครใหม่</p></a

            >

          </div>

          <div class="other-list other-list-2">

            <a href="./bonustoday" class="btn-dark-tri hvr-buzz-out"

            ><i class="fas fa-star"></i>

            <p>โบนัส รายวัน</p></a

            >

          </div>

          <div class="other-list other-list-1">

            <a href="card" class="btn-dark-tri hvr-buzz-out"

            ><i class="fas fa-check"></i>

            <p>เติมโค้ด</p></a

            >

          </div>

          <div class="other-list other-list-2">

            <a href="#" target="_blank" class="btn-dark-tri hvr-buzz-out"

            ><i class="fas fa-chess-queen"></i>

            <p>สูตรคาสิโน</p></a

            >

          </div>

          <div class="other-list other-list-1">

            <a href="spin" class="btn-dark-tri hvr-buzz-out"

            ><i class="fas fa-tire"></i>

            <p>หมุนวงล้อนำโชค</p></a

            >

          </div>

        <div class="other-list other-list-2">

            <a href="refund" class="btn-dark-tri hvr-buzz-out"

            ><i class="fas fa-donate"></i>

            <p>รับเงินคืน</p></a

            >

          </div>

          <div class="other-list other-list-1">

            <a href="history" class="btn-dark-tri hvr-buzz-out"

            ><i class="fal fa-list-alt"></i>

            <p>ประวัติการเงิน</p></a

            >

          </div>

          

          <div class="clearfix"></div>

        </div>

        <div class="clearfix"></div>

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



    <popup-announcement />

  </div>

  <div class="loader-wrapper">

    <span class="loader"><span class="loader-inner"></span></span>

  </div>

</main>





<?php 

require 'footer.php';

?>

</div>









<script>







  // $( ".fas fa-sync-alt refresh pointer animated" ).change(function() {

  //   alert( "Handler for .change() called." );

  // });





  function login_game(){

    var username_game="<?php echo $row["username_game"]; ?>";

    window.open("login_game.php?username_game="+username_game);

  }



  window.onload = function() {

    var phone = "<?php echo $_SESSION["phone"] ?>";

    $.ajax({

     url: 'action.php?uodate_profile',

     type: 'POST',

     data: {

      phone: phone

    },



    success: function(data) {



     console.log(data)



   }



 });





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

          <script>

            $(window).on("load",function(){

              $(".loader-wrapper").fadeOut("slow");

            });

          </script>



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

        </div>



      </body>

      </html>

