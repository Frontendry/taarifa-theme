<?php
/**
 * Template part for displaying intro post
 *
 * @package Taarifa
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'blog-post' ); ?>>                                    
    <div class="blog-post-in<?php echo taarifa_post_animation(); ?>>

        <?php
        if ( true === taarifa_check_featured_image() ) : 
        taarifa_post_thumbnail();
        endif;
        ?>

        <div class="blog-post-text">
            <?php 
            
            taarifa_post_intro_data();                     
            
            if( !has_post_format( 'quote' ) && !has_post_format( 'aside' ) ) : ?>
            <div class="cta post-intro-cta">
                <a href="<?php esc_attr( the_permalink() ) ?>">
                    <?php if( !empty( taarifa_get_option( 'readmore-text' ) ) ) : echo esc_html( taarifa_get_option( 'readmore-text' ) ); else : echo esc_html( 'Read More' );endif;  ?>
                </a>
            </div>
            <!-- .post-intro-cta -->
            <?php endif; ?>
        </div>
        <!-- .blog-post-text -->
    </div>
    <!-- .blog-post-in -->
</article>
<!-- .blog-post -->