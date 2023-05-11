<?php

/**
 * @author  wpWax
 * @since   1.0
 * @version 1.0
 */

class Sanidump_Location_Fields
{
    public function __construct()
    {
        // Add the fields to the "lcoation" taxonomy, using our callback function
        add_action(ATBDP_LOCATION . '_edit_form_fields', array($this, 'location_lat_lng_fields'), 1, 2);

        // Save the changes made on the "location" taxonomy, using our callback function
        add_action('edited_' . ATBDP_LOCATION, array($this, 'save_location_lat_lng_fields'), 10, 2);
    }

    // A callback function to add a custom field to our "location" taxonomy
    function location_lat_lng_fields($tag)
    {
        // Check for existing taxonomy meta for the term you're editing
        $t_id = $tag->term_id; // Get the ID of the term you're editing
        $camp_desc = get_term_meta($t_id, 'camp_desc', true);
        $dump_desc = get_term_meta($t_id, 'dump_desc', true);
        $latitude = get_term_meta($t_id, 'latitude', true);
        $longitude = get_term_meta($t_id, 'longitude', true);
?>

        <tr class="form-field">
            <th scope="row" valign="top">
                <label for="camp_desc"><?php _e('RV Campground Description'); ?></label>
            </th>
            <td>
                <textarea name="camp_desc" id="camp_desc" rows="5" cols="50"><?php echo $camp_desc ? $camp_desc : ''; ?></textarea><br />
                <span class="description"><?php _e('This is the description of the campgorunds in this location'); ?></span>
            </td>
        </tr>
        <tr class="form-field">
            <th scope="row" valign="top">
                <label for="dump_desc"><?php _e('RV Dump Station Description'); ?></label>
            </th>
            <td>
                <textarea name="dump_desc" id="dump_desc" rows="5" cols="50"><?php echo $dump_desc ? $dump_desc : ''; ?></textarea><br />
                <span class="description"><?php _e('This is the description of the campgorunds in this location'); ?></span>
            </td>
        </tr>
        <tr class="form-field">
            <th scope="row" valign="top">
                <label for="latitude"><?php _e('Latitude'); ?></label>
            </th>
            <td>
                <input type="text" name="latitude" id="latitude" size="25" style="width:60%;" value="<?php echo $latitude ? $latitude : ''; ?>"><br />
                <span class="description"><?php _e('Location latutude point'); ?></span>
            </td>
        </tr>
        <tr class="form-field">
            <th scope="row" valign="top">
                <label for="longitude"><?php _e('Longitude'); ?></label>
            </th>
            <td>
                <input type="text" name="longitude" id="longitude" size="25" style="width:60%;" value="<?php echo $longitude ? $longitude : ''; ?>"><br />
                <span class="description"><?php _e('Location longitude point'); ?></span>
            </td>
        </tr>
        <tr class="form-field">
            <th scope="row" valign="top">
                <label for="sitemap"><?php _e('Add to Sitemap'); ?></label>
            </th>
            <td>
                <input type="checkbox" class="postform" name="sitemap" value="1" id="sitemap" <?php echo $sitemap ? 'checked' : ''; ?>>
                <label for="sitemap">Enabled</label>
            </td>
        </tr>

<?php
    }


    // A callback function to save our extra taxonomy field(s)
    function save_location_lat_lng_fields($term_id)
    {
        if (isset($_POST['camp_desc']) && !empty($_POST['camp_desc'])) {
            update_term_meta($term_id, 'camp_desc', $_POST['camp_desc']);
        }
        if (isset($_POST['dump_desc']) && !empty($_POST['dump_desc'])) {
            update_term_meta($term_id, 'dump_desc', $_POST['dump_desc']);
        }
        if (isset($_POST['latitude']) && !empty($_POST['latitude'])) {
            update_term_meta($term_id, 'latitude', $_POST['latitude']);
        }
        if (isset($_POST['longitude']) && !empty($_POST['longitude'])) {
            update_term_meta($term_id, 'longitude', $_POST['longitude']);
        }
        if (isset($_POST['sitemap']) && !empty($_POST['sitemap'])) {
            update_term_meta($term_id, 'sitemap', $_POST['sitemap']);
        } else {
            update_term_meta($term_id, 'sitemap', 0);
        }
    }
}

new Sanidump_Location_Fields();
