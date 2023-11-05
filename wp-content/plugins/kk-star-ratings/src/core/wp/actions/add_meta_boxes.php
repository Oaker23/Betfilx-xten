<?php

/*
 * This file is part of bhittani/kk-star-ratings.
 *
 * (c) Kamal Khan <shout@bhittani.com>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace Bhittani\StarRating\core\wp\actions;

use function Bhittani\StarRating\core\functions\action;
use function Bhittani\StarRating\core\functions\calculate;
use function Bhittani\StarRating\core\functions\option;

if (! defined('KK_STAR_RATINGS')) {
    http_response_code(404);
    exit();
}

function add_meta_boxes($type, $post): void
{
    $icon = $legend = '';

    if ($post) {
        $best = option('stars');
        [$count, $score] = calculate((int) $post->ID, 'default', $best);
        // $icon = '<span class="dashicons dashicons-star-half" style="margin-right: .25rem; font-size: 18px;"></span>';
        $legend = '';

        if ($score) {
            $legend = "
                <span style=\"margin-left: 10px;color:#666;\">
                    {$score}
                    <span style=\"font-weight:normal;color:#ddd;\">/</span>
                    {$best}
                    <span style=\"font-weight:normal;color:#aaa;\">({$count})</span>
                </span>
            ";
        }
    }

    $postTypes = array_merge(
        ['post', 'page'],
        get_post_types(['publicly_queryable' => true, '_builtin' => false], 'names')
    );

    $title = '<span class="components-button components-panel__body-toggle" style="margin: -15px;">'.$icon.kksr('name').$legend.'</span>';

    add_meta_box(
        kksr('slug'),
        $title,
        function () use ($type, $post) {
            wp_nonce_field(kksr('core.wp.actions.save_post'), kksr('slug').'-metabox');
            action('metabox/index', $type, $post);
        },
        $postTypes,
        'side'
    );
}
