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
define( 'DB_NAME', 'phonestore_db' );

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
define( 'AUTH_KEY',         'qdUQCUBu0ZT:u*r+- |x{;y!MbgBX.OfR6])>A]e$/su3RTX)-M35DV,kJ8flb-2' );
define( 'SECURE_AUTH_KEY',  'lh[F:i]FsjzWM0|ZT4U?6hk-;,5D-MAnMaj8W37c.N[vUZ@A~}K|ezg@c=|=&256' );
define( 'LOGGED_IN_KEY',    '|vox;h^|S%Yf]2jLlcX8Y;=5%hZDht}CT5V,dS]>?_Sb>q2f1YQV[kQy9Cwu+{[9' );
define( 'NONCE_KEY',        '?<jA3%:k+P=?L2+UaR9st$};S>Rp*OMPe?%qZYW(PO Fgd+mEf,1S+}k(16C Df~' );
define( 'AUTH_SALT',        'uL9E|Rk02L]IXGvCGB+HL4APD(6Twn9l%]^_&Q*+,Rv@rm@p/-H1NuP_Jv!^?x)#' );
define( 'SECURE_AUTH_SALT', '$u@uftGb,z}BXP~ns?96~@bXm-uh/]An2{U+]60qY.&Cj?A% zJwmapo*sXL;m,I' );
define( 'LOGGED_IN_SALT',   ']#&)TmMsX_3qop?EjP+qaWvh_$Ev][CVe;.j8zk74?0gRx7Noo755_*ju=`Znm=a' );
define( 'NONCE_SALT',       's~N-;!~-.ED_!`i8sk/5k5.E`ErGhWKZ6L[=2#;x@Yvc)u1?UK`_wJxCjiFERU$1' );

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
