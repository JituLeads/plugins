<?php
/* Custom Hook functionality for JituLeads Product Chat plugin.
 * Description: Change position with custom hook
 * Version: 1.0.0
 * Author: JituLeads | Dicky Ibrohim
 */
// Register hook position, custom hook, and custom priority settings
function jituleads_custom_hook_settings() {
    register_setting('jituleads_options_group', 'hook_position');
    register_setting('jituleads_options_group', 'custom_hook');
    register_setting('jituleads_options_group', 'custom_priority');
}
add_action('admin_init', 'jituleads_custom_hook_settings');

// Function to handle custom hook and priority
function jituleads_handle_custom_hook() {
    $hook_position = get_option('hook_position', 'woocommerce_before_add_to_cart_form');
    $custom_hook = get_option('custom_hook');
    $custom_priority = get_option('custom_priority', 30);

    // If custom hook is selected and custom hook is not empty
    if ($hook_position === 'custom' && !empty($custom_hook)) {
        add_action($custom_hook, function() {
            include JITULEADS_PLUGIN_DIR . 'templates/contact-info-markup.php';
        }, $custom_priority);
    } else {
        add_action($hook_position, function() {
            include JITULEADS_PLUGIN_DIR . 'templates/contact-info-markup.php';
        }, 30);
    }
}
//add_action('init', 'jituleads_handle_custom_hook');