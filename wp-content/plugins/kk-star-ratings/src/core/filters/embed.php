<?php

/*
 * This file is part of bhittani/kk-star-ratings.
 *
 * (c) Kamal Khan <shout@bhittani.com>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace Bhittani\StarRating\core\filters;

use function Bhittani\StarRating\functions\applying_filter;

if (! defined('KK_STAR_RATINGS')) {
    http_response_code(404);
    exit();
}

/** Whether to auto-embed the star ratings in a post. */
function embed(?bool $bool, string $content): bool
{
    if (! is_null($bool)) {
        return $bool;
    }

    if (applying_filter('get_the_excerpt')) {
        return false;
    }

    foreach ([
        kksr('slug'),
        // Legacy...
        'kkratings', // < v3
        'kkstarratings', // v3, v4
    ] as $tag) {
        if (has_shortcode($content, $tag)) {
            return false;
        }
    }

    return true;
}
