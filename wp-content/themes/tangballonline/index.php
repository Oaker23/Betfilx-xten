<?php
/**
 * Template Name: Homepage
 */
?>
<?php get_header(); ?>
      <div id="main__content" class="">

         <section class="x-index-top-container">

            <!-- Section01 -->
            <div class="container -inner-wrapper">
               <div class="row">
                  <div class="col-12 col-md-9 col-lg-6 mx-auto -left-container order-lg-first order-last">
                     <div class="-single">
                       <div class=" d-block d-lg-none">
                  <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Section01 lightning") ) : ?>
                           <?php endif;?>
               </div>
                      
                     <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Sec01-Image-Left") ) : ?>
                      <?php endif;?>
                     <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Sec01-Football-Left") ) : ?>
                     <?php endif;?>
                     </div>
                  </div>
                  <div class="col-12 col-lg-6 -right-container order-lg-last order-first" data-animatable="fadeInUp" data-delay="100">
                     <div class="  d-none d-lg-block">
                    <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Section01 lightning") ) : ?>
                           <?php endif;?>
               </div>
                    <div class="-logo-img d-block">
                
                    <?php if ( function_exists( 'the_custom_logo' ) ) {
                              the_custom_logo();
                              } ?>
                     </div>

                     <div class="-btn-actions">
                        <button type="button" class="btn -register-btn">
                           <div class="-glow-container"></div>

                           <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Section01 Btn Card") ) : ?>
                           <?php endif;?>
                           <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Section01 Btn ball") ) : ?>
                           <?php endif;?>
                           <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Section01 Btn dice") ) : ?>
                           <?php endif;?>
                           <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Section01 Btn button") ) : ?>
                           <?php endif;?>

                           <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Sec01-Text-button") ) : ?>
                           <?php endif;?>
                        </button>
                     </div>
                     <div class="-contents-wrapper container">
                        <strong class="-title h1">
                        </strong>
                        <div data-slickable="{&quot;arrows&quot;:false,&quot;slidesToShow&quot;:1,&quot;fade&quot;:true,&quot;infinite&quot;:true,&quot;autoplay&quot;:true,&quot;draggable&quot;:false,&quot;autoplaySpeed&quot;:4000,&quot;pauseOnHover&quot;:false}" class="-single">

                            <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Sec01-Text-Right") ) : ?>
                           <?php endif;?>

                        </div>
                     </div>
                     
                  </div>
               </div>
            </div>
            <!-- Section01 -->
            <!-- Section02 -->
            <div class="-games-container">
               <div class="container">
                  <div class="row -row-inner-wrapper">
                     <div class="col-6 col-lg-3 -col-wrapper" data-animatable="fadeInUp" data-delay="200">
                        <div class="-box-wrapper">
                            <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Sec02 Header Image 01") ) : ?>
                           <?php endif;?>
                            <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Sec02 Header Detail 01") ) : ?>
                           <?php endif;?>
                           <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Sec02 Button Play") ) : ?>
                           <?php endif;?>
                        </div>
                     </div>
                     <div class="col-6 col-lg-3 -col-wrapper" data-animatable="fadeInUp" data-delay="400">
                        <div class="-box-wrapper">
                            <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Sec02 Header Image 02") ) : ?>
                           <?php endif;?>
                            <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Sec02 Header Detail 02") ) : ?>
                           <?php endif;?>
                           <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Sec02 Button Play") ) : ?>
                           <?php endif;?>
                        </div>
                     </div>
                     <div class="col-6 col-lg-3 -col-wrapper" data-animatable="fadeInUp" data-delay="600">
                        <div class="-box-wrapper">
                           <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Sec02 Header Image 03") ) : ?>
                           <?php endif;?>
                            <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Sec02 Header Detail 03") ) : ?>
                           <?php endif;?>
                           <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Sec02 Button Play") ) : ?>
                           <?php endif;?>
                        </div>
                     </div>
                     <div class="col-6 col-lg-3 -col-wrapper" data-animatable="fadeInUp" data-delay="800">
                        <div class="-box-wrapper">
                            <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Sec02 Header Image 04") ) : ?>
                           <?php endif;?>
                            <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Sec02 Header Detail 04") ) : ?>
                           <?php endif;?>
                           <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Sec02 Button Play") ) : ?>
                           <?php endif;?>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
             <!-- Section02 -->
         </section>










          <!-- Section03 -->
         <section class="x-index-middle-container lazyload bgsec02">
            <div class="-middle-container">
               <div class="container">
                  <div class="row mb-lg-4">
                     <div class="col-12 col-lg-6 -left-container-top">
                        <div class="-logo">
                            <?php if ( function_exists( 'the_custom_logo' ) ) {
                              the_custom_logo();
                              } ?>
                        </div>
                     </div>
                     <div class="col-12 col-lg-6 -right-container-top">
                        <div data-slickable="{&quot;arrows&quot;:false,&quot;slidesToShow&quot;:1,&quot;fade&quot;:true,&quot;infinite&quot;:true,&quot;autoplay&quot;:true,&quot;draggable&quot;:false,&quot;autoplaySpeed&quot;:4000,&quot;pauseOnHover&quot;:false}" class="-single">
                           <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Sec03 Header Text") ) : ?>
                           <?php endif;?>
                        </div>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-12 col-lg-6 -left-container">
                        <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Sec03 LEFT Mobile") ) : ?>
                           <?php endif;?>
                        <div class="-shield-container">
                           <img src="<?php echo get_template_directory_uri(); ?>/build/web/UFABET/img/index-lower-dust.png" class="-dust-img" alt="UFABET shield image png" data-animatable="fadeInLeft" data-delay="600">
                           <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Sec03 LEFT Shield") ) : ?>
                           <?php endif;?>
                        </div>
                     </div>
                     <div class="col-12 col-lg-6 -right-container">
                        <div class="-text-lists-wrapper">
                           <ul class="navbar-nav">
                               <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Sec03 Detail Text") ) : ?>
                           <?php endif;?>
                           </ul>
                        </div>
                        <div class="-lobby-logo-wrapper">
                           <ul class="navbar-nav">
                              <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Sec03 All Game") ) : ?>
                           <?php endif;?>
                             
                           </ul>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </section>
          <!-- Section03 -->

