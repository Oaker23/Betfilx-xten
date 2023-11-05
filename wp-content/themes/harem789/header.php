<!DOCTYPE html>
<html <?php language_attributes(); ?> class="h-100">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

   <?php wp_head(); ?>

    
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
     <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/style.css?<?php echo time(); ?>">

      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />

</head>

<body <?php body_class(); ?>>


    <div class="overlay"></div>

 <div class="wrapper">

    <button class="wrapper-menu  sidebarCollapse"  aria-label="Main Menu">
      <svg width="40" height="40" viewBox="0 0 100 100">
        <path class="line line1" d="M 20,29.000046 H 80.000231 C 80.000231,29.000046 94.498839,28.817352 94.532987,66.711331 94.543142,77.980673 90.966081,81.670246 85.259173,81.668997 79.552261,81.667751 75.000211,74.999942 75.000211,74.999942 L 25.000021,25.000058" />
        <path class="line line2" d="M 20,50 H 80" />
        <path class="line line3" d="M 20,70.999954 H 80.000231 C 80.000231,70.999954 94.498839,71.182648 94.532987,33.288669 94.543142,22.019327 90.966081,18.329754 85.259173,18.331003 79.552261,18.332249 75.000211,25.000058 75.000211,25.000058 L 25.000021,74.999942" />
    </svg>
</button>

<div class="w-100">
<div class="stars"></div>
<div class="stars2"></div>
<div class="stars3"></div>
</div>


<div class="navbarmain">
    <div class="lightning">
        <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("lightning Head") ) : ?><?php endif;?>
    </div>
    <div class="logo">
        <?php if ( function_exists( 'the_custom_logo' ) ) {the_custom_logo();} ?>
    </div>
    <div class="menuicon ">
         <?php  $argsmenuright = array(      
                    'menu' => 113
                );
                wp_nav_menu( $argsmenuright ); 
                ?>
        <div class="overlaymenu"></div>
    </div>
    <div class="loginregishead">
       <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Nav Header BTN") ) : ?><?php endif;?>
    </div>

</div>





 <div class="fixedtopmobile">
           <div class="newsboxhead" data-animatable="fadeInUp" data-delat="200">
                              <div class="-icon-container">
                                 <i class="fas fa-volume-up"></i>
                              </div>
                                <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Text Slide") ) : ?><?php endif;?>
                           </div>


                 <div class="swiper-container-2">
            <div class="swiper-wrapper">
               <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Alert Slide") ) : ?><?php endif;?>
            </div>
            <!-- Add Pagination -->
            <div class="swiper-pagination"></div>
            <div class="swiper-button-prev swiper-button-white"></div>
            <div class="swiper-button-next swiper-button-white"></div>
         </div>
      </div>



      
 <div class="x-button-actions" id="account-actions-mobile">
   <div class="-outer-wrapper">
      <div class="-left-wrapper">
         

         <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("LoginMobile Left") ) : ?>
         <?php endif;?>

      </div>
      <span class="-center-wrapper js-footer-lobby-selector js-menu-mobile-container">

          <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("LoginMobile Center") ) : ?>
         <?php endif;?>
            
      </span>
      <div class="-fake-center-bg-wrapper">
         <svg viewBox="-10 -1 30 12">
            <defs>
               <linearGradient id="rectangleGradient" x1="0%" y1="0%" x2="0%" y2="100%">
                  <stop offset="0%" stop-color="#7b39ce"></stop>
                  <stop offset="100%" stop-color="#22164e"></stop>
               </linearGradient>
            </defs>
            <path d="M-10 -1 H30 V12 H-10z M 5 5 m -5, 0 a 5,5 0 1,0 10,0 a 5,5 0 1,0 -10,0z"></path>
         </svg>
      </div>
      <div class="-right-wrapper">
         
         <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("LoginMobile Right") ) : ?>
         <?php endif;?>


      </div>
      <div class="-fully-overlay js-footer-lobby-overlay"></div>
   </div>
</div>


 <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("FACEBOOK MOBILE") ) : ?>
         <?php endif;?>

<div class="containmain">

<div class="fixedcontain">
	<div class="fixedleft ">
		<div class="sidegamebar ">
		    <div class="tabgamemenu">
		          <?php 
                $argsmenuleft = array(      
                    'menu' => 4
                );
                wp_nav_menu( $argsmenuleft ); ?>
		        
		        	
		    </div>
            <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("SideBar Line") ) : ?><?php endif;?>
		</div>
	</div>
	<div class="fixedright">
 
      <div class="sectiongame">
     
         