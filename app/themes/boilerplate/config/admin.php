<?php

return [
    'add_login_css' => true,
    'add_admin_css' => true,
    'add_editor_css' => true,
    'disable_admin_color_picker' => true,
    'remove_update_nag' => true,

    'footer_credits' => '<small>'
        . t('developed by')
        . ' <a href="https://mysite.com" target="_blank">me</a>'
        . '</small>',
    'remove_wp_version' => true,

    'hide_posts' => true,
    'replace_dashboard' => true,
    'remove_administration_menus' => app()->isProduction() || !\current_user_can('manage_options'),
];
