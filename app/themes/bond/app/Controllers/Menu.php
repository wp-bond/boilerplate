<?php

namespace App\Controllers;

use Bond\Settings\Languages;
use Bond\Utils\Link;
use Bond\Utils\Cache;

class Menu
{
    public static function boot()
    {
        // View hook
        add_action('Bond/ready', [static::class, 'ready']);

        // Clear cache on every post save
        add_action('Bond/save_post', function ($post) {
            Cache::forget('menu');
        });
    }

    public static function ready()
    {
        $menu = Cache::json(
            'menu/' . Languages::shortCode(),
            -1,
            function () {

                // language switcher
                $languageSwitcher = [
                    'lang' => Languages::shortCode(),
                    'languages' => [],
                ];

                // menu items
                $items = [];

                $items[] = [
                    'title' => t('News'),
                    'link' => Link::path(NEWS),
                ];

                // links
                $homeUrl = Link::path();
                $searchUrl = Link::search();
                $searchPlaceholder = t('Search');

                return compact(
                    'items',
                    'homeUrl',
                    'searchUrl',
                    'searchPlaceholder',
                    'languageSwitcher'
                );
            }
        );

        // update langauge menu
        foreach (Languages::codes() as $code) {
            $menu['languageSwitcher']['languages'][] = [
                'lang' => Languages::shortCode($code),
                'name' => Languages::shortName($code),
                'url' => Link::current($code),
            ];
        }

        // add to View
        view()->add(compact('menu'));
    }
}
