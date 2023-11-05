<?php 
error_reporting(0);
if (!isset($_SESSION)) {
  session_start();
}
if($_SESSION["phone"] != "") {
  echo " <script> window.location = './login';</script>";
}

require 'config/config.php';
include('dashboard_header.php'); 

$phone = @$_GET['ref'];

$sqlInfo = "SELECT * FROM website";
$resultInfo = $server->query($sqlInfo);
$rowInfo = mysqli_fetch_assoc($resultInfo);

?>

<form>
   <div style="padding: 5px;">
      <div data-aos="fade-left" class="containregister boxcolor">
         <div class="logologin" style="padding-top: 10px;">
           <img class="imganimationlogin" src="./manager/<?php echo $rowInfo['logo']; ?>">
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
               <input type="text" maxlength="10"  class="form-control loginform01" name="phone" id="phone" aria-describedby="emailHelp" placeholder="กรอกเบอร์มือถือ">
            </div>
            <div class="btnofregister">
               <table style="width: 100%">
                  <tr>
                     <td class="tdbtnregister">
                        <button type="button" onclick="location.href='/login'" class="btnbackregister bkcolor">ย้อนกลับ</button>
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
               <input type="password" maxlength="30"  class="form-control loginform01" name="password" id="password" aria-describedby="emailHelp" placeholder="รหัสผ่าน">
            </div>
            <div style="margin-top: 10px;">
               <label for="exampleInputEmail1">ยืนยันรหัสผ่าน</label>
               <div class="iconlogin">
                  <i class="fal fa-user" style="font-size: 20px;"></i>
               </div>
               <input type="password" maxlength="30"  class="form-control loginform01" name="password_confirm" id="password_confirm" aria-describedby="emailHelp" placeholder="ยืนยันรหัสผ่าน">
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
               <input type="text" name="select_bank" id="select_bank" value="" hidden >
            </div>
            <div style="margin-top: 10px;">
               <label for="exampleInputEmail1">หมายเลขบัญชี</label>
               <div class="iconlogin">
                  <i class="fal fa-sort-numeric-up-alt" style="font-size: 20px;"></i>
               </div>
               <input type="number" maxlength="10"  class="form-control loginform01" name="account_number" id="bank_number" aria-describedby="emailHelp" placeholder="กรอกหมายเลขบัญชี">
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
         <td><img class="selectbank" name="กรุงเทพ (BBL)" alt="กรุงเทพ" src="images/bank/bangkok.svg"><br> กรุงเทพ (BBL)</td>
         <td><img class="selectbank" name="กสิกรไทย (KBANK)" alt="กสิกรไทย" src="images/bank/kbank.svg"><br> กสิกรไทย (KBANK)</td>
      </tr>
      <tr>
         <td><img class="selectbank" name="กรุงไทย (KTB)" alt="กรุงไทย" src="images/bank/krungthai.svg"><br> กรุงไทย (KTB)</td>
         <td><img class="selectbank" name="ทหารไทย (TMB)" alt="ทหารไทย" src="images/bank/tmb.svg"><br> ทหารไทย (TMB)</td>
      </tr>
      <tr>
         <td><img class="selectbank" name="ไทยพาณิชย์ (SCB)" alt="ไทยพาณิชย์" src="images/bank/scb.svg"><br> ไทยพาณิชย์ (SCB)</td>
         <td><img class="selectbank" name="กรุงศรีอยุธยา (BAY)" alt="กรุงศรีฯ" src="images/bank/krungsri.svg"><br> กรุงศรีอยุธยา (BAY)</td>
      </tr>
      <tr>
         <td><img class="selectbank" name="ออมสิน (GSB)" alt="ออมสิน" src="images/bank/aomsin.svg"><br> ออมสิน (GSB)</td>
         <td><img class="selectbank" name="ธกส. (BAAC)" alt="ธกส" src="images/bank/baac.svg"><br> ธกส. (BAAC)</td>
      </tr>
   </table>
</div>
</div>


<?php  include('dashboard_footer.php'); ?>

