<?php include('dashboard_header.php'); ?>
<!-- เรียกใช้ Sidebar--------------------------- -->
<!-- <?php //include('navbar.php'); ?> -->
<!-- <div class="wrapermenucon">
   <button class="wrapper-menu  sidebarCollapse"  aria-label="Main Menu">
   <svg width="40" height="40" viewBox="0 0 100 100">
   <path class="line line1" d="M 20,29.000046 H 80.000231 C 80.000231,29.000046 94.498839,28.817352 94.532987,66.711331 94.543142,77.980673 90.966081,81.670246 85.259173,81.668997 79.552261,81.667751 75.000211,74.999942 75.000211,74.999942 L 25.000021,25.000058" />
   <path class="line line2" d="M 20,50 H 80" />
   <path class="line line3" d="M 20,70.999954 H 80.000231 C 80.000231,70.999954 94.498839,71.182648 94.532987,33.288669 94.543142,22.019327 90.966081,18.329754 85.259173,18.331003 79.552261,18.332249 75.000211,25.000058 75.000211,25.000058 L 25.000021,74.999942" />
   </svg>
   </button>
   </div> -->
<!-- เรียกใช้ Sidebar--------------------------- -->






<form>
   <div style="padding: 5px;">
      <div data-aos="fade-left" class="containregister boxcolor">
         <div class="logologin" style="padding-top: 10px;">
           <img class="imganimationlogin" src="images/logo/logotext.png">
         </div>
         <div style="text-align: center;margin-top: 10px;">
            <h4 class="textlogin">สมัครสมาชิก</h4>
         </div>
         <div id="hidefinish" style="margin-top: 30px;">
            <table style="width: 100%;text-align: center;">
               <tr>
                  <td class="tdstepregister headstep1 active">
                     <b>1</b><br><span>โทรศัพท์</span>
                  </td>
                  <td class="tdstepregister headstep2">
                     <b>2</b><br><span>ตั้งรหัสผ่าน</span>
                  </td>
                  <td class="tdstepregister headstep3">
                     <b>3</b><br><span>บัญชีธนาคาร</span>
                  </td>
                  <td class="tdstepregister headstep4">
                     <b style="padding: 0 5px;"><i class="fal fa-check"></i></b><br><span>สำเร็จ</span>
                  </td>
               </tr>
            </table>
         </div>




         <!-- ---------------------step1--------------------- -->
         <div class="stepre01 slideto containinlogin">
            <div style="margin-top: 30px;">
               <label for="exampleInputEmail1">เบอร์มือถือ</label>
               <div class="iconlogin">
                  <i class="fal fa-user" style="font-size: 20px;"></i>
               </div>
               <input type="text" maxlength="10"  class="form-control loginform01" name="phone_number" id="phone_number" aria-describedby="emailHelp" placeholder="กรอกเบอร์มือถือ">
            </div>
            <div class="btnofregister">
               <table style="width: 100%">
                  <tr>
                     <td class="tdbtnregister">
                        <button type="button" onclick="location.href='login.php'" class="btnbackregister bkcolor">ย้อนกลับ</button>
                     </td>
                     <td class="tdbtnregister">
                        <button type="button" id="btn-step1" class="btnnextregister mcolor">ถัดไป </button>
                     </td>
                  </tr>
               </table>
            </div>
         </div>
         <!-- ---------------------End step1--------------------- -->



         <!-- ---------------------step2----------------------------- -->
         <div class="stepre02 slideto containinlogin">
            <div style="margin-top: 30px;">
               <label for="exampleInputEmail1">รหัสผ่าน</label>
               <div class="iconlogin">
                  <i class="fal fa-user" style="font-size: 20px;"></i>
               </div>
               <input type="password" maxlength="10"  class="form-control loginform01" name="phone_number" id="phone_number" aria-describedby="emailHelp" placeholder="รหัสผ่าน">
            </div>
            <div style="margin-top: 10px;">
               <label for="exampleInputEmail1">ยืนยันรหัสผ่าน</label>
               <div class="iconlogin">
                  <i class="fal fa-user" style="font-size: 20px;"></i>
               </div>
               <input type="password" maxlength="10"  class="form-control loginform01" name="phone_number" id="phone_number" aria-describedby="emailHelp" placeholder="ยืนยันรหัสผ่าน">
            </div>
            <div class="btnofregister">
               <table style="width: 100%">
                  <tr>
                     <td class="tdbtnregister">
                        <button type="button" id="btn-back1" class="btnbackregister bkcolor">ย้อนกลับ</button>
                     </td>
                     <td class="tdbtnregister">
                        <button type="button" id="btn-step2" class="btnnextregister mcolor">ถัดไป</button>
                     </td>
                  </tr>
               </table>
            </div>
         </div>
         <!-- ---------------------END step2--------------------- -->



         <!-- ---------------------step3--------------------- -->
         <div class="stepre03 slideto containinlogin">
            <div style="margin-top: 30px;">
               <label for="exampleInputEmail1">ธนาคาร</label>
               <div class="iconlogin">
                  <i class="fal fa-university font-size: 20px;"></i>
               </div>
               <input type="text" maxlength="10" readonly class="form-control loginform01 open_select_bank" style="cursor: pointer;" placeholder="เลือกธนาคาร">
               <input type="text" name="financial_service_provider_id" id="financial_service_provider_id" value="" hidden >

            </div>
            <div style="margin-top: 10px;">
               <label for="exampleInputEmail1">ชื่อบัญชี</label>
               <div class="iconlogin">
                  <i class="fal fa-user" style="font-size: 20px;"></i>
               </div>
               <input type="password" maxlength="10"  class="form-control loginform01" name="name" id="name" aria-describedby="emailHelp" placeholder="กรอกชื่อบัญชี">
            </div>
            <div style="margin-top: 10px;">
               <label for="exampleInputEmail1">หมายเลขบัญชี</label>
               <div class="iconlogin">
                  <i class="fal fa-sort-numeric-up-alt" style="font-size: 20px;"></i>
               </div>
               <input type="password" maxlength="10"  class="form-control loginform01" name="account_number" id="account_number" aria-describedby="emailHelp" placeholder="กรอกหมายเลขบัญชี">
            </div>
            <div style="margin-top: 10px;">
               <label for="exampleInputEmail1">คุณรู้จักเราจากไหน</label>
               <div class="iconlogin">
                  <i class="fal fa-bullhorn" style="font-size: 20px;"></i>
               </div>
               <select class="form-control loginform01" id="register_channel_id" name="register_channel_id" required="">
                  <option value="">เลือกช่องทาง</option>
                  <option value="1">FaceBook</option>
                  <option value="2">Line</option>
                  <option value="3">Google</option>
                  <option value="4">Instargram</option>
                  <option value="5">Youtube</option>
                  <option value="6">SMS</option>
                  <option value="7">เพื่อนแนะนำ</option>
               </select>
            </div>
            <div id="friendinput" style="margin-top: 10px;">
               <label for="exampleInputEmail1">เบอร์มือถือเพื่อน</label>
               <div class="iconlogin">
                  <i class="fal fa-user-friends" style="font-size: 20px;"></i>
               </div>
               <input type="password" maxlength="10"  class="form-control loginform01" name="account_number" id="account_number" aria-describedby="emailHelp" placeholder="เบอร์มือถือเพื่อน">
            </div>
            <div class="btnofregister">
               <table style="width: 100%">
                  <tr>
                     <td class="tdbtnregister">
                        <button type="button" id="btn-back2" class="btnbackregister bkcolor">ย้อนกลับ</button>
                     </td>
                     <td class="tdbtnregister">
                        <button type="button" id="btn-step3" class="btnnextregister mcolor">ยืนยัน</button>
                     </td>
                  </tr>
               </table>
            </div>
         </div>
         <!-- ---------------------END step3--------------------- -->



         <!-- ---------------------step4--------------------- -->
         <div class="stepre04 slideto containinlogin">
            <div style="text-align: center;margin-top: 20px;
               margin-bottom: 10px;"><i class="far fa-check checkfinish"></i></div>
            <div class="finishregister">
               <span>สมัครสมาชิกสำเร็จ</span> <br>
               กำลังพาท่านเข้าสู่ระบบ กรุณารอสักครู่ <i class="fad fa-spinner-third fa-spin "></i>
            </div>
         </div>
         <!-- ---------------------END step4--------------------- -->


      </div>
   </div>
