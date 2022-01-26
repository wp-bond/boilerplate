<!DOCTYPE html>
<html lang="<?= Bond\Settings\Language::tag() ?>">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <?php

    // Preload fonts
    $this->partial('html/preload');

    // Styles and Scripts
    $this->partial('html/vite');

    // WP Head
    wp_head();

    // Styles, etc
    $this->partial('html/schema-org');
    $this->partial('html/google-analytics');
    $this->partial('html/polyfill');

    ?>
</head>

<body <?php body_class() ?>>
    <?php

    // the header
    $this->template('header');

    // pre content, usually for features
    $this->template('pre-content');

    // main content
    $this->template('content');

    // after the main content, usually for cross linking
    $this->template('pre-footer');

    // the footer
    $this->template('footer');


    // WP footer
    wp_footer();

    // JS state
    echo $this->state->jsTag('__STATE__');

    // Vite Legacy
    $this->partial('html/vite-legacy');

    ?>
</body>

</html>
