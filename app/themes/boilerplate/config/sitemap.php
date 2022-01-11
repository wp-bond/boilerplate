<?php

return [

    // enable our sitemap handle
    // set to false to disable WP sitemaps entirely
    'enabled' => true,

    // disable stylesheed if wanted
    'stylesheet' => false,

    // only add these post types
    // set to false to disable all post types
    'post_types' => [
        PAGE,
        NEWS,
    ],

    // only add these taxonomies
    // set to false to disable all taxonomies
    'taxonomies' => false,

    // set to false to disable all users
    'users' => false,

    // TODO extra links

    // list of post types to exclude from archive links
    'skip_archives' => [],

    // list of post types to exclude from singles links
    'skip_singles' => [],

    // list of post names to exclude from pages links
    'skip_pages' => [
        'home',
    ],
];
