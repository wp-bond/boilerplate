<?php

use Bond\Utils\Str;

$props = [
    'msg' => 'Header'
];

?>
<header class="vue-app">
    <hello-world v-bind="<?= Str::escJson($props) ?>"></hello-world>
</header>
