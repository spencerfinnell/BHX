<?php
/**
 * The template part for displaying a message that posts cannot be found.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package BHX
 * @since BHX 1.0
 */
?>

<div id="page-header">
	<h1 class="page-title"><span><?php _e( 'No Results', 'bhx' ); ?></span></h1>
	<span class="page-meta"><?php _e( 'Try searching on the right.', 'bhx' ); ?></span>

	<?php get_search_form(); ?>
</div>

<article id="post-0" class="hentry row">
	<div class="span14 offset1">
		<?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>
			<p><?php printf( __( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'bhx' ), admin_url( 'post-new.php' ) ); ?></p>
		<?php elseif ( is_search() ) : ?>
			<p><?php _e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'bhx' ); ?></p>
		<?php else : ?>
			<p><?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'bhx' ); ?></p>
		<?php endif; ?>
	</div><!-- .entry-content -->
</article><!-- #post-0 .post .no-results .not-found -->
