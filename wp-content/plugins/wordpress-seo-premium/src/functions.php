<?php
/**
 * WPSEO plugin file.
 *
 * @package Yoast\WP\SEO\Premium
 */

use Yoast\WP\SEO\Premium\Main;

/**
 * Retrieves the main instance.
 *
 * @phpcs:disable WordPress.NamingConventions -- Should probably be renamed, but leave for now.
 *
 * @return Main The main instance.
 */
function YoastSEOPremium() {
	// phpcs:enable

	static $main;
	if ( did_action( 'wpseo_loaded' ) ) {
		if ( $main === null ) {
			// Ensure free is loaded as loading premium will fail without it.
			YoastSEO();
			$main = new Main();
			$main->load();
		}
	}
	else {
		add_action( 'wpseo_loaded', 'YoastSEOPremium' );
	}

	return $main;
}
