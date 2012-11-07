<?php

/**
 * Educational Resources
 *
 * @since BHX 1.0
 */
function bhx_post_type_visit() {
	$labels = array(
		'name'               => __( 'Visit St. Augustine', 'bhx' ),
		'singular_name'      => __( 'Visit', 'bhx' ),
		'add_new'            => __( 'Add New', 'bhx' ),
		'add_new_item'       => __( 'Add New', 'bhx' ),
		'edit_item'          => __( 'Edit Item', 'bhx' ),
		'new_item'           => __( 'New Item', 'bhx' ),
		'all_items'          => __( 'Visit', 'bhx' ),
		'view_item'          => __( 'View Item', 'bhx' ),
		'search_items'       => __( 'Search Items', 'bhx' ),
		'not_found'          => __( 'No items found', 'bhx' ),
		'not_found_in_trash' => __( 'No items found in Trash', 'bhx' ), 
		'parent_item_colon'  => __( 'Item: ', 'bhx' ),
		'menu_name'          => __( 'Visit', 'bhx' )
	);
	
	$args = array(
		'labels'              => $labels,
		'public'              => true,
		'rewrite'             => array(
			'slug'       => 'visits',
			'with_front' => false
		),
		'capability_type'     => 'post',
		'has_archive'         => 'travel', 
		'hierarchical'        => false,
		'menu_position'       => null,
		'supports'            => array( 'title', 'editor', 'thumbnail' )
	);
	
	register_post_type( 'visit', $args );
	
	$labels = array(
		'name'              => __( 'Categories', 'bhx' ),
		'singular_name'     => __( 'Category', 'bhx' ),
		'search_items'      => __( 'Search Categories', 'bhx'  ),
		'all_items'         => __( 'Categories', 'bhx'  ),
		'parent_item'       => __( 'Parent Category', 'bhx'  ),
		'parent_item_colon' => __( 'Parent Category:', 'bhx'  ),
		'edit_item'         => __( 'Edit Category', 'bhx'  ), 
		'update_item'       => __( 'Update Category', 'bhx'  ),
		'add_new_item'      => __( 'Add New Category', 'bhx'  ),
		'new_item_name'     => __( 'New Category Name', 'bhx'  ),
		'menu_name'         => __( 'Categories', 'bhx'  ),
	); 	

	$args = array(
		'labels'       => $labels,
		'hierarchical' => true,
		'show_ui'      => true,
		'query_var'    => true,
		'rewrite'      => array(
			'slug' => 'visit'
		)
	);

	register_taxonomy( 'visit-type', array( 'visit' ), $args );

	$labels = array(
		'name'              => __( 'Stars', 'bhx' ),
		'singular_name'     => __( 'Star', 'bhx' ),
		'search_items'      => __( 'Search Stars', 'bhx'  ),
		'all_items'         => __( 'Stars', 'bhx'  ),
		'parent_item'       => __( 'Parent Star', 'bhx'  ),
		'parent_item_colon' => __( 'Parent Star:', 'bhx'  ),
		'edit_item'         => __( 'Edit Star', 'bhx'  ), 
		'update_item'       => __( 'Update Star', 'bhx'  ),
		'add_new_item'      => __( 'Add New Star', 'bhx'  ),
		'new_item_name'     => __( 'New Star', 'bhx'  ),
		'menu_name'         => __( 'Stars', 'bhx'  ),
	); 	

	$args = array(
		'labels'       => $labels,
		'hierarchical' => true,
		'show_ui'      => true,
		'query_var'    => true,
		'rewrite'      => array(
			'slug' => 'stars'
		)
	);

	register_taxonomy( 'visit-stars', array( 'visit' ), $args );

	$labels = array(
		'name'              => __( 'Pricing', 'bhx' ),
		'singular_name'     => __( 'Price', 'bhx' ),
		'search_items'      => __( 'Search Pricing', 'bhx'  ),
		'all_items'         => __( 'Pricing', 'bhx'  ),
		'parent_item'       => __( 'Parent Pricing', 'bhx'  ),
		'parent_item_colon' => __( 'Parent Pricing:', 'bhx'  ),
		'edit_item'         => __( 'Edit Pricing', 'bhx'  ), 
		'update_item'       => __( 'Update Pricing', 'bhx'  ),
		'add_new_item'      => __( 'Add New Pricing', 'bhx'  ),
		'new_item_name'     => __( 'New Pricing', 'bhx'  ),
		'menu_name'         => __( 'Pricing', 'bhx'  ),
	); 	

	$args = array(
		'labels'       => $labels,
		'hierarchical' => true,
		'show_ui'      => true,
		'query_var'    => true,
		'rewrite'      => array(
			'slug' => 'price'
		)
	);

	register_taxonomy( 'visit-price', array( 'visit' ), $args );
}
add_action( 'init', 'bhx_post_type_visit' );

function bhx_visit_template() {
	global $wp_query;
	
	if ( get_query_var( 'post_type' ) != 'visit' )
		return;

	if ( ! is_post_type_archive( 'visit' ) )
		return;
	
	require( get_template_directory() . '/archive-educational.php' );
	exit();
}
add_action( 'template_redirect', 'bhx_visit_template' );