<?php

function bhx_menu_pages() {
	add_menu_page(
		__( 'BHX', 'bhx' ),
		__( 'BHX', 'bhx' ),
		'edit_pages',
		'bhx',
		'bhx_admin_menu_page',
		'',
		6
	);
	
	remove_menu_page( 'edit.php' );
	remove_menu_page( 'link-manager.php' );
	remove_menu_page( 'edit-comments.php' );
}
add_action( 'admin_menu', 'bhx_menu_pages' );

function bhx_admin_menu_page() {

}