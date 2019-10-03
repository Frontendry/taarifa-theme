<?php

/**
 * Ultimate Shortcodes Filters
 * 
 */

// Remove all shortcodes 
add_filter( 'su/data/shortcodes', 'taarifa_remove_su_shortcodes' );
function taarifa_remove_su_shortcodes( $shortcodes ) { 

	$shortcodes = array();

	// Return modified data
	return $shortcodes;

}

//require get_template_directory() . '/inc/shortcodes/sampleshortcodes.php';
require get_template_directory() . '/inc/shortcodes/clicktotweet.php';
