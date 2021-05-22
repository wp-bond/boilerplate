<?php

namespace App\Post;

use Bond\Settings\Language;
use Bond\Post;
use Bond\Utils\Date;
use Bond\Utils\Image;
use Bond\Utils\Str;

class BasePost extends Post
{
    public function content(): string
    {
        return Str::filterContent($this->post_content);
    }

    public function date()
    {
        return Date::iso($this->post_date, 'DD.MM.Y');
    }

    public function dateLong()
    {
        return Date::iso($this->post_date, 'D MMMM Y');
    }

    public function archiveImage(): int
    {
        if ($this->archive_image) {
            return (int) $this->archive_image;
        }
        return $this->image();
    }

    public function image(): int
    {
        // is attachment already
        if ($this->post_type === 'attachment') {
            return (int) $this->ID;
        }

        // try ACF image fields
        // IMPORTANT relies that the return_type is id
        if ($this->image) {
            return (int) $this->image;
        }
        if ($this->archive_image) {
            return (int) $this->archive_image;
        }
        if ($this->feature_image) {
            return (int) $this->feature_image;
        }

        // gallery field
        if (!empty($this->images[0])) {
            return (int) $this->images[0];
        }

        // modules
        $images = $this->modulesImages($this->modules);
        if (count($images)) {
            return (int) $images[0];
        }

        // raw body content
        // could be used if the default editor is used

        // $content = $this->content ?: $this->post_content;
        // $images = Image::findWpImages($content);
        // if (count($images)) {
        //     return (int) $images[0];
        // }

        return 0;
    }

    // common fields that should hold an image in ACF Flex modules
    protected function modulesImages($modules): array
    {
        if (empty($modules)) {
            return [];
        }
        $images = [];

        foreach ($modules as $module) {

            if (is_int($module['image'])) {
                $images[] = $module['image'];
            }

            if (is_iterable($module['images'])) {
                foreach ($module['images'] as $image) {

                    if (is_int($image)) {
                        $images[] = $image;
                    } elseif (
                        !empty($images['image'])
                        && is_int($images['image'])
                    ) {
                        $images[] = $image;
                    }
                }
            }
        }
        return array_map('intval', $images);
    }



    // Schema Org
    public function schemaId($hash = '')
    {
        return app()->url()
            . $this->link(Language::getDefault())
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
            $this->image(),
            'large'
        );
    }
}
