<?php

namespace App\PostType;

use Bond\PostType;
use Bond\Settings\Admin;
use Bond\Settings\Languages;

class Pages extends PostType
{
    public static string $post_type = PAGE;


    public static function boot()
    {
    }


    public static function bootAdmin()
    {
        Admin::hideTitle(self::$post_type);
        Languages::ensureTitlesAndSlugs(self::$post_type);

        Admin::setColumns(self::$post_type, [
            'title' => t('Title'),
            'multilanguage_links' => t('Links'),
        ]);
    }
}
