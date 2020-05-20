<?php

namespace App\Support;

use Aws\Ses\SesClient;

class Mail
{

    public static function from(): string
    {
        static $email;
        if (!$email) {
            // ACF field so editors can edit in the admin
            $email = get_field('client_email', 'options') ?: '';
        }
        return $email;
    }

    /**
     * Send preformatted SES email, returns boolean of success.
     *
     * @param string|array $to Target email.
     * @param string $subject The subject
     * @param string $body Email body, HTML formatted.
     * @param string|array $replyTo ReplyTo email to attach, if needed.
     */
    public static function send(
        $to,
        string $subject,
        string $body,
        $replyTo = false
    ) {

        $from = static::from();
        $to = (array) $to;

        // nothing to do
        if (empty($from) || empty($to) || empty($body)) {
            return false;
        }

        $args = [
            'Source' => $from,
            'Destination' => [
                'ToAddresses' => $to,
            ],
            'ReturnPath' => $from,
            'Message' => [
                'Subject' => [
                    'Data' => $subject,
                ],
                'Body' => [
                    'Html' => [
                        'Data' => $body,
                    ],
                ],
            ],
        ];

        if (!empty($replyTo)) {
            $args['ReplyToAddresses'] = (array) $replyTo;
        }

        static::client()->sendEmail($args);
        // it will throw Exceptions if needed

        return true;
    }


    protected static function client(): SesClient
    {
        static $client = null;

        if (!$client) {
            $options = [
                'region' => config('services.ses.region') ?: 'us-east-1',
                'version' => 'latest',
            ];

            // In our case, credentials are not needed in production
            // it is hosted on AWS EC2 with a EC2 role already permitting SES
            if (!app()->isProduction()) {
                $options['credentials'] = [
                    'key' => config('services.ses.key'),
                    'secret' => config('services.ses.secret'),
                ];
            }

            $client = new SesClient($options);
        }

        return $client;
    }
}
