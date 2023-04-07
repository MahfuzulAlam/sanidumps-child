<?php

/**
 * @author  wpWax
 * @since   1.0
 * @version 1.0
 */

class Sanidump_Routes
{
    public function __construct()
    {
        // Custom URL/Routes for location page
        add_action('init', array($this, 'sanidump_custom_routes'), 10, 0);
    }

    /**
     * Custom URL/Routes for location page
     */

    public function sanidump_custom_routes()
    {
        // RV CAMPGROUND ROUTES
        add_rewrite_rule('^rv-campground/([^/]*)/([^/]*)/([^/]*)/?', 'index.php?pagename=rv-campground&country=$matches[1]&province=$matches[2]&city=$matches[3]', 'top');
        add_rewrite_rule('^rv-campground/([^/]*)/([^/]*)/?', 'index.php?pagename=rv-campground&country=$matches[1]&province=$matches[2]', 'top');
        add_rewrite_rule('^rv-campground/([^/]*)/?', 'index.php?pagename=rv-campground&country=$matches[1]', 'top');

        // RV DUMP STATIONS
        add_rewrite_rule('^rv-dump-station/([^/]*)/([^/]*)/([^/]*)/?', 'index.php?pagename=rv-dump-station&country=$matches[1]&province=$matches[2]&city=$matches[3]', 'top');
        add_rewrite_rule('^rv-dump-station/([^/]*)/([^/]*)/?', 'index.php?pagename=rv-dump-station&country=$matches[1]&province=$matches[2]', 'top');
        add_rewrite_rule('^rv-dump-station/([^/]*)/?', 'index.php?pagename=rv-dump-station&country=$matches[1]', 'top');

        // REWRITE TAGS
        add_rewrite_tag('%country%', '([^&]+)');
        add_rewrite_tag('%province%', '([^&]+)');
        add_rewrite_tag('%city%', '([^&]+)');
    }
}

new Sanidump_Routes();
