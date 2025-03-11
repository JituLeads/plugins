<?php
if (!defined('WP_UNINSTALL_PLUGIN')) {
    exit;
}

// remove from database
delete_option('jituleads_security_options');