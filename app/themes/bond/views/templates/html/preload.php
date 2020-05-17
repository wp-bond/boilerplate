<?php

if (config()->isDevelopment()) {
    return;
}

?>

<link rel="preload" href="<?= config()->themeDir() ?>/fonts/yourfont.woff2" as="font" type="font/woff2" crossorigin="anonymous">

<link rel="preload" href="<?= mix('js/manifest.js') ?>" as="script">
<link rel="preload" href="<?= mix('js/vendor.js') ?>" as="script">
<link rel="preload" href="<?= mix('js/app.js') ?>" as="script">
