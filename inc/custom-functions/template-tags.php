<?php
/**
 * Custom template tags for this theme
 *
 * @package Taarifa
 */

if ( ! function_exists( 'taarifa_get_option' ) ) :
	/**
	 * Get Redux Field Values
	 */
	function taarifa_get_option( $fieldId ) {
		
		global $redux_builder_frontendry;

		if ( empty( $redux_builder_frontendry ) ) {
			$redux_builder_frontendry = get_option( 'redux_builder_frontendry' );
		}

		if ( isset( $redux_builder_frontendry[$fieldId] ) ) {
			return is_array( $redux_builder_frontendry[$fieldId] ) && isset( $redux_builder_frontendry[$fieldId]['url'] ) ? $redux_builder_frontendry[$fieldId]['url'] : $redux_builder_frontendry[$fieldId];
		} else {
			return false;
		}

	}
endif;

if ( ! function_exists( 'taarifa_header_layout' ) ) :
	function taarifa_header_layout(){
		$header_layout_val = taarifa_get_option( 'header-layout' );

		if ( !empty( $header_layout_val ) ) :
			return $header_layout_val;
		endif;
	}
endif;

if ( ! function_exists( 'taarifa_top_logo' ) ) :
	/**
	 * Displays the website logo.
	 */
	function taarifa_top_logo() {
		
		$logo_image_url = taarifa_get_option( 'main-logo' );
		$blog_info_name = get_bloginfo( 'name' );  
		$logo_custom_url = taarifa_get_option( 'main-logo-custom-url' );                            

		if ( !empty( $logo_image_url ) ) :
		
		?>
			<a href="<?php if ( !empty( $logo_custom_url ) ) : echo esc_url( $logo_custom_url ); else : echo home_url( '/' ); endif; ?>"><img src="<?php echo esc_url( $logo_image_url ); ?>" alt="<?php echo esc_attr ( $blog_info_name ) ?>"></a>
		<?php else :
			echo '<a href="'; if ( !empty( $logo_custom_url ) ) : echo esc_url( $logo_custom_url ); else : echo home_url( '/' ); endif; echo '"><h1>'. get_bloginfo( 'name' ) .'</h1></a>';
			endif; 

	}
endif;

if ( ! function_exists( 'taarifa_post_layout' ) ) :
	/**
	 * Return post layout option.
	 */
	function taarifa_post_layout(){
		$post_layout_val = taarifa_get_option( 'posts-layout-options' );

		if ( !empty( $post_layout_val ) ) :
			return $post_layout_val;
		endif;
	}
endif;

if ( ! function_exists( 'taarifa_post_layout_class' ) ) :
	/**
	 * Set different classes for the post layouts.
	 */
	function taarifa_post_layout_class(){
		$post_layout_class;
		$post_layout_val = taarifa_post_layout();

		if( $post_layout_val === 'masonry-grid-layout' ) :
			$post_layout_class = 'masonry-grid-layout';
		elseif( $post_layout_val === 'list-layout-a' ) : 
			$post_layout_class = 'list-layout';
		elseif( $post_layout_val === 'list-layout-b' ) : 
			$post_layout_class = 'fi-list-layout';
		elseif( $post_layout_val === 'list-layout-c' ) : 
			$post_layout_class = 'fi-list-layout fi-list-layout-alt';
		else:
			$post_layout_class = 'masonry-grid-layout';
		endif;

		return $post_layout_class;
	}
endif;

if ( ! function_exists( 'taarifa_load_more_pagination' ) ) :
	/**
	 * Prints HTML for load more pagination.
	 */
	function taarifa_load_more_pagination() {
		global $wp_query; 
		$loadmorepagination = sprintf(
			( ( $wp_query->max_num_pages > 1 ) ? '<div class="fr-loadmore cta-2"><button><span class="spinner"></span>' . __( taarifa_get_option( 'more-posts-text' ), 'taarifa' ) . '</div>' : '' )
		);
		echo $loadmorepagination;
	}
endif;

if ( ! function_exists( 'taarifa_prev_pagination' ) ) :
	/**
	 * Prints HTML for previous page pagination.
	 */
	function taarifa_prev_pagination() {
		$getprevpostlinks = get_previous_posts_link( esc_html__( 'Previous Articles', 'taarifa' ) );
		$prevpaginations = sprintf(
			( get_previous_posts_link() ? '<div class="fr-posts-nav fr-post-nav-prev"> <div class="cta fr-posts-nav-in">' . $getprevpostlinks . '</div> </div>' : '' )
		);
		echo $prevpaginations;
	}
endif;

