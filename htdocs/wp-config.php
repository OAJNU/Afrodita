<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, and ABSPATH. You can find more information
 * by visiting {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'wp_oajnu');

/** MySQL database username */
define('DB_USER', 'oajnu');

/** MySQL database password */
define('DB_PASSWORD', 'Tek8sdHNs');

/** MySQL hostname */
define('DB_HOST', '192.168.0.195');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

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
define('AUTH_KEY',         '$3$5ivT-&[cr|<|yI)C_>_[=.9P+$Pd8JL[.dWei>_<1;D^WQT)LDD+1|2OmK,am');
define('SECURE_AUTH_KEY',  '?68R6yfm[0f6]fm}gDOLBm>i3ZTS8 OXiH8@_2}vFt<W{=UMb+yu]w1F& C2nfuy');
define('LOGGED_IN_KEY',    'qX/l(72*]p@EV^89p&r(>@QOe<bg0zj]B)+E+eDVt8o<~cMMuVz{n^cim=Y[;n*/');
define('NONCE_KEY',        '5#l1Z=`vjx)E@mJxhrNFc2zgEdg|3vsUf5X}EA.5j_kLoJBz1~q,;q}dIL7I7_hG');
define('AUTH_SALT',        'UyYx!WC (Z&mpGv{B#RBSBVv%4<u-;<bpO34dueRQM#<&RTAT|M3dpf$e5,Y$zm_');
define('SECURE_AUTH_SALT', 'F7[2aD1_*C|u-n1Vfwt^pU0@5&0*0X=3vyN#2Ud^~-6lJN1.$`iz5Z`;7U[)7`R|');
define('LOGGED_IN_SALT',   'ln7&vKh4.$N+ |LpphlcJlR; ,G_w+Q6FdfG5Imv-!fbnd,;)w6k:w<n$25T(2Hf');
define('NONCE_SALT',       '~?o0WL5/B1gAp8a6F:c05-uK]eRG{p{*).9|`LjPFjhgEOPG{ -HwMj|5E<<y|^.');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

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
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
