
<?php

include("../config/config.php");

if($_SESSION["username"] == "") {

  echo " <script> window.open('./login');</script>";

  exit();
}

date_default_timezone_set("Asia/Bangkok");
$date_check=date("d/m/Y");
$time_check=date("h:i");


$start_date=date("d/m/Y", strtotime("first day of this month"));
$end_date=date('t/m/Y',strtotime('today'));


$sql="SELECT COUNT(*) AS total_member FROM member WHERE username_game!=''";
$result = $server->query($sql);
$row = mysqli_fetch_assoc($result);
$total_member=$row['total_member'];


$sql_membertoday="SELECT COUNT(*) AS total__membertoday FROM member WHERE `date_check`='".$date_check."' and username_game!=''";
$result_membertoday = $server->query($sql_membertoday);
$row_membertoday = mysqli_fetch_assoc($result_membertoday);
$total__membertoday=$row_membertoday['total__membertoday'];




$sql_membermonth="SELECT COUNT(*) AS total__membermonth FROM member WHERE `date_check` between '".$start_date."' and '".$end_date."' and username_game!=''";
$result_membermonth = $server->query($sql_membermonth);
$row_membermonth = mysqli_fetch_assoc($result_membermonth);
$total__membermonth=$row_membermonth['total__membermonth'];

include("include/function.php");



// SELECT COUNT(*) AS total__code FROM code_itme;

$sql_code="SELECT COUNT(*) as total_code FROM code_itme;";
$result_code = $server->query($sql_code);
$row_code = mysqli_fetch_assoc($result_code);
$total_code=$row_code['total_code'];

$sql_code1="SELECT COUNT(*) AS total_code1 FROM code_itme WHERE status=1;";
$result_code1 = $server->query($sql_code1);
$row_code1 = mysqli_fetch_assoc($result_code1);
$total_code1=$row_code1['total_code1'];

$sql_code2="SELECT COUNT(*) AS total_code2 FROM code_itme WHERE status=0;";
$result_code2 = $server->query($sql_code2);
$row_code2 = mysqli_fetch_assoc($result_code2);
$total_code2=$row_code2['total_code2'];

// SELECT SUM(credit) as total_code FROM code_itme;


$sql_code3="SELECT SUM(credit) as total_code3 FROM code_itme WHERE `status`=1;";
$result_code3 = $server->query($sql_code3);
$row_code3 = mysqli_fetch_assoc($result_code3);
$total_code3=$row_code3['total_code3'];
?>




<div class="page-holder bg-gray-100">
  <div class="container-fluid px-lg-4 px-xl-5">
    <!-- <h2>สร้างโค้ด รับเครดิต</h2> -->
    
    <!-- <div class="row">
      <div class="col-xl-3 col-md-6 mb-4">
        <div class="card-widget h-100">
          <div class="card-widget-body">
            <div class="dot me-3 bg-indigo"></div>
            <div class="text">
              <h6 class="mb-0">โค้ดทั้งหมด</h6><span class="text-gray-500"><h4><?php echo $total_code; ?> </h4></span>
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
              <h6 class="mb-0">โค้ดที่เติมไปแล้ว</h6><span class="text-gray-500"><h4><?php echo $total_code1; ?> </h4></span>
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
              <h6 class="mb-0">โค้ดคงเหลือ</h6><span class="text-gray-500"><h4><?php echo $total_code2; ?> </h4></span>
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
              <h6 class="mb-0">เครดิตที่เสียไป</h6><span class="text-gray-500"><h4><?php echo number_format($total_code3,2); ?> บาท</h4></span>
            </div>
          </div>
          <div class="icon text-white bg-red"><i class="fas fa-receipt"></i></div>
        </div>
      </div>
    </div> -->

    <div class="row">
      <div class="col-xs-12 col-md-3">
        <div class="all-box box-far">
          <h2><?php echo $total_code; ?></h2>
          <h3>โค้ดทั้งหมด</h3>
        </div>
      </div>
      <div class="col-xs-12 col-md-3">
        <div class="all-box box-yellow">
          <h2><?php echo $total_code1; ?></h2>
          <h3>โค้ดที่เติมไปแล้ว</h3>
        </div>
      </div>
      <div class="col-xs-12 col-md-3">
        <div class="all-box box-green">
          <h2><?php echo $total_code2; ?></h2>
          <h3>โค้ดคงเหลือ</h3>
        </div>
      </div>
      <div class="col-xs-12 col-md-3">
        <div class="all-box box-red">
          <h2>฿ <?php echo number_format($total_code3,2); ?></h2>
          <h3>เครดิตที่เสียไป</h3>
        </div>
      </div>
    </div>

    <section>
      <div class="card mb-4">
        <div class="card-header">
          <h4>สร้างโค้ด รับเครดิต</h4> 
        </div>
        <div class="card-body">
          <div class="row mx-4 my-4">
            <form action="" method="post" id="formAddGive">
              <div class="mb-3 col-md col-lg">
                <label for="Credit" class="form-label">เครดิต</label>
                <input type="text" class="form-control" id="Credit" name="Credit" placeholder="50.00">
                <!-- <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div> -->
              </div>
              <div class="mb-3 col-md col-lg">
                <label for="TurnOver" class="form-label">ทำเทิร์น</label>
                <input type="text" class="form-control" id="TurnOver" name="TurnOver" placeholder="300.00">
                <!-- <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div> -->
              </div>
              <div class="mb-3 col-md col-lg">
                <label for="giveNum" class="form-label">จำนวน โค้ด</label>
                <input type="text" class="form-control" id="giveNum" name="giveNum" placeholder="1 code เติมได้1คน">
                <!-- <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div> -->
              </div>
              <button type="button" onclick="GeneratorGive()" class="btn btn-primary"><i class="fas fa-plus"></i> สร้าง</button>
              <button type="button" onclick="delete_code()" class="btn btn-danger"><i class="fas fa-minus-circle"></i> ล้างโค้ด</button>
            </form>
          </div>
        </div>
      </div>

    </section>

    <section>
      <div class="card mb-4">
        <div class="card-header">
          <h4>รายการเครดิต ที่ยังไม่ใช้</h4> 
        </div>
        <div class="card-body">

          <table id="tableCode" class="table table-striped dt-responsive" style="width:100%">
            <thead>
              <tr>
                <th>ลำดับ.</th>
                <!-- <th>id</th> -->
                <th>วันที่</th>
                <th class="none">วันที่สร้าง</th>
                <th>Code</th>
                <th>Credit</th>
                <th class="none">เบอร์</th>
                <th>ทำเทินร์น</th>
                <th>สถานะ</th>

              </tr>
            </thead>
          </table>
        </div>
      </div>


    </section>





  </div>
