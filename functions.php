<?php
/**
 * Taarifa functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Taarifa
 */

if ( ! function_exists( 'taarifa_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function taarifa_setup() {

		/**
		 * Redux Options.
		 */
		require get_template_directory() . '/inc/admin/redux/admin/admin-init.php';
		
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Taarifa, use a find and replace
		 * to change 'taarifa' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'taarifa', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'menu-1' => esc_html__( 'Primary', 'taarifa' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		/*
		 * Enable Support for post formats
		 */
		add_theme_support( 'post-formats', array(
			'audio',
			'aside',
			'chat',
			'gallery',
			'quote',		
			'video'		
		) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		
	}
endif;
add_action( 'after_setup_theme', 'taarifa_setup' );


/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function taarifa_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'taarifa' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'taarifa' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'taarifa_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function taarifa_scripts() {

	global $wp_query; 

	wp_enqueue_style('taarifa-default-font', 'https://fonts.googleapis.com/css?family=Lato:400,400i,700|PT+Serif:400,400i,700');

	wp_enqueue_style( 'taarifa-libs-css', get_template_directory_uri() . '/assets/css/libs.css', array(), '' );

	wp_enqueue_style( 'taarifa-style', get_stylesheet_uri() );

	wp_deregister_script('jquery');		

	wp_enqueue_script( 'taarifa-libs-js', get_template_directory_uri() . '/assets/js/lib/libs.js', array(), '', true );	

	wp_enqueue_script( 'taarifa-app-js', get_template_directory_uri() . '/assets/js/app.js', array(), '', true );

	wp_localize_script( 'taarifa-app-js', 'taarifa_wp_localize', array(
		'ajaxurl' => site_url() . '/wp-admin/admin-ajax.php',
		'posts' => json_encode( $wp_query->query_vars ),
		'current_page' => get_query_var( 'paged' ) ? get_query_var('paged') : 1,
		'max_page' => $wp_query->max_num_pages,
		'more_post_text' => esc_html__( taarifa_get_option( 'more-posts-text' ), 'taarifa' ),
		'loading_text' => esc_html__( taarifa_get_option( 'loading-text' ), 'taarifa' )
	) );	

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
	
}
add_action( 'wp_enqueue_scripts', 'taarifa_scripts' );


/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/custom-functions/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/custom-functions/template-functions.php';


/**
 * WP Customizer.
 */
require get_template_directory() . '/inc/admin/wp-customizer/customizer.php';


/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/plugin-compatibility/jetpack/jetpack.php';
}

/**
 * Ultimate Shortcode Integration.
 */
if ( class_exists( 'Shortcodes_Ultimate' ) ) {
	require get_template_directory() . '/inc/shortcodes/shortcodes.php';
}

