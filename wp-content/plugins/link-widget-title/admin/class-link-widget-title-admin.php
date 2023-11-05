<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://allurewebsolutions.com
 * @since      1.0.0
 *
 * @package    Link_Widget_Title
 * @subpackage Link_Widget_Title/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Link_Widget_Title
 * @subpackage Link_Widget_Title/admin
 * @author     Allure Web Solutions <info@allurewebsolutions.com>
 */
class Link_Widget_Title_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Link_Widget_Title_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Link_Widget_Title_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/link-widget-title-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Link_Widget_Title_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Link_Widget_Title_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/link-widget-title-admin.js', array( 'jquery' ), $this->version, false );

	}

	/**
	 * Add Title Link field to widget form
	 *
	 * @uses add_action() 'in_widget_form'
	 *
	 * @param $widget
	 * @param $args
	 * @param $instance
	 */
  public function add_title_link_fields_to_widget_form( $widget, $args, $instance ) {
  ?>
    <fieldset class="title-link-options">
      <p><label for="<?php echo $widget->get_field_id('title_link'); ?>"><?php _e('Title link <small class="description">(Example: http://google.com)</small>', 'widget-title-links'); ?></label>
      <input type="text" name="<?php echo $widget->get_field_name('title_link'); ?>" id="<?php echo $widget->get_field_id('title_link'); ?>"" class="widefat" value="<?php echo $instance['title_link']; ?>"" /></p>
      
      <p>
        <input type="checkbox" class="checkbox" id="<?php echo $widget->get_field_id('title_link_target_blank'); ?>" name="<?php echo $widget->get_field_name('title_link_target_blank'); ?>"<?php checked( $instance['title_link_target_blank'] ); ?> />
        <label for="<?php echo $widget->get_field_id('title_link_target_blank'); ?>"><?php _e( 'Open link in new window/tab', 'widget-title-links' ); ?></label>
      </p>
      
      <p>
        <input type="checkbox" class="checkbox" id="<?php echo $widget->get_field_id('title_link_wrap'); ?>" name="<?php echo $widget->get_field_name('title_link_wrap'); ?>"<?php checked( $instance['title_link_wrap'] ); ?> />
        <label for="<?php echo $widget->get_field_id('title_link_wrap'); ?>"><?php _e( 'Make the entire title bar clickable', 'widget-title-links' ); ?></label>
      </p>
    </fieldset>
  <?php
  }

	/**
	 * Register the additional widget field
	 *
	 * @uses add_filter() 'widget_form_callback'
	 *
	 * @param $instance
	 * @param $widget
	 *
	 * @return mixed
	 */
  public function register_widget_title_link_field ( $instance, $widget ) {
    if ( !isset($instance['title_link']) )
      $instance['title_link'] = null;
    if ( !isset($instance['title_link_target_blank']) )
      $instance['title_link_target_blank'] = null;    
    if ( !isset($instance['title_link_wrap']) )
      $instance['title_link_wrap'] = null;    
    return $instance;
  }

	/**
	 * Add the additional field to widget update callback
	 *
	 * @uses add_filter() 'widget_update_callback'
	 *
	 * @param $instance
	 * @param $new_instance
	 *
	 * @return mixed
	 */
  public function widget_update_extend ( $instance, $new_instance ) {
    $instance['title_link'] = esc_url( $new_instance['title_link'] );
    $instance['title_link_target_blank'] = !empty($new_instance['title_link_target_blank']) ? 1 : 0;
    $instance['title_link_wrap'] = !empty($new_instance['title_link_wrap']) ? 1 : 0;
    return $instance;
  }

	/**
	 * Add link to widget title on output
	 *
	 * @uses add_filter() 'dynamic_sidebar_params'
	 *
	 * @param $params
	 *
	 * @return mixed
	 */
  public function add_link_to_widget_title( $params ) {
    if (is_admin())
      return $params;

    global $wp_registered_widgets;
    $id = $params[0]['widget_id'];

    if (isset($wp_registered_widgets[$id]['callback'][0]) && is_object($wp_registered_widgets[$id]['callback'][0])) {
      // Get settings for all widgets of this type
      $settings = $wp_registered_widgets[$id]['callback'][0]->get_settings();

      // Get settings for this instance of the widget
      $instance = $settings[substr( $id, strrpos( $id, '-' ) + 1 )];

      // Allow overriding the title link programmatically via filters
      $link = isset($instance['title_link']) ? $instance['title_link'] : null;
      $link = apply_filters('widget_title_link', $link, $instance);

      if ( $link ) {
        $target = $instance['title_link_target_blank'] ? ' target="_blank"' : '';

        // Wrap everything before_title inside the link, if wrap mode is on
        if ( isset($instance['title_link_wrap']) && $instance['title_link_wrap'] ) {
          $params[0]['before_title'] = '<a href="' . $link . '"' . $target . '>' . $params[0]['before_title'];
          $params[0]['after_title']  = $params[0]['after_title'] . '</a>';
        }

        // Otherwise, only wrap the actual title
        else {
          $params[0]['before_title'] = $params[0]['before_title'] . '<a href="' . $link . '"' . $target . '>';
          $params[0]['after_title']  = '</a>' . $params[0]['after_title'];
        }

      }
    }

    return $params;
  }

}
