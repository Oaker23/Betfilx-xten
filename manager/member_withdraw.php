
<div class="page-holder bg-gray-100">
  <div class="container-fluid px-lg-4 px-xl-5">
<label>แสดง 10 ราการ ล่าสุด</label><br>

    <div align="right" class="mb-3">

    </div>
    <section>
      <div class="row">
        <div class="col">
          <div class="card mb-4">

           

           <div class="card-body">
            <div class="container" align="center">
         
 <?php
            if ($check1_withdraw<=0) {
             echo "<h5>ไม่มีรายการ</h5>";

           }
           ?>
           
              <table <?php
            if ($check1_withdraw<=0) {
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
            <?php $i=1; foreach ($res1 as $key => $value) {?>
              <tr>

                <td><?=$value ['date_withdraw']; ?> <?=$value ['time_withdraw']; ?></td>
                <td><?=number_format($value['credit'],2); ?></td>
<td><?=$value ['description']; ?></td>
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
