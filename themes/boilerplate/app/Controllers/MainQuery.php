<?php

namespace App\Controllers;

use Bond\Settings\Language;

class MainQuery
{
    public static function boot()
    {
        \add_filter('pre_get_posts', [static::class, 'mainQuery']);
    }

    public static function mainQuery($query)
    {
        if (\is_admin() || !$query->is_main_query()) {
            return;
        }

        // vars
        $post_type = $query->query['post_type'] ?? '';

        // sanitize
        if ($query->get('page')) {
            $query->is_page = true;
            $query->is_home = false;
        }

        // Password protection filter everywhere except the post itself
        // i.e. excludes password protected posts from archive queries
        if (!is_singular()) {
            \add_filter('posts_where', [static::class, 'excludeProtected']);
        }

        // helper
        $meta_query_is_enabled = [
            'relation' => 'AND',
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
            ]
        ];


        // the search archive
        if ($query->is_search || $query->is_author) {

            // Not handled by WP, api only
            $query->set('post_type', 'any');
            $query->set('posts_per_page', 1);
            $query->set('no_found_rows', true);
            // $query->set('suppress_filters', true);
            $query->set('update_post_meta_cache', false);
            $query->set('update_post_term_cache', false);

            // clear tax query
            // TODO review
            // self::clearTaxQuery($query);


            // remove search trigger
            if (trim($query->query_vars['s']) == false) {
                $query->set('s', false);
            }
            return;
        }


        // archives
        if ($query->is_archive) {

            switch ($post_type) {

                case NEWS:
                    // $query->set('meta_query', $meta_query_is_enabled);
                    $query->set('posts_per_page', 8);
                    break;

                default:

                    break;
            }
        }
    }

    // TODO review this
    // public static function clearTaxQuery(&$query)
    // {
    //     foreach (MultilanguageTerms::$taxonomies as $tax) {
    //         unset($query->query[$tax]);
    //         unset($query->query_vars[$tax]);
    //     }
    //     $query->tax_query = new \WP_Tax_Query([]);
    //     $query->is_tax = false;
    // }


    public static function excludeProtected($where)
    {
        global $wpdb;
        return $where .= " AND {$wpdb->posts}.post_password = '' ";
    }
}
