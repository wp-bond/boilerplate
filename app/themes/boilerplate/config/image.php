<?php

// TODO change to plural? check consistencies if files or oembeds, other media types get added

// do not disable thumbnail and medium sizes, they are required for WP Admin upload UI (feel free to change the sizes, just don't disable)

// Constants to prevent typos and IDE auto fill
const THUMBNAIL = 'thumbnail';
const THUMBNAIL_SQUARE = 'thumbnail_square';
const MEDIUM = 'medium';
const MEDIUM_CROP = 'medium_crop';
const MEDIUM_SQUARE = 'medium_square';
const MEDIUM_LARGE = 'medium_large';
const MEDIUM_LARGE_CROP = 'medium_large_crop';
const LARGE = 'large';
const LARGE_CROP = 'large_crop';
const FULL = 'full';

$sizes = [

    // 3 columns
    THUMBNAIL => [177, 0],
    // THUMBNAIL.'_sm' => [270, 0],
    THUMBNAIL . '_md' => [270, 0],
    THUMBNAIL . '_lg' => [270, 0],
    THUMBNAIL . '_xl' => [270 * 1.6, 0],

    THUMBNAIL_SQUARE => [177, 177, true],
    // THUMBNAIL_SQUARE.'_sm' => [270, 270, true],
    THUMBNAIL_SQUARE . '_md' => [270, 270, true],
    THUMBNAIL_SQUARE . '_lg' => [270, 270, true],
    THUMBNAIL_SQUARE . '_xl' => [270 * 1.6, 270 * 1.6, true],


    // 6 columns
    MEDIUM => [374, 0],
    // MEDIUM.'_sm' => [580, 0],
    MEDIUM . '_md' => [580, 0],
    MEDIUM . '_lg' => [580, 0],
    MEDIUM . '_xl' => [580 * 1.6, 0],

    MEDIUM_CROP => [374, 340, true],
    // MEDIUM_CROP.'_sm' => [580, 542, true],
    MEDIUM_CROP . '_md' => [580, 542, true],
    MEDIUM_CROP . '_lg' => [580, 542, true],
    MEDIUM_CROP . '_xl' => [580 * 1.6, 542 * 1.6, true],

    MEDIUM_SQUARE => [374, 374, true],
    // MEDIUM_SQUARE.'_sm' => [580, 580, true],
    MEDIUM_SQUARE . '_md' => [580, 580, true],
    MEDIUM_SQUARE . '_lg' => [580, 580, true],
    MEDIUM_SQUARE . '_xl' => [580 * 1.6, 580 * 1.6, true],


    // 9 columns
    MEDIUM_LARGE => [374, 0],
    // MEDIUM_LARGE.'_sm' => [890, 0],
    MEDIUM_LARGE . '_md' => [890, 0],
    MEDIUM_LARGE . '_lg' => [890, 0],
    MEDIUM_LARGE . '_xl' => [890 * 1.6, 0],

    MEDIUM_LARGE_CROP => [374, 340, true],
    // MEDIUM_LARGE_CROP.'_sm' => [890, 542, true],
    MEDIUM_LARGE_CROP . '_md' => [580, 580, true],
    MEDIUM_LARGE_CROP . '_lg' => [890, 542, true],
    MEDIUM_LARGE_CROP . '_xl' => [890 * 1.6, 542 * 1.6, true],

    // 12 column, fluid container
    LARGE => [374, 0],
    // LARGE.'_sm' => [1200, 0],
    LARGE . '_md' => [1200, 0],
    LARGE . '_lg' => [1200, 0],
    LARGE . '_xl' => [1200 * 1.6, 0],

    LARGE_CROP => [374, 340, true],
    // LARGE_CROP.'_sm' => [1200, 542, true],
    LARGE_CROP . '_md' => [1200, 542, true],
    LARGE_CROP . '_lg' => [1200, 542, true],
    LARGE_CROP . '_xl' => [1200 * 1.6, 542 * 1.6, true],
];

// retina it
foreach (array_slice($sizes, 0) as $name => $values) {

    if (!$values) {
        continue;
    }

    // skip some
    // if (in_array($name, [FULL_PAGE, FULL_PAGE_WIDE])) {
    //     continue;
    // }

    // retina 2x others
    $name = $name . '_retina';

    $values[0] = $values[0] * 2;
    $values[1] = $values[1] * 2;
    $sizes[$name] = $values;
}


return [
    'quality' => 90, // default is 82
    'sizes' => $sizes,

    'editor_sizes' => [
        'thumbnail' => t('Thumbnail'), // required for media upload ui
        // 'medium' => t('Medium'),
        // 'medium_large' => t('Medium Large'),
        'full' => t('Original'),
    ],
];
