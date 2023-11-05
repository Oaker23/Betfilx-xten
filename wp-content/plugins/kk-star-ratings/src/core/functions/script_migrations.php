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

function script_migrations(bool $isDebugMode = false): void
{
    wp_enqueue_script(
        kksr('nick').'-migrations',
        kksr('core.url').'public/js/kksr-migrations'
            .($isDebugMode ? '' : '.min').'.js',
        ['jquery'],
        kksr('version'),
        true
    );

    wp_localize_script(
        kksr('nick').'-migrations',
        str_replace('-', '_', kksr('nick')).'_migrations',
        [
            'action' => kksr('nick').'-migrations',
            'endpoint' => admin_url('admin-ajax.php'),
            'nonce' => wp_create_nonce(kksr('core.wp.actions.wp_ajax_'.kksr('nick').'-migrations')),
        ]
    );
}
