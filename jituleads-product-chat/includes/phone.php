<?php
/* Phone button functionality for JituLeads Product Chat plugin.
 * Description: Auto-update for dynamic chat buttons for WooCommerce product.
 * Version: 1.0.0
 * Author: JituLeads | Dicky Ibrohim
 */
// Phone settings and functionality
function jituleads_phone_settings() {
    register_setting(
        'jituleads_options_group', // Option group
        'phone_number',          // Option name
        'jituleads_validate_phone_number' // Validation callback
    );
    register_setting('jituleads_options_group', 'phone_image');
    register_setting('jituleads_options_group', 'enable_phone');
}
add_action('admin_init', 'jituleads_phone_settings');

// Validation function for Phone Number
function jituleads_validate_phone_number($input) {
    // Jika Phone diaktifkan, validasi nomor telepon
    if (isset($_POST['enable_phone']) && $_POST['enable_phone'] == 1) {
        if (empty($input)) {
            add_settings_error(
                'phone_number', // Slug title of the setting
                'phone_number_error', // Error ID
                __('Phone Number is required.', 'jitu-leads'), // Error message
                'error' // Type of message (error, success, warning, info)
            );
            // Kembalikan nilai sebelumnya jika validasi gagal
            return get_option('phone_number');
        }
    }
    // Jika validasi berhasil, kembalikan nilai input
    return sanitize_text_field($input);
}

function jituleads_add_phone_css() {
    if (get_option('enable_phone')) {
        include JITULEADS_PLUGIN_DIR . 'templates/phone-css.php';
    }
}
add_action('wp_head', 'jituleads_add_phone_css');