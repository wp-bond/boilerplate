<?php

// Tip for language code values:
// if using translation check if it's available, and which code to use:
// https://cloud.google.com/translate/docs/languages
// https://docs.aws.amazon.com/translate/latest/dg/what-is.html#language-pairs

// Tip for locale values:
// check if your system has available locale
// system('locale -a');exit;

return [

    'codes' => [
        // TODO, maybe move these keys into a language_code or code param, reads better
        // 'codes' would go into 'languages' ?
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
