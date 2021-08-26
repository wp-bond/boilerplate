<?php

namespace App\Admin;

use Bond\Post;
use Bond\Settings\Language;
use Bond\Settings\Admin;

class ArchiveColumns
{

    public static function bootAdmin()
    {
        // Common column handlers

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
