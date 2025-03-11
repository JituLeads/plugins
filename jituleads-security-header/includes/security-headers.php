<?php
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Output security headers based on plugin settings.
 *
 * If the global "Activate All" is enabled, all headers are applied.
 * Otherwise, only headers that are individually enabled are applied.
 */
function jituleads_optimized_security_headers() {
    $options = get_option('jituleads_security_options');
    if (!$options || !isset($options['headers']) || !is_array($options['headers'])) {
        return;
    }
    
    // Mapping from option key to header name.
    $headers_mapping = array(
        'strict_transport_security'       => 'Strict-Transport-Security',
        'x_content_type_options'            => 'X-Content-Type-Options',
        'x_frame_options'                   => 'X-Frame-Options',
        'referrer_policy'                   => 'Referrer-Policy',
        'access_control_allow_methods'      => 'Access-Control-Allow-Methods',
        'access_control_allow_headers'      => 'Access-Control-Allow-Headers',
        'content_security_policy'           => 'Content-Security-Policy',
        'cross_origin_embedder_policy'      => 'Cross-Origin-Embedder-Policy',
        'cross_origin_opener_policy'        => 'Cross-Origin-Opener-Policy',
        'cross_origin_resource_policy'      => 'Cross-Origin-Resource-Policy',
        'permissions_policy'                => 'Permissions-Policy',
        'x_permitted_cross_domain_policies' => 'X-Permitted-Cross-Domain-Policies'
    );
    
    // Remove any headers that may have already been set to avoid conflicts.
    foreach ($headers_mapping as $header_name) {
        header_remove($header_name);
    }
    
    // Loop through each header and apply if:
    // - Global "Activate All" is enabled, or
    // - The individual header option is enabled.
    foreach ($headers_mapping as $key => $header_name) {
        $apply = false;
        if ( isset($options['enable_all']) && $options['enable_all'] ) {
            // If global is active, apply the header regardless of its value.
            $apply = true;
        } elseif ( isset($options['headers'][$key]['enabled']) && $options['headers'][$key]['enabled'] ) {
            // If global is not active, apply only if the individual header is enabled.
            $apply = true;
        }
        
        if ($apply) {
            $value = isset($options['headers'][$key]['value']) ? trim($options['headers'][$key]['value']) : '';
            if (!empty($value)) {
                header("{$header_name}: {$value}");
            }
        }
    }
}
add_action('send_headers', 'jituleads_optimized_security_headers');