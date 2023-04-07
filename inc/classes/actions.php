<?php

/**
 * @author  wpWax
 * @since   1.0
 * @version 1.0
 */

class Sanidump_Actions
{
    public function __construct()
    {
        // Dplace Child Theme Style
        add_action('wp_enqueue_scripts', array($this, 'dplace_child_styles'));
    }

    public function dplace_child_styles()
    {
        //
    }
}

new Sanidump_Actions();
