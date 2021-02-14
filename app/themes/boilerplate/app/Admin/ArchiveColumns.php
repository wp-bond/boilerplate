<?php

namespace App\Admin;

use App\Post\BasePost;
use Bond\Post;
use Bond\Settings\Language;
use Bond\Settings\Admin;
use Bond\Utils\Image;
use Bond\Utils\Str;

class ArchiveColumns
{

    public static function bootAdmin()
    {

        // Common column handlers

        Admin::addColumnHandler('subtitle', function (Post $post) {
            return $post->subtitle ?: '—';
        });

        Admin::addColumnHandler('content', function (Post $post) {

            $value = $post->content ?: $post->post_content;

            echo '<a href="' . get_edit_post_link($post->ID) . '">';
            echo $value ? Str::clean($value, 20) : '—';
            echo '</a>';
        });

        Admin::addColumnHandler('image', function (BasePost $post) {
            $image_id = $post->image();
            if (!$image_id) {
                return;
            }
            return '<a href="' . get_edit_post_link($post->ID) . '">'
                . Image::imageTag(
                    $image_id,
                    'thumbnail',
                    [
                        'class' => 'archive-img',
                    ]
                )
                . '</a>';
        });

        Admin::addColumnHandler('multilanguage_links', function (Post $post) {
            $res = '<div class="multilanguage-circles">';

            foreach (Language::codes() as $code) {

                if ($link = $post->link($code)) {
                    $res .= '<a href="' . $link . '" target="_blank">';
                } else {
                    $res .= '<div>';
                }

                $res .= '<div class="multilanguage-circle ' . ($post->isDisabled($code) ? 'no' : '') . '">' . Language::shortCode($code) . '</div>';

                if ($link) {
                    $res .= '</a>';
                } else {
                    $res .= '</div>';
                }
            }

            $res .= '</div>';

            return $res;
        });
    }
}
