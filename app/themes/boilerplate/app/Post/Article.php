<?php

namespace App\Post;

use Bond\Support\Fluent;

class Article extends BasePost
{
    public string $post_type = NEWS;


    public function values(string $for = ''): Fluent
    {
        $values = new Fluent();

        switch ($for) {

            case 'api':
                $values->title = $this->title ?: $this->post_title;
                $values->date = $this->dateLong();
                break;

            default:
                break;
        }

        return $values;
    }
}
