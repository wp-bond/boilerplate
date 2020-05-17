<?php

return [
    'force_https' => config()->isProduction() || config()->isStaging(),
];
