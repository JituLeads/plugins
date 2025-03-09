<?php
/**
 * Plugin Name: JituLeads Product Chat
 * Plugin URI: https://www.jituleads.com/
 * Description: A plugin to add dynamic chat buttons for WooCommerce product pages with custom fields for contact options.
 * Version: 1.0.2
 * Author: JituLeads | Dicky Ibrohim
 * Author URI: https://www.jituleads.com/
 * Text Domain: jitu-leads
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

// Define plugin constants
define('JITULEADS_PLUGIN_DIR', plugin_dir_path(__FILE__));
define('JITULEADS_PLUGIN_URL', plugin_dir_url(__FILE__));
define('JITULEADS_PLUGIN_SLUG', 'jituleads-product-chat'); // Plugin slug

// Include necessary files
require_once JITULEADS_PLUGIN_DIR . 'includes/whatsapp.php';
require_once JITULEADS_PLUGIN_DIR . 'includes/email.php';
require_once JITULEADS_PLUGIN_DIR . 'includes/phone.php';
require_once JITULEADS_PLUGIN_DIR . 'includes/custom-hook.php';
require_once JITULEADS_PLUGIN_DIR . 'includes/shortcodes.php';
// Include auto-update functionality
require_once JITULEADS_PLUGIN_DIR . 'includes/auto-update.php';
// Register plugin settings page
function jituleads_register_settings_page() {
    add_menu_page(
        __('JituLeads Settings', 'jitu-leads'),
        __('JituLeads Settings', 'jitu-leads'),
        'manage_options',
        'jituleads-product-chat',
        'jituleads_settings_page',
        'dashicons-admin-generic',
        80
    );
}
add_action('admin_menu', 'jituleads_register_settings_page');

// Display settings page in admin
function jituleads_settings_page() {
    include JITULEADS_PLUGIN_DIR . 'templates/settings-page.php';
}

// Enqueue scripts and styles
function jituleads_enqueue_scripts() {
    wp_enqueue_style('jitu-leads-style', JITULEADS_PLUGIN_URL . 'assets/css/style.css');
    wp_enqueue_script('jitu-leads-script', JITULEADS_PLUGIN_URL . 'assets/js/script.js', array('jquery'), null, true);
    wp_enqueue_style('jitu-leads-admin-style', JITULEADS_PLUGIN_URL . 'assets/css/admin-style.css');
}
//add_action('wp_enqueue_scripts', 'jituleads_enqueue_scripts');
add_action('admin_enqueue_scripts', 'jituleads_enqueue_scripts');
// Admin CSS to manage dynamic fields only on the "jituleads-product-chat" settings page
function jituleads_admin_styles() {
    // Check if the current page is the "jituleads-product-chat" settings page
    $screen = get_current_screen();
    if ( isset($screen->id) && $screen->id === 'toplevel_page_jituleads-product-chat' ) {
        ?>
        <style>
            .wrap {
                background-color: #1e1e1e;
                color: #fff;
                padding: 20px;
                border-radius: 8px;
            }
            .form-table th, .form-wrap label {
                color: #fff;
            }
            h1 {
                color: yellow;
                font-size: 32px;
            }
            .form-table th {
                font-size: 16px;
                padding-right: 20px;
            }
            .form-table td input, .form-table td textarea {
                width: 100%;
                padding: 10px;
                background-color: #333;
                border: 1px solid #555;
                border-radius: 5px;
                color: #fff;
            }
            input[type="checkbox"] {
                margin-top: 10px;
            }
            .form-table td input[type="color"] {
                width: 50px;
            }
            input[type="submit"] {
                background-color: yellow;
                border: none;
                color: white;
                padding: 10px 20px;
                border-radius: 5px;
                cursor: pointer;
            }
            input[type="submit"]:hover {
                background-color: #ff784d;
            }

            /* Toggle Switch Style */
            input[type="checkbox"] {
                -webkit-appearance: none;
                -moz-appearance: none;
                appearance: none;
                width: 50px;
                height: 25px;
                background-color: #ccc;
                border-radius: 50px;
                position: relative;
                transition: all 0.3s ease;
            }

            /* Circle within the checkbox */
            input[type="checkbox"]:before {
                content: '';
                position: absolute;
                top: 2px;
                left: 2px;
                width: 21px;
                height: 21px;
                background-color: white;
                border-radius: 50%;
                transition: all 0.3s ease;
            }

            /* When checkbox is checked (on state) */
            input[type="checkbox"]:checked {
                background-color: #FFEB3B; /* Yellow color */
            }

            /* Move the circle to the right when checked */
            input[type="checkbox"]:checked:before {
                left: calc(100% - 23px);
            }
			
            /* Optional: Hover effect */
            input[type="checkbox"]:hover {
                background-color: #f0f0f0;
            }

            input[type="checkbox"] {
                height: 30px;
                width: 60px !important;
                border-radius: 8px !important;
            }

            input[type="checkbox"]:checked::before {
                height: 27px;
                width: 27px;
                background: white;
            }
			.wp-core-ui .button-primary, .wp-core-ui .button-primary {
				box-shadow: 0 0 0 1px #40cd00, 0 0 0 3px #40cd00 !important;
				background: #40cd00 !important;
				color: black !important;
			}
			 .wp-core-ui .button-primary.focus, .wp-core-ui .button-primary:focus, .wp-core-ui .button-primary:hover {
				box-shadow: 0 0 0 1px #36a106, 0 0 0 3px #36a106 !important;
				background: #36a106 !important;
				color: black !important;
			}
            .settings-error {
                color: red;
            }
            .notice-success {
                color: darkgreen;
            }
        </style>
        <script>
            jQuery(document).ready(function($){
                function toggleSettings() {
                    if ($('input[name="enable_whatsapp"]').is(':checked')) {
                        $('.whatsapp-settings').show();
                    } else {
                        $('.whatsapp-settings').hide();
                    }

                    if ($('input[name="enable_email"]').is(':checked')) {
                        $('.email-settings').show();
                    } else {
                        $('.email-settings').hide();
                    }

                    if ($('input[name="enable_phone"]').is(':checked')) {
                        $('.phone-settings').show();
                    } else {
                        $('.phone-settings').hide();
                    }

                    if ($('select[name="hook_position"]').val() === 'custom') {
                        $('.custom-hook-settings').show();
                    } else {
                        $('.custom-hook-settings').hide();
                    }
                }
                toggleSettings();  // Initial check

                $('input[type="checkbox"], select[name="hook_position"]').on('change', function() {
                    toggleSettings();
                });
            });
        </script>
        <?php
    }
}
add_action('admin_head', 'jituleads_admin_styles');
// Shortcode to display contact info
function jituleads_contact_info_shortcode() {
    ob_start();
    include JITULEADS_PLUGIN_DIR . 'templates/contact-info-markup.php';
    return ob_get_clean();
}
add_shortcode('jituleads_marketing', 'jituleads_contact_info_shortcode');

// Hook the function to WooCommerce based on selected hook position
function jituleads_add_chat_marketing() {
    $hook_position = get_option('hook_position', 'woocommerce_before_add_to_cart_form');
    $custom_hook = get_option('custom_hook');
    $custom_priority = get_option('custom_priority', 30);

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
add_action('init', 'jituleads_add_chat_marketing');