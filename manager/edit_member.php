<?php
error_reporting(0);

include("../config/config.php");




$sql = 'SELECT * FROM  `member` where id="'.$_POST['id'].'"';
$result = $server->query($sql);
$row = mysqli_fetch_assoc($result);
$phone=$row['phone'];
$fname=$row['fname'];
$bank_number=$row['bank_number'];
$bank_name=$row['bank_name'];
$id=$row['id'];
$status_turnover=$row['status_turnover'];
$affliliate_percen=$row['affliliate_percen'];
$refid=$row['refid'];


?>

<input class="form-control" type="hidden" id="e_id" placeholder="" value="<?php echo $id; ?>" aria-label="default input example">
<label class="mt-2">เบอร์</label>
<input class="form-control" type="text" id="e_phone" placeholder="เบอร์" value="<?php echo $phone; ?>" aria-label="default input example">
<label class="mt-2">รหัสผ่าน</label>
<input class="form-control" type="text" id="e_password" placeholder="รหัสผ่าน" value="" aria-label="default input example">
<label class="mt-2">ชื่อ-นามสกุล</label>
<input class="form-control" type="text" id="e_fname" placeholder="ชื่อ-นามสกุล" value="<?php echo $fname; ?>" aria-label="default input example">
<label class="mt-2">เลขบัญชี</label>
<input class="form-control" type="text" id="e_bank_number" placeholder="เลขบัญชี" value="<?php echo $bank_number; ?>" aria-label="default input example">
<label class="mt-2">เลือกธนาคาร</label>
<select id="select_member" class="form-control">
	<?php
	if ($bank_name=="") {
		echo "<option selected>ไม่ได้ยืนยัน</option>";
	}else{
		echo "<option selected>$bank_name</option>";
	}
	?>

	<?php if ($bank_name!="ไทยพาณิชย์") {
		echo "<option value='ไทยพาณิชย์'>ไทยพาณิชย์</option>";
	} ?>

	<?php if ($bank_name!="กรุงเทพ") {
		echo "<option value='กรุงเทพ'>กรุงเทพ</option>";
	} ?>

	<?php if ($bank_name!="กสิกรไทย") {
		echo "<option value='กสิกรไทย'>กสิกรไทย</option>";
	} ?>

	<?php if ($bank_name!="กรุงไทย") {
		echo "<option value='กรุงไทย'>กรุงไทย</option>";
	} ?>

	<?php if ($bank_name!="ทหารไทย") {
		echo "<option value='ทหารไทยธนชาติ'>ทหารไทยธนชาติ</option>";
	} ?>

	<?php if ($bank_name!="กรุงศรีฯ") {
		echo "<option value='กรุงศรีฯ'>กรุงศรีฯ</option>";
	} ?>

	<?php if ($bank_name!="ออมสิน") {
		echo "<option value='ออมสิน'>ออมสิน</option>";
	} ?>

	<?php if ($bank_name!="ธกส") {
		echo "<option value='ธกส'>ธกส</option>";
	} ?>
	

</select>

<label class="mt-2">ผู้แนะนำ refid</label>
<input   class="form-control" type="text" id="e_refid" placeholder="xxx" value="<?php echo $refid; ?>" aria-label="default input example">

<label class="mt-2">% affiliate ผู้เล่นทั่วไปให้เว้นว่าง</label>
<input   class="form-control" type="text" id="e_affliliate_percen" placeholder="0%" value="<?php echo $affliliate_percen; ?>" aria-label="default input example">


