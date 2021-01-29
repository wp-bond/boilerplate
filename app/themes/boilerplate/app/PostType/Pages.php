<?php

namespace App\PostType;

use Bond\PostType;
use Bond\Settings\Admin;

class Pages extends PostType
{
    public static string $post_type = PAGE;


    public static function boot()
    {
    }


    public static function bootAdmin()
    {
        Admin::hideTitle(self::$post_type);

        Admin::setColumns(self::$post_type, [
            'title' => 'Title',
            'multilanguage_links' => 'Links',
        ]);
    }
}
