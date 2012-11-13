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
	if ( is_admin() )
		return;

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
		'menu_name'         => __( 'Resource Types', 'bhx'  ),
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
 * Custom Columns
 *
 * @since BHX 1.0
 *
 * @param array $columns The columns to display
 * @return array $columns The modified list of columns to display
 */
function bhx_post_type_educational_columns( $columns ) {
	$columns = array(
		'cb'       => '<input type="checkbox" />',
		'title'    => __( 'Site', 'bhx' ),
		'category' => __( 'Resource Type', 'bhx' ),
		'date'     => __( 'Published', 'bhx' )
	);

	return $columns;
}
add_filter( 'manage_edit-educational_columns', 'bhx_post_type_educational_columns' ) ;

/**
 * Custom Column Content
 *
 * @since BHX 1.0
 *
 * @param string $column The current column slug
 * @param in $post_id The current row's associated post ID
 * @return void
 */
function bhx_post_type_educational_columns_manage( $column, $post_id ) {
	global $post;

	switch( $column ) {
		case 'category' :
			echo get_the_term_list( $post_id, 'educational-resource-type', '', ', ' );
			break;
		case 'location' :
			echo 'Somewhere';
			break;
		default :
			break;
	}
}
add_action( 'manage_educational_posts_custom_column', 'bhx_post_type_educational_columns_manage', 10, 2 );

/**
 * Taxonomy Sorting
 *
 * @since BHX 1.0
 *
 * @return void
 */
function bhx_post_type_educational_sort() {
	global $typenow;
 
	if ( $typenow != 'educational' )
		return;

	bhx_post_type_taxonomy_sort( array( 'educational-resource-type' ) );
}
add_action( 'restrict_manage_posts', 'bhx_post_type_educational_sort' );

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
 * Metaboxes
 *
 * @since BHX 1.0
 *
 * @return void
 */
function bhx_post_type_site_metabox() {
	add_meta_box( 'site-info', __( 'Site Information', 'bhx' ), 'bhx_post_type_site_metabox_information', 'site', 'normal', 'high' );
}
add_action( 'add_meta_boxes', 'bhx_post_type_site_metabox' );

/**
 * Information Metabox
 *
 * @since BHX 1.0
 *
 * @return void
 */
function bhx_post_type_site_metabox_information() {
	global $post;

	wp_nonce_field( 'bhx-site-information', 'bhx-save-site-information' );

	$link = get_post_meta( $post->ID, 'bhx-link', true );
	$loc  = get_post_meta( $post->ID, 'bhx-location', true );
?>
	<p>
		<label for="bhx-link"><?php _e( 'More Information Link', 'bhx' ); ?>: <br />
		<input type="text" name="bhx-link" id="bhx-link" style="width: 100%" class="code" value="<?php echo esc_attr( $link ); ?>" />
	</p>

	<p>
		<label for="bhx-location"><?php _e( 'Longitude and Latitude', 'bhx' ); ?>: <br />
		<input type="text" name="bhx-location" id="bhx-location" style="width: 100%" class="code" value="<?php echo esc_attr( $loc ); ?>" />
	</p>
<?php
}

/**
 * Save the Time Period Metabox
 *
 * Convert the human date to a format that can be used by
 * the interactive timeline. It is automatically reformatted on ouput.
 *
 * @since BHX 1.0
 *
 * @param int $post_id The ID of the post being saved
 * @return void
 */
function bhx_post_type_site_metabox_save( $post_id ) {
	if ( empty( $_POST ) )
		return $post_id;

	/** Don't save when autosaving */
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) 
		return $post_id;

	if ( ! isset( $_POST[ 'post_type' ] ) || ! in_array( $_POST[ 'post_type' ], array( 'site' ) ) )
		return $post_id;
	
	/** Check Nonce */
	if ( ! wp_verify_nonce( $_POST[ 'bhx-save-site-information' ], 'bhx-site-information' ) )
		return $post_id;
	
	$link = trim( esc_attr( $_POST[ 'bhx-link' ] ) );
	$loc  = esc_attr( $_POST[ 'bhx-location' ] );

	update_post_meta( $post_id, 'bhx-link', $link );
	update_post_meta( $post_id, 'bhx-location', $loc );
}
add_action( 'save_post', 'bhx_post_type_site_metabox_save' );

/**
 * Taxonomy Sorting
 *
 * @since BHX 1.0
 *
 * @return void
 */
function bhx_post_type_site_sort() {
	global $typenow;
 
	if ( $typenow != 'site' )
		return;

	bhx_post_type_taxonomy_sort( array( 'site-type' ) );
}
add_action( 'restrict_manage_posts', 'bhx_post_type_site_sort' );

/**
 * Custom Columns
 *
 * @since BHX 1.0
 *
 * @param array $columns The columns to display
 * @return array $columns The modified list of columns to display
 */
function bhx_post_type_site_columns( $columns ) {
	$columns = array(
		'cb'       => '<input type="checkbox" />',
		'title'    => __( 'Site', 'bhx' ),
		'category' => __( 'Category', 'bhx' ),
		'location' => __( 'Location', 'bhx' ),
		'date'     => __( 'Published', 'bhx' )
	);

	return $columns;
}
add_filter( 'manage_edit-site_columns', 'bhx_post_type_site_columns' ) ;

/**
 * Custom Column Content
 *
 * @since BHX 1.0
 *
 * @param string $column The current column slug
 * @param in $post_id The current row's associated post ID
 * @return void
 */
