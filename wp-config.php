<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

define( 'WPCACHEHOME', '/var/www/html/wp-content/plugins/wp-super-cache/' );
define( 'WP_CACHE', true );
// Define Environments
$environments = array(
    'development' => 'localhost',
    'production' => 'store.mbird.com',
);
// Get Server name
$server_name = $_SERVER['SERVER_NAME'];

foreach($environments AS $key => $env){
    if(strstr($server_name, $env)){
        define('ENVIRONMENT', $key);
        break;
    }
    else{ define('ENVIRONMENT', 'ec2'); }
}
// Define different DB connection details depending on environment
switch(ENVIRONMENT) {
    case 'development':
        define('WP_SITEURL', 'http://localhost');
        define('WP_HOME', 'http://localhost');
        define('WP_DEBUG', true);
        define('WP_CACHE', false);
        @ini_set('log_errors','On'); // enable or disable php error logging (use 'On' or 'Off')
        define('WP_DEBUG_DISPLAY', false);
        define('WP_DEBUG_LOG', true);
        define('SCRIPT_DEBUG', true);
        define('SAVEQUERIES', true);
        define('WP_ALLOW_REPAIR', true);
        break;
    case 'production':
        define('WP_SITEURL', 'http://store.mbird.com/');
        define('WP_HOME', 'http://store.mbird.com/');
        define('WP_DEBUG', false);
        break;
    case 'ec2':
        define('WP_SITEURL', 'http://' . $_SERVER['HTTP_HOST']);
        define('WP_HOME', 'http://' . $_SERVER['HTTP_HOST']);
        ini_set('log_errors', 'On');
        ini_set('error_log', '/var/app/current/php-errors.log');
        error_reporting(E_ALL);
}

// If no environment is set default to production
if(!defined('ENVIRONMENT')) define('ENVIRONMENT', 'ec2');

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'mbird_store_wordpress');

/** MySQL database username */
define('DB_USER', 'bn_wordpress');

/** MySQL database password */
define('DB_PASSWORD', '9494647662');

/** MySQL hostname */
define('DB_HOST', 'mbird-store.chc5sxkp1qgh.us-east-1.rds.amazonaws.com');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

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
$table_prefix = getenv('DB_TABLE_PREFIX');

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
 *
 * For information on other constants that can be used for debugging,
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
