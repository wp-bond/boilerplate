<footer>

    <h4>Newsletter</h4>

    <?php
    $props = [
        'submitLabel' => t('Join')
    ];
    ?>
    <newsletter-form class="vue-app" v-bind="<?= esc_json($props) ?>"></newsletter-form>


</footer>
