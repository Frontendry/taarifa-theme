<?php
add_filter( 'su/data/shortcodes', 'register_my_custom_shortcode' );


/**
 * Filter to modify original shortcodes data and add custom shortcodes
 *
 * @param array   $shortcodes Original plugin shortcodes
 * @return array Modified array
 */
function register_my_custom_shortcode( $shortcodes ) {
	// Add new shortcode
	$shortcodes['heading2'] = array(
		// Shortcode name
		'name' => __( 'Heading 2', 'textdomain' ),
		// Shortcode type. Can be 'wrap' or 'single'
		// Example: [b]this is wrapped[/b], [this_is_single]
		'type' => 'wrap',
		// Shortcode group.
		// Can be 'content', 'box', 'media' or 'other'.
		// Groups can be mixed, for example 'content box'
		'group' => 'content',
		// List of shortcode params (attributes)
		'atts' => array(
			// Style attribute
			'style' => array(
				// Attribute type.
				// Can be 'select', 'color', 'bool' or 'text'
				'type' => 'select',
				// Available values
				'values' => array(
					'default' => __( 'Default', 'textdomain' ),
					'small' => __( 'Small', 'textdomain' )
				),
				// Default value
				'default' => 'default',
				// Attribute name
				'name' => __( 'Style', 'textdomain' ),
				// Attribute description
				'desc' => __( 'Heading 2 style', 'textdomain' )
			)
		),
		// Default content for generator (for wrap-type shortcodes)
		'content' => __( 'Heading 2 text', 'textdomain' ),
		// Shortcode description for cheatsheet and generator
		'desc' => __( 'Styled heading 2', 'textdomain' ),
		// Custom icon (font-awesome)
		'icon' => 'plus',
		// Name of custom shortcode function
		// IMPORTANT: this is the name of the next function
		'function' => 'my_custom_shortcode',
	);
	// Return modified data
	return $shortcodes;
}

/**
 * Callback function
 *
 * @param array   $atts    Shortcode attributes
 * @param string  $content Shortcode content
 * @return string Shortcode markup
 */
function my_custom_shortcode( $atts, $content = null ) {

	// Default settings
	$atts = shortcode_atts( array(
			'style' => 'default',
			'foo' => 'bar'
		), $atts );

	return sprintf( '<div class="%s">%s</div>', esc_attr( $atts['style'] ), $content );
}

