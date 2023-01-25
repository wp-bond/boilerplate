<?php

use Bond\Settings\Html;


// Html::resetBodyClasses();
Html::cleanupHead();


Html::unwrapParagraphs();
// Html::h6Captions();


Html::disableEmojis();
Html::disableShortlink();
Html::disableWpEmbed();
Html::disableBlockLibrary();
Html::disableJetpackIncludes();
Html::disableAdminBar();
