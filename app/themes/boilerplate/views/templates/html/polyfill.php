<?php

// no polyfill on dev
if (app()->isDevelopment()) {
    return;
}

?>
<script crossorigin="anonymous" src="https://polyfill.io/v3/polyfill.min.js?features=default%2Cfetch%2CIntl"></script>
