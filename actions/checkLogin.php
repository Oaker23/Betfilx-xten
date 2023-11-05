<?php
	session_start();
    include "../config/config.php";
	$username = mysqli_real_escape_string($server, $_POST["phone"]);  
	$password = mysqli_real_escape_string($server, md5($_POST["password"]));  
	$query = 'SELECT * FROM `member` WHERE `phone`="'.$username.'" and password="'.$password.'"';
	$result = $server->query($query);
	$row = mysqli_fetch_assoc($result);
	if(!$row){
		$data = array ('msg'=>' ชื่อผู้ใช้์ หรือ รหัสผ่านไม่ถูกต้อง','status'=>500);
		echo json_encode($data);

	}else {

		// updateLastLogin($_POST["phone"]);
        $user = $_POST["phone"];
        $date_check=date("d/m/Y");
        $sql="UPDATE `member` SET `last_login`='".$date_check."' WHERE phone='".$user."'";
        $result = $server->query($sql);
        if ($result === TRUE) {
            $data = array ('msg'=>'เข้าระบบ สำเร็จ!','status'=>200);
            echo json_encode($data);
    
        }
		
		//*** Session
		$_SESSION["phone"]=$row["phone"];
		session_write_close();


	}
?>