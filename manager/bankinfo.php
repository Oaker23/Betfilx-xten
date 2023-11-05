<?php

include("../config/config.php");

if($_SESSION["username"] == "") {

  echo " <script> window.open('./login');</script>";

  exit();
}

include 'class_scb.php';
$sql = 'SELECT * FROM  `scb_info`';
$result = $server->query($sql);

// $balance = json_decode($api->balance(),true)['result'];
// $sql="UPDATE `scb_info` SET `balance`=".$balance."WHERE id=1";
// if ($server->query($sql) === TRUE) {}

?>



<div class="page-holder bg-gray-100">
	<div class="container-fluid px-lg-4 px-xl-5">

		<section>
			<div class="row">
				<div class="col">
					<div class="card mb-4">
						<div class="card-header">
							<h4>ข้อมูล ธนาคาร</h4>
						</div>
						<div class="card-body">
							<button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add_bank"><i class="fas fa-plus"></i> เพิ่มบัญชีธนาคาร</button>
							<div class="table-responsive">
							<table class="table">
								<thead>
									<tr>
										<th>ลำดับ</th>
										<th>deviceid</th>
										<th>pin</th>
										<th>ชื่อ บัญชี</th>
										<th>เลขบัญชี</th>
										<th>ธนาคาร</th>
										<th>สถานะ</th>
										<th>ยอดเงิน</th>
										<th>รายละเอียด</th>
									</tr>
								</thead> 
								<tbody>
									<style>
										.form-control{
											/* width: fit-content !important; */
											width: 100px !important;
										}
										.tab-button{
											display: flex;
										}
										.tab-button button{
											padding: 6px 10px 6px 10px;
    										margin-right: 5px;
    										width: 90px;
										}
									</style>
									<?php
									$i = 1;
									while ($row = mysqli_fetch_assoc($result)) {
										?>
										<tr>
											<td><?php echo $i++; ?></td>
											<td><input disabled class="form-control" type="text" id="deviceid<?php echo $row['id'] ?>" value="<?php echo $row['deviceid'] ?>"></td>
											<td><input disabled class="form-control" style="width: 80px !important;" type="text" id="pin<?php echo $row['id'] ?>" value="<?php echo $row['pin'] ?>"></td>

											<td><input disabled class="form-control" type="text" id="fname<?php echo $row['id'] ?>" value="<?php echo $row['fname'] ?>"></td>
											<td><input disabled class="form-control" type="text" id="banknumber<?php echo $row['id'] ?>" value="<?php echo $row['banknumber'] ?>"></td>
											<td><input disabled class="form-control" type="text" id="bankname<?php echo $row['id'] ?>" value="<?php echo $row['bankname'] ?>"></td>


											<td><input disabled class="form-control" style="width: 40px !important;" type="text" id="status<?php echo $row['id'] ?>" value="<?php echo $row['status'] ?>"></td>
											<td><input disabled class="form-control" type="text" id="status<?php echo $row['id'] ?>" value="<?php echo $row['balance'] ?>"></td>
											


											<td><input disabled class="form-control" type="text" id="description<?php echo $row['id'] ?>" value="<?php echo $row['description'] ?>"></td>
											<td class="tab-button">

											
												<button class="btn btn-secondary" onclick="update_balance('<?php echo $row['banknumber'] ?>')"><i class="fas fa-redo"></i> อัพเดท</button>

												<button class="btn btn-success" id="<?php echo $row['id'] ?>" data-bs-toggle="modal" data-bs-target="#tranfer"><i class="fas fa-dollar-sign"></i> โอนเงิน</button>

												<button id="enabled<?php echo $row['id'] ?>" class="btn btn-warning" onclick="enabled(<?php echo $row['id'] ?>)"><i class="far fa-edit"></i> แก้ไข</button>
												<button id="website<?php echo $row['id'] ?>" class="btn btn-primary" onclick="update_bank(<?php echo $row['id'] ?>)"><i class="fas fa-save"></i> บันทึก</button>
												<button id="delete<?php echo $row['id'] ?>" class="btn btn-danger" onclick="delete_bank(<?php echo $row['id'] ?>)"><i class="fas fa-trash"></i> ลบ</button>



											</td>

										</tr>
										<?php
									}
									?>



								</tbody>
							</table>
							</div>

						</div>
					</div>
				</div>
			</div>
		</section>
	</div>
</div>


