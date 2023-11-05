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


// $sql_rfid = "SELECT * FROM refill WHERE phone='".$_SESSION['phone']."' and status='0' ORDER by id DESC limit 5";
$sql_rfid = "SELECT * FROM refill WHERE phone='".$_SESSION['phone']."' ORDER by id DESC limit 5";
$result_rfid = $server->query($sql_rfid);
$res=[];
foreach ($result_rfid as  $value) {
  array_push($res, $value);
  
}
// var_dump($res);
$check=count($res);


$sql_rfid1 = "SELECT * FROM withdraw WHERE phone='".$_SESSION['phone']."' ORDER by id DESC limit 5";
// $sql_rfid1 = "SELECT * FROM withdraw WHERE phone='".$_SESSION['phone']."' and status='0' ORDER by id DESC limit 5";
$result_rfid1 = $server->query($sql_rfid1);
$res1=[];
foreach ($result_rfid1 as  $value1) {
  array_push($res1, $value1);
  
}

$check1=count($res1);

function code($value){
  $value=trim($value);

  if ($value=="BAY") {
    return 'กรุงศรี อยุธยา';
  }

  if ($value=="CIMB") {
    return 'ทรูมันนี่ วอเลต';
  }

  if ($value=="CIMB") {
    return 'ทรูมันนี่ วอเลต';
  }

  if ($value=="KBANK") {
    return 'กสิกรไทย';
  }

  if ($value=="SCB") {
    return 'ไทยพาณิชย์';
  }



}


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
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Kanit:300">
  <link
  rel="stylesheet"
  href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.0-beta/css/bootstrap-select.min.css"
  />

  <!-- Custom styles -->
  <link href="public/css/style-dashboardv6.css?v=1.01" rel="stylesheet" />

  <style>
  .share-list i {
    color: #212529;
  }
</style>
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Kanit:300">
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
          <h5 class="card-header">ประวัติ การฝากเงิน</h5>
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
              <table width="100%" class="table table-striped" id="tableDeposit">
                <thead>
                  <tr>

                    <th>เวลา</th>
                    <th>ยอดเงิน</th>

                  </tr>
                </thead>
                <tbody>
                  <?php $i=1; foreach ($res as $key => $value) {?>
                    <tr>

                      <td><?=$value ['date_check']; ?> <?=$value ['time_check']; ?></td>
                      <td><?=number_format($value['amount'],2); ?></td>

                    </tr>
                    <?php $i++; }  ?>
                  </tbody>
                </table>
              </div>

            </div>
          </div>
          <br >
          <div class="card">
            <h5 class="card-header">ประวัติ การถอนเงิน</h5>
            <div class="card-body" align="center">
            <!-- <?php
            if ($check1<=0) {
              echo "ไม่มีข้อมุล";

            }
            ?>
            <div class="container"
            <?php
            if ($check1<=0) {
              echo "style='display: none'";

            }
            ?>    
            > -->
            <div class="container">
              <table width="100%" class="table table-striped" id="tableWithdraw">
                <thead>
                  <tr>

                    <th>วัน/เวลา</th>
                    <th>ยอดเงิน</th>
                    <th>สถานะ</th>
                    <th>ข้อมูล</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $i=1; foreach ($res1 as $key => $value) {?>
                    <tr>

                      <td><?=$value ['date_withdraw']; ?> <?=$value ['time_withdraw']; ?></td>
                      <td><?=number_format($value['credit'],2); ?></td>
                      <td>
                        <?php
                        $status=$value['status'];
                        if ($status==1) {
                          echo "<i class='fas fa-spinner' style='color: green'></i> รอ";
                        }

                        if ($status==2) {

                          echo "<i class='fas fa-times' style='color: red'></i> ผิดพลาด";
                        }

                        if ($status==0) {

                         echo "<i class='fas fa-check' style='color: green'></i> !สำเร็จ";
                       }
                       ?>  
                     </td> 
                     <td><?=$value ['description']; ?></td>
                   </tr>
                   <?php $i++; }  ?>
                 </tbody>
               </table>
             </div>

           </div>
         </div>
         <div class="card">
          <h5 class="card-header">ประวัติ การถอนเงิน แนะนำเพื่อน</h5>
          <div class="card-body">

            <?php 

            $sql_rfid = "SELECT * FROM log_affliliate WHERE phone='".$_SESSION['phone']."'ORDER by id DESC limit 5";
            $result_rfid = $server->query($sql_rfid);
            $res_refund=[];
            foreach ($result_rfid as  $value) {
              array_push($res_refund, $value);

            }

         
            ?>

            <table class="table table-striped" id="tableRefund">
              <thead  style="color:black;"> 
                <tr>
                  <th>ลำดับ</th>
                  <th>วัน/เวลา</th>
                  <th>ยอดเงิน</th>

                </tr>
              </thead>
              <tbody>
                <?php $i=1; foreach ($res_refund as $key => $value) {?>
                  <tr>
                    <td><?=$i ?></td>
                    <td><?=$value['date_check']; ?> <?=$value['time_check']; ?></td>
                    <td><?=number_format($value ['credit'],2); ?></td>

                  </tr>
                  <?php $i++; }  ?>
                </tbody>
              </table>

            </section>

            <popup-announcement />
          </div>
        </main>


        <?php 
        require 'footer.php';
        ?>
      </div>

      <script>
        function login_game(){
          var username_game="<?php echo $row["username_game"]; ?>";
          window.open("login_game.php?username_game="+username_game);
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
          <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
          <script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap4.min.js"></script>
          <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
          <script src="https://cdn.datatables.net/responsive/2.2.9/js/responsive.bootstrap4.min.js"></script>
          <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap4.min.css">
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
<script>
	$(document).ready(function() {
		$('#tableWithdraw').DataTable({
			"lengthChange": false,
			"pageLength": 5,
      "searching": false,
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

  $(document).ready(function() {
    $('#tableDeposit').DataTable({
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
