<?php

include("../config/config.php");

if($_SESSION["username"] == "") {

  echo " <script> window.open('./login');</script>";

  exit();
}


$sql = 'SELECT * FROM  `admin` ORDER by id asc';
$result = $server->query($sql);
$res=array();
foreach ($result as $row) {

  $category_master=explode(",",$row['category']);
  $row['category_spite'] = $category_master;
  array_push($res,$row);

}

function status($data){
  if ($data==1) {
    return "แอดมินสูงสุด";
  }
  if ($data==0) {
    return "แอดมินรอง";
  }
}

function category($data){
  if ($data==1) {
    return 'รายงานผลรวม';
  }
  if ($data==2) {
    return 'จัดการผู้ดูแล';
  }
  if ($data==3) {
    return 'จัดการสมาชิก';
  }
  if ($data==4) {
    return 'จัดการโบนัส';
  }
  if ($data==5) {
    return 'จัดการข้อมูลเว็บ';
  }
  if ($data==6) {
    return 'จัดการ line';
  }
  if ($data==7) {
    return 'จัดการธนาคาร';
  }
  if ($data==8) {
    return 'รายการฝากเงิน';
  }
  if ($data==9) {
    return 'รายการถอนเงิน';
  }
  if ($data==10) {
    return 'ยอดฝากไม่สำเร็จ';
  }
  if ($data==11) {
    return 'ลูกค้าแจ้งถอนเงิน';
  }
  if ($data==12) {
    return 'สร้างโค้ดแจกเครดิต';
  }
  if ($data==13) {
    return 'ไฟล์สำหรับ cronjob';
  }
  if ($data==14) {
    return 'ป๊อปอัพ popup';
  }
  if ($data==18) {
    return 'จัดการ slider';
  }

}


?>




