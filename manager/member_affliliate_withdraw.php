
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
             if ($check_aff<=0) {
               echo "<h5>ไม่มีรายการ</h5>";

             }
             ?>
             <table <?php
             if ($check_aff<=0) {
               echo "style='display: none'";

             }
           ?> width="100%" class="table table-striped" id="tableDeposit">
           <thead>
            <tr>

              <th>เวลา</th>
              <th>ยอดเงิน</th>

            </tr>
          </thead>
          <tbody>
            <?php $i=1; foreach ($res_aff as $key => $value) {?>
              <tr>

                <td><?=$value ['date_check']; ?></td>
                <td><?=number_format($value['credit'],2); ?></td>

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
