<!DOCTYPE html>
<html lang="en" class="h-100">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>ClashRed</title>

    
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">

    <!-- Jquery -->
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>


    
    <!-- Scrollbar Custom CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.css">

    <!-- Font Awesome JS -->
    <link href="https://kit-pro.fontawesome.com/releases/v5.15.3/css/pro.min.css" rel="stylesheet">

    <!-- AOS JS -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <!-- Swiper -->
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />

    <!-- AOS JS -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    
    <!-- Our Custom CSS -->
    <link rel="stylesheet" href="style.css?<?php echo time(); ?>">

      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />

    <!-- Facebook shared -->
    <meta property="og:url"                content="http://www..com/" />
    <meta property="og:type"               content="article" />
    <meta property="og:title"              content="" />
    <meta property="og:description"        content="แค่เว็บเวิร์ดเพรสเว็บหนึ่ง" />
    <meta property="og:image"              content="img" />
    <meta name='robots' content='max-image-preview:large' />

</head>

<body class="d-flex flex-column h-100">

 <div class="wrapper">

    <button class="wrapper-menu  sidebarCollapse"  aria-label="Main Menu">
      <svg width="40" height="40" viewBox="0 0 100 100">
        <path class="line line1" d="M 20,29.000046 H 80.000231 C 80.000231,29.000046 94.498839,28.817352 94.532987,66.711331 94.543142,77.980673 90.966081,81.670246 85.259173,81.668997 79.552261,81.667751 75.000211,74.999942 75.000211,74.999942 L 25.000021,25.000058" />
        <path class="line line2" d="M 20,50 H 80" />
        <path class="line line3" d="M 20,70.999954 H 80.000231 C 80.000231,70.999954 94.498839,71.182648 94.532987,33.288669 94.543142,22.019327 90.966081,18.329754 85.259173,18.331003 79.552261,18.332249 75.000211,25.000058 75.000211,25.000058 L 25.000021,74.999942" />
    </svg>
</button>



<div class="navbarmain">
    <div class="logo">
        <a href="dashboard.php">
            <img src="<?php echo get_template_directory_uri(); ?>/images/logo/logo2.png?v=1">
        </a>
    </div>
    <div class="menuicon">
        <ul class="animate__animated animate__slideInDown">
            <li>
                <a class="tabmenu popupbtn" href="javascript:void(0)" onclick="openPopupTab(event, 'personalct')">
                    <img src="<?php echo get_template_directory_uri(); ?>/images/icon/user.png">
                <span>ข้อมูลส่วนตัว</span>
                </a>
            </li>
            <li>
                <a class="tabmenu popupbtn" href="javascript:void(0)" onclick="openPopupTab(event, 'depositct')">
                    <img src="<?php echo get_template_directory_uri(); ?>/images/icon/footer-menu-ic-right-1.png">
                <span>ฝาก</span>
                </a>
            </li>
            <li>
                <a class="tabmenu popupbtn" href="javascript:void(0)" onclick="openPopupTab(event, 'withdrawct')">
                    <img src="<?php echo get_template_directory_uri(); ?>/images/icon/footer-menu-ic-right-2.png">
                <span>ถอน</span>
                </a>
            </li>
            <li>
                <a class="tabmenu popupbtn" href="javascript:void(0)" onclick="openPopupTab(event, 'returncreditct')">
                    <img src="<?php echo get_template_directory_uri(); ?>/images/icon/return.png">
                <span>คืนยอดเสีย</span>
                </a>
            </li>
            <li>
                <a class="tabmenu popupbtn" href="javascript:void(0)" onclick="openPopupTab(event, 'changepasswordct')">
                    <img src="<?php echo get_template_directory_uri(); ?>/images/icon/lock.png">
                <span>เปลี่ยนรหัส</span>
                </a>
            </li>
            <li>
                <a class="tabmenu popupbtn" href="javascript:void(0)" onclick="openPopupTab(event, 'historyct')">
                    <img src="<?php echo get_template_directory_uri(); ?>/images/icon/history.png">
                <span>ประวัติ</span>
                </a>
            </li>
            <li >
                <a class="tabmenu popupbtn" href="javascript:void(0)" onclick="openPopupTab(event, 'friendstab')">
                    <img src="<?php echo get_template_directory_uri(); ?>/images/icon/friends.png">
                <span>ชวนเพื่อน</span>
                </a>
            </li>
            <li >
                <a class="tabmenu " href="javascript:void(0)" onclick="openTabBox(event, 'promotionstab')">
                    <img src="<?php echo get_template_directory_uri(); ?>/images/icon/icn-hot-checked.png">
                <span>โปรโมชั่น</span>
                </a>
            </li>
            <li>
                <a class="tabmenu" href="javascript:void(0)" onclick="openTabBox(event, 'othertab')">
                    <img src="<?php echo get_template_directory_uri(); ?>/images/icon/icn-esports-checked.png">
                <span>อื่นๆ</span>
                </a>
            </li>
            
            <li>
                <a class="tabmenu d-flex d-lg-none" href="index.php" >
                    <img src="<?php echo get_template_directory_uri(); ?>/images/icon/logout.png">
                <span>ออกระบบ</span>
                </a>
            </li>
            
        </ul>
        <div class="overlaymenu"></div>
    </div>
    <div class="personalnav">
        <div class="spanname">
            <span>0912345678 <img onclick="location.href='index.php'" src="<?php echo get_template_directory_uri(); ?>/images/icon/logout.png"></span>
        </div>
        <div class="balancecredit">
            <img src="<?php echo get_template_directory_uri(); ?>/images/icon/ic-coin.png">
            <i class="fas fa-redo-alt"></i> 9,999,000 บาท
        </div>
    </div>

</div>









