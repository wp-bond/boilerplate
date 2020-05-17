<?php

namespace App\PostType;

use Bond\PostType;


class Pages extends PostType
{
    public static string $post_type = PAGE;


    public static function boot()
    {
        // View hooks
        static::addToView();
    }


    public static function bootAdmin()
    {
        // columns
        \add_filter('manage_' . self::$post_type . '_posts_columns', function ($defaults) {
            // dd($defaults);
            return [
                'cb' => '<input type="checkbox" />',
                'title' => t('Title'),
                'multilanguage_links' => t('Links'),
            ];
        });
    }
}
