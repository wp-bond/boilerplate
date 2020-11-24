<?php

$props = [
    'msg' => 'Header'
];

?>
<header class="vue-app">
    <hello-world v-bind="<?= esc_json($props) ?>"></hello-world>
</header>
