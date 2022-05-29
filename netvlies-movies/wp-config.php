<?php
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
define( 'DB_NAME', 'netvlies_movies' );

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
define( 'AUTH_KEY',         '/b~*.2rEirknyf A{ThZPcfhL:wgS2FkYhTDE]|_H&Y,j.E@bwO5z9%s98[zbO#u' );
define( 'SECURE_AUTH_KEY',  'F}K@4UR/P{07})8NE>m@u.w.<}plScJ2c=O?O Yv/]z,_Ek4{H_m/L~G%H8=o?t[' );
define( 'LOGGED_IN_KEY',    '!hhJy^G#YE]TRKSzFt2l.]xzbI_?IT<`~K8i#j9y0HXt1y5VbhhVp>R}Q5:t0!?:' );
define( 'NONCE_KEY',        '4u9pD:icR[F*;P7<e!6KzO}Z~:O|SQd9AIeJ)lUi(nm;U3)g!(^{Bc.YOFto:A4w' );
define( 'AUTH_SALT',        'VY^C9tB_~hVFq=*RCa%Ujv;T7F<i(~B|J~mzK6YtZ5yuCMUe0VNYp)3K:&:E.}Zn' );
define( 'SECURE_AUTH_SALT', 's;p[0We=tjaDGvm5O$)1}X/EXQ[9,Ermg |qz3GAiscnNx5m:SOPtk%7ux./k~sD' );
define( 'LOGGED_IN_SALT',   'hrnR7WR SQ{r9cB4j=C1l-$2<%7*a6%8$}SS70iQl|q0/ZVPvf~ZXPi134|Iiw1k' );
define( 'NONCE_SALT',       '/}ql[Gz-%#&nuG/.?Zywz&7AP@IVbwqi=;/bb>t<7NqkB7}=NM_<x9*&+1`Jd]@X' );

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
