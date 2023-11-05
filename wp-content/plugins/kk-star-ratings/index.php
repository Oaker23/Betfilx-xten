<?php

/**
 * Plugin Name:     kk Star Ratings
 * Plugin Slug:     kk-star-ratings
 * Plugin Nick:     kksr
 * Plugin URI:      https://github.com/kamalkhan/kk-star-ratings
 * Description:     Allow blog visitors to involve and interact more effectively with your website by rating posts.
 * Author:          Kamal Khan
 * Author URI:      http://bhittani.com
 * Text Domain:     kk-star-ratings
 * Domain Path:     /languages
 * Version:         5.4.6
 * License:         GPLv2 or later
 */

use function Bhittani\StarRating\core\functions\action;

if (! defined('ABSPATH')) {
    http_response_code(404);
    exit();
}

define('KK_STAR_RATINGS', __FILE__);



if (function_exists('kksr_freemius')) {
    kksr_freemius()->set_basename(true, __FILE__);
} else {
    if (! function_exists('kksr_freemius')) {
        require_once __DIR__.'/freemius.php';
    }

    require_once __DIR__.'/src/index.php';
    require_once __DIR__.'/src/core/index.php';

    // Let everyone know that the plugin is loaded.
    action('init', kksr());
}
