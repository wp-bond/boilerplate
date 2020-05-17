<?php

return [
    'theming' => true,

    'hide_posts' => true,

    // boolean (all posts) or array of post types
    'hide_title' => [
        NEWS,
        PAGE,
    ],

    'footer_text' => '<small>'
        . t('developed by')
        . ' <a href="https://mysite.com" target="_blank">me</a>'
        . '</small>',
];
