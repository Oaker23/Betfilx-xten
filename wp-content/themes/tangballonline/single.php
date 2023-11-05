<?php
/**
 * Template Name: Single
 */
?>

<?php get_header(); ?>
<div class="fixedbgback">
</div>
<div class="px-2 mb-2">
    <div class="containpage p-3">

<?php  if(have_posts()) :?>
    <?php while(have_posts()) : the_post(); ?>
         <h1><?php  the_title(); ?></h1>
<?php  the_content(); ?>

   <?php endwhile; ?>
    <?php  else : ?>
      <?php echo wpautop('Sorry, No Posts'); ?>
      <?php endif;  ?> 


 </div>
</div>

<!--  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script> -->

 <script src="<?php echo get_template_directory_uri(); ?>/js/jsppp.js?<?php echo time(); ?>"></script>

<?php get_footer(); ?>