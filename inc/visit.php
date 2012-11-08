<?php
/**
 * Visit Functionality
 *
 * Anything that has to do with the "Visit" section. This
 * includes Visit post type and trip planner.
 *
 * @package BHX
 * @since BHX 1.0
 */

/**
 * Visit
 *
 * Register the custom post type and taxonomies for visit.
 *
 * @since BHX 1.0
 *
 * @return void
 */
function bhx_post_type_visit() {
	/** Custom Post Type */
	$labels = array(
		'name'               => __( 'Visit St. Augustine', 'bhx' ),
		'singular_name'      => __( 'Visit', 'bhx' ),
		'add_new'            => __( 'Add New', 'bhx' ),
		'add_new_item'       => __( 'Add New', 'bhx' ),
		'edit_item'          => __( 'Edit Item', 'bhx' ),
		'new_item'           => __( 'New Item', 'bhx' ),
		'all_items'          => __( 'Places', 'bhx' ),
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
	
	/** Category */
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

	/** Star Rating */
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

	/** Prices */
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

/**
 * Custom Columns
 *
 * @since BHX 1.0
 *
 * @param array $columns The columns to display
 * @return array $columns The modified list of columns to display
 */
function bhx_post_type_visit_columns( $columns ) {
	$columns = array(
		'cb'       => '<input type="checkbox" />',
		'title'    => __( 'Title', 'bhx' ),
		'category' => __( 'Category', 'bhx' ),
		'price'    => __( 'Price', 'bhx' ),
		'stars'    => __( 'Stars', 'bhx' ),
		'date'     => __( 'Published', 'bhx' )
	);

	return $columns;
}
add_filter( 'manage_edit-visit_columns', 'bhx_post_type_visit_columns' ) ;

/**
 * Custom Column Content
 *
 * @since BHX 1.0
 *
 * @param string $column The current column slug
 * @param in $post_id The current row's associated post ID
 * @return void
 */
function bhx_post_type_visit_columns_manage( $column, $post_id ) {
	global $post;

	switch( $column ) {
		case 'category' :
			$terms = get_the_terms( $post_id, 'visit-type' );
			
			if ( ! empty( $terms ) ) {
				$out = array();

				foreach ( $terms as $term ) {
					$out[] = sprintf( '<a href="%s">%s</a>',
						esc_url( add_query_arg( array( 'post_type' => $post->post_type, 'visit-type' => $term->slug ), 'edit.php' ) ),
						esc_html( sanitize_term_field( 'name', $term->name, $term->term_id, 'visit-type', 'display' ) )
					);
				}

				echo join( ', ', $out );
			}
			break;
		case 'price' :
			$terms = get_the_terms( $post_id, 'visit-price' );
			
			if ( ! empty( $terms ) ) {
				$out = array();

				foreach ( $terms as $term ) {
					$out[] = sprintf( '<a href="%s">%s</a>',
						esc_url( add_query_arg( array( 'post_type' => $post->post_type, 'visit-price' => $term->slug ), 'edit.php' ) ),
						esc_html( sanitize_term_field( 'name', $term->name, $term->term_id, 'visit-price', 'display' ) )
					);
				}

				echo join( ', ', $out );
			}
			break;
		case 'stars' :
			$terms = get_the_terms( $post_id, 'visit-stars' );
			
			if ( ! empty( $terms ) ) {
				$out = array();

				foreach ( $terms as $term ) {
					$out[] = sprintf( '<a href="%s">%s</a>',
						esc_url( add_query_arg( array( 'post_type' => $post->post_type, 'visit-stars' => $term->slug ), 'edit.php' ) ),
						esc_html( sanitize_term_field( 'name', $term->name, $term->term_id, 'visit-stars', 'display' ) )
					);
				}

				echo join( ', ', $out );
			}
			break;
		default :
			break;
	}
}
add_action( 'manage_visit_posts_custom_column', 'bhx_post_type_visit_columns_manage', 10, 2 );

/**
 * Taxonomy Sorting
 *
 * @since BHX 1.0
 *
 * @return void
 */
function bhx_post_type_visit_sort() {
	global $typenow;
 
	if ( $typenow != 'visit' )
		return;

	bhx_post_type_taxonomy_sort( array( 'visit-type', 'visit-price', 'visit-stars' ) );
}
add_action( 'restrict_manage_posts', 'bhx_post_type_visit_sort' );

/**
 * Visit Archive
 *
 * Use the same archive template as the educational template.
 * This is to avoid more duplicate templating.
 *
 * @since BHX 1.0
 *
 * @return void
 */
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