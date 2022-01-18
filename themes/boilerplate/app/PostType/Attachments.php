<?php

namespace App\PostType;

use Bond\PostType;

class Attachments extends PostType
{
    public static string $post_type = ATTACHMENT;


    public static function boot()
    {
        // fields
        $group = self::fieldGroup('General Control')
            ->screenHideAll();

        $group->textAreaField('caption')
            ->multilanguage()
            ->rows(4)
            ->newLines('br');
    }


    public static function bootAdmin()
    {
        // columns
        self::setColumns([
            'title' => 'File',
            'caption' => 'Caption',
            // 'author' => 'Author',
            'parent' => 'Attached to',
            'date' => 'Date',
        ]);
    }
}
