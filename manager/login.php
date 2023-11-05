<?php
if (!isset($_SESSION)) {
	session_start();
}
include("../config/config.php");

if($_SESSION["username"] != "") {
	header( "location: ./main.php?page=dashboard" );
}

$phone = @$_GET['ref'];

$sql = 'SELECT * FROM  `website`';
$result = $server->query($sql);
$row = mysqli_fetch_assoc($result);

$actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
preg_match('/(?<=\/\/).(.*?)(?=\/)/', $actual_link, $output_array);

?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>ระบบหลังบ้าน <?php echo $output_array[0]; ?></title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="all,follow">
    <!-- Google fonts - Popppins for copy-->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;700&amp;display=swap" rel="stylesheet">
    <!-- Prism Syntax Highlighting-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <link rel="stylesheet" href="vendor/prismjs/plugins/toolbar/prism-toolbar.css">
    <link rel="stylesheet" href="vendor/prismjs/themes/prism-okaidia.css">
    <!-- The Main Theme stylesheet (Contains also Bootstrap CSS)-->
    <link rel="stylesheet" href="css/style.default.css" id="theme-stylesheet">
    <!-- Custom stylesheet - for your changes-->
    <link rel="stylesheet" href="css/custom.css">
    <!-- Favicon-->
    <link rel="shortcut icon" href="img/favicon.png">
  </head>
  <body>
    <div class="page-holder align-items-center py-4 bg-gray-100 vh-100">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-lg-6 px-lg-4">
            <div class="card">
              <div class="card-header px-lg-5">
                <div class="card-heading text-primary">ระบบหลังบ้าน <?php echo $row['domain']; ?></div>
              </div>
              <div class="card-body p-lg-5">
                  <div class="form-floating mb-3">
                    <input class="form-control" id="username" type="email" placeholder="name@example.com">
                    <label for="floatingInput">ชื่อผู้ใช้</label>
                  </div>
                  <div class="form-floating mb-3">
                    <input class="form-control" id="password" type="password" placeholder="Password">
                    <label for="floatingPassword">รหัสผ่าร</label>
                  </div>
                  <div class="form-floating mb-3">
                    <input class="form-control" id="Keylogin" type="text" placeholder="Keylogin">
                    <label for="floatingPassword">คีย์ เข้าระบบ</label>
                  </div>

                  <button class="btn btn-primary btn-lg" onclick="login()">Login</button>
               
              </div>
             
            </div>
          </div>
      
        </div>
      </div>
    </div>

    <script>
    		window.onload = function(){
				 document.getElementById('Keylogin').value =localStorage.getItem('Keylogin');
				 document.getElementById('username').value =localStorage.getItem('username');
				 document.getElementById('password').value =localStorage.getItem('password');
			}

			function save_key(){
        var Keylogin=$("#Keylogin").val();
			localStorage.setItem("Keylogin", Keylogin);
     
		}

	function save_username(){
			var username=$("#username").val();
			localStorage.setItem("username", username);
		}

		function save_password(){
			var password=$("#password").val();
			localStorage.setItem("password", password);
		}
	


			function login() {
        save_username()
			save_password()
      save_key()

				var username=document.getElementById("username").value;
				var password=document.getElementById("password").value;
        var Keylogin=document.getElementById("Keylogin").value;
				if (username=="") {
					Swal.fire({
						icon: 'error',
						title: 'แจ้งเตือน...',
						text:'กรุณากรอก ชื่อผู้ใช้'

					})
					return false
				} else if (password=="") {
					Swal.fire({
						icon: 'error',
						title: 'แจ้งเตือน...',
						text:'กรุณากรอก รหัสผ่าน'

					})
					return false
        } else if (Keylogin=="") {
					Swal.fire({
						icon: 'error',
						title: 'แจ้งเตือน...',
						text:'กรุณากรอก Keylogin'

					})
					return false
				}

				$.ajax({
					url:'action.php?login',
					type:'POST',
					data:{
						username:username,
						password:password,
            Keylogin:Keylogin
					},

					success:function(data){
						if (data!="") {
							var obj = JSON.parse(data);
							var msg=obj.msg
							var status=obj.status
							if (status==200) {
							 location.replace("./main.php?page=dashboard");
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
    <!-- JavaScript files-->
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/js-cookie@2/src/js.cookie.min.js"></script>
    <!-- Main Theme JS File-->
    <script src="js/theme.js"></script>
    <!-- Prism for syntax highlighting-->
    <script src="vendor/prismjs/prism.js"></script>
    <script src="vendor/prismjs/plugins/normalize-whitespace/prism-normalize-whitespace.min.js"></script>
    <script src="vendor/prismjs/plugins/toolbar/prism-toolbar.min.js"></script>
    <script src="vendor/prismjs/plugins/copy-to-clipboard/prism-copy-to-clipboard.min.js"></script>
    <script type="text/javascript">
      // Optional
      Prism.plugins.NormalizeWhitespace.setDefaults({
      'remove-trailing': true,
      'remove-indent': true,
      'left-trim': true,
      'right-trim': true,
      });
          
    </script>
    <script>
      // ------------------------------------------------------- //
      //   Inject SVG Sprite - 
      //   see more here 
      //   https://css-tricks.com/ajaxing-svg-sprite/
      // ------------------------------------------------------ //
      function injectSvgSprite(path) {
      
          var ajax = new XMLHttpRequest();
          ajax.open("GET", path, true);
          ajax.send();
          ajax.onload = function(e) {
          var div = document.createElement("div");
          div.className = 'd-none';
          div.innerHTML = ajax.responseText;
          document.body.insertBefore(div, document.body.childNodes[0]);
          }
      }
      // this is set to BootstrapTemple website as you cannot 
      // inject local SVG sprite (using only 'icons/orion-svg-sprite.svg' path)
      // while using file:// protocol
      // pls don't forget to change to your domain :)
      injectSvgSprite('https://demo.bootstrapious.com/bubbly/1-0/icons/orion-svg-sprite.57a86639.svg');
      
    </script>
    <!-- FontAwesome CSS - loading as last, so it doesn't block rendering-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
  </body>
</html>