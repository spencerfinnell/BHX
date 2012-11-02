<?php
/**
 * @package BHX
 * @since BHX 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="entry">
		<div class="entry-header">
			<h1 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'bhx' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h1>
		</div>

		<div class="entry-summary">
			<?php the_excerpt(); ?>
		</div><!-- .entry-summary -->

		<?php if ( is_search() || is_archive() ) : ?>
		<div class="entry-type">
			<a href="#" class="button flat">Historic Site</a> <a href="#" class="all">View All</a>
		</div>
		<?php endif; ?>
	</div>
</article><!-- #post-<?php the_ID(); ?> -->
