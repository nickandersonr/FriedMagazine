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
define('DB_NAME', 'Wordpress');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'Ilikewater1!');

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
define('AUTH_KEY',         '$i9YsEJ&.OMIRz|ve%{A<vQBOzgm>|,crvtp)%zkNWz+C9N6`<Zz|AV_^sWCC%X>');
define('SECURE_AUTH_KEY',  '>O?a*7T|;b; -keB;c6t9$D&{2*n2u-|S+tcPm%:D1z+qjK}%->^pyyX|dA_GZq[');
define('LOGGED_IN_KEY',    'L]eo;K7h9+~G!TE=`u]UgP9 S wv7rbv?%|]3K.:H|B(qH(-Ya![y+|C0=8fUxE!');
define('NONCE_KEY',        '}Mryq+AX7>N3z:pR%tH}D|ep#S&8S|ZlP?6|d9(Q<&{ma9}za=fp]q;Go1j8#];W');
define('AUTH_SALT',        '4j2K}v2gKL*PnDU6FdG`NSCUok=36 oQwb|eIv4?XR AehI{`Zd~EV-Oc?^f^ty?');
define('SECURE_AUTH_SALT', 'DvJ-}* 7n(`>?$M;yMV2&gZUh#S7-t9rczL-L1wF9{-DM+^thh3aK*4@4o:vBuNv');
define('LOGGED_IN_SALT',   '[LSGv;uP{qG^oF9Lq<9Jxw%:ad#=j!b.8z8UaHnVdDwuROoLH~`pnae+M42-;{y|');
define('NONCE_SALT',       '6cs:zt6>$V11^ClscU!&-.3F/[ePm&_@`P+.QHT2-?XgBsoyD69H,$6ya#.4f}!L');

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
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
