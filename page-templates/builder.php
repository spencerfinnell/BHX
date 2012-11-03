<?php
/**
 * Template Name: Trip Builder
 *
 * Custom builder template. As one would guess.
 *
 * @package BHX
 * @since BHX 1.0
 */

$prices = get_terms( 'visit-price', array( 'hide_empty' => false ) );
$stars  = get_terms( 'visit-stars', array( 'hide_empty' => false ) );

get_header();
?>

	<div id="build-criteria">
		<form>
			<div class="columns clearfix">
				<fieldset class="build-criteria">
					<legend><label for="include-tours" class="section"><input type="checkbox" value="tours" id="include-tours" checked="checked" /> Tours</label></legend>
					<ul>
						<?php foreach ( $prices as $price ) : ?>
						<li><label for="tour-<?php echo $price->slug; ?>"><input type="checkbox" name="<?php echo $price->slug; ?>" id="tour-<?php echo $price->slug; ?>" value="<?php echo $price->slug; ?>" /> <?php echo $price->name; ?></label></li>
						<?php endforeach; ?>
					</ul>
				</fieldset>

				<fieldset class="build-criteria">
					<legend><label for="include-attractions" class="section"><input type="checkbox" id="include-attractions" /> Attractions</label></legend>
					<ul>
						<?php foreach ( $prices as $price ) : ?>
						<li><label for="attraction-<?php echo $price->slug; ?>"><input type="checkbox" name="<?php echo $price->slug; ?>" id="attraction-<?php echo $price->slug; ?>" value="<?php echo $price->slug; ?>" /> <?php echo $price->name; ?></label></li>
						<?php endforeach; ?>
					</ul>
				</fieldset>

				<fieldset class="build-criteria">
					<legend><label for="include-restaraunts" class="section"><input type="checkbox" id="include-restaraunts" checked="checked" /> Restaurants</label></legend>
					<ul>
						<?php foreach ( $prices as $price ) : ?>
						<li><label for="restaurant-<?php echo $price->slug; ?>"><input type="checkbox" name="<?php echo $price->slug; ?>" id="restaurant-<?php echo $price->slug; ?>" value="<?php echo $price->slug; ?>" /> <?php echo $price->name; ?></label></li>
						<?php endforeach; ?>
					</ul>
				</fieldset>

				<fieldset id="lodging" class="build-criteria">
					<legend><label for="include-lodging" class="section"><input type="checkbox" id="include-lodging" checked="checked" /> Lodging</label></legend>
					<ul>
						<?php foreach ( $prices as $price ) : ?>
						<li><label for="lodging-<?php echo $price->slug; ?>"><input type="checkbox" name="<?php echo $price->slug; ?>" id="lodging-<?php echo $price->slug; ?>" value="<?php echo $price->slug; ?>" /> <?php echo $price->name; ?></label></li>
						<?php endforeach; ?>
					</ul>

					<ul>
						<?php foreach ( $stars as $star ) : ?>
						<li><label for="lodging-<?php echo $star->slug; ?>"><input type="checkbox" name="<?php echo $star->slug; ?>" id="lodging-<?php echo $star->slug; ?>" value="<?php echo $star->slug; ?>" /> <?php echo $star->name; ?></label></li>
						<?php endforeach; ?>
					</ul>
				</fieldset>
			</div>

			<p class="filter">
				<span class="note">If you have more questions about visiting St. Augustine and getting the ultimate <strong>Black Heritage Xperience</strong>, please do not hesitate to <a href="#">contact us</a> and we will gladly help you.</span>
				<input type="submit" name="submit" value="<?php esc_attr_e( 'Search St. Augustine', 'bhx' ); ?>" />
			</p>
		</form>
	</div>

	<div id="page-header">
		<h1 class="page-title"><span><?php _e( 'Our Suggestions', 'bhx' ); ?></span></h1>
		<span class="page-meta"><?php _e( 'Let us help you find great things to do in St. Augustine, Florida', 'bhx' ); ?></span>
	</div>

	<div id="builder-results">

		<section id="tours" class="visit-suggestions">
			<h2>Tours</h2>

			<ul>
				<li>
					<h3 class="suggestion-title"><a href="#">Some Tour #1</a></h3>
					<p class="suggestion-meta">Just a little bit of text, not really sure.</p>
				</li>
				<li>
					<h3 class="suggestion-title"><a href="#">The Ultimate Black Heritage Tour</a></h3>
					<p class="suggestion-meta">Just a little bit of text, not really sure.</p>
				</li>
			</uL>
		</section>

		<section id="tours" class="visit-suggestions">
			<h2>Attractions</h2>

			<ul>
				<li>
					<h3 class="suggestion-title"><a href="#">A Super Awesome Theme Park Attraction</a></h3>
					<p class="suggestion-meta">Just a little bit of text, not really sure.</p>
				</li>
			</uL>
		</section>

	</div>

<?php get_footer(); ?>