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

?>

<div class="page-holder bg-gray-100">
  <div class="container-fluid px-lg-4 px-xl-5">
    <section>
      <div class="row">
        <div class="col">
          <div class="card mb-4">
            <div class="card-header">
              <h4>ประวัติการใช้งานของผู้ใช้</h4>
            </div>
            <div class="card-body">
              <table id="tableLogAdmin" class="table table-striped dt-responsive" style="width:100%">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>วันที่</th>
                    <th>username</th>
                    <th>กระทำ</th>
                    <th>data</th>
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


<script type="text/javascript">

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

  $(document).ready(function(){
   $('#tableLogAdmin').DataTable({
    'processing': true,
    'serverSide': true,
    'serverMethod': 'post',
    "order": [[ 0, 'desc' ], [ 1, 'desc' ]],
    'ajax': {
      'url':'ajax_log_member.php'
    },
    'columns': [
      { data: 'id' },
      { data: 'create_date' },
      { data: 'user_member' },
      { data: 'detail_name' },
      { data: 'value1' },
      

      // {data: "status" , render : function ( data, type, row, meta ) 
      //   {
      //     if (data == "1") {
      //       return type === 'display'  ?
      //       "<button class='btn btn-success' disabled>สำเร็จ</button>":data;
      //     }else{
      //       return type === 'display'  ?
      //       "<button class='btn btn-danger' disabled>ยังไม่สำเร็จ</button>":data;
      //     }
      //   }
      // },

      ]
    });
 });
</script>
