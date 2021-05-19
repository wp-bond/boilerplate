<?php

namespace App\Controllers;

use Bond\Utils\Cast;

class Redirects
{

    public static function boot()
    {
        // runs qfter WordPress is fully loaded, but before query
        \add_action('wp_loaded', [static::class, 'directMatches']);

        // runs after query
        \add_action('wp', [static::class, 'posts']);
    }

    // for the redirects that doesn't rely on posts
    public static function directMatches()
    {
        $uri = $_SERVER['REQUEST_URI'];
        $uri = trim($uri, '/');
        // dd($uri);

        $direct_matches = array(
            '/home' => '/',
        );

        foreach ($direct_matches as $match => $path) {
            $match = trim($match, '/');

            if ($uri === $match) {
                wp_redirect($path, 301);
                exit;
            }
        }
    }

    // TODO can be upgraded into Bond as relies on redirectLink, which is a defined method
    public static function posts()
    {
        global $post;

        if (!is_singular()) {
            return;
        }

        $p = Cast::post($post);
        if (!$p) {
            return;
        }

        $redirect = $p->redirectLink();
        if ($redirect) {
            wp_redirect($redirect);
            exit;
        }
    }
}
