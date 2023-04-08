<?php

/**
 * @author  wpWax
 * @since   1.0
 * @version 1.0
 */

?>
<!DOCTYPE html>

<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="profile" href="https://gmpg.org/xfn/11" />

    <?php
    $pagename = get_query_var('pagename', '');
    ?>
    <?php
    if ($pagename === 'rv-campground' || $pagename === 'rv-dump-station') :
    ?>
        <title><?php wp_title('|', true, 'right'); ?> | <?php echo get_bloginfo('name') ?></title>
    <?php
    endif;
    ?>
    <?php wp_head();
    ?>

</head>

<body <?php body_class(); ?>>

    <?php wp_body_open(); ?>

    <div id="page" class="site">
        <a class="skip-link screen-reader-text" href="#main-content">

            <?php esc_html_e("skip to content", "dplace"); ?>

        </a>
        <header id="site-header" class="<?php echo apply_filters('theme_top_header_menu_area_class', 'menu-area'); ?> sticky-top">

            <?php get_template_part('template-parts/content-header'); ?>

        </header>
        <span class="theme-mobile-menu-overlay"></span>
        <div id="content" class="site-content">

            <?php get_template_part('template-parts/content-banner');    ?>