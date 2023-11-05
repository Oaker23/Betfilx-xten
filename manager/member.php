
<?php

error_reporting(0);
if (!isset($_SESSION)) {
  session_start();
}

include '../config/config.php';


if($_SESSION["username"] == "") {

  echo " <script> window.open('./login');</script>";

  exit();
}

date_default_timezone_set("Asia/Bangkok");
$date_check=date("Y-m-d");
$time_check=date('H:i:s');

$sql_website = "SELECT * FROM website";
$result_website = $server->query($sql_website);
$row_website = mysqli_fetch_assoc($result_website);


$start_date=date("Y-m-d", strtotime("first day of this month"));
$end_date=date('Y-m-t',strtotime('today'));


$sql="SELECT COUNT(*) AS total_member FROM member WHERE username_game!=''";
$result = $server->query($sql);
$row = mysqli_fetch_assoc($result);
$total_member=$row['total_member']; //สมาชิกทะ้งหมด


$sql_membertoday="SELECT COUNT(*) AS total__membertoday FROM member WHERE `date_check`='".$date_check."' and username_game!=''";
$result_membertoday = $server->query($sql_membertoday);
$row_membertoday = mysqli_fetch_assoc($result_membertoday);
$total__membertoday=$row_membertoday['total__membertoday']; //สมาชิกวันนี้




$sql_membermonth="SELECT COUNT(*) AS total__membermonth FROM member WHERE `date_check` BETWEEN '".$start_date."' AND '".$end_date."'";
$result_membermonth = $server->query($sql_membermonth);
$row_membermonth = mysqli_fetch_assoc($result_membermonth);
$total__membermonth=$row_membermonth['total__membermonth'];  //สมาชิกเดือนนี้



$sql_member="SELECT COUNT(DISTINCT phone) total_member_deposit  FROM refill where date_check='".$date_check."'";
$result_member = $server->query($sql_member);
$row_member = mysqli_fetch_assoc($result_member);
$total_member_deposit=$row_member['total_member_deposit'];



?>


