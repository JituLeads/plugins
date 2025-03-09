<?php
/* Markup for WhatsApp button functionality for JituLeads Product Chat plugin.
 * Description: Auto-update for dynamic chat buttons for WooCommerce product.
 * Version: 1.0.0
 * Author: JituLeads | Dicky Ibrohim
 */
// WhatsApp Button
if (get_option('enable_whatsapp')) {
    $whatsapp_message = jituleads_get_whatsapp_message();
    ?>
    <a class="marketing_link walink" target="_blank" href="https://wa.me/<?php echo esc_attr(get_option('whatsapp_phone')); ?>?text=<?php echo esc_attr(rawurlencode($whatsapp_message)); ?>" rel="nofollow noopener noreferrer">
        <div class="marketing_wa">
            <div class="marketingjituleads_img">
                <img src="<?php echo esc_url(get_option('whatsapp_image')); ?>" alt="WhatsApp Icon" />
            </div>
            <div class="marketingjituleads_content">
                <span class="marketingjituleads_text"><?php _e("Sales", "jitu-leads"); ?></span>
                <span class="marketingjituleads_status"><?php _e("online", "jitu-leads"); ?></span>
                <span class="marketingjituleads_desc"><?php _e("Minat? Chat", "jitu-leads"); ?></span>
            </div>
        </div>
    </a>
    <?php
}
?>