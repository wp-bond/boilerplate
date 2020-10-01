<?php

// Environment
const APP_ENV = 'development'; // production / staging / development
const APP_URL = 'http://boilerplate.test';

// Paths
const ROOT_APP_PATH = __DIR__ . '/app';
const WP_CONTENT_FOLDER = 'app';

// WordPress Settings
const WP_SITEURL = 'http://boilerplate.test/wp'; // WP Admin URL
// const WP_DEFAULT_THEME = 'bond'; // Advanced Custom Fields plugin must be activated first
const WP_DEBUG = true;
const WP_POST_REVISIONS = 5;
const WP_MEMORY_LIMIT = '512M';
const WP_MAX_MEMORY_LIMIT = '1280M';

// Services
const AWS_ACCESS_KEY_ID = '';
const AWS_SECRET_ACCESS_KEY = '';
// if (!getenv('GOOGLE_APPLICATION_CREDENTIALS')) {
//     putenv('GOOGLE_APPLICATION_CREDENTIALS=' . __DIR__ . '/gcloud.json');
// }

// Database
const DB_NAME = 'bond';
const DB_USER = 'root';
const DB_PASSWORD = '';
const DB_HOST = '127.0.0.1';
const DB_CHARSET = 'utf8mb4';
const DB_COLLATE = '';
$table_prefix = 'wp_';

// Salt - generate new keys here https://api.wordpress.org/secret-key/1.1/salt/
define('AUTH_KEY',         'copy & past new keys from the link above');
define('SECURE_AUTH_KEY',  'copy & past new keys from the link above');
define('LOGGED_IN_KEY',    'copy & past new keys from the link above');
define('NONCE_KEY',        'copy & past new keys from the link above');
define('AUTH_SALT',        'copy & past new keys from the link above');
define('SECURE_AUTH_SALT', 'copy & past new keys from the link above');
define('LOGGED_IN_SALT',   'copy & past new keys from the link above');
define('NONCE_SALT',       'copy & past new keys from the link above');


// Optional PHP settings

// LibVips warnings
// if (!getenv('VIPS_WARNING')) {
//     putenv('VIPS_WARNING=0');
// }

// Error reporting - development
error_reporting(E_ALL | E_STRICT);
ini_set('display_errors', 'on');

// Error reporting - production
// error_reporting(E_ERROR);
// ini_set('display_errors', 'off');

// default charset, if needed
// ini_set('default_charset', 'UTF-8');
