<?php
error_reporting(0);
include 'api_betflix.php';
$data = json_decode($api->get_balance($row['username_game']),true);
$amount=$data['data']['balance'];
$amount =str_replace(",","", $amount);





$sql = "SELECT * FROM member WHERE phone='".$_SESSION["phone"]."'";

$result = $server->query($sql);
$row = mysqli_fetch_assoc($result);

if ($row['status_update']==0) {
	$res=$api->edit($row['username_game'],$row['fname'],$row['phone']);
	 $data = json_decode($res,true);
	if ($data['status']) {
		$sql="UPDATE `member` SET `status_update`='1' WHERE phone='".$_SESSION["phone"]."'";
	if ($server->query($sql) === TRUE) {}
	}
}



if ($amount=="") {
	$amount=$row['credit'];
}

if ($amount!="") {
	$sql="UPDATE `member` SET `credit`='".$amount."' WHERE phone='".$_SESSION["phone"]."'";
	if ($server->query($sql) === TRUE) {}
}


?>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<header class="header">
	<div class="navbar">
		<div class="container d-flex justify-content-between">
			<div class="col-2 p-0">
				<div class="top-nav">
					<ul>
						<li>
							<a href="./dashboard"
							><i class="far fa-home"></i>
							<p>หน้าแรก</p></a
							>
						</li>
					</ul>
				</div>
			</div>
			<?php 
			$sqlInfo = "SELECT * FROM website";

			$resultInfo = $server->query($sqlInfo);
			$rowInfo = mysqli_fetch_assoc($resultInfo);
			?>
			<div class="col-8 text-center">
				<img style="margin-top: -20px;"
				class="header-logo"
				src="./manager/<?php echo $rowInfo['logo']; ?>"
				alt=""
				width="50%"
				/>
			</div>
			<div class="col-2 p-0"<?php if ($_SESSION["phone"]=="") {echo "style='display: none;'";}?>>

				<div class="top-nav">
					<ul>
						<li>
							<a href="./action.php?logout"
							><i class="far fa-power-off"></i>
							<p>ออกจากระบบ</p></a
							>
						</li>
					</ul>
				</div>
			</div>

			<div class="col-2 p-0"<?php
			if ($_SESSION["phone"]=="") {
				echo "style='block:'";
			}else{
				echo "style='display: none;'";

			}?>>

			<div class="top-nav">
				<ul>
					<li>
						<a href="./register"
						><i class="far fa-user-plus fa-sm"></i>
						<p>สมัครสมาชิก</p></a
						>
					</li>
				</ul>
			</div>
		</div>

	</div>
</div>
</header>