<hr class="x-tab-hr">

          <!-- Section04 -->
          
   <section class="section04">

       <div class="containersec04 homepagecontent">
         
          <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Header Post") ) : ?>
                  <?php endif;?>
         <?php  if(have_posts()) :?>
         <?php while(have_posts()) : the_post(); ?>
               <?php  the_content(); ?>
         <?php endwhile; ?>
         <?php  else : ?>
            <?php echo wpautop('Sorry, No Posts'); ?>
         <?php endif;  ?> 
      </div>

<hr class="x-tab-hr2 mt-4">
   </section>

          <!-- Section04 -->

      <section class="section05">

         <div class="px-1 px-sm-2 px-xl-0">
            <div class="containsec05">
               <div class="tabpromotion text-center pt-4">
                  <button class="btnpromotion active">
                  <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Section4 HeaderPro") ) : ?>
                  <?php endif;?>
                  </button>
                  <button class="btnpost">
                  <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Section4 HeaderPost") ) : ?>
                  <?php endif;?>
                  </button>
               </div>
               <div class="containpro">
                  <div class="swiper-container mt-3 promotionsl">
                     <div class="swiper-wrapper" >
                        <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Promotion") ) : ?>
                        <?php endif;?>  
                     </div>
                     <div class="swiper-pagination"></div>
                  </div>
               </div>
               <div class="containpost">
                  <div class="swiper-container mt-2 postslide">
                     <div class="swiper-wrapper" >
                        <?php 
                           $category_id = get_cat_ID('homepage');
                           query_posts( array(
                             'category__not_in' => $category_id ,
                             'posts_per_page' => 5,
                           ) );
                           if(have_posts()) :?>
                        <?php while(have_posts()) : the_post(); ?>
                        <div class="swiper-slide" onclick="location.href='<?php the_permalink(); ?>'">
                           <?php the_post_thumbnail(); ?>
                           <div class="headerpostsl"><?php  the_title(); ?></div>
                        </div>
                        <?php endwhile; ?>
                        <?php  else : ?>
                        <?php echo wpautop('Sorry, No Posts'); ?>
                        <?php endif;  ?>
                     </div>
                     <div class="swiper-pagination2"></div>
                  </div>
                  <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Section4 BtnAllpost") ) : ?>
                  <?php endif;?>  
               </div>
            </div>
         </div>
         <hr class="x-hr-border-glow2 mt-4 mb-0">
      </section>



