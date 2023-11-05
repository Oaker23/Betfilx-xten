<?php wp_head(); ?>
<!DOCTYPE html>
<html <?php language_attributes(); ?> class="h-100">
   <head>

      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
      <meta name="robots" content="noodp">
      <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
      <title><?php wp_title(''); ?></title>

      <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>

 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
  
      <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/style.css?<?php echo time(); ?>">
      <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/styleCustom.css?<?php echo time(); ?>">

      <!-- Awesome -->
      <link href="https://kit-pro.fontawesome.com/releases/v5.15.3/css/pro.min.css" rel="stylesheet">

      <!-- Swiper -->
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />

      <script type="text/javascript">
         window['gif64'] = 'data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7';
         window['Bonn'] = {
             boots: [],
             inits: []
         };
      </script>
   </head>
   <?php 
         // เรียกใช้โลโก้
         $custom_logo_id = get_theme_mod( 'custom_logo' );
         $image = wp_get_attachment_image_src( $custom_logo_id , 'full' );
         ?>
   <body class="x-transfer-website d-flex flex-column h-100">
      
      <nav class="x-header bg-transparent navbar-expand-lg -anon">
         <div class="-header-inner-wrapper navbar">
            <div class="container align-items-center px-sm-3 px-0 position-relative">
               <div id="headerBrand">
                  <a class="navbar-brand" href="javascript:void(0)">
                     <div class="navlogo">
                        <?php if ( function_exists( 'the_custom_logo' ) ) {the_custom_logo();} ?>
                     </div>
                  <button class="wrapper-menu  sidebarCollapse d-lg-none d-block"  aria-label="Main Menu">
                        <svg width="40" height="40" viewBox="0 0 100 100">
                          <path class="line line1" d="M 20,29.000046 H 80.000231 C 80.000231,29.000046 94.498839,28.817352 94.532987,66.711331 94.543142,77.980673 90.966081,81.670246 85.259173,81.668997 79.552261,81.667751 75.000211,74.999942 75.000211,74.999942 L 25.000021,25.000058" />
                          <path class="line line2" d="M 20,50 H 80" />
                          <path class="line line3" d="M 20,70.999954 H 80.000231 C 80.000231,70.999954 94.498839,71.182648 94.532987,33.288669 94.543142,22.019327 90.966081,18.329754 85.259173,18.331003 79.552261,18.332249 75.000211,25.000058 75.000211,25.000058 L 25.000021,74.999942" />
                      </svg>
                  </button>

                  </a>
                  <div class="d-none d-lg-block navbarpc">
                     <?php wp_nav_menu(); ?>
                  </div>
               </div>
               <div id="headerContent">
                  <div class="d-flex">
                        <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("LoginHeader") ) : ?>
                     <?php endif;?>
                  </div>
               </div>
            </div>
         </div>
         
      </nav>
      <div class="overlay"></div>
      <div id="sidebar" class="d-lg-none d-block sidebarmenu" >
           <div class="row">
              <div class="col-8 position-relative">  <?php if ( function_exists( 'the_custom_logo' ) ) {
               the_custom_logo();
               } ?></div>
               <div class="col-4 position-relative"><button id="xsidebar"><i class="far fa-times"></i></button></div>
           </div>
            <?php wp_nav_menu(); ?>
      </div>