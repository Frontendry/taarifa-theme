<?php

// Add Click to tweet shortcode
add_filter( 'su/data/shortcodes', 'register_taarifa_click_to_tweet_shortcode' );
function register_taarifa_click_to_tweet_shortcode(){

    $shortcodes['click_to_tweet'] = array(
        'name' => __( 'Click to tweet', 'taarifa' ),
        'type' => 'wrap',
        'group' => 'content',
        'atts' => array(			
			'speaker' => array(
                'default' => 'Speaker 1',
				// Attribute name
				'name' => __( 'Speaker Name', 'taarifa' ),
				// Attribute description
				'desc' => __( 'Enter the name of the speaker', 'taarifa' )
            )
		),
		// Default content for generator (for wrap-type shortcodes)
		'content' => __( 'Tweet text', 'taarifa' ),
		// Shortcode description for cheatsheet and generator
		'desc' => __( 'Click to tweet', 'taarifa' ),
        // Custom icon (font-awesome)
        'icon' => 'plus',
        // Name of custom shortcode function
        // IMPORTANT: this is the name of the next function
        'function' => 'taarifa_click_to_tweet_shortcode',
    );
    // Return modified data
    return $shortcodes;
}

function taarifa_click_to_tweet_shortcode( $atts, $content = null ) {

	// Default settings
	$atts = shortcode_atts( array(
        'speaker' => 'Speaker 1'
    ), $atts );

	return sprintf( '<div data-type="%s">%s</div>', esc_attr( $atts['style'] ), esc_attr( $atts['speaker'] ), $content );

}