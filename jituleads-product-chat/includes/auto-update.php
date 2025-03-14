<?php
/* Auto-update functionality for JituLeads Product Chat plugin.
 * Version: 1.0.0
 * Author: JituLeads | Dicky Ibrohim
 */
// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Enable auto-updates for the plugin from a custom server.
 */
function jituleads_check_for_updates($transient) {
    if (empty($transient->checked)) {
        return $transient;
    }

    // URL ke file JSON yang berisi informasi versi terbaru
    $remote_url = 'https://shop.jituleads.com/api/wp/update/jituleads-product-chat-updater.json';

    // Ambil data JSON dari server
    $remote_json = wp_remote_get($remote_url, array('timeout' => 10, 'headers' => array('Accept' => 'application/json')));

    if (is_wp_error($remote_json) || wp_remote_retrieve_response_code($remote_json) !== 200) {
        return $transient;
    }

    $remote_data = json_decode(wp_remote_retrieve_body($remote_json));

    // Periksa apakah versi terbaru tersedia
    if ($remote_data && version_compare($transient->checked['jituleads-product-chat/jituleads-product-chat.php'], $remote_data->version, '<')) {
        $transient->response['jituleads-product-chat/jituleads-product-chat.php'] = (object) array(
            'slug'        => 'jituleads-product-chat',
            'new_version' => $remote_data->version,
            'package'     => $remote_data->download_url,
            'tested'      => $remote_data->tested,
            'requires'    => $remote_data->requires,
        );
    }

    return $transient;
}
add_filter('site_transient_update_plugins', 'jituleads_check_for_updates');

/**
 * Add plugin information to the WordPress plugin details view.
 */
function jituleads_plugin_info($res, $action, $args) {
    if ($action !== 'plugin_information' || $args->slug !== 'jituleads-product-chat') {
        return $res;
    }

    // URL ke file JSON yang berisi informasi plugin
    $remote_url = 'https://shop.jituleads.com/api/wp/update/jituleads-product-chat-updater.json';

    // Ambil data JSON dari server
    $remote_json = wp_remote_get($remote_url, array('timeout' => 10, 'headers' => array('Accept' => 'application/json')));

    if (is_wp_error($remote_json) || wp_remote_retrieve_response_code($remote_json) !== 200) {
        return $res;
    }

    $remote_data = json_decode(wp_remote_retrieve_body($remote_json));

    if ($remote_data) {
        $res = (object) array(
            'name'          => 'JituLeads Product Chat',
            'slug'          => 'jituleads-product-chat',
            'version'       => $remote_data->version,
            'tested'        => $remote_data->tested,
            'requires'      => $remote_data->requires,
            'last_updated'  => $remote_data->last_updated,
            'author'        => $remote_data->author,
            'homepage'      => $remote_data->homepage,
            'download_link' => $remote_data->download_url,
            'sections'      => array(
                'description' => $remote_data->sections->description,
                'changelog'   => $remote_data->sections->changelog,
            ),
            'banners'       => array(
                'low'  => $remote_data->banners->low,
                'high' => $remote_data->banners->high,
            ),
            'icons'         => array(
                '1x' => $remote_data->icons->{'1x'},
                '2x' => $remote_data->icons->{'2x'},
            ),
            'faq'           => (array) $remote_data->faq, // Konversi objek FAQ ke array
        );
    }

    return $res;
}
add_filter('plugins_api', 'jituleads_plugin_info', 20, 3);
