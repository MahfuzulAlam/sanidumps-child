<?php

/**
 * @author  wpWax
 * @since   1.0
 * @version 1.0
 */

class Sanidump_Search_Home
{
    public function __construct()
    {
        // Custom Search Arguments
        add_filter('atbdp_listing_search_query_argument', array($this, 'search_query_modification_dir_type'));
    }

    /**
     * Custom Search Arguments
     */

    function search_query_modification_dir_type($args)
    {
        return $args;
    }
}

new Sanidump_Search_Home();
