<?php
/**
 * The template for displaying Archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package BHX
 * @since BHX 1.0
 */

get_header(); ?>

	<?php if ( have_posts() ) : ?>

		<div id="page-header" class="<?php echo is_tax() ? '' : 'no-sorting'; ?>">
			<h1 class="page-title"><span>
				<?php
					if ( is_category() ) {
						printf( __( 'Category Archives: %s', 'bhx' ), '<span>' . single_cat_title( '', false ) . '</span>' );
					} elseif ( is_tag() ) {
						printf( __( 'Tag Archives: %s', 'bhx' ), '<span>' . single_tag_title( '', false ) . '</span>' );
					} elseif ( is_author() ) {
						the_post();
						printf( __( 'Author Archives: %s', 'bhx' ), '<span class="vcard"><a class="url fn n" href="' . get_author_posts_url( get_the_author_meta( "ID" ) ) . '" title="' . esc_attr( get_the_author() ) . '" rel="me">' . get_the_author() . '</a></span>' );
						rewind_posts();
					} elseif ( is_day() ) {
						printf( __( 'Daily Archives: %s', 'bhx' ), '<span>' . get_the_date() . '</span>' );
					} elseif ( is_month() ) {
						printf( __( 'Monthly Archives: %s', 'bhx' ), '<span>' . get_the_date( 'F Y' ) . '</span>' );
					} elseif ( is_year() ) {
						printf( __( 'Yearly Archives: %s', 'bhx' ), '<span>' . get_the_date( 'Y' ) . '</span>' );
					} elseif ( is_tax() ) {
						echo single_term_title();
					} else {
						_e( 'Archives', 'bhx' );
					}
				?>
			</span></h1>

			<?php if ( is_tax() ) : ?>
			<ul class="page-sorting">
				<?php bhx_archive_sorting( get_queried_object()->taxonomy ); ?>
			</ul>
			<?php endif; ?>
		</div><!-- .page-header -->

		<div id="stuff-grid">
			<?php while ( have_posts() ) : the_post(); ?>
				<?php get_template_part( 'content' ); ?>
			<?php endwhile; ?>
		</div>

		<?php bhx_pagination(); ?>

	<?php else : ?>
		<?php get_template_part( 'no-results', 'archive' ); ?>
	<?php endif; ?>

<?php get_footer(); ?>