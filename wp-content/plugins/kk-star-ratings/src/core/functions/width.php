<?php

/*
 * This file is part of bhittani/kk-star-ratings.
 *
 * (c) Kamal Khan <shout@bhittani.com>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace Bhittani\StarRating\core\functions;

if (! defined('KK_STAR_RATINGS')) {
    http_response_code(404);
    exit();
}

/** Calculate the width, providing a size and a gap */
function width(float $score, float $size = null, float $gap = null): float
{
    $size = $size ?? option('size');
    $gap = $gap ?? option('gap');

    return max(0, $score * $size + $score * $gap - $gap / 2);
}
