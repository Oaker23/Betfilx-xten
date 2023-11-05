<?php 
error_reporting(0);
if (!isset($_SESSION)) {
  session_start();
}
if($_SESSION["phone"] != "") {
  echo " <script> window.location = './dashboard';</script>";
}

require 'config/config.php';
include('dashboard_header.php'); 

$phone = @$_GET['ref'];

$sqlInfo = "SELECT * FROM website";
$resultInfo = $server->query($sqlInfo);
$rowInfo = mysqli_fetch_assoc($resultInfo);

function get_client_ip() {
	$ipaddress = '';
	if (getenv('HTTP_CLIENT_IP'))
		$ipaddress = getenv('HTTP_CLIENT_IP');
	else if(getenv('HTTP_X_FORWARDED_FOR'))
		$ipaddress = getenv('HTTP_X_FORWARDED_FOR');
	else if(getenv('HTTP_X_FORWARDED'))
		$ipaddress = getenv('HTTP_X_FORWARDED');
	else if(getenv('HTTP_FORWARDED_FOR'))
		$ipaddress = getenv('HTTP_FORWARDED_FOR');
	else if(getenv('HTTP_FORWARDED'))
		$ipaddress = getenv('HTTP_FORWARDED');
	else if(getenv('REMOTE_ADDR'))
		$ipaddress = getenv('REMOTE_ADDR');
	else
		$ipaddress = 'UNKNOWN';
	return $ipaddress;
}

?>

<div style="padding:0 5px;">
   <div data-aos="fade-right" class="containlogin boxcolor">
      <div class="logologin">
         <img class="imganimationlogin" src="./manager/<?php echo $rowInfo['logo']; ?>">
      </div>
      <div class="containinlogin">
         <div style="text-align: center;margin-top: 10px;">
            <h4 class="textlogin">เข้าสู่ระบบ</h4>
         </div>
         <div style="margin-top: 10px;">
            <label for="exampleInputEmail1">เบอร์โทรศัพท์</label>
            <div class="iconlogin">
               <i class="fal fa-user" style="font-size: 20px;"></i>
            </div>
            <input id="phone" type="number" class="form-control loginform01" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="เบอร์โทรศัพท์">
         </div>
         <div style="margin-top: 20px;">
            <label for="exampleInputEmail1">รหัสผ่าน</label>
            <div class="iconlogin">
               <i class="fal fa-lock" style="font-size: 20px;"></i>
            </div>
            <input id="password" type="password" class="form-control loginform01" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="รหัสผ่าน">
         </div>
      </div>
      <div style="text-align: center; margin-top: 40px;">
         <button class="mcolor colorbtn01" onclick="login()"><i class="fal fa-sign-in"></i> เข้าสู่ระบบ</button>
      </div>
      <div onclick="location.href='/register'" class="needregister bkcolor"><i class="fal fa-user-plus"></i> สมัครสมาชิก</div>
      <div onclick="location.href='http://line.me/ti/p/~<?php echo $rowInfo['line_id']; ?>'" class="needregister bkcolor"><i class="fa fa-comment" aria-hidden="true"></i> ลืมรหัสผ่าน</div>
   </div>
</div>


<?php  include('dashboard_footer.php'); ?>

<script>

   window.onload = function(){
		localStorage.setItem("ref", '<?php echo $phone; ?>');
		var ref = localStorage.getItem("ref");

    //   console.log("onload phone=",localStorage.getItem('phone'));
    //   console.log("onload password=",localStorage.getItem('password'));
    //   console.log("onload ref=",localStorage.getItem('ref'));

      	document.getElementById('phone').value =localStorage.getItem('phone');
		document.getElementById('password').value =localStorage.getItem('password');
	}

   function login() {
		var phone=$("#phone").val();
		var password=$("#password").val();

		if (phone=="") {
			Swal.fire({
				icon: 'error',
				title: 'แจ้งเตือน...',
				text:'กรุณากรอก เบอร์โทรศัพท์'

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
			url:'action.php?login',
			type:'POST',
			data:{
				phone:phone,
				password:password
			},
			success:function(data){
			// console.log(data);
			   if (data!="") {
			   	var obj = JSON.parse(data);
			   	var msg=obj.msg
			   	var status=obj.status
			   	if (status==200) {
					   localStorage.setItem("phone", phone);
                  localStorage.setItem("password", password);

			   		location.replace("./dashboard");
			   	}else{
			   		Swal.fire({
			   			icon: 'error',
			   			title: msg,
			   			// text: "ชื่อผู้ใช้ หรือ รหัสผ่านไม่ถูกต้อง"
			   		})
			   	}
			   }
		   }
		});
	}
</script>

