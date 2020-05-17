<?php

namespace App\PostType;

use Bond\FieldGroup;
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
            ->title(t('General Control'))
            ->screenHideAll();

        $group->textAreaField('caption')
            ->multilanguage()
            ->label(t('Caption'))
            ->rows(4)
            ->newLines('br');
    }


    public static function bootAdmin()
    {
        // columns
        \add_filter('manage_media_columns', function ($defaults) {
            // dd($defaults);

            return [
                'cb' => '<input type="checkbox" />',
                'title' => t('File'),
                'i18n-image-caption' => t('Caption'),
                // 'author' => t('Author'),
                'parent' => t('Attached to'),
                'date' => t('Date'),
            ];
        });

        Admin::addArchiveColumn('i18n-image-caption', function ($post) {
            return $post->caption ?: '—';
        });
    }
}
