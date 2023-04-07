<?php

/**
 * @author  wpWax
 * @since   1.0
 * @version 1.0
 */

class Sanidump_Filters
{
    public function __construct()
    {
        // Showing the IDs in custom fields
        add_filter('directorist_custom_field_meta_key_field_args', array($this, 'custom_field_meta_key'));
    }

    /**
     * Showing the IDs in custom fields
     */
    public function custom_field_meta_key($args)
    {
        $args['type'] = 'text';
        return $args;
    }
}

new Sanidump_Filters();
