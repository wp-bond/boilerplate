<?php

namespace App\Post;

use Bond\Fields\Acf\FieldGroup;
use Bond\Utils\Query;

class Home extends Page
{
    public string $post_name = 'home';


    public static function boot()
    {
        // Fields
        $location = [
            [
                [
                    'param' => 'page',
                    'operator' => '==',
                    'value' => Query::id('home', 'page'),
                ],
            ],
        ];

        $group = (new FieldGroup('home'))
            ->title('Content')
            ->screenHideAll()
            ->menuOrder(10)
            ->location($location);

        $flex = $group->flexibleContentField('modules')
            ->buttonLabel('+ Add Module');


        // Feature
        $layout = $flex->layout('features')
            ->label('Feature');

        $layout->relationshipField('related_posts')
            ->instructions('Select from the website\'s content.')
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
