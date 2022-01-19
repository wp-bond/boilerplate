<?php

namespace App\Admin;

use Bond\Settings\Rewrite;

class RewriteRules
{
    // TODO maybe upgrade to a Service and have app.search_path move to the rewrite.php config file

    public static function boot()
    {
        // Rewrite::tag('page_control', true);

        // ! mind the order of these rules
        // as a general rule, start with the longest, more specific urls

        Rewrite::reset();

        Rewrite::search();

        Rewrite::postType(NEWS);

        Rewrite::pages();
    }
}
