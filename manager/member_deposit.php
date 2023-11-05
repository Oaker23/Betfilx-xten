
<div class="page-holder bg-gray-100">
  <div class="container-fluid px-lg-4 px-xl-5">

<label>แสดง 10 รายการ ล่าสุด</label><br>
<br>
    <div align="right" class="mb-3">

    </div>
    <section>
      <div class="row">
        <div class="col">
          <div class="card mb-4">



           <div class="card-body">
            <div class="container" align="center">

             <?php
             if ($check_deposit<=0) {
               echo "<h5>ไม่มีรายการ</h5>";

             }
             ?>

             <table <?php
             if ($check_deposit<=0) {
               echo "style='display: none'";

             }
           ?> width="100%" class="table table-striped" id="tableDeposit">
           <thead>
            <tr>

              <th>เวลา</th>
              <th>ยอดเงิน</th>
              <th>รายละเอียด</th>
            </tr>
          </thead>
          <tbody>
          <?php 
          $check_show_sum_date = false;
          $index_show_sum_date = 0;
          $check_date = $res_bydate[$index_show_sum_date]['date_check']; 
          ?>
            <?php $i=1; foreach ($res as $key => $value) {?>
              <?php 
              if($check_date == $value['date_check']){
                $check_show_sum_date = false;
              }else{
                $check_date = $value['date_check'];
                $check_show_sum_date = true;
              }
              ?>
         <?php if($check_show_sum_date){ ?>
              <tr>
              <td style="text-align: right;">ยอดรวม</td>
              <td><?php echo $res_bydate[$index_show_sum_date]['amount'];$index_show_sum_date++ ?></td>
              <td></td>
             </tr>
         <?php } ?>
              <tr>
                <td ><?=$value ['date_check']; ?> <?=$value ['time_check']; ?></td>
                <td><?=number_format($value['amount'],2); ?></td>
                <td><?php if ($value['status_bonus']==1) {
                 echo "<strong><span style='color: red'>รับโบนัส</span></strong>";
               }else{
                 echo 'ไม่รับโบนัส';
               }
             ?></td>
           </tr>
           <?php $i++; }  ?>
             <tr>
              <td style="text-align: right;">ยอดรวม</td>
              <td><?php echo $res_bydate[$index_show_sum_date]['amount'];$index_show_sum_date++ ?></td>
              <td></td>
             </tr>
           <tr>
            <td colspan="4" style="text-align: center;font-size: 26px;">รวมทั้งหมด <?php echo $res_all_amount ?></td>
           </tr>
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
