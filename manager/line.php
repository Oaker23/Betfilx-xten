<?php

include '../config/config.php';

if($_SESSION["username"] == "") {

  echo " <script> window.open('./login');</script>";

  exit();
}


$sql = 'SELECT * FROM  `notify`';
$result = $server->query($sql);
$res=array();
foreach ($result as $row) {

  array_push($res,$row);

}

?>



<div class="page-holder bg-gray-100">
  <div class="container-fluid px-lg-4 px-xl-5">

    <section>
      <div class="row">
        <div class="col">
          <div class="card mb-4">
            <div class="card-header">
              <h4>แจ้งเตือน Line</h4>


              <button class="btn btn-primary" onclick="window.open('https://notify-bot.line.me/th/', '_blank')">รับ token</button>
            </div>
            <div class="card-body">
							<div class="table-responsive">
              <table class="table">
                <thead>

                  <tr>
                    <th>ลำดับ</th>
                    <th>ชื่อ</th>
                    <th>โทเคน</th>
                    <th>แก้ไข</th>
                  </tr>
                </tr>
              </thead>
              <style>
										.form-control{
											width: fit-content !important;
										}
										.tab-button{
											display: flex;
										}
										.tab-button button{
											padding: 6px 10px 6px 10px;
    										margin-right: 5px;
    										width: 90px;
										}
									</style>
              <tbody>
                <?php $i=1; foreach ($res as $key => $value){?>
                  <tr>
                    <th scope="row"><?=$i ?></th>
                    <td><?=$value ['name'] ?></td>
                    <td>
                      <input disabled class="form-control" type="text" id="token<?=$value ['id'] ?>" value=" <?=$value ['token'] ?>">
                   </td>
                   <td class="tab-button">
                    <button onclick="editadmin(<?=$value ['id'] ?>)" class="btn btn-warning"><i class="far fa-edit"></i> แก้ไข</button> 
                    <button onclick="update_line(<?=$value ['id'] ?>)" class="btn btn-primary"></i>&nbsp;บันทึก</button> 
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





<script type="text/javascript">



 function editadmin(id) {

  document.getElementById("token"+id).disabled = false;

}


function update_line(id) {
  var token=$("#token"+id).val();
  

  $.ajax({
    url:'action.php?update_line',
    type:'POST',
    data:{
      id:id,
      token:token
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
