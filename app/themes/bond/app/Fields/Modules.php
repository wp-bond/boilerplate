<?php

namespace App\Fields;

use Bond\FieldGroup;

class Modules
{
    private static $key = 'flex';
    private static $location = [
        NEWS,
        [
            [
                'param' => 'post_type',
                'operator' => '==',
                'value' => PAGE,
            ],
            [
                'param' => 'page_type',
                'operator' => '!=',
                'value' => 'front_page',
            ],
        ],
    ];

    public static function boot()
    {
        // Fields
        $group = (new FieldGroup(self::$key))
            ->title(t('Content'))
            ->screenHideAll()
            ->menuOrder(10)
            ->location(self::$location);

        $flex = $group->flexibleContentField('modules')
            ->buttonLabel(t('+ Add Module'));


        // Content
        $layout = $flex->layout('content')
            ->label(t('Content'));

        $layout->textField('title')
            ->label(t('Title'))
            ->multilanguage()
            ->wrapWidth(50);

        $layout->textField('subtitle')
            ->label(t('Subtitle'))
            ->multilanguage()
            ->wrapWidth(50);

        $layout->wysiwygField('content')
            ->label(t('Text'))
            ->multilanguage()
            ->mediaUpload(false)
            ->wrapWidth(50)
            ->toolbar(config()->id());



        // Image Gallery
        $layout = $flex->layout('gallery')
            ->label(t('Image Gallery'));

        $layout->textField('title')
            ->label(t('Title'))
            ->multilanguage()
            ->wrapWidth(50);

        $layout->textField('subtitle')
            ->label(t('Subtitle'))
            ->multilanguage()
            ->wrapWidth(50);

        $layout->galleryField('gallery')
            ->label(t('Image Gallery'));
    }
}
