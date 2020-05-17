<?php

namespace App\Admin;

class Toolbars
{

    public static function bootAdmin()
    {
        // default WP Editor settings
        \add_filter('tiny_mce_before_init', [self::class, 'tinyMce']);

        // ACF toolbars options
        \add_filter('acf/fields/wysiwyg/toolbars', [self::class, 'acf']);
    }



    // http://www.tinymce.com/wiki.php/Configuration
    // http://www.tinymce.com/wiki.php/Controls
    public static function tinyMce($in)
    {
        global $current_screen;
        // dd($current_screen->id);

        // switch ($current_screen->id) {
        //         // case '':
        //         // 	break;
        //     default:
        //         $in['block_formats'] = "Headline (h2)=h2; Text (p)=p";
        //         break;
        // }

        // default WP Editor
        $in['toolbar1'] = implode(',', [
            'formatselect',
            'removeformat',
            'bold',
            'italic',
            'superscript',
            'sub',
            'strikethrough',
            'alignleft',
            'aligncenter',
            'bullist',
            'numlist',
            'link',
            'unlink',
            'charmap',
            'spellchecker'
        ]);
        $in['toolbar2'] = '';
        $in['toolbar3'] = '';
        $in['toolbar4'] = '';

        $in['paste_webkit_styles'] = '';
        $in['paste_as_text'] = true;

        // default _blank links
        $in['default_link_target'] = '_blank';

        return $in;
    }


    public static function acf($toolbars)
    {
        // Uncomment to view array format of $toolbars
        // echo '<pre>';
        // print_r($toolbars);
        // echo '</pre>';
        // die;

        // Add a new toolbar for ACF editors
        $toolbars[config()->id()] = [];
        $toolbars[config()->id()][1] = [
            'formatselect',
            'removeformat',
            // 'bold',
            'italic',
            // 'underline',
            // 'blockquote',
            'superscript',
            'subscript',
            // 'hr',
            'strikethrough',
            // 'aligncenter',
            // 'bullist',
            // 'numlist',
            // 'charmap',
            'link',
            'unlink',
            // 'charmap',
            // 'spellchecker',
            // 'fullscreen',
        ];

        // link_only
        $toolbars['link_only'] = [];
        $toolbars['link_only'][1] = [
            'removeformat',
            'link',
            'unlink',
        ];

        return $toolbars;
    }
}
