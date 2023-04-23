<?php

class Sitemap_Provider
{
    private $name;
    private $taxonomy;

    public function __construct($name, $taxonomy)
    {
        $this->name = $name;
        $this->taxonomy = $taxonomy;

        //add_filter('aioseop_sitemap_providers', array($this, 'custom_sitemap_provider'));
        add_filter('aioseo_sitemap_indexes', array($this, 'aioseo_add_sitemap_index'));
    }

    public function generate_sitemap()
    {
        $locations = get_posts(array(
            'post_type' => 'any',
            'taxonomy' => $this->taxonomy,
            'posts_per_page' => 100,
            'orderby' => 'title',
            'order' => 'ASC',
            'fields' => 'ids',
        ));

        if (empty($locations)) {
            return;
        }

        echo '<?xml version="1.0" encoding="' . get_bloginfo('charset') . '"?>' . "\n";
        echo '<!-- Generated by Custom Sitemap for All in One SEO Pack -->' . "\n";
        echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";

        foreach ($locations as $post_id) {
            $permalink = get_permalink($post_id);
            $lastmod = get_the_modified_time('Y-m-d\TH:i:s+00:00', $post_id);
            $url = '<url><loc>' . esc_url($permalink) . '</loc><lastmod>' . $lastmod . '</lastmod></url>';
            echo $url . "\n";
        }

        echo '</urlset>' . "\n";
    }

    /**
     * Sitemap Provider
     */

    function custom_sitemap_provider($providers)
    {
        $providers[$this->name] = $this->generate_sitemap();
        return $providers;
    }

    function aioseo_add_sitemap_index($indexes)
    {
        $indexes[] = [
            'loc'     => 'http://directoristgit.local/custom-location.xml',
            'lastmod' => aioseo()->helpers->dateTimeToIso8601('2021-09-08 12:02')
        ];
        e_var_dump('Hello');
        return $indexes;
    }
}

new Sitemap_Provider('sitemap-locations', 'at_biz_dir-location');