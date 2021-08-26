<?php

return [
    'google_analytics' => [
        'id' => 'G-xxxx',
    ],

    'google_maps' => [
        'key' => 'key for google maps API',
    ],

    'ses' => [
        'key' => c('AWS_ACCESS_KEY_ID'),
        'secret' => c('AWS_SECRET_ACCESS_KEY'),
        'region' => 'us-east-1',
    ],
];
