<?php

use Bond\Utils\Str;

if ($this->isEmpty()) {
    return;
}

// this is just an example on how I handle the ACF Flex field
// it allows to customize each module as they are outputted

$i = 0;
$previous_layout = '';
$previous_color_theme = '';

foreach ($this as $module) {

    // vars
    $next_module = $i >= count($this) - 1 ? null : $this[$i + 1];
    $previous_module = $i >= 1 ? $this[$i - 1] : null;
    $layout = $module['acf_fc_layout'];


    // control
    $auto_container = true;
    $color_theme = '';



    // get the HMTL
    // the Output Buffering here allows each module to decide to skip
    ob_start();
    view()->partial('module-' . $layout, $module);
    $html = ob_get_clean();

    if (empty($html)) {
        continue;
    }


    // to next
    $previous_color_theme = $color_theme;
    $previous_layout = $layout;



    // output
    $classes = [
        'section',
        'module-' . $layout,
    ];
    if ($color_theme) {
        $classes[] = $color_theme . '-theme';
    }

    $anchor = $module['anchor'] ?? $module['title'] ?? null;
    if ($anchor) {
        $anchor = ' id="' . Str::slug('section-' . $anchor) . '"';
    }

    echo '<section class="' . implode(' ', $classes) . '"'
        . $anchor
        . '>';

    if ($auto_container) {
        echo '<div class="container">';
    }

    // output content
    echo $html;

    if ($auto_container) {
        echo '</div>';
    }
    echo '</section>';
    $i++;
}
