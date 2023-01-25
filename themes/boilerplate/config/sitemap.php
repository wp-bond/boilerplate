<?php

// Bond\Services\Sitemap

// Uses the native WP Sitemap feature, providing more control
// and multilanguage support.

// TODO idea, change the rewrite rule from wp-sitemap.xml to only sitemap.xml


// enable our sitemap handler
app()->sitemap()->enable();

// disables WP sitemap entirely
// also disables our service too as it's based on the native WP sitemap
// app()->sitemap()->disableWpSitemap();


// disable stylesheed if wanted
// app()->sitemap()->disableStylesheet();

// specify post types to add to sitemap
// leave unset to allow all public post types
app()->sitemap()->postTypes([
    PAGE,
    NEWS,
]);

// disable all post types from sitemap
// app()->sitemap()->disablePosts();


// specify taxonomies to add to sitemap
// set to empty array to disable all taxonomies
// leave unset to allow all public taxonomies
// app()->sitemap()->taxonomies([]);

// disable all taxonomies from sitemap
app()->sitemap()->disableTaxonomies();

// TODO specify users to add to sitemap (wait for Bond upgrade)
// leave unset to allow all public users
// app()->sitemap()->users([]);

// disable all users from sitemap
app()->sitemap()->disableUsers();

// TODO extra links

// list of post types to exclude from archive links
// app()->sitemap()->skipArchives([]);

// list of post types to exclude from singles links
// app()->sitemap()->skipSingles([]);

// list of post names to exclude from pages links
app()->sitemap()->skipPages([
    'home'
]);
