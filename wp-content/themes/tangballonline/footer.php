      <script id="b-loading" type="text/template"></script>
         <script id="loading" type="text/template"></script>


         <footer class="x-footer -anon mt-auto bg-black">
          <div class="fotterctn">
            <div class="disfooterct">
               <div class="infootergrid p-0 text-break">
                  <div class="text-center">
                     <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Footer-truewallet") ) : ?>
                  <?php endif;?>
               </div>
               <div class="bankcontainer">
                  <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Footer-Bank") ) : ?>
               <?php endif;?>
            </div>
         </div>

      </div>
   </div>
   <div class="footercontain">
    <div class="disfooterct">
     <div class="infootergrid pt-3"><?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Footer1") ) : ?><?php endif;?></div>
     <div class="infootergrid pt-3"><?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Footer2") ) : ?><?php endif;?></div>
     <div class="infootergrid pt-3"><?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Footer3") ) : ?><?php endif;?></div>
  </div>
</div>

</footer>







         <div class="x-contact-us">
            <div class="-contact-inner-wrapper">
               <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Fixed Line") ) : ?>
               <?php endif;?>
                <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Fixed Line Small") ) : ?>
               <?php endif;?>
            </div>
         </div>






<div class="x-button-actions" id="account-actions-mobile">
   <div class="-outer-wrapper">
      <div class="-left-wrapper">
         

         <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("LoginMobile Right") ) : ?>
         <?php endif;?>

      </div>
      <span class="-center-wrapper js-footer-lobby-selector js-menu-mobile-container">

          <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("LoginMobile logo") ) : ?>
         <?php endif;?>
            
      </span>
      <div class="-fake-center-bg-wrapper">
         <svg viewBox="-10 -1 30 12">
            <defs>
               <linearGradient id="rectangleGradient" x1="0%" y1="0%" x2="0%" y2="100%">
                  <stop offset="0%" stop-color="#2f67b3"></stop>
                  <stop offset="100%" stop-color="#1d3050"></stop>
               </linearGradient>
            </defs>
            <path d="M-10 -1 H30 V12 H-10z M 5 5 m -5, 0 a 5,5 0 1,0 10,0 a 5,5 0 1,0 -10,0z"></path>
         </svg>
      </div>
      <div class="-right-wrapper">
         
         <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("LoginMobile Left") ) : ?>
         <?php endif;?>


      </div>
      <div class="-fully-overlay js-footer-lobby-overlay"></div>
   </div>
</div>



<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("bgSection01") ) : ?>
<?php endif;?>
<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("bgSection02") ) : ?>
<?php endif;?>
<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("bgSection03") ) : ?>
<?php endif;?>
<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("bgSection04") ) : ?>
<?php endif;?>
<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("bgSection05") ) : ?>
<?php endif;?>
<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("bgSection06") ) : ?>
<?php endif;?>
<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("bgBody") ) : ?>
<?php endif;?>

         <!-- Global site tag (gtag.js) - Google Analytics -->
         <script rel="preload" as="script" defer="" src="gtag/js.js?id=UA-154557947-11"></script>
         <script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());
            
            gtag('config', 'UA-154557947-11');
         </script>
      </div>
      <script></script>
      <script>
         Bonn.boots.push(function () {
             setTimeout(function () {
                 $('#bankInfoModal').modal('show');
             }, 500);
         });
      </script>
      <script>
         var IS_ANDROID = false;
         var IS_TRANSFER_WEBSITE = true;
      </script>

  
      <!-- Swiper -->
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
      <script src="<?php echo get_template_directory_uri(); ?>/js/js.js?<?php echo time(); ?>"></script>

   </body>
</html>
<?php  if (is_user_logged_in()): ?>
<script type="text/javascript">
   $(".x-header").addClass("loginwphd");
   $(window).scroll(function(){
    if($(window).scrollTop() == $(window).height() > $(document).height() - 150) {
        $('.x-header').removeClass('mobilewp');

    }else{
     $('.x-header').addClass('mobilewp');
 }
});
</script>
<?php endif; ?>






<?php wp_footer(); ?>