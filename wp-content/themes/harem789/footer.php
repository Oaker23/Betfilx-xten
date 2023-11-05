

         </div>

    </div>
</div>





<footer>
        <?php 
    query_posts( array(
        'post_type' => 'page',
        'pagename' => 'Footer',
    ) );
    if(have_posts()) :?>
        <?php while(have_posts()) : the_post(); ?>
            <?php  the_content(); ?>
        <?php endwhile; ?>
    <?php  else : ?>
        <?php echo wpautop('Sorry, No Posts'); ?>
    <?php endif;  ?>
</footer>



</div>



<div class="loadercontain">
	<div class="spincontain">
		<div class="boxload"></div>
	</div>
  <?php if ( function_exists( 'the_custom_logo' ) ) {the_custom_logo();} ?>
<div id="loadmeta">

</div>
</div>

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
    <script src="<?php echo get_template_directory_uri(); ?>/js/js.js?<?php echo time(); ?>"></script>
    <?php wp_footer(); ?>
</body>

</html>

  <?php  if (is_user_logged_in()): ?>
        <script type="text/javascript">


            
            if ($('#wpadminbar')[0]) {
                $('.navbarmain').addClass('wpadmin');
                $('.tabgamemenu').addClass('wpadmin');
                $('.fixedtopmobile').addClass('wpadmin');
                $('.sidegamebar').addClass('wpadmin');
                $('.fixedright').addClass('wpadmin');
                $('.wrapper-menu').addClass('wpadmin');
            }


        </script>
    <?php endif; ?>
