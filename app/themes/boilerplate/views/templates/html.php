<!DOCTYPE html>
<html lang="<?= Bond\Settings\Languages::htmlAttribute() ?>">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <?php

    // Preload fonts
    $this->template('html/preload');

    // Styles and Scripts
    $this->template('html/vite');

    // WP Head
    wp_head();

    // Styles, etc
    $this->template('html/schema-org');
    $this->template('html/google-analytics');
    $this->template('html/polyfill');

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

    // Vite Legacy
    $this->template('html/vite-legacy');

    ?>
</body>

</html>
