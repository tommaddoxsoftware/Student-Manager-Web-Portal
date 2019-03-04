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
define('DB_NAME', 'student_manager');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

/** MySQL hostname */
define('DB_HOST', 'localhost');

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
define('AUTH_KEY',         'wJhWi#n]_nIEH`<7`qn5HulsX{tk 9p[u]0:?;yQM_C[Tb`k!/&qA<)WlYzB051#');
define('SECURE_AUTH_KEY',  'usg?v&#F}fw)V#zRZsuURlsp|,{p{myN`N@Y/X4<8r9Yf}5cN8[0qy$4l|ZMUm~Z');
define('LOGGED_IN_KEY',    'fIbfDRE-!{}pU:_-A|(KL&Ak9nx7MJ|R8=C>*90i& @L_cDbt_Id7g_P%wiW8Y|&');
define('NONCE_KEY',        'UF-<LV JV-Md]5rk| 2ul^LsrBM@a+d1`<}+k>yfi85]C8; LzQE%!HQly[m E{O');
define('AUTH_SALT',        ')wm|Hz^Q^}H2{T:!fRn)vbXG)FG+2tx!S{*pJYJRv<oGZZRtxXbK48B hsc8}{wj');
define('SECURE_AUTH_SALT', '&I/UJVQ.jbX^PgLOy7u*bN;=,,p~/u9Pyclw?*C[Rgqh_9d`Cw7 /I>V|iit/5hD');
define('LOGGED_IN_SALT',   'aO48w7]=/7FkWYC|ImDFwdOr~5w3R`KaE7O]fD:aTRG@qeK:MB#lc2ggCS&ot~~T');
define('NONCE_SALT',       'C)+65Z77uESkQ@pAj:ZhJ=8f3-OZ$~:HhdX:ceGTDcixb|]uYvpB;MQX4~VWUsUk');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'sm_';

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
