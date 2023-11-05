<?php 




// Header
 if ( function_exists('register_sidebar') )
  register_sidebar(array(
    'name' => 'Nav Header BTN',
    'before_widget' => '<button  class="btn btn-primary mt-lg-3 mr-lg-3"><div class="-text-container">',
    'after_widget' => '</div></button>',
  )
); 

 if ( function_exists('register_sidebar') )
  register_sidebar(array(
    'name' => 'SideBar Line',
    'before_widget' => '<div class="linechatfixed">',
    'after_widget' => '</div>',
  )
); 
// Header

// Promotions Alert
 if ( function_exists('register_sidebar') )
  register_sidebar(array(
    'name' => 'Alert Slide',
    'before_widget' => '<div class="swiper-slide">',
    'after_widget' => '</div>',
  )
); 

 if ( function_exists('register_sidebar') )
  register_sidebar(array(
    'name' => 'Text Slide',
    'before_widget' => '',
    'after_widget' => '',
    'before_title' => '<span>',
    'after_title' => '<span>',

  )
); 
// Promotions Alert



// Fixed Mobile
 if ( function_exists('register_sidebar') )
  register_sidebar(array(
    'name' => 'LoginMobile Right',
    'before_widget' => '<span class="-item-wrapper"><span class="-ic-img">',
    'after_widget' => '</span></span>',
    'before_title' => '<span class="-textfooter d-block">',
    'after_title' => '</span>',
  )
); 

 if ( function_exists('register_sidebar') )
  register_sidebar(array(
    'name' => 'LoginMobile Left',
    'before_widget' => '<span class="-item-wrapper"><span class="-ic-img">',
    'after_widget' => '</span></span>',
    'before_title' => '<span class="-textfooter d-block">',
    'after_title' => '</span>',
  )
); 


 if ( function_exists('register_sidebar') )
  register_sidebar(array(
    'name' => 'LoginMobile Center',
    'before_widget' => '<div class="-selected">',
    'after_widget' => '</div>',
  )
); 
// Fixed Mobile



 if ( function_exists('register_sidebar') )
  register_sidebar(array(
    'name' => 'HEADER POST',
    'before_widget' => '<div class="header-post">',
    'after_widget' => '</div>',
    'before_title' => '<h1>',
    'after_title' => '</h1>',
  )
); 

 if ( function_exists('register_sidebar') )
  register_sidebar(array(
    'name' => 'FACEBOOK MOBILE',
    'before_widget' => '<div class="facebook-mobile">',
    'after_widget' => '</div>',
    'before_title' => '<h2>',
    'after_title' => '</h2>',
  )
); 


 if ( function_exists('register_sidebar') )
  register_sidebar(array(
    'name' => 'lightning Head',
    'before_widget' => '',
    'after_widget' => '',
    'before_title' => '',
    'after_title' => '',
  )
); 


 if ( function_exists('register_sidebar') )
  register_sidebar(array(
    'name' => 'Images Animaite',
    'before_widget' => '',
    'after_widget' => '',

  )
); 
// WEBP UPLOAD
//** * Enable preview / thumbnail for webp image files.*/
//** *Enable upload for webp image files.*/
// Ensure all network sites include WebP support.
add_filter(
  'site_option_upload_filetypes',
  function ( $filetypes ) {
    $filetypes = explode( ' ', $filetypes );
    if ( ! in_array( 'webp', $filetypes, true ) ) {
      $filetypes[] = 'webp';
    }
    $filetypes   = implode( ' ', $filetypes );
 
    return $filetypes;
  }
);

// WEBP UPLOAD






add_filter( 'widget_title', 'anchor_in_widget_title' );
function anchor_in_widget_title($widgetTitle) {
// We are replacing  with [anchor][/anchor]
$widgetTitle = str_replace( '[anchor', '<a', $widgetTitle );
$widgetTitle = str_replace( '[/anchor]', '', $widgetTitle );
$widgetTitle = str_replace( ']', '>', $widgetTitle );
return $widgetTitle;
}







//Make a Custome Comment fileds
function custom_fields($fields) {
$commenter = wp_get_current_commenter();
$req = get_option( 'require_name_email' );

$fields[ 'author' ] = 
'<div class="row"><div class="col-lg-12 pb-3 px-3 pt-1"><div class="commentInputer">'.
'<label for="author">' .'<i class="fas fa-user cutcolor"></i> ยูสเซอร์'. '</label>'.
( $req ? '<span class="required"></span>' : ’ ).
'<input id="author" name="author" type="text" value="'. esc_attr( $commenter['comment_author'] ) .
'" size="30" tabindex="1"' . $aria_req . ' />'.'</div></div>';

$fields[ 'email' ] = '<div class=" col-lg-12 mb-3 px-3"><div class="commentInputer">'.
'<label for="email">' .'<i class="fas fa-envelope cutcolor"></i> อีเมลล์'. '</label>'.
( $req ? '<span class="required"></span>' : ’ ).
'<input id="email" name="email" type="text" value="'. esc_attr( $commenter['comment_author_email'] ) .
'" size="30" tabindex="2"' . $aria_req . ' />'.'</div></div></div>';


return $fields;
}
add_filter('comment_form_default_fields', 'custom_fields');




// Title
add_theme_support( 'title-tag' );
// Title





remove_filter('widget_text_content', 'wpautop');







register_nav_menus(array(
'primary' => __('Primary Menu')
));




$args = array(
    'default-color' => 'ffffff',
);
add_theme_support( 'custom-background', $args );






// โลโก้

add_theme_support( 'custom-logo' );
add_theme_support( 'custom-logo', array(
  'flex-height' => true,
  'flex-width'  => true,
  'header-text' => array( 'site-title', 'site-description' ),
) );


//ฟีเจอร์ใส่รูป
add_theme_support( 'post-thumbnails' );




//เพิ่มดินสอสำหรับแก้ไข Wordpress
add_theme_support( 'customize-selective-refresh-widgets' );


?>