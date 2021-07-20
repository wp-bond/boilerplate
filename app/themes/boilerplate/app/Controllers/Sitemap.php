<?php

namespace App\Controllers;

use Bond\Settings\Language;
use Bond\Utils\Cast;
use Bond\Utils\Date;
use Bond\Utils\Link;
use Bond\Utils\Query;
use samdark\sitemap\Index;
use samdark\sitemap\Sitemap as SitemapXml;
use WP_Query;

class Sitemap
{
    public static string $root_path;

    public static array $post_types = [
        NEWS,
    ];
    public static array $skip_archives = [];
    public static array $skip_singles = [];
    public static array $skip_pages = [
        'home',
    ];


    public static function boot()
    {
        self::$root_path = dirname(ABSPATH);

        if (isset($_GET['refresh-sitemap'])) {
            self::refreshWhenReady();
        }

        if (app()->isProduction()) {

            // action hook
            add_action('sitemap_hook', [self::class, 'refreshWhenReady']);

            // add cron hook
            add_action('after_switch_theme', function () {
                if (!wp_next_scheduled('sitemap_hook')) {
                    wp_schedule_event(time(), 'daily', 'sitemap_hook');
                }
            });

            // clear cron hook
            add_action('switch_theme', function () {
                wp_clear_scheduled_hook('sitemap_hook');
            });
        }
    }


    public static function refreshWhenReady()
    {
        add_action('wp', [self::class, 'refreshSitemap']);
    }


    public static function refreshSitemap()
    {
        if (!file_exists(self::$root_path . '/sitemaps')) {
            mkdir(self::$root_path . '/sitemaps', 0755, true);
        }

        // get all sitemaps urls
        $urls = [];

        // create pages Sitemap
        $urls = array_merge(
            self::pagesSitemap(),
            self::postsSitemap()
        );

        // create the Index
        $index = new Index(self::$root_path . '/sitemap.xml');
        foreach ($urls as $url) {
            if (empty($url)) {
                continue;
            }
            $index->addSitemap($url);
        }
        $index->write();
    }


    public static function postsSitemap()
    {
        return cache()->remember(
            'sitemaps/posts',
            function () {

                $sitemaps_urls = [];

                foreach (self::$post_types as $post_type) {

                    // has no archive
                    if (in_array($post_type, self::$skip_singles)) {
                        continue;
                    }

                    $posts = self::allPostsOf($post_type);
                    if (empty($posts)) {
                        continue;
                    }

                    // create sitemap
                    $sitemap = new SitemapXml(
                        self::$root_path . '/sitemaps/sitemap-' . $post_type . '.xml',
                        true
                    );
                    $sitemap->setMaxUrls(floor(50000 / count(Language::codes())));


                    // add all links
                    foreach ($posts as $post) {

                        $urls = [];
                        foreach (Language::codes() as $code) {
                            $urls[$code] = app()->url()
                                . $post->link($code);
                        }
                        if (empty($urls)) {
                            continue;
                        }
                        $sitemap->addItem(
                            $urls,
                            Date::time($post->post_modified),
                            'daily'
                        );
                    }

                    // store
                    $sitemap->write();

                    // retrieve links
                    foreach ($sitemap->getSitemapUrls(app()->url() . '/sitemaps/') as $url) {
                        $sitemaps_urls[] = $url;
                    }
                }

                return $sitemaps_urls;
            },
            app()->isDevelopment() ? 0 : 60 * 60 * 2
        );
    }



    public static function pagesSitemap()
    {
        return cache()->remember(
            'sitemaps/pages',
            function () {
                $sitemap = new SitemapXml(
                    self::$root_path . '/sitemaps/sitemap-pages.xml',
                    true
                );


                // add all archive pages
                foreach (self::$post_types as $post_type) {

                    // has no archive
                    if (in_array($post_type, self::$skip_archives)) {
                        continue;
                    }

                    // ensure i18n archives exists
                    $urls = [];
                    foreach (Language::codes() as $code) {

                        $url = Link::postType($post_type, $code);
                        if ($url) {
                            $urls[$code] = app()->url() . $url;
                        }
                    }
                    if (empty($urls)) {
                        continue;
                    }
                    $sitemap->addItem(
                        $urls,
                        Query::lastModifiedTime($post_type),
                        'daily'
                    );
                }

                // add pages
                $posts = self::allPostsOf(PAGE);

                foreach ($posts as $post) {

                    // skip some
                    if (in_array($post->post_name, self::$skip_pages)) {
                        continue;
                    }

                    $urls = [];
                    foreach (Language::codes() as $code) {
                        $urls[$code] = app()->url()
                            . $post->link($code);
                    }
                    if (empty($urls)) {
                        continue;
                    }
                    $sitemap->addItem(
                        $urls,
                        Date::time($post->post_modified),
                        'daily'
                    );
                }

                // store page sitemap
                $sitemap->write();

                return $sitemap->getSitemapUrls(app()->url() . '/sitemaps/');
            },
            app()->isDevelopment() ? 0 : 60 * 60 * 2
        );
    }



    public static function allPostsOf($post_type)
    {
        // get post by meta, to find its slug
        $query_args = [
            'post_type' => $post_type,
            'posts_per_page' => -1,
            'post_status' => 'publish',
            'no_found_rows' => true,
            'update_post_meta_cache' => false,
            'update_post_term_cache' => false,
            'meta_query' => [
                [
                    [
                        'key' => 'is_disabled' . Language::fieldsSuffix(),
                        'value' => '1',
                        'compare' => '!=',
                    ],
                    [
                        'key' => 'is_disabled' . Language::fieldsSuffix(),
                        'compare' => 'NOT EXISTS',
                    ],
                    'relation' => 'OR',
                ],
            ],
        ];

        $query = new WP_Query($query_args);

        return Cast::posts($query->posts);
    }
}
