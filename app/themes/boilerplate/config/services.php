<?php

return [
    'google_analytics' => [
        'id' => 'G-xxxx',
    ],

    'facebook' => [
        'app_id' => '',
        'pages' => '',
        'admins' => '',
        'url' => 'https://www.facebook.com/pagename',
    ],

    'instagram' => [
        'url' => 'https://www.instagram.com/pagename',
    ],

    'twitter' => [
        'user' => 'username',
        'url' => 'https://www.twitter.com/username',
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
