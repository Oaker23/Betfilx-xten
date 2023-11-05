<?php

include '../config/config.php';

include("include/function.php");

if($_SESSION["username"] == "") {

  echo " <script> window.open('./login');</script>";

  exit();
}

date_default_timezone_set("Asia/Bangkok");
$date_check=date("Y-m-d");
$time_check=date('H:i:s');

$sql_member="SELECT COUNT(DISTINCT phone) total_member_deposit  FROM refill where date_check='".$date_check."'and phone!=''";
$result_member = $server->query($sql_member);
$row_member = mysqli_fetch_assoc($result_member);
$total_member_deposit=$row_member['total_member_deposit'];




$sql_sum = "SELECT SUM(amount) as total_today FROM refill WHERE date_check='".$date_check."' and amount>0  and phone!=''";
$result_sum = $server->query($sql_sum);
$row__sum = mysqli_fetch_assoc($result_sum);
$total_today=$row__sum['total_today'];




$sql_sum1 = "SELECT SUM(amount) as total_all FROM refill WHERE amount>0 and phone!=''";
$result_sum1 = $server->query($sql_sum1);
$row__sum1 = mysqli_fetch_assoc($result_sum1);
$total_all=$row__sum1['total_all'];



$start_date=date("Y-m-d", strtotime("first day of this month"));
$end_date=date('Y-m-t',strtotime('today'));

$sql_sum2 = "SELECT SUM(amount) as total_month FROM refill WHERE amount>0 and phone!=''AND date_check BETWEEN '".$start_date."' AND '".$end_date."'";
$result_sum2 = $server->query($sql_sum2);
$row__sum2 = mysqli_fetch_assoc($result_sum2);
$total_month=$row__sum2['total_month'];




?>



<div class="page-holder bg-gray-100">
  <div class="container-fluid px-lg-4 px-xl-5">

   <!-- <div class="row">
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card-widget h-100">
        <div class="card-widget-body">
          <div class="dot me-3 bg-indigo"></div>
          <div class="text">
            <h6 class="mb-0">รายการฝาก ทั้งหมด</h6><span class="text-gray-500"><h4><?php echo number_format($total_all,2); ?>  บาท</h4></span>
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
            <h6 class="mb-0">รายการฝาก เดือนนี้</h6><span class="text-gray-500"><h4><?php echo number_format($total_month,2); ?> บาท</h4></span>
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
            <h6 class="mb-0">รายการฝาก วันนี้</h6><span class="text-gray-500"><h4><?php echo number_format($total_today,2); ?> บาท</h4></span>
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
            <h6 class="mb-0">สมาชิก ฝากเงิน</h6><span class="text-gray-500"><h4><?php echo $total_member_deposit; ?> คน</h4></span>
          </div>
        </div>
        <div class="icon text-white bg-red"><i class="fas fa-receipt"></i></div>
      </div>
    </div>
  </div> -->

    <div class="row">
      <div class="col-xs-12 col-md-3">
        <div class="all-box box-far">
          <h2>฿ <?php echo number_format($total_all,2); ?></h2>
          <h3>รายการฝาก ทั้งหมด</h3>
        </div>
      </div>
      <div class="col-xs-12 col-md-3">
        <div class="all-box box-yellow">
          <h2>฿ <?php echo number_format($total_month,2); ?></h2>
          <h3>รายการฝาก เดือนนี้</h3>
        </div>
      </div>
      <div class="col-xs-12 col-md-3">
        <div class="all-box box-green">
          <h2>฿ <?php echo number_format($total_today,2); ?></h2>
          <h3>รายการฝาก วันนี้</h3>
        </div>
      </div>
      <div class="col-xs-12 col-md-3">
        <div class="all-box box-red">
          <h2><?php echo $total_member_deposit; ?></h2>
          <h3>สมาชิก ฝากเงิน</h3>
        </div>
      </div>
    </div>

  <section>
    <div class="row">
      <div class="col">
        <div class="card mb-4">
          <div class="card-header">
            <h4>รายการ ฝากเงิน</h4>
          </div>
          <div class="card-body">
             <button class='btn btn-warning' onclick="download_refill()"><i class="fas fa-cloud-download-alt"></i> Export Csv</button><br><br>
            <table id="tableWithdraw" class="table table-striped dt-responsive" style="width:100%">
              <thead>
                <tr>
                  <th>ลำดับ.</th>
                  <!-- <th>id</th> -->
                  <th class="none">refill_id</th>
                  <th >ชื่อในเกมส์</th>
                  <th>วัน/เวลา</th>
                  <th>เครดิต</th>
                  <th>ชื่อ-นามสกุล</th>
                  <th>เลขบัญชี</th>
                  <th>ธนาคาร</th>
                  <th class="none">buyerName</th>
                  <th>เบอร์</th>
                  <th>ชองทาง</th>
                  <th>ผู้ดูแล</th>

                  <th class="none">status</th>
                  
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

    function download_refill() {

    $.ajax({
      url:'action.php?download_refill',
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
            window.open("./refill.csv");
            $.ajax({
              url:'action.php?delete_csv_refill',
              success:function(data){  }
            });

          }

        }

      }
    });

  }

  
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
   $('#tableWithdraw').DataTable({
    'processing': true,
    'serverSide': true,
    'serverMethod': 'post',
    "order": [[ 0, 'desc' ], [ 1, 'desc' ]],
    'ajax': {
      'url':'ajax_deposit.php'
    },
    'columns': [
    {data: "id" , render : function ( data, type, row, meta ) {
      return row.No;
    }},
      // { data: 'id' },
      { data: 'refill_id' },
      { data: 'username_game' },
      { data: 'date_check' },
      { data: 'amount' },
      { data: 'fname' },
      { data: 'banknumber' },
      { data: 'buyerBank' },
      { data: 'buyerName' },
      { data: 'phone' },
      { data: 'description' },
      { data: 'info' },

      // { data: 'status' }
      {data: "status" , render : function ( data, type, row, meta ) {
        if (data == "1") {
          return type === 'display'  ?
          "<button class='btn btn-success' disabled>สำเร็จ</button>":data;
        }else{
          return type === 'display'  ?
          "<button class='btn btn-danger' disabled>ยังไม่สำเร็จ</button>":data;
        }
      }},

      ]
    });
 });
</script>
