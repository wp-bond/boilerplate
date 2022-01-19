<?php

namespace App\Api;

class Routes
{
    // TODO upgrade Settings/Api to a Service
    // move all these options there, including the routes setup

    public static function boot()
    {
        static::enableCors();

        // Routes
        \add_action('rest_api_init', function ($server) {
            $namespace = app()->id();

            // \register_rest_route(
            //     $namespace,
            //     '/some-endpoint',
            //     [
            //         'methods' => 'GET',
            //         'callback' => [MyClass::class, 'get'],
            //         'permission_callback' => '__return_true',
            //     ]
            // );
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
