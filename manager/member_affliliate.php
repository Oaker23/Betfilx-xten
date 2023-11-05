
    

<div class="page-holder bg-gray-100">
  <div class="container-fluid px-lg-4 px-xl-5">


    <div align="right" class="mb-3">

    </div>
    <section>


  
        <div class="row">
    
      
     
     <div class="col-xl-3 col-md-6 mb-4">
            <div class="card-widget h-100">
              <div class="card-widget-body">
                <div class="dot me-3 bg-green"></div>
                <div class="text">
                 
                  <h6 class="mb-0">ยอดฝากทั้งเดือน</h6><span class="text-gray-500"><h4> <?php echo number_format($deposit_all,2); ?> บาท</h4></span>
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
                 
                  <h6 class="mb-0">ยอดถอนทั้งเดือน</h6><span class="text-gray-500"><h4> <?php echo number_format($wd_all,2); ?> บาท</h4></span>
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
                 
                  <h6 class="mb-0">แนะนำทั้งหมด</h6><span class="text-gray-500"><h4> <?php echo $ref_total; ?> </h4></span>
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
                 
                  <h6 class="mb-0">เปอร์เซ้นที่ได้รับ</h6><span class="text-gray-500"><h4> <?php echo $percen; ?> </h4></span>
                </div>
              </div>
              <div class="icon text-white bg-green"><i class="fas fa-user"></i></div>
            </div>
          </div>

              <!-- <div class="col-xl-3 col-md-6 mb-4">
            <div class="card-widget h-100">
              <div class="card-widget-body">
                <div class="dot me-3 bg-blue"></div>
                <div class="text">
                 
                  <h6 class="mb-0">รายได้ จากการแนะนำ  </h6><span class="text-gray-500"><h4> <?php echo number_format($profit,2); ?> </h4></span>
                </div>
              </div>
              <div class="icon text-white bg-green"><i class="fas fa-dollar-sign"></i></div>
            </div>
          </div> -->

 <div class="alert alert-danger mt-2" role="alert"><i class="fas fa-bomb"></i> ยอดฝาก ลบ ยอดถอน หากยอดเงินติดลบ จะขึ้นเป็น0บาท
              </div>

        </div>

      <div class="row">
        <div class="col">
          <div class="card mb-4">



           <div class="card-body">



            <h5  style="color:black" class="card-header">สมาชิกที่แนะนำ ทั้งหมด <?php


            if ($ref_total==0) {
              echo "0";
            }else{
              echo $ref_total;
            }
          ?> คน</h5>
          <div class="card-body">
          
            <table class="table table-striped" id="tableRefund" <?php

            if ($ref_total==0) {
              echo "style='display: none;'";
            }
          ?>>
          
          <thead  style="color:black;"> 
            <tr>
              <th>ลำดับ</th>
              <th>วันที่สมัคร</th>
              <th>ชื่อผู้ใช้</th>
              <th>ฝากวันนี้</th>
              <th>ถอนวันนี้</th>
            </tr>
          </thead>
          <tbody>
            <?php $i=1; foreach ($res_user as $key => $value) {?>
              <tr>
                <td><?=$i ?></td>
                <td><?=$value['date_check']; ?></td>

                <td><?php echo $agent_username; ?><?=$value ['username_game']; ?></td>
                <td>
                  <?php
                  date_default_timezone_set('Asia/Bangkok');
                  $date_now=date("Y-m-d");
                  $sql_total_refill="SELECT SUM(amount) as total_refill
                  FROM refill WHERE `username_game`='" . $value ['username_game']. "' and `date_check`='" . $date_now. "'";
                  $result_total_refill = $server->query($sql_total_refill);
                  $row_total_refill = mysqli_fetch_assoc($result_total_refill);
                  echo number_format($row_total_refill['total_refill'],2);

                  ?>
                </td>
                    <td>
                  <?php
                  date_default_timezone_set('Asia/Bangkok');
                  $date_now=date("Y-m-d");
                  $sql_total_refill="SELECT SUM(credit) as total_refill
                  FROM withdraw WHERE `username_game`='" . $value ['username_game']. "' and `date_withdraw`='" . $date_now. "'";
                  $result_total_refill = $server->query($sql_total_refill);
                  $row_total_refill = mysqli_fetch_assoc($result_total_refill);
                  echo number_format($row_total_refill['total_refill'],2);

                  ?>
                </td>
              </tr>
              <?php $i++; }  ?>
            </tbody>
          </table>

        </div>

      </div>
    </div>
  </div>
</div>
</section>
</div>
</div>
