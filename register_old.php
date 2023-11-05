<?php


require 'config/config.php';
$phone = @$_GET['ref'];


?>
<!doctype html>
<html lang="th">

<!doctype html>
    <html lang="th">

    <head>
        <?php include("template/info.php"); ?>
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css">
        <!-- core CSS -->
        <link href="public/css/bootstrap.min.css" rel="stylesheet">
        <link href="public/css/hover.css" rel="stylesheet">
        <link href="public/css/animate.css" rel="stylesheet">
        <link href="public/icons/icon.min.css" rel="stylesheet">
        <link href="public/css/thbank/thbanklogos.css" rel="stylesheet">
        <link href="public/css/thbank/thbanklogos-colors.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.0-beta/css/bootstrap-select.min.css" />

        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
        <!-- Custom styles -->
        <link href="public/css/style-dashboardv6.css?v=1.01" rel="stylesheet">




        <style>
        .share-list i {
            color: #212529;
        }
    </style>

    <script>
        window.siteUrl = '';
    </script>

</head>

<body class="animated fadeIn fast">
    <div>
       <?php 
       require 'header.php';
       ?>
       <section class="slide">
        <div class="slide-img d-none d-md-block"><img src="" alt=""></div>
        <div class="slide-img d-block d-md-none"><img src="" alt=""></div>
    </section>

    <div id="app">
        <main role="main">
            <div class="container content" v-cloak>
                <section class="user-bank">
                    <div class="card">

                        <h5 class="card-header"><i class="far fa-user-plus fa-sm"></i> สมัครสมาชิก</h5>

                        <div class="card-body" align="center">

                          <div class="form-group">
                            <label class="float-left">เลขบัญชีธนาคาร</label>
                            <input type="text" class="form-control form-control-lg" id="bank_number" aria-describedby="เลขบัญชีธนาคาร" placeholder="473208XXXX">
                        </div>

                        <div class="form-group">
                            <select id="select" class="form-control form-control-lg">
                                <option selected>เลือก ธนาคาร</option>
                                <option value="ไทยพาณิชย์">ไทยพาณิชย์</option>
                                <option value="กรุงเทพ">กรุงเทพ</option>
                                <option value="กสิกรไทย">กสิกรไทย</option>
                                <option value="กรุงไทย">กรุงไทย</option>
                                <option value="ทหารไทย">ทหารไทยธนชาติ</option>
                                <option value="กรุงศรีฯ">กรุงศรีฯ</option>
                                <option value="ออมสิน">ออมสิน</option>
                                <option value="ธนชาติ">ธนชาติ</option>
                                <option value="ธกส">ธกส</option>
                                  
                            </select>
                        </div>

                        <!--<div class="form-group">
                            <label class="float-left">ชื่อ-นามสกุล</label>
                            <input type="text" class="form-control form-control-lg" id="fname" aria-describedby="ชื่อ-นามสกุลชื่อ" placeholder="ชื่อ-นามสกุลชื่อ">
                        </div>-->

                        <div class="form-group">
                            <label class="float-left">เบอร์มือถือ</label>
                            <input type="text" class="form-control form-control-lg" id="phone" aria-describedby="phone" placeholder="094-259-7XX4">
                        </div>

                        <div class="form-group">
                            <label class="float-left">ตั้งรหัสผ่านเอง</label>
                            <input type="text" class="form-control form-control-lg" id="password" aria-describedby="password" placeholder="Aa12XXXX">
                        </div>

                        <div class="form-group"><button  class="btn-red btn-lg btn-block" onclick="register()"><i class="fas fa-sign-in-alt fa-sm"></i> 
                        สมัครสมาชิก </button></div>


                    </div>
                </div>
            </section>

        </div>
    </main>
  
    <?php 
    require 'footer.php';
    ?>

</div>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script>
    window.jQuery || document.write('<script src="assets/js/vendor/jquery-slim.min.js"><\/script>')
</script>
<script src="public/js/vendor/popper.min.js"></script>
<script src="public/js/bootstrap.min.js"></script>
<script src="public/js/vendor/holder.min.js"></script>
<script src="public/js/v20/app.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.0-beta/js/bootstrap-select.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.6.0/slick.js"></script>
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-155235476-1"></script>
<script>


  window.onload = function() {
    localStorage.setItem("ref", '<?php echo $phone; ?>');
    var ref = localStorage.getItem("ref");


}


function register(confirm_code=0) {
    var phone=$("#phone").val();
    var password=$("#password").val();
    var fname=$("#fname").val();
    var bank_number=$("#bank_number").val();
	var confirm_code=confirm_code;

    var e = document.getElementById("select");
        var bank_name = e.options[e.selectedIndex].value; //ธนาคาร
        var ref = localStorage.getItem("ref");



        var form_data = new FormData();                  
        form_data.append('phone', phone);
        form_data.append('password', password);
        form_data.append('bank_number', bank_number);
        form_data.append('bank_name', bank_name);
        form_data.append('ref', ref);
        form_data.append('fname', fname);
        form_data.append('confirm_code', confirm_code);
        
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
        // else if (fname=="") {
        //     Swal.fire({
        //         icon: 'error',
        //         title: 'แจ้งเตือน...',
        //         text:'กรุณากรอก ชื่อ'

        //     })
        //     return false
        // }

        $.ajax({
            url: 'action.php?register',
            type: 'POST',
            contentType: false,
            processData: false,
                // data: {
                //     phone: phone,
                //     password: password,
                //     bank_number: bank_number,
                //     bank_name: bank_name,
                //     ref:ref
                // },
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
                    // console.log("data=",data);
                    if (data != "") {
                        var obj = JSON.parse(data);
                        var msg = obj.msg
                        var status = obj.status
                        if (status == 200) {

                            Swal.fire({
                                title: 'แจ้งเตือน',
                                text: 'สมัครสมาชิกสำเร้จ',
                                icon: 'success',
                                showCancelButton: false,
                                confirmButtonColor: '#3085d6',
                                cancelButtonColor: '#d33',
                                confirmButtonText: 'OK'
                            }).then((result) => {
                                if (result.value) {
                                    location.replace("./dashboard");
                                }
                            });

                        }else if (status == 202){

                            Swal.fire({
                              title: 'ยืนยันการสมัครสมาชิก ?',
                              html: "ชื่อ-นามสกุล : "+obj.msg+
                              "<br> เลขบัญชีธนาคาร : "+bank_number+
                              "<br> ธนาคาร : "+bank_name+
                              "<br> เบอรโทร : "+phone,
                              showDenyButton: true,
                              showCancelButton: true,
                              confirmButtonText: 'ยืนยัน',
                              denyButtonText: `ยกเลิก`,
                            }).then((result) => {
                              if (result.isConfirmed) {
                                register(1)
                              } 
                            //   else if (result.isDenied) {
                            //     Swal.fire('Changes are not saved', '', 'info')
                            //   }
                            })

                        }
                         else {
                            Swal.fire({
                                icon: 'error',
                                title: 'แจ้งเตือน...',
                                html: msg

                            })



                        }

                    }




                }


            });



    }


</script>


</body>

</html>