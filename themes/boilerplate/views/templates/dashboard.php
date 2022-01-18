<div id="dashboard">

    <h1><?= t('General Guidelines') ?></h1>


    <div class="help">

        <?php

        echo '<div class="help-block">';
        echo '<p class="title">' . t('Texts Translation') . '</p>';
        $messages = [
            '<a href="https://cloud.google.com/translate" target="_blank">' . t('Google Translate') . '</a> ' . t('is integrated directly within this administration panel.') . ' ' . t('Whenever you update a page that is missing a translation, the website will send the text available in other languages for Google to translate for you.'),

            // explain further as you wish

            // t('Translation works two-way, from Y to English and for English to Y. Just fill either field with the text you need and click the Update button. The website will find the empty fields and try to translate.'),
            // t('You can still edit the translated texts afterwards, if there is any text on the field the website won\'t overwrite.'),
            // t('You can use this feature in your advantage, whenever you make updates to any of the texts, erase the content on other languages, that way, when you update the page they will be translated again.')
        ];
        echo '<p>' . implode('</p><p>', $messages) . '</p>';
        echo '</div>';


        echo '<div class="help-block">';
        echo '<p class="title">' . t('Image Guidelines') . '</p>';
        $messages = [
            // t('Image captions are edited in the image itself.'),
            t('Always in JPG or PNG (never in TIFF, BMP or any other format).'),
            t('PNG only for vector images with few colors or if you need transparency. When in doubt, always use JPG.'),
            t('Remove any white borders on images.'),
            t('Preferably use the original images or in high quality, above 3600px in width or height. The server is the one who creates all the variations in size, so it is important to have available the images in good quality.'),
            t('Always use RGB images. Browsers do not represent CMYK colors correctly and they are not automatically converted.'),
        ];
        echo '<ul>';
        echo '<li>' . implode('</li><li>', $messages) . '</li>';
        echo '</ul>';
        echo '</div>';

        ?>
    </div>
</div>
