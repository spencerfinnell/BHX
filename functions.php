<?php
/**
 * BHX functions and definitions
 *
 * @package BHX
 * @since BHX 1.0
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 *
 * @since BHX 1.0
 */
if ( ! isset( $content_width ) )
	$content_width = 640; /* pixels */

if ( ! function_exists( 'bhx_setup' ) ):
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 *
 * @since BHX 1.0
 */
function bhx_setup() {
	/**
	 * Translation, if needed (isn't)
	 */
	load_theme_textdomain( 'bhx', get_template_directory() . '/languages' );
	
	/**
	 * Custom Theme Options
	 */
	require( get_template_directory() . '/inc/theme-options.php' );

	/**
	 * Custom Stuff
	 */
	if ( is_admin() ) {
		require( get_template_directory() . '/inc/admin.php' );
	}

	require( get_template_directory() . '/inc/educate.php' );
	require( get_template_directory() . '/inc/visit.php' );
	require( get_template_directory() . '/inc/builder.php' );
	require( get_template_directory() . '/inc/woocommerce.php' );

	/**
	 * Add default posts and comments RSS feed links to head
	 */
	add_theme_support( 'automatic-feed-links' );

	/**
	 * Enable support for Post Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );

	/**
	 * This theme uses wp_nav_menu() in one location.
	 */
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'bhx' ),
	) );

	add_image_size( 'content-grid', 400, 125, true );
}
endif; // bhx_setup
add_action( 'after_setup_theme', 'bhx_setup' );

/**
 * Enqueue scripts and styles
 */
function bhx_scripts() {
	wp_dequeue_style( 'contact-form-7' );

	wp_enqueue_style( 'google-fonts', 'http://fonts.googleapis.com/css?family=Patua+One|Glegoo|Droid+Sans' );
	wp_enqueue_style( 'style', get_template_directory_uri() . '/css/style.css' );

	wp_enqueue_script( 'jquery' );
	wp_enqueue_script( 'fancybox', get_template_directory_uri() . '/js/fancybox.min.js' );

	if ( is_home() )
		wp_enqueue_script( 'jcarousellite', get_template_directory_uri() . '/js/jcarousellite.min.js' );

	if ( is_archive() || is_search() )
		wp_enqueue_script( 'masonry', get_template_directory_uri() . '/js/masonry.min.js' );

	wp_enqueue_script( 'bhx', get_template_directory_uri() . '/js/bhx.js' );
}
add_action( 'wp_enqueue_scripts', 'bhx_scripts' );

function bhx_masonry() {
	if ( is_archive() || is_search() ) {
?>
	<script>
		jQuery(document).ready(function($) {
			$( '#stuff-grid' ).masonry({
			  itemSelector : '.hentry',
			  gutterWidth  : 40 
			});
		});
	</script>
<?php
	}
}
add_action( 'wp_head', 'bhx_masonry' );

/**
 * Creates a nicely formatted and more specific title element text
 * for output in head of document, based on current view.
 *
 * @since BHX 1.0
 *
 * @param string $title Default title text for current view.
 * @param string $sep Optional separator.
 * @return string Filtered title.
 */
function bhx_wp_title( $title, $sep ) {
	global $paged, $page;

	if ( is_feed() )
		return $title;

	// Add the site name.
	$title .= get_bloginfo( 'name' );

	// Add the site description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		$title = "$title $sep $site_description";

	// Add a page number if necessary.
	if ( $paged >= 2 || $page >= 2 )
		$title = "$title $sep " . sprintf( __( 'Page %s', 'bhx' ), max( $paged, $page ) );

	return $title;
}
add_filter( 'wp_title', 'bhx_wp_title', 10, 2 );

/**
 * Excerpt Ending
 *
 * @since BHX 1.0
 *
 * @return string Three periods
 */
function bhx_excerpt_more() {
	return '...';
}
add_filter( 'excerpt_more', 'bhx_excerpt_more' );

/**
 * Archive Pagination
 *
 * Use numeric links instead of older/newer as those terms don't
 * have any relevance in most situations.
 *
 * @since BHX 1.0
 *
 * @return void
 */
function bhx_pagination() {
	global $wp_query;

	$big = 999999999;
?>
	<div id="pagination-wrap">
		<div id="pagination">
		<?php 
			echo paginate_links( array(
				'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
				'format' => '?paged=%#%',
				'current' => max( 1, get_query_var('paged') ),
				'total' => $wp_query->max_num_pages
			) );
		?>
		</div>
	</div>
<?php
}

/**
 * Taxonomy/Archive Sorting
 *
 * Get all terms for a specific taxnomy and output the links.
 * An action before and after it allows for prepending of other
 * custom/static links to the lists.
 *
 * @since BHX 1.0
 *
 * @return void
 */
function bhx_archive_sorting( $taxonomy = null ) {
	$terms = get_terms( $taxonomy, array( 'hide_empty' => false ) );

	do_action( 'bhx_archive_sorting_before_' . $taxonomy, $taxonomy );

	foreach ( $terms as $term )  {
?>
	<li <?php echo is_tax( $taxonomy, $term->slug ) ? ' class="active"' : ''; ?>>
		<a href="<?php echo get_term_link( $term->slug, $taxonomy ); ?>"><?php echo esc_attr( $term->name ); ?></a>
	</li>
<?php
	}

	do_action( 'bhx_archive_sorting_after_' . $taxonomy, $taxonomy );
}

/**
 * Visit Sorting Links
 *
 * Prepend a "Plan a Trip" link before taxonomy links.
 *
 * @since BHX 1.0
 *
 * @return void
 */
function bhx_archive_sorting_before_visit_type() {
?>
	<li><a href="<?php echo esc_url( get_permalink( bhx_get_theme_option( 'page_builder' ) ) ); ?>"><?php _e( 'Plan a Trip', 'bhx' ); ?></a></li>
<?php
}
add_action( 'bhx_archive_sorting_before_visit-type', 'bhx_archive_sorting_before_visit_type' );

/**
 * Educate Sorting Links
 *
 * Prepend a "Interactive Timeline" and "Historic Sites" 
 * links before taxonomy links.
 *
 * @since BHX 1.0
 *
 * @return void
 */
function bhx_archive_sorting_before_educational_resource_type() {
?>
	<li><a href="<?php echo esc_url( get_permalink( bhx_get_theme_option( 'page_timeline' ) ) ); ?>"><?php _e( 'Interactive Timeline', 'bhx' ); ?></a></li>
	<li><a href="<?php echo get_post_type_archive_link( 'site' ); ?>"><?php _e( 'Historic Sites', 'bhx' ); ?></a></li>
<?php
}
add_action( 'bhx_archive_sorting_before_educational-resource-type', 'bhx_archive_sorting_before_educational_resource_type' );

/**
 * Site Sorting Links
 *
 * Prepend a "All" link before taxonomy links.
 *
 * @since BHX 1.0
 *
 * @return void
 */
function bhx_archive_sorting_before_site_type() {
?>
	<li <?php echo is_post_type_archive() ? ' class="active"' : ''; ?>><a href="<?php echo get_post_type_archive_link( 'site' ); ?>"><?php _e( 'All', 'bhx' ); ?></a></li>
<?php
}
add_action( 'bhx_archive_sorting_before_site-type', 'bhx_archive_sorting_before_site_type' );