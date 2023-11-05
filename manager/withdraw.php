<?php



include '../config/config.php';

if($_SESSION["username"] == "") {

  echo " <script> window.open('./login');</script>";

  exit();
}


include_once "../config/config_data.php";
$sql = 'SELECT * FROM  `withdraw` where `status`=1 ORDER by id  asc';
$result = $server->query($sql);
$res=array();
foreach ($result as $row) {
 $sql = "SELECT * FROM member where `phone`='".$row['phone']."'";
 $result = $server->query($sql);
 $row1 = mysqli_fetch_assoc($result);
 // $res['fname']=$row1['fname'];
 $row['turnover']=$row1['turnover'];
 $row['pro_turnover']=$row1['pro_turnover'];
 $row['fname']=$row1['fname'];
 $row['id_member']=$row1['id'];



 $query = $server->query('SELECT * FROM `withdraw` WHERE `phone`="'.$row['phone'].'" and status=1');
 $refill_check = $query->num_rows;
 $account = $query->fetch_assoc();




 $sql2="SELECT COUNT(id) as totalwd FROM withdraw WHERE `phone`='".$row['phone']."'and status=0";
 $result2 = $server->query($sql2);
 $row2 = mysqli_fetch_assoc($result2);

 $sql3="SELECT COUNT(id) as totalrf FROM refill WHERE `phone`='".$row['phone']."'";
 $result3 = $server->query($sql3);
 $row3 = mysqli_fetch_assoc($result3);

 $sql_refill = "SELECT * FROM refill WHERE phone='".$row['phone']."'  ORDER BY id DESC";
 $result_refill = $server->query($sql_refill);
 $row_refill = mysqli_fetch_assoc($result_refill);
 $status_bonus=$row_refill['status_bonus'];

 $sql_rfid2 = "SELECT * FROM history_promotion WHERE phone='".$row['phone']."' ORDER by id DESC";
 $result_rfid2 = $server->query($sql_rfid2);
 $row_bonus = mysqli_fetch_assoc($result_rfid2);


 preg_match('/%/',$row_bonus['promotion'], $output_array);
 $check1=$output_array[0];
 if ($check1=='%') {
   $row['pro_detail']=$row_bonus['name']." โปร ".$row_bonus['promotion']." รับเงิน ".$row_bonus['credit']." ทำเทิร์น ".$row_bonus['turnover'];
 }else{
  $row['pro_detail']=$row_bonus['name']."ฝาก ".$row_bonus['promotion']." รับเงิน ".$row_bonus['credit']." ทำเทิร์น ".$row_bonus['turnover'];
}



$row['status_bonus']=$row_refill['status_bonus'];

if($row2['totalwd'] == 0){
 $row['status_member']='สมาชิกใหม่';
}else{
 $row['status_member']='สมาชิกเก่า';
}

$row['refill_total']=$row3['totalrf'];
$row['withdraw_total']=$row2['totalwd'];


array_push($res,$row);

}
$sql1 = 'SELECT * FROM  `website`';
$result1 = $server->query($sql1);
$row1 = mysqli_fetch_assoc($result1);

include 'api_betflix.php';
$date_now=date('Y-m-d');
$refund=$api->Winlose($row['username_game'],$date_now,$date_now);

//print_r($res);

//echo "username=".$row['username_game'];
//echo ",refund=".$refund;

?>




