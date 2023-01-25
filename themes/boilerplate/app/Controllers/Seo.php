<?php

namespace App\Controllers;

use App\Fields\Options;
use Bond\Utils\Link;
use Bond\Settings\Language;
use Spatie\SchemaOrg\Organization;
use Spatie\SchemaOrg\SearchAction;
use Spatie\SchemaOrg\WebSite;

// Validate here
// https://search.google.com/structured-data/testing-tool

class Seo
{

    public static function boot()
    {
        add_action(
            'Bond/template_redirect/archive',
            [static::class, 'archive'],
            99
        );
        add_action(
            'Bond/template_redirect/singular',
            [static::class, 'singular'],
            99
        );
        add_action(
            'Bond/template_redirect/front-page',
            [static::class, 'frontPage'],
            99
        );

        // Clear cache on every post save
        add_action('Bond/save_post', function ($post) {
            cache()->delete('seo');
        });
        add_action('Bond/save_options', function () {
            cache()->delete('seo');
        });
    }


    public static function frontPage()
    {
        $schemas = [];
        $schemas[] = self::organization();
        $schemas[] = self::website();

        // dd($schemas[0]->toArray());

        view()->add(compact('schemas'));

        $options = Options::all();
        meta()->description = $options?->seo?->description;
    }


    public static function archive()
    {
        global $wp_query;

        // Description SEO
        if ($wp_query->is_search) {
            $key = 'search';
        } else {
            $type = (array) $wp_query->get('post_type');
            $key = $type[0] ?? null;
        }

        $options = Options::all();
        meta()->description = $options?->seo?->{$key . 'Description'};
    }


    public static function singular()
    {
        // Description
        meta()->description = view()->get('content')
            ?? self::findModulesFirstContent(view()->get('modules'));

        // Images
        meta()->addImages(view()->get('image'));
        meta()->addImages(view()->get('images'));
        meta()->addImages(self::findModulesImages(view()->get('modules')));
    }



    public static function organizationId()
    {
        return (new Organization())
            ->identifier(app()->url() . '#organization');
    }

    public static function organization()
    {
        return cache()->remember(
            'seo/schema-organization',
            function () {
                $options = Options::all();

                return (new Organization())
                    ->identifier(app()->url() . '#organization')
                    ->url(app()->url())
                    ->name(app()->name())
                    ->description($options?->seo?->description)
                    ->logo(app()->url() . '/apple-touch-icon.png');
                // ->sameAs([
                //     meta()->instagram->url
                // ])
                // ->location(self::locations());
            }
        );
    }


    public static function website()
    {
        return (new WebSite())
            ->identifier(app()->url() . '#website')
            ->url(app()->url() . Link::path())
            ->name(app()->name());
        // ->potentialAction(
        //     (new SearchAction())
        //         ->target(app()->url() . Link::search() . '?q={search_term_string}')
        //         ->setProperty('query-input', 'required name=search_term_string')
        // );
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
