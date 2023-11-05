<?php 
// error_reporting(0);
// if (!isset($_SESSION)) {
//   session_start();
// }
// if($_SESSION["phone"] == "") {
//   echo " <script> window.location = './login';</script>";
// }

 require 'config/config.php';

include('dashboard_header.php'); 

?>


<div style="padding:0 5px;">
   <div data-aos="fade-right" class="containlogin boxcolor">
      <div class="logologin">
         <img class="imganimationlogin" src="images/logo/logotext.png">
      </div>
      <div class="containinlogin">
         <div style="text-align: center;margin-top: 10px;">
            <h4 class="textlogin">เข้าสู่ระบบ</h4>
         </div>
         <form>
            <div style="margin-top: 10px;">
               <label for="exampleInputEmail1">ชื่อผู้ใช้ / เบอร์โทรศัพท์</label>
               <div class="iconlogin">
                  <i class="fal fa-user" style="font-size: 20px;"></i>
               </div>
               <input type="email" class="form-control loginform01" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="ชื่อผู้ใช้ / เบอร์โทรศัพท์">
            </div>
            <div style="margin-top: 20px;">
               <label for="exampleInputEmail1">รหัสผ่าน</label>
               <div class="iconlogin">
                  <i class="fal fa-lock" style="font-size: 20px;"></i>
               </div>
               <input type="password" class="form-control loginform01" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="รหัสผ่าน">
            </div>
         </form>
      </div>
      <div style="text-align: center; margin-top: 40px;">
         <button class="mcolor colorbtn01" onclick="location.href='index.php'"><i class="fal fa-sign-in"></i> เข้าสู่ระบบ</button>
      </div>
      <div onclick="location.href='register.php'" class="needregister bkcolor"><i class="fal fa-user-plus"></i> สมัครสมาชิก</div>
   </div>
</div>


<?php  include('dashboard_footer.php'); ?>