</form>



<div class="bankselectpopup" style="padding:0 20px;">
   <div class="inbankselectpopup bkcolor">
      <button class="btnclosebankselect"><i class="fal fa-times"></i></button>
   <table>
      <tr>
         <td><img class="selectbank" name="กรุงเทพ (BBL)" alt="1" src="images/bank/bangkok.svg"><br> กรุงเทพ (BBL)</td>
         <td><img class="selectbank" name="กสิกรไทย (KBANK)" alt="2" src="images/bank/kbank.svg"><br> กสิกรไทย (KBANK)</td>
      </tr>
      <tr>
         <td><img class="selectbank" name="กรุงไทย (KTB)" alt="3" src="images/bank/krungthai.svg"><br> กรุงไทย (KTB)</td>
         <td><img class="selectbank" name="ทหารไทย (TMB)" alt="4" src="images/bank/tmb.svg"><br> ทหารไทย (TMB)</td>
      </tr>
      <tr>
         <td><img class="selectbank" name="ไทยพาณิชย์ (SCB)" alt="5" src="images/bank/scb.svg"><br> ไทยพาณิชย์ (SCB)</td>
         <td><img class="selectbank" name="ซีไอเอ็มบีไทย (CIMB)" alt="6" src="images/bank/cimb.svg"><br> ซีไอเอ็มบีไทย (CIMB)
         </td>
      </tr>
      <tr>
         <td><img class="selectbank" name="ยูโอบี (UOB)" alt="7" src="images/bank/uob.svg"><br> ยูโอบี (UOB)</td>
         <td><img class="selectbank" name="กรุงศรีอยุธยา (BAY)" alt="8" src="images/bank/krungsri.svg"><br> กรุงศรีอยุธยา (BAY)
         </td>
      </tr>
      <tr>
         <td><img class="selectbank" name="ออมสิน (GSB)" alt="9" src="images/bank/aomsin.svg"><br> ออมสิน (GSB)</td>
         <td><img class="selectbank" name="ธกส. (BAAC)" alt="10" src="images/bank/baac.svg"><br> ธกส. (BAAC)</td>
      </tr>
      <tr>
         <td><img class="selectbank" name="ธนชาต (TBANK)" alt="11" src="images/bank/tnc.svg"><br> ธนชาต (TBANK)</td>
         <td><img class="selectbank" name="ทิสโก้ (TISCO)" alt="12" src="images/bank/tisco.svg"><br> ทิสโก้ (TISCO)</td>
      </tr>
      <tr>
         <td><img class="selectbank" name="เกียรตินาคิน (KKP)" alt="13" src="images/bank/kiatnakin.svg"><br> เกียรตินาคิน (KKP)</td>
         <td><img class="selectbank" name="แลนด์แอนด์เฮ้าส์ (LHFG)" alt="14" src="images/bank/lh.svg"><br> แลนด์แอนด์เฮ้าส์ (LHFG)</td>
      </tr>
   </table>
