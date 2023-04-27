<?php

/**
 * @author  wpWax
 * @since   1.0
 * @version 1.0
 */

/**
 * Get Taxonomy ID by Slug
 */
function get_taxonomy_id_by_slug($slug, $taxonomy)
{
    if (!$slug || !$taxonomy) return 0;
    $term = get_term_by('slug', $slug, $taxonomy);
    if ($term) {
        return $term->term_id;
    } else {
        return 0;
    }
}


/**
 * Get a Page link by Slug
 */
function get_page_link_by_slug($slug)
{
    return get_permalink(get_page_by_path($slug));
}


/**
 * Check if Sanidump Location Page
 */
function is_sanidump_location_page()
{
    $result = false;
    $pagename = get_query_var('pagename', '');

    if ($pagename === 'rv-campground' || $pagename === 'rv-dump-station') :
        $result = array('status' => true);
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
        $result['location'] = $location_slug;
    endif;

    return $result;
}


/**
 * Sanidump Location Breadcrump
 */
function sanidump_location_breadcrumb($location)
{
    if ($location && !empty($location)) {
        $term = get_term_by('slug', $location, ATBDP_LOCATION);
        $location_title = $term->name;
        ob_start();
?>
        <div class="main-breadcrumb">
            <nav role="navigation" aria-label="Breadcrumbs" class="breadcrumb-trail breadcrumbs" itemprop="breadcrumb">
                <ul class="trail-items" itemscope="" itemtype="http://schema.org/BreadcrumbList">
                    <meta name="numberOfItems" content="2">
                    <meta name="itemListOrder" content="Ascending">
                    <li itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem" class="trail-item trail-begin"><a href="<?php echo get_bloginfo('url'); ?>" rel="home" itemprop="item"><span itemprop="name">Home</span></a>
                        <meta itemprop="position" content="1">
                    </li>
                    <li itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem" class="trail-item trail-end"><span itemprop="item"><span itemprop="name"><?php echo $location_title ?></span></span>
                        <meta itemprop="position" content="2">
                    </li>
                </ul>
            </nav>
        </div>
<?php
        return ob_get_clean();
    } else {
        return '';
    }
}


/**
 * Get Location Slug
 */

function sanidump_get_location_slug()
{
    $location_slug = '';
    $country = get_query_var('country', '');
    $province = get_query_var('province', '');
    $city = get_query_var('city', '');


    if (!empty($city)) {
        $location_slug = $city;
    } else if (!empty($province)) {
        $location_slug = $province;
    } else if (!empty($country)) {
        $location_slug = $country;
    }
    return $location_slug;
}


add_filter('atbdp_all_locations_argument', function ($args) {
    unset($args['parent']);
    return $args;
});

add_filter('atbdp_listing_import_limit_per_cycle', function ($limit) {
    return 10;
});
