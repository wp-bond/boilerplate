<?php
// IMPORTANT: the keys from the 'codes' param are the actual language codes,
// so if you are using AWS or Google Translate you must choose one they support:

// AWS Translate
// https://docs.aws.amazon.com/translate/latest/dg/what-is.html#language-pairs

// Google Translate
// https://cloud.google.com/translate/docs/languages

use Bond\Settings\Language;

Language::add(
    code: 'en',
    values: [
        'short_code' => 'en',
        'locale' => 'en_US',
        'name' => 'English',
        'short_name' => 'EN',
        'fields_suffix' => 'en',
        'fields_label' => '(EN)',
    ]
);
// Note the first language will be the default one, otherwise use setDefaultCode()

Language::add(
    code: 'pt-br',
    values: [
        'short_code' => 'pt',
        'locale' => 'pt_BR',
        'name' => 'Português',
        'short_name' => 'PT',
        'fields_suffix' => 'pt',
        'fields_label' => '(PT)',
    ]
);


// set current language
Language::setCurrentFromRequest();
