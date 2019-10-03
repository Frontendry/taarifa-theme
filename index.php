<?php
/**
 * The main template file
 *
 * @package Taarifa
 */

get_header();
?>

			<section class="header-hero-holder <?php echo esc_attr( taarifa_header_layout() ); ?>-hhh">
			
				<?php get_template_part( '/template-parts/page-headers/page-header', taarifa_header_layout() ); ?>

				<?php get_template_part( '/template-parts/hero/hero-section'); ?>
				   
			</section> 
			<!-- .header-hero-holder --> 

			<section class="content-area">
				<div class="container-fluid">
					<div class="row extra-side-space">
						<div class="col no-padd clearfix content-area-in side-pagination-enabled"><!-- Add sidebar-include class here on .content-area-in. Remember to add the file below. Add side-pagination-enabled class to enable side paginations -->
							
							<main class="posts-collect sticky-wrap">
								<?php if ( have_posts() ) : ?>
								<div class="theiaStickySidebar">
									<div class="articles-display">
										<?php get_template_part( '/template-parts/content/content', 'intro' ); ?> 
									</div>
									<!-- .articles-display -->
								</div>
								<!-- .theiaStickySidebar -->
							<?php 
							endif;
							?>
								
							</main>
							<!-- .posts-collect --> 

							<!-- PHP Require sidebar.php file here. -->
						</div>
						<!-- .content-area-in -->
					</div>
					<!-- .row -->
				</div>
				<!-- .container-fluid -->
			</section>
			<!-- .content-area -->

<?php
get_footer();
