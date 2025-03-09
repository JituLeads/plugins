<?php
/* Shortcode functionality for JituLeads Product Chat plugin.
 * Description: Auto-update for dynamic chat buttons for WooCommerce product.
 * Version: 1.0.0
 * Author: JituLeads | Dicky Ibrohim
 */
// Fungsi untuk mengganti shortcode dengan nilai dinamis
function jituleads_replace_shortcodes($text) {
    global $post, $product;

    // Daftar shortcode yang didukung
    $shortcodes = array(
        '{site_title}' => get_bloginfo('name'), // Judul situs
        '{site_url}' => get_bloginfo('url'), // URL situs
        '{page_title}' => get_the_title($post->ID), // Judul halaman saat ini
        '{page_url}' => get_permalink($post->ID), // URL halaman saat ini
        '{product_name}' => is_a($product, 'WC_Product') ? $product->get_name() : '', // Nama produk (jika di halaman produk WooCommerce)
        '{product_url}' => is_a($product, 'WC_Product') ? get_permalink($product->get_id()) : '', // URL produk (jika di halaman produk WooCommerce)
    );

    // Ganti shortcode dengan nilai yang sesuai
    foreach ($shortcodes as $shortcode => $value) {
        $text = str_replace($shortcode, $value, $text);
    }

    return $text;
}