<?php

namespace App\Fields;

use Bond\Fields\Acf\FieldGroup;

class FrontPage
{
    private static $key = 'home';
    private static $location = [
        [
            [
                'param' => 'post_type',
                'operator' => '==',
                'value' => PAGE,
            ],
            [
                'param' => 'page_type',
                'operator' => '==',
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


        // Feature
        $layout = $flex->layout('features')
            ->label(t('Feature'));

        $layout->relationshipField('related_posts')
            ->instructions(t('Select from the website\'s content.'))
            ->postType([
                NEWS,
            ])
            ->filters([
                'search',
                // 'post_type',
                // 'taxonomy',
            ])
            ->min(1)
            ->returnFormat('id');
    }
}
