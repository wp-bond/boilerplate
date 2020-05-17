<?php

namespace App\Controllers;

use Bond\Settings\Languages;
use Bond\Utils\Query;
use WP_Tax_Query;

class MainQuery
{
    public static function boot()
    {
        add_filter('pre_get_posts', [static::class, 'mainQuery']);
    }

    public static function mainQuery($query)
    {
        if (is_admin() || !$query->is_main_query()) {
            return;
        }

        // common vars, force set globals to avoid inconsistencies
        global $s,
            $post_type,
            $paged,
            $pagename;

        $vars = [
            's',
            'post_type',
            'paged',
            'pagename',
        ];


        // sanitize paged
        $paged = (int) $paged;

        // sanitize
        if ($query->get('page')) {
            $query->is_page = true;
            $query->is_home = false;
        }

        // Password protection filter everywhere except the post itself
        // excludes password protected posts from queries
        if (!is_singular()) {
            \add_filter('posts_where', [static::class, 'excludeProtected']);
        }


        // feed
        if ($query->is_feed) {
            $query->set('post_type', Feed::$post_types);
            $query->set('posts_per_page', 100);
            return;
        }


        // helper
        $meta_query_is_enabled = [
            'relation' => 'AND',
            [
                [
                    'key' => 'is_disabled' . Languages::fieldsSuffix(),
                    'value' => '1',
                    'compare' => '!=',
                ],
                [
                    'key' => 'is_disabled' . Languages::fieldsSuffix(),
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


        // singles
        // use only for posts that have i18n slugs
        if ($query->is_single) {

            if (!Languages::isDefault()) {
                // get post by meta, to find its slug

                $found = Query::wpPostBySlug(
                    $query->get('name'),
                    $post_type,
                    null,
                    [
                        'post_status' => is_user_logged_in() ? 'any' : 'publish',
                    ]
                );

                if ($found) {
                    // set the actual slug
                    $query->set($post_type, $found->post_name);
                } else {
                    // let it go for now, may match on post slug
                    // disabled because exhibitions with no title
                    // $query->is_404 = true;
                }
            }

            return;
        }

        // use only for posts that has i18n slugs
        if ($query->is_page) {

            if (!Languages::isDefault()) {

                $full_path = $query->get('page');
                // print_r($full_path);

                if ($full_path) {

                    // get page by meta, to find its slug

                    $found = Query::wpPostBySlug(
                        $full_path,
                        PAGE,
                        null,
                        [
                            'post_status' => is_user_logged_in() ? 'any' : 'publish',
                        ]
                    );

                    if ($found) {
                        // reparse query
                        $query->parse_query([
                            'page_id' => $found->ID,
                        ]);
                    } else {
                        $query->is_404 = true;
                    }
                }
            }
            return;
        }
    }



    // public static function clearTaxQuery(&$query)
    // {
    //     foreach (MultilanguageTerms::$taxonomies as $tax) {
    //         unset($query->query[$tax]);
    //         unset($query->query_vars[$tax]);
    //     }
    //     $query->tax_query = new WP_Tax_Query([]);
    //     $query->is_tax = false;
    // }


    public static function excludeProtected($where)
    {
        global $wpdb;
        return $where .= " AND {$wpdb->posts}.post_password = '' ";
    }
}
