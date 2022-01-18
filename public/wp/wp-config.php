<?php

// Load settings
require_once dirname(dirname(__DIR__)) . '/wp.php';


// Auto set required WordPress paths, if needed
if (!defined('WP_CONTENT_FOLDER')) {
	define('WP_CONTENT_FOLDER', 'wp-content');
}
if (!defined('WP_HOME')) {
	define('WP_HOME', APP_URL);
}
if (!defined('WP_SITEURL')) {
	define('WP_SITEURL', APP_URL);
}
if (!defined('WP_CONTENT_DIR')) {
	define('WP_CONTENT_DIR', dirname(__DIR__) . '/' . WP_CONTENT_FOLDER);
}
if (!defined('WP_CONTENT_URL')) {
	define('WP_CONTENT_URL', WP_HOME . '/' . WP_CONTENT_FOLDER);
}
if (!defined('ABSPATH')) {
	define('ABSPATH', __DIR__);
}

// Load WordPress
require_once ABSPATH . 'wp-settings.php';
