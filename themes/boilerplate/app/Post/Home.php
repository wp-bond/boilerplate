<?php

namespace App\Post;

use Bond\Fields\Acf\FieldGroup;

class Home extends Page
{
    public string $post_name = 'home';


    public static function boot()
    {
        // Fields
        $location = [
            [
                [
                    'param' => 'page_type',
                    'operator' => '==',
                    'value' => 'front_page',
                ],
            ],
        ];

        $group = (new FieldGroup('home'))
            ->title('Content')
            ->screenHideAll()
            ->order(10)
            ->location($location);

        $flex = $group->flexibleContentField('modules')
            ->buttonLabel('+ Add Module');


        // Feature
        $layout = $flex->layout('features')
            ->label('Feature');

        $layout->relationshipField('related_posts', '')
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