function bhx_post_type_site_columns_manage( $column, $post_id ) {
	global $post;

	switch( $column ) {
		case 'category' :
			echo get_the_term_list( $post_id, 'site-type', '',  ', ' );
			break;
		case 'location' :
			echo get_post_meta( $post->ID, 'bhx-location', true );
			break;
		default :
			break;
	}
}
add_action( 'manage_site_posts_custom_column', 'bhx_post_type_site_columns_manage', 10, 2 );

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
		'public'              => true,
		'rewrite'             => array(
			'slug'       => 'timeline',
			'with_front' => false
		),
		'capability_type'     => 'post',
		'has_archive'         => 'visit', 
		'hierarchical'        => false,
		'menu_position'       => null,
		'supports'            => array( 'title', 'editor', 'thumbnail' ),
		'show_in_menu'        => 'edit.php?post_type=educational'
	);

	register_post_type( 'timeline', $args );
}
add_action( 'init', 'bhx_post_type_timeline' );

/**
 * Custom Columns
 *
 * @since BHX 1.0
 *
 * @param array $columns The columns to display
 * @return array $columns The modified list of columns to display
 */
function bhx_post_type_timeline_columns( $columns ) {
	$columns = array(
		'cb'       => '<input type="checkbox" />',
		'title'    => __( 'Site', 'bhx' ),
		'period'   => __( 'Time Period', 'bhx' )
	);

	return $columns;
}
add_filter( 'manage_edit-timeline_columns', 'bhx_post_type_timeline_columns' ) ;

/**
 * Custom Column Content
 *
 * @since BHX 1.0
 *
 * @param string $column The current column slug
 * @param in $post_id The current row's associated post ID
 * @return void
 */
function bhx_post_type_timeline_columns_manage( $column, $post_id ) {
	global $post;

	switch( $column ) {
		case 'period' :
			echo bhx_post_type_timeline_formatted_date( $post_id );
			break;
		default :
			break;
	}
}
add_action( 'manage_timeline_posts_custom_column', 'bhx_post_type_timeline_columns_manage', 10, 2 );

/**
 * Metaboxes
 *
 * @since BHX 1.0
 *
 * @return void
 */
function bhx_post_type_timeline_metabox() {
	add_meta_box( 'timeline-date', __( 'Time Period', 'bhx' ), 'bhx_post_type_timeline_metabox_time', 'timeline', 'side', 'high' );
}
add_action( 'add_meta_boxes', 'bhx_post_type_timeline_metabox' );

/**
 * Time metabox output
 *
 * Outputs a single input to add a date the time happened.
 *
 * @since BHX 1.0
 *
 * @return void
 */
function bhx_post_type_timeline_metabox_time() {
	global $post;

	wp_nonce_field( 'bhx-time-period', 'bhx-save-time-period' );
?>
	<input type="text" name="bhx-time-period" id="bhx-time-period" style="width: 100%" value="<?php echo bhx_post_type_timeline_formatted_date( $post->ID ); ?>" />
<?php
}

/**
 * Save the Time Period Metabox
 *
 * Convert the human date to a format that can be used by
 * the interactive timeline. It is automatically reformatted on ouput.
 *
 * @since BHX 1.0
 *
 * @param int $post_id The ID of the post being saved
 * @return void
 */
function bhx_post_type_timeline_metabox_save( $post_id ) {
	if ( empty( $_POST ) )
		return $post_id;

	/** Don't save when autosaving */
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) 
		return $post_id;

	if ( ! isset( $_POST[ 'post_type' ] ) || ! in_array( $_POST[ 'post_type' ], array( 'timeline' ) ) )
		return $post_id;
	
	/** Check Nonce */
	if ( ! wp_verify_nonce( $_POST[ 'bhx-save-time-period' ], 'bhx-time-period' ) )
		return $post_id;
		
	$period = esc_attr( $_POST[ 'bhx-time-period' ] );
	$period = new DateTime( $period );

	update_post_meta( $post_id, 'bhx-time-period', $period->format( 'Y,m,d' ) );
}
add_action( 'save_post', 'bhx_post_type_timeline_metabox_save' );

/**
 * Format the Time Period
 *
 * Create a date from the weird format used by the Timeline,
 * and output it in its localized format.
 *
 * @since BHX 1.0
 *
 * @param int $post_id The ID of the post being saved
 * @return void
 */
function bhx_post_type_timeline_formatted_date( $post_id ) {
	$period = get_post_meta( $post_id, 'bhx-time-period', true );

	if ( ! $period )
		$period = null;
	else {
		$period = DateTime::createFromFormat( 'Y,m,d', $period );
		$period = $period->format( get_option( 'date_format' ) );
	}

	return esc_attr( $period );
}

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
		'post_type'      => array( 'timeline' ),
		'posts_per_page' => -1
	);

	$count = 0;
	$dates = $output = array();
	$times = new WP_Query( $timeline_args );
	
	while ( $times->have_posts() ) : $times->the_post();
		$image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'full' );
		$date  = get_post_meta( get_the_ID(), 'bhx-time-period', true );

		if ( ! $date )
			continue;

		$content = get_the_excerpt();
		$content .= '<p><a href="' . get_permalink( get_the_ID() ) . '" class="fancybox">Read More &rarr;</a></p>';
		
		$dates[$count][ 'startDate' ] = $date;
		$dates[$count][ 'endDate' ]   = $date;
		$dates[$count][ 'headline' ]  = get_the_title();
		$dates[$count][ 'text' ]      = wpautop( $content );
		$dates[$count][ 'asset' ]     = array(
			'media' => $image[0]
		);

		$count++;
	endwhile;

	$output = array(
		'timeline' => array(
			'type'           => 'default',
			'startDate'      => get_post_meta( $times->posts[0]->ID, 'bhx-time-period', true ),
			'start_at_slide' => 0,
			'date'           => $dates
		)
	);

	echo json_encode( $output );

	die();
}
add_action( 'template_redirect', 'bhx_timeline_json' );