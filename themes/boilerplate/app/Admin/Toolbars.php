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
        // global $current_screen;
        // dd($current_screen->id);

        $in['block_formats'] = "H1=h1; H2=h2; H3=h3; H4=h4; H5=h5; H6=h6; Text=p; Tag (h6)=h6.tag;";

        $style_formats = [
            // [
            //     'title' => 'H1',
            //     'block' => 'h1',
            // ],
            // [
            //     'title' => 'H2',
            //     'block' => 'h2',
            // ],
            // [
            //     'title' => 'H3',
            //     'block' => 'h3',
            // ],
            // [
            //     'title' => 'H4',
            //     'block' => 'h4',
            // ],
            // [
            //     'title' => 'H5',
            //     'block' => 'h5',
            // ],
            [
                'title' => 'Text',
                'block' => 'p',
            ],
            // [
            //     'title' => 'Caption',
            //     'block' => 'h6',
            // ],
            // [
            //     'title' => 'Tag',
            //     'block' => 'h6',
            //     'classes' => 'tag'
            // ],
            // [
            //     'title' => 'Quote Caption',
            //     'selector' => 'p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li,table,img',
            //     'classes' => 'quote-caption'
            // ],
            // [
            //     'title' => 'Footnote Link',
            //     'inline' => 'a',
            //     'attributes' => [
            //         'href' => '#note',
            //     ]
            // ],
        ];
        $in['style_formats'] = json_encode($style_formats);

        // default WP Editor
        $in['toolbar1'] = implode(',', [
            // 'formatselect',
            'styleselect',
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
        $toolbars[app()->id()] = [];
        $toolbars[app()->id()][1] = [
            'styleselect',
            // 'formatselect',
            'removeformat',
            // 'bold',
            'italic',
            // 'underline',
            // 'blockquote',
            'superscript',
            // 'subscript',
            // 'hr',
            // 'strikethrough',
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
