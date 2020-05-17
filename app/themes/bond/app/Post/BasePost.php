<?php

namespace App\Post;

use Bond\Settings\Languages;
use Bond\Post;
use Bond\Support\Fluent;
use Bond\Utils\Date;
use Bond\Utils\Image;
use Bond\Utils\Query;

class BasePost extends Post
{
    // TODO test the addition of some fields var here
    // great for IDE autofill, just test the cases for unset and multilanguage

    // public string $title_en;
    // public array $related_posts = [];

    // declare(strict_types=0);
    // if needed


    public function values(string $for = ''): Fluent
    {
        $values = parent::values($for);

        // default values for every case
        $values->id = $this->ID;
        $values->title = $this->title ?: $this->post_title;
        $values->link = $this->link();
        $values->modules = $this->modules;

        // default values specific for the request
        switch ($for) {

            case 'api':
                $values->type = $this->post_type;
                $values->typeName = Query::postTypeName($this->post_type);

                $values->imageTag = responsive_picture(
                    $this->image(),
                    THUMBNAIL
                );
                break;

            default:
                break;
        }

        return $values;
    }


    public function date()
    {
        return Date::iso($this->post_date, 'DD.MM.Y');
    }

    public function dateLong()
    {
        return Date::iso($this->post_date, 'D MMMM Y');
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
    protected function modulesImages(): array
    {
        if (!$this->modules) {
            return [];
        }
        $images = [];

        foreach ($this->modules as $module) {
            if (!empty($module['image'])) {
                $images[] =  $module['image'];
            }
            if (!empty($module['images'])) {
                $images = array_merge($images, (array) $module['images']);
            }
        }
        return array_map('intval', $images);
    }



    // Schema Org
    public function schemaId($hash = '')
    {
        return config()->url()
            . $this->link(Languages::getDefault())
            . ($hash ? '#' . $hash : '');
    }

    public function schemaUrl()
    {
        return config()->url()
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
