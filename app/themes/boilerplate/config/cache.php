<?php

return [
    'enabled' => true,
    'ttl' => app()->isDevelopment() ? 0 : -1,
];
