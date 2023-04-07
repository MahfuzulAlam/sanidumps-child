<?php

/**
 * @author  wpWax
 * @since   1.0
 * @version 1.0
 */

class Sanidump_Shortcodes
{
    public function __construct()
    {
        // Sanidump Location
        add_shortcode('sanidump-location', array($this, 'sanidump_location'));
    }

    /**
     * Sanidump Location
     */
    function sanidump_location()
    {
        ob_start();
        global $wp_query;
        e_var_dump($wp_query->query_vars);
        return ob_get_clean();
    }
}

new Sanidump_Shortcodes();
