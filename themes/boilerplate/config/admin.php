<?php

use Bond\Settings\Admin;


// css
Admin::addLoginCss();
Admin::addAdminCss();
Admin::addEditorCss();

// color scheme
Admin::addColorScheme();
Admin::disableAdminColorPicker();

// footer
Admin::setFooterCredits('');
Admin::removeWpVersion();

// hide default Posts post type
Admin::hidePosts();

// replace the dashboard html with our template
Admin::replaceDashboard();

// hide admin menus from the non-admin users
if (app()->isProduction() || !\current_user_can('manage_options')) {
    Admin::removeAdministrationMenus();
}

// remove the update nag
Admin::removeUpdateNag();
