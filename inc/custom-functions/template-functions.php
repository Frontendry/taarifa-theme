<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package Taarifa
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function taarifa_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	return $classes;
}
add_filter( 'body_class', 'taarifa_body_classes' );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function taarifa_pingback_header() {
	if ( is_singular() && pings_open() ) {
		echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
	}
}
add_action( 'wp_head', 'taarifa_pingback_header' );

/**
 * Add scripts and css on admin.
 */
function taarifa_admin_scripts(){
	wp_enqueue_style( 'taarifa-custom-admin-css', get_template_directory_uri() . '/assets/css/admin/custom-admin.css', array(), '20151215' );

	wp_enqueue_script( 'taarifa-admin-libs-js', get_template_directory_uri() . '/assets/js/admin/lib/libs.js', array(), '20151215', true );

	wp_enqueue_script( 'taarifa-custom-admin-js', get_template_directory_uri() . '/assets/js/admin/custom-admin.js', array(), '20151215', true );
}
add_action( 'admin_enqueue_scripts', 'taarifa_admin_scripts' );

/**
 * Add classes to post
 */
function taarifa_post_classes( $classes ){

	// Add no-pattern classes 
	if ( '0' === taarifa_get_option( 'display-pattern' ) && ! is_singular() ) {
		$classes[] = 'no-pattern';
	}

	// Add no-media for no-featured posts
	if ( false === taarifa_check_featured_image() && ! is_singular() ) {
		$classes[] = 'no-media';
	}

	return $classes;

}
add_filter( 'post_class', 'taarifa_post_classes' );


/**
 * Filter the content of chat posts
 */
function taarifa_format_chat_content( $content ) {
    global $_post_format_chat_ids;

    
    if ( !has_post_format( 'chat' ) )
        return $content;

    
    $_post_format_chat_ids = array();
   
    $separator = apply_filters( 'taarifa_post_format_chat_separator', ':' );

    $chat_output = "\n\t\t\t" . '<div class="chat-transcript chat-transcript-' . esc_attr( get_the_ID() ) . '"><div class="chat-transcript-in">';

    $chat_rows = preg_split( "/(\r?\n)+|(&lt;br\s*\/?>\s*)+/", $content );

    foreach ( $chat_rows as $chat_row ) {
        
        if ( strpos( $chat_row, $separator ) ) {
            
            $chat_row_split = explode( $separator, trim( $chat_row ), 2 );
         
            $chat_author = strip_tags( trim( $chat_row_split[0] ) );
            
            $chat_text = trim( $chat_row_split[1] );

            $speaker_id = taarifa_format_chat_row_id( $chat_author );
            
            $chat_output .= "\n\t\t\t\t" . '<div class="chat-row ' . sanitize_html_class( "chat-speaker-{$speaker_id}" ) . '">';
       
            $chat_output .= "\n\t\t\t\t\t" . '<div class="chat-author ' . sanitize_html_class( strtolower( "chat-author-{$chat_author}" ) ) . ' vcard"><cite class="fn">' . apply_filters( 'taarifa_post_format_chat_author', $chat_author, $speaker_id ) . '</cite>' . $separator . '</div>';
            
            $chat_output .= "\n\t\t\t\t\t" . '<div class="chat-text">' . str_replace( array( "\r", "\n", "\t" ), '', apply_filters( 'taarifa_post_format_chat_text', $chat_text, $chat_author, $speaker_id ) ) . '</div>';
          
            $chat_output .= "\n\t\t\t\t" . '</div><!-- .chat-row -->';
        }

        /**
         * If no author is found, assume this is a separate paragraph of text that belongs to the
         * previous speaker and label it as such, but let's still create a new row.
         */
        else {

            /* Make sure we have text. */
            if ( !empty( $chat_row ) ) {

                /* Open the chat row. */
                $chat_output .= "\n\t\t\t\t" . '<div class="chat-row ' . sanitize_html_class( "chat-speaker-{$speaker_id}" ) . '">';

                /* Don't add a chat row author.  The label for the previous row should suffice. */

                /* Add the chat row text. */
                $chat_output .= "\n\t\t\t\t\t" . '<div class="chat-text">' . str_replace( array( "\r", "\n", "\t" ), '', apply_filters( 'taarifa_post_format_chat_text', $chat_row, $chat_author, $speaker_id ) ) . '</div>';

                /* Close the chat row. */
                $chat_output .= "\n\t\t\t</div><!-- .chat-row -->";
            }
        }
    }

    /* Close the chat transcript div. */
    $chat_output .= "\n\t\t\t</div><!-- .chat-transcript-in -->\n</div><!-- .chat-transcript -->\n";

    /* Return the chat content and apply filters for developers. */
    return apply_filters( 'taarifa_post_format_chat_content', wp_kses_post( $chat_output ) );
}
add_filter( 'the_content', 'taarifa_format_chat_content' );


