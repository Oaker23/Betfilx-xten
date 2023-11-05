<?php
if($_SESSION["username"] == "") {

  echo " <script> window.open('./login');</script>";

  exit();
}
$actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

$url=str_replace("manager/main.php?page=cronjob","",$actual_link);

?>

<div class="page-holder bg-gray-100">
  <div class="container-fluid px-lg-4 px-xl-5">
    <!-- <h2>สร้างโค้ด รับเครดิต</h2> -->
        <section>
        <div class="card mb-4">
          <div class="card-header">
          <h4>ไฟล์ cronjob</h4> 
          </div>
          <div class="card-body">
            <div class="row mx-4 my-4">
       <table class="table table-striped mt-2">
  <thead>
    <tr>
      <th>No</th>
      <th>ชื่อ</th>
      <th>URL</th>
      <th>Copy</th>
    </tr>
  </thead> 
  <tbody>
    
    <tr>
      <td>1</td>
      <td>เพิ่มเครดิต แบบQR CODE</td>
      <td><input class="form-control" type="text" id="url1" value="<?php echo $url?>add_credit_QR.php"></td>
      <td><button type="button" class="btn btn-success" onclick="copy_data(1)">Copy</button></td>
    </tr>

   <tr>
      <td>2</td>
      <td>เพิ่มเครดิต แบบเลขบันชี</td>
      <td><input class="form-control" type="text" id="url2" value="<?php echo $url?>add_credit_scb.php"></td>
      <td><button type="button" class="btn btn-success" onclick="copy_data(2)">Copy</button></td>
    </tr>

   <tr>

    <tr>
      <td>3</td>
      <td>บันทึกเครดิต scb</td>
      <td><input class="form-control" type="text" id="url3" value="<?php echo $url?>cronjob_credit_scb.php"></td>
      <td><button type="button" class="btn btn-success" onclick="copy_data(3)">Copy</button></td>
    </tr>

   <tr>

    <tr>
      <td>4</td>
      <td>บันทึกเครดิต mamanee</td>
      <td><input class="form-control" type="text" id="url4" value="<?php echo $url?>cronjob_credit_mamanee.php"></td>
      <td><button type="button" class="btn btn-success" onclick="copy_data(4)">Copy</button></td>
    </tr>


   <tr>

      <td>5</td>
      <td>สต้อค สมาชิก</td>
      <td><input class="form-control" type="text" id="url5" value="<?php echo $url?>cronjob_register.php"></td>
      <td><button type="button" class="btn btn-success" onclick="copy_data(5)">Copy</button></td>
    </tr>

    <tr>
      <td>6</td>
      <td>บันทึกข้อมูลการเล่นสมาชิก</td>
      <td><input class="form-control" type="text" id="url6" value="<?php echo $url?>cronjob_report_game.php"></td>
      <td><button type="button" class="btn btn-success" onclick="copy_data(6)">Copy</button></td>
    </tr>


<!-- <tr>

      <td>6</td>
      <td>บอทดึงยอดเสีย</td>
      <td><input class="form-control" type="text" id="url6" value="<?php echo $url?>bot_report.php"></td>
      <td><button type="button" class="btn btn-success" onclick="copy_data(6)">Copy</button></td>
    </tr> -->

  </tbody>
</table>
</div>



          </div>
        </div>
          
        </section>


  </div>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script>
  $(window).on("load",function(){
  $(".loader-wrapper").fadeOut("slow");
  });
</script>
<script>
  function copy_data(id) {
    var copyText = document.getElementById("url"+id);
    copyText.select();
    copyText.setSelectionRange(0, 99999)
    document.execCommand("copy");

    Swal.fire(
      'สำเร็จ!',
      'success'
      )

  }

</script>