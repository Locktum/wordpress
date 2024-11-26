<?php

/*
Plugin Name: Vanilla Lazyload
*/

function find_and_replace($atts, $attachment) {
    if (isset($atts['class'])) {
        $atts['class'] = 'lazy';
    }

    if (isset($atts['src'])) {
        $atts['data-src'] = $atts['src'];
        unset($atts['src']);
    }

    return $atts;
}
add_filter('wp_get_attachment_image_attributes', 'find_and_replace', 10, 2);

function enqueue_lazy_load_script() {
    wp_enqueue_script('lazyload', 'https://cdn.jsdelivr.net/npm/vanilla-lazyload@latest', array(), null, true);
    wp_add_inline_script('lazyload', 'document.addEventListener("DOMContentLoaded", function() { new LazyLoad({ elements_selector: ".lazy" }); });');
}
add_action('wp_enqueue_scripts', 'enqueue_lazy_load_script');

?>
