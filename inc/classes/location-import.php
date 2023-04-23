<?php

/**
 * @author  wpWax
 * @since   1.0
 * @version 1.0
 */

class Sanidump_Location_Import
{
    public function __construct()
    {
        // Dplace Child Theme Style
        add_action('directorist_listing_imported', array($this, 'directorist_listing_imported_never_expire'));
    }

    /**
     * Listing Import - Set Never Expire
     */
    public function directorist_listing_imported_never_expire($post_id)
    {
        // Never Expire
        update_post_meta($post_id, '_never_expire', 1);
        // Update Post Author
        $arg = array(
            'ID' => $post_id,
            'post_author' => 1,
        );
        wp_update_post($arg);
    }
}

new Sanidump_Location_Import();
