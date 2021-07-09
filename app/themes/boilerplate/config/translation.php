<?php

return [
    'service' => 'aws', // google / aws / null

    // set the language which the source code texts are written in
    // you can change freely, but best just once, when you start the project
    'written_language' => 'en',

    'credentials' => [
        'google' => [
            'key' => c('GOOGLE_TRANSLATE_KEY'),
        ],
        'aws' => [
            'key' => c('AWS_TRANSLATE_KEY'),
            'secret' => c('AWS_TRANSLATE_SECRET'),
            'region' => 'us-east-1',
        ],
    ],
];
