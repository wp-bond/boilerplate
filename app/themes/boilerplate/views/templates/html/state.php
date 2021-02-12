<?php

if (empty($state)) {
    return;
}

echo '<script>'
    . '__APP__ = JSON.parse(' . json_encode(json_encode($state)) . ')'
    . '</script>';
