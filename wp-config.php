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
define( 'DB_NAME', 'odb' );

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
define( 'AUTH_KEY',         'hXt=$Oi/8wT|FtJU4t<UPOG1TEwX<aTi]7yG<$BaA|n_|I|=b);q$0&<.*}w{e^K' );
define( 'SECURE_AUTH_KEY',  'b`xU0oNmR+&;;R2&7%wBV*NWcL>@Tk8,6?Jqf13JIwKWNRC,](~:>:/m RlZztSL' );
define( 'LOGGED_IN_KEY',    '$fbg!HLi_dYD{lxao{(nsphFfw>,((Q-Ug{DR5b68iUXOKf(SF:6vjzc%7+fqNTH' );
define( 'NONCE_KEY',        '[Ne-[>XCZKU!,YC04[WB!wS;.ee<`Vjt@5RTgg@ov|q=/S&xlN`d#!@VpJfDbYVf' );
define( 'AUTH_SALT',        '$B]z3-CV|qxDE_v9%_-S`pvAZU.vydWf:&IKau}=Tnh$pE#]:aMCl1%k?:{n|iHI' );
define( 'SECURE_AUTH_SALT', 'AP%MZqQ1ny|f.kwA(VLY:6eBL>nq0.(>|n_GTFQ+qgDa(cjExAg[v|e?yT`i]j*3' );
define( 'LOGGED_IN_SALT',   '<P%fYH95171=$89U,C0gW@0.Xe)X5_%6/gj_EwLNq3/D?_wk*:3b4YJDCqWW4dnh' );
define( 'NONCE_SALT',       'z2N3#h|r:$b9!#-t;]3B=q+f.LK1~)>Y,ff@2dHWAQb&oN~j}HrO]AU9xdk.powX' );

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
