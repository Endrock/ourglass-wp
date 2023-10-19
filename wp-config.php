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
define('DB_NAME', 'ourglas5_WPSGZ');

/** Database username */
define('DB_USER', 'ourglas5_WPSGZ');

/** Database password */
define('DB_PASSWORD', 'k?:0Dqr6Sr-7moGdF');

/** Database hostname */
define('DB_HOST', 'localhost');

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
define('AUTH_KEY', 'bbb9305f65926374384a5a6bb1cf09688acfe46bc18369a7379e015a6f55a53e');
define('SECURE_AUTH_KEY', 'f4d9302ac8d6f8f70bb630f0144efe26f364938d95f9b850014a570678f204c3');
define('LOGGED_IN_KEY', '3b0a62d73a0bbf16b3eb6bcc3936fd6927fbd5f2c2fb6fe3e71756973f82b94d');
define('NONCE_KEY', '702929cee1f9e69c6221c6a9c94777981c3168749afdd6ab446c7c22d450950f');
define('AUTH_SALT', '1496a9ecbeacaa78a7b59693ace47284a30cebfa20d970b7e7b642c606edb76d');
define('SECURE_AUTH_SALT', '2499c8a6a25dc9ee4a83ab419a2c0d008a10054e1a5b85b036ef1a860dce8488');
define('LOGGED_IN_SALT', 'a227a583e053fc73064ea59ff31e8d50b3d05b5eb40c41641cc5ed5a008e595a');
define('NONCE_SALT', 'b84e4920f8c83db66a5cfa563b5168674bd44107a485b7e54c79061f66eb8387');

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'rHp_';
define('WP_CRON_LOCK_TIMEOUT', 120);
define('AUTOSAVE_INTERVAL', 300);
define('WP_POST_REVISIONS', 20);
define('EMPTY_TRASH_DAYS', 7);
define('WP_AUTO_UPDATE_CORE', true);

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
