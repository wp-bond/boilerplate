<?php

// TIP: define your credentials as constants at the wp.php file
// this way you can commit this file to your version control

// remember to make the wp.php file readonly, either:
// chmod 440 wp.php (allowing read for user and group)
// chmod 400 wp.php (allowing read for user only)



app()->id('boilerplate');
app()->name(t('My App'));

// TODO change to public vars??
// app()->id = 'boilerplate';

// https://www.php.net/manual/en/timezones.php
app()->timezone('America/Sao_Paulo');




// TODO will try to move to Bond core where appropriate
// ACF - add google maps key to GoogleMapField
if (app()->hasAcf() && $key = c('GOOGLE_MAPS_PUBLIC_KEY')) {
    \add_filter('acf/fields/google_map/api', function ($api) use ($key) {
        $api['key'] = $key;
        return $api;
    });
}
