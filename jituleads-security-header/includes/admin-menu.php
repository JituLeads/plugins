<?php
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Add the admin menu page under Settings.
 */
function jituleads_security_add_admin_menu() {
    add_options_page(
        'JituLeads Security Header Settings',
        'Security Header Settings',
        'manage_options',
        'jituleads-security-header',
        'jituleads_security_options_page'
    );
}
add_action('admin_menu', 'jituleads_security_add_admin_menu');

/**
 * Process and save the settings form submission.
 */
function jituleads_security_handle_form_submission() {
    // Verify user capability.
    if (!current_user_can('manage_options')) {
        return;
    }
    
    // Check nonce for security.
    if (!isset($_POST['jituleads_security_nonce']) || !wp_verify_nonce($_POST['jituleads_security_nonce'], 'jituleads_security_save_options')) {
        return;
    }
    
    // Daftar header keys.
    $default_headers = array(
        'strict_transport_security',
        'x_content_type_options',
        'x_frame_options',
        'referrer_policy',
        'access_control_allow_methods',
        'access_control_allow_headers',
        'content_security_policy',
        'cross_origin_embedder_policy',
        'cross_origin_opener_policy',
        'cross_origin_resource_policy',
        'permissions_policy',
        'x_permitted_cross_domain_policies'
    );
    
    $options = array();
    $options['enable_all'] = (isset($_POST['enable_all']) && $_POST['enable_all'] == '1') ? true : false;
    $options['headers']   = array();
    
    // Loop untuk setiap header: gunakan wp_unslash untuk menghindari penambahan backslashes.
    foreach ($default_headers as $header_key) {
        $enabled = (isset($_POST[$header_key . '_enabled']) && $_POST[$header_key . '_enabled'] == '1') ? true : false;
        $value   = isset($_POST[$header_key . '_value']) ? sanitize_text_field(wp_unslash($_POST[$header_key . '_value'])) : '';
        $options['headers'][$header_key] = array(
            'enabled' => $enabled,
            'value'   => $value
        );
    }
    
    update_option('jituleads_security_options', $options);
    
    // Redirect kembali ke halaman settings.
    wp_redirect(add_query_arg('page', 'jituleads-security-header', admin_url('options-general.php')));
    exit;
}
add_action('admin_post_jituleads_security_save', 'jituleads_security_handle_form_submission');

/**
 * Reset options to default values.
 */
function jituleads_security_reset_options() {
    $default_options = array(
        'enable_all' => false,
        'headers'    => array(
            'strict_transport_security'    => array('enabled' => false, 'value' => "max-age=63072000; includeSubDomains; preload"),
            'x_content_type_options'         => array('enabled' => false, 'value' => "nosniff"),
            'x_frame_options'                => array('enabled' => false, 'value' => "SAMEORIGIN"),
            'referrer_policy'                => array('enabled' => false, 'value' => "strict-origin-when-cross-origin"),
            'access_control_allow_methods'   => array('enabled' => false, 'value' => "GET, POST"),
            'access_control_allow_headers'   => array('enabled' => false, 'value' => "Content-Type, Authorization"),
            'content_security_policy'        => array('enabled' => false, 'value' => "upgrade-insecure-requests; default-src 'self'; script-src 'self' 'unsafe-inline' 'unsafe-eval'; style-src 'self' 'unsafe-inline'; img-src 'self' data:; font-src 'self'; object-src 'none'; frame-ancestors 'none'; base-uri 'self'"),
            'cross_origin_embedder_policy'   => array('enabled' => false, 'value' => "require-corp"),
            'cross_origin_opener_policy'     => array('enabled' => false, 'value' => "same-origin"),
            'cross_origin_resource_policy'   => array('enabled' => false, 'value' => "same-origin"),
            'permissions_policy'             => array('enabled' => false, 'value' => "accelerometer=(), autoplay=(), camera=(), geolocation=(), gyroscope=(), magnetometer=(), microphone=(), payment=(), usb=()"),
            'x_permitted_cross_domain_policies' => array('enabled' => false, 'value' => "none"),
        )
    );
    update_option('jituleads_security_options', $default_options);
}

/**
 * Handle reset action.
 */
function jituleads_security_reset_handler() {
    if (!current_user_can('manage_options')) {
        return;
    }
    check_admin_referer('jituleads_security_reset_options');
    jituleads_security_reset_options();
    wp_redirect(add_query_arg('page', 'jituleads-security-header', admin_url('options-general.php')));
    exit;
}
add_action('admin_post_jituleads_security_reset', 'jituleads_security_reset_handler');

