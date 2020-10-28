<?php

namespace App\Api;

use Bond\Settings\Languages;
use Exception;

class NewsletterApi
{

    public static function subscribe($params)
    {
        // force set current language as post request does not
        // handle the get parameter 'lang'
        Languages::resetLocale();

        $status = 'ready';
        $message = '';
        $name = sanitize_input($params['name'] ?? '');
        $email = sanitize_input($params['email'] ?? '', 'email');

        if (!is_post()) {
            $status = 'error';
            $message = t('Server error, reload the page and try again.');
            //
        } elseif (!is_ajax()) {
            $status = 'error';
            $message = t('Method not allowed.');

            // } elseif (empty($name)) {
            //     $status = 'error';
            //     $message = t('Fill in your name.');

        } elseif (empty($email)) {
            $status = 'error';
            $message = t('Fill your e-mail.');
        } else {

            // submit
            try {
                // subscribe logic
                $status = 'success';
                $message = t('Subscribed successfully!');
            } catch (Exception $e) {
                $status = 'error';
                $message = t('An error occurred, check your email and try again.');
            }
        }

        return compact(
            'status',
            'message'
        );
    }
}
