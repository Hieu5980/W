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
define( 'DB_NAME', 'project_wordpress' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '170389' );

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
define( 'AUTH_KEY',         'q&C!dR5Y6|aC)$cNSFg2#3g|<Y@McWrz1}i9:Mf([W~]qB&V-dy#w/<*%U0S &W^' );
define( 'SECURE_AUTH_KEY',  '@l<{e`%+p8FpQEZ1BD%Ro~yN3=fjXaYEXwK8dp.%7Oy{O8Y8 >;4#oxg2Q+Ou4hA' );
define( 'LOGGED_IN_KEY',    'B_Y:YZm?e>d/F+f!.TZVBD!P35 <$(DGkpDu%+.<Fe.z+1`)2s08EZkLz?skfqAV' );
define( 'NONCE_KEY',        'aF$@1-wLe7l=0sfeJ&43DXxE%XH|A<Ilf1wr~Cxx-?li.l3<|,8@Ter>K(b+4=5f' );
define( 'AUTH_SALT',        'y<gEU/!7.6z0J-:;tHa[[~)Gr+8:M[dx0uZTIG5#7XUs_/t1AUJTo;ytrf>~gG,a' );
define( 'SECURE_AUTH_SALT', 'R_@4t{6Va|kC(7Vy]/lDuLpfsBtl:0nQ5pUk@MnN}Bk-Dd_Vwz,rI7z}- nS$E/R' );
define( 'LOGGED_IN_SALT',   'OMu9E?<t$hS`Ui~[!U:0PzC;<i->xX]4[N3IQ%JWY.KZm#eVu#r>,8:[,8;gYW]^' );
define( 'NONCE_SALT',       'aU,EF8a-U?X@*=pD?Yz$vwp`wHl`6fMIt5w&!FlgRdD*SsE2TOY1}#edjT`mJs_%' );

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