<section class="section06 py-4">
   <div class="containsec06">
      <div class="containcomment">
         <div class="commentct bgindexcomment">
            <div class="headcomment text-center">
               <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Section5 CommentHeader") ) : ?>
               <?php endif;?>
            </div>
            <?php 
               $number = 5;
                                            //Get only the approved comments
               $args = array(
                 'number' => $number,
               );
                                        // The comment Query
               $comments_query = new WP_Comment_Query;
               $comments = $comments_query->query( $args );
                                        // Comment Loop
               if ( $comments ) {
                 foreach ( $comments as $comment ) { ?>
            <?php $starnum = get_comment_meta($comment->comment_ID, 'review_rating', true); ?>
            <div class="reviewcontain my-3">
               <div class="comment-author vcard cutcolor2 headercomment">ความพอใจ <?php echo $comment->comment_author; ?> 
                  <?php if (($starnum > 4 && $starnum <= 5)) {?>
                  <img src="<?php echo get_template_directory_uri(); ?>/images/icon/star.svg?v=2" >
                  <img src="<?php echo get_template_directory_uri(); ?>/images/icon/star.svg?v=2" >
                  <img src="<?php echo get_template_directory_uri(); ?>/images/icon/star.svg?v=2" >
                  <img src="<?php echo get_template_directory_uri(); ?>/images/icon/star.svg?v=2" >
                  <img src="<?php echo get_template_directory_uri(); ?>/images/icon/star.svg?v=2">
                  <?php }if(($starnum > 3 && $starnum <= 4)) { ?>
                  <img src="<?php echo get_template_directory_uri(); ?>/images/icon/star.svg?v=2" >
                  <img src="<?php echo get_template_directory_uri(); ?>/images/icon/star.svg?v=2" >
                  <img src="<?php echo get_template_directory_uri(); ?>/images/icon/star.svg?v=2" >
                  <img src="<?php echo get_template_directory_uri(); ?>/images/icon/star.svg?v=2" >
                  <img src="<?php echo get_template_directory_uri(); ?>/images/icon/stargray.png?v=2" >
                  <?php } if (($starnum > 2 && $starnum <= 3)) {?>
                  <img src="<?php echo get_template_directory_uri(); ?>/images/icon/star.svg?v=2" >
                  <img src="<?php echo get_template_directory_uri(); ?>/images/icon/star.svg?v=2" >
                  <img src="<?php echo get_template_directory_uri(); ?>/images/icon/star.svg?v=2" >
                  <img src="<?php echo get_template_directory_uri(); ?>/images/icon/stargray.png?v=2" >
                  <img src="<?php echo get_template_directory_uri(); ?>/images/icon/stargray.png?v=2" >
                  <?php } if (($starnum > 1 && $starnum <= 2)) {?>
                  <img src="<?php echo get_template_directory_uri(); ?>/images/icon/star.svg?v=2" >
                  <img src="<?php echo get_template_directory_uri(); ?>/images/icon/star.svg?v=2" >
                  <img src="<?php echo get_template_directory_uri(); ?>/images/icon/stargray.png?v=2" >
                  <img src="<?php echo get_template_directory_uri(); ?>/images/icon/stargray.png?v=2" >
                  <img src="<?php echo get_template_directory_uri(); ?>/images/icon/stargray.png?v=2" >
                  <?php } if (($starnum > 0 && $starnum <= 1)) {?>
                  <img src="<?php echo get_template_directory_uri(); ?>/images/icon/star.svg?v=2" >
                  <img src="<?php echo get_template_directory_uri(); ?>/images/icon/stargray.png?v=2" >
                  <img src="<?php echo get_template_directory_uri(); ?>/images/icon/stargray.png?v=2" >
                  <img src="<?php echo get_template_directory_uri(); ?>/images/icon/stargray.png?v=2" >
                  <img src="<?php echo get_template_directory_uri(); ?>/images/icon/stargray.png?v=2" >
                  <?php } ?>
                  <?php  if ($starnum == 0) {?>
                  <img src="<?php echo get_template_directory_uri(); ?>/images/icon/stargray.png?v=2" >
                  <img src="<?php echo get_template_directory_uri(); ?>/images/icon/stargray.png?v=2" >
                  <img src="<?php echo get_template_directory_uri(); ?>/images/icon/stargray.png?v=2" >
                  <img src="<?php echo get_template_directory_uri(); ?>/images/icon/stargray.png?v=2" >
                  <img src="<?php echo get_template_directory_uri(); ?>/images/icon/stargray.png?v=2" >
                  <?php } ?>
               </div>
               <div class="contentcomment pl-3 py-2"><?php echo $comment->comment_content; ?></div>
               <div class="datetimerv pl-3 "><?php echo $comment->comment_date; ?> | <span><?php 
                  $newIP = substr($comment->comment_author_IP, 0, -3) . 'xxx';
                  echo $newIP;
                  ?></span></div>
            </div>
            <?php  }
               } else {
                 echo 'No comments found.';
               }
               
               ?>
            <div class="mt-3 text-center">
               <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Reviews-Button") ) : ?>
               <?php endif;?>
            </div>
         </div>
      </div>
   </div>
</section>



         <!-- Section06 -->
         <div class="x-footer">
            <div class="-mobile-application-container lazyload">
               <div class="container -container-inner-wrapper">
                  <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Section06 Text") ) : ?>
               <?php endif;?>
               </div>
            </div>
         </div>
            <!-- Section06 -->



            <!-- Section07 -->
            <section class="tagcontainer pt-4 pb-2">
               <div class="container">
                  <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Footer Tags") ) : ?>
               <?php endif;?>
            </div>
         </section>
         <!-- Section07 -->
         
      <script src="<?php echo get_template_directory_uri(); ?>/build/runtime.1ba6bf05.js"></script><script src="<?php echo get_template_directory_uri(); ?>/build/web/UFABET/app.22181d7d.js"></script>
   <?php get_footer(); ?>
   