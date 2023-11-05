<?php

/**
 * @package Auto-Install Free SSL
 * This package is a WordPress Plugin. It issues and installs free SSL certificates in cPanel shared hosting with complete automation.
 *
 * @author    Anindya Sundar Mandal <anindya@SpeedUpWebsite.info>
 * @copyright Copyright (C) 2019, Anindya Sundar Mandal
 * @license   http://www.gnu.org/licenses/gpl-3.0.html GNU General Public License, version 3
 * @link      https://SpeedUpWebsite.info
 * @since     Class available since Release 1.0.0
 *
 *
 *   This program is free software: you can redistribute it and/or modify
 *   it under the terms of the GNU General Public License as published by
 *   the Free Software Foundation, either version 3 of the License, or
 *   (at your option) any later version.
 *
 *   This program is distributed in the hope that it will be useful,
 *   but WITHOUT ANY WARRANTY; without even the implied warranty of
 *   MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *   GNU General Public License for more details.
 *
 *   You should have received a copy of the GNU General Public License
 *   along with this program.  If not, see <https://www.gnu.org/licenses/>.
 */

if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
    wp_die(__("Unfortunately, this app is not compatible with Windows. It works on Linux hosting.", 'auto-install-free-ssl'));
}

if (!defined('PHP_VERSION_ID') || PHP_VERSION_ID < 50400) {
    wp_die(__("You need at least PHP 5.4.0\n", 'auto-install-free-ssl'));
}

if (!extension_loaded('openssl')) {
    wp_die(__("You need OpenSSL extension enabled with PHP\n", 'auto-install-free-ssl'));
}

if (!extension_loaded('curl')) {
    wp_die(__("You need Curl extension enabled with PHP\n", 'auto-install-free-ssl'));
}

require_once __DIR__ . '/../../../../wp-load.php';
require_once ABSPATH . 'wp-admin/includes/file.php';

// Increase script execution time
ini_set('max_execution_time', '0');

$ok = ssl_zen_admin::cron_ssl_renew();
if (is_bool($ok) && $ok) {
    // Remove http verification files, no meter what variant have used before
    ssl_zen_helper::deleteAll(ABSPATH . '.well-known/acme-challenge', true);
}
