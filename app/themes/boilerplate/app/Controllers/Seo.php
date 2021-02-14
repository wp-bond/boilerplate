<?php

namespace App\Controllers;

use App\PostType\Galleries;

use Bond\Utils\Cache;
use Bond\Utils\Link;

use Spatie\SchemaOrg\Organization;
use Spatie\SchemaOrg\SearchAction;
use Spatie\SchemaOrg\WebSite;

// Validate here
// https://search.google.com/structured-data/testing-tool

class Seo
{

    public static function boot()
    {
        // TODO
        // add_action(
        //     'Bond/template_redirect/archive',
        //     [static::class, 'archive'],
        //     99
        // );
        add_action(
            'Bond/template_redirect/single',
            [static::class, 'single'],
            99
        );
        add_action(
            'Bond/template_redirect/front-page',
            [static::class, 'frontPage'],
            99
        );

        // Clear cache on every post save
        add_action('Bond/save_post', function ($post) {
            Cache::forget('seo');
        });
    }


    // public static function archive()
    // {
    //     global $wp_query;
    //     // dd($wp_query);

    //     // Description SEO
    //     if ($wp_query->is_search) {
    //         $key = 'search';
    //     } else {
    //         $type = (array) $wp_query->get('post_type');
    //         $key = $type[0] ?? null;
    //     }

    //     meta()->description = get_field($key . '_description' . Language::fieldsSuffix(), 'options');

    //     // Images too if possible
    // }


    public static function single()
    {
        // Description
        meta()->description = view()->get('content') ?? self::findModulesFirstContent(view()->get('modules'));

        // Images
        meta()->addImages(view()->get('image'));
        meta()->addImages(view()->get('images'));
        meta()->addImages(self::findModulesImages(view()->get('modules')));
    }


    public static function frontPage()
    {
        $schemas = [];
        $schemas[] = self::organization();
        $schemas[] = self::website();

        // dd($schemas[0]->toArray());

        view()->add(compact('schemas'));
    }


    public static function organizationId()
    {
        return (new Organization())
            ->identifier(app()->url() . '#organization');
    }

    public static function organization()
    {
        return Cache::php(
            'seo/schema-organization',
            -1,
            function () {
                return (new Organization())
                    ->identifier(app()->url() . '#organization')
                    ->url(app()->url())
                    ->name(app()->name())
                    ->description(get_field('description_en', 'options'))
                    ->logo(app()->url() . '/apple-touch-icon.png')
                    ->sameAs([
                        config('services.facebook.url'),
                        config('services.instagram.url')
                    ])
                    ->location(self::locations());
            }
        );
    }

    public static function locations(): array
    {
        $locations = [];
        // foreach ($galleries as $gallery) {
        //     $locations[] = $gallery->schemaPlace();
        // }
        return $locations;
    }


    public static function website()
    {
        return (new WebSite())
            ->identifier(app()->url() . '#website')
            ->url(app()->url() . Link::path())
            ->name(app()->name())
            ->potentialAction(
                (new SearchAction())
                    ->target(app()->url() . Link::search() . '?q={search_term_string}')
                    ->setProperty('query-input', 'required name=search_term_string')
            );
    }



    private static function findModulesFirstContent($modules): string
    {
        if (empty($modules)) {
            return '';
        }

        foreach ($modules as $module) {
            if (!empty($module['content'])) {
                return (string) $module['content'];
            }
        }
        return '';
    }

    private static function findModulesImages($modules): array
    {
        if (empty($modules)) {
            return [];
        }
        $images = [];

        foreach ($modules as $module) {
            if (!empty($module['image'])) {
                $images[] = $module['image'];
            }
            if (!empty($module['images'])) {
                $images = array_merge($images, (array) $module['images']);
            }
        }

        return $images;
    }
}
