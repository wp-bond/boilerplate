<?php

if (app()->isDevelopment()) {
    return;
}

return;
// example below on how to preload your fonts

?>

<link rel="preload" href="<?= app()->themeDir() ?>/fonts/yourfont.woff2" as="font" type="font/woff2" crossorigin="anonymous">
