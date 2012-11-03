<?php

/**
 * Timeline
 *
 * @since BHX 1.0
 */
function bhx_post_type_timeline() {
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
		'menu_name'          => __( 'Time Periods', 'bhx' )
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
		'supports'            => array( 'title', 'editor', 'thumbnail' ),
		'show_in_menu'        => 'bhx'
	);

	register_post_type( 'timeline', $args );
}
add_action( 'init', 'bhx_post_type_timeline' );

function bhx_timeline_rewrite() {
	add_rewrite_rule( 'timeline.json', 'index.php?bhx-timeline-json=true', 'top' );
}
add_action( 'init', 'bhx_timeline_rewrite' );

function bhx_timeline_query_vars( $query_vars ) {
    $query_vars[] = 'bhx-timeline-json';

    return $query_vars;
}
add_filter( 'query_vars', 'bhx_timeline_query_vars' );

function bhx_post_date_to_timeline_date( $date ) {
	$date = strtotime( $date );
	$date = date( 'Y,m,d', $date );

	return $date;
}

function bhx_timeline_json( $wp ) {
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
		
		$dates[$count][ 'startDate' ] = bhx_post_date_to_timeline_date( get_the_date() );
		$dates[$count][ 'endDate' ]   = bhx_post_date_to_timeline_date( get_the_date() );
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
			'startDate'      => bhx_post_date_to_timeline_date( $times->posts[0]->post_date ),
			'start_at_slide' => 0,
			'date'           => $dates
		)
	);

	echo json_encode( $output );

	die();
}
add_action( 'template_redirect', 'bhx_timeline_json' );