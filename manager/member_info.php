
<div class="page-holder bg-gray-100">
  <div class="container-fluid px-lg-4 px-xl-5">


    <div align="right" class="mb-3">

    </div>
    <section>
      <div class="row">
        <div class="col">
          <div class="card mb-4">


            <div class="card-body">
              <div class="container">


                <table class="table table-striped">

                  <tbody>
                    <tr>
                      <td>เบอร์มือถือ</td>
                      <td><?php echo $phone; ?></td>

                    </tr>
                    <tr>
                      <td>เวลา/วันที่สมัคร</td>
                      <td><?php echo $row['time_check'].'  '.$row['date_check']; ?></td>

                    </tr>
                    <tr>
                      <td>ชื่อผู้ใช้ในเกมส์</td>
                      <td>ชื่อผู้ใช้: <?php echo $agent_username.$row['username_game']; ?> รหัสผ่าน: <?php echo $row['password_game']; ?></td>

                    </tr>

                    <tr>
                      <td>ชื่อ-นามสกุล</td>
                      <td><?php echo $row['fname']; ?></td>

                    </tr>

                    <tr>
                      <td>เลชบัญชี</td>
                      <td><?php echo $row['bank_number']; ?></td>

                    </tr>
                    <tr>
                      <td>ธนาคาร</td>
                      <td><?php echo $row['bank_name']; ?></td>

                    </tr>
                    <tr>
                      <td>เครดิตคงเหลือ</td>
                      <td><?php echo number_format($amount,2); ?></td>

                    </tr>

                      <tr>
                      <td>ยอดเล่นวันนี้</td>
                      <td><?php echo $refund; ?></td>

                    </tr>
                    <tr>
                      <td>สถานะ โบนัส</td>
                      <td><?php 

                      if ($status_bonus==1) {
                         echo 'รับโบนัส';
                       
                      }else{
                        echo 'ไม่รับโบนัส';
                      }

                      ; ?></td>

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

<!-- Modal -->
<div class="modal fade" id="editadmin_modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true" style="margin-top: 200px;">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
       <i class="fas fa-edit"></i>&nbsp; <h5 class="modal-title" id="head_editadmin"></h5>
       <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
     </div>
     <div class="modal-body" id="editadmin_detail">

     </div>
     <div class="modal-footer">
      <button type="button" class="btn btn-primary" onclick="update_member()" ><i class="fas fa-plus"></i> บันทึก</button>
      <button type="button" class="btn btn-danger" data-bs-dismiss="modal">ปืด</button>

    </div>
  </div>
</div>
</div>


<!-- The Modal -->
<div class="modal fade" id="add_member" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true" style="margin-top: 200px;">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel"><i class="fas fa-plus"></i> เพิ่ม สมาชิก</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">



        <div class="form-group">
          <label class="float-left">เลขบัญชีธนาคาร</label>
          <input type="text" class="form-control form-control-lg" id="bank_number" aria-describedby="เลขบัญชีธนาคาร" placeholder="เลขบัญชีธนาคาร">
        </div>

        <div class="form-group">
          <select id="select" class="form-control form-control-lg">
            <option selected>เลือก ธนาคาร</option>
            <option value="ไทยพาณิชย์">ไทยพาณิชย์</option>
            <option value="กรุงเทพ">กรุงเทพ</option>
            <option value="กสิกรไทย">กสิกรไทย</option>
            <option value="กรุงไทย">กรุงไทย</option>
            <option value="ทหารไทย">ทหารไทย</option>
            <option value="กรุงศรีฯ">กรุงศรีฯ</option>
            <option value="ออมสิน">ออมสิน</option>
            <option value="ธนชาติ">ธนชาติ</option>
            <option value="ธกส">ธกส</option>
            <!-- <option value="ทรูวอเลต">ทรูวอเลต</option> -->
          </select>
        </div>

        <div class="form-group">
          <label class="float-left">ชื่อ-นามสกุล</label>
          <input type="text" class="form-control form-control-lg" id="fname" aria-describedby="ชื่อ-นามสกุลชื่อ" placeholder="ชื่อ-นามสกุลชื่อ">
        </div>

        <div class="form-group">
          <label class="float-left">เบอร์มือถือ</label>
          <input type="text" class="form-control form-control-lg" id="phone_user" aria-describedby="phone_user" placeholder="เบอร์มือถือ">
        </div>

        <div class="form-group">
          <label class="float-left">ตั้งรหัสผ่านเอง</label>
          <input type="text" class="form-control form-control-lg" id="password" aria-describedby="password" placeholder="ตั้งรหัสผ่านเอง">
        </div>


        <div class="modal-footer">
          <button type="button" class="btn btn-primary" onclick="add_member()"><i class="fas fa-plus"></i> เพิ่ม</button>
          <button type="button" class="btn btn-danger" data-bs-dismiss="modal">ปืด</button>

        </div>
      </div>
    </div>
  </div>
</div>
<!-- The Modal -->
<div class="modal fade" id="add_credit" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true" style="margin-top: 200px;">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel"><i class="fas fa-plus"></i> เพิ่ม เครดิต</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" id="addcredit_detail">


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" onclick="update_credit_user()"><i class="fas fa-plus"></i> เพิ่ม</button>
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">ปืด</button>

      </div>
    </div>
  </div>
</div>