<div class="page-holder bg-gray-100">
  <div class="container-fluid px-lg-4 px-xl-5">

    <!-- <div class="row">
      <div class="col-xl-3 col-md-6 mb-4">
        <div class="card-widget h-100">
          <div class="card-widget-body">
            <div class="dot me-3 bg-indigo"></div>
            <div class="text">
              <h6 class="mb-0">สมาชิกทั้งหมด</h6><span class="text-gray-500"><h4><?php echo $total_member; ?> </h4></span>
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
              <h6 class="mb-0">สมาชิกเดือนนี้</h6><span class="text-gray-500"><h4><?php echo $total__membermonth; ?></h4></span>
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
              <h6 class="mb-0">สมาชิกวันนี้</h6><span class="text-gray-500"><h4><?php echo $total__membertoday; ?></h4></span>
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
              <h6 class="mb-0">สมาชิก ฝากเงิน วันนี้</h6><span class="text-gray-500"><h4><?php echo $total_member_deposit; ?> คน</h4></span>
            </div>
          </div>
          <div class="icon text-white bg-red"><i class="fas fa-receipt"></i></div>
        </div>
      </div>
    </div> -->

    <div class="row">
      <div class="col-xs-12 col-md-3">
        <div class="all-box box-far">
          <h2><?php echo $total_member; ?></h2>
          <h3>สมาชิกทั้งหมด</h3>
        </div>
      </div>
      <div class="col-xs-12 col-md-3">
        <div class="all-box box-yellow">
          <h2><?php echo $total__membermonth; ?></h2>
          <h3>สมาชิกเดือนนี้</h3>
        </div>
      </div>
      <div class="col-xs-12 col-md-3">
        <div class="all-box box-green">
          <h2><?php echo $total__membertoday; ?></h2>
          <h3>สมาชิกวันนี้</h3>
        </div>
      </div>
      <div class="col-xs-12 col-md-3">
        <div class="all-box box-red">
          <h2><?php echo $total_member_deposit; ?></h2>
          <h3>สมาชิก ฝากเงิน วันนี้</h3>
        </div>
      </div>
    </div>


    <div align="right" class="mb-3">
      <button class="btn btn-primary text-uppercase" data-bs-toggle="modal" data-bs-target="#add_member">เพิ่ม สมาชิก</button>
    </div>
    <section>
      <div class="row">
        <div class="col">
          <div class="card mb-4">
            <div class="card-header">
              <h4>จัดการ สมาชิก</h4>
            </div>
              <table id="tableMember" class="table table-striped dt-responsive mt-2" style="width:100%">
                <thead>
                  <tr>
                    <th>ลำดับ.</th>
                    <th class="none">ไอดี</th>
                   <th>วันที่สมัคร</th>
                    <th>ชื่อในเกมส์</th>
                    <th>ชื่อ/สกุล</th>
                    <th>เลขบัญชี</th>
                    <th>ธนาคาร</th>
                    <th>เบอร์มือถือ</th>
                    <th>เครดิต</th>
                    <th>พ้อย</th>
                    <!-- <th>ยอดเทิร์น</th> -->
					          <!-- <th>ติดเทิร์น</th> -->
					          <th>สถานะ</th> 
					          <!-- <th>สถานะเทิร์น</th>   -->
                    <th width="36%">จัดการ</th>

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
       <i class="fas fa-edit"></i>&nbsp; <h5 class="modal-title" id="head_editadmin"></h5>
       <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
     </div>
     <div class="modal-body" id="editadmin_detail">

     </div>
     <div class="modal-footer">
      <button type="button" class="btn btn-primary" onclick="update_member()" ><i class="fas fa-plus"></i> บันทึก</button>
      <button type="button" class="btn btn-danger" data-bs-dismiss="modal">ปิด</button>

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
          <input type="text" class="form-control" id="bank_number" aria-describedby="เลขบัญชีธนาคาร" placeholder="เลขบัญชีธนาคาร">
        </div>

        <div class="form-group mt-2">
          <select id="select" class="form-control">
            <option selected>เลือก ธนาคาร</option>
            <option value="ไทยพาณิชย์">ไทยพาณิชย์</option>
            <option value="กรุงเทพ">กรุงเทพ</option>
            <option value="กสิกรไทย">กสิกรไทย</option>
            <option value="กรุงไทย">กรุงไทย</option>
            <option value="ทหารไทย">ทหารไทยธนชาติ</option>
            <option value="กรุงศรีฯ">กรุงศรีฯ</option>
            <option value="ออมสิน">ออมสิน</option>
            <option value="ธนชาติ">ธนชาติ</option>
            <option value="ธกส">ธกส</option>
            <option value="ทรูวอเลต">ทรูวอเลต</option>
          </select>
        </div>

        <div class="form-group mt-2">
          <label class="float-left">ชื่อ-นามสกุล</label>
          <input type="text" class="form-control" id="fname" aria-describedby="ชื่อ-นามสกุลชื่อ" placeholder="ชื่อ-นามสกุล">
        </div>

        <div class="form-group mt-2">
          <label class="float-left">เบอร์มือถือ</label>
          <input type="text" class="form-control" id="phone_user" aria-describedby="phone_user" placeholder="เบอร์มือถือ">
        </div>

        <div class="form-group mt-2">
          <label class="float-left">ตั้งรหัสผ่านเอง</label>
          <input type="text" class="form-control" id="password" aria-describedby="password" placeholder="ตั้งรหัสผ่านเอง">
        </div>


        <div class="modal-footer">
          <button type="button" class="btn btn-primary" onclick="add_member()"><i class="fas fa-plus"></i> เพิ่ม</button>
          <button type="button" class="btn btn-danger" data-bs-dismiss="modal">ปิด</button>

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
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">ปิด</button>

      </div>
    </div>
  </div>
</div>

<!-- The Modal -->
<div class="modal fade" id="add_point" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true" style="margin-top: 200px;">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel"><i class="fas fa-plus"></i> เพิ่ม พ้อย</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" id="addpoint_detail">


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" onclick="update_point_user()"><i class="fas fa-plus"></i> เพิ่ม</button>
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">ปิด</button>

      </div>
    </div>
  </div>
</div>


 <!-- The Modal -->
 <div class="modal fade" id="gameplay_list_modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true" >
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel"><i class="fas fa-chart-line"></i> รายการเล่น <span id="phoneid"></span> </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <table id="gameplay_table" class="table table-striped dt-responsive" style="width:100%">
                <thead>
                    <th>เกมส์</th>
                    <th>วันเวลาเล่น</th>
                    <th>ยอดเล่น</th>
                    <th>ยอดได้/เสีย</th>
                </thead>
                <tbody>

                </tbody>
      </table>
