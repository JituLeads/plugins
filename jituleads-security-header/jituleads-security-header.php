<?php
/**
 * Plugin Name: JituLeads Security Header
 * Plugin URI: https://shop.jituleads.com/
 * Description: Adds advanced security headers to WordPress for enhanced protection with customizable settings.
 * Version: 1.0.0
 * Author: JituLeads | Dicky Ibrohim
 * Author URI: https://shop.jituleads.com/
 * License: GPL2
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

// Define plugin constants
define('JITULEADS_SECURITY_PLUGIN_DIR', plugin_dir_path(__FILE__));
define('JITULEADS_SECURITY_PLUGIN_SLUG', 'jituleads-security-header');

// Include necessary files
require_once JITULEADS_SECURITY_PLUGIN_DIR . 'includes/auto-update.php';
require_once JITULEADS_SECURITY_PLUGIN_DIR . 'includes/security-headers.php';
require_once JITULEADS_SECURITY_PLUGIN_DIR . 'includes/admin-menu.php';

/**
 * Set default options on plugin activation.
 * By default, all headers are disabled.
 */
function jituleads_security_activate() {
    $default_options = array(
        'enable_all' => false,
        'headers'    => array(
            'strict_transport_security'    => array(
                'enabled' => false,
                'value'   => "max-age=63072000; includeSubDomains; preload"
            ),
            'x_content_type_options'         => array(
                'enabled' => false,
                'value'   => "nosniff"
            ),
            'x_frame_options'                => array(
                'enabled' => false,
                'value'   => "SAMEORIGIN"
            ),
            'referrer_policy'                => array(
                'enabled' => false,
                'value'   => "strict-origin-when-cross-origin"
            ),
            'access_control_allow_methods'   => array(
                'enabled' => false,
                'value'   => "GET, POST"
            ),
            'access_control_allow_headers'   => array(
                'enabled' => false,
                'value'   => "Content-Type, Authorization"
            ),
            'content_security_policy'        => array(
                'enabled' => false,
                'value'   => "upgrade-insecure-requests; default-src 'self'; script-src 'self' 'unsafe-inline' 'unsafe-eval'; style-src 'self' 'unsafe-inline'; img-src 'self' data:; font-src 'self'; object-src 'none'; frame-ancestors 'none'; base-uri 'self'"
            ),
            'cross_origin_embedder_policy'   => array(
                'enabled' => false,
                'value'   => "require-corp"
            ),
            'cross_origin_opener_policy'     => array(
                'enabled' => false,
                'value'   => "same-origin"
            ),
            'cross_origin_resource_policy'   => array(
                'enabled' => false,
                'value'   => "same-origin"
            ),
            'permissions_policy'             => array(
                'enabled' => false,
                'value'   => "accelerometer=(), autoplay=(), camera=(), geolocation=(), gyroscope=(), magnetometer=(), microphone=(), payment=(), usb=()"
            ),
            'x_permitted_cross_domain_policies' => array(
                'enabled' => false,
                'value'   => "none"
            )
        )
    );
    if (!get_option('jituleads_security_options')) {
        update_option('jituleads_security_options', $default_options);
    }
}
register_activation_hook(__FILE__, 'jituleads_security_activate');