/**
 * Display the admin settings page.
 */
function jituleads_security_options_page() {
    // Retrieve current options.
    $options = get_option('jituleads_security_options');
    if (!$options) {
        $options = array(
            'enable_all' => false,
            'headers'    => array(
                'strict_transport_security'    => array('enabled' => false, 'value' => "max-age=63072000; includeSubDomains; preload"),
                'x_content_type_options'         => array('enabled' => false, 'value' => "nosniff"),
                'x_frame_options'                => array('enabled' => false, 'value' => "SAMEORIGIN"),
                'referrer_policy'                => array('enabled' => false, 'value' => "strict-origin-when-cross-origin"),
                'access_control_allow_methods'   => array('enabled' => false, 'value' => "GET, POST"),
                'access_control_allow_headers'   => array('enabled' => false, 'value' => "Content-Type, Authorization"),
                'content_security_policy'        => array('enabled' => false, 'value' => "upgrade-insecure-requests; default-src 'self'; script-src 'self' 'unsafe-inline' 'unsafe-eval'; style-src 'self' 'unsafe-inline'; img-src 'self' data:; font-src 'self'; object-src 'none'; frame-ancestors 'none'; base-uri 'self'"),
                'cross_origin_embedder_policy'   => array('enabled' => false, 'value' => "require-corp"),
                'cross_origin_opener_policy'     => array('enabled' => false, 'value' => "same-origin"),
                'cross_origin_resource_policy'   => array('enabled' => false, 'value' => "same-origin"),
                'permissions_policy'             => array('enabled' => false, 'value' => "accelerometer=(), autoplay=(), camera=(), geolocation=(), gyroscope=(), magnetometer=(), microphone=(), payment=(), usb=()"),
                'x_permitted_cross_domain_policies' => array('enabled' => false, 'value' => "none"),
            )
        );
    }
    ?>
    <div class="wrap">
        <h1>JituLeads Security Header Settings</h1>
        <form method="post" action="<?php echo admin_url('admin-post.php'); ?>">
            <?php wp_nonce_field('jituleads_security_save_options', 'jituleads_security_nonce'); ?>
            <input type="hidden" name="action" value="jituleads_security_save">
            
            <!-- Global Settings: Activate All -->
            <h2>Global Settings</h2>
            <p>
                <label for="enable_all">
                    <input type="checkbox" id="enable_all" name="enable_all" value="1" <?php checked($options['enable_all'], true); ?> />
                    Activate All Security Headers
                </label>
            </p>
            <p style="color:red;">
                Warning: Activating all headers without proper configuration may cause issues with site functionality. Please review each header's settings below.
            </p>
            
            <hr />
            
            <!-- Custom Header Settings -->
            <h2>Custom Security Headers Configuration</h2>
            <?php
            // Header definitions
            $headers_info = array(
                'strict_transport_security' => array(
                    'label'       => 'Strict-Transport-Security',
                    'description' => 'Enforces secure (HTTPS) connections. Example: max-age=63072000; includeSubDomains; preload. Tip: Ensure your site has a valid SSL certificate before enabling.'
                ),
                'x_content_type_options' => array(
                    'label'       => 'X-Content-Type-Options',
                    'description' => 'Prevents MIME-type sniffing. Example: nosniff. Tip: Essential for avoiding content-type confusion attacks.'
                ),
                'x_frame_options' => array(
                    'label'       => 'X-Frame-Options',
                    'description' => 'Controls framing of your site. Example: SAMEORIGIN. Tip: Use SAMEORIGIN to help prevent clickjacking.'
                ),
                'referrer_policy' => array(
                    'label'       => 'Referrer-Policy',
                    'description' => 'Governs referral information. Example: strict-origin-when-cross-origin. Tip: Protect sensitive referral data.'
                ),
                'access_control_allow_methods' => array(
                    'label'       => 'Access-Control-Allow-Methods',
                    'description' => 'Specifies allowed HTTP methods. Example: GET, POST. Tip: Limit methods to those necessary for your site.'
                ),
                'access_control_allow_headers' => array(
                    'label'       => 'Access-Control-Allow-Headers',
                    'description' => 'Specifies allowed HTTP headers. Example: Content-Type, Authorization. Tip: Only allow essential headers.'
                ),
                'content_security_policy' => array(
                    'label'       => 'Content-Security-Policy',
                    'description' => 'Mitigates XSS and other attacks. Example: upgrade-insecure-requests; default-src \'self\'; script-src \'self\' \'unsafe-inline\' \'unsafe-eval\'; style-src \'self\' \'unsafe-inline\'; img-src \'self\' data:; font-src \'self\'; object-src \'none\'; frame-ancestors \'none\'; base-uri \'self\'. Tip: Tailor the policy to match your site’s resources.'
                ),
                'cross_origin_embedder_policy' => array(
                    'label'       => 'Cross-Origin-Embedder-Policy',
                    'description' => 'Ensures proper handling of cross-origin resources. Example: require-corp. Tip: Enhances content isolation.'
                ),
                'cross_origin_opener_policy' => array(
                    'label'       => 'Cross-Origin-Opener-Policy',
                    'description' => 'Prevents sharing a browsing context with cross-origin documents. Example: same-origin. Tip: Useful for sensitive applications.'
                ),
                'cross_origin_resource_policy' => array(
                    'label'       => 'Cross-Origin-Resource-Policy',
                    'description' => 'Restricts resource sharing. Example: same-origin. Tip: Helps prevent unauthorized cross-origin access.'
                ),
                'permissions_policy' => array(
                    'label'       => 'Permissions-Policy',
                    'description' => 'Controls access to browser features. Example: accelerometer=(), autoplay=(), camera=(), geolocation=(), gyroscope=(), magnetometer=(), microphone=(), payment=(), usb=(). Tip: Only enable features that are necessary.'
                ),
                'x_permitted_cross_domain_policies' => array(
                    'label'       => 'X-Permitted-Cross-Domain-Policies',
                    'description' => 'Regulates cross-domain policies for Flash/Acrobat. Example: none. Tip: Set to none unless cross-domain policies are required.'
                ),
            );
            
            // Loop untuk membuat field untuk masing-masing header.
            foreach ($headers_info as $key => $info) {
                $current_enabled = isset($options['headers'][$key]['enabled']) ? $options['headers'][$key]['enabled'] : false;
                $current_value   = isset($options['headers'][$key]['value']) ? $options['headers'][$key]['value'] : '';
                ?>
                <fieldset style="margin-bottom:20px; padding:10px; border:1px solid #ccc;">
                    <legend><strong><?php echo esc_html($info['label']); ?></strong></legend>
                    <p>
                        <label for="<?php echo esc_attr($key); ?>_enabled">
                            <input type="checkbox" id="<?php echo esc_attr($key); ?>_enabled" name="<?php echo esc_attr($key); ?>_enabled" value="1" <?php checked($current_enabled, true); ?> />
                            Enable <?php echo esc_html($info['label']); ?>
                        </label>
                    </p>
                    <p>
                        <label for="<?php echo esc_attr($key); ?>_value">Header Value:</label><br/>
                        <input type="text" id="<?php echo esc_attr($key); ?>_value" name="<?php echo esc_attr($key); ?>_value" value="<?php echo esc_attr($current_value); ?>" style="width:100%;" />
                    </p>
                    <p><em><?php echo esc_html($info['description']); ?></em></p>
                </fieldset>
                <?php
            }
            ?>
            <p>
                <input type="submit" class="button-primary" value="Save Settings" />
            </p>
        </form>
        
        <!-- Reset Form -->
        <form method="post" action="<?php echo admin_url('admin-post.php'); ?>" onsubmit="return confirm('Are you sure you want to reset all settings to default?');" style="margin-top:20px;">
            <?php wp_nonce_field('jituleads_security_reset_options'); ?>
            <input type="hidden" name="action" value="jituleads_security_reset">
            <input type="submit" class="button-secondary" value="Reset to Default Settings" />
        </form>
    </div>
    
    <!-- JavaScript for interactivity -->
    <script>
    document.addEventListener("DOMContentLoaded", function() {
        const globalCheckbox = document.getElementById('enable_all');
        const headerCheckboxes = document.querySelectorAll('input[type="checkbox"][id$="_enabled"]');
        
        // handle checkbox check all
        globalCheckbox.addEventListener('change', function() {
            headerCheckboxes.forEach(function(chk) {
                chk.checked = globalCheckbox.checked;
            });
        });
        
        // handle checkbox
        headerCheckboxes.forEach(function(chk) {
            chk.addEventListener('change', function() {
                if (!chk.checked) {
                    globalCheckbox.checked = false;
                } else {
                    let allChecked = true;
                    headerCheckboxes.forEach(function(c) {
                        if (!c.checked) { allChecked = false; }
                    });
                    globalCheckbox.checked = allChecked;
                }
            });
        });
    });
    </script>
    <?php
}