<?php

// Forward to our root theme
$root_app = defined('ROOT_APP_PATH')
    ? ROOT_APP_PATH
    : dirname($_SERVER['DOCUMENT_ROOT']) . '/app';

require_once $root_app . '/themes/' . get_stylesheet() . '/functions.php';

// Note: get_stylesheet below implies the theme has the same folder name
// but you can change if you want
