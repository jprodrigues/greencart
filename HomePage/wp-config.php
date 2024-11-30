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
define( 'DB_NAME', 'banco1site' );

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
define( 'AUTH_KEY',         ';*19NKY@$@6B;$[-2R+gJ7FL/Mtb4^vaXU3S@HL.Y!w15y^fAgP7F0[> o*JwfEg' );
define( 'SECURE_AUTH_KEY',  '%[dtn1|]H!^~py?)9x2Ny<m;zLwK8taSc5Jm7sLB%I{eDj4l4a1_#}!`W6bOz_9]' );
define( 'LOGGED_IN_KEY',    '#G(wuVY4?qqbhjM4ctX@V`1@!P>4O{&#9:Ur~1k-29E6th<!EhMOmK+Cn5%%lKpq' );
define( 'NONCE_KEY',        'E:w+YM^TC}FZ:Tm$Y::6CbrN|<dL[3t@[BOM:a^MK<JRoN*UknDlVvH&qf%Y6W`p' );
define( 'AUTH_SALT',        'G@6HB9rBInQ?8~jMV-kp-H;l)hxGEAK~G^aB9PnX9Gs3>RV9 aHf:.!rv/zr&_ka' );
define( 'SECURE_AUTH_SALT', 'PxF=iZ<m!R00fEtYZkB^|9N8%8=Y%C;U5EcR_c,PJ]]uv[k+&~LRqHYxm7R5)1Z0' );
define( 'LOGGED_IN_SALT',   '?v=|xHiZh9RaR7nVPMVU*yJ3]Z9eBxR5*x%$qrC_uEOqz]T+,Mu8@1(i#ccLO~TB' );
define( 'NONCE_SALT',       '!9TVQe rnk<g6TUpM5d`F{a,DVZ3TcTV|c,0R`}U*`UP7pvGSDH.?v6d`]ft:)1q' );

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
