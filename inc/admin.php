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