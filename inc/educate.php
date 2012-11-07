<?php

function bhx_filter_query_educational( $query ) {
	if ( is_main_query() && is_post_type_archive( 'educational' ) && $query->query_vars['post_type'] != 'nav_menu_item' ) {
		$query->set( 'post_type', array( 'educational', 'site' ) );
	}
}
add_filter( 'pre_get_posts', 'bhx_filter_query_educational' );

/**
 * Educational Resources
 *
 * @since BHX 1.0
 */
function bhx_post_type_educational_resources() {
	$labels = array(
		'name'               => __( 'Educational Resources', 'bhx' ),
		'singular_name'      => __( 'Educational Resource', 'bhx' ),
		'add_new'            => __( 'Add New', 'bhx' ),
		'add_new_item'       => __( 'Add New Resource', 'bhx' ),
		'edit_item'          => __( 'Edit Resource', 'bhx' ),
		'new_item'           => __( 'New Resource', 'bhx' ),
		'all_items'          => __( 'Educate', 'bhx' ),
		'view_item'          => __( 'View Resource', 'bhx' ),
		'search_items'       => __( 'Search Resources', 'bhx' ),
		'not_found'          => __( 'No educational resources found', 'bhx' ),
		'not_found_in_trash' => __( 'No educational resources in trash', 'bhx' ), 
		'parent_item_colon'  => __( 'Educational Resource: ', 'bhx' ),
		'menu_name'          => __( 'Educate', 'bhx' )
	);
	
	$args = array(
		'labels'              => $labels,
		'public'              => true,
		'rewrite'             => array(
			'slug'       => 'educational',
			'with_front' => true
		),
		'capability_type'     => 'post',
		'has_archive'         => 'educate', 
		'hierarchical'        => false,
		'menu_position'       => null,
		'supports'            => array( 'title', 'editor', 'thumbnail' )
	);
	
	register_post_type( 'educational', $args );
	
	/**
	 * Category Taxonomy
	 */
	$labels = array(
		'name'              => __( 'Resource Type', 'bhx' ),
		'singular_name'     => __( 'Resource Type', 'bhx' ),
		'search_items'      => __( 'Search Types', 'bhx'  ),
		'all_items'         => __( 'All Types', 'bhx'  ),
		'parent_item'       => __( 'Parent Type', 'bhx'  ),
		'parent_item_colon' => __( 'Parent Type:', 'bhx'  ),
		'edit_item'         => __( 'Edit Type', 'bhx'  ), 
		'update_item'       => __( 'Update Type', 'bhx'  ),
		'add_new_item'      => __( 'Add New Type', 'bhx'  ),
		'new_item_name'     => __( 'New Resource Type Name', 'bhx'  ),
		'menu_name'         => __( 'Categories', 'bhx'  ),
	); 	

	$args = array(
		'labels'       => $labels,
		'hierarchical' => true,
		'show_ui'      => true,
		'query_var'    => true,
		'rewrite'      => array(
			'slug' => 'educate'
		)
	);

	register_taxonomy( 'educational-resource-type', array( 'educational' ), $args );
}
add_action( 'init', 'bhx_post_type_educational_resources' );

/**
 * Educational Resources
 *
 * @since BHX 1.0
 */
function bhx_post_type_educational_sites() {
	$labels = array(
		'name'               => __( 'Historic Sites', 'bhx' ),
		'singular_name'      => __( 'Historic Site', 'bhx' ),
		'add_new'            => __( 'Add New', 'bhx' ),
		'add_new_item'       => __( 'Add New Site', 'bhx' ),
		'edit_item'          => __( 'Edit Site', 'bhx' ),
		'new_item'           => __( 'New Site', 'bhx' ),
		'all_items'          => __( 'Historic Sites', 'bhx' ),
		'view_item'          => __( 'View Site', 'bhx' ),
		'search_items'       => __( 'Search Sites', 'bhx' ),
		'not_found'          => __( 'No sites found', 'bhx' ),
		'not_found_in_trash' => __( 'No sites found in Trash', 'bhx' ), 
		'parent_item_colon'  => __( 'Site: ', 'bhx' ),
		'menu_name'          => __( 'Sites', 'bhx' )
	);
	
	$args = array(
		'labels'              => $labels,
		'public'              => true,
		'rewrite'             => array(
			'slug'       => 'site',
			'with_front' => false
		),
		'capability_type'     => 'post',
		'has_archive'         => 'educate/sites', 
		'hierarchical'        => false,
		'menu_position'       => null,
		'supports'            => array( 'title', 'editor', 'thumbnail' )
	);
	
	register_post_type( 'site', $args );
	
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
			'slug' => 'sites'
		),
		'show_in_menu' => 'bhx'
	);

	register_taxonomy( 'site-type', array( 'site' ), $args );
}
add_action( 'init', 'bhx_post_type_educational_sites' );

function bhx_sites_archive() {
	global $wp_query;

	if ( ! is_tax() )
		return;

	$taxonomy = $wp_query->get_queried_object();

	if ( $taxonomy->taxonomy != 'site-type' )
		return;

	require( get_template_directory() . '/archive-site.php' );
	exit();
}
add_action( 'template_redirect', 'bhx_sites_archive' );