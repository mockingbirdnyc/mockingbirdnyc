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
define('AUTH_KEY',         'l_eXTo:0])j[Vm,g:xV^*%:SB}phPIf=h_:3P,wv[uUs{EOgAxY;e#l]9=0*w?tU');
define('SECURE_AUTH_KEY',  'Y63]~5?UZKEA|QPTf+vBrbnw+`;Zb&t[IsXfLT /liVd(FHi.R]<O]C2QNxuWtE2');
define('LOGGED_IN_KEY',    'p?cizwa<zHoSM]K}wFA!`zbhzG@>iSHKANUN5V>,]4q56rLOH67xYp&kq(a<p!}g');
define('NONCE_KEY',        '-7zmNy5O<)1gHOR,}k3%,(51 HXq.l U;xbQgI&b`HSzb:5P4E`x0gZa3#S?c<;[');
define('AUTH_SALT',        'M9:ug>:uAB9ZcL8rk)Y?7`<$_`^(Ko#uU;TXg=LC)-DY]N:ZeA/vg+YW*EBh&Xna');
define('SECURE_AUTH_SALT', '_*D$$X%16h.KT5GBYw[.]dN[s-0;CvNCxNW5.Sg]CoA6UviJ_2aJ:<&(qU0Ostd*');
define('LOGGED_IN_SALT',   'l?=Ib)M1.O+Fi3//0?=JZ5YdY8EDrsU=D|kPHyUH@[:u&>55oIl_-JZL>uvht*xW');
define('NONCE_SALT',       '$`FsKmtgV338n;k]/{>gE@[xU)N-x>:Fu2up+:-Zu{6Rq36Y>d~?-ppXH``2Cn*#');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_52rbj9_';

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