<script>
   window.onload = function(){
		localStorage.setItem("ref", '<?php echo $phone; ?>');
		var ref = localStorage.getItem("ref");
	}

   $('.selectbank').click(function(){
      $('#select_bank').val($(this).attr('alt'));
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
		if($("#phone").val()){
			$(".stepre01").hide();
    		$(".stepre02").show();
    		$(".headstep1").removeClass("active");
    		$(".headstep2").addClass("active");
		}else{
			Swal.fire({
                icon: 'error',
                title: 'แจ้งเตือน...',
                html: "กรุณากรอก เบอร์มือถือ"
            });
		}
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
		if(!$("#password").val()){
			Swal.fire({
                icon: 'error',
                title: 'แจ้งเตือน...',
                html: "กรุณากรอก รหัสผ่าน"
            });
		}else{
			if($("#password").val() == $("#password_confirm").val()){
				$(".stepre02").hide();
      			$(".stepre03").show();
      			$(".headstep2").removeClass("active");
      			$(".headstep3").addClass("active");
			}else{
				Swal.fire({
        	        icon: 'error',
        	        title: 'แจ้งเตือน...',
        	        html: "รหัสผ่านยืนยันไม่ถูกต้อง"
        	    });
			}
		}

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
		register();
   };
   

   function register(confirm_code=0) {
    	var phone=$("#phone").val();
    	var password=$("#password").val();
    	var bank_number=$("#bank_number").val();
    	var bank_name=$("#select_bank").val();
		var confirm_code=confirm_code;
        var ref = localStorage.getItem("ref");

        var form_data = new FormData();                  
        form_data.append('phone', phone);
        form_data.append('password', password);
        form_data.append('bank_number', bank_number);
        form_data.append('bank_name', bank_name);
        form_data.append('ref', ref);
        form_data.append('confirm_code', confirm_code);

		// for (var pair of form_data.entries()) {
		//     console.log("form_data=",pair[0]+ ' -> ' + pair[1]); 
		// }
		// return false;
        
        if (bank_number=="") {
            Swal.fire({
                icon: 'error',
                title: 'แจ้งเตือน...',
                text:'กรุณากรอก เลขบัญชีธนาคาร'

            })
            return false
        } else if (bank_name=="เลือก ธนาคาร") {
            Swal.fire({
                icon: 'error',
                title: 'แจ้งเตือน...',
                text:'เลือก ธนาคาร'

            })
            return false
        } else if (phone=="") {
            Swal.fire({
                icon: 'error',
                title: 'แจ้งเตือน...',
                text:'กรุณากรอก เบอร์มือถือ'

            })
            return false
        } else if (password=="") {
            Swal.fire({
                icon: 'error',
                title: 'แจ้งเตือน...',
                text:'กรุณากรอก รหัสผ่าน'

            })
            return false

        } 

        $.ajax({
            url: 'action.php?register',
            type: 'POST',
            contentType: false,
            processData: false,
            data : form_data,
            timeout: 3000,
            error: function() {
                Swal.fire({
                    icon: 'error',
                    title: 'แจ้งเตือน...',
                    text: 'หมดเวลาเชื่อมต่อ กรุณาทำรายการใหม่อีกครั้ง'
                })
            },
            success: function(data) {
               //   console.log("data=",data);
                if (data != "") {
                    var obj = JSON.parse(data);
                    var msg = obj.msg
                    var status = obj.status
                    if (status == 200) {

						$(".stepre03").hide();
      					$(".stepre04").show();
      					$(".headstep3").removeClass("active");
      					$(".headstep4").addClass("active");
      					setTimeout(function(){ location.href='./dashboard'; }, 2000);

                        // Swal.fire({
                        //     title: 'แจ้งเตือน',
                        //     text: 'สมัครสมาชิกสำเร้จ',
                        //     icon: 'success',
                        //     showCancelButton: false,
                        //     confirmButtonColor: '#3085d6',
                        //     cancelButtonColor: '#d33',
                        //     confirmButtonText: 'OK'
                        // }).then((result) => {
                        //     if (result.value) {
                        //         location.replace("./dashboard");
                        //     }
                        // });

                    }else if (status == 202){
                        Swal.fire({
                          title: 'ยืนยันการสมัครสมาชิก ?',
                          html: "ชื่อ-นามสกุล : "+obj.msg+
                          "<br> เลขบัญชีธนาคาร : "+bank_number+
                          "<br> ธนาคาร : "+bank_name+
                          "<br> เบอร์โทร : "+phone,
                          showDenyButton: true,
                          showCancelButton: true,
                          confirmButtonText: 'ยืนยัน',
                          denyButtonText: `ยกเลิก`,
                        }).then((result) => {
                          if (result.isConfirmed) {
                            register(1)
                          } 
                        })
                    }
                    else {
                        Swal.fire({
                            icon: 'error',
                            title: 'แจ้งเตือน...',
                            html: msg
                        });
                    }
                }
				return false;
            }
        });
    }
</script>

