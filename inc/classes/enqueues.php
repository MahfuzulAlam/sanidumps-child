<?php

/**
 * @author  wpWax
 * @since   1.0
 * @version 1.0
 */

class Sanidump_Enqueues
{

    public function __construct()
    {
        // Dplace Child Theme Style
        add_action('wp_enqueue_scripts', array($this, 'sanidump_new_styles'));
        // Dplace Child Theme Style
        add_action('wp_print_scripts', array($this, 'sanidump_bbd_inspect_scripts'));
        // Dplace child theme setup
        add_action('wp_enqueue_scripts', array($this, 'sanidump_custom_google_map_scripts'));
    }

    /**
     * Dplace Child Theme Style
     */
    public function sanidump_bbd_inspect_scripts()
    {
        if (!is_admin()) {
            wp_dequeue_script('directorist-google-map');
            wp_deregister_script('directorist-google-map');
        }
    }

    /**
     * Dplace child theme setup
     */
    public function sanidump_custom_google_map_scripts()
    {
        wp_enqueue_script('google-map-api');
        wp_enqueue_script('directorist-markerclusterer');
        wp_enqueue_script('bbd-custom-google', get_stylesheet_directory_uri() . '/assets/js/custom-google.js', array('google-map-api'), '1.0.0', true);
        wp_localize_script('bbd-custom-google', 'directorist_options', array($this, 'sanidump_bbd_get_option_data'));
    }

    /**
     * Sanidump Get Option Data
     */
    public function sanidump_bbd_get_option_data()
    {
        $options = [];
        $options['script_debugging'] = get_directorist_option('script_debugging', DIRECTORIST_LOAD_MIN_FILES, true);
        return $options;
    }

    /**
     * Sanidump New Style
     */
    public function sanidump_new_styles()
    {
        // Styles
        wp_enqueue_style('sanidump-child-css', get_stylesheet_directory_uri() . '/assets/css/sanidump-style.css',);
    }
}


new Sanidump_Enqueues();
