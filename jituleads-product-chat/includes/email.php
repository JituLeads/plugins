<?php
/* Email button functionality for JituLeads Product Chat plugin.
 * Description: Auto-update for dynamic chat buttons for WooCommerce product.
 * Version: 1.0.0
 * Author: JituLeads | Dicky Ibrohim
 */
// Email settings and functionality
function jituleads_email_settings() {
    register_setting(
        'jituleads_options_group', // Option group
        'email_address',          // Option name
        'jituleads_validate_email_address' // Validation callback
    );
    register_setting('jituleads_options_group', 'email_subject');
    register_setting('jituleads_options_group', 'email_body');
    register_setting('jituleads_options_group', 'email_image');
    register_setting('jituleads_options_group', 'enable_email');
}
add_action('admin_init', 'jituleads_email_settings');

// Validation function for Email Address
function jituleads_validate_email_address($input) {
    // Jika Email diaktifkan, validasi alamat email
    if (isset($_POST['enable_email']) && $_POST['enable_email'] == 1) {
        if (empty($input)) {
            add_settings_error(
                'email_address', // Slug title of the setting
                'email_address_error', // Error ID
                __('Email Address is required.', 'jitu-leads'), // Error message
                'error' // Type of message (error, success, warning, info)
            );
            // Kembalikan nilai sebelumnya jika validasi gagal
            return get_option('email_address');
        }
    }
    // Jika validasi berhasil, kembalikan nilai input
    return sanitize_email($input);
}

// Fungsi untuk mendapatkan subjek email dengan shortcode yang diganti
function jituleads_get_email_subject() {
    $subject = get_option('email_subject', 'Interested in {product_name}');
    return jituleads_replace_shortcodes($subject);
}

// Fungsi untuk mendapatkan konten email dengan shortcode yang diganti
function jituleads_get_email_body() {
    $body = get_option('email_body', 'Hello, I am interested in {product_name}. You can find the product here: {product_url}');
    return jituleads_replace_shortcodes($body);
}
function jituleads_add_email_css() {
    if (get_option('enable_email')) {
        include JITULEADS_PLUGIN_DIR . 'templates/email-css.php';
    }
}
add_action('wp_head', 'jituleads_add_email_css');