if ( ! function_exists( 'taarifa_next_pagination' ) ) :
	/**
	 * Prints HTML for next page pagination.
	 */
	function taarifa_next_pagination() {
		$getnextpostlinks = get_next_posts_link( esc_html__( 'Next Articles', 'taarifa' ) );
		$nextpaginations = sprintf(
			( get_next_posts_link() ? '<div class="fr-posts-nav fr-post-nav-next"> <div class="cta fr-posts-nav-in">' . $getnextpostlinks . '</div> </div>' : '' )
		);
		echo $nextpaginations;
	}
endif;

if ( ! function_exists( 'taarifa_numbered_pagination' ) ) :
	/**
	 * Prints HTML for numbered page pagination.
	 */
	function taarifa_numbered_pagination() {
		$numberedpagination = get_the_posts_pagination( array(
			'mid_size' => 2,
		) );
		echo '<div class="fr-posts-paginations">' .$numberedpagination. '</div>';
	}
endif;

if ( ! function_exists( 'taarifa_pagination_layout' ) ) :
	/**
	 * Return pagination layout option.
	 */
	function taarifa_pagination_layout(){
		$pagination_layout_val = taarifa_get_option( 'pagination-layout-options' );

		if( $pagination_layout_val === 'load-more-button' ) :
			taarifa_load_more_pagination();
		elseif ( $pagination_layout_val === 'prev-next-pagination' ) :
			taarifa_prev_pagination();
			taarifa_next_pagination();
		elseif ( $pagination_layout_val === 'numbered-pagination' ) :
			taarifa_numbered_pagination();
		elseif ( $pagination_layout_val === 'both-prev-next-and-numbered-pagination' ) :
			taarifa_prev_pagination();
			taarifa_next_pagination();
			taarifa_numbered_pagination();
		endif;
	}
endif;

if ( ! function_exists( 'taarifa_check_featured_image' ) ) :
	/**
	 * Check posts featured image status.
	 */
	function taarifa_check_featured_image(){
		global $post;

		if( has_post_thumbnail( $post->ID ) ) :
			return true;
		else :
			return false;
		endif;
	}
endif;

if ( ! function_exists( 'taarifa_post_animation' ) ) :
	/**
	 * Enable post animation.
	 */
	function taarifa_post_animation(){
		if( '1' === taarifa_get_option( 'enable-animations' ) ) :
			return ' js-aos" data-aos="fade-up"';
		else :
			return '"';
		endif;
	}
endif;

if ( ! function_exists( 'taarifa_post_thumbnail' ) ) :
	/**
	 * Post Thumbnail on landing and single pages.
	 */
	function taarifa_post_thumbnail(){
		if ( post_password_required() || is_attachment() ) {
			return;
		}
	
		if ( is_singular() ) :
		?>

		<div class="blog-post-full-media">
			<figure class="bpim-in featured-image">
				<?php
					the_post_thumbnail( 'post-thumbnail', array( 'alt' => get_the_title() ) );
				?>
			</figure>			
		</div>
		<!-- .blog-post-full-media -->
	
		<?php else : ?>

		<div class="blog-post-media">
			<figure class="featured-image">				
				<a href="<?php the_permalink(); ?>">
				<?php the_post_thumbnail( 'post-thumbnail', array( 'alt' => get_the_title() ) ); ?>
				</a>				
			</figure>
		</div>
		<!-- .blog-post-media -->	
	
		<?php endif; 
	}
endif;

