  <?php 
 if($_SESSION["username"] == "") {

  echo " <script> window.open('./login');</script>";

  exit();
}
  date_default_timezone_set("Asia/Bangkok");
  
  $start_date = $_GET['start_date'];
  $end_date = $_GET['end_date'];


  if ($start_date=="") {
    $start_date=$date_check=date("Y-m-d");
    $end_date= $date_check=date("Y-m-d");
  }else{
    $start_date= $start_date;
    $end_date= $end_date;
  }


  $sql_sum1 = "SELECT SUM(amount) as total_all FROM refill WHERE amount>0 and phone!='' and date_check between '".$start_date."' and '".$end_date."'";
  $result_sum1 = $server->query($sql_sum1);
  $row__sum1 = mysqli_fetch_assoc($result_sum1);
  $total_all=$row__sum1['total_all']; //ยอดฝาก

  $sql_sum6 = "SELECT SUM(credit) as total_all FROM withdraw where status=0  and   date_withdraw between '".$start_date."' and '".$end_date."'";
  $result_sum6 = $server->query($sql_sum6);
  $row__sum6 = mysqli_fetch_assoc($result_sum6);
  $total_all_withdraw=$row__sum6['total_all']; 




//ยอดรับโปรสมาชิกให่วันนี้

$sql_promotion1 = "SELECT COUNT(DISTINCT phone) total_bonus_today FROM history_promotion WHERE `name`='ฝากครั้งแรกของวัน'  and date_check between '".$start_date."' and '".$end_date."'";
$result_promotion1 = $server->query($sql_promotion1);
$row__promotion1 = mysqli_fetch_assoc($result_promotion1);
$total_promotion1=$row__promotion1['total_bonus_today'];



//ฝากครั้งแรกของวัน


$sql_promotion2 = "SELECT SUM(credit) as sum_bonus FROM history_promotion WHERE    date_check between '".$start_date."' and '".$end_date."'";
$result_promotion2 = $server->query($sql_promotion2);
$row__promotion2 = mysqli_fetch_assoc($result_promotion2);
$total_promotion2=$row__promotion2['sum_bonus'];



//เครดิตโบนัส รวม

$sql_promotion3 = "SELECT SUM(credit) as sum_bonus_new FROM history_promotion WHERE `name`='โปร สมาชิกใหม่'  and date_check between '".$start_date."' and '".$end_date."'";
$result_promotion3 = $server->query($sql_promotion3);
$row__promotion3 = mysqli_fetch_assoc($result_promotion3);
$sum_bonus_new=$row__promotion3['sum_bonus_new'];

$sql_promotion4 = "SELECT SUM(credit) as sum_bonus_today FROM history_promotion WHERE `name`='ฝากครั้งแรกของวัน'   and date_check between '".$start_date."' and '".$end_date."'";
$result_promotion4 = $server->query($sql_promotion4);
$row__promotion4 = mysqli_fetch_assoc($result_promotion4);
$sum_bonus_today=$row__promotion4['sum_bonus_today'];




$sql_promotion5 = "SELECT SUM(credit) as sum_bonus_today FROM history_promotion WHERE `name`='รับทุกครั้งที่ฝากเงิน'   and date_check between '".$start_date."' and '".$end_date."'";
$result_promotion5 = $server->query($sql_promotion5);
$row__promotion5 = mysqli_fetch_assoc($result_promotion5);
$sum_bonus_today1=$row__promotion5['sum_bonus_today'];

$total_promotion=$sum_bonus_new+$sum_bonus_today+$sum_bonus_today1;


$sql_code="SELECT COUNT(DISTINCT phone) total_code FROM code_itme WHERE  `phone`!=''  and date_check between '".$start_date."' and '".$end_date."'";
$result_code = $server->query($sql_code);
$row_code = mysqli_fetch_assoc($result_code);
$total_code=$row_code['total_code'];



$sql_sum_code = "SELECT SUM(credit) as sum_code FROM code_itme WHERE phone!='' and date_check between '".$start_date."' and '".$end_date."'";
$result_sum_code = $server->query($sql_sum_code);
$row__sum_code = mysqli_fetch_assoc($result_sum_code);
$sum_code=$row__sum_code['sum_code'];