<div class="fixedcontain">
    <div class="fixedleft">
        <div class="sidegamebar">
            <div class="tabgamemenu">
                <ul>
                  <li class="tabmenu sport active" onclick="openTabBox(event, 'sportstab')">
                      <img src="<?php echo get_template_directory_uri(); ?>/images/icon/icn-sportsbook-check.png">
                      <span>กีฬา</span>
                  </li>
                    <li class="tabmenu" onclick="openTabBox(event, 'casinostab')">
                        <img src="<?php echo get_template_directory_uri(); ?>/images/icon/icon04.png">
                        <span>คาสิโนสด</span>
                    </li>
                    <li class="tabmenu" onclick="openTabBox(event, 'slotstab')">
                        <img src="<?php echo get_template_directory_uri(); ?>/images/icon/icon05.png">
                        <span>สล็อต</span>
                    </li>
                    <li class="tabmenu" onclick="openTabBox(event, 'homegamestab')">
                        <img src="<?php echo get_template_directory_uri(); ?>/images/icon/icon06.png">
                        <span>เกมพื้นบ้าน</span>
                    </li>
                    <li class="tabmenu" onclick="openTabBox(event, 'fishstab')">
                        <img src="<?php echo get_template_directory_uri(); ?>/images/icon/icn-fishing-checked.png">
                        <span>เกมยิงปลา</span>
                    </li>
                </ul>
                <div class="linechatfixed">
                    <a href="javascript:void(0)">
                        <img src="<?php echo get_template_directory_uri(); ?>/images/icon/linetext.png">
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="fixedright">
      <div class="sectiongame">
         <div class="swiper-container-2">
            <div class="swiper-wrapper">
               <div class="swiper-slide">
                  <img src="<?php echo get_template_directory_uri(); ?>/images/alert/b01.jpg">
               </div>
               <div class="swiper-slide">
                  <img src="<?php echo get_template_directory_uri(); ?>/images/alert/b02.jpg">
               </div>
               <div class="swiper-slide">
                  <img src="<?php echo get_template_directory_uri(); ?>/images/alert/b03.jpg">
               </div>
            </div>
            <!-- Add Pagination -->
            <div class="swiper-pagination"></div>
            <div class="swiper-button-prev swiper-button-white"></div>
            <div class="swiper-button-next swiper-button-white"></div>
         </div>
         


<div class="containmain">
    <!-- Games Tab -->
    <?php include('gamestab.php'); ?>
    <!-- Games Tab -->



<div class="tabmainbox" id="promotionstab">
    <div class="headergame"><h1>โปรโมชั่นสุดพิเศษ</h1></div>
                     <div class="gridgame full" >
                       <div class="ingridgame ">
                          <div class="iningridgame pro">
                          <img class="accordion" src="<?php echo get_template_directory_uri(); ?>/images/promotions/01.jpg?v=1">
                            <div class="panel">
                              <div class="inpanel">

    <h5>คืนยอดเสีย 5% ทุกวันศุกร์</h5>
    ➭ รับโบนัสคืนยอดเสียรวม สัปดาห์ (ตัดรอบ วันศุกร์ 11:00 ถึง 10:59 ของวันศุกร์อีกสัปดาห์)
 <br>➭ มียอดเสียมากกว่า 1000 บาทต่อสัปดาห์ และต้องมียอดเทิร์นโอเวอร์ 5 เท่า ของยอดฝาก จึงจะได้รับคืนยอดเสีย 5 %
 <br>➭ รับคืนสูงสุด 5000 บาท
 <br>➭ เมื่อรับโปรโมชั่นเครดิตมีอายุการใช้งาน 1 วันจากนั้นเครดิตคืนยอดเสียจะถูกปรับเป็น 0
 <br>➭ โบนัสจะได้รับทุกวันศุกร์สามารถกดรับได้ที่หน้าเว็บตั้งแต่ 11:30 น. เป็นต้นไป

<button type="button" class="btnLogin my-3"><span>รับโปรโมชั่น</span></button>
                              </div>
                            </div>
                           </div>
                       </div>
                       <div class="ingridgame">
                          <div class="iningridgame pro">
                          <img class="accordion" src="<?php echo get_template_directory_uri(); ?>/images/promotions/02.jpg?v=1">
                            <div class="panel">
                              <div class="inpanel">

    <h5>คืนยอดเสีย 5% ทุกวันศุกร์</h5>
    ➭ รับโบนัสคืนยอดเสียรวม สัปดาห์ (ตัดรอบ วันศุกร์ 11:00 ถึง 10:59 ของวันศุกร์อีกสัปดาห์)
 <br>➭ มียอดเสียมากกว่า 1000 บาทต่อสัปดาห์ และต้องมียอดเทิร์นโอเวอร์ 5 เท่า ของยอดฝาก จึงจะได้รับคืนยอดเสีย 5 %
 <br>➭ รับคืนสูงสุด 5000 บาท
 <br>➭ เมื่อรับโปรโมชั่นเครดิตมีอายุการใช้งาน 1 วันจากนั้นเครดิตคืนยอดเสียจะถูกปรับเป็น 0
 <br>➭ โบนัสจะได้รับทุกวันศุกร์สามารถกดรับได้ที่หน้าเว็บตั้งแต่ 11:30 น. เป็นต้นไป

<button type="button" class="btnLogin my-3"><span>รับโปรโมชั่น</span></button>
                              </div>
                            </div>
                           </div>
                       </div>
                       <div class="ingridgame">
                          <div class="iningridgame pro">
                          <img class="accordion" src="<?php echo get_template_directory_uri(); ?>/images/promotions/03.jpg?v=1">
                            <div class="panel">
                              <div class="inpanel">

    <h5>คืนยอดเสีย 5% ทุกวันศุกร์</h5>
    ➭ รับโบนัสคืนยอดเสียรวม สัปดาห์ (ตัดรอบ วันศุกร์ 11:00 ถึง 10:59 ของวันศุกร์อีกสัปดาห์)
 <br>➭ มียอดเสียมากกว่า 1000 บาทต่อสัปดาห์ และต้องมียอดเทิร์นโอเวอร์ 5 เท่า ของยอดฝาก จึงจะได้รับคืนยอดเสีย 5 %
 <br>➭ รับคืนสูงสุด 5000 บาท
 <br>➭ เมื่อรับโปรโมชั่นเครดิตมีอายุการใช้งาน 1 วันจากนั้นเครดิตคืนยอดเสียจะถูกปรับเป็น 0
 <br>➭ โบนัสจะได้รับทุกวันศุกร์สามารถกดรับได้ที่หน้าเว็บตั้งแต่ 11:30 น. เป็นต้นไป

