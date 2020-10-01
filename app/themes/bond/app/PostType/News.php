<?php

namespace App\PostType;

use Bond\FieldGroup;
use Bond\PostType;
use Bond\Settings\Admin;

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
        $group = (new FieldGroup('tax_' . self::$post_type))
            ->location(self::$post_type)
            ->title(t('Category'))
            ->positionSide()
            ->screenHideAll();

        $group->taxonomyField(CATEGORY)
            // ->label(t('Categories'))
            ->field_type('checkbox')
            ->allow_null(1)
            ->add_term(1)
            ->save_terms(1)
            ->load_terms(1)
            ->multiple(1)
            ->return_format('id')
            ->taxonomy(CATEGORY);
    }


    public static function bootAdmin()
    {
        Admin::hideTitle(self::$post_type);

        // Archive Columns
        Admin::setColumns(self::$post_type, [
            'image' => '',
            'title' => t('Title'),
            'taxonomy-category'  => t('Category'),
            'date' => t('Date'),
            'multilanguage_links' => t('Links'),
        ]);
    }


    public static function single()
    {
        parent::single();

        // Extra SEO
        meta()->og_type = 'article';
    }
}
