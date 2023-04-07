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
        // Custom Term Link
        add_filter('term_link', array($this, 'custom_term_link'), 20, 3);
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

            // $location = get_taxonomy_id_by_slug($location_slug, ATBDP_LOCATION);

            // if ($location) {
            //     update_term_meta($location, 'latitude', 23.6237764);
            //     update_term_meta($location, 'longitude', 90.50004039999999);
            // }

            // Location Arguments
            if (!empty($location_slug)) :
                $location_id = get_taxonomy_id_by_slug($location_slug, ATBDP_LOCATION);

                $latitude = get_term_meta($location_id, 'latitude', true);
                $longitude = get_term_meta($location_id, 'longitude', true);

                if ($latitude && $longitude) :
                    $args['sanidump_geo_query'] = array(
                        'lat_field' => '_manual_lat',
                        'lng_field' => '_manual_lng',
                        'latitude' => $latitude,
                        'longitude' => $longitude,
                        'distance' => 150,
                        'units' => 'miles'
                    );
                endif;

                $args['orderby'] = 'distance';
                $args['order'] = 'ASC';
            endif;
        endif;
        //e_var_dump($args);
        return $args;
    }

    function custom_term_link($url, $term, $taxonomy)
    {
        $directory_type_id       = get_post_meta(get_the_ID(), '_directory_type', true);
        $directory_type_slug     = '';

        if (!empty($directory_type_id)) {
            $directory_type_term = get_term_by('id', $directory_type_id, ATBDP_DIRECTORY_TYPE);
            $directory_type_slug = ($directory_type_term && is_object($directory_type_term)) ? $directory_type_term->slug : '';
        }


        // Categories
        if (ATBDP_CATEGORY === $taxonomy) {
            $url = ATBDP_Permalink::atbdp_get_category_page($term);
        }

        // Location
        if (ATBDP_LOCATION === $taxonomy) {

            if (!empty($directory_type_slug)) {
                $parents = get_term_parents_list($term->term_id, ATBDP_LOCATION, array('inclusive' => false, 'format' => 'slug', 'link' => false));
                $url = get_page_link_by_slug($directory_type_slug) . $parents . $term->slug;
            }
        }

        // Tag
        if (ATBDP_TAGS === $taxonomy) {
            $url = ATBDP_Permalink::atbdp_get_tag_page($term);
        }
        return $url;
    }
}

new Sanidump_Location_Search();
