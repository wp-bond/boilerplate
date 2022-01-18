<?php
// IMPORTANT: the keys from the 'codes' param are the actual language codes,
// so if you are using AWS or Google Translate you must choose one they support:

// AWS Translate
// https://docs.aws.amazon.com/translate/latest/dg/what-is.html#language-pairs

// Google Translate
// https://cloud.google.com/translate/docs/languages

return [

    // IMPORTANT: the first language will be the default one
    'codes' => [
        'en' => [
            'short_code' => 'en',
            'locale' => 'en_US',
            'name' => 'English',
            'short_name' => 'EN',
            'fields_suffix' => 'en',
            'fields_label' => '(EN)',
        ],
        'pt-br' => [
            'short_code' => 'pt',
            'locale' => 'pt_BR',
            'name' => 'Português',
            'short_name' => 'PT',
            'fields_suffix' => 'pt',
            'fields_label' => '(PT)',
        ],
        // 'fr' => [
        //     'short_code' => 'fr',
        //     'locale' => 'fr_CA',
        //     'name' => 'Français',
        //     'short_name' => 'FR',
        //     'fields_suffix' => 'fr',
        //     'fields_label' => '(FR)',
        // ],
    ]
];
