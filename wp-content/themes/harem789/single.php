<?php
/**
 * Template Name: Single
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





<?php get_footer(); ?>