<button type="button" class="btnLogin my-3"><span>รับโปรโมชั่น</span></button>
                              </div>
                            </div>
                           </div>
                       </div>
                       <div class="ingridgame">
                          <div class="iningridgame pro">
                          <img class="accordion" src="<?php echo get_template_directory_uri(); ?>/images/promotions/04.jpg?v=1">
                            <div class="panel">
                              <div class="inpanel">

    <h5>คืนยอดเสีย 5% ทุกวันศุกร์</h5>
    ➭ รับโบนัสคืนยอดเสียรวม สัปดาห์ (ตัดรอบ วันศุกร์ 11:00 ถึง 10:59 ของวันศุกร์อีกสัปดาห์)
 <br>➭ มียอดเสียมากกว่า 1000 บาทต่อสัปดาห์ และต้องมียอดเทิร์นโอเวอร์ 5 เท่า ของยอดฝาก จึงจะได้รับคืนยอดเสีย 5 %
 <br>➭ รับคืนสูงสุด 5000 บาท
 <br>➭ เมื่อรับโปรโมชั่นเครดิตมีอายุการใช้งาน 1 วันจากนั้นเครดิตคืนยอดเสียจะถูกปรับเป็น 0
 <br>➭ โบนัสจะได้รับทุกวันศุกร์สามารถกดรับได้ที่หน้าเว็บตั้งแต่ 11:30 น. เป็นต้นไป

<button type="button" class="btnLogin my-3"><span>รับโปรโมชั่น</span></button>
                              </div>
                            </div>
                           </div>
                       </div>
                       <div class="ingridgame">
                          <div class="iningridgame pro">
                          <img class="accordion" src="<?php echo get_template_directory_uri(); ?>/images/promotions/05.jpg?v=1">
                            <div class="panel">
                              <div class="inpanel">

    <h5>คืนยอดเสีย 5% ทุกวันศุกร์</h5>
    ➭ รับโบนัสคืนยอดเสียรวม สัปดาห์ (ตัดรอบ วันศุกร์ 11:00 ถึง 10:59 ของวันศุกร์อีกสัปดาห์)
 <br>➭ มียอดเสียมากกว่า 1000 บาทต่อสัปดาห์ และต้องมียอดเทิร์นโอเวอร์ 5 เท่า ของยอดฝาก จึงจะได้รับคืนยอดเสีย 5 %
 <br>➭ รับคืนสูงสุด 5000 บาท
 <br>➭ เมื่อรับโปรโมชั่นเครดิตมีอายุการใช้งาน 1 วันจากนั้นเครดิตคืนยอดเสียจะถูกปรับเป็น 0
 <br>➭ โบนัสจะได้รับทุกวันศุกร์สามารถกดรับได้ที่หน้าเว็บตั้งแต่ 11:30 น. เป็นต้นไป

                              </div>
                            </div>
                           </div>
                       </div>
                    </div>
</div>







<div class="tabmainbox" id="othertab">
    <div class="headergame"><h1>เดิมพันอื่นๆ</h1></div>
    <div class="row m-0">
        <div class="col-6 p-2">
            <img src="<?php echo get_template_directory_uri(); ?>/images/others/01.jpg">
        </div>
        <div class="col-6 p-2">
            <img src="<?php echo get_template_directory_uri(); ?>/images/others/02.jpg">
        </div>
        <div class="col-6 p-2">
            <img src="<?php echo get_template_directory_uri(); ?>/images/others/03.jpg">
        </div>
        <div class="col-6 p-2">
            <img src="<?php echo get_template_directory_uri(); ?>/images/others/04.jpg">
        </div>
    </div>
</div>







 </div>


<div class="section02">
   <div class="row howtoplay">
      <div class="col-12 col-lg-6 p-0 inhowtoplay">
         <img src="<?php echo get_template_directory_uri(); ?>/images/icon/reg1.png">
      </div>
      <div class="col-12 col-lg-6 p-0 inhowtoplay">
         <img src="<?php echo get_template_directory_uri(); ?>/images/icon/reg2.png">
      </div>
   </div>
</div>









<div class="section04">
    <div class="containsec04">
      <div class="row m-0 mt-2">
        <div class=" col-12 col-lg-4 p-0 pt-3 order-last order-lg-first position-relative leftsec03">
          <div class="imgleftsec04">
            <img src="<?php echo get_template_directory_uri(); ?>/images/icon/UFABET-1.png">
          </div>

        </div>
        <div class="col-12 col-lg-8 p-0  order-first order-lg-last">
          <div class="py-lg-5 py-4 px-lg-5 px-sm-5 px-sm-4 px-2   tcentersec04 colorrightsec4">
            <div>
            <div class="logosec4">
              <img src="<?php echo get_template_directory_uri(); ?>/images/logo/logo2.png?v=1">

            </div>
            <div class="detailsec3 text-left">
                <div class="headersec4">
                    สนุก และ คว้าชัยชนะได้ทุกที่ทุกเวลา
                    </div>
                    แพลตฟอร์ม คาสิโน สปอร์ต และ เกมพนันให้คุณสามารถเลือกได้ในแบบที่คุณต้องการด้วยฝ่ายบริการลูกค้าคุณภาพ 24 ชั่วโมงและระบบฝากถอนแสนง่าย อัจฉริยะ ที่ใครๆ ก็ว้าว
                </div>
                <div class="imgdetailsec4">
                    <img src="<?php echo get_template_directory_uri(); ?>/images/icon/tab_index_bottom_banner_1.png">
                </div>
                <div class="imgdetailsec4">
                    <img src="<?php echo get_template_directory_uri(); ?>/images/icon/tab_index_bottom_banner_2.png">
                </div>
                <div class="imgdetailsec4">
                    <img src="<?php echo get_template_directory_uri(); ?>/images/icon/tab_index_bottom_banner_3.png">
                </div>

          </div>
          </div>
        </div>
      </div>
    </div>
</div>











