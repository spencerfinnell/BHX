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

/**
 * Trip Planner
 *
 * Monitor for the trip planner form submission. If the form
 * is submitted, find what they need, and return it along
 * with the custom page template
 *
 * @since BHX 1.0
 *
 * @return void
 */
function bhx_builder() {
	global $results;

	if ( ! isset( $_POST[ 'action' ] ) )
		return;
		
	if ( 'bhx-trip-builder' != $_POST[ 'action' ] )
		return; 
	
	/** See what they need */
	$tours       = isset ( $_POST[ 'tours' ] ) ? $_POST[ 'tours' ] : null;
	$attractions = isset ( $_POST[ 'attractions' ] ) ? $_POST[ 'attractions' ] : null;
	$restaraunts = isset ( $_POST[ 'restaraunts' ] ) ? $_POST[ 'restaraunts' ] : null;
	$lodging     = isset ( $_POST[ 'lodging' ] ) ? $_POST[ 'lodging' ] : null;

	/** All require the same arguments */
	$args = array(
		'post_type'      => array( 'visit' ),
		'posts_per_page' => 5
	);

	/** Tours */
	if ( $tours ) {
		$tour_args = array(
			'tax_query' => array(
				'relation' => 'AND',
				array(
					'taxonomy' => 'visit-price',
					'field'    => 'slug',
					'terms'    => $tours[ 'prices' ]
				),
				array(
					'taxonomy' => 'visit-type',
					'field'    => 'slug',
					'terms'    => array( 'tours' )
				),
			)
		);

		$tours = get_posts( array_merge( $tour_args, $args ) );
	}

	/** Attractions */
	if ( $attractions ) {
		$attraction_args = array(
			'tax_query' => array(
				'relation' => 'AND',
				array(
					'taxonomy' => 'visit-price',
					'field'    => 'slug',
					'terms'    => $attractions[ 'prices' ]
				),
				array(
					'taxonomy' => 'visit-type',
					'field'    => 'slug',
					'terms'    => array( 'attraction' )
				),
			)
		);

		$attractions = get_posts( array_merge( $attraction_args, $args ) );
	}

	/** Restaraunts */
	if ( $restaraunts ) {
		$restaraunt_args = array(
			'tax_query' => array(
				'relation' => 'AND',
				array(
					'taxonomy' => 'visit-type',
					'field'    => 'slug',
					'terms'    => array( 'restaraunts' )
				),
			)
		);

		if ( ! empty( $restaraunts[ 'prices' ] ) ) {
			$restaraunt_args[ 'tax_query' ][] = array(
				'taxonomy' => 'visit-price',
				'field'    => 'slug',
				'terms'    => $restaraunts[ 'prices' ]
			);
		}

		if ( ! empty( $restaraunts[ 'stars' ] ) ) {
			$restaraunt_args[ 'tax_query' ][] = array(
				'taxonomy' => 'visit-stars',
				'field'    => 'slug',
				'terms'    => $restaraunts[ 'stars' ]
			);
		}

		$restaraunts = get_posts( array_merge( $restaraunt_args, $args ) );
	}

	/** Lodging */
	if ( $lodging ) {
		$lodging_args = array(
			'tax_query' => array(
				'relation' => 'AND',
				array(
					'taxonomy' => 'visit-type',
					'field'    => 'slug',
					'terms'    => array( 'lodging' )
				),
			)
		);

		if ( ! empty( $lodging[ 'prices' ] ) ) {
			$lodging_args[ 'tax_query' ][] = array(
				'taxonomy' => 'visit-price',
				'field'    => 'slug',
				'terms'    => $lodging[ 'prices' ]
			);
		}

		if ( ! empty( $lodging[ 'stars' ] ) ) {
			$lodging_args[ 'tax_query' ][] = array(
				'taxonomy' => 'visit-stars',
				'field'    => 'slug',
				'terms'    => $lodging[ 'stars' ]
			);
		}

		$lodging = get_posts( array_merge( $lodging_args, $args ) );
	}

	$results = compact( 'tours', 'attractions', 'restaraunts', 'lodging' );

	require( get_template_directory() . '/page-templates/builder.php' );
	exit();
}
add_action( 'template_redirect', 'bhx_builder' );

/**
 * Suggestion Meta
 *
 * For suggestions, display the price (and stars if needed).
 *
 * @TODO Make this not so terrible. Should be used on the
 * single page as well.
 *
 * @since BHX 1.0
 *
 * @return void
 */
function bhx_builder_suggestion_meta( $result_id, $section ) {
	$prices = wp_get_object_terms( $result_id, 'visit-price' );
		
	if ( $prices ) {
		$pricez = array();

		foreach ( $prices as $price ) {
			$pricez[] = '<span class="price">' . $price->name . '</span>';
		}

		echo implode( ', ', $pricez );
	}

	if ( ! in_array( $section, array( 'restaraunt', 'lodging' ) ) )
		return;

	$stars = wp_get_object_terms( $result_id, 'visit-stars' );

	if ( $stars ) {
		if ( $stars[0]->slug == '5-stars' )
			$count = 5;
		elseif ( $stars[0]->slug == '4-stars' )
			$count = 4;
		else
			$count = 3;

		echo '<span class="stars">';
		for ( $i = 0; $i < $count; $i++ )
			echo '<i class="icon-star"></i>';
		echo '</span>';
	}
}

/**
 * Planner Icons
 *
 * Depending on the section, load a certain icon name.
 *
 * @since BHX 1.0
 *
 * @return void
 */
function bhx_builder_section_icon( $section ) {
	if ( 'tours' == $section )
		$icon = 'pin';
	elseif ( 'attractions' == $section )
		$icon = 'rocket';
	elseif ( 'restaraunts' == $section )
		$icon = 'cake';
	else
		$icon = 'home';

	echo $icon;
}