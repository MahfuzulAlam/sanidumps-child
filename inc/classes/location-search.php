<?php

/**
 * @author  wpWax
 * @since   1.0
 * @version 1.0
 */

class Sanidump_Location_Search
{
    public function __construct()
    {
        // Custom Location Page Search Arguments
        add_filter('directorist_all_listings_query_arguments', array($this, 'location_page_search_result'));
    }

    function location_page_search_result($args)
    {
        // global $wp_query;
        // e_var_dump($wp_query->query_vars);
        $pagename = get_query_var('pagename', '');

        if ($pagename === 'rv-campground' || $pagename === 'rv-dump-station') :

            $directory_type = get_taxonomy_id_by_slug($pagename, ATBDP_DIRECTORY_TYPE);

            $country = get_query_var('country', '');
            $province = get_query_var('province', '');
            $city = get_query_var('city', '');

            $location_slug = '';
            if (!empty($city)) {
                $location_slug = $city;
            } else if (!empty($province)) {
                $location_slug = $province;
            } else if (!empty($country)) {
                $location_slug = $country;
            }


            // Directory Type Query
            if ($directory_type) :
                $args['meta_query']['directory_type'] = array(
                    'key' => '_directory_type',
                    'value' => $directory_type,
                    'compare' => '='
                );
            endif;

            // Location Arguments
            if (!empty($location_slug)) :
                $args['sanidump_geo_query'] = array(
                    'lat_field' => '_manual_lat',
                    'lng_field' => '_manual_lng',
                    'latitude' => 23.6964327,
                    'longitude' => 90.4539181,
                    'distance' => 2,
                    'units' => 'miles'
                );
                $args['orderby'] = 'distance';
                $args['order'] = 'ASC';
            endif;
        endif;
        //e_var_dump($args);
        return $args;
    }
}

new Sanidump_Location_Search();
