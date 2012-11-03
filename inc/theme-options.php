<?php
/**
 * BHX Options
 *
 * @package BHX
 * @since BHX 1.0
 */

/**
 * Register the form setting for our bhx_options array.
 *
 * This function is attached to the admin_init action hook.
 *
 * This call to register_setting() registers a validation callback, bhx_theme_options_validate(),
 * which is used when the option is saved, to ensure that our option values are properly
 * formatted, and safe.
 *
 * @since BHX 1.0
 */
function bhx_theme_options_init() {
	register_setting(
		'bhx_options',
		'bhx_options',
		'bhx_theme_options_validate'
	);

	add_settings_section(
		'pages',
		__( 'Page Settings', 'bhx' ),
		'__return_false',
		'bhx_options'
	);

	add_settings_field(
		'builder',
		__( 'Trip Builder Page', 'bhx' ), 
		'bhx_settings_field_pages',
		'bhx_options',
		'pages',
		array(
			'name'        => 'page_builder',
			'value'       => bhx_get_theme_option( 'page_builder' )
		)
	);

	add_settings_field(
		'timeline',
		__( 'Timeline Page', 'bhx' ), 
		'bhx_settings_field_pages',
		'bhx_options',
		'pages',
		array(
			'name'        => 'page_timeline',
			'value'       => bhx_get_theme_option( 'page_timeline' )
		)
	);
	
	add_settings_section(
		'social',
		__( 'Social Settings', 'bhx' ),
		'__return_false',
		'bhx_options'
	);
	
	add_settings_field(
		'twitter',
		__( 'Twitter Handle', 'bhx' ), 
		'bhx_settings_field_text',
		'bhx_options',
		'social',
		array(
			'name'        => 'twitter',
			'value'       => bhx_get_theme_option( 'twitter' ),
			'description' => __( 'Just the username. None of the <code>http</code> or any of that.', 'bhx' )
		)
	);

	add_settings_field(
		'facebook',
		__( 'Twitter Handle', 'bhx' ), 
		'bhx_settings_field_text',
		'bhx_options',
		'social',
		array(
			'name'        => 'facebook',
			'value'       => bhx_get_theme_option( 'facebook' ),
			'description' => __( 'Just the username. None of the <code>http</code> or any of that.', 'bhx' )
		)
	);
}
add_action( 'admin_init', 'bhx_theme_options_init' );

/**
 * Change the capability required to save the 'bhx_options' options group.
 *
 * @see bhx_theme_options_init() First parameter to register_setting() is the name of the options group.
 * @see bhx_theme_options_add_page() The edit_theme_options capability is used for viewing the page.
 *
 * @param string $capability The capability used for the page, which is manage_options by default.
 * @return string The capability to actually use.
 */
function bhx_option_page_capability( $capability ) {
	return 'edit_theme_options';
}
add_filter( 'option_page_capability_bhx_options', 'bhx_option_page_capability' );

/**
 * Add our theme options page to the admin menu.
 *
 * This function is attached to the admin_menu action hook.
 *
 * @since BHX 1.0
 */
function bhx_theme_options_add_page() {
	$theme_page = add_theme_page(
		__( 'Theme Options', 'bhx' ),
		__( 'Theme Options', 'bhx' ),
		'edit_theme_options',
		'bhx_options',
		'bhx_theme_options_render_page'
	);
}
add_action( 'admin_menu', 'bhx_theme_options_add_page' );

/**
 * Returns the options array for Intro.
 *
 * @since BHX 1.0
 */
function bhx_get_theme_options() {
	$saved = (array) get_option( 'bhx_options' );
	
	$defaults = array(
		'page_timeline' => '',
		'page_builder'  => '',
		'twitter'       => 'blackheritagex',
		'facebook'      => 'blackheritagexperience'
	);

	$defaults = apply_filters( 'bhx_default_theme_options', $defaults );

	$options = wp_parse_args( $saved, $defaults );
	$options = array_intersect_key( $options, $defaults );

	return $options;
}

/**
 * Get a single theme option
 *
 * @since BHX 1.0
 */
function bhx_get_theme_option( $key ) {
	$options = bhx_get_theme_options();
	
	if ( isset( $options[ $key ] ) )
		return $options[ $key ];
		
	return false;
}

/**
 * Renders the Theme Options administration screen.
 *
 * @since BHX 1.0
 */
function bhx_theme_options_render_page() {
	$theme = wp_get_theme();
	?>
	<div class="wrap">
		<?php screen_icon(); ?>
		<h2><?php printf( __( '%s Theme Options', 'bhx' ), $theme->Name ); ?></h2>
		<?php settings_errors(); ?>

		<form method="post" action="options.php">
			<?php
				settings_fields( 'bhx_options' );
				do_settings_sections( 'bhx_options' );
				submit_button();
			?>
		</form>
	</div>
	<?php
}

/**
 * Sanitize and validate form input. Accepts an array, return a sanitized array.
 *
 * @see bhx_theme_options_init()
 * @todo set up Reset Options action
 *
 * @param array $input Unknown values.
 * @return array Sanitized theme options ready to be stored in the database.
 *
 * @since BHX 1.0
 */
function bhx_theme_options_validate( $input ) {
	$output = array();
	
	$output = $input;
		
	$output = wp_parse_args( $output, bhx_get_theme_options() );	
		
	return apply_filters( 'bhx_theme_options_validate', $output, $input );
}

/* Fields ***************************************************************/
 
/**
 * Number Field
 *
 * @since BHX 1.0
 */
