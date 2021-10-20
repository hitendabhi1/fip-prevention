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
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'hiten-ugv-u-287520' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', 'root' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

define('FS_METHOD','direct');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'J58P(HuTuSqTHNaSmJ3NpS2arf?V1|`qOoh+V f>(8cFQs(w%(5p,PW!Hgu,TSwT' );
define( 'SECURE_AUTH_KEY',  'q=H  WMAk3C<d;wNi{h0U/wf`D5Vbf*b`=_PL)1$%rjK2Vq&|p*B3vt){:=<;=pB' );
define( 'LOGGED_IN_KEY',    '{!I[u:_KxgWL3w&*6i^ImzDT <p/(xCzG| anI@g2V8iuWfySAK/WZG1>HCt&wVK' );
define( 'NONCE_KEY',        'NAVU0}c6(uRe$/h|qZj:3<#D([)ib6J=QB,>7FqP?B/LA;PiR0GN~-#E{Bw^Lh2n' );
define( 'AUTH_SALT',        'Zu9@z%`?Kf&`XUGBI`mlPEjFQpA4%>{~!Y}j7Hr<Yg_:Br:KM&3N=}PEu/~quQZ9' );
define( 'SECURE_AUTH_SALT', 'cA5Y6$Rhf8[WJP}K!E@t+DQN=Aw<<bPY;w,aU^2[{#]0tdgAWTD=}&ND;<XPmQm>' );
define( 'LOGGED_IN_SALT',   'iDr3/=yJ:>c}/9~Qtn(s7i/?O/>Ri|l/`R*g5*2IprYI*AZELZdP<i7=bY{e|z18' );
define( 'NONCE_SALT',       '?{ZH$6F@&<p+*_qyfCcs5~Dk_ZWu3-C,s)~kHHTB/hK0qbHf:HCcI0pascXkx)sB' );

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'fipmicro_';

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
define( 'WP_HOME', 'http://localhost:8888/fip-prevention/' );
define( 'WP_SITEURL', 'http://localhost:8888/fip-prevention/' );
/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
    define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
