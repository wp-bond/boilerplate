<?php

namespace App\Post;

use Bond\Settings\Language;
use Bond\Post;
use Bond\Utils\Image;

class BasePost extends Post
{

    // Schema Org
    public function schemaId($hash = '')
    {
        return app()->url()
            . $this->link(Language::defaultCode())
            . ($hash ? '#' . $hash : '');
    }

    public function schemaUrl()
    {
        return app()->url()
            . $this->link();
    }

    public function schemaImage()
    {
        return Image::url(
            $this->imageId(),
            'large'
        );
    }
}
