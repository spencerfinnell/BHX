<?php
/**
 * General Admin Functionality
 *
 * Miscellenious admin functionality that does
 * not fit in any specific place.
 *
 * @package BHX
 * @since BHX 1.0
 */

/**
 * Menu Tweaks
 *
 * Remove menu pages that aren't needed (Posts, Links, Comments)
 * and add a divider that will be set in the correct spot later.
 *
 * @since BHX 1.0
 *
 * @return void;
 */
function bhx_menu_pages() {
	remove_menu_page( 'edit.php' );
	remove_menu_page( 'link-manager.php' );
	remove_menu_page( 'edit-comments.php' );
}
add_action( 'admin_menu', 'bhx_menu_pages' );

/**
 * Taxonomy Sorting
 *
 * A helper function for adding taxonomy select boxes to custom
 * post types filter options.
 *
 * @since BHX 1.0
 *
 * @return void;
 */
function bhx_post_type_taxonomy_sort( $taxonomies ) {
	foreach ( $taxonomies as $tax_slug ) {
		$tax_obj  = get_taxonomy( $tax_slug );
		$tax_name = $tax_obj->labels->name;
		$terms    = get_terms( $tax_slug );
		
		if ( count( $terms ) <= 0 )
			continue;

		echo '<select name="' . $tax_slug . '" id="' . $tax_slug. '" class="postform">';
		echo '<option value="">' . sprintf( __( 'Show All %s', 'bhx' ), $tax_name ) . '</option>';
		foreach ( $terms as $term ) {
			echo '<option value="' . $term->slug . '"' . selected( $_GET[$tax_slug], $term->slug, false ) . '">' . $term->name . ' (' . $term->count . ')</option>';
		}
		echo '</select>';
	}
}