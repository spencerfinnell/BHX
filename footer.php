<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content after
 *
 * @package BHX
 * @since BHX 1.0
 */
?>
	
		</div>

		<footer id="colophon">
			<div id="contact">
				<a href="<?php echo esc_url( get_permalink( get_page_by_path( 'contact' ) ) ); ?>"><i class="icon-mail"></i> <?php _e( 'Send us an Email', 'bhx' ); ?></a>
				<a href="tel:9043259679"><i class="icon-phone"></i> <?php _e( '(904) 325-9679', 'bhx' ); ?></a>
			</div>

			<div id="social">
				<a href="<?php echo esc_url( sprintf( 'http://twitter.com/%s', bhx_get_theme_option( 'twitter' ) ) ); ?>" class="twitter"><i class="icon-twitter"></i> <?php _e( 'Follow us on Twitter', 'bhx' ); ?></a>
				<a href="#<?php echo esc_url( sprintf( 'http://facebook.com/%s', bhx_get_theme_option( 'facebook' ) ) ); ?>" class="facebook"><i class="icon-facebook"></i> <?php _e( 'Like us on Facebook', 'bhx' ); ?></a>
			</div>
		</footer>
	</div><!-- #wrapper -->
</div><!-- #page -->

<div id="section-educate" class="section-modal">
	<ul id="sections">
		<li class="full"><a href="<?php echo esc_url( get_permalink( bhx_get_theme_option( 'page_timeline' ) ) ); ?>"><i class="icon-share"></i> <?php _e( 'Interactive Timeline', 'bhx' ); ?></a></li>
		<li class="fake"></li>
		<li><a href="<?php echo esc_url( get_post_type_archive_link( 'xtraordinary' ) ); ?>"><i class="icon-star"></i> <?php _e( 'Xtraordinary People', 'bhx' ); ?></a></li>
		<li><a href="<?php echo get_post_type_archive_link( 'site' ); ?>"><i class="icon-picture"></i> <?php _e( 'Historic Sites', 'bhx' ); ?></a></li>
		<li><a href="<?php echo get_term_link( 'literature', 'educational-resource-type' ); ?>"><i class="icon-newspaper"></i> <?php _e( 'Literature', 'bhx' ); ?></a></li>
		<li><a href="<?php echo get_term_link( 'documentary', 'educational-resource-type' ); ?>"><i class="icon-mic"></i> <?php _e( 'Documentaries', 'bhx' ); ?></a></li>
	</ul>
</div>

<div id="section-visit" class="section-modal">
	<ul id="sections">
		<li class="full"><a href="<?php echo esc_url( get_permalink( bhx_get_theme_option( 'page_builder' ) ) ); ?>"><i class="icon-attachment"></i> <?php _e( 'Trip Planner', 'bhx' ); ?></a></li>
		<li class="fake"></li>
		<li><a href="<?php echo get_term_link( 'tours', 'visit-type' ); ?>"><i class="icon-pin"></i> <?php _e( 'Tours', 'bhx' ); ?></a></li>
		<li><a href="<?php echo get_term_link( 'attractions', 'visit-type' ); ?>"><i class="icon-rocket"></i> <?php _e( 'Attractions', 'bhx' ); ?></a></li>
		<li><a href="<?php echo get_term_link( 'lodging', 'visit-type' ); ?>"><i class="icon-home"></i> <?php _e( 'Lodging', 'bhx' ); ?></a></li>
		<li><a href="<?php echo get_term_link( 'restaurants', 'visit-type' ); ?>"><i class="icon-cake"></i> <?php _e( 'Restaurants', 'bhx' ); ?></a></li>
	</ul>
</div>

<?php wp_footer(); ?>

</body>
</html>