<?php

namespace App\Controllers;

use Bond\Settings\Language;
use Bond\Utils\Link;
use Bond\Utils\Cache;

class Menu
{
    public static function boot()
    {
        // View hook
        add_action('Bond/ready', [static::class, 'ready']);
    }

    public static function ready()
    {
        $menu = Cache::json(
            'global/menu-' . Language::shortCode(),
            -1,
            function () {

                // language switcher
                $languageSwitcher = [
                    'lang' => Language::shortCode(),
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
        foreach (Language::codes() as $code) {
            $menu['languageSwitcher']['languages'][] = [
                'lang' => Language::shortCode($code),
                'name' => Language::shortName($code),
                'url' => Link::current($code),
            ];
        }

        // add to View
        view()->add(compact('menu'));
    }
}