$sql_refun = "SELECT SUM(credit) as sum_refund FROM history_refund WHERE    date_check between '".$start_date."' and '".$end_date."'";
$result_refun = $server->query($sql_refun);
$row_refun = mysqli_fetch_assoc($result_refun);
$sum_refund=$row_refun['sum_refund'];



 $free_total=$sum_code;
  $free_bonus=$total_promotion;

$profit=$total_all-$total_all_withdraw; //กำไรขาดทุน

$sql_user_stock="SELECT COUNT(id) user_stock FROM user_stock ";
$result_user_stock = $server->query($sql_user_stock);
$row_user_stock = mysqli_fetch_assoc($result_user_stock);
$user_stock=$row_user_stock['user_stock'];


include '../api_betflix.php';
$balance_agent=$api->balance_agent();

  ?>
  <link href="datepicker/css/datepicker.css" rel="stylesheet" media="screen">
  <div class="page-holder bg-gray-100">
    <div class="container-fluid px-lg-4 px-xl-5">

      <section class="mb-3 mb-lg-5">

          <div class="row">
            <div class="col-xs-12 col-md-6">
              <div class="all-box box-green">
                <h2>฿ <?php echo number_format($total_all,2); ?></h2>
                <h3>ยอดฝากรวม</h3>
              </div>
            </div>
            <div class="col-xs-12 col-md-6">
              <div class="all-box box-red">
                <h2>฿ <?php echo number_format($total_all_withdraw,2); ?></h2>
                <h3>ยอดถอนรวม</h3>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-xs-12 col-md-6">
              <div class="all-box box-yellow">
                <h2>฿ <?php echo number_format($free_bonus,2); ?></h2>
                <h3>โบนัสเสียรวม</h3>
              </div>
            </div>
            <div class="col-xs-12 col-md-6">
              <div class="all-box box-far">
                <h2><?php echo $user_stock; ?></h2>
                <h3>สมาชิก stock</h3>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-xs-12 col-md-3">
              <div class="all-box box-green">
                <h2>฿ <?php echo number_format($balance_agent,2); ?></h2>
                <h3>เครดิต คงเหลือ</h3>
              </div>
            </div>
            <div class="col-xs-12 col-md-3">
              <div class="all-box box-red">
                <h2>฿ <?php echo number_format($sum_refund,2); ?></h2>
                <h3>รับยอด เสียรวม</h3>
              </div>
            </div>
            <div class="col-xs-12 col-md-3">
              <div class="all-box box-green">
                <h2>฿ <?php echo number_format($profit,2); ?></h2>
                <h3>กำไร-ขาดทุน</h3>
              </div>
            </div>
            <div class="col-xs-12 col-md-3">
              <div class="all-box box-red">
                <h2>฿ <?php echo number_format($free_total,2); ?></h2>
                <h3>โค้ดเครดิตฟรี เสียรวม</h3>
              </div>
            </div>
          </div>

      </section>

      <!-- <section class="mb-3 mb-lg-5">
        <div class="row">
          <div class="col-xl-3 col-md-6 mb-4">
            <div class="card-widget h-100">
              <div class="card-widget-body">
                <div class="dot me-3 bg-indigo"></div>
                <div class="text">
                  <h6 class="mb-0">ยอดฝากรวม</h6><span class="text-gray-500"><h4><?php echo number_format($total_all,2); ?> บาท</h4></span>
                </div>
              </div>
              <div class="icon text-white bg-indigo"><i class="fas fa-server"></i></div>
            </div>
          </div>
          <div class="col-xl-3 col-md-6 mb-4">
            <div class="card-widget h-100">
              <div class="card-widget-body">
                <div class="dot me-3 bg-green"></div>
                <div class="text">
                  <h6 class="mb-0">ยอดถอนรวม</h6><span class="text-gray-500"><h4><?php echo number_format($total_all_withdraw,2); ?>  บาท</h4></span>
                </div>
              </div>
              <div class="icon text-white bg-green"><i class="far fa-clipboard"></i></div>
            </div>
          </div>
          <div class="col-xl-3 col-md-6 mb-4">
            <div class="card-widget h-100">
              <div class="card-widget-body">
                <div class="dot me-3 bg-blue"></div>
                <div class="text">
                  <h6 class="mb-0">กำไร-ขาดทุน</h6><span class="text-gray-500"><h4><?php echo number_format($profit,2); ?> บาท</h4></span>
                </div>
              </div>
              <div class="icon text-white bg-blue"><i class="fas fa-search-dollar"></i></div>
            </div>
          </div>
          <div class="col-xl-3 col-md-6 mb-4">
            <div class="card-widget h-100">
              <div class="card-widget-body">
                <div class="dot me-3 bg-red"></div>
                <div class="text">
                 
                  <h6 class="mb-0">โค้ดเครดิตฟรี เสียรวม</h6><span class="text-gray-500"><h4> <?php echo number_format($free_total,2); ?> บาท</h4></span>
                </div>
              </div>
              <div class="icon text-white bg-red"><i class="fas fa-receipt"></i></div>
            </div>
          </div>
     
     <div class="col-xl-3 col-md-6 mb-4">
            <div class="card-widget h-100">
              <div class="card-widget-body">
                <div class="dot me-3 bg-green"></div>
                <div class="text">
                 
                  <h6 class="mb-0">โบนัส เสียรวม</h6><span class="text-gray-500"><h4> <?php echo number_format($free_bonus,2); ?> บาท</h4></span>
                </div>
              </div>
              <div class="icon text-white bg-yellow"><i class="fas fa-donate"></i></div>
            </div>
          </div>

               <div class="col-xl-3 col-md-6 mb-4">
            <div class="card-widget h-100">
              <div class="card-widget-body">
                <div class="dot me-3 bg-red"></div>
                <div class="text">
                 
                  <h6 class="mb-0">รับยอด เสียรวม</h6><span class="text-gray-500"><h4> <?php echo number_format($sum_refund,2); ?> บาท</h4></span>
                </div>
              </div>
              <div class="icon text-white bg-blue"><i class="fas fa-hand-holding-usd"></i></div>
            </div>
          </div>

                 <div class="col-xl-3 col-md-6 mb-4">
            <div class="card-widget h-100">
              <div class="card-widget-body">
                <div class="dot me-3 bg-indigo"></div>
                <div class="text">
                 
                  <h6 class="mb-0">เครดิต คงเหลือ</h6><span class="text-gray-500"><h4> <?php echo $balance_agent; ?> </h4></span>
                </div>
              </div>
              <div class="icon text-white bg-indigo"><i class="fas fa-comments-dollar"></i></div>
            </div>
          </div>

              <div class="col-xl-3 col-md-6 mb-4">
            <div class="card-widget h-100">
              <div class="card-widget-body">
                <div class="dot me-3 bg-blue"></div>
                <div class="text">
                 
                  <h6 class="mb-0">สมาชิก stock</h6><span class="text-gray-500"><h4> <?php echo $user_stock; ?> </h4></span>
                </div>
              </div>
              <div class="icon text-white bg-green"><i class="fas fa-user"></i></div>
            </div>
          </div>

        </div>
      </section> -->


      <section class="mb-4 mb-lg-5">
        
          <div class="row">
            <div class="col">
              <div class="card">
                <div class="card-header">
                 <h4>กรองข้อมูลตามวันที่</h4>
               </div>
               <div class="card-body">
                <div class="input-group">
                  <input type="text" data-provide="datepicker" data-date-language="th" id="start_date" class="form-control" placeholder="จากวันที่ วว/ดด/ปปปป" aria-label="จากวันที่" name="start_date" value="<?php echo $start_date; ?>">
                  <input type="text" data-provide="datepicker" data-date-language="th" id="end_date" class="form-control" placeholder="ถึงวันที่ วว/ดด/ปปปป" aria-label="ถึงวันที่" name="end_date" value="<?php echo $end_date; ?>">
                  <button class="btn btn-primary" onclick="search()">ค้นหา</button>
                  <a class="btn btn-danger" href="main.php?page=dashboard">ล้างข้อมูล</a>
                </div>
              </div>
            </div>

          </div>
        </div>
    </section>
    <section class="mb-4 mb-lg-5">

    </section>
    <section class="mb-4 mb-lg-5">

      <h2 class="section-heading section-heading-ms mb-4 mb-lg-5"><h4></h2>

        <div class="row">

          <div class="col-lg-6 mb-4 mb-lg-0">
            <div class="card h-100">
              <div class="card-header">
                <h4>#กราฟแสดงผล กำไร - ขาดทุน</h4>
              </div>
              <div class="card-body">
                <div class="chart-holder">
                  <canvas class="w-100" id="lineChart1"></canvas>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-6 mb-4 mb-lg-0">
            <div class="card h-100">
              <div class="card-header">
                <h4>#การฟแสดงผล ฝาก</h4>
              </div>
              <div class="card-body">
                <div class="chart-holder">
                  <canvas class="w-100" id="barChart"></canvas>
                </div>
              </div>
            </div>
                <!-- <div class="h-50 pt-lg-2">
                  <div class="card h-100">
                    <div class="card-body d-flex">
                      <div class="row w-100 align-items-center">
                        <div class="col-sm-5 mb-4 mb-sm-0">
                          <h2 class="mb-0 d-flex align-items-center"><span>325</span><span class="dot bg-indigo d-inline-block ms-3"></span></h2><span class="text-muted text-uppercase small">Tasks Completed</span>
                          <hr><small class="text-muted">Tasks Completed this months</small>
                        </div>
                        <div class="col-sm-7">
                          <canvas id="pieChartHome2"></canvas>
                        </div>
                      </div>
                    </div>
                  </div>
                </div> -->
              </div>
            </div>
          </section>
        </div>
        <footer class="footer bg-white shadow align-self-end py-3 px-xl-5 w-100">
          <div class="container-fluid">
            <div class="row">
              <div class="col-md-6 text-center text-md-start text-primary">
                <p class="mb-2 mb-md-0">Your company &copy; 2021</p>
              </div>
              <div class="col-md-6 text-center text-md-end text-gray-400">
                <p class="mb-0">Version 1.0.0</p>
              </div>
            </div>
          </div>
        </footer>
      </div>
      
      <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
      <!-- <script>
        var dataChart;
        var settings = {
          "url": "include/data_chartjs_dashboard_line.php",
          "method": "POST",
          "timeout": 0,
          // "dataType":"json",
          data: {start_date: "<?php echo $start_date ?>",end_date: "<?php echo $end_date ?>"},
          "async":false,
        };

        $.ajax(settings).done(function (response) {
          console.log(response);
          dataChart = response;
        });
      </script> -->

      <script>
        var dataChartBar;
        var settingsBar = {
          "url": "include/data_chartjs_dashboard_bar.php",
          "method": "POST",
          "timeout": 0,
          // "dataType":"json",
          data: {start_date: "<?php echo $start_date ?>",end_date: "<?php echo $end_date ?>"},
          "async":false,
        };

        $.ajax(settingsBar).done(function (response) {
          // console.log(response);
          dataChartBar = response;
        });
      </script>

      <script type="text/javascript">
  function search() {
    var start_date = $("#start_date").val();
     var end_date = $("#end_date").val();
     console.log(start_date+' '+end_date)
  window.location.replace('?page=dashboard&start_date='+start_date+'&end_date='+end_date);
  }
</script>

      <script src="datepicker/js/bootstrap-datepicker.js"></script>
      <script src="datepicker/js/locales/bootstrap-datepicker.th.js"></script>
      <script src="datepicker/js/bootstrap-datepicker-thai.js"></script>
      <script id="example_script"  type="text/javascript">
        function demo() {
          $('.datepicker').datepicker();
        }
      </script>
      
      <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4"></script>
            <script type="text/javascript">
        const total_all = <?php echo json_decode($total_all); ?>;
        const TotalCTX = document.getElementById('barChart').getContext('2d');
        const TatalBarChart = new Chart(TotalCTX, {
        type: 'bar',
        data: {
            labels: ['ฝาก'],
            datasets: [{
                label: '# ฝาก',
                data: [total_all],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
});

        const profit = <?php echo json_decode($profit); ?>;
        const profitCTX = document.getElementById('lineChart1').getContext('2d');
        const profitBarChart = new Chart(profitCTX, {
        type: 'bar',
        data: {
            labels: ['กําไร-ขาดทุน'],
            datasets: [{
                label: '# กําไร-ขาดทุน',
                data: [profit],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
});

      </script>
