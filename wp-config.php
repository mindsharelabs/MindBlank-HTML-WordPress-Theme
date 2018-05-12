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
define('DB_NAME', 'html5');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'root');

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
define('AUTH_KEY',         'kN/D8_(xmK=zA.Z&t?4BeNS hG]PW~]CNv);&qvXrouJOg7l-`=%SCMRAG4Tvu4p');
define('SECURE_AUTH_KEY',  'gZffp{*M7K-i)N-X-V/P1`@!CoOJ4Yf_|f-)U,v)s;LgP>^jQ?V,Uv61e2TQyA$%');
define('LOGGED_IN_KEY',    '>eN9h-.+:=tXR-,hL(~rA_|vRUKSkoCW7Z xi`{QFzIJ0#L-;-p*~u{vt%HybOXd');
define('NONCE_KEY',        'Fev$ig[w|5S4a2lnd%d2? O[wC_p(yIgdF:eIGB(Z?=J#Y%e1@s0hVoeV:?z:cn0');
define('AUTH_SALT',        'Jy)Rljjex-OPSvPvyh1?]7PR,DE<8_wiO@$n~V!ZbtB)q)x)H)^-H :|o=8}}pnt');
define('SECURE_AUTH_SALT', 'wV0d`>P!~%_$bB`@NmQl^[lOXU~*1T3Q=^0E2N38s`B<,*@w(UPwGW4,_A$[.T:?');
define('LOGGED_IN_SALT',   'e4TO,{ NG|Wi<qmK)!7*i0evU_]MNtojxZfQf$[035LrO;Om_Wtz@Iz5m/K3W{GG');
define('NONCE_SALT',       '_9U|v[o@;&G.~b#Dfn:sj}GCCm/m1/{QTrVJzMfsB%+N9KN9?;pS~.}e*h$*ui)v');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

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
define('WP_DEBUG', TRUE);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