<div class="section03">
    <div class="headergametype">
            <h1>เดิมพันยอดนิยม</h1>
    </div>
    <div class="row allgametype">
        <div class="col-6 col-lg-3 inallgametype">
            <img src="<?php echo get_template_directory_uri(); ?>/images/icon/icon-game1.png">
        </div>
        <div class="col-6 col-lg-3 inallgametype">
            <img src="<?php echo get_template_directory_uri(); ?>/images/icon/icon-game2.png">
        </div>
        <div class="col-6 col-lg-3 inallgametype">
            <img src="<?php echo get_template_directory_uri(); ?>/images/icon/icon-game3.png">
        </div>
        <div class="col-6 col-lg-3 inallgametype">
            <img src="<?php echo get_template_directory_uri(); ?>/images/icon/icon-game4.png">
        </div>
    </div>
</div>










<footer class="footer mt-auto">
   <section class="tagcontainer pt-2 pb-2">
      <div class="container">
         <span class="tagfooter">
            <div class="textwidget"><a href="/">myrichgame</a></div>
         </span>
      </div>
   </section>
   <div class="fotterctn">
      <div class="disfooterct">
         <div class="infootergrid p-0 text-break">
            <div class="text-center">
               <div class="trueimg">
                <span class="headerbt">รองรับ TrueWallet</span>
                <img src="<?php echo get_template_directory_uri(); ?>/images/icon/true.png">
                </div>                        
            </div>
            <div class="bankcontainer">
               <img src="<?php echo get_template_directory_uri(); ?>/images/bank/kbank.svg">
               <img src="<?php echo get_template_directory_uri(); ?>/images/bank/baac.svg">
               <img src="<?php echo get_template_directory_uri(); ?>/images/bank/bay.svg"> 
               <img src="<?php echo get_template_directory_uri(); ?>/images/bank/bbl.svg">
               <img src="<?php echo get_template_directory_uri(); ?>/images/bank/scb.svg">
               <img src="<?php echo get_template_directory_uri(); ?>/images/bank/gsb.svg">
               <img src="<?php echo get_template_directory_uri(); ?>/images/bank/ktb.svg">
               <img src="<?php echo get_template_directory_uri(); ?>/images/bank/ttb.svg">
               <img src="<?php echo get_template_directory_uri(); ?>/images/bank/kiatnakin.svg">
               <img src="<?php echo get_template_directory_uri(); ?>/images/bank/tisco.svg">
            </div>
         </div>
      </div>
   </div>
   <div class="footercontain">
      <div class="disfooterct">
         <div class="infootergrid pt-3">
            <div class="mx-auto">
                <img src="<?php echo get_template_directory_uri(); ?>/images/logo/logo2.png?v=1">
            </div>
         </div>
         <div class="infootergrid pt-3">
            <div class="mx-auto">
               <h2 class="widgettitle">MYRICHGAME</h2>
               <div class="textwidget">เว็บไซต์ MYRICHGAME เปิดให้บริการคาสิโนมาอย่างยาวนานกว่า 10 ปี เรามีเกมคาสิโนครบครันมากมายกว่า 1000+ เกม รวมไปถึงเรายังมีค่ายเกมฮิตในไทย มากที่สุดอีกด้วย หากคุณสนใจและกำลังมองหาเว็บไซต์ บาคาร่า คาสิโนสด เราขอแนะนำเว็บ MYRICHGAME ครบจบในที่เดียว สมัครฟรี ไม่มีขั้นต่ำ</div>
            </div>
         </div>
         <div class="infootergrid pt-3"></div>
      </div>
   </div>
</footer>
         </div>
    </div>
</div>








<!-- -------------  ข้อมูลส่วนตัว  ---------------- -->
<div class="contentmodaldiv" id="personalct">
 <div class="modaldiv">
    <div class="contentmodal animate__animated animate__bounceInDown" >
        <button class="closepopup"><i class="fas fa-times"></i></button>
        <div class="login">
         <div class="logopopup">
             <img src="<?php echo get_template_directory_uri(); ?>/images/logo/logo2.png?v=1">
         </div>
            <h1>ข้อมูลส่วนตัว</h1>
            <div class="detailuser">
                <table>
                    <tr>
                        <td>
                            <i class="fas fa-user"></i>
                        </td>
                        <td>
                            ทดสอบทด สอบระบบ
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <i class="fas fa-phone-alt"></i>
                        </td>
                        <td>
                            091-123-1233
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <img src="<?php echo get_template_directory_uri(); ?>/images/bank/ttb.svg">
                        </td>
                        <td>
                            012-3-45678-9
                        </td>
                    </tr>
                    <tr>
                        <td>
                            ยูส
                        </td>
                        <td>
                            myrichgame01
                        </td>
                    </tr>
                    <tr>
                        <td>
                            โปร
                        </td>
                        <td>
                            สมัครใหม่รับ 50% เทิร์น 200 เท่า
                        </td>
                    </tr>
                    <tr>
                        <td>
                            เครดิต
                        </td>
                        <td>
                            9,999,000 บาท
                        </td>
                    </tr>
                </table>
            </div>
         </div>
    </div>
    <div class="overlaymodal"></div>
</div>
</div>
<!-- -------------  ข้อมูลส่วนตัว  ---------------- -->












