<?php

//Begin Really Simple SSL Load balancing fix
if ((isset($_ENV["HTTPS"]) && ("on" == $_ENV["HTTPS"]))
|| (isset($_SERVER["HTTP_X_FORWARDED_SSL"]) && (strpos($_SERVER["HTTP_X_FORWARDED_SSL"], "1") !== false))
|| (isset($_SERVER["HTTP_X_FORWARDED_SSL"]) && (strpos($_SERVER["HTTP_X_FORWARDED_SSL"], "on") !== false))
|| (isset($_SERVER["HTTP_CF_VISITOR"]) && (strpos($_SERVER["HTTP_CF_VISITOR"], "https") !== false))
|| (isset($_SERVER["HTTP_CLOUDFRONT_FORWARDED_PROTO"]) && (strpos($_SERVER["HTTP_CLOUDFRONT_FORWARDED_PROTO"], "https") !== false))
|| (isset($_SERVER["HTTP_X_FORWARDED_PROTO"]) && (strpos($_SERVER["HTTP_X_FORWARDED_PROTO"], "https") !== false))
|| (isset($_SERVER["HTTP_X_PROTO"]) && (strpos($_SERVER["HTTP_X_PROTO"], "SSL") !== false))
) {
$_SERVER["HTTPS"] = "on";
}
//END Really Simple SSL
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'betflixff_wp' );

/** Database username */
define( 'DB_USER', 'betflixff_wp' );

/** Database password */
define( 'DB_PASSWORD', 'g8reZ0TipJ' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         '`F4&6=*Eo,* ,ilOf,dxqNn=XG2)A1|V&c5Jy|&?9:ty^h,a(PRrc94||CTykVF>' );
define( 'SECURE_AUTH_KEY',  '.`S+Ctw6zVGNe4nNRQI3.e0@DHK,V*a~)pix+t@:,ONT::}!)c>nep S%@]fg[`m' );
define( 'LOGGED_IN_KEY',    'z+~Pp`Kbk812Npb>>Up21I#y#N0p_OG]f?%qRo7:4R?;maRuhq_bj$ge%!(QdD<[' );
define( 'NONCE_KEY',        'w!T{^vkS[vnd%-__Si84(![2ds6x6QCdQ~Q4,Uw)crdGD@PG#:#C/CpO|]6>)lZd' );
define( 'AUTH_SALT',        'SZ43l$JE*aUINxTgQE8Nk&n2|!@(FO!sw8w=zfi*x-><|73|HAqTc(1:BnXBIA:b' );
define( 'SECURE_AUTH_SALT', '}!zcVr%VM;I?`W$,#BQ]!rnJb</nXSPyCS#~k8H}S:H/o:t<U#hr{8LEL{Y2S@Yp' );
define( 'LOGGED_IN_SALT',   ':/?.O*meU>)XXH>)JNcNaldY h@y^bw@av`AeuZDwbg*_^FJ2L1p[AP%h&ZiHZ3-' );
define( 'NONCE_SALT',       'K3r@yqVFW`hqB#F3(]D/E=ZI+a{)_Lz1.ywCA26_LrrM0sk::Zb}.9HJ&n?01 ]#' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the documentation.
 *
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
