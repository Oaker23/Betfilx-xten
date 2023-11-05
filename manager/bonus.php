<?php

include("../config/config.php");

if($_SESSION["username"] == "") {

  echo " <script> window.open('./login');</script>";

  exit();
}

$sql = 'SELECT * FROM  `promotion` ORDER by p_id  asc';
$result = $server->query($sql);
$res=array();
foreach ($result as $row) {

	array_push($res,$row);

}


?>



<div class="page-holder bg-gray-100">
	<div class="container-fluid px-lg-4 px-xl-5">


		<div align="right" class="mb-3">
			<button class="btn btn-primary text-uppercase" data-bs-toggle="modal" data-bs-target="#add_bonus1"><i class="fas fa-plus"></i> โบนัส ยอดเงิน</button>
			<button class="btn btn-primary text-uppercase" data-bs-toggle="modal" data-bs-target="#add_bonus2"><i class="fas fa-plus"></i> โบนัส เปอร์เซ็น</button>
		</div>
		<section>
			<div class="row">
				<div class="col">
					<div class="card mb-4">
						<div class="card-header">
							<h4>จัดการ โปรโมชั่น</h4>
						</div>
						<div class="card-body">

							<div class="row">
								<div class="row justify-content-md-center">
									<?php $i=1; foreach ($res as $key => $value) {?>
										<div class="col-md-4 col-sm-6 col-xs-12 col-xl-3 mx-3">
											<div class="card bonus mt-4">
												<img src="<?=$value['image']; ?>" alt="Card image cap" class="card-img-top">
												<div class="card-body bonus-body text-center">
													<input class="form-control" type="text" id="name<?=$value ['p_id'] ?>" placeholder="ชื่อโปรโมชั่น" disabled value="<?=$value['p_name']; ?>">
													<h6 class="mt-2">ฝากเงิน</h6>
													<input class="form-control" type="text" id="deposit<?=$value ['p_id'] ?>" placeholder="ฝากเงิน" disabled value="<?=$value['p_deposit']; ?>">

													<h6  style="display: <?php if ($value['p_credit']=="") {echo "none";}else{echo "block";}?>;" class="mt-2">รับเงิน</h6>
													<input style="display: <?php if ($value['p_credit']=="") {echo "none";}else{echo "block";}?>;" class="form-control" type="text" id="credit<?=$value ['p_id'] ?>" placeholder="รับเงิน" disabled value="<?=$value['p_credit']; ?>">
													<h6 class="mt-2">ทำเทิร์น</h6>
													<input class="form-control" type="text" id="turnover<?=$value ['p_id'] ?>" placeholder="ทำเทิร์น" disabled value="<?=$value['turnover']; ?>">

													<h6  style="display: <?php if ($value['p_credit']=="") {echo "block";}else{echo "none";}?>;" class="mt-2">ฝากขั้นต่ำ</h6>
													<input  style="display: <?php if ($value['p_credit']=="") {echo "block";}else{echo "none";}?>;" class="form-control" type="text" id="min_deposit<?=$value ['p_id'] ?>" placeholder="ฝากขั้นต่ำ" disabled value="<?=$value['min_deposit']; ?>">

													<h6 style="display: <?php if ($value['maxximum']=="") {echo "none";}else{echo "block";}?>;" class="mt-2">โบนัสสูงสุด</h6>
													<input  style="display: <?php if ($value['maxximum']=="") {echo "none";}else{echo "block";}?>;" class="form-control" type="text" id="maxximum_e<?=$value ['p_id'] ?>" placeholder="โบนัสสูงสุด" disabled value="<?=$value['maxximum']; ?>">


													<h6 class="mt-2">เงื่อนไข</h6>
													<input class="form-control" type="text" id="condition_pro<?=$value ['p_id'] ?>" placeholder="เงื่อนไข" disabled value="<?=$value['condition_pro']; ?>">

													

													<label class=" mt-2">รายละเอียด</label>
													<textarea class="form-control" type="text"rows="3" id="description<?=$value ['p_id'] ?>" name="description" placeholder="รายละเอียด" aria-label="default input example"disabled><?=$value['description']; ?></textarea>

													<h6 class="mt-2">url รูปภาพ</h6>
													<!-- <img src="<?=$value['image']; ?>" width="100%" alt="" srcset=""> -->
													<input class="form-control" type="file" id="image<?=$value ['p_id'] ?>" placeholder="รูปภาพ" disabled value="<?=$value['image']; ?>">
													<!-- <input class="form-control" type="text" id="image<?=$value ['p_id'] ?>" placeholder="รูปภาพ" disabled value="<?=$value['image']; ?>"> -->
													<div class="d-grid gap-2 my-4">
														<button id="edit_bonus<?=$value ['p_id'] ?>" onclick="edit_bonus(<?=$value ['p_id'] ?>)" class="col btn btn-warning">แก้ไข</button>
														<button style="display: none;" id="update_bonus<?=$value ['p_id'] ?>" onclick="update_bonus(<?=$value ['p_id'] ?>)" class="col btn btn-primary">บันทึก</button>
														<button onclick="delete_bonus(<?=$value ['p_id'] ?>)" class="col btn btn-danger mt-1">ลบ</button>
													</div>
												</div>

											</div>

										</div>

										<?php $i++; }  ?>
									</div>
								</div>

							</div>
						</div>
					</div>
				</div>
			</section>
		</div>
	</div>





	<!-- Modal -->
	<div class="modal fade" id="add_bonus1" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true" style="margin-top: 200px;">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="staticBackdropLabel"><i class="fas fa-plus"></i> เพิ่ม โปรโมชั่น</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<label>เงื่อนไข โบนัส</label>
					<select id="p_name" class="form-control" name="p_name">
						<option value="โปร สมาชิกใหม่">โปรสมาชิกใหม่</option>
						<option value="ฝากครั้งแรกของวัน">ฝากครั้งแรกของวัน</option>
						<option value="รับทุกครั้งที่ฝากเงิน">รับทุกครั้งที่ฝากเงิน</option>
					</select>

					<label class=" mt-2">ฝากเงิน</label>
					<input class="form-control" type="text" id="deposit" name="deposit" placeholder="ฝากเงิน" aria-label="default input example">

					<label class=" mt-2">รับเงิน</label>
					<input class="form-control" type="text" id="credit" name="credit" placeholder="รับเงิน" aria-label="default input example">

					<label class=" mt-2">ทำเทิร์น</label>
					<input class="form-control" type="text" id="turnover" name="turnover" placeholder="ทำเทิร์น" aria-label="default input example">

					<label class=" mt-2">ฝากขั้นต่ำ</label>
					<input class="form-control" type="text" id="min_deposit" name="min_deposit" placeholder="ฝากขั้นต่ำ" aria-label="default input example">

					<label class=" mt-2">เงื่อนไข โบนัส</label>
					<select id="condition_pro1" class="form-control" name="condition_pro1">
						<option value="เฉพาะสมาชิกใหม่">เฉพาะสมาชิกใหม่ฝากเงิน</option>
						<option value="รับวันละครั้งที่ฝากเงิน">รับวันละครั้งที่ฝากเงิน</option>
						<option value="รับวันละครั้งที่ฝากเงิน">รับทุกครั้งที่ฝากเงิน</option>
					</select>

					<label class=" mt-2">รายละเอียด</label>
					<textarea class="form-control" type="text"rows="3" id="description" name="description" placeholder="รายละเอียด" aria-label="default input example"></textarea>

					<label class=" mt-2">URL รูปภาพ</label>
					<input class="form-control" type="file" id="image" name="image" placeholder="รูปภาพ" aria-label="default input example">



				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-primary" onclick="add_bonus1()"><i class="fas fa-plus"></i> เพิ่ม</button>
					<button type="button" class="btn btn-danger" data-bs-dismiss="modal">ปืด</button>

				</div>
			</div>
		</div>
	</div>



	<!-- Modal -->
	<div class="modal fade" id="add_bonus2" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true" style="margin-top: 200px;">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="staticBackdropLabel"><i class="fas fa-plus"></i> เพิ่ม โปรโมชั่น</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<label>เงื่อนไข โบนัส</label>
					<select id="p_name2" class="form-control" name="p_name2">
						<option value="โปร สมาชิกใหม่">โปร สมาชิกใหม่</option>
						<option value="ฝากครั้งแรกของวัน">ฝากครั้งแรกของวัน</option>
						<option value="รับทุกครั้งที่ฝากเงิน">รับทุกครั้งที่ฝากเงิน</option>
					</select>

					<label class=" mt-2">รับบโบนัส %</label>
					<input class="form-control" type="text" id="deposit2" name="deposit" placeholder="ใส่ %" aria-label="default input example">

					<label class=" mt-2">ทำเทิร์น ใส่เป็นเท่า</label>
					<input class="form-control" type="text" id="turnover2" name="turnover" placeholder="ทำเทิร์น" aria-label="default input example">

					<label class=" mt-2">โบนัส สูงสุด</label>
					<input class="form-control" type="text" id="maxximum2" name="maxximum" placeholder="โบนัส สูงสุด" aria-label="default input example">

					<label class=" mt-2">ฝากขั้นต่ำ</label>
					<input class="form-control" type="text" id="min_deposit2" name="min_deposit" placeholder="ฝากขั้นต่ำ" aria-label="default input example">

					<label class=" mt-2">เงื่อนไข โบนัส</label>
					<select id="condition_pro2" class="form-control" name="condition_pro2">
						
						<!-- 	<option value="รับทุกครั้งที่ฝากเงิน">รับทุกครั้งที่ฝากเงิน</option> -->
						<option value="เฉพาะสมาชิกใหม่">เฉพาะสมาชิกใหม่ฝากเงิน</option>
						<option value="รับวันละครั้งที่ฝากเงิน">รับวันละครั้งที่ฝากเงิน</option>
						<option value="รับทุกครั้งที่ฝากเงิน">รับทุกครั้งที่ฝากเงิน</option>
					</select>

					<label class=" mt-2">รายละเอียด</label>
					<textarea class="form-control" type="text"rows="3" id="description2" name="description" placeholder="รายละเอียด" aria-label="default input example"></textarea>

					<label class=" mt-2">URL รูปภาพ</label>
					<input class="form-control" type="file" id="image2" name="image" placeholder="รูปภาพ" aria-label="default input example">

					

				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-primary" onclick="add_bonus2()"><i class="fas fa-plus"></i> เพิ่ม</button>
					<button type="button" class="btn btn-danger" data-bs-dismiss="modal">ปืด</button>

				</div>
			</div>
		</div>
	</div>


	<script type="text/javascript">




		function edit_bonus(id) {
			var deposit=$("#deposit"+id).val();
			var credit=$("#credit"+id).val();
			var turnover=$("#turnover"+id).val();
			var url=$("#image"+id).val();
			document.getElementById("deposit"+id).disabled = false;
			document.getElementById("credit"+id).disabled = false;
			document.getElementById("turnover"+id).disabled = false;
			document.getElementById("image"+id).disabled = false;
			document.getElementById("min_deposit"+id).disabled = false;
			document.getElementById("description"+id).disabled = false;
			document.getElementById("maxximum_e"+id).disabled = false;
			document.getElementById("edit_bonus"+id).style.display = "none";
			document.getElementById("update_bonus"+id).style.display = "block";
			document.getElementById("description"+id).style.display = "block";
			document.getElementById("min_deposit"+id).style.display = "block";
		}

		function add_bonus1() {
			var p_name=$("#p_name").val();
			var condition_pro1=$("#condition_pro1").val();
			var deposit=$("#deposit").val();
			var credit=$("#credit").val();
			var turnover=$("#turnover").val();
			var description=$("#description").val();
			var min_deposit=$("#min_deposit").val();
			 // alert(description);
			 // return false

			 var file_data = $("#image").prop('files')[0];   
			 var form_data = new FormData();                  
			 form_data.append('p_name', p_name);
			 form_data.append('file', file_data);
			 form_data.append('deposit', deposit);
			 form_data.append('credit', credit);
			 form_data.append('turnover', turnover);
			 form_data.append('condition_pro1', condition_pro1);
			 form_data.append('description', description);
			 form_data.append('min_deposit', min_deposit);
			 if (p_name=="" || deposit=="" || credit=="" || turnover=="" || description=="" || file_data==""|| min_deposit=="") {
			 	Swal.fire({
			 		icon: 'error',
			 		title: 'แจ้งเตือน...',
			 		text:'กรุณากรอกข้อมูลให้ครบถ้วนด้วย'

			 	})
			 	return false
			 } 

			 $.ajax({
			 	url:'action.php?add_bonus',
			 	type:'POST',
			 	contentType: false,
			 	processData: false,
			 	data: form_data, 
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


			function add_bonus2() {
				var p_name=$("#p_name2").val();
				var condition_pro1=$("#condition_pro2").val();
				var deposit=$("#deposit2").val();
				var turnover=$("#turnover2").val();
				var maxximum=$("#maxximum2").val();
				var description=$("#description2").val();
				var min_deposit=$("#min_deposit2").val();
			// alert(condition_pro1);
			// return false

			var file_data = $("#image2").prop('files')[0];   
			var form_data = new FormData();                  
			form_data.append('p_name', p_name);
			form_data.append('file', file_data);
			form_data.append('deposit', deposit);
			form_data.append('turnover', turnover);
			form_data.append('maxximum', maxximum);
			form_data.append('condition_pro1', condition_pro1);
			form_data.append('min_deposit', min_deposit);
			form_data.append('description', description);
			if (p_name=="" || deposit=="" || credit=="" || turnover==""|| description=="" || file_data=="" || maxximum=="" || min_deposit=="") {
				Swal.fire({
					icon: 'error',
					title: 'แจ้งเตือน...',
					text:'กรุณากรอกข้อมูลให้ครบถ้วนด้วย'

				})
				return false
			} 

			$.ajax({
				url:'action.php?add_bonus',
				type:'POST',
				contentType: false,
				processData: false,
				data: form_data, 
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



		function delete_bonus(id){

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
						url:'action.php?delete_bonus',
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



		function update_bonus(id){
			
			var deposit=$("#deposit"+id).val();
			var credit=$("#credit"+id).val();
			var turnover=$("#turnover"+id).val();
			var min_deposit=$("#min_deposit"+id).val();
			var url=$("#image"+id).val();
			var description=$("#description"+id).val();
			var maxximum_e=$("#maxximum_e"+id).val();
			var file_data = $("#image"+id).prop('files')[0];   
			var form_data = new FormData();                  
			form_data.append('id', id);
			form_data.append('file', file_data);
			form_data.append('deposit', deposit);
			form_data.append('credit', credit);
			form_data.append('maxximum', maxximum_e);
			form_data.append('description', description);
			form_data.append('turnover', turnover);
			form_data.append('turnover', turnover);
			form_data.append('min_deposit', min_deposit);
			// alert(form_data);  
			$.ajax({
				url:'action.php?update_bonus',
				type:'POST',
				// dataType: 'text',  // what to expect back from the PHP script, if anything
				// cache: false,
				contentType: false,
				processData: false,
				data:form_data , 
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
	</script>
	<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
	<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
	<script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap4.min.js"></script>
	<script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
	<script src="https://cdn.datatables.net/responsive/2.2.9/js/responsive.bootstrap4.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function () { 
			$("#p_name").change(function (e) { 
				e.preventDefault();
				if($(this).val() == "โปรสมาชิกใหม่"){
					$("#condition_pro1").html("");
					$("#condition_pro1").append('<option value="เฉพาะสมาชิกใหม่">เฉพาะสมาชิกใหม่</option>');
				} else if($(this).val() == "รับทุกครั้งที่ฝากเงิน"){
					$("#condition_pro1").html("");
					$("#condition_pro1").append('<option value="รับทุกครั้งที่ฝากเงิน">รับทุกครั้งที่ฝากเงิน</option>');
				} else {
					$("#condition_pro1").html("");
					$("#condition_pro1").append('<option value="รับวันละครั้งที่ฝากเงิน">รับวันละครั้งที่ฝากเงิน</option>');

				}
			});
			$("#p_name2").change(function (e) { 
				e.preventDefault();
				if($(this).val() == "โปร สมาชิกใหม่"){
					$("#condition_pro2").html("");
					$("#condition_pro2").append('<option value="เฉพาะสมาชิกใหม่">เฉพาะสมาชิกใหม่</option>');
				} else if($(this).val() == "รับทุกครั้งที่ฝากเงิน"){
					$("#condition_pro2").html("");
					$("#condition_pro2").append('<option value="รับทุกครั้งที่ฝากเงิน">รับทุกครั้งที่ฝากเงิน</option>');
				} else {
					$("#condition_pro2").html("");
					$("#condition_pro2").append('<option value="รับวันละครั้งที่ฝากเงิน">รับวันละครั้งที่ฝากเงิน</option>');
				}
			});
		});
	</script>
