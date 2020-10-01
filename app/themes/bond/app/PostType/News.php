<?php

namespace App\PostType;

use Bond\FieldGroup;
use Bond\PostType;
use Bond\Settings\Admin;
use Bond\Utils\Register;

class News extends PostType
{
    public static string $post_type = NEWS;
    public static array $taxonomies = [
        CATEGORY,
    ];

    public static function boot()
    {

        // Register
        Register::postType(self::$post_type, [
            'labels' => [
                'name' => t('News'),
                'singular_name' => t('Article'),
                'add_new' => t('Add') . ' ' . t('article'),
                'add_new_item' => t('Add new') . ' ' . t('article'),
                'edit_item' => t('Edit') . ' ' . t('article'),
                'new_item' => t('New') . ' ' . t('article'),
                'view_item' => t('View') . ' ' . t('article'),
                'search_items' => t('Search') . ' ' . t('article'),
                'not_found' => t('No article') . ' ' . t('found'),
                'not_found_in_trash' => t('No article') . ' ' . t('found in trash'),
            ],
            'menu_icon' => 'dashicons-format-aside',
            'menu_position' => 28,
            'taxonomies' => static::$taxonomies,
        ]);


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
