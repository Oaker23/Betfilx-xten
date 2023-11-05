<?php

include '../config/config.php';

if($_SESSION["username"] == "") {

  echo " <script> window.open('./login');</script>";

  exit();
}

$sql = 'SELECT * FROM  `website`';
$result = $server->query($sql);
$row = mysqli_fetch_assoc($result);


if(isset($_POST['submit'])){
  $countfiles = count($_FILES['file']['name']);
  for($i=0;$i<$countfiles;$i++){
    $filename = $_FILES['file']['name'];
    $extension = pathinfo($filename[$i] , PATHINFO_EXTENSION);
    move_uploaded_file($_FILES['file']['tmp_name'][$i],'upload/logo.'.$extension);
  }
} 




?>
<?php
$sqlInfo = "SELECT * FROM website LIMIT 1";

$resultInfo = $server->query($sqlInfo);
$rowInfo = mysqli_fetch_assoc($resultInfo);
?>



<div class="page-holder bg-gray-100">
  <div class="container-fluid px-lg-4 px-xl-5">

    <section>
      <div class="row">
        <div class="col">
          <div class="card mb-4">
            <div class="card-header">
              <h4>ข้อมูล เว็บไซต์</h4>
            </div>
            <div class="card-body">

							<div class="table-responsive">
              <table class="table">
                <thead>
                  <tr>
                    <th>ลำดับ</th>
                    <th>หัวข้อ</th>
                    <th>ข้อมูล</th>

                  </tr>
                </thead> 
                <tbody>

                  <tr>
                    <td>1</td>
                    <td width="20%">
                      <img width="100%" src="<?php echo $rowInfo['logo']; ?>">
                    </td>
                    <td>
                      <div class="mb-3">
                        
                        <!-- <form method='post' action='' enctype='multipart/form-data'> -->
                          <input type="file" name="file" id="image">
                          <!-- <input type='submit' class="btn btn-success" name='submit' value='อัพโหลด'> -->
                        <!-- </form> -->
                        <div class="alert alert-danger text-center mt-3" role="alert"> นามสกุลไฟล์ รองรับ PNG</div>
                      </div>

                    </td>

                    </tr>
                    <tr>
                      <td>2</td>
                      <td>
                        <img width="100%" src="<?php echo $rowInfo['icon']; ?>">
                      </td>
                      <td>
                      <div class="mb-3">
                        
                        <!-- <form method='post' action='' enctype='multipart/form-data'> -->
                          <input type="file" name="fileIcon" id="fileIcon">
                          <!-- <input type='submit' class="btn btn-success" name='submit' value='อัพโหลด'> -->
                        <!-- </form> -->
                        <div class="alert alert-danger text-center mt-3" role="alert"> นามสกุลไฟล์ รองรับ ICO</div>
                      </div>

                      </td>

                    </tr>

                    <tr>
                      <td>3</td>
                      <td>หัวข้อเว็บ</td>
                      <td><input disabled class="form-control" type="text" id="title" value="<?php echo $row['title'] ?>"></td>

                    </tr>

                    <tr>
                      <td>4</td>
                      <td>คีย์เวิร์ด</td>
                      <td><input disabled class="form-control" type="text" id="keyword" value="<?php echo $row['keyword'] ?>"></td>

                    </tr>

                    <tr>
                      <td>5</td>
                      <td>โดเมนเนม</td>
                      <td><input disabled class="form-control" type="text" id="domain" value="<?php echo $row['domain'] ?>"></td>

                    </tr>

                    <tr>
                      <td>6</td>
                      <td>ไลน์ ติดต่อ</td>
                      <td><input disabled class="form-control" type="text" id="line" value="<?php echo $row['line_id'] ?>"></td>

                    </tr>


                    <tr>
                      <td>7</td>
                      <td>ไอดี เอเย่น</td>
                      <td><input disabled class="form-control" type="text" id="agent" value="<?php echo $row['agent_username'] ?>"></td>

                    </tr>


                    <tr>
                      <td>8</td>
                      <td>คืนยอดเสีย กี่%</td>
                      <td><input disabled class="form-control" type="text" id="refund" value="<?php echo $row['refund_percen'] ?>"></td>

                    </tr>


                    <tr>
                      <td>9</td>
                      <td>แนะนำเพื่อนกี่ %</td>
                      <td><input disabled class="form-control" type="text" id="affliliate" value="<?php echo $row['affliliate_percen'] ?>"></td>

                    </tr>

                   

                    <tr>
                      <td>11</td>
                      <td>ฝากเงิน ขึ้นต่ำ</td>
                      <td><input disabled class="form-control" type="text" id="minimum_deposit" value="<?php echo number_format($row['minimum_deposit'],2) ?>"></td>

                    </tr>

                    <tr>
                      <td>12</td>
                      <td>ถอนเงิน ขั้นต่ำ</td>
                      <td><input disabled class="form-control" type="text" id="minimum_withdraw" value="<?php echo number_format($row['minimum_withdraw'],2) ?>"></td>

                    </tr>

                  </tr>

                  <tr>
                    <td>13</td>
                    <td>ถอนเงิน สูงสุดต่อวัน</td>
                    <td><input disabled class="form-control" type="text" id="max_withdraw" value="<?php echo number_format($row['max_withdraw'],2) ?>"></td>

                  </tr>

                  <tr>
                    <td>14</td>
                    <td>ถอนเงิน ยอดเสีย ขั้นต่ำ</td>
                    <td><input disabled class="form-control" type="text" id="min_refund" value="<?php echo number_format($row['min_refund'],2) ?>"></td>

                  </tr>

                  <tr>
                    <td>15</td>
                    <td>ถอนเงิน แนะนำเพื่อน ขั้นต่ำ</td>
                    <td><input disabled class="form-control" type="text" id="min_affliliate" value="<?php echo number_format($row['min_affliliate'],2) ?>"></td>

                  </tr>

                  <tr>
                    <td>16</td>
                    <td>เปิด/ปิด หน้าบ้าน (1=เปิด,0=ปิด)</td>
                    <td><input disabled class="form-control" type="text" id="enable_webpage" value="<?php echo $row['enable_webpage'] ?>"></td>

                  </tr>


                </tbody>
              </table>
              </div>
              <div align="right">
                <button id="enabled" class="btn btn-warning text-uppercase" onclick="enabled()"><i class="far fa-edit"></i>แก้ไข</button>&nbsp;
                <button id="website" class="btn btn-primary text-uppercase" onclick="update_website()"><i class="fas fa-save"></i>บันทึก</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
