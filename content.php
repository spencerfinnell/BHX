<?php
/**
 * @package BHX
 * @since BHX 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'row divider' ); ?>>
	<div class="featured-image span5 offset1">
		<span class="overlay"><a href="#"><i class="icon-pin"></i> Get Directions</a></span>
		<a href="#"><img src="<?php echo get_template_directory_uri(); ?>/images/lipsum/list.jpg" alt="" /></a>
	</div>

	<div class="entry span9">
		<div class="entry-header">
			<h1 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'bhx' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h1>
		</div>

		<div class="entry-summary">
			<?php the_excerpt(); ?>
		</div><!-- .entry-summary -->
	</div>
</article><!-- #post-<?php the_ID(); ?> -->
