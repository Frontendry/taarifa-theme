<?php
/**
 * The template for displaying all single posts
 *
 * @package Taarifa
 */

get_header();

get_template_part( '/template-parts/page-headers/page-header', taarifa_header_layout() ); 
?>

	<?php
	while ( have_posts() ) : the_post(); 
	?>
	<section class="blog-post-top-header">
		<div class="container-fluid">
			<div class="row blog-post-top-header-row">
				<div class="col no-padd blog-post-top-header-col">
					<div class="bpth-title">
						<span class="title-intro">
						<?php if( !empty( taarifa_get_option( 'you-are-reading-text' ) ) ) : echo esc_html( taarifa_get_option( 'you-are-reading-text' ) ); else : echo esc_html( 'You are reading' );endif;  ?>
						</span>
						<h1><?php echo esc_html( get_the_title() ); ?></h1>
					</div>
					<!-- .bpth-title -->

					<div class="bpth-misc-cont">
						<div class="comment-full-post">
							<a class="comment-icon ion-ios-text" href="#comments"><?php comments_number( 0, 1, '%'); ?> </a>
						</div>  
						<!-- .comment-full-post -->

						<div class="blog-full-nav">
							<?php
							$next_post = get_next_post();
							$prev_post = get_previous_post();

							if (!empty( $prev_post )): ?>
							<a href="<?php echo esc_url( get_permalink( $prev_post->ID ) ); ?>" class="prev-full-blog <?php if( empty( $next_post ) ) : echo 'no-separator';
							endif; ?>"><?php echo esc_html__( 'Previous Article', 'taarifa' ) ?></a>
							<?php
							endif;

							if (!empty( $next_post )): ?>
							<a href="<?php echo esc_url( get_permalink( $next_post->ID ) ); ?>" class="next-full-blog"><?php echo esc_html__( 'Next Article', 'taarifa' ) ?></a>
							<?php endif; ?>

						</div> 
						<!-- .blog-full-nav -->                
					</div>
					<!-- .bpth-misc-cont -->
				</div>
				<!-- .col -->
			</div>
			<!-- .row -->
		</div>
		<!-- .container-fluid -->
	</section>
	<!-- .blog-post-top-header -->

	<section class="content-area">
		<div class="container-fluid">
			<div class="row">
				<div class="col no-padd clearfix content-area-in">
					<main class="post-collect">
						<article id="post-<?php the_ID(); ?>" <?php post_class( 'blog-post-full' ); ?>>
							<div class="blog-post-full-head extra-side-space">
								<div class="bpih-in">
									<?php taarifa_post_intro_data(); ?>
								</div>
								<!-- .bpih-in -->
							</div>
							<!-- .blog-post-full-head -->

							<?php

							if ( true === taarifa_check_featured_image() && false ===  get_post_format() ||true === taarifa_check_featured_image() && 'quote' ===  get_post_format() || true === taarifa_check_featured_image() && 'aside' ===  get_post_format() || true === taarifa_check_featured_image() && 'chat' ===  get_post_format() ) : 

								taarifa_post_thumbnail();						

							elseif ( has_post_format( 'video' ) ) : 

								$video_media = get_post_meta( $post->ID, '_media_video_field', true );
								$o_embedded_media = wp_oembed_get( $video_media );

								if ( !empty( $video_media ) ) : ?>
								<div class="blog-post-full-media">
									<figure class="bpim-in featured-video">
										<?php
										if( $o_embedded_media ) :
											echo '<div class="iframe-vid">' .$o_embedded_media. '</div>';
										else : 
											$getIframe = substr( $video_media, 1,6 );	

											if( $getIframe == 'iframe') : 
												echo '<div class="iframe-vid">' .$video_media. '</div>';
											else:
											?>
												<video width="640" height="360" style="max-width:100%;" preload="auto" controls playsinline webkit-playsinline src="<?php echo esc_url( $video_media ); ?>"></video>
											<?php
											endif;
										endif;
										?>
									</figure>
								</div>
								<?php
								endif;
						
							elseif ( has_post_format( 'audio' ) ) : 
								$audio_media = get_post_meta( $post->ID, '_media_audio_field', true );
								$o_embedded_media = wp_oembed_get( $audio_media );						

								if ( !empty( $audio_media ) ) : ?>
								<div class="blog-post-full-media">
									<figure class="bpim-in featured-audio">
										<?php
										if( $o_embedded_media ) :
											if( strpos( $audio_media, 'mixcloud' ) !== false || strpos( $audio_media, 'reverbnation' ) !== false ) :
												echo '<div class="no-aspect-ratio">' .$o_embedded_media. '</div>';
											else:
											echo '<div class="iframe-aud">' .$o_embedded_media. '</div>';
											endif;											
										else : 
											$getIframe = substr( $audio_media, 1,6 );	
											$getShortCodeOpener = substr( $audio_media, 0,1 );
											
											if( $getIframe == 'iframe' ) : 
												if( strpos( $audio_media, 'mixcloud' ) !== false || strpos( $audio_media, 'reverbnation' ) !== false ) :
													echo '<div class="no-aspect-ratio">' .$audio_media. '</div>';
												else:
												echo '<div class="iframe-aud">' .$audio_media. '</div>';
												endif;
											else :
												if( $getShortCodeOpener === '[' ) :
													global $wp_embed;
													$audioshortcode = $wp_embed->run_shortcode( $audio_media );

													if( strpos( $audioshortcode, 'mixcloud' ) !== false || strpos( $audioshortcode, 'reverbnation' ) !== false ) :
														echo '<div class="no-aspect-ratio">' .$audioshortcode. '</div>';
													else:
													echo '<div class="iframe-aud">' .$audioshortcode. '</div>';
													endif;

												else : ?>												
												<audio preload="auto" controls style="max-width:100%;" src="<?php echo esc_url( $audio_media ); ?>"></audio>
												
												<?php
												endif;
											endif;
										endif;
										?>
									</figure>
								</div>
								<?php
								endif;
							elseif ( has_post_format( 'gallery' ) ) : 
								$gallery_media = get_post_meta( $post->ID, '_media_gallery_field', true );

								if( !empty( $gallery_media ) ) :							
								$first_gallery_image = wp_get_attachment_image_src($gallery_media[0], 'full');
								?>
								<div class="blog-post-full-media">
									<figure class="bpim-in featured-image">
										<img src="<?php echo $first_gallery_image[0];  ?>" alt="<?php get_the_title() ?>">
									</figure>

									<?php taarifa_gallery_photos_cta(); ?>
								</div>
								<!-- .blog-post-full-media -->

								<div class="page-modal gallery-modal">
									<div class="page-modal-in">
										<div class="page-modal-header">
											<div class="pmh-ls">
												<div class="back-post cta-3">
													<button>
														<?php if( !empty( taarifa_get_option( 'back-to-post-text' ) ) ) : echo esc_html( taarifa_get_option( 'back-to-post-text' ) ); else : echo esc_html( 'Back to post' );endif;  ?>
													</button>
												</div>
												
											</div>
											<!-- .pmh-ls -->

											<div class="pmh-cs">
												<div class="gallery-modal-counter">
													<span class="gallery-counter-position"></span>
													<span class="gallery-counter-total"></span>
												</div>
												<!-- .gallery-modal-counter -->
											</div>
											<!-- .pmh-cs -->

											<div class="pmh-rs">
												<div class="gallery-modal-nav-cont">
													<span class="prev-gmn gallery-modal-nav" title="<?php __( 'Previous image', 'taarifa' ) ?>"></span>
													<span class="view-all-gmn" title="<?php __( 'View all images', 'taarifa' ) ?>"></span>
													<span class="next-gmn gallery-modal-nav" title="<?php __( 'Next image', 'taarifa' ) ?>"></span>
												</div>
												<!-- .gallery-modal-nav -->
											</div>
											<!-- .pmh-rs -->
										</div>
										<!-- .page-modal-header -->

										<div class="page-modal-body">

											<div class="pmb-ls">
												<div class="gallery-modal-post-title">
													<span class="title-intro">
													<?php if( !empty( taarifa_get_option( 'you-are-reading-text' ) ) ) : echo esc_html( taarifa_get_option( 'you-are-reading-text' ) ); else : echo esc_html( 'You are reading' );endif;  ?>
													</span>
													<h2><?php echo esc_html( get_the_title() ); ?></h2>
												</div>
												<!-- .gallery-modal-post-title -->

												<div class="gallery-modal-image-caption">
													<p></p>
												</div>
												<!-- .gallery-modal-image-caption -->

												<div class="gallery-modal-social">
													<a href="#" class="fab fa-facebook-f"></a>
													<a href="#" class="fab fa-twitter"></a>
													<a href="#" class="fab fa-instagram"></a>
												</div>
												<!-- .gallery-modal-social -->
											</div>
											<!-- .pmb-ls --> 

											<div class="pmb-rs">
												<div class="gallery-modal-carousel">
													<?php
													foreach ( $gallery_media as $gallery_image_id ) {
														$thumbnail = wp_get_attachment_image_src($gallery_image_id, 'full');

														$caption = wp_get_attachment_caption( $gallery_image_id );

														$alt = get_post_meta( $gallery_image_id, '_wp_attachment_image_alt', true );	
														
														echo '<figure class="single-gmc-image"'. ( ( !empty( $caption ) ) ? 'data-gmc-caption="' . $caption . '"' : "" ) .'><img src="' . $thumbnail[0] . '"' . ( ( !empty( $alt ) ) ? 'alt="' . $alt . '"' : "" ) . '/></figure>';
													}
													?>
												</div>
												<!-- .gallery-modal-carousel -->

												<div class="gallery-modal-grid">
													<div class="gallery-modal-grid-in">
														<div class="gallery-modal-masonry">
															<div class="modal-grid-sizer"></div>
															<div class="modal-gutter-sizer"></div>

															<?php
															$gridcount = 0; 
															foreach ( $gallery_media as $gallery_image_id ) {
																$thumbnail = wp_get_attachment_image_src($gallery_image_id, 'full');

																$alt = get_post_meta( $gallery_image_id, '_wp_attachment_image_alt', true );	
																
																echo '<figure class="single-grid-image" data-grid-count="' .$gridcount++. '"><img src="' . $thumbnail[0] . '"' . ( ( !empty( $alt ) ) ? 'alt="' . $alt . '"' : "" ) . '/></figure>';
															}
															?>
														</div>
														<!-- .gallery-modal-masonry -->
													</div>
													<!-- .gallery-modal-grid-in -->
													
												</div>
											</div>
											<!-- .pmb-rs -->											
										</div>
										<!-- .page-modal-body -->
									</div>
									<!-- .gallery-modal-in -->
								</div>
								<!-- .gallery-modal -->
								<?php
								endif;								
							endif;
							?>

							<div class="blog-post-in-body">
								<div class="blog-post-content text-content">

									<?php
									if( has_post_format( 'quote' ) ) : ?>

									<blockquote>
										<?php the_content(); 

										$current_quote_author = get_post_meta( $post->ID, '_quote_author_field', true );

										if( !empty( $current_quote_author ) ) : ?>	
										<footer class="author-cont">
											<p><?php echo esc_html( $current_quote_author ); ?></p>
										</footer>
										<?php endif; ?>
									</blockquote>

									<?php 
									else :
									the_content();
									endif; 
									?>

								</div>
								<!-- .blog-post-content -->

								<div class="blog-post-tags">

								</div>
								<!-- .blog-post-tags -->

								<?php
								// If comments are open or we have at least one comment, load up the comment template.
								if ( comments_open() || get_comments_number() ) :
									comments_template();
								endif; 
								
								$social_share_options = taarifa_get_option( 'posts_social_opts' );

								if( in_array( '1', $social_share_options, true ) ) : ?> 
								<div class="social-posts-share">
									<?php taarifa_social_share(); ?>
								</div>
								<!-- .social-posts-share -->
								<?php 
								endif;
								?>
							</div>
							<!-- .blog-post-in-body -->
						</article>
						<!-- .blog-post-in -->
					</main>
					<!-- .post-collect -->
				</div>
				<!-- .content-area-in -->
			</div>
			<!-- .row -->
		</div>
		<!-- .container-fluid -->
	</section>
	<!-- .content-area -->

	<?php
	endwhile; 

get_footer();