<!-- Modal -->
<div class="modal fade" id="tranfer" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true" style="margin-top: 200px;">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="staticBackdropLabel"><i class="fas fa-comment-dollar"></i> โอนเงิน ออก</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<div class="alert alert-danger">
					<strong><i class="fas fa-exclamation-triangle"></i>  อ่าน!</strong> กรุณาเช้คให้ถูกต้องก่อนโอน โอนผิดไม่สามารถดึงกลับได้ 
				</div><br>
				<label>เลขบัญชีตัวเอง</label>
				<input class="form-control" type="text" id="banknumber" name="banknumber" placeholder="เลขบัญชีตัวเอง" aria-label="default input example">
				<label class="mt-2">เลขบัญชีปลายทาง</label>
				<input class="form-control" type="text" id="bankto" name="bankto" placeholder="เลขบัญชีปลายทาง" aria-label="default input example">

				<label class=" mt-2">ธนาคาร</label>
				<div class="form-group mt-2">
					<select id="select" class="form-control">
						<option selected>เลือก ธนาคาร</option>
						<option value="ไทยพาณิชย์">ไทยพาณิชย์</option>
						<option value="กรุงเทพ">กรุงเทพ</option>
						<option value="กสิกรไทย">กสิกรไทย</option>
						<option value="กรุงไทย">กรุงไทย</option>
						<option value="ทหารไทย">ทหารไทย</option>
						<option value="กรุงศรีฯ">กรุงศรีฯ</option>
						<option value="ออมสิน">ออมสิน</option>
						<option value="ธนชาติ">ธนชาติ</option>
						<option value="ธกส">ธกส</option>
						<option value="ทรูวอเลต">ทรูวอเลต</option>
					</select>
				</div>

				<label class=" mt-2">ยอดเงิน</label>
				<input class="form-control" type="number" id="balanceto" name="balanceto" placeholder="" aria-label="default input example" value="0.00">

				<label class=" mt-2">key ถอนเงิน</label>
				<input class="form-control" type="password" id="key_tranfer" name="addBanktype" placeholder="" value="">

			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-primary" onclick="tranfer()"><i class="fas fa-comment-dollar"></i> ทำรายการ</button>
				<button type="button" class="btn btn-danger" data-bs-dismiss="modal">ปิด</button>

			</div>
		</div>
	</div>
</div>

<!-- Modal -->
<div class="modal fade" id="add_bank" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true" style="margin-top: 200px;">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="staticBackdropLabel"><i class="fas fa-plus"></i> เพิ่ม ธนาคาร</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">

				<label class=" mt-2">deviceid</label>
				<input class="form-control" type="text" id="deviceid" name="deviceid" placeholder="deviceid" aria-label="default input example">
				<label class=" mt-2">pin</label>
				<input class="form-control" type="text" id="pin" name="pin" placeholder="pin" aria-label="default input example">

				<label class=" mt-2">ชื่อบัญชี</label>
				<input class="form-control" type="text" id="addBankname" name="bankname" placeholder="ชื่อบัญชี" aria-label="default input example">

				<label class=" mt-2">เลขบัญชี</label>
				<input class="form-control" type="text" id="addBanknumber" name="addBanknumber" placeholder="เลขบัญชี" aria-label="default input example">

				<label class=" mt-2">ธนาคาร</label>
				<input class="form-control" type="text" id="addBanktype" name="addBanktype" placeholder="" aria-label="default input example" value="ไทยพาณิชย์">



			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-primary" onclick="add_bank()" data-bs-dismiss="modal"><i class="fas fa-plus"></i> เพิ่ม</button>
				<button type="button" class="btn btn-danger" data-bs-dismiss="modal">ปิด</button>

			</div>
		</div>
	</div>
</div>





