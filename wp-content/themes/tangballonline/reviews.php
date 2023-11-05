<?php
/**
 * Template Name: Reviews
 */
?>
<?php get_header(); ?>
<div class="fixedbgback">
</div>
<div class="px-1 mb-4">
 <div class="containpage bg-black">
<div class="containsingle px-md-3 px-0 ">
    <!-- <div class="backsingle" onclick="location.href='<?php echo home_url(); ?>/index.php/allpost/'"><i class="fas fa-angle-left"></i> ย้อนกลับ</div> -->
    <main class="flex-shrink-0  marginsinglepost px-0 px-md-3 py-4">

        <div class="headcomment text-center">
             <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Section5 CommentHeader") ) : ?>
    <?php endif;?>
    </div>
    <div class="containcomment">
        <div class="commentct commentlist">
            <?php 
            /*Set how many comments per page*/
            $comments_per_page=5;

            /*Count comments and count only approved*/
            $all_comments = wp_count_comments();
/*If you are going to get only comments from a post you need to change the above code to
$all_comments = wp_count_comments($post->ID);
*/
$all_comments_approved = $all_comments->approved;

/*Get Current Page Var, if you want to show comments in the homepage will need to change get_query_var('paged') to get_query_var('page')*/
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
/*How many comments offset*/
$offset = ($paged - 1) * $comments_per_page;
/*Max number of pages*/
$max_num_pages = intval( $all_comments_approved / $comments_per_page ) + 1;

/*Get Comments*/
/*If you are going to get comments from a post you need to add 'post_id' => $post->ID, to the array*/
$comments = get_comments(array(
    'status' => 'approve',
    'number' => $comments_per_page,
    'offset' => $offset
));

/*Show Comments*/
if ( $comments ) {
    foreach ( $comments as $comment ) {  

        ?>
<?php $starnum = get_comment_meta($comment->comment_ID, 'review_rating', true); ?>
        <div class="reviewcontain my-3">
           <div class="comment-author vcard cutcolor headercomment">ความพอใจ <?php echo $comment->comment_author; ?> 

           
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
   <?php }
} else {
    echo 'No comments found.';
}  ?>


<div class="paginationrv">
    <?php
    /*Set current page for pagination*/
    $current_page = max(1, get_query_var('paged'));
    /*Echo paginate links*/
    echo paginate_links(array(
        'base' => get_pagenum_link(1) . '%_%',
        'current' => $current_page,
        'total' => $max_num_pages,
        'prev_text' => __('&laquo; Previous'),
        'next_text' => __('Next &raquo;'),
        'end_size' => 2,
        'mid-size' => 3
    ));
    ?>
</div>
</div>

</div>

    
        <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Comment box Hdader") ) : ?>
        <?php endif;?>
    <div class="commentbox px-3">
        Rating Review
    <?php 
// if (is_user_logged_in()):
comments_template();
// endif;
 ?>
</div>

</main>
</div>
</div>
</div>

<!--  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
 -->
<script src="<?php echo get_template_directory_uri(); ?>/js/jsppp.js?<?php echo time(); ?>"></script>
<?php get_footer(); ?>

