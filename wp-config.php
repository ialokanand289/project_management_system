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
 * @link https://wordpress.org/documentation/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'project-management-system' );

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
define( 'AUTH_KEY',         '+@ukUL[ (%xdrH{F[!w2H|+b=]co6#;p~3z |Ife-o/gJ/!(t-l(>@#?853GSV4i' );
define( 'SECURE_AUTH_KEY',  'zc2aATfnpu.|D=ucM@B@]07@?[^Z3^BX|C(6dbbuzWQt}u$}#w-p*MyEUnG^pvth' );
define( 'LOGGED_IN_KEY',    'je29&$y,OjI[*WJ#dsb^o-<}6f7S7V?Z:x(.c1VrwN5DdV+~mV_EC2]x4fM2uUDb' );
define( 'NONCE_KEY',        'NV7GswHYNr}O@7elR%aWfDn4p)y^8>#<v^5Ck=H*(`M>)xYvWUxBfQrDW2qK/-Qi' );
define( 'AUTH_SALT',        '=.%q}&}R22xWMw.uT}6?mYJGH)F!v)m|(x=]@ s]u^i`xD)0}qn#v6tGJ;FDcCZ[' );
define( 'SECURE_AUTH_SALT', 'XA+W+KXTA|myMMq8VDn&Uuj+^QL#{e| &<B^;`;icGTN<NVF3-RQqpjFAt(K&[<i' );
define( 'LOGGED_IN_SALT',   'f<B_B:r*lzL*|T^!+dAdNF>(,<?@prIo*$qpXjU/{)eJNpA%{~)hbn}e6jwMF<e[' );
define( 'NONCE_SALT',       '4<cH7[s*5a`Yp&o`SqEZjB9p%{EEKs+lRi>8xxWSnmI}=UHI{OU`)=7UMX-rcWHc' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_project_management_system';

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
 * @link https://wordpress.org/documentation/article/debugging-in-wordpress/
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
