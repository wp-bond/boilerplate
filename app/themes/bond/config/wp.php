<?php

return [
    'force_https' => app()->isProduction() || app()->isStaging(),
];
