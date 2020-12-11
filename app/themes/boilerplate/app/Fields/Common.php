<?php

namespace App\Fields;

use Bond\Fields\Acf\FieldGroup;

class Common
{
    private static $key = 'common';
    private static $location_summary = [
        NEWS,
    ];
    private static $location_archive_image = [
        NEWS,
    ];

    public static function boot()
    {
        // Summary
        $group = (new FieldGroup(self::$key))
            ->location(self::$location_summary)
            ->title('Summary')
            ->menuOrder(2)
            ->screenHideAll();

        $group->textField('heading')
            ->label('Heading')
            ->multilanguage()
            ->wrapWidth(50);

        $group->textAreaField('summary')
            ->multilanguage()
            ->label('Summary')
            ->wrapWidth(50)
            ->maxlength(250)
            ->rows(4);

        // Archive Image
        $group = (new FieldGroup(self::$key))
            ->location(self::$location_archive_image)
            ->title('Archive Image')
            ->positionSide()
            ->screenHideAll();

        $group->imageField('image')
            ->instructions('If not selected, the first avaiable image on this page will be used.')
            ->previewSize('thumbnail_square');
    }
}
