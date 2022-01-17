<?php

// no polyfill on dev, nor mobile
if (app()->isDevelopment() || app()->isMobile()) {
    return;
}

?>
<script crossorigin="anonymous" src="https://polyfill.io/v3/polyfill.min.js?features=default%2Cfetch"></script>
