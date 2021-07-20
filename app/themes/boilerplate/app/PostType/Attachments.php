<?php

namespace App\PostType;

use Bond\PostType;
use Bond\Settings\Admin;

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
            ->label('Caption')
            ->rows(4)
            ->newLines('br');
    }


    public static function bootAdmin()
    {
        // columns
        Admin::setColumns(self::$post_type, [
            'title' => 'File',
            'i18n-image-caption' => 'Caption',
            // 'author' => 'Author',
            'parent' => 'Attached to',
            'date' => 'Date',
        ]);

        Admin::addColumnHandler('i18n-image-caption', function ($post) {
            return $post->caption ?: '—';
        });
    }
}
