<?php

namespace App\PostType;

use Bond\Fields\Acf\FieldGroup;
use Bond\PostType;
use Bond\Settings\Admin;

class Attachments extends PostType
{
    public static string $post_type = ATTACHMENT;


    public static function boot()
    {
        // fields
        $group = (new FieldGroup(static::$post_type))
            ->location([static::$post_type])
            ->title('General Control')
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
            'title' => t('File'),
            'i18n-image-caption' => t('Caption'),
            // 'author' => t('Author'),
            'parent' => t('Attached to'),
            'date' => t('Date'),
        ]);

        Admin::addColumnHandler('i18n-image-caption', function ($post) {
            return $post->caption ?: '—';
        });
    }
}
