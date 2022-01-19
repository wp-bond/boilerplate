<?php

return [

    'enabled' => !app()->isCli(),

    // default ttl (in seconds)
    'ttl' => app()->isDevelopment() ? 0 : -1,
    // -1 means forever, 0 means never
    // we can safely use forever cache as Bond clears itself on Post/Tax/etc updates

    // cache handler
    // 'class' => Bond\Services\Cache\FileCache::class, (default)

    // path for file cache
    // 'path' => app()->basePath() . '/.cache', (default)
];
