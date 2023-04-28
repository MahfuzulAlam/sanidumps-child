<?php

use Directorist\Helper;

if (!Helper::multi_directory_enabled()) {
    return;
}

global $bdmv_listings;

$location_page = '';
if (is_page('rv-campground')) {
    $location_page = 'rv-campground';
} else {
    $location_page = 'rv-dump-station';
}

if (empty($location_page)) :
?>
    <div class="directorist-type-nav directorist-type-nav--listings-map">

        <ul class="directorist-type-nav__list">

            <?php if ($bdmv_listings->data['listings']->listing_types) : ?>

                <?php foreach ($bdmv_listings->data['listings']->listing_types as $id => $value) : ?>

                    <li class="<?php echo ($bdmv_listings->data['listings']->current_listing_type == $value['term']->term_id) ? 'current' : ''; ?> bdmv-directorist-type">
                        <a class="directorist-type-nav__link" data-id="<?php echo $value['term']->term_id; ?>"><?php directorist_icon($value['data']['icon']); ?><?php echo esc_html($value['name']); ?></a>
                    </li>

                <?php endforeach; ?>

            <?php endif; ?>

        </ul>

    </div>

<?php
else :
?>
    <div class="directorist-type-nav directorist-type-nav--listings-map">
        <ul class="directorist-type-nav__list">

            <li>
                <p class="directorist-type-nav__link_new"><?php echo $location_page === 'rv-campground' ? 'RV Campground' : 'RV Dump Station'; ?>
                <p>
            </li>

        </ul>
    </div>
<?php
endif;
?>