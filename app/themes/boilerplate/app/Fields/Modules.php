<?php

namespace App\Fields;

use Bond\Fields\Acf\FieldGroup;

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
            ->title('Content')
            ->screenHideAll()
            ->menuOrder(10)
            ->location(self::$location);

        $flex = $group->flexibleContentField('modules')
            ->buttonLabel('+ Add Module');


        // Content
        $layout = $flex->layout('content')
            ->label('Content');

        $layout->textField('title')
            ->label('Title')
            ->multilanguage()
            ->wrapWidth(50);

        $layout->textField('subtitle')
            ->label('Subtitle')
            ->multilanguage()
            ->wrapWidth(50);

        $layout->wysiwygField('content')
            ->label('Text')
            ->multilanguage()
            ->mediaUpload(false)
            ->wrapWidth(50)
            ->toolbar(app()->id());



        // Image Gallery
        $layout = $flex->layout('gallery')
            ->label('Image Gallery');

        $layout->textField('title')
            ->label('Title')
            ->multilanguage()
            ->wrapWidth(50);

        $layout->textField('subtitle')
            ->label('Subtitle')
            ->multilanguage()
            ->wrapWidth(50);

        $layout->galleryField('gallery')
            ->label('Image Gallery');
    }
}
