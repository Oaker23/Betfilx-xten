<?php

include '../config/config.php';

if($_SESSION["username"] == "") {
  echo " <script> window.open('./login');</script>";
  exit();
}


if(isset($_POST['submit'])){
  $countfiles = count($_FILES['file']['name']);
  for($i=0;$i<$countfiles;$i++){
    $filename = $_FILES['file']['name'];
    $extension = pathinfo($filename[$i] , PATHINFO_EXTENSION);
    move_uploaded_file($_FILES['file']['tmp_name'][$i],'upload/logo.'.$extension);
  }
} 

$sql = "SELECT * FROM `slider` WHERE is_delete = false ORDER BY sort asc";
$result = $server->query($sql);
$arr = array();
while($row = mysqli_fetch_assoc($result)) {
    $arr[] = $row;
}

$menu_name = "สไลด์";
?>

<div class="page-holder bg-gray-100">
  <div class="container-fluid px-lg-4 px-xl-5">
    <section>
      <div class="row">
        <div class="col">
          <div class="card mb-4">
            <div class="card-header">
              <h4>ข้อมูล <?php echo $menu_name?></h4>
              <div align="right" style="margin-top: -39px;">
                <button class="btn btn-warning text-uppercase" data-bs-toggle="modal" data-bs-target="#add_data"><i class="far fa-edit"></i>เพิ่ม</button>&nbsp;
              </div>
            </div>
            <style>
              @media only screen and (max-width: 768px) {
                .fa-arrows-alt-v{
              		display:none;
              	}
                .div-display{
                  margin-top: 0px !important;
              	}
              	.div-button{
              		padding-top: 0px !important;
                  text-align: center;
              	}
              }
            </style>
            <div class="card-body">
              <div id="simple-list" class="row">
		          	<div id="drag-div" class="list-group col">
                <?php $i=1; foreach ($arr as $key => $value){?>
		          		  <div class="list-group-item">
                      <div class="col-12">
                        <input type="hidden" class="hidden" name="id" value="<?php echo $value['id']; ?>">
                        <div class="row">
                          <div class="col-lg-8 col-md-12 " style="text-align: center;">
                            <i class="fas fa-arrows-alt-v" style="font-size: 30px;float: left;margin-top: 82px;"></i>
                            <img style="width: 100%;max-width: 280px;" src="<?php echo $value['path']; ?>">
                          </div>
                          <div class="col-lg-2 col-md-12 div-display" style="text-align: center;margin-top: 72px;">
                            <?php if($value['is_hide']=="0"){ ?>
                              การแสดงผล: <lable style="color:green;">แสดงผล</lable>
                            <?php }else{ ?>
                              การแสดงผล: <lable style="color:red;">ไม่แสดงผล</lable>
                            <?php } ?>
                          </div>
                          <div class="col-lg-2 col-md-12 div-button" style="padding-top: 70px;">
                            <button class="btn btn-warning text-uppercase" onclick="get_data(<?php echo $value['id']; ?>)"><i class="far fa-edit"></i>แก้ไข</button>
                            <button class="btn btn-danger text-uppercase" onclick="delete_data(<?php echo $value['id']; ?>)"><i class="fas fa-trash"></i>ลบ</button>
                          </div>
                        </div>
                      </div>
                    </div>
                  <?php $i++; } ?>
		          	</div>
		          </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
</div>


<!-- The Modal ADD -->
<div class="modal fade" id="add_data" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true" style="margin-top: 200px;">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel"><i class="fas fa-plus"></i> เพิ่ม <?php echo $menu_name?></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row">
          <img id="add_show" src="">
        </div>
        <div class="row">
          <div class="form-group mt-2">
            <label class="float-left">เลือกรูป</label>
            <input type="file" name="file" id="image">
            <div class="alert alert-danger text-center mt-3" role="alert"> นามสกุลไฟล์รองรับ jpg</div>
            <label class="mt-2">เลือกการแสดงผลรูป</label>
            <select id="select_display" class="form-control">
              <option value='0' selected>แสดง</option>
              <option value='1'>ไม่แสดง</option>
            </select>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" onclick="add_data()"><i class="fas fa-plus"></i> บันทึก</button>
          <button type="button" class="btn btn-danger" data-bs-dismiss="modal">ปิด</button>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- The Modal Edit -->
<div class="modal fade" id="edit_data" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true" style="margin-top: 200px;">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel"><i class="fas fa-plus"></i> แก้ไข <?php echo $menu_name?></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row">
          <img id="edit_show" src="">
        </div>
        <div class="row">
          <div class="form-group mt-2">
            <label class="float-left">เลือกรูป</label>
            <input type="file" name="file" id="image2">
            <div class="alert alert-danger text-center mt-3" role="alert"> นามสกุลไฟล์รองรับ jpg</div>
            <label class="mt-2">เลือกการแสดงผลรูป</label>
            <select id="select_display2" class="form-control">
            <option value='0'>แสดง</option>
            <option value='1'>ไม่แสดง</option>
          </select>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" onclick="edit_data()"><i class="fas fa-plus"></i> บันทึก</button>
          <button type="button" class="btn btn-danger" data-bs-dismiss="modal">ปิด</button>
        </div>
      </div>
    </div>
  </div>
