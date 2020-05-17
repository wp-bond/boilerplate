<?php

namespace App\Fields;

use Bond\FieldGroup;
use Bond\Settings\Languages;
use Bond\Utils\Cast;
use Bond\Utils\Str;

class MultilanguagePosts
{
    private static $key = 'i18n';

    private static $location = [
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
    private static $locationFull = [
        NEWS,
    ];

    public static function boot()
    {
        // Fields
        $group = (new FieldGroup(self::$key))
            ->title(t('Title / Link'))
            ->screenHideAll()
            ->menuOrder(9)
            ->positionAfterTitle()
            ->multilanguageTabs()
            ->location(self::$location);

        $group->textField('title')
            ->multilanguage()
            ->wrapWidth(50)
            ->label(t('Title'));

        $group->textField('slug')
            ->multilanguage()
            ->label(t('Page Slug'))
            ->wrapWidth(25);

        $group->booleanField('is_disabled')
            ->multilanguage()
            ->label(t('Disable'))
            ->wrapWidth(15);

        $group->messageField('i18n_link_message_icon')
            ->multilanguage()
            ->label(t('Link'))
            ->wrapWidth(10);

        $group->urlField('external_link')
            ->multilanguage()
            ->label(t('Redirect Link'))
            ->instructions(t('Optional. If not filled this page will be automatically redirected to the most fitting page.'))
            ->i18n_conditional(true)
            ->conditionalLogic([
                [
                    [
                        'field' => 'is_disabled',
                        'operator' => '==',
                        'value' => '1',
                    ],
                ],
            ]);



        // Fields
        $group = (new FieldGroup('full_' . self::$key))
            ->title(t('Title / Link'))
            ->screenHideAll()
            ->menuOrder(9)
            ->positionAfterTitle()
            ->multilanguageTabs()
            ->location(self::$locationFull);

        $group->textField('title')
            ->multilanguage()
            // ->wrapWidth(50)
            ->label(t('Title'));

        $group->textField('subtitle')
            ->multilanguage()
            ->wrapWidth(50)
            ->label(t('Subtitle'));

        $group->textField('slug')
            ->multilanguage()
            ->label(t('Page Slug'))
            ->wrapWidth(25);

        $group->booleanField('is_disabled')
            ->multilanguage()
            ->label(t('Disable'))
            ->wrapWidth(15);

        $group->messageField('i18n_link_message_icon')
            ->multilanguage()
            ->label(t('Link'))
            ->wrapWidth(10);

        $group->urlField('external_link')
            ->multilanguage()
            ->label(t('Redirect Link'))
            ->instructions(t('Optional. If not filled this page will be automatically redirected to the most fitting page.'))
            ->i18n_conditional(true)
            ->conditionalLogic([
                [
                    [
                        'field' => 'is_disabled',
                        'operator' => '==',
                        'value' => '1',
                    ],
                ],
            ]);


        // link message
        foreach (Languages::codes() as $code) {
            $suffix = Languages::fieldsSuffix($code);

            \add_filter(
                'acf/render_field/name=i18n_link_message_icon' . $suffix,
                function ($field) use ($code) {
                    global $post;

                    $post = Cast::post($post);
                    if (!$post) {
                        return;
                    }

                    $link = $post->link($code);
                    if (!$link) {
                        return;
                    }

                    echo '<a href="' . $link . '" target="_blank" class="link-icon"></a>';
                }
            );
        }


        // TODO move to Bond
        // Multilanguage
        \add_filter('the_title', function ($title, $id) {
            $post = Cast::post($id);
            if ($post) {
                return $post->title ?: $post->post_title;
            }
            return $title;
        }, 10, 2);


        \add_filter('acf/fields/taxonomy/result', function ($title, $term, $field, $post_id) {

            $term = Cast::term($term);
            $title = $term->get('name', Languages::code());

            return Str::limit($title, 28);
        }, 10, 4);


        \add_filter('acf/fields/post_object/result', function ($title, $post, $field, $post_id) {
            return Str::limit($title, 28);
        }, 10, 4);
    }
}