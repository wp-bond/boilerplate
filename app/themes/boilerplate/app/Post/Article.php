<?php

namespace App\Post;

use Bond\Support\Fluent;

class Article extends BasePost
{
    public string $post_type = NEWS;


    public function values(string $for = ''): Fluent
    {
        $values = parent::values($for);

        switch ($for) {

            case 'api':
                $values->date = $this->dateLong();
                break;

            default:
                break;
        }

        return $values;
    }
}