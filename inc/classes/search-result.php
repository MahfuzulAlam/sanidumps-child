<?php

/**
 * @author  wpWax
 * @since   1.0
 * @version 1.0
 */

class Sanidump_Search_Result
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
        if (isset($args['meta_query']) && count($args['meta_query']) > 0) {
            foreach ($args['meta_query'] as $key => $meta_arg) {
                if (isset($meta_arg['key']) && $meta_arg['key'] === '_dir_type') {
                    $term = get_term_by('slug', $meta_arg['value'], ATBDP_DIRECTORY_TYPE);
                    if ($term) {
                        unset($args['meta_query'][$key]);
                        $args['meta_query']['directory_type']['value'] = $term->term_id;
                    }
                }
            }
        }
        return $args;
    }
}

new Sanidump_Search_Result();
