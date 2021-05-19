<?php

namespace App\Post;

use Bond\Support\Fluent;
use Bond\Utils\Image;

class Attachment extends BasePost
{
    public string $post_type = ATTACHMENT;

    public function link(string $language_code = null): string
    {
        return Image::url($this->ID, 'original');
    }

    public function caption(): string
    {
        return Image::caption($this->ID);
    }

    public function alt(): string
    {
        return Image::alt($this->ID);
    }

    public function values(string $for = ''): Fluent
    {
        $values = parent::values($for);

        // extra content
        switch ($for) {

            case 'api':
                $values->id = $this->ID;
                $values->imageTag = Image::pictureTag(
                    $this->ID,
                    THUMBNAIL
                );
                $values->caption = $this->caption();
                break;

            default:
                break;
        }

        return $values;
    }
}
