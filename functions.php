<?php
/**
 * Musilog Theme Functions
 *
 * @package Musilog
 */

if ( ! function_exists( 'musilog_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 */
	function musilog_setup() {
		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		// Let WordPress manage the document title.
		add_theme_support( 'title-tag' );

		// Enable support for Post Thumbnails on posts and pages.
		add_theme_support( 'post-thumbnails' );

        // Custom Logo support
        add_theme_support( 'custom-logo', array(
            'height'      => 60,
            'width'       => 200,
            'flex-height' => true,
            'flex-width'  => true,
            'header-text' => array( 'site-title', 'site-description' ),
        ) );

		// Register navigation menus.
		register_nav_menus( array(
			'menu-1' => esc_html__( 'Primary', 'musilog' ),
            'menu-footer' => esc_html__( 'Footer', 'musilog' ),
		) );

		// Switch default core markup for search form, comment form, and comments to output valid HTML5.
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comments',
			'gallery',
			'caption',
		) );
	}
endif;
add_action( 'after_setup_theme', 'musilog_setup' );

/**
 * Enqueue scripts and styles.
 */
function musilog_scripts() {
    // Google Fonts: Inter and Outfit
    wp_enqueue_style( 'musilog-fonts', 'https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700&family=Outfit:wght@500;700&family=Noto+Sans+JP:wght@400;500;700&display=swap', array(), null );

	// Main Stylesheet
	wp_enqueue_style( 'musilog-style', get_stylesheet_uri(), array(), filemtime( get_stylesheet_directory() . '/style.css' ) );

    // Main Scripts
    wp_enqueue_script( 'musilog-script', get_template_directory_uri() . '/assets/js/main.js', array(), filemtime( get_template_directory() . '/assets/js/main.js' ), true );
}
add_action( 'wp_enqueue_scripts', 'musilog_scripts' );

/**
 * Add Meta Description
 */
function musilog_add_meta_tags() {
    if ( is_single() || is_page() ) {
        global $post;
        $description = '';

        if ( has_excerpt() ) {
            $description = get_the_excerpt();
        } else {
            $content = $post->post_content;
            $content = strip_shortcodes( $content );
            $content = strip_tags( $content );
            $content = str_replace( array("\r\n", "\r", "\n"), '', $content );
            $description = mb_substr( $content, 0, 120, 'UTF-8' );
            if ( mb_strlen( $content, 'UTF-8' ) > 120 ) {
                $description .= '...';
            }
        }
    } elseif ( is_home() || is_front_page() ) {
        $description = get_bloginfo( 'description' );
    } elseif ( is_category() ) {
        $description = category_description();
    } elseif ( is_tag() ) {
        $description = tag_description();
    }

    // Fallback if empty
    if ( empty( $description ) && ( is_home() || is_front_page() ) ) {
         $description = get_bloginfo( 'name' ) . ' is a personal blog.';
    }

    // Clean up
    $description = trim( strip_tags( $description ) );

    if ( ! empty( $description ) ) {
        echo '<meta name="description" content="' . esc_attr( $description ) . '" />' . "\n";
    }
}
add_action( 'wp_head', 'musilog_add_meta_tags', 1 );
