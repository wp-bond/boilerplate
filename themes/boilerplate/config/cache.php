<?php

// ignore cache if on CLI
if (app()->isCli()) {
    return;
}

// change the cache handler (default is FileCache)
// class must implement Bond\Services\Cache\AbstractCache
// app()->addShared('cache', \Bond\Services\Cache\FileCache::class);

// change the file cache local path (default is .cache)
// cache()->path(app()->basePath() . '/.cache');


// default TTL (in seconds)
cache()->ttl(app()->isDevelopment() ? 0 : -1);
// -1 means forever, 0 means never
// we can safely use forever cache as Bond clears itself on Post/Tax/etc updates


// enable
cache()->enable();

// cache()->config([

// ])
