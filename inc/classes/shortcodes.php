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

        $location_slug = sanidump_get_location_slug();

        $location_id = get_taxonomy_id_by_slug($location_slug, ATBDP_LOCATION);

        $children = get_term_children($location_id, ATBDP_LOCATION);

        if (empty($children)) {
            echo do_shortcode('[directorist_all_listing view="listings_with_map" map_height="100%" listings_with_map_columns="2"]');
        } else {
            // Make slugs
            $child_slugs = array();
            foreach ($children as $child_id) {
                $child_term = get_term($child_id, $taxonomy);
                $child_slugs[] = $child_term->slug;
            }
            $child_slugs = !empty($child_slugs) ? implode(',', $child_slugs) : '';
            // Term has no children
            echo do_shortcode('[directorist_all_locations view="grid" columns="1" slug="' . $child_slugs . '"]');
        }

        return ob_get_clean();
    }
}

new Sanidump_Shortcodes();
