<?php

return [
    // if needed disable the cache here
    // note that on WP CLI it will always be disabled
    'enabled' => true,

    // default ttl (in seconds)
    'ttl' => app()->isDevelopment() ? 0 : -1,
    // -1 means forever, 0 means never
    // we can safely use forever cache as Bond clears itself on Post/Tax/etc updates

    // cache handler
    // 'class' => Bond\Services\Cache\FileCache::class, (default)

    // path for file cache
    // 'path' => app()->basePath() . '/.cache', (default)
];
