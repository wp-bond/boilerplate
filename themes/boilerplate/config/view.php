<?php

use Bond\Settings\Language;


// we don't need the template handler if not on front end
if (!app()->isFrontEnd()) {
    return;
}

// enable our view template handler
view()->enable();

// set the templates lookup dir
// can add more if needed
view()->addLookupFolder(app()->viewsPath());

// auto sets the lookup order based on the global WP_Query
view()->autoSetOrder();

// replace WP body_class based on the view order, language and device
view()->setBodyClasses();


// add custom data
// here just add any data you want into the View initially
view()->add([
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
]);
