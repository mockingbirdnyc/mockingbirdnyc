<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, and ABSPATH. You can find more information
 * by visiting {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'michaelcerrito_com_1');

/** MySQL database username */
define('DB_USER', 'nay5xqj');

/** MySQL database password */
define('DB_PASSWORD', '3sptX7?a');

/** MySQL hostname */
define('DB_HOST', 'mysql.michaelcerrito.com');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'FJbN|R5%gy(8^?z|C`h(%$*;1p!nI8!VLd~Yma%W2uZxu:P+1Ac8|xJy8D&qY~96');
define('SECURE_AUTH_KEY',  '`9_bck1B#MRb`@1jKKR~S47G+4m5FN$yJ/+m8/oAyz|44A`zz~"nmcD&N4$`OP31');
define('LOGGED_IN_KEY',    'Frut:gSjrh$%4NNkdeF!qIp+8PcfNrB;e0pg~X?HAZSGu"SR9"Uz|k*8_lwJ3iMB');
define('NONCE_KEY',        'p/Oi8vQKy)h7`tiZeEuddwb3rO7q?VXYHa%4deY8"6rN:t$U/6^P)));eY2ZqW;E');
define('AUTH_SALT',        '0LTnoGhKm3zPUYfITI650H;)5;NCJpBxigU75`zXzTMdA%u:F#FNk:USQK7^`kA!');
define('SECURE_AUTH_SALT', '|W5PC(r@?Uk|Eyw#ae9hr*5s9?_!Hx;kFchhMwiVi&dDnc"8$exl+^AP~vc+t^A6');
define('LOGGED_IN_SALT',   '3b!PLKjvgUjUA&Cqs|Ak1V4U#nzsshm2`/WEUSp|e#$"44/#@QK*;|2(6Y9hoV;%');
define('NONCE_SALT',       '87y#!G(PBzz0w`iMrTpLYtap1dV38vz2Oj_iv"|9A")!MnE~z^?&GmomxgZxFZVw');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_52rbj9_';

/**
 * Limits total Post Revisions saved per Post/Page.
 * Change or comment this line out if you would like to increase or remove the limit.
 */
define('WP_POST_REVISIONS',  10);

/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress. A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de_DE.mo to wp-content/languages and set WPLANG to 'de_DE' to enable German
 * language support.
 */
define('WPLANG', '');

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