<!-- -------------  ฝาก  ---------------- -->
<div class="contentmodaldiv" id="depositct">
 <div class="modaldiv">
    <div class="contentmodal animate__animated animate__bounceInDown" >
        <button class="closepopup"><i class="fas fa-times"></i></button>
        <div class="login">
         <div class="logopopup">
             <img src="<?php echo get_template_directory_uri(); ?>/images/logo/logo2.png?v=1">
         </div>
            <h1>ฝากเงิน</h1>
        <div class="row m-0 mt-4">
            <div class="col-3 p-0 leftdps">
               <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                  <a class="nav-link active" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true"><img class="banktabicon" src="<?php echo get_template_directory_uri(); ?>/images/icon/bankicon.png?v=2"> ธนาคาร</a>
                  <a class="nav-link" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false"><img class="banktabicon" src="<?php echo get_template_directory_uri(); ?>/images/bank/truewallet.svg?v=1"> TrueWallet</a>
               </div>
            </div>
            <div class="col-9 p-0">
               <div class="tab-content" id="v-pills-tabContent">
                  <div class="tab-pane fade active show" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                     <div class="griddps">
                        <div class="ingriddps">
                           <div class="iningriddps copybtn">
                              <img src="<?php echo get_template_directory_uri(); ?>/images/bank/scb.svg"> <br>
                              ธนาคารไทยพาณิชย์ <br>
                              <span>123-456-7890</span> <br>
                              ทดสอบ ทดสอบ <br>
                              <button onclick="copylink()"><i class="fad fa-copy"></i> คัดลอก</button>
                           </div>
                        </div>
                        <div class="ingriddps">
                           <div class="iningriddps copybtn">
                              <img src="<?php echo get_template_directory_uri(); ?>/images/bank/kbank.svg"> <br>
                              ธนาคารไทยพาณิชย์ <br>
                              <span>123-456-7890</span> <br>
                              ทดสอบ ทดสอบ <br>
                              <button onclick="copylink()"><i class="fad fa-copy"></i> คัดลอก</button>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                     <div class="griddps">
                        <div class="ingriddps">
                           <div class="iningriddps copybtn">
                              <img src="<?php echo get_template_directory_uri(); ?>/images/bank/truewallet.svg?v=1"> <br>
                              ธนาคารไทยพาณิชย์ <br>
                              <span>123-456-7890</span> <br>
                              ทดสอบ ทดสอบ <br>
                              <button onclick="copylink()"><i class="fad fa-copy"></i> คัดลอก</button>
                           </div>
                        </div>
                        <div class="ingriddps">
                           <div class="iningriddps copybtn">
                              <img src="<?php echo get_template_directory_uri(); ?>/images/bank/truewallet.svg?v=1"> <br>
                              ธนาคารไทยพาณิชย์ <br>
                              <span>123-456-7890</span> <br>
                              ทดสอบ ทดสอบ <br>
                              <button onclick="copylink()"><i class="fad fa-copy"></i> คัดลอก</button>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="modalspanbox mt-3">
            หากลูกค้าฝากเงินสด ผ่านตู้ หรือ ช่องทางอื่น
            กรุณาติดต่อแอดมินทุกกรณี
         </div>
         </div>
    </div>
    <div class="overlaymodal"></div>
</div>
</div>
<!-- -------------  ฝาก  ---------------- -->




<!-- -------------  ถอน  ---------------- -->
<div class="contentmodaldiv" id="withdrawct">
 <div class="modaldiv">
    <div class="contentmodal animate__animated animate__bounceInDown" >
        <button class="closepopup"><i class="fas fa-times"></i></button>
        <div class="login">
         <div class="logopopup">
             <img src="<?php echo get_template_directory_uri(); ?>/images/logo/logo2.png?v=1">
         </div>
            <h1><img src="<?php echo get_template_directory_uri(); ?>/images/icon/cd.png"> ถอนเงิน</h1>
            <div class="nmwdcontain">
               <hr class="x-hr-border-glow mb-1 mt-1">
               <div class="detailwd accountct">
                  <table align="center">
                     <tbody>
                        <tr>
                           <td>
                              <img src="<?php echo get_template_directory_uri(); ?>/images/bank/ttb.svg">
                           </td>
                           <td>
                              ธนาคาร: ทหารไทยธนชาต <br>
                              <span>เลขบัญชี: 012-3-45678-1</span><br>
                              <span>ชื่อบัญชี: ทดสอบทด สอบระบบ</span>
                           </td>
                        </tr>
                     </tbody>
                  </table>
               </div>
               <div class="headerbankdt mt-3 mb-1">
                  ยอดเงินคงเหลือ 300 บาท
               </div>
               <div class=" form-group mb-4">
                  <div class="el-input">
                     <input type="text" placeholder="ถอนขั้นต่ำ 1 บาท" class="inputstyle text-center p-0 py-2">
                  </div>
               </div>
               <button type="button" class="btnLogin mt-0 mb-3" onclick="location.href='dashboard.php'">
               <span>
               ถอนเงิน
               </span>
               </button>
            </div>
         </div>
    </div>
    <div class="overlaymodal"></div>
</div>
</div>
<!-- -------------  ถอน  ---------------- -->




<!-- -------------  เครดิตเงินคืน  ---------------- -->
<div class="contentmodaldiv" id="returncreditct">
 <div class="modaldiv">
    <div class="contentmodal animate__animated animate__bounceInDown" >
        <button class="closepopup"><i class="fas fa-times"></i></button>
        <div class="login">
         <div class="logopopup">
             <img src="<?php echo get_template_directory_uri(); ?>/images/logo/logo2.png?v=1">
         </div>
            <h1>เครดิตเงินคืน</h1>
            <div class="modalspanbox mt-3">
            คำนวณคืนยอดเสียตั้งแต่วันที่<br>
            30-11-2021 ถึง 06-12-2021
            </div>
            <h1>CASHBACK ที่ได้รับ</h1>
            <h5 class="cashbacknb">
                3,005.59 บาท
            </h5>
            <button type="button" class="btnLogin my-3" onclick="location.href='dashboard.php'">
               <span>รับ CASHBACK</span>
            </button>
            <hr class="cashbackhr">
            <div class="modalspanbox mt-3 text-left">
            <div class="text-center">▶ เงื่อนไขการถอนเงิน สำหรับโปร คืนยอดเสีย 10%</div><br>
✅ สมาชิกต้องทำ TurnOver ครบ 3 เท่าจากจำนวนคืนยอดเสียที่ได้รับ จึงสามารถทำรายการถอนเงินได้<br>
✅ การคืนยอดเสียจะถูกคำนวนรอบรายการเล่นจากวันจันทร์ - วันอาทิตย์ ระบบจะประมวลผลให้ในวันจันทร์ถัดไป เวลา 14:00 น. เป็นต้นไป<br>
            </div>
         </div>
    </div>
    <div class="overlaymodal"></div>
</div>
</div>
<!-- -------------  เครดิตเงินคืน  ---------------- -->







