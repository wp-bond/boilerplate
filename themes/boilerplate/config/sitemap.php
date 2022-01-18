<?php

return [

    // enable our sitemap handle
    // set to false to disable WP sitemaps entirely
    'enabled' => true,

    // disable stylesheed if wanted
    'stylesheet' => false,

    // specify post types to add to sitemap
    // set to empty array to disable all post types
    // leave unset to allow all public post types
    'post_types' => [
        PAGE,
        NEWS,
    ],

    // specify taxonomies to add to sitemap
    // set to empty array to disable all taxonomies
    // leave unset to allow all public taxonomies
    'taxonomies' => [],

    // TODO specify users to add to sitemap (wait for Bond upgrade)
    // set to empty array to disable all users
    // leave unset to allow all public users
    'users' => [],

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
