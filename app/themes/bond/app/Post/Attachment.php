<?php

namespace App\Post;

use Bond\Support\Fluent;

class Attachment extends BasePost
{
    public string $post_type = ATTACHMENT;


    public function values(string $for = ''): Fluent
    {
        $values = parent::values($for);

        // extra content
        switch ($for) {

            case 'api':
                break;

            default:
                break;
        }

        return $values;
    }
}