</div>



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
    $('#tableCode').DataTable({
      'processing': true,
      'serverSide': true,
      'serverMethod': 'post',
      "order": [[ 0, 'desc' ], [ 1, 'desc' ]],
      'ajax': {
        'url':'ajax_code.php?codeList'
      },
      'columns': [
      {data: "id" , render : function ( data, type, row, meta ) {
        return row.No;
      }},
        // { data: 'id' },
        { data: 'date_check' },
        { data: 'date_give' },
        { data: 'code' },
        { data: 'credit' },
        { data: 'phone' },
        { data: 'turnover' },
        { data: 'status' }
        ]
      });
  });

  $(document).ready(function(){
    $('#tableCodeUse').DataTable({
      'processing': true,
      'serverSide': true,
      'serverMethod': 'post',
      "order": [[ 0, 'desc' ], [ 1, 'desc' ]],
      'ajax': {
        'url':'ajax_code.php?codeUse'
      },
      'columns': [
      {data: "id" , render : function ( data, type, row, meta ) {
        return row.No;
      }},
        // { data: 'id' },
        { data: 'username_game' },
        { data: 'date_check' },
        { data: 'date_give' },
        { data: 'code' },
        { data: 'credit' },
        { data: 'phone' },
        { data: 'turnover' },
        { data: 'status' }
        ]
      });
  });
</script>

<script>





  function getRandomString(length) {
        // var randomChars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
        var randomChars = 'abcdefghijklmnopqrstuvwxyz0123456789';
        var result = '';
        for ( var i = 0; i < length; i++ ) {
          result += randomChars.charAt(Math.floor(Math.random() * randomChars.length));
        }
        return result;
      }
      function GeneratorGive() {
        var Credit = $('#Credit').val();
        var TurnOver = $('#TurnOver').val();
        var giveNum = $('#giveNum').val();
        if (Credit != ""  && TurnOver != "" && giveNum != "") {
          var arrFormGive = []
          for (let index = 0; index < giveNum; index++) {
            genKey = getRandomString(40)
          // console.log(genKey);
          arrIn = {"Credit":Credit,"TurnOver":TurnOver,"genKey":genKey}
          arrFormGive.push(arrIn);

          
        }
        console.log(arrFormGive);
        $.ajax({
          url:'actionNew.php?addGive',
          type:'POST',
          data:{
            arrFormGive:arrFormGive,
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
              document.getElementById("formAddGive").reset();
              
            }

          });
        // console.log();
      } else {
        Swal.fire({
          icon: 'error',
          title: 'แจ้งเตือน...',
          text:'กรุณากรอก ข้อมูลให้ครบด้วย'

        })
        return false
      }
      

    }

      function delete_code(){
  
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
          url:'action.php?delete_code',
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


</script>
