<?php

namespace App\Fields;

use Bond\Fields\Acf\FieldGroup;

class Control
{

    public static function boot()
    {
        if (!app()->hasAcf()) {
            return;
        }

        // SEO
        \acf_add_options_page([
            'page_title' => 'SEO',
            'menu_title' => 'SEO',
            'menu_slug' => 'acf-options-seo',
            // 'capability'    => 'edit_posts',
            // 'parent_slug' => 'acf-options' ,
            'parent_slug'   => 'index.php',
            'position' => null,
            'icon_url' => false,
            'redirect' => false
        ]);

        $group = (new FieldGroup('seo'))
            ->location([
                'options' => 'seo',
            ])
            ->title('Search Engine Optimization');

        $group->messageField('seo_helper', '')
            ->message('In the fields below fill a maximum of 170 characters, relative to 2 lines of text on the Google search results page.');


        // Home page
        $group->textAreaField('description')
            ->label('Description for the Home page')
            ->multilanguage()
            ->wrapWidth(50)
            ->maxlength(170)
            ->rows(3);

        // archive pages SEO
        $archives = [
            NEWS => t('News'),
            'search' => t('Search'),
        ];

        foreach ($archives as $key => $label) {
            $group->textAreaField($key . '_description')
                ->label('Description for the ' . $label . ' page')
                ->multilanguage()
                ->maxlength(170)
                ->rows(3)
                ->wrapWidth(50);
        }

        $group->messageField('seo_message')
            ->message('Other SEO optimizations are done automatically by the website.');
    }
}
