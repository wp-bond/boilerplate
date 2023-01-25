<?php

// TODO will remove the Wp class and move these settings to App

use Bond\Settings\Language;
use Bond\Settings\Wp;

// Settings
Wp::updateSettings();


// protect Wp if not using
Wp::disableUserRegistration();

// Protects WP redirect on front pages
if (Language::isMultilanguage()) {
    Wp::disableFrontPageRedirect();
}

// force https on production/staging
if (app()->isProduction() || app()->isStaging()) {
    Wp::forceHttps();
}
