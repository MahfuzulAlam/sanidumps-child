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
        //file_put_contents(dirname(__FILE__) . '/request.json', json_encode($_REQUEST));
        // Deal with Taxonomy
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
        // Deal with Location
        $latitude = 0;
        $longitude = 0;
        if (isset($_GET['cityLat']) && !empty($_GET['cityLat'])) $latitude = $_GET['cityLat'];
        if (isset($_REQUEST['cityLat']) && !empty($_REQUEST['cityLat'])) $latitude = $_REQUEST['cityLat'];
        if (isset($_GET['cityLng']) && !empty($_GET['cityLng'])) $longitude = $_GET['cityLng'];
        if (isset($_REQUEST['cityLng']) && !empty($_REQUEST['cityLng'])) $longitude = $_REQUEST['cityLng'];


        if ($latitude && $longitude) :
            $args['sanidump_geo_query'] = array(
                'lat_field' => '_manual_lat',
                'lng_field' => '_manual_lng',
                'latitude' => $latitude,
                'longitude' => $longitude,
                'distance' => 150,
                'units' => 'miles'
            );
            $args['orderby'] = 'distance';
            $args['order'] = 'ASC';
        endif;

        // Deal with tax query
        unset($args['tax_query']);
        unset($args['meta_query']['_address']);

        // Deal with Need Post
        if (isset($_REQUEST['action']) && $_REQUEST['action'] === 'ajax_search_listing') {
            unset($args['meta_query'][0]);
            unset($args['meta_query'][1]);
            unset($args['meta_query'][2]);
        }
        //e_var_dump($args);
        //file_put_contents(dirname(__FILE__) . '/file.json', json_encode($args));
        return $args;
    }
}

new Sanidump_Search_Result();