<script type="text/javascript">

	window.onload = function() {



	}

	function tranfer() {


		var bankto=$("#bankto").val();

		var balanceto=$("#balanceto").val();
		var key_tranfer=$("#key_tranfer").val();


		var e = document.getElementById("select");
        var banknameto = e.options[e.selectedIndex].value; //ธนาคาร
        var banknumber=$("#banknumber").val();


        if (bankto=='') {
        	Swal.fire({
        		icon: 'error',
        		title: 'แจ้งเตือน...',
        		text: 'ห้ามเว้นว่าง'

        	})
        	return false
        }

        if (balanceto=='') {
        	Swal.fire({
        		icon: 'error',
        		title: 'แจ้งเตือน...',
        		text: 'ห้ามเว้นว่าง'

        	})
        	return false
        }

        if (key_tranfer=='') {
        	Swal.fire({
        		icon: 'error',
        		title: 'แจ้งเตือน...',
        		text: 'ห้ามเว้นว่าง'

        	})
        	return false
        }

        if (banknameto=='เลือก ธนาคาร') {
        	Swal.fire({
        		icon: 'error',
        		title: 'แจ้งเตือน...',
        		text: 'กรุณาเลือก ธนาคาร'

        	})
        	return false
        }

        Swal.fire({
        	title: 'คุณแน่ใจไหม?',
        	text: "กรุณาเช็คเลขบัญชีอีกครั้ง! "+bankto+' ธนาคาร '+banknameto,
        	icon: 'warning',
        	showCancelButton: true,
        	confirmButtonColor: '#3085d6',
        	cancelButtonColor: '#d33',
        	confirmButtonText: 'ยืนยัน'
        }).then((result) => {
        	if (result.value) {
        		showModal();
        		$.ajax({
        			url:'action.php?tranfersto',
        			type:'POST',
        			data:{
        				bankto:bankto,
        				balanceto:balanceto,
        				banknameto:banknameto,
        				key_tranfer:key_tranfer,
        				banknumber:banknumber
        			}, 
        			timeout: 30000,
        			error: function(){
        				$('body').loadingModal('hide');
        				$('body').loadingModal('destroy') ;
        				Swal.fire({
        					icon: 'error',
        					title: 'แจ้งเตือน...',
        					text: 'มีบางอย่างผิดพลาด กรุณาลองใหม่อีกครั้ง'

        				})
        			},
        			success:function(data){ 
        // console.log(data);
        if (data!="") {
        	var obj = JSON.parse(data);
        	var msg=obj.msg
        	var status=obj.status
        	if (status==200) {
        		$('body').loadingModal('hide');
        		$('body').loadingModal('destroy') ;
        		Swal.fire({
        			title: 'แจ้งเตือน!',
        			text: msg,
        			icon: 'success',
        			showCancelButton: false,
        			confirmButtonColor: '#3085d6',
        			cancelButtonColor: '#d33',
        			confirmButtonText: 'OK'
        		}).then((result) => {
        			if (result.value) {
        				window.location.reload();
        			}
        		});


        	}else{
        		$('body').loadingModal('hide');
        		$('body').loadingModal('destroy') ;
        		Swal.fire({
        			icon: 'error',
        			title: 'แจ้งเตือน...',
        			text: msg

        		})

        	}

        }
    }
});

        	}
        })




    }



    function enabled(id) {

    	document.getElementById("fname"+id).disabled = false;
    	document.getElementById("banknumber"+id).disabled = false;
    	document.getElementById("status"+id).disabled = false;
    	document.getElementById("description"+id).disabled = false;
    	document.getElementById("deviceid"+id).disabled = false;
    	document.getElementById("pin"+id).disabled = false;
    	document.getElementById("enabled"+id).disabled = true;
    }




    function delete_bank(id) {


    	Swal.fire({
    		title: 'คุณแน่ใจไหม?',
    		text: "คุณจะไม่สามารถยกเลิกสิ่งนี้ได้!",
    		icon: 'warning',
    		showCancelButton: true,
    		confirmButtonColor: '#3085d6',
    		cancelButtonColor: '#d33',
    		confirmButtonText: 'ยืนยัน ลบ'
    	}).then((result) => {
    		if (result.value) {

    			$.ajax({
    				url:'action.php?delete_bank',
    				type:'POST',
    				data:{

    					id:id
    				}, 
    				timeout: 30000,
    				error: function(){
    					Swal.fire({
    						icon: 'error',
    						title: 'แจ้งเตือน...',
    						text: 'มีบางอย่างผิดพลาด กรุณาลองใหม่อีกครั้ง'

    					})
    				},
    				success:function(data){ 
    					if (data!="") {
    						var obj = JSON.parse(data);
    						var msg=obj.msg
    						var status=obj.status
    						if (status==200) {
    							Swal.fire({
    								title: 'แจ้งเตือน!',
    								text: msg,
    								icon: 'success',
    								showCancelButton: false,
    								confirmButtonColor: '#3085d6',
    								cancelButtonColor: '#d33',
    								confirmButtonText: 'OK'
    							}).then((result) => {
    								if (result.value) {
    									window.location.reload();
    								}
    							});


    						}else{

    							Swal.fire({
    								icon: 'error',
    								title: 'แจ้งเตือน...',
    								text: msg

    							})

    						}

    					}
    				}
    			});

    		}
    	})




    }


    function add_bank() {
    	var addBankname=$("#addBankname").val();
    	var addBanknumber=$("#addBanknumber").val();
    	var addBanktype=$("#addBanktype").val();
    	var deviceid=$("#deviceid").val();
    	var pin=$("#pin").val();

    	$.ajax({
    		url:'action.php?add_bank',
    		type:'POST',
    		data:{
    			addBankname:addBankname,
    			addBanknumber:addBanknumber,
    			addBanktype:addBanktype,
    			deviceid:deviceid,
    			pin:pin
    		}, 
    		timeout: 30000,
    		error: function(){
    			Swal.fire({
    				icon: 'error',
    				title: 'แจ้งเตือน...',
    				text: 'มีบางอย่างผิดพลาด กรุณาลองใหม่อีกครั้ง'

    			})
    		},
    		success:function(data){ 
        // console.log(data);
        if (data!="") {
        	var obj = JSON.parse(data);
        	var msg=obj.msg
        	var status=obj.status
        	if (status==200) {
        		Swal.fire({
        			title: 'แจ้งเตือน!',
        			text: msg,
        			icon: 'success',
        			showCancelButton: false,
        			confirmButtonColor: '#3085d6',
        			cancelButtonColor: '#d33',
        			confirmButtonText: 'OK'
        		}).then((result) => {
        			if (result.value) {
        				window.location.reload();
        			}
        		});


        	}else{

        		Swal.fire({
        			icon: 'error',
        			title: 'แจ้งเตือน...',
        			text: msg

        		})

        	}

        }
    }
});

    }


    function update_balance(data) {
    	var banknumber=data;
    	showModal();
    	$.ajax({
    		url:'action.php?update_balance',
    		type:'POST',
    		data:{
    			banknumber:banknumber
    		}, 
    		timeout: 30000,
    		error: function(){
    			$('body').loadingModal('hide');
        		$('body').loadingModal('destroy') ;
    			Swal.fire({
    				icon: 'error',
    				title: 'แจ้งเตือน...',
    				text: 'มีบางอย่างผิดพลาด กรุณาลองใหม่อีกครั้ง'

    			})
    		},
    		success:function(data){ 
    			if (data!="") {
    				var obj = JSON.parse(data);
    				var msg=obj.msg
    				var status=obj.status
    				if (status==200) {
    					$('body').loadingModal('hide');
        		$('body').loadingModal('destroy') ;
    					Swal.fire({
    						title: 'แจ้งเตือน!',
    						text: msg,
    						icon: 'success',
    						showCancelButton: false,
    						confirmButtonColor: '#3085d6',
    						cancelButtonColor: '#d33',
    						confirmButtonText: 'OK'
    					}).then((result) => {
    						if (result.value) {
    							window.location.reload();
    						}
    					});


    				}else{
$('body').loadingModal('hide');
        		$('body').loadingModal('destroy') ;
    					Swal.fire({
    						icon: 'error',
    						title: 'แจ้งเตือน...',
    						text: msg

    					})

    				}

    			}
    		}
    	});


    }
    function update_bank(id) {
    	var fname=$("#fname"+id).val();
    	var banknumber=$("#banknumber"+id).val();
    	var status=$("#status"+id).val();
    	var description=$("#description"+id).val();
    	var deviceid=$("#deviceid"+id).val();
    	var pin=$("#pin"+id).val();


    	$.ajax({
    		url:'action.php?update_bank',
    		type:'POST',
    		data:{
    			fname:fname,
    			banknumber:banknumber,
    			status:status,
    			id:id,
    			description:description,
    			deviceid:deviceid,
    			pin:pin
    		}, 
    		timeout: 30000,
    		error: function(){
    			Swal.fire({
    				icon: 'error',
    				title: 'แจ้งเตือน...',
    				text: 'มีบางอย่างผิดพลาด กรุณาลองใหม่อีกครั้ง'

    			})
    		},
    		success:function(data){ 
    			if (data!="") {
    				var obj = JSON.parse(data);
    				var msg=obj.msg
    				var status=obj.status
    				if (status==200) {
    					Swal.fire({
    						title: 'แจ้งเตือน!',
    						text: msg,
    						icon: 'success',
    						showCancelButton: false,
    						confirmButtonColor: '#3085d6',
    						cancelButtonColor: '#d33',
    						confirmButtonText: 'OK'
    					}).then((result) => {
    						if (result.value) {
    							window.location.reload();
    						}
    					});


    				}else{

    					Swal.fire({
    						icon: 'error',
    						title: 'แจ้งเตือน...',
    						text: msg

    					})

    				}

    			}
    		}
    	});

    }

</script>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.9/js/responsive.bootstrap4.min.js"></script>
