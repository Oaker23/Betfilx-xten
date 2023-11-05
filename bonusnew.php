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
$status=$row['status_user'];

$sql = "SELECT * FROM `promotion` WHERE `p_name`='โปร สมาชิกใหม่'";

$result = $server->query($sql);
$res=[];
foreach ($result as  $value) {
  array_push($res, $value);
  
}

$check=count($res);

?>


<!DOCTYPE html>
<html lang="th">
<head>
  <?php include("template/info.php"); ?>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
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
  <link rel="stylesheet" href="css/jquery.loadingModal.css">
  <!-- Custom styles -->
  <link href="public/css/style-dashboardv6.css?v=1.01" rel="stylesheet" />

  <style>
  .share-list i {
    color: #212529;
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


        <section class="bonus">
          <h3 class="text-center">โบนัส สมาชิกใหม่</h3>



          <div class="row">
           <?php $i=1; foreach ($res as $key => $value) {?>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <div class="card bonus">
                <img src="manager/<?=$value['image']; ?>" alt="Card image cap" class="card-img-top">
                <div class="card-body bonus-body text-center">
                 <h4 class="card-title"> <?=$value['description']; ?></h4>
                <!-- <h4 class="card-title"><?=$value['p_name']; ?></h4>
                <p style="display: <?php if ($value['p_credit']=="") {echo "none";}else{echo "block";}?>;" class="card-text"><span> ฝาก <?=$value['p_deposit']; ?></span> <span>บาท</span> <span>รับเงินเพิ่ม</span> <?=$value['p_credit']; ?> ทำเทิร์น <?=$value['turnover']; ?></p>
                 <p style="display: <?php if ($value['p_credit']=="") {echo "block";}else{echo "none";}?>;" class="card-text"><span> รับ <?=$value['p_deposit']; ?> ของยอดฝาก</span>  ทำเทิร์น <?=$value['turnover']; ?> เท่า</p>
                 <h4 class="card-title">เงื่อนไข : <?=$value['condition_pro']; ?></h4> -->
                 <div role="alert" class="alert alert-danger bonus-alert"><a>หากทีมงานตรวจสอบพบรายการลูกค้าเข้าค่ายการล่าโปร ขอระงับการจ่ายเงินทุกกรณี</a>
                 </div>
                 <button class="btn btn-success btn-sm br-main" onclick="give('<?=$value['p_id']; ?>')"><i class="far fa-gift"></i> กดที่นี่เพื่อรับโบนัส
                 </button>
               </div>
             </div>
           </div>
           <?php $i++; }  ?>
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
  function give(data){
    var id=data;
    var phone="<?php echo $row["phone"]; ?>";
    showModal();
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
