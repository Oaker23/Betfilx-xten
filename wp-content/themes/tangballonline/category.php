<?php
/**
 * Template Name: Category
 */
?>
<?php get_header(); ?>
<div class="fixedbgback">
</div>
   <?php 
               // รับค่า Pages
   $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;


   ?>
<?php
    // get category slug in wordpress
    if ( is_single() ) {
        $cats =  get_the_category();
        $cat = $cats[0];
    } else {
        $cat = get_category( get_query_var( 'cat' ) );
    }
    $cat_slug = $cat->slug;

$string = $cat_slug;
$decode2 = urldecode($string);
// echo $decode2;
?>

<div class="px-2 mb-2">
    <div class="containpage p-3">

    
    <main class="flex-shrink-0  marginsinglepost bgsingle">
   <div class="row m-0">
      <div class="col-md-3 p-post text-center">
          <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Category Post") ) : ?>
          <?php endif;?> 
      </div>
      <div class="col-md-9  mt-sm-0 mt-2 p-post">
         <div class="tab-content" id="v-pills-tabContent">
            <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
               <div class="gridpost">
                  <?php 
                     
                     if(have_posts()) :?>
                  <?php while(have_posts()) : the_post(); ?>
                  <div class="ingridpost">
                     <div class="iningridpost" onclick="location='<?php the_permalink(); ?>'">
                        <?php the_post_thumbnail(); ?>
                        <?php  the_title(); ?>
                     </div>
                  </div>
                  <?php endwhile;  ?>
                  <?php  else : ?>
                  <?php echo wpautop('Sorry, No Posts'); ?>
                  <?php endif;  ?>
               </div>
            </div>

         </div>
         <div class="pages-post">
            <?php  echo paginate_links(); ?>
         </div>
      </div>
   </div>
</main>
</div>
</div>







<?php get_footer(); ?>