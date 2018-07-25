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
define('DB_NAME', 'oss-wp');

/** MySQL database username */
define('DB_USER', 'oss');

/** MySQL database password */
define('DB_PASSWORD', '055pass');

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
define('AUTH_KEY',         ']wIlT1o$Y3,l/{de_?)j-;nj[F&sm{fDCJq>-TFl{[+i=E)Ep>0K[AxrqyKDkz5^');
define('SECURE_AUTH_KEY',  '3b*BILf*%,OPbST&8JrJnfY3M?B]p_r>Z8+E#n`1`tLLDDJIS)}&Mv`RU*gfVJuU');
define('LOGGED_IN_KEY',    'W^3}B},e7qmL+-|&iYdMbhV(f5Y=WT_k{kN1U+c75SvtxiP-x,~0m4O] >b)Neb5');
define('NONCE_KEY',        'D[F.n+$JTIw8UC_hw*}WGfZ8mRiRHB=iI{>O~CC}_r);6^B!$f% EO(1d1m;LVIf');
define('AUTH_SALT',        '4$?dMAN[=i/8)Pk8]N<KPQojtfVV86(5<#S{]N?qy@VPOQ;}$XNNuc%5c*EnW~g9');
define('SECURE_AUTH_SALT', 'hjB~IiX{@GH {2l|LZ.f%Cop1bh>u$c#r{h~et/Cq&2C+T/6Jk1?=$SfaQvDYh)A');
define('LOGGED_IN_SALT',   '//v{gyrb]vX?/{=gL/3]x2ry0Da?`N$q40w)7V7F1!z[a5_;8CD^?e=...Gvt=R3');
define('NONCE_SALT',       'Aas6B88ewR:Hiiw3hxAnzeIp>H8/9_~D}0Da$;V~iKk?EUQZLMol(/H[|y]_W>_k');

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
define('WP_DEBUG', true);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
