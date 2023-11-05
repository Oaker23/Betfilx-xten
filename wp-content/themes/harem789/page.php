<?php
/**
 * Template Name: Page
 */
?>
<?php get_header(); ?>






<div class="containmain">

<div class="-bg-container">
        <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Images Animaite") ) : ?><?php endif;?>
    </div>

   
	<?php  if(have_posts()) :?>
          <?php while(have_posts()) : the_post(); ?>
           <?php  the_content(); ?>
         <?php endwhile; ?>
       <?php  else : ?>
        <?php echo wpautop('Sorry, No Posts'); ?>
      <?php endif;  ?>





 </div>





<?php get_footer(); ?>