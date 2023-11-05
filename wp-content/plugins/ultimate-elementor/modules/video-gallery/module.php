<?php
/**
 * UAEL VideoGallery Module.
 *
 * @package UAEL
 */

namespace UltimateElementor\Modules\VideoGallery;

use UltimateElementor\Classes\UAEL_Helper;
use UltimateElementor\Base\Module_Base;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Class Module.
 */
class Module extends Module_Base {

	/**
	 * Module should load or not.
	 *
	 * @since 1.6.0
	 * @access public
	 *
	 * @return bool true|false.
	 */
	public static function is_enable() {
		return true;
	}

	/**
	 * All sections.
	 *
	 * @since 1.35.1
	 * @var all_sections
	 */
	private static $all_sections = array();

	/**
	 * VideoGalleryWidget.
	 *
	 * @since 1.35.1
	 * @var all_video_gallery_widgets
	 */
	private static $all_video_gallery_widgets = array();


	/**
	 * Get Module Name.
	 *
	 * @since 1.6.0
	 * @access public
	 *
	 * @return string Module name.
	 */
	public function get_name() {
		return 'uael-video-gallery';
	}

	/**
	 * Get Widgets.
	 *
	 * @since 1.6.0
	 * @access public
	 *
	 * @return array Widgets.
	 */
	public function get_widgets() {
		return array(
			'Video_Gallery',
		);
	}

	/**
	 * Constructor.
	 */
	public function __construct() { // phpcs:ignore Generic.CodeAnalysis.UselessOverridingMethod.Found
		parent::__construct();
		if ( UAEL_Helper::is_widget_active( 'Video_Gallery' ) ) {

			add_action(
				'elementor/frontend/before_render',
				function( $obj ) {

					$current_widget = $obj->get_data();
					// If multiple times widget used on a page add all the video elements on a page in a single array.
					if ( isset( $current_widget['elType'] ) && 'section' === $current_widget['elType'] ) {

						array_push( self::$all_sections, $current_widget );
					}
					// If multiple times widget used on a page add all the main widget elements on a page in a single array.
					if ( isset( $current_widget['widgetType'] ) && 'uael-video-gallery' === $current_widget['widgetType'] ) {
						if ( ! in_array( $current_widget['id'], self::$all_video_gallery_widgets, true ) ) {
							array_push( self::$all_video_gallery_widgets, $current_widget['id'] );
						}
					}
				}
			);
			add_action( 'wp_footer', array( $this, 'render_video_gallery_schema' ) );
		}
	}


	/**
	 * Render Video Gallery Schema.
	 *
	 * @since 1.35.1
	 *
	 * @access public
	 */
	public function render_video_gallery_schema() {

		if ( ! empty( self::$all_video_gallery_widgets ) ) {

			$elementor     = \Elementor\Plugin::$instance;
			$data          = self::$all_sections;
			$widget_ids    = self::$all_video_gallery_widgets;
			$object_data   = array();
			$positioncount = 1;
			$videocount    = 1;

			foreach ( $widget_ids as $widget_id ) {

				$actual_link          = ( 'on' === isset( $_SERVER['HTTPS'] ) && $_SERVER['HTTPS'] ) ? 'https' : 'http' . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
				$widget_data          = $this->find_element_recursive( $data, $widget_id );
				$widget               = $elementor->elements_manager->create_element_instance( $widget_data );
				$settings             = $widget->get_settings();
				$enable_schema        = $settings['schema_support'];
				$video_link           = array();
				$video_type           = '';
				$is_custom            = '';
				$custom_thumbnail_url = '';
				$schema_thumbnail_url = '';

				foreach ( $settings['gallery_items'] as $key => $val ) {
					$content_schema_warning = false;
					if ( is_array( $val ) ) {

						$video_type = $val['type'];

						switch ( $video_type ) {
							case 'youtube':
							case 'vimeo':
								$video_link = $val['video_url'];
								break;

							case 'wistia':
								$video_link = ( preg_match( '/https?\:\/\/[^\",]+/i', $val['wistia_url'], $url ) ) ? $url[0] : '';
								break;

							case 'hosted':
								if ( 'hosted' === $video_type && 'yes' !== $val['insert_url'] ) {
									$video_link = $val['hosted_url']['url'];
								} elseif ( 'hosted' === $video_type && 'yes' === $val['insert_url'] ) {
									$video_link = $val['external_url']['url'];
								}
								break;
							default:
						}

						$is_custom = ( 'yes' === $val['custom_placeholder'] ? true : false );
						foreach ( $val as $image_url => $url_value ) {
							if ( is_array( $url_value ) ) {

								if ( 'placeholder_image' === $image_url ) {
									$custom_image         = $url_value['url'];
									$custom_thumbnail_url = isset( $custom_image ) ? $custom_image : '';

								}
								if ( 'schema_thumbnail' === $image_url ) {
									$schema_image         = $url_value['url'];
									$schema_thumbnail_url = isset( $schema_image ) ? $schema_image : '';
								}
							}
						}
					}

					if ( 'yes' === $enable_schema && ( ( '' === $val['schema_title'] || '' === $val['schema_description'] || '' === $val['schema_upload_date'] || ( ! $is_custom && '' === $schema_thumbnail_url ) || ( $is_custom && '' === $custom_thumbnail_url ) ) ) ) {
						$content_schema_warning = true;
					}

					if ( 'yes' === $enable_schema && false === $content_schema_warning ) {
						$new_data = array(
							'@type'        => 'VideoObject',
							'url'          => $actual_link . '#uael-video__gallery-item' . ( $videocount++ ),
							'position'     => $positioncount++,
							'name'         => $val['schema_title'],
							'description'  => $val['schema_description'],
							'thumbnailUrl' => $is_custom ? $custom_thumbnail_url : $schema_thumbnail_url,
							'uploadDate'   => $val['schema_upload_date'],
							'contentUrl'   => $video_link,
							'embedUrl'     => $video_link,
						);
						array_push( $object_data, $new_data );
					}
				}
			}

			if ( $object_data ) {
				$schema_data = array(
					'@context'        => 'https://schema.org',
					'@type'           => 'ItemList',
					'itemListElement' => array( $object_data ),

				);
				UAEL_Helper::print_json_schema( $schema_data );
			}
		}
	}

	/**
	 * Get Widget Setting data.
	 *
	 * @since 1.35.1
	 * @access public
	 * @param array  $elements Element array.
	 * @param string $form_id Element ID.
	 * @return Boolean True/False.
	 */
	public function find_element_recursive( $elements, $form_id ) {

		foreach ( $elements as $element ) {
			if ( $form_id === $element['id'] ) {
				return $element;
			}

			if ( ! empty( $element['elements'] ) ) {
				$element = $this->find_element_recursive( $element['elements'], $form_id );

				if ( $element ) {
					return $element;
				}
			}
		}

		return false;
	}
}
