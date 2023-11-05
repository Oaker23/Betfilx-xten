<?php
/**
 * Template Name: Post
 */
?>

<?php get_header(); ?>
<div class="fixedbgback">
</div>
<div class="px-2 mb-2">
    <div class="containpage p-3">

<div class="postcontainer pb-5">
   <div class="headsec05">
         <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("postheader") ) : ?>
         <?php endif;?>
      </div>
   <div class="row m-0 mt-4">
      <div class="col-lg-3 col-sm-2 p-post text-center">
         <div class="nav flex-column nav-pills postmenu">
            <a class="nav-link active mx-sm-0 mx-1" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="false">ทั้งหมด</a>
            <?php 
            $category_id = get_cat_ID('homepage');
            $categories = get_categories(array('exclude' => $category_id));
            foreach($categories as $category) {
              echo '<a class="nav-link mx-sm-0 mx-1" id="v-pills-'. $category->name . '-tab" data-toggle="pill" href="#v-pills-' . $category->name . '" role="tab" aria-controls="v-pills-' . $category->name . '" aria-selected="false" >' . $category->name . '</a>';
           }
           ?>
        </div>
     </div>
     <div class="col-lg-9 mt-sm-0 mt-2 col-sm-10 p-post">
      <div class="tab-content" id="v-pills-tabContent">


         <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
            <div class="gridpost">

               <?php 

               $category_id = get_cat_ID('homepage');
               query_posts( array(
                  'category__not_in' => $category_id ,
                  'posts_per_page' => 9999,
               ) );


               if(have_posts()) :?>
                  <?php while(have_posts()) : the_post(); ?>
                     <div class="ingridpost">
                        <div class="iningridpost" onclick="location='<?php the_permalink(); ?>'">
                           <?php the_post_thumbnail(); ?>
                           <?php  the_title(); ?>
                        </div>
                     </div>
                  <?php endwhile; ?>
               <?php  else : ?>
                  <?php echo wpautop('Sorry, No Posts'); ?>
               <?php endif;  ?>
            </div>
         </div>


         <?php 
         $categories = get_categories(array('exclude' => $category_id));
         foreach($categories as $category) {  

            $catname2 = $category->name;

            ?>

            <div class="tab-pane fade" id="v-pills-<?php echo $catname2; ?>" role="tabpanel" aria-labelledby="v-pills-<?php echo $category->name; ?>-tab">
               <div class="gridpost">
                  <?php query_posts ( array(  'category_name' => $catname2));
                  if(have_posts()) :?>
                     <?php while(have_posts()) : the_post(); ?>
                        <div class="ingridpost">
                           <div class="iningridpost" onclick="location='<?php the_permalink(); ?>'">
                              <?php the_post_thumbnail(); ?>
                              <?php  the_title(); ?>
                           </div>
                        </div>
                     <?php endwhile; ?>
                  <?php  else : ?>
                     <?php echo wpautop('Sorry, No Posts'); ?>
                  <?php endif;  ?>
               </div>
            </div>


         <?php } ?>



      </div>
   </div>
</div>
</div>


 </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>


<script src="<?php echo get_template_directory_uri(); ?>/js/jsppp.js?<?php echo time(); ?>"></script>

<?php get_footer(); ?>