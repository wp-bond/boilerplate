<?php

namespace App\Fields;

use Bond\Fields\Acf\FieldGroup;

class Control
{
    private static $key = 'control';

    public static function boot()
    {
        if (!app()->hasAcf()) {
            return;
        }

        // SEO
        \acf_add_options_page([
            'page_title' => 'SEO',
            'menu_title' => 'SEO',
            'menu_slug' => 'acf-options-seo-' . self::$key,
            // 'capability'    => 'edit_posts',
            // 'parent_slug' => 'acf-options-' . self::$key,
            'parent_slug'   => 'index.php',
            'position' => null,
            'icon_url' => false,
            'redirect' => false
        ]);

        $group = (new FieldGroup('seo-' . self::$key))
            ->location([
                'options' => 'seo-' . self::$key,
            ])
            ->title('Search Engine Optimization');

        $group->textAreaField('description')
            ->multilanguage()
            ->label('Google Search Description')
            ->wrapWidth(50)
            ->maxlength(170)
            ->rows(3)
            ->instructions('Maximum of 170 characters, relative to 2 lines of text on the Google search results page.');

        $group->messageField('seo_message')
            ->message('Other SEO optimizations are done automatically by the website.');
    }
}
