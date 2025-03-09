<?php
/* WhatsApp button functionality for JituLeads Product Chat plugin.
 * Description: Auto-update for dynamic chat buttons for WooCommerce product.
 * Version: 1.0.0
 * Author: JituLeads | Dicky Ibrohim
 */
// WhatsApp settings and functionality
function jituleads_whatsapp_settings() {
    register_setting(
        'jituleads_options_group', // Option group
        'whatsapp_phone',          // Option name
        'jituleads_validate_whatsapp_phone' // Validation callback
    );
    register_setting('jituleads_options_group', 'whatsapp_message');
    register_setting('jituleads_options_group', 'whatsapp_image');
    register_setting('jituleads_options_group', 'enable_whatsapp');
}
add_action('admin_init', 'jituleads_whatsapp_settings');

// Validation function for WhatsApp phone number
function jituleads_validate_whatsapp_phone($input) {
    // Jika WhatsApp diaktifkan, validasi nomor telepon
    if (isset($_POST['enable_whatsapp']) && $_POST['enable_whatsapp'] == 1) {
        if (empty($input)) {
            add_settings_error(
                'whatsapp_phone', // Slug title of the setting
                'whatsapp_phone_error', // Error ID
                __('WhatsApp Phone Number is required.', 'jitu-leads'), // Error message
                'error' // Type of message (error, success, warning, info)
            );
            // Kembalikan nilai sebelumnya jika validasi gagal
            return get_option('whatsapp_phone');
        }
    }
    // Jika validasi berhasil, kembalikan nilai input
    return sanitize_text_field($input);
}

// Fungsi untuk mendapatkan pesan WhatsApp dengan shortcode yang diganti
function jituleads_get_whatsapp_message() {
    $message = get_option('whatsapp_message', 'Hello, I am interested in {product_name}.');
    return jituleads_replace_shortcodes($message);
}

function jituleads_add_whatsapp_css() {
    if (get_option('enable_whatsapp')) {
        include JITULEADS_PLUGIN_DIR . 'templates/whatsapp-css.php';
    }
}
add_action('wp_head', 'jituleads_add_whatsapp_css');