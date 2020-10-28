<?php

// TIP: define your credentials as constants at the wp.php file
// this way you can commit this file to your version control

// remember to make the wp.php file readonly, either:
// chmod 440 wp.php (allowing read for user and group)
// chmod 400 wp.php (allowing read for user only)

return [
    'id' => 'boilerplate',
    'name' => 'My App',

    // https://www.php.net/manual/en/timezones.php
    'timezone' => 'America/Sao_Paulo',

    'search_path' => 'search',

    'developer_email' => 'my@email.com',
];
