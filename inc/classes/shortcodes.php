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

        if (empty($location_slug)) {
            $this->get_locations();
        } else {

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
                $this->get_locations($child_slugs, $location_id);
            }
        }

        return ob_get_clean();
    }

    /**
     * Get All Location
     */
    public function get_locations($child_slugs = '', $location_id = 0)
    {
        global $post;
        $post_slug = $post->post_name;
        $directory_type = get_term_by('slug', $post_slug, ATBDP_DIRECTORY_TYPE);

        $args = array(
            'taxonomy'   => ATBDP_LOCATION,
            'hide_empty' => false,
            'parent' => $location_id,
        );

        if ($directory_type) {
            $args['meta_query'] = array(
                array(
                    'key' => '_directory_type', // replace with your meta key's name
                    'value' => ':' . $directory_type->term_id . ';', // replace 2 with the value you want to search for
                    'compare' => 'LIKE',
                ),
            );
        }

        //if (!empty($child_slugs)) unset($args['parent']);
        //e_var_dump($args);
        $locations = get_terms($args);

        echo '<div class="sd-location-archive-page"><div class="theme-container"><div class="row"><div class="col-12"><div class="main-content">';

        if ($location_id) {
            $parent_obj = get_term($location_id, ATBDP_LOCATION);
            if ($parent_obj) {
                echo '<h1>' . $parent_obj->name . '</h1>';
            }
        } else {
            echo '<h1>' . $directory_type->name . '</h1>';
        }

        if ($locations && count($locations)) {
            echo '<div class="location-holder">';
            foreach ($locations as $location) {
                $parents = get_term_parents_list($location->term_id, ATBDP_LOCATION, array('inclusive' => false, 'format' => 'slug', 'link' => false));
                $permalink = get_page_link_by_slug($post_slug) . $parents . $location->slug;
                echo '<a href="' . $permalink . '">' . $location->name . '</a>';
            }
            echo '</div>';
        }

        echo '</div></div></div></div></div>';
    }
}

new Sanidump_Shortcodes();
