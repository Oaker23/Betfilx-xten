<?php

include("../config/config.php");

if($_SESSION["username"] == "") {

  echo " <script> window.open('./login');</script>";

  exit();
}


$sql = 'SELECT * FROM  `popup` ORDER by id  asc';
$result = $server->query($sql);
$res=array();
foreach ($result as $row) {

	array_push($res,$row);

}


?>



<div class="page-holder bg-gray-100">
	<div class="container-fluid px-lg-4 px-xl-5">


		<section>
			<div class="row">
				<div class="col">
					<div class="card mb-4">
						<div class="card-header">
							<h4>จัดการ ป๊อปอัพ</h4>
						</div>
						<div class="card-body">

							<div class="row">
								<div class="row justify-content-md-center">
									<?php $i=1; foreach ($res as $key => $value) {?>
										<div class="col-md-4 col-sm-6 col-xs-12 col-xl-3 mx-3">
											<div class="card bonus mt-4">
												<img src="<?=$value['image']; ?>" alt="Card image cap" class="card-img-top">
												<div class="card-body bonus-body text-center">

													<h6 class="mt-2">ป๊อปอัพ <?php echo $i; ?></h6>
													<input class="form-control" type="text" id="name<?=$value ['id'] ?>" placeholder="หัวข้อ" disabled value="<?=$value['name']; ?>">

													<!-- <label class=" mt-2"><?=$value ['name'] ?></label><br> -->
													<label class=" mt-2">รายละเอียด</label>
													<textarea class="form-control" type="text"rows="3" id="description<?=$value ['id'] ?>" name="description" placeholder="รายละเอียด" aria-label="default input example"disabled><?=$value['description']; ?></textarea>

													<h6 class="mt-2">url รูปภาพ</h6>
													
													<input class="form-control" type="file" id="image<?=$value ['id'] ?>" placeholder="รูปภาพ" disabled value="<?=$value['image']; ?>">
													

													<div class="d-grid gap-2 my-4">
														<button id="edit_bonus<?=$value ['p_id'] ?>" onclick="edit_popup(<?=$value ['id'] ?>)" class="col btn btn-warning">แก้ไข</button>
														<button style="display: none;" id="update_popup<?=$value ['id'] ?>" onclick="update_popup(<?=$value ['id'] ?>)" class="col btn btn-primary">บันทึก</button>
														<button onclick="delete_popup(<?=$value ['id'] ?>)" class="col btn btn-danger mt-1">ลบ</button>
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





	<script type="text/javascript">




		function edit_popup(id) {

			var url=$("#image"+id).val();


			document.getElementById("name"+id).disabled = false;
			document.getElementById("description"+id).disabled = false;
			document.getElementById("image"+id).disabled = false;
			document.getElementById("description"+id).style.display = "block";
			document.getElementById("update_popup"+id).style.display = "block";
			document.getElementById("name"+id).style.display = "block";
		}


		function delete_popup(id){

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
						url:'action.php?delete_popup',
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



		function update_popup(id){
			var url=$("#image"+id).val();

			var name=$("#name"+id).val();
			var description=$("#description"+id).val();
			var file_data = $("#image"+id).prop('files')[0];   
			var form_data = new FormData();                  
			form_data.append('id', id);
			form_data.append('file', file_data);
			form_data.append('description', description);
			form_data.append('name', name);
			$.ajax({
				url:'action.php?update_popup',
				type:'POST',
				dataType: 'text',  // what to expect back from the PHP script, if anything
				cache: false,
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
