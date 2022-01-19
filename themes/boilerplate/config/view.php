<?php

use Bond\Settings\Language;

return [
    'enabled' => app()->isFrontEnd(),

    'use_theme' => true,
    // Tells this view to work as the theme's main view.
    // This is a shortcut to do exactly the same as (if they are not set below):
    // - add app()->viewsPath() as a lookup folder
    // - enable auto_set_order
    // - enable do_actions

    // here just add any data you want into the View initially
    'data' => [
        // we added this 'state' as we need to make available to JS later
        // check views/templates/html.php
        'state' => [
            'app' => [
                'isProduction' => app()->isProduction(),
                'isMobile' => app()->isMobile(),
                'isTablet' => app()->isTablet(),
                'isDesktop' => app()->isDesktop(),
            ],
            'language' => [
                'code' => Language::code(),
                'shortCode' => Language::shortCode(),
            ],
        ],
    ],

    // add view folders
    // 'lookup_folders' => [
    //     app()->viewsPath(),
    // ],

    // change the template folders if needed for emergencies
    // 'templates_dir' => 'templates',
    // 'partials_dir' => 'partials',

    // auto set the lookup order based on the global WP_Query
    // 'auto_set_order' => true,

    // enables 'Bond' action hooks
    // 'do_actions' => true,
];