function bhx_settings_field_number( $args = array() ) {
	$defaults = array(
		'menu'        => '', 
		'min'         => 1,
		'max'         => 100,
		'step'        => 1,
		'name'        => '',
		'value'       => '',
		'description' => ''
	);
	
	$args = wp_parse_args( $args, $defaults );
	extract( $args );
	
	$id   = esc_attr( $name );
	$name = esc_attr( sprintf( 'bhx_options[%s]', $name ) );
?>
	<label for="<?php echo esc_attr( $id ); ?>">
		<input type="number" min="<?php echo absint( $min ); ?>" max="<?php echo absint( $max ); ?>" step="<?php echo absint( $step ); ?>" name="<?php echo $name; ?>" id="<?php echo $id ?>" value="<?php echo esc_attr( $value ); ?>" />
		<?php echo $description; ?>
	</label>
<?php
} 

/**
 * Text Field
 *
 * @since BHX 1.0
 */
function bhx_settings_field_text( $args = array() ) {
	$defaults = array(
		'name'        => '',
		'value'       => '',
		'description' => ''
	);
	
	$args = wp_parse_args( $args, $defaults );
	extract( $args );
	
	$id   = esc_attr( $name );
	$name = esc_attr( sprintf( 'bhx_options[%s]', $name ) );
?>
	<label for="<?php echo $id; ?>">
		<input type="text" name="<?php echo $name; ?>" id="<?php echo $id; ?>" class="regular-text" value="<?php echo esc_textarea( $value ); ?>" />
		<br />
		<?php echo $description; ?>
	</label>
<?php
} 

/**
 * Textarea Field
 *
 * @since BHX 1.0
 */
function bhx_settings_field_textarea( $args = array() ) {
	$defaults = array(
		'name'        => '',
		'value'       => '',
		'description' => ''
	);
	
	$args = wp_parse_args( $args, $defaults );
	extract( $args );
	
	$id   = esc_attr( $name );
	$name = esc_attr( sprintf( 'bhx_options[%s]', $name ) );
?>
	<label for="<?php echo $id; ?>">
		<textarea name="<?php echo $name; ?>" id="<?php echo $id; ?>" class="code large-text" rows="3" cols="30"><?php echo esc_textarea( $value ); ?></textarea>
		<br />
		<?php echo $description; ?>
	</label>
<?php
} 

/**
 * Single Checkbox Field
 *
 * @since BHX 1.0
 */
function bhx_settings_field_checkbox_single( $args = array() ) {
	$defaults = array(
		'name'        => '',
		'value'       => '',
		'compare'     => 'on',
		'description' => ''
	);
	
	$args = wp_parse_args( $args, $defaults );
	extract( $args );
	
	$id   = esc_attr( $name );
	$name = esc_attr( sprintf( 'bhx_options[%s]', $name ) );
?>
	<label for="<?php echo esc_attr( $id ); ?>">
		<input type="checkbox" id="<?php echo $id; ?>" name="<?php echo $name; ?>" value="<?php echo esc_attr( $value ); ?>" <?php checked( $compare, $value ); ?>>
		<?php echo $description; ?>
	</label>
<?php
} 

/**
 * Radio Field
 *
 * @since BHX 1.0
 */
function bhx_settings_field_radio( $args = array() ) {
	$defaults = array(
		'name'        => '',
		'value'       => '',
		'options'     => array(),
		'description' => ''
	);
	
	$args = wp_parse_args( $args, $defaults );
	extract( $args );
	
	$id   = esc_attr( $name );
	$name = esc_attr( sprintf( 'bhx_options[%s]', $name ) );
?>
	<?php foreach ( $options as $option_id => $option_label ) : ?>
	<label title="<?php echo esc_attr( $option_label ); ?>">
		<input type="radio" name="<?php echo $name; ?>" value="<?php echo $option_id; ?>" <?php checked( $option_id, $value ); ?>>
		<?php echo esc_attr( $option_label ); ?>
	</label>
		<br />
	<?php endforeach; ?>
<?php
}

/**
 * Select Field
 *
 * @since BHX 1.0
 */
function bhx_settings_field_select( $args = array() ) {
	$defaults = array(
		'name'        => '',
		'value'       => '',
		'options'     => array(),
		'description' => ''
	);
	
	$args = wp_parse_args( $args, $defaults );
	extract( $args );
	
	$id   = esc_attr( $name );
	$name = esc_attr( sprintf( 'bhx_options[%s]', $name ) );
?>
	<label for="<?php echo $id; ?>">
		<select name="<?php echo $name; ?>">
			<?php foreach ( $options as $option_id => $option_label ) : ?>
			<option value="<?php echo esc_attr( $option_id ); ?>" <?php selected( $option_id, $value ); ?>>
				<?php echo esc_attr( $option_label ); ?>
			</option>
			<?php endforeach; ?>
		</select>
		<?php echo $description; ?>
	</label>
<?php
}

/**
 * Pages Select
 *
 * @since BHX 1.0
 */
function bhx_settings_field_pages( $args = array() ) {
	$defaults = array(
		'name'        => '',
		'value'       => '',
		'description' => ''
	);
	
	$args = wp_parse_args( $args, $defaults );
	extract( $args );
	
	$id   = esc_attr( $name );
	$name = esc_attr( sprintf( 'bhx_options[%s]', $name ) );
?>
	<label for="<?php echo $id; ?>">
		<?php wp_dropdown_pages( array(
			'name' => $name,
			'selected' => $value
		) ); ?>
		<?php echo $description; ?>
	</label>
<?php
}