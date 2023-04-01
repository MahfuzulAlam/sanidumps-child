<?php
/**
 * @author  wpWax
 * @since   6.6
 * @version 7.3.1
 */

if ( ! defined( 'ABSPATH' ) ) exit;

$value = isset( $_GET['q'] ) ? sanitize_text_field( wp_unslash( $_GET['q'] ) ) : '';
$search_field_types = $searchform->form_data;
$title_search 		= isset( $search_field_types[1]['fields']['title'] ) ? true : false;

if(!isset($_POST['listing_type']) || $_POST['listing_type'] !== 'rv-dump-station') return;

?>
<?php if ( $title_search && $data['label'] ) : ?>

	<label><?php echo esc_html( $data['label'] ); ?></label>

<?php endif; ?>

<div class="directorist-search-field directorist-form-group directorist-search-query">

	<input class="directorist-form-element" type="text" name="q" value="<?php echo esc_attr( $value ); ?>" placeholder="<?php echo esc_attr( $data['placeholder'] ); ?>" <?php echo ! empty( $data['required'] ) ? 'required="required"' : ''; ?>>

</div>