<div class="page-holder bg-gray-100">
  <div class="container-fluid px-lg-4 px-xl-5">

    <section>
      <div class="row">
        <div class="col">
          <div class="card mb-4">
            <div class="card-header">
              <h4 >จัดการ ผู้ดูแล</h4>
              <div align="right" class="mb-3">
                <button class="btn btn-primary text-uppercase" data-bs-toggle="modal" data-bs-target="#add_admin"><i class="fas fa-plus"></i> เพิ่ม ผู้ดูแล</button>
              </div>
            </div>
            <div class="card-body">
							<div class="table-responsive">
              <table class="table">
                <thead>

                  <tr>
                    <th>ลำดับ</th>
                    <th>ชื่อผู้ใช้</th>
                    <th>ชื่อ</th>
                    <th width="30%">หมวดหมู่ เข้าถึง</th>
                    <th>สถานะ</th>
                    <th>จัดการ</th>
                  </tr>
                </tr>
              </thead>
              <tbody>
                <?php $i=1; foreach ($res as $key => $value){?>
                  <tr>
                    <th scope="row"><?=$i ?></th>
                    <td><?=$value ['username'] ?></td>
                    <td><?=$value ['fname'] ?></td>
                    <td>
                      <?php $test=$value['category_spite'] ;
                      for ($i = 0; $i < count($test); $i++) {
                        echo "<span class='badge bg-secondary'>".category($test[$i])."</span>"."    ";
                      }

                      ?>
                      
                    </td> 
                    <td><?=status($value['status']) ?></td>
                    <td>
                      <button onclick="editadmin(<?=$value ['id'] ?>)" class="btn btn-primary "><i class="fas fa-edit" aria-hidden="true"></i></button>
                      <button onclick="delete_admin(<?=$value ['id'] ?>)" class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></button>
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
      <button type="button" class="btn btn-primary" onclick="update_admin()"><i class="fas fa-plus"></i> บันทึก</button>
      <button type="button" class="btn btn-danger" data-bs-dismiss="modal">ปืด</button>

    </div>
  </div>
</div>
</div>




<!-- Modal -->
<div class="modal fade" id="add_admin" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true" style="margin-top: 200px;">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel"><i class="fas fa-plus"></i> เพิ่ม ผุ้ดูแล</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <label>ชื่อผู้ใช้</label>
        <input class="form-control" type="text" id="username" placeholder="ชือผู้ใช้" aria-label="default input example">
        <label class="mt-2">รหัสผ่าน</label>
        <input class="form-control mt-2" type="text" id="password" placeholder="รหัสผ่าน" aria-label="default input example">
        <label class="mt-2">ชื่อ</label>
        <input class="form-control mt-2" type="text" id="fname" placeholder="ชื่อ" aria-label="default input example">
  <label class="mt-2">หมวดหมู่</label>
        <div class="row mt-2">
          <div class="col-md-12">


              <!-- <select class="form-select mb-3 is-invalid" multiple required data-placeholder="เลือกหมวดหมู่" data-allow-clear="1" id="langOptgroup">
                <option value="1">รายงานผลรวม</option>
                <option value="2">จัดการ ผู้ดูแล</option>
                <option value="3">จัดการ สมาชิก</option>
                <option value="4">จัดการ โปรโมชั่น</option>
                <option value="5">จัดการ ข้อมูลเว็บ</option>
                <option value="6">จัดการ line Alert</option>
                <option value="7">จัดการ ธนาคาร</option>
                <option value="8">รายการ ฝากเงิน</option>
                <option value="9">รายการ ถอนเงิน</option>
                <option value="10">ยอดฝาก ไม่สำเร็จ</option>
                <option value="11">ลูกค้าแจ้ง ถอนเงิน</option>
                <option value="12">สร้างโค้ด แจกเครดิต</option>
                <option value="13">สมาชิก หมุนวงล้อ</option>
                <option value="14">cronjob</option>
                <option value="18">จัดการ slider</option>
                <option value="19">ประวัติแอดมิน</option>
              </select> -->

              <select name="basic" id="category_List_add" multiple>
                <option value="1">รายงานผลรวม</option>
                <option value="2">จัดการ ผู้ดูแล</option>
                <option value="3">จัดการ สมาชิก</option>
                <option value="4">จัดการ โปรโมชั่น</option>
                <option value="5">จัดการ ข้อมูลเว็บ</option>
                <option value="6">จัดการ line Alert</option>
                <option value="7">จัดการ ธนาคาร</option>
                <option value="8">รายการ ฝากเงิน</option>
                <option value="9">รายการ ถอนเงิน</option>
                <option value="10">ยอดฝาก ไม่สำเร็จ</option>
                <option value="11">ลูกค้าแจ้ง ถอนเงิน</option>
                <option value="12">สร้างโค้ด แจกเครดิต</option>
                <option value="13">สมาชิก หมุนวงล้อ</option>
                <option value="14">cronjob</option>
                <option value="18">จัดการ slider</option>
                <option value="19">ประวัติแอดมิน</option>
              </select>

              <!-- </div> -->


            </div>


          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" onclick="add_admin()"><i class="fas fa-plus"></i> เพิ่ม</button>
          <button type="button" class="btn btn-danger" data-bs-dismiss="modal">ปืด</button>

        </div>
      </div>
    </div>
  </div>

  <script type="text/javascript">

    function add_admin() {
     var username=$("#username").val();
     var password=$("#password").val();
     var fname=$("#fname").val();

     var catogory = $('#category_List_add').val();


     if (username=="") {
      Swal.fire({
        icon: 'error',
        title: 'แจ้งเตือน...',
        text:'กรุณากรอก ชื่อผู้ใช้'

      })
      return false
    } 

    if (password=="") {
      Swal.fire({
        icon: 'error',
        title: 'แจ้งเตือน...',
        text:'กรุณากรอก รหัสผ่าน'

      })
      return false
    } 

    if (fname=="") {
      Swal.fire({
        icon: 'error',
        title: 'แจ้งเตือน...',
        text:'กรุณากรอก ชื่อ'

      })
      return false
    } 

    if (catogory=="") {
      Swal.fire({
        icon: 'error',
        title: 'แจ้งเตือน...',
        text:'กรุณาเลือหมวดหมู่'

      })
      return false
    } 

    if (category_List_add=="") {
      Swal.fire({
        icon: 'error',
        title: 'แจ้งเตือน...',
        text:'กรุณาเลือกทำงาน'

      })
      return false
    } 


    $.ajax({
      url:'action.php?add_admin',
      type:'POST',
      data:{
        password:password,
        username:username,
        fname:fname,
        catogory:catogory
      }, 
      timeout: 30000,
      error: function(){
        $('body').loadingModal('hide');
        $('body').loadingModal('destroy') ;
        Swal.fire({
          icon: 'error',
          title: 'แจ้งเตือน...',
          text: 'มีบางอย่างผิดพลาด กรุณาลองใหม่อีกครั้ง'

        })
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
                window.location.reload();
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


  function delete_admin(id){

    Swal.fire({
      title: 'คุณแน่ใจไหม?',
      text: "คุณจะไม่สามารถยกเลิกสิ่งนี้ได้!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'ยืนยัน ลบ'
    }).then((result) => {
      if (result.value) {

        $.ajax({
          url:'action.php?delete_admin',
          type:'POST',
          data:{
            id:id
          }, 
          timeout: 30000,
          error: function(){
            Swal.fire({
              icon: 'error',
              title: 'แจ้งเตือน...',
              text: 'มีบางอย่างผิดพลาด กรุณาลองใหม่อีกครั้ง'

            })
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
                    window.location.reload();
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
    })



  }


  function editadmin(id){
    var id = id;
    $('#head_editadmin').html('ข้อมูล ผู้ดูแล'); 
    $.ajax({
      url:'edit_admin.php',
      type:'POST',
      data:{
        id:id
      }, 
      timeout: 30000,
      error: function(){

        Swal.fire({
          icon: 'error',
          title: 'แจ้งเตือน...',
          text: 'มีบางอย่างผิดพลาด กรุณาลองใหม่อีกครั้ง'

        })
      },
      success:function(data){ 
        $('#editadmin_detail').html(data);  
        $('#editadmin_modal').modal('show');
        $('#category_List').picker();
      }

    });


  }

  function update_admin (id){
    var id=$("#e_id").val();
    
    var username=$("#e_username").val();
    var password=$("#e_password").val();
    
    var fname=$("#e_fname").val();
    var category_List=$("#category_List").val();
    
    // var e = document.getElementById("select_status");
    //     var status = e.options[e.selectedIndex].value; //ธนาคาร



        $.ajax({
          url:'action.php?update_admin',
          type:'POST',
          data:{
            id:id,
            username:username,
            password:password,

            category_List:category_List,
            fname:fname
          }, 
          timeout: 30000,
          error: function(){

            Swal.fire({
              icon: 'error',
              title: 'แจ้งเตือน...',
              text: 'มีบางอย่างผิดพลาด กรุณาลองใหม่อีกครั้ง'

            })
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
                    window.location.reload();
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

    </script>

    <!-- jQuery -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.min.js"></script>

    <!-- Select2 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />

    <!-- Bootstrap -->
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" /> -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script> -->


    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <!-- select2-bootstrap-5-theme -->
    <link href="https://apalfrey.github.io/select2-bootstrap-5-theme/select2-bootstrap-5-theme.css" rel="stylesheet"> <!-- for local development env -->

    <!-- Bootstrap -->
    <!-- Select2 -->

    <!-- select2-bootstrap-5-theme -->
    <script src="https://apalfrey.github.io/select2-bootstrap-5-theme/script.js"></script>

    <script type="text/javascript">

      // const langOptgroup = $("#langOptgroup")
      // langOptgroup.select2({
      //   theme: "bootstrap-5",
      // });

      $( document ).ready(function() {
        $('#category_List_add').picker();
      });


    </script>

    <style type="text/css">
    .select2-container{
      z-index:100000;
    }
    .select2-drop {z-index: 99999;}
  </style>