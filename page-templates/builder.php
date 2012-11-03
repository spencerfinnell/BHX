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

$sections = array( 'tours', 'attractions', 'restaraunts', 'lodging' );
$defaults = array( 'tours', 'lodging' );

$prices = get_terms( 'visit-price', array( 'hide_empty' => false ) );
$stars  = get_terms( 'visit-stars', array( 'hide_empty' => false ) );

get_header();
?>

	<div id="build-criteria">
		<form action="" method="post">
			<div class="columns clearfix">
				<?php foreach ( $sections as $section ) : ?>

				<fieldset id="<?php echo $section; ?>" class="build-criteria">
					<legend>
						<label for="include-<?php echo $section; ?>" class="section">
							<input type="checkbox" name="include-<?php echo $section; ?>" value="<?php echo $section; ?>" id="include-<?php echo $section; ?>" <?php echo ( ! $results ) ? checked(1, in_array( $section, $defaults ), false) : checked( $section, $_POST[ 'include-' . $section ], false ); ?> /> <?php echo ucfirst( $section ); ?>
						</label>
					</legend>
					
					<ul>
						<?php if ( $prices ) : foreach ( $prices as $price ) : ?>
							<li>
								<label for="<?php echo $section; ?>-<?php echo $price->slug; ?>">
									<input type="checkbox" name="<?php echo $section; ?>[prices][<?php echo $price->slug; ?>]" id="<?php echo $section; ?>-<?php echo $price->slug; ?>" value="<?php echo $price->slug; ?>" <?php echo ( ! $results ) ? checked( 1, in_array( $section, $defaults ), false ) : checked( $price->slug, $_POST[ $section ][ 'prices' ][ $price->slug ], false ); ?> /> <?php echo $price->name; ?>
								</label>
							</li>
						<?php endforeach; endif; ?>
					</ul>

					<?php if ( in_array( $section, array( 'restaraunts', 'lodging' ) ) ) : ?>
					<ul>
						<?php if ( $stars ) : foreach ( $stars as $star ) : ?>
						<li><label for="<?php echo $section; ?>-<?php echo $star->slug; ?>"><input type="checkbox" name="<?php echo $section; ?>[stars][<?php echo $star->slug; ?>]" id="<?php echo $section; ?>-<?php echo $star->slug; ?>" value="<?php echo $star->slug; ?>" <?php echo ( ! $results ) ? checked( 1, in_array( $section, $defaults ), false ) : checked( $star->slug, $_POST[ $section ][ 'stars' ][ $star->slug ], false ); ?> /> <?php echo $star->name; ?></label></li>
						<?php endforeach; endif; ?>
					</ul>
					<?php endif; ?>

				</fieldset>

				<?php endforeach; ?>
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

		<?php
			if ( isset ( $results ) ) :
				foreach ( $sections as $section ) :
					if ( ! $_POST[ $section ] )
						continue; 
		?>

				<section id="tours" class="visit-suggestions">
					<h2><i class="icon-pin"></i> <?php echo ucfirst( $section ); ?></h2>

					<ul>
						<?php if ( $results[ $section ] ) : foreach ( $results[ $section ] as $result ) : ?>
						<li>
							<h3 class="suggestion-title"><a href="<?php echo get_permalink( $result->ID ); ?>"><?php echo get_the_title( $result->ID ); ?></a></h3>
							<p class="suggestion-meta"><?php echo wp_trim_words( $result->post_content, 10 ); ?></p>
							<p class="suggestion-types"><?php bhx_builder_suggestion_meta( $result->ID, $section ); ?></p>
						</li>
						<?php endforeach; else : ?>
						<li>
							<h3 class="suggestion-title">Sorry, we don't have anything.</h3>
							<p class="suggestion-meta">Unfortunently we don't have any <?php echo $section; ?>s matching your search.</p>
						</li>
						<?php endif; ?>
					</uL>
				</section>
		<?php
				endforeach;
			else :
		?>

			<blockquote>Use the filtering tools above to find great places to see in St. Augustine.</blockquote>

		<?php endif; ?>

	</div>

<?php get_footer(); ?>