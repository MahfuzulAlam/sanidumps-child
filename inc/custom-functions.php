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
