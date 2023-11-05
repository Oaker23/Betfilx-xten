<?php
if($_SESSION["username"] == "") {

  echo " <script> alert('ควย');</script>";
  exit();
}

include '../config/config.php';

$sql = 'SELECT * FROM  `promotion` ORDER by p_id  asc';
$result = $server->query($sql);
$res=array();
foreach ($result as $row) {

  array_push($res,$row);

}


?>
<?php include("include/function.php"); ?>


<div class="page-holder bg-gray-100">
  <div class="container-fluid px-lg-4 px-xl-5">
      <section class="mb-3 mb-lg-5">
        <div class="row">
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card-widget h-100">
                <div class="card-widget-body">
                  <div class="dot me-3 bg-indigo"></div>
                  <div class="text">
                    <h6 class="mb-0">ยอดถอน ทั้งหมด</h6><span class="text-gray-500"><h4><?php affliliateList(); ?> บาท</h4></span>
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
                    <h6 class="mb-0">ยอดถอน เดือนนี้</h6><span class="text-gray-500"><h4><?php affliliateOfMonthList(); ?> บาท</h4></span>
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
                    <h6 class="mb-0">ยอดถอน อาทิตย์นี้</h6><span class="text-gray-500"><h4><?php affliliateOfWeekList(); ?> บาท</h4></span>
                  </div>
                </div>
                <div class="icon text-white bg-blue"><i class="fa fa-dolly-flatbed"></i></div>
              </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card-widget h-100">
                <div class="card-widget-body">
                  <div class="dot me-3 bg-red"></div>
                  <div class="text">
                    <h6 class="mb-0">ยอดถอน วันนี้</h6><span class="text-gray-500"><h4><?php affliliateOfDayList() ?> บาท</h4></span>
                  </div>
                </div>
                <div class="icon text-white bg-red"><i class="fas fa-receipt"></i></div>
              </div>
            </div>
          </div>
        </section>
    <section>
      <div class="row">
        <div class="col">
          <div class="card mb-4">
            <div class="card-header">
              <h4>ถอนเงิน  แนะนำเพื่อน</h4>
            </div>
            <div class="card-body">
              <table id="tableRefund" class="table table-striped dt-responsive" style="width:100%">
                  <thead>
                    <tr>
                      <th>ลำดับ.</th>
                      <!-- <th>id</th> -->
                       <th>ชื่อในเกมส์.</th>
                      <th>วัน</th>
                      <th>เวลา</th>
                      <th>เครดิต</th>
                      <th>เบอร์</th>

                  </tr>
                </thead>
              </table>
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
       <i class="fas fa-user-edit"></i>&nbsp; <h5 class="modal-title" id="head_editadmin"></h5>
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
<div class="modal fade" id="add_bonus" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true" style="margin-top: 200px;">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel"><i class="fas fa-user-plus"></i> เพิ่ม โปรโมชั่น</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <input class="form-control" type="text" id="username" placeholder="ชือผู้ใช้" aria-label="default input example">
        <input class="form-control mt-2" type="text" id="password" placeholder="รหัสผ่าน" aria-label="default input example">
        <input class="form-control mt-2" type="text" id="fname" placeholder="ชื่อ" aria-label="default input example">
        <input class="form-control mt-2" type="text" id="phone" placeholder="เบอร์มือถือ" aria-label="default input example">
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
   var phone=$("#phone").val();


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
  if (phone=="") {
    Swal.fire({
      icon: 'error',
      title: 'แจ้งเตือน...',
      text:'กรุณากรอก เบอร์มือถือ'

    })
    return false
  } 

  $.ajax({
    url:'action.php?add_admin',
    type:'POST',
    data:{
      phone:phone,
      password:password,
      username:username,
      fname:fname
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

    }

  });


}

function update_admin (id){
  var id=$("#e_id").val();
  var username=$("#e_username").val();
  var password=$("#e_password").val();
  var phone=$("#e_phone").val();
  var fname=$("#e_fname").val();


  $.ajax({
    url:'action.php?update_admin',
    type:'POST',
    data:{
      id:id,
      username:username,
      password:password,
      phone:phone,
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
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.9/js/responsive.bootstrap4.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap4.min.css">


<script>
  $.extend(true, $.fn.dataTable.defaults, {
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
  // $(document).ready(function() {
  //     $('#tableMember').DataTable();
  // } );
  // $(document).ready(function() {
  //     $('#tableMember').DataTable( {
  //         "processing": true,
  //         "serverSide": true,
  //         "ajax": "server.php"
  //     } );
  // } );

  $(document).ready(function(){
   $('#tableRefund').DataTable({
    'processing': true,
    'serverSide': true,
    'serverMethod': 'post',
    "order": [[ 0, 'desc' ], [ 1, 'desc' ]],
    'ajax': {
      'url':'ajax_affliliate.php'
    },
    'columns': [
    {data: "id" , render : function ( data, type, row, meta ) {
      return row.No;
    }},
      // { data: 'id' },
         { data: 'username_game' },
      { data: 'date_check' },
      { data: 'time_check' },
      { data: 'credit' },
      { data: 'phone' },
    ]
    });
 });
</script>
