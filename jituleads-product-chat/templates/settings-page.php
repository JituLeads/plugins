<!-- Markup for Email button functionality for JituLeads Product Chat plugin.
 * Description: Auto-update for dynamic chat buttons for WooCommerce product.
 * Version: 1.0.0
 * Author: JituLeads | Dicky Ibrohim
 * --->
<div class="wrap">
    <h1><?php _e('JituLeads Product Chat Settings', 'jitu-leads'); ?></h1>
    <?php settings_errors(); ?> <!-- Menampilkan pesan error -->
    <form method="post" action="options.php">
        <?php
        settings_fields('jituleads_options_group');
        do_settings_sections('jituleads');
        ?>
        <table class="form-table">
            <!-- WhatsApp Settings -->
            <tr valign="top">
                <th scope="row"><?php _e('Enable WhatsApp', 'jitu-leads'); ?></th>
                <td>
                    <input type="checkbox" name="enable_whatsapp" value="1" <?php checked(get_option('enable_whatsapp'), 1); ?> />
                    <p class="description"><?php _e('Enable this option to display the WhatsApp chat button on product pages.', 'jitu-leads'); ?></p>
                </td>
            </tr>
            <tr valign="top" class="whatsapp-settings" style="display: <?php echo (get_option('enable_whatsapp') == 1) ? 'table-row' : 'none'; ?>;">
                <th scope="row"><?php _e('WhatsApp Phone Number', 'jitu-leads'); ?></th>
                <td>
                    <input type="text" name="whatsapp_phone" value="<?php echo esc_attr(get_option('whatsapp_phone')); ?>" <?php echo (get_option('enable_whatsapp') == 1) ? 'required' : ''; ?> />
                    <p class="description">
                        <?php _e('Enter the WhatsApp phone number with the country code (e.g., <strong>6281234567890</strong> for Indonesia). Do not include the "+" sign.', 'jitu-leads'); ?>
                    </p>
                    <?php if (get_settings_errors('whatsapp_phone')) : ?>
                        <p class="description" style="color: red;"><?php echo esc_html(get_settings_errors('whatsapp_phone')[0]['message']); ?></p>
                    <?php endif; ?>
                </td>
            </tr>
            <tr valign="top" class="whatsapp-settings" style="display: <?php echo (get_option('enable_whatsapp') == 1) ? 'table-row' : 'none'; ?>;">
                <th scope="row"><?php _e('WhatsApp Message', 'jitu-leads'); ?></th>
                <td>
                    <input type="text" name="whatsapp_message" value="<?php echo esc_attr(get_option('whatsapp_message')); ?>" />
                    <p class="description">
                        <?php _e('Enter the default message for WhatsApp. You can use dynamic placeholders like <strong>{site_title}</strong>, <strong>{product_name}</strong>, or <strong>{product_url}</strong>.', 'jitu-leads'); ?>
                        <br>
                        <?php _e('Example: <em>"Hello, I am interested in {product_name}. Can you provide more details?"</em>', 'jitu-leads'); ?>
                    </p>
                </td>
            </tr>
            <tr valign="top" class="whatsapp-settings" style="display: <?php echo (get_option('enable_whatsapp') == 1) ? 'table-row' : 'none'; ?>;">
                <th scope="row"><?php _e('WhatsApp Image URL', 'jitu-leads'); ?></th>
                <td>
                    <input type="url" name="whatsapp_image" value="<?php echo esc_attr(get_option('whatsapp_image')); ?>" />
                    <p class="description"><?php _e('Enter the URL of the image to be displayed for the WhatsApp button. Recommended size: 70x70 pixels.', 'jitu-leads'); ?></p>
                </td>
            </tr>

            <!-- Email Settings -->
            <tr valign="top">
                <th scope="row"><?php _e('Enable Email', 'jitu-leads'); ?></th>
                <td>
                    <input type="checkbox" name="enable_email" value="1" <?php checked(get_option('enable_email'), 1); ?> />
                    <p class="description"><?php _e('Enable this option to display the Email button on product pages.', 'jitu-leads'); ?></p>
                </td>
            </tr>
            <tr valign="top" class="email-settings" style="display: <?php echo (get_option('enable_email') == 1) ? 'table-row' : 'none'; ?>;">
                <th scope="row"><?php _e('Email Address', 'jitu-leads'); ?></th>
                <td>
                    <input type="email" name="email_address" value="<?php echo esc_attr(get_option('email_address')); ?>" <?php echo (get_option('enable_email') == 1) ? 'required' : ''; ?> />
                    <p class="description"><?php _e('Enter the email address where inquiries should be sent.', 'jitu-leads'); ?></p>
                    <?php if (get_settings_errors('email_address')) : ?>
                        <p class="description" style="color: red;"><?php echo esc_html(get_settings_errors('email_address')[0]['message']); ?></p>
                    <?php endif; ?>
                </td>
            </tr>
            <tr valign="top" class="email-settings" style="display: <?php echo (get_option('enable_email') == 1) ? 'table-row' : 'none'; ?>;">
                <th scope="row"><?php _e('Email Subject', 'jitu-leads'); ?></th>
                <td>
                    <input type="text" name="email_subject" value="<?php echo esc_attr(get_option('email_subject')); ?>" />
                    <p class="description">
                        <?php _e('Enter the subject for the email. You can use dynamic placeholders like <strong>{site_title}</strong>, <strong>{product_name}</strong>, or <strong>{product_url}</strong>.', 'jitu-leads'); ?>
                        <br>
                        <?php _e('Example: <em>"Inquiry about {product_name}"</em>', 'jitu-leads'); ?>
                    </p>
                </td>
            </tr>
            <tr valign="top" class="email-settings" style="display: <?php echo (get_option('enable_email') == 1) ? 'table-row' : 'none'; ?>;">
                <th scope="row"><?php _e('Email Body', 'jitu-leads'); ?></th>
                <td>
                    <textarea name="email_body"><?php echo esc_textarea(get_option('email_body')); ?></textarea>
                    <p class="description">
                        <?php _e('Enter the default content for the email. You can use dynamic placeholders like <strong>{site_title}</strong>, <strong>{product_name}</strong>, or <strong>{product_url}</strong>.', 'jitu-leads'); ?>
                        <br>
                        <?php _e('Example: <em>"Hello, I am interested in {product_name}. Can you provide more details? You can find the product here: {product_url}"</em>', 'jitu-leads'); ?>
                    </p>
                </td>
            </tr>
            <tr valign="top" class="email-settings" style="display: <?php echo (get_option('enable_email') == 1) ? 'table-row' : 'none'; ?>;">
                <th scope="row"><?php _e('Email Image URL', 'jitu-leads'); ?></th>
                <td>
                    <input type="url" name="email_image" value="<?php echo esc_attr(get_option('email_image')); ?>" />
                    <p class="description"><?php _e('Enter the URL of the image to be displayed for the Email button. Recommended size: 70x70 pixels.', 'jitu-leads'); ?></p>
                </td>
            </tr>

            <!-- Phone Settings -->
            <tr valign="top">
                <th scope="row"><?php _e('Enable Phone', 'jitu-leads'); ?></th>
                <td>
                    <input type="checkbox" name="enable_phone" value="1" <?php checked(get_option('enable_phone'), 1); ?> />
                    <p class="description"><?php _e('Enable this option to display the Phone button on product pages.', 'jitu-leads'); ?></p>
                </td>
            </tr>
            <tr valign="top" class="phone-settings" style="display: <?php echo (get_option('enable_phone') == 1) ? 'table-row' : 'none'; ?>;">
                <th scope="row"><?php _e('Phone Number', 'jitu-leads'); ?></th>
                <td>
                    <input type="text" name="phone_number" value="<?php echo esc_attr(get_option('phone_number')); ?>" <?php echo (get_option('enable_phone') == 1) ? 'required' : ''; ?> />
                    <p class="description"><?php _e('Enter the phone number with the country code (e.g., <strong>6281234567890</strong> for Indonesia). Do not include the "+" sign.', 'jitu-leads'); ?></p>
                    <?php if (get_settings_errors('phone_number')) : ?>
                        <p class="description" style="color: red;"><?php echo esc_html(get_settings_errors('phone_number')[0]['message']); ?></p>
                    <?php endif; ?>
                </td>
            </tr>
            <tr valign="top" class="phone-settings" style="display: <?php echo (get_option('enable_phone') == 1) ? 'table-row' : 'none'; ?>;">
                <th scope="row"><?php _e('Phone Image URL', 'jitu-leads'); ?></th>
                <td>
                    <input type="url" name="phone_image" value="<?php echo esc_attr(get_option('phone_image')); ?>" />
                    <p class="description"><?php _e('Enter the URL of the image to be displayed for the Phone button. Recommended size: 70x70 pixels.', 'jitu-leads'); ?></p>
                </td>
            </tr>

            <!-- Hook Position -->
            <tr valign="top">
                <th scope="row"><?php _e('Hook Position', 'jitu-leads'); ?></th>
                <td>
                    <select name="hook_position">
                        <option value="woocommerce_before_add_to_cart_form" <?php selected(get_option('hook_position'), 'woocommerce_before_add_to_cart_form'); ?>><?php _e('Before Add to Cart Form', 'jitu-leads'); ?></option>
                        <option value="woocommerce_single_product_summary" <?php selected(get_option('hook_position'), 'woocommerce_single_product_summary'); ?>><?php _e('Single Product Summary', 'jitu-leads'); ?></option>
                        <option value="woocommerce_before_add_to_cart_button" <?php selected(get_option('hook_position'), 'woocommerce_before_add_to_cart_button'); ?>><?php _e('Before Add to Cart Button', 'jitu-leads'); ?></option>
                        <option value="woocommerce_before_add_to_cart_quantity" <?php selected(get_option('hook_position'), 'woocommerce_before_add_to_cart_quantity'); ?>><?php _e('Before Add to Cart Quantity', 'jitu-leads'); ?></option>
                        <option value="woocommerce_after_add_to_cart_button" <?php selected(get_option('hook_position'), 'woocommerce_after_add_to_cart_button'); ?>><?php _e('After Add to Cart Button', 'jitu-leads'); ?></option>
                        <option value="woocommerce_after_add_to_cart_form" <?php selected(get_option('hook_position'), 'woocommerce_after_add_to_cart_form'); ?>><?php _e('After Add to Cart Form', 'jitu-leads'); ?></option>
                        <option value="woocommerce_product_meta_start" <?php selected(get_option('hook_position'), 'woocommerce_product_meta_start'); ?>><?php _e('Product Meta Start', 'jitu-leads'); ?></option>
                        <option value="woocommerce_product_meta_end" <?php selected(get_option('hook_position'), 'woocommerce_product_meta_end'); ?>><?php _e('Product Meta End', 'jitu-leads'); ?></option>
                        <option value="woocommerce_after_single_product_summary" <?php selected(get_option('hook_position'), 'woocommerce_after_single_product_summary'); ?>><?php _e('After Single Product Summary', 'jitu-leads'); ?></option>
                        <option value="woocommerce_after_single_product" <?php selected(get_option('hook_position'), 'woocommerce_after_single_product'); ?>><?php _e('After Single Product', 'jitu-leads'); ?></option>
                        <option value="custom" <?php selected(get_option('hook_position'), 'custom'); ?>><?php _e('Custom Hook', 'jitu-leads'); ?></option>
                    </select>
                    <p class="description"><?php _e('Choose where the chat buttons should be displayed on the product page.', 'jitu-leads'); ?></p>
                </td>
            </tr>

            <!-- Custom Hook and Priority -->
            <tr valign="top" class="custom-hook-settings" style="display: <?php echo (get_option('hook_position') == 'custom') ? 'table-row' : 'none'; ?>;">
                <th scope="row"><?php _e('Custom Hook', 'jitu-leads'); ?></th>
                <td>
                    <input type="text" name="custom_hook" value="<?php echo esc_attr(get_option('custom_hook')); ?>" />
                    <p class="description"><?php _e('Enter a custom hook name if you want to use a custom location for the chat buttons.', 'jitu-leads'); ?></p>
                </td>
            </tr>
            <tr valign="top" class="custom-hook-settings" style="display: <?php echo (get_option('hook_position') == 'custom') ? 'table-row' : 'none'; ?>;">
                <th scope="row"><?php _e('Custom Priority', 'jitu-leads'); ?></th>
                <td>
                    <input type="number" name="custom_priority" value="<?php echo esc_attr(get_option('custom_priority')); ?>" />
                    <p class="description"><?php _e('Enter the priority for the custom hook. Lower numbers have higher priority.', 'jitu-leads'); ?></p>
                </td>
            </tr>
        </table>
        <?php submit_button(); ?>
    </form>
</div>