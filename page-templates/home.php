<?php
/**
 * Template Name: Home
 *
 * Custom Homepage template. As one would guess.
 *
 * @package BHX
 * @since BHX 1.0
 */

get_header();
?>

	<div id="search" class="divider">
		<form id="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>" method="get" class="row">
			<label for="s" class="span2"><?php _e( 'Find Something:', 'bhx' ); ?></label>
			<input type="text" name="s" class="span10" />
			<input type="submit" name="submit" class="span2" value="<?php esc_attr_e( 'Search', 'bhx' ); ?>" />
		</form>
	</div><!-- #search -->

	<div id="featured-slider" class="divider row">
		<div id="featured-slider-text" class="featured-slider-slides span4 offset1">
			<ul>
				<?php
					$slider_args = array(
						'post_type' => array( 'educational', 'site', 'visit' ),
						'posts_per_page' => 5,
						'orderby' => 'rand'
					);

					$slider = new WP_Query( $slider_args );

					while ( $slider->have_posts() ) : $slider->the_post();
				?>
				<li>
					<h3><?php the_title(); ?></h3>

					<?php the_excerpt(); ?>

					<p class="learn">
						<a href="<?php the_permalink(); ?>" class="button"><?php _e( 'Learn More', 'bhx' ); ?></a>
					</p>
				</li>
				<?php endwhile; ?>
			</ul>

			<div id="featured-slider-navigation">
				<a href="#" class="previous"><i class="icon-arrow-left"></i></a>
				<a href="#" class="next"><i class="icon-arrow-right"></i></a>
			</div>
		</div>

		<div id="featured-slider-image" class="span10">
			<ul>
				<?php while ( $slider->have_posts() ) : $slider->the_post(); ?>
				<li><a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'home-slider' ); ?></a></li>
				<?php endwhile; ?>
			</ul>
		</div>
	</div><!-- #featured-slider -->

	<ul id="xstuff" class="container divider">
		<li class="x-action">
			<a href="#"><img src="<?php echo get_template_directory_uri(); ?>/images/lipsum/action-knowledge.jpg" alt="" /></a>
			<h3><span>X</span>pand Your Knowledge</h3>
			<p>Visit our website for a listing of black history <a href="<?php echo get_term_link( 'literature', 'educational-resource-type' ); ?>">books</a> and <a href="<?php echo get_term_link( 'documentary', 'educational-resource-type' ); ?>">documentaries</a>. Also, don't forget to check out our <a href="<?php echo esc_url( get_permalink( bhx_get_theme_option( 'page_timeline' ) ) ); ?>">interactive timeline</a>.</p>
		</li>

		<li class="x-action">
			<a href="#"><img src="<?php echo get_template_directory_uri(); ?>/images/lipsum/action-excursion.png" alt="" /></a>
			<h3>Plan Your <span>X</span>cursion</h3>
			<p>Reserve a walking, carriage, or trolley <a href="<?php echo get_term_link( 'tours', 'visit-type' ); ?>">tour</a> of Saint Augustine's black history. Self-guided tours are also available <a href="<?php echo esc_url( get_permalink( get_page_by_path( 'contact' ) ) ); ?>">upon request</a>.</p>
		</li>

		<li class="x-action">
			<a href="#"><img src="<?php echo get_template_directory_uri(); ?>/images/lipsum/action-tour.png" alt="" /></a>
			<h3><span>X</span>plore the History</h3>
			<p><a href="<?php echo esc_url( get_permalink( get_page_by_path( 'contact' ) ) ); ?>">Contact us</a> for recommendations on <a href="<?php echo get_term_link( 'lodging', 'visit-type' ); ?>">hotels</a>, <a href="<?php echo get_term_link( 'restaurants', 'visit-type' ); ?>">restaurants</a>, and <a href="<?php echo get_term_link( 'attractions', 'visit-type' ); ?>">other attractions</a> to enjoy while in beautiful Saint Augustine.</p>
		</li>
	</ul><!-- #xstuff -->

	<div id="young" class="container">
		<blockquote>
			<p class="grabber">For decades, millions upon millions of Florida tourists have visited St. Augustine, which is celebrated as 
<em>America’s oldest city</em> and known for its vital role the nation’s history, yet almost all those people have come and 
gone without hearing a word about the area’s rich African American heritage.</p>

			<cite>Civil Rights Leader, Andrew Young <span class="dash">&mdash;</span> <a href="<?php echo esc_url( get_attachment_link(760) ); ?>">Read the Full Letter &rarr;</a></cite>
		</blockquote>
	</div><!-- #young -->

<?php get_footer(); ?>