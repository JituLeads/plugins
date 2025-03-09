<?php
// Uninstall script
if (!defined('WP_UNINSTALL_PLUGIN')) {
    exit;
}

// Delete plugin options
delete_option('whatsapp_phone');
delete_option('whatsapp_message');
delete_option('whatsapp_image');
delete_option('enable_whatsapp');
delete_option('email_address');
delete_option('email_subject');
delete_option('email_body');
delete_option('email_image');
delete_option('enable_email');
delete_option('phone_number');
delete_option('phone_image');
delete_option('enable_phone');
delete_option('hook_position');
delete_option('custom_hook');
delete_option('custom_priority');