<?php
add_action( 'wp_enqueue_scripts', 'dplace_child_styles', 18 );
function dplace_child_styles() {
	wp_enqueue_style( 'dplace-child-style', get_stylesheet_uri() );
}

add_action( 'after_setup_theme', 'dplace_child_theme_setup' );
function dplace_child_theme_setup() {
    load_child_theme_textdomain( 'dplace', get_stylesheet_directory() . '/languages' );
}



/****************************** CUSTOM ENQUEUES ******************************/
function mpp_bbd_inspect_scripts()
{
	if (!is_admin()) {
		wp_dequeue_script('directorist-google-map');
		wp_deregister_script('directorist-google-map');
	}
}
add_action('wp_print_scripts', 'mpp_bbd_inspect_scripts');

function mpp_custom_google_map_scripts()
{
	//wp_enqueue_style('custom-css', get_stylesheet_directory_uri() . '/assets/css/custom.css');
	wp_enqueue_script('google-map-api');
	wp_enqueue_script('directorist-markerclusterer');
	wp_enqueue_script('bbd-custom-google', get_stylesheet_directory_uri() . '/assets/js/custom-google.js', array('google-map-api'), '1.0.0', true);
	wp_localize_script('bbd-custom-google', 'directorist_options', bbd_get_option_data());
}
add_action('wp_enqueue_scripts', 'mpp_custom_google_map_scripts', 0);

function bbd_get_option_data()
{
    $options = [];
    $options['script_debugging'] = get_directorist_option('script_debugging', DIRECTORIST_LOAD_MIN_FILES, true);
    return $options;
}


/**
 * Showing the IDs in custom fields
 */

add_filter('directorist_custom_field_meta_key_field_args', function ($args) {
	$args['type'] = 'text';
	return $args;
});

/**
 * Test
 */


 add_filter("atbdp_listing_search_query_argument", function ($args) {
	e_var_dump($_GET);
	return $args;
});