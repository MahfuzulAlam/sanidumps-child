<?php

/**
 * @author  wpWax
 * @since   6.6
 * @version 7.4.0
 */

use \Directorist\Helper;

if (!defined('ABSPATH')) exit;
?>

<div class="<?php Helper::directorist_container_fluid(); ?>">
    <ul class="directorist-listing-type-selection">
        <?php foreach ($searchform->get_listing_type_data() as $id => $value) : ?>

            <?php if ($value['term']->slug === 'general') continue; ?>

            <?php
            $title = $value['term']->slug === 'rv-campground' ? 'Search by Location' : 'Search by Name';
            $icon = $value['term']->slug === 'rv-campground' ? 'fa fa-location-arrow' : 'fa fa-text-width';
            ?>

            <li class="directorist-listing-type-selection__item"><a class="search_listing_types directorist-listing-type-selection__link<?php echo $searchform->get_default_listing_type() == $id ? '--current' : ''; ?>" data-listing_type="<?php echo esc_attr($value['term']->slug); ?>" data-listing_type_id="<?php echo esc_attr($id); ?>" href="#"><?php directorist_icon($icon); ?> <?php echo esc_html($title); ?></a></li>

        <?php endforeach; ?>
    </ul>
</div>