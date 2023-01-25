<?php

$id = ''; // G-xxxx or UA-xxxx

if (!app()->isProduction() || !$id) {
    return;
}

?>
<script async src="https://www.googletagmanager.com/gtag/js?id=<?= $id ?>"></script>
<script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
        dataLayer.push(arguments);
    }
    gtag('js', new Date());
    gtag('config', '<?= $id ?>');
</script>
