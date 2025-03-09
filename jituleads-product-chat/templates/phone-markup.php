<?php
/* Markup for Phone button functionality for JituLeads Product Chat plugin.
 * Description: Auto-update for dynamic chat buttons for WooCommerce product.
 * Version: 1.0.0
 * Author: JituLeads | Dicky Ibrohim
 */
// Phone Button
if (get_option('enable_phone')) {
    ?>
    <a class="marketing_link tellink" href="tel:<?php echo esc_attr(get_option('phone_number')); ?>">
        <div class="marketing_telp">
            <div class="marketingjituleads_img">
                <img src="<?php echo esc_url(get_option('phone_image')); ?>" alt="Phone Icon" />
            </div>
            <div class="marketingjituleads_content">
                <span class="marketingjituleads_text"><?php _e("Sales", "jitu-leads"); ?></span>
                <span class="marketingjituleads_status"><?php _e("online", "jitu-leads"); ?></span>
                <span class="marketingjituleads_desc"><?php _e("Minat? Kirim Telp", "jitu-leads"); ?></span>
            </div>
        </div>
    </a>
    <?php
}

?>