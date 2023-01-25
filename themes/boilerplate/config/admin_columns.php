<?php

// enables our admin column handler
if (app()->isAdmin()) {
    app()->adminColumns()->enable();
}
