<?php

if (!empty($title)) {
    echo '<h1>' . $title . '</h1>';
}

if (!empty($subtitle)) {
    echo '<h2>' . $subtitle . '</h2>';
}

if (!empty($content)) {
    echo '<div class="the-content">';
    echo $content;
    echo '</div>';
}