</div>


<script type="text/javascript">

var onload_id = [];
var onchange_id = [];
window.onload = function() {
  $('#drag-div').sortable({
      animation: 150,
      ghostClass: 'blue-background-class',
  });

  
  $('.list-group-item .hidden').each(function(index,data) {
    onload_id.push($(data).val());
  });

  const interval = setInterval(function() {
    var check_on_drag = $('.sortable-chosen').length;
    if(!check_on_drag){
      onchange_id = [];
      $('.list-group-item .hidden').each(function(index,data) {
        onchange_id.push($(data).val());
      });
      // console.log("onchange_id=",onchange_id);
      if(onload_id.toString() != onchange_id.toString()){
        // console.log("change=====");
        sort_data(onchange_id.toString());
        onload_id = onchange_id;
      }
    }
 }, 500);
  
}

function sort_data(onchange_id) {
  // console.log("sort_data=",onchange_id);
  var form_data = new FormData();                  
  form_data.append('onchange_id', onchange_id);
  $.ajax({
    url:'action.php?sort_slider',
    type:'POST',
    contentType: false,
		processData: false,
    data:form_data, 
    timeout: 30000,
    error: function(){
      Swal.fire({
        icon: 'error',
        title: 'แจ้งเตือน...',
        text: 'มีบางอย่างผิดพลาด กรุณาลองใหม่อีกครั้ง'
      })
    },
    success:function(data){ 
      // console.log("data=",data);
      if (data!="") {
        var obj = JSON.parse(data);
        // console.log("obj=",obj);
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
              // window.location.reload();
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

var edit_data_id;
function get_data(id) {
  edit_data_id = id;
  // console.log("get_data=",id);
  var form_data = new FormData();                  
  form_data.append('id', id);
  $.ajax({
    url:'action.php?get_slider',
    type:'POST',
    contentType: false,
		processData: false,
    data:form_data, 
    timeout: 30000,
    error: function(){
      Swal.fire({
        icon: 'error',
        title: 'แจ้งเตือน...',
        text: 'มีบางอย่างผิดพลาด กรุณาลองใหม่อีกครั้ง'
      })
    },
    success:function(data){ 
      // console.log("data=",data);
      if (data!="") {
        var obj = JSON.parse(data);
        // console.log("obj=",obj);
        var msg=obj.msg
        var status=obj.status
        if (status==200) {
          $('#edit_show').attr('src',obj.msg.path);
          $('#select_display2').val(obj.msg.is_hide);
          $('#edit_data').modal('show');
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

function delete_data(id) {
  // console.log("delete_data=",id);
  var form_data = new FormData();                  
  form_data.append('id', id);
  Swal.fire({
  title: 'ยืนยันการลบข้อมูล?',
  icon: 'warning',
  showDenyButton: true,
  showCancelButton: true,
  confirmButtonText: 'ตกลง',
  cancelButtonText: "ยกเลิก",
  }).then((result) => {
    if (result.isConfirmed) {
      $.ajax({
          url:'action.php?del_slider',
          type:'POST',
          contentType: false,
  	    	processData: false,
          data:form_data, 
          timeout: 30000,
          error: function(){
            Swal.fire({
              icon: 'error',
              title: 'แจ้งเตือน...',
              text: 'มีบางอย่างผิดพลาด กรุณาลองใหม่อีกครั้ง'
            })
          },
          success:function(data){ 
              // console.log("data=",data);
            if (data!="") {
              var obj = JSON.parse(data);
              // console.log("obj=",obj);
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
  });
}

 function add_data() {
  var file_data = $("#image").prop('files')[0];
  var select_display = $("#select_display").val();
  
  var form_data = new FormData();                  
  form_data.append('file_data', file_data);
  form_data.append('select_display', select_display);
  
  $.ajax({
    url:'action.php?add_slider',
    type:'POST',
    contentType: false,
		processData: false,
    data:form_data, 
    timeout: 30000,
    error: function(){
      Swal.fire({
        icon: 'error',
        title: 'แจ้งเตือน...',
        text: 'มีบางอย่างผิดพลาด กรุณาลองใหม่อีกครั้ง'
      })
    },
    success:function(data){ 
      // console.log(data);
      if (data!="") {
        var obj = JSON.parse(data);
        // console.log("obj=",obj);
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

function edit_data() {
  // console.log("edit_data=",edit_data_id);
  var file_data = $("#image2").prop('files')[0];
  var select_display = $("#select_display2").val();
  var form_data = new FormData();                  
  form_data.append('id', edit_data_id);
  form_data.append('file_data', file_data);
  form_data.append('select_display', select_display);
  $.ajax({
    url:'action.php?edit_slider',
    type:'POST',
    contentType: false,
		processData: false,
    data:form_data, 
    timeout: 30000,
    error: function(){
      Swal.fire({
        icon: 'error',
        title: 'แจ้งเตือน...',
        text: 'มีบางอย่างผิดพลาด กรุณาลองใหม่อีกครั้ง'
      })
    },
    success:function(data){ 
      // console.log(data);
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
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.9/js/responsive.bootstrap4.min.js"></script>

<script src="https://unpkg.com/sortablejs-make/Sortable.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-sortablejs@latest/jquery-sortable.js"></script>
  