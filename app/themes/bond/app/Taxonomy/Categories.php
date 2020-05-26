<?php

namespace App\Taxonomy;

use Bond\Taxonomy;

class Categories extends Taxonomy
{
    public static string $taxonomy = CATEGORY;

    public static function boot()
    {
        // category is already registered by WP
        // if needed we can safely register again to change any options
    }

    public static function bootAdmin()
    {
    }
}
