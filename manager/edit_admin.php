<?php

include("../config/config.php");
$sql = 'SELECT * FROM  `admin` where id="' . $_POST['id'] . '"';
$result = $server->query($sql);
$row = mysqli_fetch_assoc($result);
$username = $row['username'];
$fname = $row['fname'];

$status = $row['status'];
$id = $row['id'];

$catogory=$row['category'];
$catogory_arr = explode(",", $catogory);

function catogory_search($page_id,$catogory_arr){
	foreach ($catogory_arr as $key => $value) {
		if($value == $page_id){
			return true;
		}
	}
	return false;
}


?>
<input class="form-control" type="hidden" id="e_id" placeholder="ชือผู้ใช้" value="<?php echo $id; ?>" aria-label="default input example">
<input class="form-control" type="text" id="e_username" placeholder="ชือผู้ใช้" value="<?php echo $username; ?>" aria-label="default input example">
<input class="form-control mt-2" type="text" id="e_password" placeholder="รหัสผ่าน" value="" aria-label="default input example">
<input class="form-control mt-2" type="text" id="e_fname" placeholder="ชื่อ" value="<?php echo $fname; ?>" aria-label="default input example">

<label class="mt-2">หมวดหมู่</label>
<div class="row mt-2">
    <select name="basic" id="category_List" multiple>
        <option value="" disabled hidden>เลือก</option>
        <option value="1" <?php if(catogory_search(1,$catogory_arr)){ echo "selected";}?> >รายงานผลรวม</option>
        <option value="2" <?php if(catogory_search(2,$catogory_arr)){ echo "selected";}?> >จัดการ ผู้ดูแล</option>
        <option value="3" <?php if(catogory_search(3,$catogory_arr)){ echo "selected";}?> >จัดการ สมาชิก</option>
        <option value="4" <?php if(catogory_search(4,$catogory_arr)){ echo "selected";}?> >จัดการ โปรโมชั่น</option>
        <option value="5" <?php if(catogory_search(5,$catogory_arr)){ echo "selected";}?> >จัดการ ข้อมูลเว็บ</option>
        <option value="6" <?php if(catogory_search(6,$catogory_arr)){ echo "selected";}?> >จัดการ line Alert</option>
        <option value="7" <?php if(catogory_search(7,$catogory_arr)){ echo "selected";}?> >จัดการ ธนาคาร</option>
        <option value="8" <?php if(catogory_search(8,$catogory_arr)){ echo "selected";}?> >รายการ ฝากเงิน</option>
        <option value="9" <?php if(catogory_search(9,$catogory_arr)){ echo "selected";}?> >รายการ ถอนเงิน</option>
        <option value="10" <?php if(catogory_search(10,$catogory_arr)){ echo "selected";}?> >ยอดฝาก ไม่สำเร็จ</option>
        <option value="11" <?php if(catogory_search(11,$catogory_arr)){ echo "selected";}?> >ลูกค้าแจ้ง ถอนเงิน</option>
        <option value="12" <?php if(catogory_search(12,$catogory_arr)){ echo "selected";}?> >สร้างโค้ด แจกเครดิต</option>
        <option value="13" <?php if(catogory_search(13,$catogory_arr)){ echo "selected";}?> >สมาชิก หมุนวงล้อ</option>
        <option value="14" <?php if(catogory_search(14,$catogory_arr)){ echo "selected";}?> >cronjob</option>
        <option value="18" <?php if(catogory_search(18,$catogory_arr)){ echo "selected";}?> >จัดการ slider</option>
        <option value="19" <?php if(catogory_search(19,$catogory_arr)){ echo "selected";}?> >ประวัติแอดมิน</option>
    </select>
</div>