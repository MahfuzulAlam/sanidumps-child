<?php

/**
 * @author  wpWax
 * @since   1.0
 * @version 1.0
 */

use wpWax\dPlace\Theme;
use wpWax\dPlace\Helper;

if (!Theme::$has_banner) {
    return false;
}

// Theme Banner isn't need for Specific pages 
if (class_exists('Directorist_Base')) {
    if (atbdp_is_page('author') || is_singular('at_biz_dir') || atbdp_is_page('dashboard')) {
        return;
    }
}

// Check if the Location page
$location_page = is_sanidump_location_page();
$location_breadcrumb = '';
if ($location_page) {
    $location_breadcrumb = sanidump_location_breadcrumb($location_page['location']);
}

?>
<div class="banner">
    <div class="theme-container">
        <div class="banner-content breadcrumb-banner">

            <?php if (Theme::$options['page-title']) : ?>

                <h1><?php echo wp_kses_post(Helper::get_page_title()); ?></h1>

            <?php endif; ?>

            <?php if (Theme::$has_breadcrumb) : ?>

                <div class="main-breadcrumb">
                    <?php if (!empty($location_breadcrumb)) {
                        echo $location_breadcrumb;
                    } else {
                        Helper::the_breadcrumb();
                    } ?>
                </div>

            <?php endif; ?>

        </div>
    </div>
</div>