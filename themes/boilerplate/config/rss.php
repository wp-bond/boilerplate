<?php

app()->rss()->enable();

// disable native WP RSS
app()->rss()->disableWpRss();

// add our feeds
// we can have many feeds, each with a different key

app()->rss()->addFeed('main', [
    // the title (defaults to app()->name())
    // 'title' => '',

    // 'description' => '',

    // image
    // 'image' => app()->themeUrl() . '/images/rss.png',

    // only of specific post types (defaults to all public types)
    // 'post_types' => ['post', 'page', ...],

    // max itens in the feed (default 100)
    // 'max' => 20,

    // url path to the feed (defaults to /rss)
    // 'url' => '/rss',

    // in case you use a feed publisher service this is the url that will be shown publicly on HTML head and the feed XML
    // 'public_url' => 'https://...',

    // update frequency (default once a day)
    // 'update_period' => 'hourly', // hourly, daily, weekly, monthly, yearly
    // 'update_frequency' => 2,
    // https://web.resource.org/rss/1.0/modules/syndication/

    // multilanguage
    // 'multilanguage' => true,

    // note the title/description/url options above are translated
    // so edit them in the language JSON if needed
    // look under "rss" and "url" context

    // if you use the public_url, provide for each language code too
    // 'public_url' => [
    //     'en' => 'https://...',
    //     'pt-br' => 'https://...',
    // ],
]);
