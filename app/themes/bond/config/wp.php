<?php

return [
    'force_https' => app()->isProduction() || app()->isStaging(),

    'front_page_redirect' => false,

    'disable_user_registration' => true,
];
