<?php

if (!empty($modules)) {
    $this->partial('modules', compact('modules'));
} else {
    $this->partial('under-construction');
}
