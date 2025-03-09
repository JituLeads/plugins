/* JS for Product Chat - Backend
 * Description: Style for dynamic chat buttons for WooCommerce product pages with custom fields for contact options.
 * Version: 1.0.0
 * Author: JituLeads | Dicky Ibrohim
 */
jQuery(document).ready(function($) {
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