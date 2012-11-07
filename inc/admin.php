<?php

function bhx_menu_pages() {
	global $menu;

	remove_menu_page( 'edit.php' );
	remove_menu_page( 'link-manager.php' );
	remove_menu_page( 'edit-comments.php' );

	if ( current_user_can( 'manage_woocommerce' ) )
 	   $menu[] = array( '', 'read', 'separator-bhx', '', 'wp-menu-separator bhx' );
}
add_action( 'admin_menu', 'bhx_menu_pages' );

/**
 * Reorder the WC menu items in admin.
 *
 * @access public
 * @param mixed $menu_order
 * @return void
 */
function bhx_admin_menu_order( $menu_order ) {

	// Initialize our custom order array
	$woocommerce_menu_order = array();

	// Get the index of our custom separator
	$woocommerce_separator = array_search( 'separator-bhx', $menu_order );

	// Get index of product menu
	$woocommerce_product = array_search( 'edit.php?post_type=educational', $menu_order );

	// Loop through menu order and do some rearranging
	foreach ( $menu_order as $index => $item ) :
		if ( ( ( 'edit.php?post_type=educational' ) == $item ) ) :
			$woocommerce_menu_order[] = 'separator-bhx';
			$woocommerce_menu_order[] = $item;
			$woocommerce_menu_order[] = 'edit.php?post_type=educational';
			unset( $menu_order[$woocommerce_separator] );
			unset( $menu_order[$woocommerce_product] );
		elseif ( !in_array( $item, array( 'separator-bhx' ) ) ) :
			$woocommerce_menu_order[] = $item;
		endif;

	endforeach;

	// Return order
	return $woocommerce_menu_order;
}

add_action('menu_order', 'bhx_admin_menu_order');