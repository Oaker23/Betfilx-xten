<?php
if($_SESSION["username"] == "") {

  echo " <script> alert('ควย');</script>";
  exit();
}
include '../config/config.php';
include("include/function.php");

$sql_member="SELECT sum(credit) as total_member FROM history_refund WHERE date_check='".$date_check."'";
$result_member = $server->query($sql_member);
$row_member = mysqli_fetch_assoc($result_member);

$total_member=$row_member['total_member'];


?>



<div class="page-holder bg-gray-100">
  <div class="container-fluid px-lg-4 px-xl-5">
   <div class="row">
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card-widget h-100">
        <div class="card-widget-body">
          <div class="dot me-3 bg-indigo"></div>
          <div class="text">
            <h6 class="mb-0">รับยอดเสีย ทั้งหมด</h6><span class="text-gray-500"><h4><?php refunList(); ?> บาท</h4></span>
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
            <h6 class="mb-0">รับยอดเสีย เดือนนี้</h6><span class="text-gray-500"><h4><?php refunOfMonthList(); ?> บาท</h4></span>
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
            <h6 class="mb-0">รับยอดเสีย อาทิตย์นี้</h6><span class="text-gray-500"><h4><?php refunOfWeekList(); ?> บาท</h4></span>
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
            <h6 class="mb-0">รับยอดเสีย วันนี้</h6><span class="text-gray-500"><h4><?php refunOfDayList(); ?> บาท</h4></span>
          </div>
        </div>
        <div class="icon text-white bg-red"><i class="fas fa-receipt"></i></div>
      </div>
    </div>
  </div>
  <section>
    <div class="row">
      <div class="col">
        <div class="card mb-4">
          <div class="card-header">
            <h4 >รายงาน สมาชิกรับยอดเสีย</h4>
          </div>
          <div class="card-body">
            <table id="tableRefund" class="table table-striped dt-responsive" style="width:100%">
              <thead>
                <tr>
                  <th>ลำดับ.</th>
                  <!-- <th>id</th> -->
                  <th>ชื่อในเกมส์</th>
                  <th>วันที่</th>
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
    'ajax': {
      'url':'ajax_history_refund.php'
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