</div>
</div>




<?php  include('dashboard_footer.php'); ?>



<script type="text/javascript">

$('.selectbank').click(function(){
      $('#financial_service_provider_id').val($(this).attr('alt'));
      $('.open_select_bank').val($(this).attr('name'));
       $('.inbankselectpopup').addClass("closeanimationselectbank");
         setTimeout(function(){ 
            $('.bankselectpopup').hide();
          }, 400);
});
$('.btnclosebankselect').click(function(){
         $('.inbankselectpopup').addClass("closeanimationselectbank");
         setTimeout(function(){ 
            $('.bankselectpopup').hide();
          }, 400);
      
});


$('.open_select_bank').click(function(){
   $('.inbankselectpopup').removeClass("closeanimationselectbank");
      $('.bankselectpopup').show();
});






   $(".stepre02").hide();
   $(".stepre03").hide();
   $(".stepre04").hide();
   $("#friendinput").hide();
   
   
   // go step01 to step2
   document.getElementById("btn-step1").onclick = function(){
      $(".stepre01").hide();
      $(".stepre02").show();
      $(".headstep1").removeClass("active");
      $(".headstep2").addClass("active");
   };
   // back step2 to step1
   document.getElementById("btn-back1").onclick = function(){
      $(".stepre02").hide();
      $(".stepre01").show();
      $(".headstep2").removeClass("active");
      $(".headstep1").addClass("active");
   };
   
   
    // go step02 to step3
    document.getElementById("btn-step2").onclick = function(){
      $(".stepre02").hide();
      $(".stepre03").show();
      $(".headstep2").removeClass("active");
      $(".headstep3").addClass("active");
   };
   // back step3 to step2
   document.getElementById("btn-back2").onclick = function(){
      $(".stepre03").hide();
      $(".stepre02").show();
      $(".headstep3").removeClass("active");
      $(".headstep2").addClass("active");
   };
   
    // go step03 to step4
    document.getElementById("btn-step3").onclick = function(){
      $(".stepre03").hide();
      $(".stepre04").show();
      $(".headstep3").removeClass("active");
      $(".headstep4").addClass("active");

      setTimeout(function(){ location.href='index.php'; }, 2000);
   };
   
   
   $("#register_channel_id").on('keyup change', function(){
      if ($('#register_channel_id').val() == '7'){ 
       $('#friendinput').show();
    } else{
       $('#friendinput').hide();
    }  
   });
</script>