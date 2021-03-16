<?php

return [
    'service' => 'google', // google / aws / null

    'update_wp_titles' => true,

    // set the language which the source code texts are written in
    // you can change freely, but best just once, when you start the project
    'written_language' => 'en',

    'credentials' => [
        'google' => [
            'key' => c('GOOGLE_TRANSLATE_KEY'),
        ],
        // 'aws' => [
        //     'key' => c('AWS_ACCESS_KEY_ID'),
        //     'secret' => c('AWS_SECRET_ACCESS_KEY'),
        //     'region' => 'us-east-1',
        // ],
    ],
];