if ( ! function_exists( 'taarifa_posted_on' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time.
	 */
	function taarifa_posted_on() {
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
		}

		$time_string = sprintf( $time_string,
			esc_attr( get_the_date( DATE_W3C ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( DATE_W3C ) ),
			esc_html( get_the_modified_date() )
		);

		$posted_on = sprintf(
			'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
		);

		echo $posted_on;

	}
endif;

if ( ! function_exists( 'taarifa_posted_by' ) ) :
	/**
	 * Prints HTML with meta information for the current author.
	 */
	function taarifa_posted_by() {
		$byline = sprintf(
			'<a href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '"> ' . esc_html( get_the_author() ) . '</a>'
		);
		echo $byline;
	}
endif;

if ( ! function_exists( 'taarifa_post_intro_data' ) ) :
	
	function taarifa_post_intro_data(){

		/**
		 * Post categories.
		 */
		$categories = get_the_category();

		if ( ! empty( $categories ) ) :
		?>
			<div class="blog-post-cat">
				<?php
				foreach( $categories as $category ){
					echo '<a href="' . esc_url( get_category_link( $category->term_id ) ) . '">' . esc_html( $category->name ) . '</a>';
				}
				?>				
			</div>
			<!-- .blog-post-cat -->
		<?php
		endif;

		/**
		 * Post title.
		 */

		if ( is_singular() ) :
		?>
		<header class="blog-post-title">
			<h2><?php echo esc_html( get_the_title() ) ?></h2>
		</header>
		<!-- .blog-post-title -->

		<?php
		else : 	
		
		if( !has_post_format( 'quote' ) && !has_post_format( 'aside' ) ) : ?>
		<header class="blog-post-title">
			<h2><a href="<?php esc_attr( the_permalink() ); ?>"><?php echo esc_html( get_the_title() ) ?></a></h2>
		</header>
		<!-- .blog-post-title -->
		<?php
		endif;

		if( has_post_format( 'quote' ) ) : ?>
		<div class="blog-post-content text-content">
			<blockquote>
				<?php the_content(); 
				
				global $post;
				$current_quote_author = get_post_meta( $post->ID, '_quote_author_field', true );

				if( !empty( $current_quote_author ) ) : ?>	
				<footer class="author-cont">
					<p><a href="<?php echo esc_url( get_the_permalink() ); ?>"><?php echo esc_html( $current_quote_author ); ?></a></p>
				</footer>
				<?php endif; ?>
			</blockquote>
			
		</div>
		<!-- .blog-post-content -->
		<?php
		elseif( has_post_format( 'aside' ) ) : ?>
		<div class="blog-post-content text-content">
			<?php the_content(); ?>
		</div>
		<!-- .blog-post-content -->
		<?php
		endif;

		endif;

		/**
		 * Post Date and Author.
		 */

		if( !has_post_format( 'quote' ) ) : 
		?>

		<div class="blog-post-misc">
			<div class="blog-post-misc-el blog-post-date"><?php taarifa_posted_on(); ?> </div>
			<!-- .blog-post-date -->

			<div class="blog-post-misc-el blog-post-auth"><?php echo esc_html( 'By', 'taarifa' ); taarifa_posted_by(); ?>  </div>
		</div>
		<!-- .blog-post-misc -->

		<?php
		endif;

	}
endif;

if ( ! function_exists( 'taarifa_entry_footer' ) ) :
	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 */
	function taarifa_entry_footer() {
		// Hide category and tag text for pages.
		if ( 'post' === get_post_type() ) {
			/* translators: used between list items, there is a space after the comma */
			$categories_list = get_the_category_list( esc_html__( ', ', 'taarifa' ) );
			if ( $categories_list ) {
				/* translators: 1: list of categories. */
				printf( '<span class="cat-links">' . esc_html__( 'Posted in %1$s', 'taarifa' ) . '</span>', $categories_list ); // WPCS: XSS OK.
			}

			/* translators: used between list items, there is a space after the comma */
			$tags_list = get_the_tag_list( '', esc_html_x( ', ', 'list item separator', 'taarifa' ) );
			if ( $tags_list ) {
				/* translators: 1: list of tags. */
				printf( '<span class="tags-links">' . esc_html__( 'Tagged %1$s', 'taarifa' ) . '</span>', $tags_list ); // WPCS: XSS OK.
			}
		}

		if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
			echo '<span class="comments-link">';
			comments_popup_link(
				sprintf(
					wp_kses(
						/* translators: %s: post title */
						__( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', 'taarifa' ),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					get_the_title()
				)
			);
			echo '</span>';
		}

		edit_post_link(
			sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Edit <span class="screen-reader-text">%s</span>', 'taarifa' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				get_the_title()
			),
			'<span class="edit-link">',
			'</span>'
		);
	}
endif;

if ( ! function_exists( 'taarifa_gallery_photos_cta' ) ) :
	/**
	 * Prints HTML for gallery cta.
	 */
	function taarifa_gallery_photos_cta() {
		$gallery_cta = sprintf(
			'<div class="gallery-trigger cta-2">
				<a href="#">' .( ( !empty( taarifa_get_option( 'view-all-photos-text' ) ) ) ? esc_html( taarifa_get_option( 'view-all-photos-text' ) ) : esc_html( 'View all photos' ) ) . '</a>
			</div>'		
		);
		echo $gallery_cta;
	}
endif;

if( !function_exists( 'taarifa_comment_list_call' ) ) :

	function taarifa_comment_list_call($comment, $args, $depth) {
		if ( 'div' === $args['style'] ) {
			$tag       = 'div';
			$add_below = 'comment';
		} else {
			$tag       = 'li';
			$add_below = 'div-comment';
		}?>
		<<?php echo $tag; ?> <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ); ?> id="comment-<?php comment_ID() ?>"><?php 
		if ( 'div' != $args['style'] ) { ?>
			<div id="div-comment-<?php comment_ID() ?>" class="comment-body"><?php
		} ?>
			<div class="comment-author vcard"><?php 
				if ( $args['avatar_size'] != 0 ) {
					echo get_avatar( $comment, $args['avatar_size'] ); 
				}
				
				echo '<cite class="fn">' . get_comment_author_link() . '</cite>'; ?>
			</div><?php 
			if ( $comment->comment_approved == '0' ) { ?>
				<em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.' ); ?></em><br/><?php 
			} ?>
			<div class="comment-meta commentmetadata">
				<a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ); ?>"><?php
					/* translators: 1: date, 2: time */
					printf( 
						__('%1$s at %2$s'), 
						get_comment_date(),  
						get_comment_time() 
					); ?>
				</a><?php 
				edit_comment_link( __( '(Edit)' ), '  ', '' ); ?>
			</div>
	
			<?php comment_text(); ?>
	
			<div class="reply"><?php 
					comment_reply_link( 
						array_merge( 
							$args, 
							array( 
								'add_below' => $add_below, 
								'depth'     => $depth, 
								'max_depth' => $args['max_depth'] 
							) 
						) 
					); ?>
			</div><?php 
		if ( 'div' != $args['style'] ) : ?>
			</div><?php 
		endif;
	}

