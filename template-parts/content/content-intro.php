<?php
/**
 * Template part for displaying introduction posts
 *
 * @package Taarifa
 */

?>

 <div class="articles-display-in clearfix <?php echo esc_attr( taarifa_post_layout_class() ); ?>">

		<?php
		if( 'masonry-grid-layout' === taarifa_post_layout() ) :
		?>
        <div class="grid-sizer"></div>
		<div class="gutter-sizer"></div>
		<?php
		endif;
		
        while ( have_posts() ) : the_post(); 
        get_template_part( '/template-parts/content/post-intro-layout' ); 
		endwhile;
		?>
    </div>
    <!-- .articles-display-in -->

    <?php taarifa_pagination_layout(); ?>

