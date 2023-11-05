<?php
error_reporting(0);

include("../config/config.php");
$sql = 'SELECT * FROM  `promotion` where p_id ="'.$_POST['id'].'"';
$result = $server->query($sql);
$row = mysqli_fetch_assoc($result);
$p_name=$row['p_name'];
$p_deposit=$row['p_deposit'];
$p_credit=$row['p_credit'];
$turnover=$row['turnover'];
$id=$row['p_id '];
$image=$row['image'];
?>

	<div class="col-xs-12">
		<div class="card bonus mt-4">
			<img src="<?php echo $image ?>" alt="Card image cap" class="card-img-top">
			<div class="card-body bonus-body text-center">
				<h4 class="card-title"><?php echo $p_name; ?></h4>
				<p class="card-text">ฝาก <?php echo $p_deposit; ?> บาท รับเงินเพิ่ม <?php echo $p_credit; ?> บาท ทำเทิร์น <?php echo $turnover; ?></p>
				<div role="alert" class="alert alert-danger bonus-alert"><a>หากทีมงานตรวจสอบพบรายการลูกค้าเข้าค่ายการล่าโปร ขอระงับการจ่ายเงินทุกกรณี</a>
				</div>
			</div>

		</div>

	</div>
