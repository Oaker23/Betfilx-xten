
<?php include("include/function.php"); ?>
<div class="page-holder bg-gray-100">
  <div class="container-fluid px-lg-4 px-xl-5">

  <!--<section class="mb-3 mb-lg-5">
            <div class="row">
              <div class="col-xl-3 col-md-6 mb-4">
                <div class="card-widget h-100">
                  <div class="card-widget-body">
                    <div class="dot me-3 bg-indigo"></div>
                    <div class="text">
                      <h6 class="mb-0">ยอดเล่น ทั้งหมด</h6><span class="text-gray-500"><h4><?php wheelList(); ?> บาท</h4></span>
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
                      <h6 class="mb-0">ยอดเล่น เดือนนี้</h6><span class="text-gray-500"><h4><?php wheelOfMonthList(); ?> บาท</h4></span>
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
                      <h6 class="mb-0">ยอดเล่น วันนี้</h6><span class="text-gray-500"><h4><?php wheelOfDayList(); ?> บาท</h4></span>
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
                      <h6 class="mb-0">กำไร-ขาดทุน</h6><span class="text-gray-500"><h4><?php wheelCusList(); ?> บาท</h4></span>
                    </div>
                  </div>
                  <div class="icon text-white bg-red"><i class="fas fa-receipt"></i></div>
                </div>
              </div>
            </div>
          </section>
-->
    <section>
      <div class="row">
        <div class="col">
          <div class="card mb-4">
            <div class="card-header">
              <h4 >สมาชิก หมุนวงล้อ</h4><button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">ตั้งค่า การออกรางวัล หมุนวงล้อ</button>
            </div>
            <div class="card-body">
            <table class="table table-striped table-bordered dt-responsive dataTable no-footer dtr-inline collapsed" id="tableWheel">
                <thead>

                  <tr>
                    <th>ลำดับ</th>
                    <th>ชื่อในเกมส์</th>
                    <th>วัน/เวลา</th>
                    <th>เครดิต</th>
                    <th>เบอร์</th>
                    <th>status</th>
                    
                  </tr>
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
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <?php 
      $sqlWheel = "SELECT * FROM config_wheel ";
      $resulWheel = $server->query($sqlWheel);

  ?>
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">ตั้งค่า การออกรางวัล หมุนวงล้อ</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="" id="formUpdateWheel">
          <?php 
                while($rowWheel = mysqli_fetch_assoc($resulWheel)) {
                  ?>
                    <div class="input-group my-4">
                    <span class="input-group-text">ประเภท</span>
                        <input type="text" aria-label="type" class="form-control" id="type<?php echo $rowWheel['id'] ?>" name="type<?php echo $rowWheel['id'] ?>" value="<?php echo $rowWheel['type'] ?>" <?php if ($rowWheel['type'] == "จำนวนพ้อยที่หักตอนกดเล่น" or $rowWheel['type'] == "รับพ้อยจากการฝากเงิน") {echo "readonly";} ?>>
                      <input type="hidden" aria-label="type" class="form-control" id="id<?php echo $rowWheel['id'] ?>" name="id<?php echo $rowWheel['id'] ?>" value="<?php echo $rowWheel['id'] ?>" >
                      
                      <?php if ($rowWheel['type'] === "รับพ้อยจากการฝากเงิน") 
                      {
                        ?>
                            <!-- <span class="input-group-text">แต้ม</span> -->
                            <input type="hidden" aria-label="type" class="form-control" id="type<?php echo $rowWheel['id'] ?>" name="type<?php echo $rowWheel['id'] ?>" value="<?php echo $rowWheel['type'] ?>" <?php if ($rowWheel['type'] == "จำนวนพ้อยที่หักตอนกดเล่น" or $rowWheel['type'] == "รับพ้อยจากการฝากเงิน") {echo "readonly";} ?>>
                            <input type="hidden" aria-label="" class="form-control" id="point<?php echo $rowWheel['id'] ?>" name="point<?php echo $rowWheel['id'] ?>" value="<?php echo $rowWheel['point'] ?>" >
                        <?php
                        
                      } else {
                        ?>

                        <span class="input-group-text">แต้ม</span>
                      <input type="text" aria-label="" class="form-control" id="point<?php echo $rowWheel['id'] ?>" name="point<?php echo $rowWheel['id'] ?>" value="<?php echo $rowWheel['point'] ?>" >
                        <?php
                      }
                      
                      ?>
                      <!-- <span class="input-group-text">แต้ม</span>
                      <input type="text" aria-label="" class="form-control" id="point<?php echo $rowWheel['id'] ?>" name="point<?php echo $rowWheel['id'] ?>" value="<?php echo $rowWheel['point'] ?>" > -->
                      <!-- <span class="input-group-text">%</span>
                      <input type="text" aria-label="" class="form-control" id="percent<?php echo $rowWheel['id'] ?>" name="percent<?php echo $rowWheel['id'] ?>" value="<?php echo $rowWheel['percent'] ?>"> -->
                      <?php 
                        if ($rowWheel['type'] != "จำนวนพ้อยที่หักตอนกดเล่น") {
                          ?>
                          <span class="input-group-text">%</span>
                          <input type="text" aria-label="" class="form-control" id="percent<?php echo $rowWheel['id'] ?>" name="percent<?php echo $rowWheel['id'] ?>" value="<?php echo $rowWheel['percent'] ?>">
                          <?php
                        }else {
                          ?>
                          <!-- <span class="input-group-text">%</span> -->
                          <input type="hidden" aria-label="" class="form-control" id="percent<?php echo $rowWheel['id'] ?>" name="percent<?php echo $rowWheel['id'] ?>" value="<?php echo $rowWheel['percent'] ?>">
                          <?php
                        }
                      ?>
                    </div>

                <?php

                } 
          ?>
        
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">ปิด</button>
        <button type="submit" class="btn btn-primary" onclick="updateWheel()" data-bs-dismiss="modal">บันทึก</button>
      </div>
    </div>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.9/js/responsive.bootstrap4.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap4.min.css">


<script>

  function updateWheel() {
    // console.log("tttt");
    var arrFormWheel = []
      for (let index = 1; index < 8; index++) {
        var id = $('#id'+index).val();
        var type = $('#type'+index).val();
        var point = $('#point'+index).val();
        var percent = $('#percent'+index).val();
        // console.log(genKey);
        arrIn = {"id": id,"type":type,"point":point,"percent":percent}
        arrFormWheel.push(arrIn);

        
      }
    console.log(arrFormWheel);
    $.ajax({
            url:'actionNew.php?update_wheel_config',
            type:'POST',
            data:{
              arrFormWheel:arrFormWheel,
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
              
            }

        });

  }


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
   $('#tableWheel').DataTable({
    'processing': true,
    'serverSide': true,
    'serverMethod': 'post',
    "order": [[ 0, 'desc' ], [ 1, 'desc' ]],
    'ajax': {
      'url':'ajax_history_wheel.php'
    },
    'columns': [
    {data: "id" , render : function ( data, type, row, meta ) {
      return row.No;
    }},
      // { data: 'id' },
       { data: 'username_game' },
    {data: "id" , render : function ( data, type, row, meta ) {
      return row.date_check+" "+row.time_check;
    }},
    
      { data: 'credit' },
      { data: 'phone' },
      { data: 'status' },
    ]
    });
 });
</script>

