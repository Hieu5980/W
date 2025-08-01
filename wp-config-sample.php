<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the website, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'database_name_here' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

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
define('AUTH_KEY',         'CJj+<2u$Iz:u%aHnCO6e,!I[feZKBf=sAb]gYUVH($e%B19fQ0HUtj%Wsc.$&J*)');
define('SECURE_AUTH_KEY',  '/yALBUgU!=S(~;cdq}?YiIBFA0OpUmqU&BW2N%AK*]~JfFg7f)T35pAFx.~Z}?0*');
define('LOGGED_IN_KEY',    'SDN%|DOYivi!._2@,*{$)c(,`0rCPz]+RpN5Pdc~=1ul#FWRJ9f0uT-]lYB^nvZ~');
define('NONCE_KEY',        '!z#1fZlABNKJSDbBp-EV77@mShb/fKCGf/bYxiJ+$-<|~_jB}*^EdNLKyBNGt>$!');
define('AUTH_SALT',        '!N7&|xMDTxN+^46eWZ&UC^jyvO_(LOuJNX!u!y]V`5K3]giO4Jq-G^d;+~Bx|wd/');
define('SECURE_AUTH_SALT', '8b-8i`=)S)Qx(QqJh~=0LVRS @S/q-YWxu5r7?L,g ^|29p?4Up4g,; p]|?ijpI');
define('LOGGED_IN_SALT',   'Jow-4=iFA@y-QS|W%HQheOv,W5})jW(C/S3Z%R*69?/GQ-:e_k?70$W!wV28K]BO');
define('NONCE_SALT',       'gotmH &o3|r68#Z-d57Sq!6.F3e2F|Oarvq?8ohYOQR2-:1<}N0@+z-pUOA#H~+K');

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 *
 * At the installation time, database tables are created with the specified prefix.
 * Changing this value after WordPress is installed will make your site think
 * it has not been installed.
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/#table-prefix
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
 * @link https://developer.wordpress.org/advanced-administration/debug/debug-wordpress/
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
