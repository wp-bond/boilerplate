<?php

use Bond\Utils\Cast;
use Bond\Utils\Image;


// Constants to prevent typos and enjoy IDE's auto completion
// this is just a personal preference, you may not use if don't want

// post types
const NEWS = 'news';
const ATTACHMENT = 'attachment';
const PAGE = 'page';

// taxonomies
const CATEGORY = 'category';


function responsive_picture($image_id, $size, $with_caption = false)
{
    if (is_array($image_id)) {
        $image_xl = !empty($image_id[0]) ? $image_id[0] : null;
        $image_lg = !empty($image_id[1]) ? $image_id[1] : $image_xl;
        $image_md = !empty($image_id[2]) ? $image_id[2] : $image_lg;
        $image_sm = !empty($image_id[3]) ? $image_id[3] : $image_md;
        $image_id = !empty($image_id[4]) ? $image_id[4] : $image_sm;
    } else {
        $image_xl = $image_id;
        $image_lg = $image_id;
        $image_md = $image_id;
        $image_sm = $image_id;
    }

    if (is_array($size)) {
        $size_xl = !empty($size[0]) ? $size[0] : null;
        $size_lg = !empty($size[1]) ? $size[1] : $size_xl;
        $size_md = !empty($size[2]) ? $size[2] : $size_lg;
        $size_sm = !empty($size[3]) ? $size[3] : $size_md;
        $size = !empty($size[4]) ? $size[4] : $size_sm;
    } else {
        $size_xl = $size;
        $size_lg = $size;
        $size_md = $size;
        $size_sm = $size;
    }

    $responsive_sizes = [];

    $responsive_sizes[] = [
        'rule' => 'min-width: 1200px',
        'size' => [$size_xl . '_xl', $size_xl . '_xl_retina'],
        'image' => $image_xl,
    ];
    $responsive_sizes[] = [
        'rule' => 'min-width: 992px',
        'size' => [$size_lg . '_lg', $size_lg . '_lg_retina'],
        'image' => $image_lg,
    ];
    $responsive_sizes[] = [
        'rule' => 'min-width: 768px',
        'size' => [$size_md . '_md', $size_md . '_md_retina'],
        'image' => $image_md,
    ];
    // $responsive_sizes[] = [
    //     'rule' => 'min-width: 576px',
    //     'size' => [$size_sm . '_sm', $size_sm . '_sm_retina'],
    //     'image' => $image_sm,
    // ];

    $tag = Image::pictureTag(
        $image_id,
        [$size, $size . '_retina'],
        $responsive_sizes
    );

    if ($with_caption) {
        $caption = Cast::post($image_id)->caption;
        if (!empty($caption)) {
            $tag .= '<h6 class="no-spacing">' . $caption . '</h6>';
        }
    }

    return $tag;
}


function is_ajax()
{
    return !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest';
}

function is_post()
{
    return !empty($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] === 'POST';
}

function sanitize_input($value, $method = 'text')
{
    if ($method === 'email') {
        return strip_tags(filter_var(str_replace("'", "", $value), FILTER_SANITIZE_EMAIL));
    }

    return strip_tags(filter_var($value, FILTER_SANITIZE_STRING));
}
