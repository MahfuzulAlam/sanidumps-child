<?php

/**
 * @author  wpWax
 * @since   1.0
 * @version 1.0
 */

class Sanidump_Child
{
    /**
     * Construct
     */
    public function __construct()
    {
        // Dplace Child Theme Style
        add_action('wp_enqueue_scripts', array($this, 'dplace_child_styles'));
        // Dplace child theme setup
        add_action('after_setup_theme', array($this, 'dplace_child_theme_setup'));

        // Instantiate Includes, when Directorist plugin is active
        if (in_array('directorist/directorist-base.php', (array) get_option('active_plugins'))) {
            $this->includes();
        }
    }

    /**
     * Dplace Child Theme Style
     */
    public function dplace_child_styles()
    {
        wp_enqueue_style('dplace-child-style', get_stylesheet_uri());
    }

    /**
     * Dplace child theme setup
     */
    public function dplace_child_theme_setup()
    {
        load_child_theme_textdomain('dplace', get_stylesheet_directory() . '/languages');
    }

    /**
     * All Included Files
     */
    public function includes()
    {
        require_once get_stylesheet_directory() . '/inc/custom-functions.php';
        require_once get_stylesheet_directory() . '/inc/classes/actions.php';
        require_once get_stylesheet_directory() . '/inc/classes/enqueues.php';
        require_once get_stylesheet_directory() . '/inc/classes/filters.php';
        require_once get_stylesheet_directory() . '/inc/classes/location-geo-query.php';
        require_once get_stylesheet_directory() . '/inc/classes/location-import.php';
        require_once get_stylesheet_directory() . '/inc/classes/location-search.php';
        require_once get_stylesheet_directory() . '/inc/classes/location-fields.php';
        require_once get_stylesheet_directory() . '/inc/classes/routes.php';
        require_once get_stylesheet_directory() . '/inc/classes/search-filters.php';
        require_once get_stylesheet_directory() . '/inc/classes/search-home.php';
        require_once get_stylesheet_directory() . '/inc/classes/search-result.php';
        require_once get_stylesheet_directory() . '/inc/classes/shortcodes.php';
        //require_once get_stylesheet_directory() . '/inc/classes/sitemap-provider.php';
        require_once get_stylesheet_directory() . '/inc/classes/location-sitemap.php';
    }
}

/**
 * Initialize the child theme
 */
new Sanidump_Child();
