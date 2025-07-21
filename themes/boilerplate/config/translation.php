<?php

// sets which translation service to use, supported are: google/aws/wp
// default is 'wp' which will use WP l10n functions __() and _x()
app()->translation()->service('aws');

// for AWS: composer require aws/aws-sdk-php
// for Google: composer require google/cloud-translate


// set the language which the source code texts are written in
// you can change freely, but choose wisely when you start the project
// default is 'en'
app()->translation()->writtenLanguage('en');
// IMPORTANT: you must fill a language code your service has support for:
// AWS Translate
// https://docs.aws.amazon.com/translate/latest/dg/what-is-languages.html
// Google Translate
// https://cloud.google.com/translate/docs/languages


// API credentials
app()->translation()->credentials([
    // 'google' => [
    //     'key' => c('GOOGLE_TRANSLATE_KEY'),
    // ],
    'aws' => [
        'key' => c('AWS_TRANSLATE_KEY'),
        'secret' => c('AWS_TRANSLATE_SECRET'),
        'region' => 'us-east-1',
    ],
]);


// Notes:
// - text is translated in runtime and stored in JSON at languages directory;
// - Google and AWS Translate understand the phrases meaning and will often
// translate correctly, but may translate incorrectly single words and short phrases;
// - after translation, review the JSON files to fix mistakes;


// enable the auto translation service
// here we need to call last, as it will try to load gettext file if using the 'wp' service
app()->translation()->enable();