</div>





<script type="text/javascript">

 window.onload = function() {
   document.getElementById("website").disabled = true;

 }


 function enabled() {

  document.getElementById("title").disabled = false;
  document.getElementById("keyword").disabled = false;
  document.getElementById("domain").disabled = false;
  document.getElementById("line").disabled = false;
  document.getElementById("agent").disabled = false;
  document.getElementById("refund").disabled = false;
  document.getElementById("affliliate").disabled = false;
  document.getElementById("minimum_deposit").disabled = false;
  document.getElementById("minimum_withdraw").disabled = false;
  document.getElementById("max_withdraw").disabled = false;
  document.getElementById("min_refund").disabled = false;
  document.getElementById("min_affliliate").disabled = false;
  document.getElementById("enable_webpage").disabled = false;
  document.getElementById("website").disabled = false;
  document.getElementById("enabled").disabled = true;
}


function update_website() {
  var title=$("#title").val();
  var keyword=$("#keyword").val();
  var domain=$("#domain").val();
  var line=$("#line").val();
  var agent=$("#agent").val();
  var refund=$("#refund").val();
  var affliliate=$("#affliliate").val();

  var minimum_withdraw=$("#minimum_withdraw").val();
  var minimum_deposit=$("#minimum_deposit").val();
  var max_withdraw=$("#max_withdraw").val();
  var min_refund=$("#min_refund").val();
  var min_affliliate=$("#min_affliliate").val();
  var enable_webpage=$("#enable_webpage").val();

  var file_data = $("#image").prop('files')[0];   
  var fileIcon = $("#fileIcon").prop('files')[0];   
  var form_data = new FormData();                  
  form_data.append('title', title);
  form_data.append('keyword', keyword);
  form_data.append('domain', domain);
  form_data.append('line', line);
  form_data.append('agent', agent);
  form_data.append('refund', refund);
  form_data.append('affliliate', affliliate);

  form_data.append('minimum_deposit', minimum_deposit);
  form_data.append('minimum_withdraw', minimum_withdraw);
  form_data.append('max_withdraw', max_withdraw);
  form_data.append('min_refund', min_refund);
  form_data.append('min_affliliate', min_affliliate);
  form_data.append('enable_webpage', enable_webpage);
  form_data.append('file', file_data);
  form_data.append('fileIcon', fileIcon);

  $.ajax({
    url:'action.php?update_website',
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
