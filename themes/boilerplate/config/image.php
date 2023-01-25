<?php

use Bond\Settings\Admin;
use Bond\Settings\Wp;
use Bond\Utils\Image;

// sanitize all filenames on upload
// very good idea to always leave on and avoid OS issues with special characters
Wp::sanitizeFilenames();

// Constants to prevent typos and IDE auto fill
const THUMBNAIL = 'thumbnail';
const MEDIUM = 'medium';
const MEDIUM_LARGE = 'medium_large';
const LARGE = 'large';
const FULL = 'full';

$sizes = [
    // IMPORTANT: do not disable thumbnail and medium sizes,
    // they are required for WP Admin upload UI
    // (feel free to change the sizes, just don't disable)

    //
    THUMBNAIL => [392, 0],
    // THUMBNAIL.'_sm' => [392, 0],
    // THUMBNAIL . '_md' => [392, 0],
    // THUMBNAIL . '_lg' => [392, 0],
    // THUMBNAIL . '_xl' => [392, 0],

    //
    MEDIUM => [392, 0],
    // MEDIUM.'_sm' => [392, 0],
    // MEDIUM . '_md' => [392, 0],
    // MEDIUM . '_lg' => [392, 0],
    // MEDIUM . '_xl' => [392, 0],

    //
    MEDIUM_LARGE => [392, 0],
    // MEDIUM_LARGE.'_sm' => [392, 0],
    // MEDIUM_LARGE . '_md' => [392, 0],
    // MEDIUM_LARGE . '_lg' => [392, 0],
    // MEDIUM_LARGE . '_xl' => [392, 0],

    //
    LARGE => [392, 0],
    // LARGE.'_sm' => [392, 0],
    // LARGE . '_md' => [1280, 0],
    // LARGE . '_lg' => [1280, 0],
    // LARGE . '_xl' => [1920, 0],
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
    $name = $name . '_2x';

    $values[0] = $values[0] * 2;
    $values[1] = $values[1] * 2;
    $sizes[$name] = $values;
}


Wp::setImageQuality(90); // WP default is 82

Wp::disableImageLimit();


// TODO will migrate to a unified method
Wp::addImageSizes($sizes);
Image::setSizes($sizes);



// TODO maybe an "editor" named class that handles the toolbar too
Admin::setEditorImageSizes([
    'thumbnail' => t('Thumbnail'), // required for media upload ui
    // 'medium' => t('Medium'),
    // 'medium_large' => t('Medium Large'),
    'full' => t('Original'),
]);
