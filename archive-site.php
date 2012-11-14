<?php
/**
 * The template for displaying Search Results pages.
 *
 * @package BHX
 * @since BHX 1.0
 */

global $wp_query;

$terms  = get_terms( 'site-type', array( 'hide_empty' => 0 ) );
$output = array();

$tax = get_queried_object();

if ( ! empty( $terms ) ) :
	foreach ( $terms as $term ) :
		$output[] = sprintf( '<li %s><a href="%s">%s</a></li>', ( is_tax() && $term->slug == $tax->slug ) ? ' class="active"' : '', get_term_link( $term, 'site-type' ), $term->name );
	endforeach;
endif;

get_header(); ?>

	<?php if ( have_posts() ) : ?>

		<div id="page-header">
			<h1 class="page-title"><span><?php echo is_post_type_archive() ? post_type_archive_title() : single_term_title(); ?></span></h1>
			<?php if ( ! empty( $output ) ) : ?>
			<ul class="page-sorting">
				<li <?php echo is_post_type_archive() ? ' class="active"' : ''; ?>><a href="<?php echo get_post_type_archive_link( 'site' ); ?>"><?php _e( 'All', 'bhx' ); ?></a></li>
				<?php echo implode( '', $output ); ?>
			</ul>
			<?php endif; ?>

			<?php get_search_form(); ?>
		</div>

		<div id="stuff-grid">
			<?php while ( have_posts() ) : the_post(); ?>
				<?php get_template_part( 'content' ); ?>
			<?php endwhile; ?>
		</div>

		<div id="pagination">
			<?php previous_posts_link(); ?>
			<?php next_posts_link(); ?>
		</div>

	<?php else : ?>

		<?php get_template_part( 'no-results', 'search' ); ?>

	<?php endif; ?>

<?php get_footer(); ?>