<?php
/**
 * Template Name: Login
 */
?>
<?php get_header(); ?>







<div class="containmain">



   
	<?php  if(have_posts()) :?>
          <?php while(have_posts()) : the_post(); ?>
           <?php  the_content(); ?>
         <?php endwhile; ?>
       <?php  else : ?>
        <?php echo wpautop('Sorry, No Posts'); ?>
      <?php endif;  ?>





 </div>
<div class="fixedpage">
    <div class="px-2 mb-2">
    <div class="containpage fixedpage">

 <iframe id="iframe-play" allowtransparency="true" scrolling="no" src="https://x.richrast.com/TV69/login"></iframe>


 </div>
</div>
</div>




<?php get_footer(); ?>
<script type="text/javascript">
    $('.fixedleft').hide();
    $('footer').hide();
     $('.swiper-container-2').hide();
    $('.fixedright').addClass('w-100');
</script>