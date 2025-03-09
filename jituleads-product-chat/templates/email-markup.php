<?php
/* Markup for Email button functionality for JituLeads Product Chat plugin.
 * Description: Auto-update for dynamic chat buttons for WooCommerce product.
 * Version: 1.0.0
 * Author: JituLeads | Dicky Ibrohim
 */
// Email Button
if (get_option('enable_email')) {
    $email_subject = jituleads_get_email_subject();
    $email_body = jituleads_get_email_body();
    ?>
    <a class="marketing_link maillink" href="mailto:<?php echo esc_attr(get_option('email_address')); ?>?subject=<?php echo esc_attr(rawurlencode($email_subject)); ?>&body=<?php echo esc_attr(rawurlencode($email_body)); ?>">
        <div class="marketing_email">
            <div class="marketingjituleads_img">
                <img src="<?php echo esc_url(get_option('email_image')); ?>" alt="Email Icon" />
            </div>
            <div class="marketingjituleads_content">
                <span class="marketingjituleads_text"><?php _e("Sales", "jitu-leads"); ?></span>
                <span class="marketingjituleads_status"><?php _e("online", "jitu-leads"); ?></span>
                <span class="marketingjituleads_desc"><?php _e("Minat? Kirim Email", "jitu-leads"); ?></span>
            </div>
        </div>
    </a>
    <?php
}
?>