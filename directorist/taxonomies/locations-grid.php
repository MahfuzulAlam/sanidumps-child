<?php

/**
 * @author  wpWax
 * @since   6.6
 * @version 7.3.1
 */

use \Directorist\Helper;

global $post;
$post_slug = $post->post_name;

$columns = floor(12 / $taxonomy->columns);

$location_slug = sanidump_get_location_slug();
$location_id = $location_slug ? get_taxonomy_id_by_slug($location_slug, ATBDP_LOCATION) : 0;

$description = '';
if ($location_id) {
    if ($post_slug && $post_slug === 'rv-campground') {
        $description = get_term_meta($location_id, 'camp_desc', true);
    } else if ($post_slug && $post_slug === 'rv-dump-station') {
        $description = get_term_meta($location_id, 'dump_desc', true);
    }
}
?>
<div id="directorist" class="atbd_wrapper directorist-w-100">
    <div class="<?php Helper::directorist_container_fluid(); ?>">
        <?php
        /**
         * @since 5.6.6
         */
        do_action('atbdp_before_all_locations_loop', $taxonomy);
        ?>
        <div class="atbd_location_grid_wrap atbdp-no-margin">
            <p><?php echo $description; ?></p>
            <div class="<?php Helper::directorist_row(); ?>">
                <?php
                if ($locations) {
                    foreach ($locations as $location) {
                        $loc_class = $location['img'] ? '' : ' atbd_location_grid-default';
                        $description = get_term_meta($location['term']->term_id, '_description', true);
                        $string = strlen($description > 200) ? substr($description, 0, 200) . '...' : $description;
                        if (!empty($location['term']->term_id)) {
                            $parents = get_term_parents_list($location['term']->term_id, ATBDP_LOCATION, array('inclusive' => false, 'format' => 'slug', 'link' => false));
                            $location['permalink'] = get_page_link_by_slug($post_slug) . $parents . $location['term']->slug;
                        }
                ?>
                        <div class="<?php Helper::directorist_column($columns); ?>">
                            <a class="atbd_location_grid<?php echo esc_attr($loc_class); ?>" href="<?php echo esc_url($location['permalink']); ?>">
                                <div>
                                    <h3><?php echo esc_html($location['name']); ?></h3>
                                    <!-- <p>
                                        <?php echo $string; ?>
                                    </p> -->
                                </div>
                            </a>
                        </div>
                    <?php
                    }
                } else {
                    ?>
                    <p><?php esc_html_e('No Results found!', 'directorist'); ?></p>
                <?php
                }
                ?>
            </div>
        </div>
    </div>
    <?php
    /**
     * @since 5.6.6
     */
    do_action('atbdp_after_all_locations_loop');
    ?>
</div>