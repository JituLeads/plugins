
<div class="marketingjituleads">
    <?php
    if (get_option('enable_whatsapp')) {
        include JITULEADS_PLUGIN_DIR . 'templates/whatsapp-markup.php';
    }
    if (get_option('enable_email')) {
        include JITULEADS_PLUGIN_DIR . 'templates/email-markup.php';
    }
    if (get_option('enable_phone')) {
        include JITULEADS_PLUGIN_DIR . 'templates/phone-markup.php';
    }
    ?>
</div>