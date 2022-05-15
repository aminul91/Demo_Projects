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
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */
// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */

define('FS_METHOD', 'direct');

define( 'DB_NAME', 'web_ecom' );

/** MySQL database username */
define( 'DB_USER', 'webmaster' );

/** MySQL database password */
define( 'DB_PASSWORD', 'Aminul$123' );

/** MySQL hostname */
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
define( 'AUTH_KEY',         ')0Ht~j02G58ztnbD#8[3!=Z6pxDe>O7N`nF!r1L0h7eBcqh2c-[*n|4%8;GJ-:v|' );
define( 'SECURE_AUTH_KEY',  '4Om1O+hwRxi-64c53sfeu$uvO#N#&7_k^Fwj>;|-z?c+XUDf =Qm_IxRwqyWHPkr' );
define( 'LOGGED_IN_KEY',    'sA@|ajTQR>gDhKKofW)*PApnvpK/i$?UgE,I}1TzR/Bs|80;`g|e&Te9vnMY}X$-' );
define( 'NONCE_KEY',        'I18!!)eI/Qpvugmi.Xxif>-Tg[>f96 6[UWX_8j%oi?>*E|2:l.uxc&3r<@Ahg6K' );
define( 'AUTH_SALT',        'L]HDn}MOIW_RNN}<k>x.7_0>nVtb[cS]bNwo_WuYve<XiL6S?uG#v^|:c*o~;7(?' );
define( 'SECURE_AUTH_SALT', '9r@QZR%[%z%{!cXWal+MdNs[<tQvDIo+Dh/n=QW%=`5,+*&NvX:nX-TG?WcXq5%9' );
define( 'LOGGED_IN_SALT',   'wxnI{V6,s)A@EsJ#03AeZS7hVbtpTQAF|FtZgO)2q}j= ipx8k@[q0y>CzK8^.m&' );
define( 'NONCE_SALT',       '0[av3?ryRcis`^N8$gS,sn}*yavC`{qaAg/}o^&HIj?zYU3=JBKkEC=}^8/C&D#E' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'bd_';

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