<div class="page-holder bg-gray-100">
  <div class="container-fluid px-lg-4 px-xl-5">

    <section>
      <div class="row">
        <div class="col">
          <div class="card mb-4">
            <div class="card-header">

              <br>

              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="basic-addon1">key ถอนเงิน</span>
                </div>
                <input type="text" class="form-control" placeholder="key ถอนเงิน" aria-label="key_adminwd" id="keyinput_adminwd" aria-describedby="basic-addon1">
              </div>

            </div>
            <div class="card-body">

              <div class="container">
                <div class="row">
                  <?php

                  // print_r($res);

                  $i=1; foreach ($res as $key => $value){?>
                    <div class="col-xs-12 col-sm-6 col-md-3">
                     <div class="card mt-3">
                      <div align="center" class="card-header">
                       <h3> <strong>ยอดถอน:</strong> <?=number_format($value ['credit'],2) ?>   <button class="btn btn-primary mt-2" id="tranfer<?=$i ?>" onclick="viwe_member(<?=$value ['id_member'] ?>)"><i class="fas fa-user-lock"></i> ประวัติ สมาชิก</button></h3><hr>
                       <h5 style="color:red;"><?=$value ['status_member'] ?></h5><hr>
                       <strong> สมาชิก:  ฝากเงิน <?=$value ['refill_total'] ?> ครั้ง</strong><br><hr>
                       <strong>สมาชิก: ถอนเงิน <?=$value ['withdraw_total'] ?> ครั้ง</strong> <br><hr>
                       <strong>สถานะ:  
                         <?php
                       if ( $value['status_bonus']==1) {
                         echo "<strong><span style='color: red'>รับโบนัส</span></strong><br><hr>";
                       }else{
                         echo "<strong><span style='color: red'>ไม่รับโบนัส</span></strong>";
                       }

                      if ( $value['status_bonus']==1) {
                        echo $value['pro_detail'];
                      }

                     ?> </strong> <hr>
                     <strong>ยอดได้เสีย: <?php echo $refund; ?></strong> <br><hr>
                     <?php if($row1['turnover']==0){ ?>
                      <p><strong style="color:green;">ทำเทรินครบ</strong></p><hr>
                     <?php }else{ ?>
                      <p><strong style="color:red;">ทำเทรินไม่ครบ</strong></p><hr>
                     <?php } ?>
                     <p>  <strong>เบอร์:</strong> <?=$value ['phone'] ?></p><hr>
                     <p>  <strong>ชื่อผู้ใช้:</strong> <?php echo $row1['agent_username']; ?><?=$value ['username_game'] ?></p><hr>
                     <p>  <strong>วัน/เวลา:</strong> <?=$value['date_withdraw'] ?> <?=$value['time_withdraw'] ?></p><hr>
                     <p>  <strong>เครดิต:</strong> <input type="" id="balance<?=$value ['id'] ?>"  class="form-control" value="<?=number_format($value ['credit'],2) ?>"></p><hr>
                     <p>  <strong>ชื่อ-สกุล:</strong> <?=$value ['fname'] ?></p><hr>
                     <p>  <strong>เลขที่บัญชี:</strong> <?=$value ['bank_number'] ?></p><hr>
                     <p>  <strong>ธนาคาร:</strong> <?=$value ['bank_name'] ?></p><hr>
                     <p>  <strong>หมายเหตุ:</strong>  <textarea class="form-control" id="description<?=$value ['id'] ?>" id="exampleFormControlTextarea1" rows="3" style="height: 36px;"></textarea></p><hr>
                     <div align="center">
                      <p> <button class="btn btn-primary mt-2" id="tranfer_auto<?=$value ['id'] ?>" onclick="withdraw(<?=$value ['id'] ?>)"><i class="fas fa-comment-dollar"></i> โอนเงินอัตโนมัติ</button>
                        <!--<button class="btn btn-warning  mt-2" id="tranfer<?=$i ?>" onclick="withdraw_mannal(<?=$value ['id'] ?>)"><i class="fas fa-comment-dollar"></i> โอนด้วยตัวเอง</button><br>-->
                        <button class="btn btn-danger mt-2" id="cancel_tranfer<?=$value ['id'] ?>" onclick="cancel(<?=$value ['id'] ?>)"><i class="fas fa-times"></i> ยกเลิก</button></p><hr>
                      </div>
                    </div>
                    
                  </div>  
                </div>
                <?php $i++; }  ?>

              </div>
            </div>











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

  window.onload = function() {

    document.getElementById("keyinput_adminwd").value=localStorage.getItem("keyinput_adminwd");


  }



  function viwe_member(data) {
    window.open('./member_data.php?page=info&id='+data+'', '_blank');
  }


  function withdraw_mannal(data) {
   var id=data;
   var balance=$("#balance"+id).val();
   Swal.fire({
    title: 'คุณแน่ใจไหม?',
    text: "ถอนเงิน "+balance+" บาท",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'ยืนยัน ลบ'
  }).then((result) => {
    if (result.value) {

     $.ajax({
      url:'action.php?withdraw_mannal',
      type:'POST',
      data:{
       id:id,
       balance:balance
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



function withdraw(data) {
 var id=data;
 var balance=$("#balance"+id).val();
 var keyinput_adminwd=$("#keyinput_adminwd").val();
 document.getElementById("tranfer_auto"+data).disabled = true;
 
 if (keyinput_adminwd=="") {
   Swal.fire({
    icon: 'error',
    title: 'แจ้งเตือน...',
    text: 'กรุณาใส่ key'

  })

 }
 localStorage.setItem("keyinput_adminwd",keyinput_adminwd);
 Swal.fire({
  title: 'คุณแน่ใจไหม?',
  text: "ถอนเงิน "+balance+" บาท",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'ยืนยัน ลบ'
}).then((result) => {
  if (result.value) {
   showModal();
   $.ajax({
    url:'action.php?withdraw_bank',
    type:'POST',
    data:{
      id:id,
      balance:balance,
      keyinput_adminwd:keyinput_adminwd
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
    }
  });

 }
})



}


function cancel(data) {
  var id=data;
  var description=$("#description"+id).val();
  document.getElementById("cancel_tranfer"+id).disabled = true;



  if (description=="") {
   Swal.fire({
    icon: 'error',
    title: 'แจ้งเตือน...',
    text: 'กรุณาใส่ หมายเหตุ'

  })
   return false
 }
 showModal();
 $.ajax({
  url:'action.php?cancel',
  type:'POST',
  data:{
    id:id,
    description:description
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
  }
});

}

</script>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.9/js/responsive.bootstrap4.min.js"></script>