<!-- -------------  แนะนำเพื่อน  ---------------- -->
<div class="contentmodaldiv" id="friendstab">
 <div class="modaldiv">
    <div class="contentmodal animate__animated animate__bounceInDown" >
        <button class="closepopup"><i class="fas fa-times"></i></button>
        <div class="login">
         <div class="logopopup">
             <img src="<?php echo get_template_directory_uri(); ?>/images/logo/logo2.png?v=1">
         </div>
            <h1>ชวนเพื่อน</h1>
            <div class="detailwd accountct">
                <table align="center">
                   <tbody>
                      <tr>
                         <td>
                            <img src="<?php echo get_template_directory_uri(); ?>/images/bank/ttb.svg">
                         </td>
                         <td>
                            <b>บัญชีรับรายได้</b><br>
                            ธนาคาร: ทหารไทยธนชาต <br>
                            <span>เลขบัญชี: 012-3-45678-1</span><br>
                            <button>ถอนรายได้</button>
                         </td>
                      </tr>
                   </tbody>
                </table>
             </div>
         <div class="text-center friendtext">
            คัดลอกลิงค์
            <div class=" form-group mb-0">
               <div class="el-input">
                  <i class="fad fa-users-medical"></i>
                  <input type="text" onclick="copylink()" id="friendlink" placeholder="รหัสผู้ใช้งาน" class="inputstyle friendlink" readonly="" value="https://msn.bet/register?prefix=GC289&amp;ref=GC28914942">
               </div>
            </div>
         </div>
         <div class="containinputwd mt-3 mb-1" id="allfriend">
            <table class="mt-0 levelfriend">
               <tbody>
                  <tr>
                     <td class="text-left">
                        <i class="fad fa-coins"></i> <span>ส่วนแบ่งรายได้ชั้นที่ 1</span>
                     </td>
                     <td class="text-right">
                        <span>10 %</span>
                     </td>
                  </tr>
                  <tr>
                     <td class="text-left">
                        <i class="fad fa-coins"></i> <span>ส่วนแบ่งรายได้ชั้นที่ 2</span>
                     </td>
                     <td class="text-right">
                        <span>5 %</span>
                     </td>
                  </tr>
               </tbody>
            </table>
            <div>
               <div class="headdtf">
                  <span class="detailaf">รายละเอียด</span>
               </div>
               <div role="alert" class="frienddetail">
                  <div class="row m-0">
                     <div class="col-6 p-0 text-left">
                        <span>เพื่อนทั้งหมด</span>
                     </div>
                     <div class="col-4 p-0 text-right">0</div>
                     <div class="col-2 p-0">คน</div>
                  </div>
                  <div class="row m-0">
                     <div class="col-6 p-0 text-left">
                        <span>เพื่อนที่ฝาก</span>
                     </div>
                     <div class="col-4 p-0 text-right">0</div>
                     <div class="col-2 p-0">คน</div>
                  </div>
                  <div class="row m-0">
                     <div class="col-6 p-0 text-left">
                        <span>ยอดฝาก</span>
                     </div>
                     <div class="col-4 p-0 text-right">0.00</div>
                     <div class="col-2 p-0">บาท</div>
                  </div>
                  <div class="row m-0">
                     <div class="col-6 p-0 text-left">
                        <span>ยอดแทงเสีย</span>
                     </div>
                     <div class="col-4 p-0 text-right">0.00</div>
                     <div class="col-2 p-0">C</div>
                  </div>
               </div>
            </div>
         </div>

         </div>
    </div>
    <div class="overlaymodal"></div>
</div>
</div>
<!-- -------------  แนะนำเพื่อน  ---------------- -->







<!-- -------------  เปลี่ยนรหัสผ่าน  ---------------- -->
<div class="contentmodaldiv" id="changepasswordct">
 <div class="modaldiv">
    <div class="contentmodal animate__animated animate__bounceInDown" >
        <button class="closepopup"><i class="fas fa-times"></i></button>
        <div class="login">
         <div class="logopopup">
             <img src="<?php echo get_template_directory_uri(); ?>/images/logo/logo2.png?v=1">
         </div>
            <h1>เปลี่ยนรหัสผ่าน</h1>
            <form class="mt-4" id="form2" name="form2" method="post">
                <input class="mb-4" id="password" name="password" type="password" placeholder="รหัสผ่านเดิม">
               <input class="mb-4" id="password" name="password" type="password" placeholder="รหัสผ่านใหม่">
               <input class="mb-2" id="password" name="cfpassword" type="cfpassword" placeholder="ยืนยันรหัสผ่านใหม่">

               <a href="dashboard.php" class="btnLogin" id="btnLogin">เปลี่ยนรหัสผ่าน</a>
            </form>
         </div>
    </div>
    <div class="overlaymodal"></div>
</div>
</div>
<!-- -------------  เปลี่ยนรหัสผ่าน  ---------------- -->


