<?php

if ($this->title) {
    echo '<h1>' . $this->title . '</h1>';
}

if ($this->subtitle) {
    echo '<h2>' . $this->subtitle . '</h2>';
}
if ($this->content) {
    echo '<div class="the-content">';
    echo $this->content;
    echo '</div>';
}
