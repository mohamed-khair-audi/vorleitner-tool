<?php
define( 'WP_CACHE', true ); // Added by WP Rocket

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
 * * Localized language
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'wp_vortleitner' );

/** Database username */
define( 'DB_USER', 'wp_user' );

/** Database password */
define( 'DB_PASSWORD', 'wp_password' );

/** Database hostname */
define( 'DB_HOST', 'db' );

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
define('AUTH_KEY', '*8&iJSbUdG;:4u7-|T[u6K2xO;O)Njnc4j]0!~|Y~U#3B+4cI&*/UCf963J00t7@');
define('SECURE_AUTH_KEY', 'E26/%@37&20;e2VL9yS6[]K5U06T06x/sJJo7oRmI:5/0Gt9yT@ChV()LMzpN9f0');
define('LOGGED_IN_KEY', '3Ch7aI)*v140(-;yR8m@Wax0I*9gH3!5f+Af(~&|%2OnG25%69Y3Gyyf[3Z0s6yK');
define('NONCE_KEY', '6HA04aWg%9m503[BQ4b5I567o2-sN!wCWv47L857Tz2J(-4!IC-8S(C@+G;A5|pa');
define('AUTH_SALT', '_0Lw]@cd8T3C_7SqY72R@pc7Aro[c6AhZl377985SV0kO4r@:/tSPIG1RR9vyAOc');
define('SECURE_AUTH_SALT', 'r+~O5oH4C+2e_eS|AB7K2m3vpP1kg&O7nq0&N6l/HOp69XfFH/v9S7&ZlD%x/v#3');
define('LOGGED_IN_SALT', 'mhEXB7&v0h7!7o7b878-5#(u2Y8L~U;fBG3kSD31(3[16E1T5E)/83iw!VuB1A|A');
define('NONCE_SALT', '@0(m(ch14B!+3]/]lm!pP)h3::k]Abw+C&YBg@g%ls|B98]j9aOKN:kgXlO[Vh[r');


/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'Vortleitner_';


/* Add any custom values between this line and the "stop editing" line. */

define('WP_ALLOW_MULTISITE', true);
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
if ( ! defined( 'WP_DEBUG' ) ) {
	define( 'WP_DEBUG', true );
}

define( 'WP_DEBUG_DISPLAY', false );
define( 'WP_DEBUG_LOG', true );
/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
