<?php
/**
 * Template Name: Trip Builder
 *
 * Custom builder template. As one would guess.
 *
 * @package BHX
 * @since BHX 1.0
 */

global $results;

$prices = get_terms( 'visit-price', array( 'hide_empty' => false ) );
$stars  = get_terms( 'visit-stars', array( 'hide_empty' => false ) );

get_header();
?>

	<div id="build-criteria">
		<form action="" method="post">
			<div class="columns clearfix">
				<fieldset id="tours" class="build-criteria">
					<legend><label for="include-tours" class="section"><input type="checkbox" value="tours" id="include-tours" checked="checked" /> Tours</label></legend>
					<ul>
						<?php foreach ( $prices as $price ) : ?>
						<li><label for="tour-<?php echo $price->slug; ?>"><input type="checkbox" name="tours[prices][<?php echo $price->slug; ?>]" id="tour-<?php echo $price->slug; ?>" value="<?php echo $price->slug; ?>" <?php checked(0, 0); ?> /> <?php echo $price->name; ?></label></li>
						<?php endforeach; ?>
					</ul>
				</fieldset>

				<fieldset id="attractions" class="build-criteria">
					<legend><label for="include-attractions" class="section"><input type="checkbox" id="include-attractions" /> Attractions</label></legend>
					<ul>
						<?php foreach ( $prices as $price ) : ?>
						<li><label for="attraction-<?php echo $price->slug; ?>"><input type="checkbox" name="attractions[prices][<?php echo $price->slug; ?>]" id="attraction-<?php echo $price->slug; ?>" value="<?php echo $price->slug; ?>" <?php checked(1, 0); ?> /> <?php echo $price->name; ?></label></li>
						<?php endforeach; ?>
					</ul>
				</fieldset>

				<fieldset id="restaraunts" class="build-criteria">
					<legend><label for="include-restaraunts" class="section"><input type="checkbox" id="include-restaraunts" /> Restaurants</label></legend>
					<ul>
						<?php foreach ( $prices as $price ) : ?>
						<li><label for="restaurant-<?php echo $price->slug; ?>"><input type="checkbox" name="restaraunts[<?php echo $price->slug; ?>]" id="restaurant-<?php echo $price->slug; ?>" value="<?php echo $price->slug; ?>" <?php checked(1, 0); ?> /> <?php echo $price->name; ?></label></li>
						<?php endforeach; ?>
					</ul>

					<ul>
						<?php foreach ( $stars as $star ) : ?>
						<li><label for="restaurant-<?php echo $star->slug; ?>"><input type="checkbox" name="restaurants[stars][<?php echo $star->slug; ?>]" id="restaurant-<?php echo $star->slug; ?>" value="<?php echo $star->slug; ?>" <?php checked(1, 0); ?> /> <?php echo $star->name; ?></label></li>
						<?php endforeach; ?>
					</ul>
				</fieldset>

				<fieldset id="lodging" class="build-criteria">
					<legend><label for="include-lodging" class="section"><input type="checkbox" id="include-lodging" checked="checked" /> Lodging</label></legend>
					<ul>
						<?php foreach ( $prices as $price ) : ?>
						<li><label for="lodging-<?php echo $price->slug; ?>"><input type="checkbox" name="lodging[prices][<?php echo $price->slug; ?>]" id="lodging-<?php echo $price->slug; ?>" value="<?php echo $price->slug; ?>" <?php checked(0, 0); ?> /> <?php echo $price->name; ?></label></li>
						<?php endforeach; ?>
					</ul>

					<ul>
						<?php foreach ( $stars as $star ) : ?>
						<li><label for="lodging-<?php echo $star->slug; ?>"><input type="checkbox" name="lodging[stars][<?php echo $star->slug; ?>]" id="lodging-<?php echo $star->slug; ?>" value="<?php echo $star->slug; ?>" <?php checked(0, 0); ?> /> <?php echo $star->name; ?></label></li>
						<?php endforeach; ?>
					</ul>
				</fieldset>
			</div>

			<p class="filter">
				<span class="note">If you have more questions about visiting St. Augustine and getting the ultimate <strong>Black Heritage Xperience</strong>, please do not hesitate to <a href="#">contact us</a> and we will gladly help you.</span>
				<input type="submit" name="submit" value="<?php esc_attr_e( 'Search St. Augustine', 'bhx' ); ?>" />
				<input type="hidden" name="action" value="bhx-trip-builder" />
			</p>
		</form>
	</div>

	<div id="page-header">
		<h1 class="page-title"><span><?php _e( 'Our Suggestions', 'bhx' ); ?></span></h1>
		<span class="page-meta"><?php _e( 'Let us help you find great things to do in St. Augustine, Florida', 'bhx' ); ?></span>
	</div>

	<div id="builder-results">

		<?php if ( isset ( $results ) ) : ?>

			<?php if ( $results[ 'tours' ] ) : ?>
			<section id="tours" class="visit-suggestions">
				<h2><i class="icon-pin"></i> <?php _e( 'Tours', 'bhx' ); ?></h2>

				<ul>
					<?php foreach ( $results[ 'tours' ] as $result ) : ?>
					<li>
						<h3 class="suggestion-title"><a href="<?php echo get_permalink( $result->ID ); ?>"><?php echo get_the_title( $result->ID ); ?></a></h3>
						<p class="suggestion-meta"><?php echo wp_trim_words( $result->post_content, 10 ); ?></p>
						<p class="suggestion-types"><?php bhx_builder_suggestion_meta( $result->ID ); ?></p>
					</li>
					<?php endforeach; ?>
				</uL>
			</section>
			<?php endif; ?>

			<?php if ( $results[ 'attractions' ] ) : ?>
			<section id="attractions" class="visit-suggestions">
				<h2><i class="icon-rocket"></i> <?php _e( 'Attractions', 'bhx' ); ?></h2>

				<ul>
					<?php foreach ( $results[ 'attractions' ] as $result ) : ?>
					<li>
						<h3 class="suggestion-title"><a href="<?php echo get_permalink( $result->ID ); ?>"><?php echo get_the_title( $result->ID ); ?></a></h3>
						<p class="suggestion-meta"><?php echo wp_trim_words( $result->post_content, 10 ); ?></p>
						<p class="suggestion-types"><?php bhx_builder_suggestion_meta( $result->ID ); ?></p>
					</li>
					<?php endforeach; ?>
				</uL>
			</section>
			<?php endif; ?>

			<?php if ( $results[ 'restaraunts' ] ) : ?>
			<section id="attractions" class="visit-suggestions">
				<h2><i class="icon-coffee"></i> <?php _e( 'Restaraunts', 'bhx' ); ?></h2>

				<ul>
					<?php foreach ( $results[ 'restaraunts' ] as $result ) : ?>
					<li>
						<h3 class="suggestion-title"><a href="<?php echo get_permalink( $result->ID ); ?>"><?php echo get_the_title( $result->ID ); ?></a></h3>
						<p class="suggestion-meta"><?php echo wp_trim_words( $result->post_content, 10 ); ?></p>
						<p class="suggestion-types"><?php bhx_builder_suggestion_meta( $result->ID ); ?></p>
					</li>
					<?php endforeach; ?>
				</uL>
			</section>
			<?php endif; ?>

			<?php if ( $results[ 'lodging' ] ) : ?>
			<section id="attractions" class="visit-suggestions">
				<h2><i class="icon-coffee"></i> <?php _e( 'Lodging', 'bhx' ); ?></h2>

				<ul>
					<?php foreach ( $results[ 'lodging' ] as $result ) : ?>
					<li>
						<h3 class="suggestion-title"><a href="<?php echo get_permalink( $result->ID ); ?>"><?php echo get_the_title( $result->ID ); ?></a></h3>
						<p class="suggestion-meta"><?php echo wp_trim_words( $result->post_content, 10 ); ?></p>
						<p class="suggestion-types"><?php bhx_builder_suggestion_meta( $result->ID ); ?></p>
					</li>
					<?php endforeach; ?>
				</uL>
			</section>
			<?php endif; ?>

		<?php endif; ?>

	</div>

<?php get_footer(); ?>