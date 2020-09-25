<?php

namespace App\Api;

// TODO, maybe pass to Bond later if gets usefull
class Routes
{

    public static function boot()
    {
        static::enableCors();

        // Routes
        \add_action('rest_api_init', function ($server) {
            $namespace = app()->id();

            \register_rest_route(
                $namespace,
                '/newsletter-subscribe',
                [
                    'methods' => 'POST',
                    'callback' => [NewsletterApi::class, 'subscribe'],
                    'permission_callback' => '__return_true',
                ]
            );
        });
    }

    public static function enableCors()
    {
        \add_action('rest_api_init', function () {

            \remove_filter('rest_pre_serve_request', 'rest_send_cors_headers');

            \add_filter('rest_pre_serve_request', function ($value) {
                header('Access-Control-Allow-Origin: *');
                header('Access-Control-Allow-Methods: GET');
                header('Access-Control-Allow-Credentials: true');
                header('Access-Control-Expose-Headers: Link', false);
                header('Access-Control-Allow-Headers: X-Requested-With, Content-Type');
                // header('Access-Control-Allow-Headers: X-Requested-With, Content-Type, X-WP-Nonce');
                return $value;
            });
        }, 15);
    }
}
