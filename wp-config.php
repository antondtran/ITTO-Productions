<?php
define( 'WP_CACHE', true );
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
 * * Localized language
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'u487121858_8K1b7' );

/** Database username */
define( 'DB_USER', 'u487121858_4fweZ' );

/** Database password */
define( 'DB_PASSWORD', 'wBDGnVo88P' );

/** Database hostname */
define( 'DB_HOST', '127.0.0.1' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

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
define( 'AUTH_KEY',          'fFp7F8i%ABAmXu}4`]_OV+]/R(APiTE]AtwV2L_BA+@W4Aglkky)JGS<EU/+HhjI' );
define( 'SECURE_AUTH_KEY',   'u?R`oNhq[8uNqHPvv8`6>{{oeof>(Q3zCt8>NG5U5S<:ebgj~q d}j(CeM]eCqQ+' );
define( 'LOGGED_IN_KEY',     'st{Wgb<;j=kK@gE>i]oV/ 8~Wv9Vhh6_U5NMs:hMtLp9&ke~F@+ _Wjbkr)SOd[t' );
define( 'NONCE_KEY',         '.vFua9|(t2voc@_L%l@@hW/]$D~<<;]v5Ry:X(/IIKAaV`!}8: _Qw$n(?vFU;u!' );
define( 'AUTH_SALT',         'Y~GthOp?$b!PQX,OQC*WOQblpzC**O,5Cm5~E5>_3njjIq6.:C>4,KT4?vPN[gwK' );
define( 'SECURE_AUTH_SALT',  'y_;*9TCgmy~@O$`jA,+6~<ZCWvK?/1k2B}K:=48=p J+x -u[JvQOm]q22(Cm8fW' );
define( 'LOGGED_IN_SALT',    'Fq2_f((%:e]ifI@m|/vh^?XYg&G|Fy:f2<912CI`ew> A,WqHEXy0l{r{t5{q_GC' );
define( 'NONCE_SALT',        'x0QUhgPECYp&I~[eD3s|`O+i &;:ycO)fcGz05D[Ikxa}aO#XOFtiR~Gb3U-6o}9' );
define( 'WP_CACHE_KEY_SALT', 'YO=p&t [n-%~YR8(J#tvP(b9K)H5q_m]Z8)y.jIFHtd +f!%ws7Jp2O,J6PBK;R[' );


/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';


/* Add any custom values between this line and the "stop editing" line. */



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
if ( ! defined( 'WP_DEBUG' ) ) {
	define( 'WP_DEBUG', false );
}

define( 'FS_METHOD', 'direct' );
define( 'WP_AUTO_UPDATE_CORE', 'minor' );
/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
