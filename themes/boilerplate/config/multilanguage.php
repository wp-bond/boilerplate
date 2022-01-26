<?php

// TODO IDEA, call directly the services here?
// maybe essencially we could kill the config container?
// app()->multilanguage()->config(
//     enabled: true,
//     post_types: [PAGE, NEWS],
//     taxonomies: [],
// );

// OR transform in JSON considering an Admin UI to change all settings?

return [
    'enabled' => true,

    'post_types' => [
        NEWS,
        PAGE,
    ],

    'taxonomies' => [],
];