/**
 * Auto-add paragraphs to the chat text. 
 */
function taarifa_format_chat_row_id( $chat_author ) {
    global $_post_format_chat_ids;

    /* Let's sanitize the chat author to avoid craziness and differences like "John" and "john". */
    $chat_author = strtolower( strip_tags( $chat_author ) );

    /* Add the chat author to the array. */
    $_post_format_chat_ids[] = $chat_author;

    /* Make sure the array only holds unique values. */
    $_post_format_chat_ids = array_unique( $_post_format_chat_ids );

    /* Return the array key for the chat author and add "1" to avoid an ID of "0". */
    return absint( array_search( $chat_author, $_post_format_chat_ids ) ) + 1;
}
add_filter( 'taarifa_post_format_chat_text', 'wpautop' );

function alter_comment_form_fields( $fields ){
    $commenter = wp_get_current_commenter();
    $req = get_option( 'require_name_email' );
    $aria_req = ( $req ? " aria-required='true'" : '' );

    $fields['author'] = '<p class="comment-form-author comment-form-fields"><input id="author" name="author" type="text" placeholder="' . __( 'Your name', 'taarifa' ) .
    ( $req ? '*' : '' ) . '" value="' . esc_attr( $commenter['comment_author'] ) . '" ' . $aria_req . ' /></p>';

    $fields['email'] = '<p class="comment-form-email comment-form-fields"><input id="email" name="email" type="email" placeholder="' . __( 'Your email', 'taarifa' ) .
    ( $req ? '*' : '' ) . '" value="' . esc_attr(  $commenter['comment_author_email'] ) .
    '" size="30"' . $aria_req . ' /></p>';

    $fields['url'] = '';

    return $fields;
}
add_filter( 'comment_form_default_fields', 'alter_comment_form_fields' );

function taarifa_comment_form_before_fields() {
    echo '<div class="comment-form-fields-cont">';
}
add_action('comment_form_before_fields', 'taarifa_comment_form_before_fields');

function taarifa_comment_form_after_fields() {
    echo '</div>';
}
add_action('comment_form_after_fields', 'taarifa_comment_form_after_fields');

function taarifa_move_comment_field_to_bottom( $fields ) {
    $comment_field = $fields['comment'];
    unset( $fields['comment'] );
    $fields['comment'] = $comment_field;
    return $fields;
}     
add_filter( 'comment_form_fields', 'taarifa_move_comment_field_to_bottom' );


/**
 * Load More Ajax Handler thanks to this guy:
 *
 * https://rudrastyh.com/wordpress/load-more-posts-ajax.html#wp_ajax_
 */
function taarifa_loadmore_ajax_handler(){
 
	// prepare our arguments for the query
	$args = json_decode( stripslashes( $_POST['query'] ), true );
	$args['paged'] = $_POST['page'] + 1; // we need next page to be loaded
	$args['post_status'] = 'publish';
 
	// it is always better to use WP_Query but not here
	query_posts( $args );
 
    if( have_posts() ) :        
		while( have_posts() ): the_post();
        get_template_part( '/template-parts/content/post-intro-layout' );  
		endwhile; 
	endif;
	die; // here we exit the script and even no wp_reset_query() required!
} 
add_action('wp_ajax_loadmore', 'taarifa_loadmore_ajax_handler'); // wp_ajax_{action}
add_action('wp_ajax_nopriv_loadmore', 'taarifa_loadmore_ajax_handler'); // wp_ajax_nopriv_{action}