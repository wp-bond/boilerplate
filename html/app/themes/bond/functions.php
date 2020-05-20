<?php

// Forward to our root theme
// IMPORTANT: get_stylesheet below implies the theme has the same folder name

$root_app = defined('ROOT_APP_PATH')
    ? ROOT_APP_PATH
    : dirname($_SERVER['DOCUMENT_ROOT']) . '/app';

require_once $root_app . '/themes/' . get_stylesheet() . '/functions.php';
