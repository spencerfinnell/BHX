<?php
/**
 * Educate Functionality
 *
 * Anything that has to do with the "Educate" section. This
 * includes Educational Resources (Literature, Documentaries), 
 * Historic Sites, and Interactive Timeline.
 *
 * @package BHX
 * @since BHX 1.0
 */

/** General **********************************************************************/

/**
 * Educate Archive
 *
 * As a non-JS fallback, the Educate permalink should query all
 * educational resources, including historic sites (this is what is
 * actually being added).
 *
 * @since BHX 1.0
 *
 * @param object $query The current query
 * @return void
 */
function bhx_filter_query_educational( $query ) {
	if ( is_main_query() && is_post_type_archive( 'educational' ) && $query->query_vars['post_type'] != 'nav_menu_item' ) {
		$query->set( 'post_type', array( 'educational', 'site' ) );
	}
}
add_filter( 'pre_get_posts', 'bhx_filter_query_educational' );

/** Educational Resources *********************************************************/

/**
 * Educational Resources
 *
 * Register the custom post type and taxonomies
 * for educational resources. Although "Sites" are technically
 * a resource, they are managed through a separate custom post
 * type. See `bhx_post_type_sites()` below.
 *
 * @since BHX 1.0
 *
 * @return void
 */
function bhx_post_type_educational_resources() {
	/** Custom Post Type */
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
	
	/** Educational Resource Type */
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

/** Historic Sites ***=***********************************************************/

/**
 * Educational Sites
 *
 * Register the custom post type for educational/historic sites
 * and the custom taxonomy for categorizing them.
 *
 * @since BHX 1.0
 *
 * @return void
 */
function bhx_post_type_site() {
	/** Custom Post Type */
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
	
	/** Site Category */
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
add_action( 'init', 'bhx_post_type_site' );

/**
 * Site Taxonomy Archive
 *
 * Instead of using a file such as `taxonomy-site-type.php`, that
 * would be the same as `archive-site.php`, just use the template
 * that already exists.
 *
 * @since BHX 1.0
 *
 * @return void
 */
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

/** Timeline **********************************************************************/

/**
 * Timeline
 *
 * Register the custom post type for the interactive timeline.
 *
 * @since BHX 1.0
 *
 * @return void
 */
function bhx_post_type_timeline() {
	/** Custom Post Type */
	$labels = array(
		'name'               => __( 'Timeline', 'bhx' ),
		'singular_name'      => __( 'Timeline', 'bhx' ),
		'add_new'            => __( 'Add Time Period', 'bhx' ),
		'add_new_item'       => __( 'Add New', 'bhx' ),
		'edit_item'          => __( 'Edit Time Period', 'bhx' ),
		'new_item'           => __( 'New Time Period', 'bhx' ),
		'all_items'          => __( 'Timeline', 'bhx' ),
		'view_item'          => __( 'View Time Period', 'bhx' ),
		'search_items'       => __( 'Search Time Periods', 'bhx' ),
		'not_found'          => __( 'No items found', 'bhx' ),
		'not_found_in_trash' => __( 'No items found in Trash', 'bhx' ), 
		'parent_item_colon'  => __( 'Time Period: ', 'bhx' ),
		'menu_name'          => __( 'Timeline', 'bhx' )
	);
	
	$args = array(
		'labels'              => $labels,
		'public'              => false,
		'show_ui'             => true,
		'rewrite'             => array(
			'slug'       => 'timeline',
			'with_front' => false
		),
		'capability_type'     => 'post',
		'has_archive'         => 'visit', 
		'hierarchical'        => false,
		'menu_position'       => null,
		'supports'            => array( 'title', 'editor', 'thumbnail' )
	);

	register_post_type( 'timeline', $args );
}
add_action( 'init', 'bhx_post_type_timeline' );

/**
 * Timeline Permalink
 *
 * Create a permalink for querying the timeline JSON
 * data. This is so we can set a JSON source in the TimelineJS
 * plugin. 
 *
 * @since BHX 1.0
 *
 * @return void
 */
function bhx_timeline_rewrite() {
	add_rewrite_rule( 'timeline.json', 'index.php?bhx-timeline-json=true', 'top' );
}
add_action( 'init', 'bhx_timeline_rewrite' );

/**
 * Timeline query variable
 *
 * Register a query variable so we can use the appropriate
 * functions later when checking if we are on the corretct page.
 *
 * @since BHX 1.0
 *
 * @param array $query_vars The array of reigstered query variables
 * @return array $query_vars The updated query variables
 */
function bhx_timeline_query_vars( $query_vars ) {
    $query_vars[] = 'bhx-timeline-json';

    return $query_vars;
}
add_filter( 'query_vars', 'bhx_timeline_query_vars' );

/**
 * Timeline JSON
 *
 * If we are on the correct page, query all timeline posts
 * and output just the data we need in JSON format. This
 * is fed to the TmielineJS plugin.
 *
 * @since BHX 1.0
 *
 * @return void
 */
function bhx_timeline_json() {
	if ( ! get_query_var( 'bhx-timeline-json' ) )
		return;

	$timeline_args = array(
		'post_type' => array( 'timeline' )
	);

	$count = 0;
	$dates = $output = array();
	$times = new WP_Query( $timeline_args );
	
	while ( $times->have_posts() ) : $times->the_post();
		$image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'full' );
		
		$dates[$count][ 'startDate' ] = date( 'Y,m,d', $post->post_date );
		$dates[$count][ 'endDate' ]   = date( 'Y,m,d', $post->post_date );
		$dates[$count][ 'headline' ]  = get_the_title();
		$dates[$count][ 'text' ]      = wpautop( get_the_content() );
		$dates[$count][ 'asset' ]     = array(
			'media' => $image[0]
		);

		$count++;
	endwhile;

	$output = array(
		'timeline' => array(
			'type'           => 'default',
			'startDate'      => date( 'Y,m,d', $times->posts[0]->post_date ),
			'start_at_slide' => 0,
			'date'           => $dates
		)
	);

	echo json_encode( $output );

	die();
}
add_action( 'template_redirect', 'bhx_timeline_json' );