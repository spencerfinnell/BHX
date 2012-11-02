<?php
/**
 * The template for displaying Search Results pages.
 *
 * @package BHX
 * @since BHX 1.0
 */

global $wp_query;

//$taxonomies = get_taxonomies( array( 'object_type' => array( get_query_var( 'post_type' ) ) ) );

$terms  = get_terms( 'site-type' );
$output = array();

if ( ! empty( $terms ) ) :
	foreach ( $terms as $term ) :
		$output[] = sprintf( '<a href="%s">%s</a>', get_term_link( $term, 'site-type' ), $term->name );
	endforeach;
endif;

get_header(); ?>

	<?php if ( have_posts() ) : ?>

		<div id="page-header">
			<h1 class="page-title"><span><?php echo is_post_type_archive() ? post_type_archive_title() : single_term_title(); ?></span></h1>
			<?php if ( ! empty( $output ) ) : ?>
			<ul class="page-sorting">
				<li><a href="<?php echo get_post_type_archive_link( 'site' ); ?>"><?php _e( 'All', 'bhx' ); ?></a></li>
				<li><?php echo implode( '</li><li>', $output ); ?></li>
			</ul>
			<?php endif; ?>
		</div>

		<div id="stuff-list">
			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'content', 'list' ); ?>

			<?php endwhile; ?>
		</div>

	<?php else : ?>

		<?php get_template_part( 'no-results', 'search' ); ?>

	<?php endif; ?>

<?php get_footer(); ?>