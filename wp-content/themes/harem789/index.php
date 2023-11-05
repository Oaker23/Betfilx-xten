<?php
/**
 * Template Name: Archivess
 */
?>
<?php get_header(); ?>








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

<div class=" mb-2">
    <div class="containpage p-1">

    
    <main class="flex-shrink-0  marginsinglepost bgsingle">
<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("HEADER POST") ) : ?><?php endif;?>
   <div class="row m-0">
      <div class="col-12  mt-sm-0 mt-2 p-post">
         <div class="tab-content" id="v-pills-tabContent">
            <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
               <div class="gridpost">
                  <?php 
                     
                     if(have_posts()) :?>
                  <?php while(have_posts()) : the_post(); ?>
                  <div class="ingridpost">
                     <a href="<?php the_permalink(); ?>">
                         <div class="iningridpost">
                            <?php the_post_thumbnail(); ?>
                            <div class="flexcenter">
                                <p><?php  the_title(); ?></p>
                            </div>
                         </div>
                     </a>
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

</div>






<?php get_footer(); ?>