endif;

if ( ! function_exists( 'taarifa_social_share' ) ) :
	/**
	 * Social share links
	 */
	function taarifa_social_share() {
		global $post;

		$pageURL = urlencode( get_permalink() );
		$pageTitle = htmlspecialchars(urlencode(html_entity_decode(get_the_title(), ENT_COMPAT, 'UTF-8')), ENT_COMPAT, 'UTF-8');
		$thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );
		$socialLinks = taarifa_get_option( 'posts_social_opts' );

		// Social URLs
		$facebookURL = 'https://www.facebook.com/sharer/sharer.php?u='.$pageURL;
		$twitterURL = 'https://twitter.com/intent/tweet?text='.$pageTitle.'&amp;url='.$pageURL;		
		$googleURL = 'https://plus.google.com/share?url='.$pageURL;
		$linkedInURL = 'https://www.linkedin.com/shareArticle?mini=true&url='.$pageURL.'&amp;title='.$pageTitle;
		$pinterestURL = 'https://pinterest.com/pin/create/button/?url='.$pageURL.'&amp;media='.$thumbnail[0].'&amp;description='.$pageTitle;
		$emailURL = 'mailto:?subject='.$pageTitle.'&body=Check out this site'.$pageURL;		
		$vkURL = 'http://vkontakte.ru/share.php?url='.$pageURL;
		//$bufferURL = 'https://bufferapp.com/add?url='.$pageURL.'&amp;text='.$pageTitle;
		$diggURL = 'http://www.digg.com/submit?url='.$pageURL;
		$redditURL = 'http://reddit.com/submit?url='.$pageURL.'&amp;title='.$pageTitle;
		$stumbleuponURL = 'http://www.stumbleupon.com/submit?url='.$pageURL.'&amp;title='.$pageTitle;
		$tumblrURL = 'http://www.tumblr.com/share/link?url='.$pageURL.'&amp;title='.$pageTitle;
		//$yummlyURL = 'http://www.yummly.com/urb/verify?url='.$pageURL.'&amp;title='.$pageTitle;
		$whatsappURL = 'whatsapp://send?text='.$pageTitle . ' ' . $pageURL;
		$telegramURL = '//telegram.me/share/url?url='.$pageURL.'&amp;text='.$pageTitle;

		$selectedSocialURls = array_keys( $socialLinks, '1' );	

		$allsocialsmeta = array(
			'facebook' => 'fab fa-facebook-f" href="' .$facebookURL. '"',
			'twitter' => 'fab fa-twitter" href="' .$twitterURL. '"',
			'googleplus' => 'fab fa-google-plus-g" href="' .$googleURL. '"',
			'linkedin' => 'fab fa-linkedin-in" href="' .$linkedInURL. '"',
			'pinterest' => 'fab fa-pinterest-p" href="' .$pinterestURL. '"',
			'email' => 'far fa-envelope" href="' .$emailURL. '"',
			'vk' => 'fab fa-vk" href="' .$vkURL. '"',
			'digg' => 'fab fa-digg" href="' .$diggURL. '"',
			'reddit' => 'fab fa-reddit-alien" href="' .$redditURL. '"',
			'stumbleupon' => 'fab fa-stumbleupon" href="' .$stumbleuponURL. '"',
			'tumblr' => 'fab fa-tumblr" href="' .$tumblrURL. '"',
			'whatsapp' => 'fab fa-whatsapp" href="' .$whatsappURL. '"',
			'telegram' => 'fab fa-telegram-plane" href="' .$telegramURL. '"'
		);		

		foreach( $selectedSocialURls as $value ) {
			if ( array_key_exists( $value, $allsocialsmeta ) ) :
				echo '<a class="social-links ' .$allsocialsmeta[$value]. '></a>';
			endif;
		}		
	}
endif;