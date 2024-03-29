<?php

namespace App\Admin;

use Bond\Settings\Rewrite;

class RewriteRules
{
    public static function boot()
    {
        // Rewrite::tag('page_control', true);

        // ! mind the order of these rules
        // as a general rule, start with the longest, more specific urls

        Rewrite::reset();

        Rewrite::$search_path = 'search';
        Rewrite::search();

        Rewrite::postType(NEWS);

        Rewrite::pages();
    }
}