</br></br>
      <table style="width:100%; " >
        <tr>
          <td style="text-align:center;">รวมยอด</td>
          <td style="text-align:center;">
          <span style="color:blue;">Turn Over</span> <br>
          <span id="allturnover" style="color:blue; font-weight: bold;">0</span>
          </td>
          <td style="text-align:center;"style="text-align:center;">
          <span style="color:green;">ยอดได้</span> <br>
            <span id="allpositive" style="color:green; font-weight: bold;">0</span>
          </td>
          <td style="text-align:center;">
          <span style="color:red;">ยอดเสีย</span> <br>
            <span id="allnegative" style="color:red; font-weight: bold;">0</span>
          </td>
          <td style="text-align:center;">
            บาท
          </td>
        </tr>
      </table>
      </div>
      <div class="modal-footer">
		<button type="button" class="btn btn-danger" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">ปิด</span>
        </button>
      </div>
    </div>
  </div>
</div>
 <!-- The Modal -->

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.9/js/responsive.bootstrap4.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap4.min.css">


<script>

  function download_member() {

    $.ajax({
      url:'action.php?download_member',
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
            window.open("./member.csv");
            $.ajax({
              url:'action.php?delete_csv',
              success:function(data){  }
            });

          }

        }

      }
    });

  }
  function add_member() {

   var phone=$("#phone_user").val();
   var password=$("#password").val();
   var bank_number=$("#bank_number").val();
   var fname=$("#fname").val();
   var e = document.getElementById("select");
        var bank_name = e.options[e.selectedIndex].value; //ธนาคาร



        if (phone=="") {
          Swal.fire({
            icon: 'error',
            title: 'แจ้งเตือน...',
            text:'กรุณากรอก เบอร์โทรศัพท์'

          })
          return false
        } else if (password=="") {
          Swal.fire({
            icon: 'error',
            title: 'แจ้งเตือน...',
            text:'กรุณากรอก รหัสผ่าน'

          })
          return false
        } else if (fname=="") {
          Swal.fire({
            icon: 'error',
            title: 'แจ้งเตือน...',
            text:'กรุณากรอก ชื่อ'

          })
          return false
        } else if (bank_number=="") {
          Swal.fire({
            icon: 'error',
            title: 'แจ้งเตือน...',
            text:'กรุณากรอก เลขบัญชี'

          })
          return false
        } else if (bank_name=="") {
          Swal.fire({
            icon: 'error',
            title: 'แจ้งเตือน...',
            text:'เลือก ธนาคาร'

          })
          return false
        }

        $.ajax({
          url:'action.php?add_member',
          type:'POST',
          data:{
            phone:phone,
            password:password,
            bank_number:bank_number,
            bank_name:bank_name,
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


      $.extend(true, $.fn.dataTable.defaults, {
        "language": {
          "sProcessing": "กำลังดำเนินการ...",
          "sLengthMenu": "แสดง_MENU_ แถว",
          "sZeroRecords": "ไม่พบข้อมูล",
          "sInfo": "แสดง _START_ ถึง _END_ จาก _TOTAL_ แถว",
          "sInfoEmpty": "แสดง 0 ถึง 0 จาก 0 แถว",
          "sInfoFiltered": "(กรองข้อมูล _MAX_ ทุกแถว)",
          "sInfoPostFix": "",
          "sSearch": "ค้นหา:",
          "sUrl": "",
          "oPaginate": {
            "sFirst": "เริ่มต้น",
            "sPrevious": "ก่อนหน้า",
            "sNext": "ถัดไป",
            "sLast": "สุดท้าย"
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
   $('#tableMember').DataTable({
    'processing': true,
    'serverSide': true,
    'serverMethod': 'post',
    "order": [[ 0, 'desc' ], [ 1, 'desc' ]],
    'ajax': {
      'url':'ajax_member.php'
    },
    'columns': [
    {data: "id" , render : function ( data, type, row, meta ) {
      return row.No;
    }},
    { data: 'id' },
    { data: 'date_check' },
    { data: 'username_game' },
    { data: 'fname' },
    { data: 'bank_number' },
    { data: 'bank_name' },
    { data: 'phone' },
    { data: 'credit' },
    { data: 'point' },
    // { data: 'turnover' },
    // {data: "turnover_struck" , render : function ( data, type, row, meta ) {
    //   return type === 'display'  ? 
    //   "<span style='color: red;'>"+data+"</span>"
    //   :data;
    // }},
    {data: "status_promotion" , render : function ( data, type, row, meta ) {
      if(data=="ติดโปรธรรมดา"){
        return type === 'display'  ? 
        "<span>"+data+"</span>"
      :data;
      }else{
        return type === 'display'  ? 
        "<span style='color: green;'>"+data+"</span>"
      :data;
      }

    }},
    // {data: "status_promotion" , render : function ( data, type, row, meta ) {

    //   if(data == 1){
    //     return type === 'display'  ? 
    //     "<span style='color: green ;'>ติดโปร</span>"
    //     :data;
    //   }else{
    //     return type === 'display'  ? 
    //     "<span style='color: green ;'>ไม่รับโปร/เทริน</span>"
    //     :data;
    //   }
    // }},
    // {data: "id" , render : function ( data, type, row, meta ) {
    //   return type === 'display'  ? 
    //   '<button class="btn btn-success  btn-sm" onclick="get_promotion(`'+data+'`)">รับโปร</button>' +
    //   '<button class="btn btn-danger  btn-sm" onclick="reset_promotion(`'+data+'`)">รีเซต</button>'
    //   :data;
    // }},
    // { data: 'color' }
    {data: "id" , render : function ( data, type, row, meta ) {

      return type === 'display'  ?
      "<button onclick='viwe_member(`"+data+"`)' class='btn btn-success' title='ดูข้อมูล'><i class='fas fa-user-lock' aria-hidden='true'></i> </button>"+ " " +
      "<button onclick='edit_member(`"+data+"`)' class='btn btn-primary' title='แก้ไข'><i class='fas fa-edit' aria-hidden='true'></i> </button>"+ " " +
      "<button onclick='add_credit(`"+data+"`)' class='btn btn-warning' title='เพิ่ม-ลบ เครดิต'><i class='fas fa-dollar-sign' aria-hidden='true'></i> </button>"+ " " +
      "<button onclick='delete_member(`"+data+"`)' class='btn btn-danger' title='ลบ-สมาชิก'><i class='fa fa-trash' aria-hidden='true'></i> </button>"+ " " +
      "<button onclick='restore_turnover(`"+row.phone+"`)' class='btn btn-info' title='รีเซต เทิร์น'><i class='fa fa-retweet' aria-hidden='true'></i> </button>"+ " " +
      "<button style='color:"+row.color+"' onclick='add_point(`"+row.phone+"`)' class='btn btn-info' title='เพิ่ม-ลบ พ้อย'><i class='fa fa-heart' aria-hidden='true'></i></button>" + " " +
      "<button onclick='gameplay_list_modal(`"+row.phone+"`)' class='btn btn-success' title=''><i class='fa fa-chart-line' aria-hidden='true'></i></button>" 
                // '<a href="customer.php?uniqid='+data+'" title="Link Customer" target="_blank" class="btn btn-primary btn-sm"><i class="fa fa-link" aria-hidden="true"></i></a>'
                :data;


              }},
              ]
            });
 });
  function code(phone) {
    showModal();
    $.ajax({
      url:'action.php?add_code',
      type:'POST',
      data:{
        phone:phone
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
        // console.log(data);
        var obj = JSON.parse(data);
        var msg=obj.msg
        var status=obj.status

        if (status==200) {
          $('body').loadingModal('hide');
          $('body').loadingModal('destroy') ;
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
          $('body').loadingModal('hide');
          $('body').loadingModal('destroy') ;
          Swal.fire({
            icon: 'error',
            title: 'แจ้งเตือน...',
            text: msg

          })
        }

      }

    });

  }

  function viwe_member(data) {
    window.open('./member_data.php?page=info&id='+data+'', '_blank');
  }


  function restore_turnover(phone) {

    $.ajax({
      url:'action.php?restore_turnover',
      type:'POST',
      data:{
        phone:phone
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
        // console.log(data);
        var obj = JSON.parse(data);
        var msg=obj.msg
        var status=obj.status
        
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

      }

    });

  }

  function update_credit_user() {
   var id_credit=$("#id_credit").val();
   var credit=$("#credit").val();
   showModal();
   $.ajax({
    url:'action.php?update_credit_user',
    type:'POST',
    data:{
      id_credit:id_credit,
      credit:credit
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

      var obj = JSON.parse(data);
      var msg=obj.msg
      var status=obj.status

      if (status==200) {
        $('body').loadingModal('hide');
        $('body').loadingModal('destroy') ;
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
        $('body').loadingModal('hide');
        $('body').loadingModal('destroy') ;
        Swal.fire({
          icon: 'error',
          title: 'แจ้งเตือน...',
          text: msg

        })
      }



    }

  });

 }

 function update_point_user() {
   var id_point=$("#id_point").val();
   var point=$("#point").val();
   showModal();
   $.ajax({
    url:'action.php?update_point_user',
    type:'POST',
    data:{
      id_point:id_point,
      point:point
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

      var obj = JSON.parse(data);
      var msg=obj.msg
      var status=obj.status

      if (status==200) {
        $('body').loadingModal('hide');
        $('body').loadingModal('destroy') ;
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
        $('body').loadingModal('hide');
        $('body').loadingModal('destroy') ;
        Swal.fire({
          icon: 'error',
          title: 'แจ้งเตือน...',
          text: msg

        })
      }
    }
  });
 }


 function add_credit(data) {
  var id=data;
  $.ajax({
    url:'add_credit.php',
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
      $('#addcredit_detail').html(data);  
      $('#add_credit').modal('show');

    }

  });

}

function add_point(data) {
  var id=data;
  $.ajax({
    url:'add_point.php',
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
      $('#addpoint_detail').html(data);  
      $('#add_point').modal('show');

    }

  });

}

function edit_member(data) {
  var id = data;
  $('#head_editadmin').html('ข้อมูล สมาชิก'); 
  $.ajax({
    url:'edit_member.php',
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

function delete_member(data){
  var id=data
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
        url:'action.php?delete_member',
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


function update_member(id){
  var id=$("#e_id").val();
  var password=$("#e_password").val();
  var phone=$("#e_phone").val();
  var fname=$("#e_fname").val();
  var bank_number=$("#e_bank_number").val();
   var refid=$("#e_refid").val();
   var e_affliliate_percen=$("#e_affliliate_percen").val();
  var e = document.getElementById("select_member");
        var bank_name = e.options[e.selectedIndex].value; //ธนาคาร



        $.ajax({
          url:'action.php?update_member',
          type:'POST',
          data:{
            id:id,
            password:password,
            phone:phone,
            fname:fname,
            bank_number:bank_number,
            bank_name:bank_name,
            e_affliliate_percen:e_affliliate_percen,
             refid:refid
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

 function gameplay_list_modal(phone){
		$('#gameplay_table').DataTable().clear().draw();
		$('#gameplay_table').DataTable().destroy();

		
		$('#gameplay_table').DataTable({
			'processing': true,
			'serverSide': true,
			"order": [ 1, 'DESC' ],
			'ajax': {
				'url':'ajax_gameplay_list.php',
				'type': 'get',
				'data':{'phone':phone},
			},
			'columns': [
				{ data: 'provider' , render : function ( data, type, row, meta ){
						return "PG : "+data;
					}
				},
				{ data: 'created_at' },
				{ data: 'turnover' , render : function ( data, type, row, meta ){
					return "<span style='color:blue;'>"+parseFloat(row.turnover).toFixed(2)+"</span>";
					}
				},
				{ data: "winloss" , render : function ( data, type, row, meta ) {
					var html = "";
					if(row.winloss > 0){
					html = "<span style='color:green;'>"+parseFloat(row.winloss).toFixed(2)+"</span>";
					}else if(row.winloss < 0){
					html = "<span style='color:red;'>"+parseFloat(row.winloss).toFixed(2)+"</span>";
					}else{
					html = "<span style='color:black;'>"+parseFloat(row.winloss).toFixed(2)+"</span>";
					}
					return html;
				}},
			]
			});
			
			$("#gameplay_list_modal").modal("show");

			$.ajax({
				url:'action.php?getallgameplay',
				type:'POST',
				data:{"phone":phone}, 
				error: function(){

				Swal.fire({
					icon: 'error',
					title: 'แจ้งเตือน...',
					text: 'มีบางอย่างผิดพลาด กรุณาลองใหม่อีกครั้ง'

				})
				},
				success:function(data){ 
				
				var result = JSON.parse(data)
				$("#allturnover").html(parseFloat(result.allturnover).toFixed(2));
				$("#allpositive").html(parseFloat(result.allpositive).toFixed(2));
				$("#allnegative").html(parseFloat(result.allnegative).toFixed(2));
				}

			});

 }


 function  get_promotion(id){

// showModal();
						$.ajax({
							url:'action.php?get_promotion',
							type:'POST',
							data:{
								id:id
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

										// $('body').loadingModal('hide');
										// $('body').loadingModal('destroy') ;

									}else{
										// $('body').loadingModal('hide');
										// $('body').loadingModal('destroy') ;
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

function  reset_promotion(id){

// showModal();
						$.ajax({
							url:'action.php?reset_promotion',
							type:'POST',
							data:{
								id:id
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

										// $('body').loadingModal('hide');
										// $('body').loadingModal('destroy') ;

									}else{
										// $('body').loadingModal('hide');
										// $('body').loadingModal('destroy') ;
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

