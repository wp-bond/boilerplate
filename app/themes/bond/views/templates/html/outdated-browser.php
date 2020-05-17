<?php

// don't bother users on every page
if (!is_front_page()) {
    return;
}

?>
<!--[if lte IE 11]>
<p class="outdated-browser"><strong><?= t('You are using an outdated browser') ?></strong>. <?= t('Please') ?> <a href="https://www.google.com/chrome/"><?= t('update your browser') ?></a> <?= t('to view this website correctly') ?>.
</p>
<![endif]-->
