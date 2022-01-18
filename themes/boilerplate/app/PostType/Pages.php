<?php

namespace App\PostType;

use Bond\PostType;

class Pages extends PostType
{
    public static string $post_type = PAGE;


    public static function boot()
    {
    }


    public static function bootAdmin()
    {
        self::setColumns([
            'title' => 'Title',
            'multilanguage_links' => 'Links',
        ]);
    }
}
