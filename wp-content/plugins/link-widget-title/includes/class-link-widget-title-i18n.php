<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://allurewebsolutions.com
 * @since      1.0.0
 *
 * @package    Link_Widget_Title
 * @subpackage Link_Widget_Title/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Link_Widget_Title
 * @subpackage Link_Widget_Title/includes
 * @author     Allure Web Solutions <info@allurewebsolutions.com>
 */
class Link_Widget_Title_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'link-widget-title',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
