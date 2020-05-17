<?php

if (
    !config()->isProduction()
    || !config('services.google_analytics.id')
) {
    return;
}

?>
<script async src="https://www.googletagmanager.com/gtag/js?id=<?= config('services.google_analytics.id') ?>"></script>
<script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
        dataLayer.push(arguments);
    }
    gtag('js', new Date());
    gtag('config', '<?= config('services.google_analytics.id') ?>');
</script>
