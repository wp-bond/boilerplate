<?php

return [
    'service' => 'google', // google / aws / null

    'update_wp_titles' => true,

    'credentials' => [
        // for Google Translate use ENV
        // putenv('GOOGLE_APPLICATION_CREDENTIALS=your_json_path')
        // https://googleapis.github.io/google-cloud-php/#/docs/google-cloud/v0.131.0/guides/authentication

        // 'aws' => [
        //     'key' => c('AWS_ACCESS_KEY_ID'),
        //     'secret' => c('AWS_SECRET_ACCESS_KEY'),
        //     'region' => 'us-east-1',
        // ],
    ],
];
