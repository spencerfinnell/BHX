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
		<div id="featured-slider-text" class="span4 offset1">
			<ul>
				<li>
					<h3>BHX's Featured Person of the Week</h3>

					<p>Did you know? The legendary singer Ray Charles went to school here in St. Augustine.</p>

					<p>Ray attended <a href="#">Florida School for the Deaf and Blind</a>, formerly named The Institute for the Blind, Deaf and Dumb, after becoming blind during his youth.</p>

					<p class="learn">
						<a href="#" class="button">Learn More</a>
					</p>
				</li>
			</ul>

			<div id="featured-slider-navigation">
				<a href="#" class="previous"><i class="icon-arrow-left"></i></a>
				<a href="#" class="next"><i class="icon-arrow-right"></i></a>
			</div>
		</div>

		<div id="featured-slider-image" class="span10">
			<ul>
				<li><a href="#"><img src="images/lipsum/charles.jpg" alt="" width="580" height="300" /></a></li>
			</ul>
		</div>
	</div><!-- #featured-slider -->

	<ul id="xstuff" class="container divider">
		<li class="x-action">
			<a href="#"><img src="<?php echo get_template_directory_uri(); ?>/images/lipsum/king.jpg" alt="" /></a>
			<h3><span>X</span>pand Your Knowledge</h3>
			<p>Visit our website for a listing of black history books and documentaries. Also, don't forget to check out our interactive timeline.</p>
		</li>

		<li class="x-action">
			<a href="#"><img src="<?php echo get_template_directory_uri(); ?>/images/lipsum/king.jpg" alt="" /></a>
			<h3>Plan Your <span>X</span>cursion</h3>
			<p>Visit our website for a listing of black history books and documentaries. Also, don't forget to check out our interactive timeline.</p>
		</li>

		<li class="x-action">
			<a href="#"><img src="<?php echo get_template_directory_uri(); ?>/images/lipsum/king.jpg" alt="" /></a>
			<h3><span>X</span>plore the History</h3>
			<p>Visit our website for a listing of black history books and documentaries. Also, don't forget to check out our interactive timeline.</p>
		</li>
	</ul><!-- #xstuff -->

	<div id="young" class="container">
		<span class="quotemark">&#8220;</span>
		<blockquote>
			<p>For decades, millions upon millions of Florida tourists have visited St. Augustine, which is celebrated as 
<em>America’s oldest city</em> and known for its vital role the nation’s history, yet almost all those people have come and 
gone without hearing a word about the area’s rich African American heritage.</p>

			<cite>Civil Rights Leader, Andrew Young <span class="dash">&mdash;</span> <a href="#">Read the Full Letter &rarr;</a></cite>
		</blockquote>
	</div><!-- #young -->

<?php get_footer(); ?>