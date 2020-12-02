<?php

return [
    'force_https' => app()->isProduction() || app()->isStaging(),

    'disable_front_page_redirect' => true,

    'disable_user_registration' => true,

    // 'disable_sitemaps' => true,
];