<!-- -------------  ประวัติ  ---------------- -->
<div class="contentmodaldiv" id="historyct">
 <div class="modaldiv">
    <div class="contentmodal animate__animated animate__bounceInDown" >
        <button class="closepopup"><i class="fas fa-times"></i></button>
        <div class="login">
         <div class="logopopup">
             <img src="<?php echo get_template_directory_uri(); ?>/images/logo/logo2.png?v=1">
         </div>
            <h1>ประวัติธุรกรรม</h1>
                     <div class="row mt-3">
            <div class="col-2 p-0 leftdps">
               <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                  <a class="nav-link green active" id="v-pills-allwdpds-tab" data-toggle="pill" href="#v-pills-allwdpds" role="tab" aria-controls="v-pills-allwdpds" aria-selected="true">ฝาก - ถอน</a>
                  <a class="nav-link green" id="v-pills-dps-tab" data-toggle="pill" href="#v-pills-dps" role="tab" aria-controls="v-pills-dps" aria-selected="true">ฝาก</a>
                  <a class="nav-link red" id="v-pills-wd-tab" data-toggle="pill" href="#v-pills-wd" role="tab" aria-controls="v-pills-wd" aria-selected="false">ถอน</a>
                  <a class="nav-link red" id="v-pills-hisgames-tab" data-toggle="pill" href="#v-pills-hisgames" role="tab" aria-controls="v-pills-hisgames" aria-selected="false">เดิมพัน</a>
               </div>
            </div>
            <div class="col-10 p-0 containhislist">
               <div class="tab-content" id="v-pills-tabContent">
                  <div class="tab-pane fade show active" id="v-pills-allwdpds" role="tabpanel" aria-labelledby="v-pills-allwdpds-tab">
                     <div class="containerhis">
                        <!--  Loop list DPS -->
                        <div class="listhtwd">
                           
                           <table>
                              <tbody>
                                 <tr>
                                    <td>
                                       <span class="badge rounded-pill bg-success"><i class="fas fa-check-circle"></i> อนุมัติ</span><br>
                                       123-2-12312-1<br>
                                       <span class="timehis">ธนาคารไทยพาณิชย์</span>
                                    </td>
                                    <td>
                                       <b>ถอน</b><br>
                                       250,000.00 บาท <br>
                                       <span class="timehis">15/02/2021 05:50:34</span>
                                    </td>
                                 </tr>
                              </tbody>
                           </table>
                        </div>
                        <div class="listht">
                           
                           <table>
                              <tbody>
                                 <tr>
                                    <td>
                                       <span class="badge rounded-pill bg-success"><i class="fas fa-check-circle"></i> อนุมัติ</span><br>
                                       123-2-12312-1<br>
                                       <span class="timehis">ธนาคารไทยพาณิชย์</span>
                                    </td>
                                    <td>
                                       <b>ฝาก</b><br>
                                       250,000.00 บาท <br>
                                       <span class="timehis">15/02/2021 05:50:34</span>
                                    </td>
                                 </tr>
                              </tbody>
                           </table>
                        </div>
                        <div class="listht">
                           
                           <table>
                              <tbody>
                                 <tr>
                                    <td>
                                       <span class="badge rounded-pill bg-danger"><i class="fas fa-times-circle"></i> ไม่อนุมัติ</span><br>
                                       123-2-12312-1<br>
                                       <span class="timehis">ธนาคารไทยพาณิชย์</span>
                                    </td>
                                    <td>
                                       <b>ฝาก</b><br>
                                       250,000.00 บาท <br>
                                       <span class="timehis">15/02/2021 05:50:34</span>
                                    </td>
                                 </tr>
                              </tbody>
                           </table>
                        </div>
                        <!--  END Loop list DPS -->
                     </div>
                  </div>
                  <div class="tab-pane fade" id="v-pills-dps" role="tabpanel" aria-labelledby="v-pills-dps-tab">
                     <div class="containerhis">
                        <!--  Loop list DPS -->
                        <div class="listht">
                           <span class="badge rounded-pill bg-success"><i class="fas fa-check-circle"></i> อนุมัติ</span>
                           <table>
                              <tbody>
                                 <tr>
                                    <td>
                                       123-2-12312-1<br>
                                       <span class="timehis">ธนาคารไทยพาณิชย์</span>
                                    </td>
                                    <td>
                                       250,000.00 บาท <br>
                                       <span class="timehis">15/02/2021 05:50:34</span>
                                    </td>
                                 </tr>
                              </tbody>
                           </table>
                        </div>
                        <div class="listht">
                           <span class="badge rounded-pill bg-success"><i class="fas fa-check-circle"></i> อนุมัติ</span>
                           <table>
                              <tbody>
                                 <tr>
                                    <td>
                                       123-2-12312-1<br>
                                       <span class="timehis">ธนาคารไทยพาณิชย์</span>
                                    </td>
                                    <td>
                                       250,000.00 บาท <br>
                                       <span class="timehis">15/02/2021 05:50:34</span>
                                    </td>
                                 </tr>
                              </tbody>
                           </table>
                        </div>
                        <div class="listht">
                           <span class="badge rounded-pill bg-danger"><i class="fas fa-times-circle"></i> ไม่อนุมัติ</span>
                           <table>
                              <tbody>
                                 <tr>
                                    <td>
                                       123-2-12312-1<br>
                                       <span class="timehis">ธนาคารไทยพาณิชย์</span>
                                    </td>
                                    <td>
                                       250,000.00 บาท <br>
                                       <span class="timehis">15/02/2021 05:50:34</span>
                                    </td>
                                 </tr>
                              </tbody>
                           </table>
                        </div>
                        <!--  END Loop list DPS -->
                     </div>
                  </div>
                  <div class="tab-pane fade" id="v-pills-wd" role="tabpanel" aria-labelledby="v-pills-wd-tab">
                     <div class="containerhis">
                        <!--  Loop list WD-->
                        <div class="listhtwd">
                           <span class="badge rounded-pill bg-danger"><i class="fas fa-times-circle"></i> ไม่อนุมัติ</span>
                           <table>
                              <tbody>
                                 <tr>
                                    <td>
                                       123-2-12312-1<br>
                                       <span class="timehis">ธนาคารไทยพาณิชย์</span>
                                    </td>
                                    <td>
                                       250,000.00 บาท <br>
                                       <span class="timehis">15/02/2021 05:50:34</span>
                                    </td>
                                 </tr>
                              </tbody>
                           </table>
                        </div>
                        <div class="listhtwd">
                           <span class="badge rounded-pill bg-success"><i class="fas fa-check-circle"></i> อนุมัติ</span>
                           <table>
                              <tbody>
                                 <tr>
                                    <td>
                                       123-2-12312-1<br>
                                       <span class="timehis">ธนาคารไทยพาณิชย์</span>
                                    </td>
                                    <td>
                                       250,000.00 บาท <br>
                                       <span class="timehis">15/02/2021 05:50:34</span>
                                    </td>
                                 </tr>
                              </tbody>
                           </table>
                        </div>
                        <div class="listhtwd">
                           <span class="badge rounded-pill bg-danger"><i class="fas fa-times-circle"></i> ไม่อนุมัติ</span>
                           <table>
                              <tbody>
                                 <tr>
                                    <td>
                                       123-2-12312-1<br>
                                       <span class="timehis">ธนาคารไทยพาณิชย์</span>
                                    </td>
                                    <td>
                                       250,000.00 บาท <br>
                                       <span class="timehis">15/02/2021 05:50:34</span>
                                    </td>
                                 </tr>
                              </tbody>
                           </table>
                        </div>
                        <!--  END Loop list WD -->
                     </div>
                  </div>
                  <div class="tab-pane fade" id="v-pills-hisgames" role="tabpanel" aria-labelledby="v-pills-hisgames-tab">
                     <div class="containerhis">
                        <!--  Loop list DPS -->
                        <div class="listht">
                           
                           <table>
                              <tbody>
                                 <tr>
                                    <td>
                                       <span class="badge rounded-pill bg-success"> เลขอ้างอิง 19827498124</span><br>
                                       เกม SA GAMING<br>
                                       <span class="timehis">เวลาเล่น: 15/02/2021 05:51:34</span><br>
                                       <span class="timehis">จบบิล</span>
                                    </td>
                                    <td>
                                       <b>ยอดเล่น</b><br>
                                       250 บาท <br>
                                       <span class="timehis">ได้เสีย: ได้</span>
                                    </td>
                                 </tr>
                              </tbody>
                           </table>
                        </div>
                        <div class="listht">
                           
                           <table>
                              <tbody>
                                 <tr>
                                    <td>
                                       <span class="badge rounded-pill bg-success"> เลขอ้างอิง 19827498124</span><br>
                                       เกม SA GAMING<br>
                                       <span class="timehis">เวลาเล่น: 15/02/2021 05:50:34</span><br>
                                       <span class="timehis">จบบิล</span>
                                    </td>
                                    <td>
                                       <b>ยอดเล่น</b><br>
                                       50 บาท <br>
                                       <span class="timehis">ได้เสีย: เสีย</span>
                                    </td>
                                 </tr>
                              </tbody>
                           </table>
                        </div>
                        <!--  END Loop list DPS -->
                     </div>
                  </div>
   
               </div>
            </div>
         </div>
         </div>
    </div>
    <div class="overlaymodal"></div>
