<?php

namespace App\PostType;

use Bond\PostType;

class News extends PostType
{
    public static string $post_type = NEWS;
    public static array $taxonomies = [
        CATEGORY,
    ];
    public static string $name = 'News';
    public static string $singular_name = 'Article';

    public static array $register_options = [
        'menu_icon' => 'dashicons-format-aside',
        'menu_position' => 28,
    ];


    public static function boot()
    {
        // Taxonomy field
        $group = self::fieldGroup('Category')
            ->positionSide()
            ->screenHideAll();

        $group->taxonomyField(CATEGORY, '')
            ->taxonomy(CATEGORY)
            ->typeCheckbox()
            ->allowNewTerms();
    }


    public static function bootAdmin()
    {
        self::setColumns([
            'image' => '',
            'title' => 'Title',
            'taxonomy-category'  => 'Category',
            'date' => 'Date',
            'multilanguage_links' => 'Links',
        ]);
    }


    public static function single()
    {
        parent::single();

        // Extra SEO
        meta()->og_type = 'article';
    }
}
