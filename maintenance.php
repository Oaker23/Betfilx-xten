<?php 
error_reporting(0);
require_once 'config/config.php';

$sql_website = "SELECT * FROM website LIMIT 1";
$result_website = $server->query($sql_website);
$row_website = mysqli_fetch_assoc($result_website);
if($row_website['enable_webpage'] == 1){
	header("location: dashboard");
}

?>


<!DOCTYPE html>

<html class="">
<head>
    <meta name="viewport" content="width=device-width" />
    <title>ปิดปรับปรุงเว็บไซต์ชั่วคราว - M4BET</title>
	<link rel="icon" type="image/ico" href=manager/upload/img_icon/218.ico />

    <style>
        html {
            height: 100%;
        }

            html.gray-scale-mode {
                filter: grayscale(100%);
                filter: gray;
                -moz-filter: grayscale(100%);
                -webkit-filter: grayscale(100%);
            }

        body {
            font-family: 'Kanit',sans-serif;
            margin: 0;
            min-height: 100%;
            height: 100%;
            background-color: #F6F6F9;
            color: #333;
            font-size: 16px;
        }

        * {
            box-sizing: border-box;
        }

        a {
            color: #594F74;
            text-decoration: none;
            background-color: transparent;
        }

            a:hover {
                color: #463E5C;
                text-decoration: underline;
            }

        .maintenance-content-wrapper {
            height: 100%;
            text-align: center;
        }

            .maintenance-content-wrapper .maintenance-icon {
                margin-bottom: 1.5em;
            }

            .maintenance-content-wrapper::after {
                clear: both;
            }

            .maintenance-content-wrapper .maintenance-content {
                padding: 0 15px 0 15px;
                margin: 0 auto;
            }

                .maintenance-content-wrapper .maintenance-content h1 {
                    margin: 0;
                    font-size: 1.95rem;
                }

                .maintenance-content-wrapper .maintenance-content h3 {
                    /*margin: 0;*/
                    font-size: 1.5rem;
                }

                @media (min-width: 1024px) {
                    .maintenance-content-wrapper .maintenance-content h1 {
                        margin: 0;
                        font-size: 2.1rem;
                    }
                }

            .maintenance-content-wrapper .kk-logo {
                position: absolute;
                right: 1em;
                z-index: 1;
                max-width: 130px;
            }

                .maintenance-content-wrapper .kk-logo svg {
                    width: 100%;
                }

            @media (min-width: 1200px) {
                .maintenance-content-wrapper .kk-logo {
                    max-width: 188px;
                    top: 1em;
                }
            }

        .text-primary {
            color: #594F74 !important;
        }

        .text-secondary {
            color: #635F98 !important;
        }

        .font-weight-bold {
            font-weight: 500 !important;
        }
    </style>
</head>
<body>
    

<div class="maintenance-content-wrapper" id="maintenance_content_wrapper">
    <div class="maintenance-content" id="maintenance_content">
        <div class="maintenance-icon">
            <img src="/images/alert/img_icon_maintenance.png" />
        </div>
        <div><h1 class="text-primary font-weight-bold">ปิดปรับปรุงเว็บไซต์ชั่วคราว</h1></div>
        <div style="margin-bottom: 1.5rem;"><h1 class="text-primary font-weight-bold mb-5">ขออภัยในความไม่สะดวก</h1></div>
    </div>
</div>
<script>
    var defaultPaddingTop = 80;
    // responsive sizing
    window.onresize = function () {
        var innerWidth = window.innerWidth || document.documentElement.clientWidth;
        document.getElementById('maintenance_content').style.width = '50%';
        if (innerWidth < 768) {
            document.getElementById('maintenance_content').style.width = '100%';
        }
        updatePosition();
    };
    // document ready
    document.onreadystatechange = function () {
        if (document.readyState === "complete") {
            updatePosition();
        }
    };
    function updatePosition() {
        var innerWidth = window.innerWidth || document.documentElement.clientWidth;
        var innerHeight = window.innerHeight || document.documentElement.clientHeight;
        
        document.getElementById('maintenance_content').style.fontSize = '15px';
        if (innerWidth > 1024) {
            document.getElementById('maintenance_content').style.fontSize = '20px';
        }
        document.getElementById('maintenance_content').style.paddingTop = '1em';
        var calHeight = (document.getElementById('maintenance_content_wrapper').offsetHeight / 2) - (document.getElementById('maintenance_content').offsetHeight / 2)
        if (calHeight < defaultPaddingTop) {
            calHeight = defaultPaddingTop;
        }
        if (innerWidth >= 992 || (innerWidth < innerHeight)) {
            document.getElementById('maintenance_content').style.paddingTop = calHeight + 'px';
        }
        
    }
</script>

    
</body>
</html>