</div>
</div>
<!-- -------------  ประวัติ  ---------------- -->



<!-- Fixed Footer Mobile -->
<div class="x-button-actions" id="account-actions-mobile">
   <div class="-outer-wrapper">
            <div class="-left-wrapper">
         <span class="-item-wrapper">
            <span class="-ic-img">
                <a href="javascript:void(0)" onclick="openPopupTab(event, 'depositct')">
                <span class="-textfooter d-block">
                    ฝาก
                </span>
                    <img width="150" height="150" src="<?php echo get_template_directory_uri(); ?>/images/icon/footer-menu-ic-right-1.png" >
                </a>
            </span>
        </span>
        <span class="-item-wrapper">
            <span class="-ic-img">
                <a href="javascript:void(0)" onclick="openPopupTab(event, 'withdrawct')">
                <span class="-textfooter d-block">
                    ถอน
                </span>
                    <img width="50" height="50" src="<?php echo get_template_directory_uri(); ?>/images/icon/footer-menu-ic-right-2.png" class="image wp-image-1200  attachment-full size-full" alt="" loading="lazy" style="max-width: 100%; height: auto;">
                </a>
            </span>
        </span>        
      </div>
      <span class="-center-wrapper js-footer-lobby-selector js-menu-mobile-container">
         <a href="javascript:void(0)" onclick="openTabBox(event, 'sportstab')">
            <div class="-selected">
               <img  src="<?php echo get_template_directory_uri(); ?>/images/logo/logo2.png">
           </div>
         </a>
      </span>
      <div class="-fake-center-bg-wrapper">
         <svg viewBox="-10 -1 30 12">
            <defs>
               <linearGradient id="rectangleGradient" x1="0%" y1="0%" x2="0%" y2="100%">
                  <stop offset="0%" stop-color="#262626"></stop>
                  <stop offset="100%" stop-color="#030303"></stop>
               </linearGradient>
            </defs>
            <path d="M-10 -1 H30 V12 H-10z M 5 5 m -5, 0 a 5,5 0 1,0 10,0 a 5,5 0 1,0 -10,0z"></path>
         </svg>
      </div>
      <div class="-right-wrapper">
         <span class="-item-wrapper">
            <span class="-ic-img">
                <a href="javascript:void(0)"onclick="openTabBox(event, 'promotionstab')">
                <span class="-textfooter d-block">
                    โปรโมชั่น
                </span>
                    <img width="100" height="100" src="<?php echo get_template_directory_uri(); ?>/images/icon/tab_promotion-1-1-1.png" class="image wp-image-877  attachment-full size-full" alt="" loading="lazy" style="max-width: 100%; height: auto;">
                </a>
            </span>
        </span>
        <span class="-item-wrapper">
            <span class="-ic-img">
                <a href="/">
                <span class="-textfooter d-block">
                    ติดต่อเรา
                </span>
                    <img width="150" height="150" src="<?php echo get_template_directory_uri(); ?>/images/icon/support.png" class="image wp-image-876  attachment-full size-full" alt="" loading="lazy" style="max-width: 100%; height: auto;">
                </a>
            </span>
        </span>
      </div>
      <div class="-fully-overlay js-footer-lobby-overlay"></div>
   </div>
</div>
<!-- Fixed Footer Mobile -->









<!-- คัดลอกลิงค์ -->
<div class="myAlert-top alertcopy">
<i class="fal fa-check-circle"></i>
  <br>
  <strong>
    คัดลอกเรียบร้อยแล้ว  </strong>
</div>
<!-- คัดลอกลิงค์ -->

<!-- ปลาหมุน -->
<div class="loadingspin">
    <div class="inloadingct">
        <img src="<?php echo get_template_directory_uri(); ?>/images/icon/fishspin.png">
    </div>
</div>
<!-- ปลาหมุน -->





</div>
 

    <div class="overlay"></div>

    <!-- Popper.JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
    <!-- jQuery Custom Scroller CDN -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.concat.min.js"></script>

    <!-- AOSJS -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

    <!-- Swiper -->
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <script>
    AOS.init({once:true});
    </script>
    <script src="js/js.js?<?php echo time(); ?>"></script>
    
</body>

</html>