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
 * Add Meta Description & OGP Tags
 */
function musilog_add_meta_tags() {
    $description = '';
    $title       = '';
    $type        = 'website';
    $url         = home_url( '/' );
    $image       = get_template_directory_uri() . '/assets/images/ogp.png';

    if ( is_single() || is_page() ) {
        global $post;
        $title = get_the_title();
        $type  = 'article';
        $url   = get_permalink();

        if ( has_post_thumbnail( $post ) ) {
            $thumbnail_url = get_the_post_thumbnail_url( $post, 'large' );
            if ( ! empty( $thumbnail_url ) ) {
                $image = $thumbnail_url;
            }
        }

        if ( has_excerpt() ) {
            $description = get_the_excerpt();
        } else {
            $content = $post->post_content;
            $content = strip_shortcodes( $content );
            $content = strip_tags( $content );
            $content = str_replace( array( "\r\n", "\r", "\n" ), '', $content );
            $description = mb_substr( $content, 0, 120, 'UTF-8' );
            if ( mb_strlen( $content, 'UTF-8' ) > 120 ) {
                $description .= '...';
            }
        }
    } elseif ( is_home() || is_front_page() ) {
        $title       = get_bloginfo( 'name' );
        $description = get_bloginfo( 'description' );
        $url         = home_url( '/' );
    } elseif ( is_category() ) {
        $title       = single_cat_title( '', false );
        $description = category_description();
        $url         = get_category_link( get_queried_object_id() );
    } elseif ( is_tag() ) {
        $title       = single_tag_title( '', false );
        $description = tag_description();
        $url         = get_tag_link( get_queried_object_id() );
    } elseif ( is_archive() ) {
        $title       = get_the_archive_title();
        $url         = get_pagenum_link();
    }

    // Fallback if empty
    if ( empty( $description ) && ( is_home() || is_front_page() ) ) {
        $description = get_bloginfo( 'name' ) . ' is a personal blog.';
    }

    // Clean up
    $description = trim( strip_tags( $description ) );
    $site_name   = get_bloginfo( 'name' );

    // Meta Description
    if ( ! empty( $description ) ) {
        echo '<meta name="description" content="' . esc_attr( $description ) . '" />' . "\n";
    }

    // OGP Tags
    echo '<meta property="og:site_name" content="' . esc_attr( $site_name ) . '" />' . "\n";
    echo '<meta property="og:locale" content="' . esc_attr( get_locale() ) . '" />' . "\n";
    echo '<meta property="og:type" content="' . esc_attr( $type ) . '" />' . "\n";
    if ( ! empty( $title ) ) {
        echo '<meta property="og:title" content="' . esc_attr( $title ) . '" />' . "\n";
        echo '<meta name="twitter:title" content="' . esc_attr( $title ) . '" />' . "\n";
    }
    if ( ! empty( $description ) ) {
        echo '<meta property="og:description" content="' . esc_attr( $description ) . '" />' . "\n";
        echo '<meta name="twitter:description" content="' . esc_attr( $description ) . '" />' . "\n";
    }
    echo '<meta property="og:url" content="' . esc_url( $url ) . '" />' . "\n";
    echo '<meta property="og:image" content="' . esc_url( $image ) . '" />' . "\n";
    echo '<meta name="twitter:image" content="' . esc_url( $image ) . '" />' . "\n";
    echo '<meta name="twitter:card" content="summary_large_image" />' . "\n";
}
add_action( 'wp_head', 'musilog_add_meta_tags', 1 );

/**
 * Add custom user contact methods
 */
function musilog_user_contact_methods( $user_contact ) {
    $user_contact['twitter'] = 'X (Twitter)';
    $user_contact['threads'] = 'Threads';
    $user_contact['note']    = 'note';
    $user_contact['youtube'] = 'YouTube';
    return $user_contact;
}
add_filter( 'user_contactmethods', 'musilog_user_contact_methods' );

/** Editable personal site settings. */
function musilog_customize_register( $wp_customize ) {
    $wp_customize->add_section( 'musilog_identity', array( 'title' => 'Musilog：プロフィール・お仕事', 'priority' => 30 ) );
    $fields = array(
        'profile_name' => array( '表示名', '脇村 隆', 'text', 'sanitize_text_field' ),
        'profile_role' => array( '肩書き', 'Web制作×AI活用支援 / Webディレクター', 'text', 'sanitize_text_field' ),
        'profile_bio' => array( '自己紹介', "Web制作に携わって24年。商工会や自治体など公的機関のWebサイト制作・運用を14年にわたり支援してきました。目的の整理から、WordPressでの構築、公開後の運用、AIを使った業務の効率化まで、一人の担当者として一貫してお手伝いします。\n横浜・あざみ野を拠点に活動しています。", 'textarea', 'sanitize_textarea_field' ),
        'profile_url' => array( '詳しいプロフィールのURL', '', 'url', 'esc_url_raw' ),
        'contact_url' => array( 'お問い合わせページのURL', '', 'url', 'esc_url_raw' ),
        'hero_title' => array( 'トップページの見出し', "つくる。伝える。\n日々を、少しよくする。", 'textarea', 'sanitize_textarea_field' ),
        'hero_description' => array( 'トップページの紹介文', 'Webディレクター・Web制作×AI活用支援の脇村 隆です。Web制作と運用の経験をもとに、目的の整理からWordPressの構築・改善まで。事業の「こんなことをしたい」を、一緒にかたちにします。', 'textarea', 'sanitize_textarea_field' ),
    );
    foreach ( $fields as $key => $field ) {
        $wp_customize->add_setting( 'musilog_' . $key, array( 'default' => $field[1], 'sanitize_callback' => $field[3] ) );
        $wp_customize->add_control( 'musilog_' . $key, array( 'label' => $field[0], 'section' => 'musilog_identity', 'type' => $field[2] ) );
    }
    $wp_customize->add_setting( 'musilog_profile_image', array( 'sanitize_callback' => 'absint' ) );
    $wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, 'musilog_profile_image', array( 'label' => 'プロフィール画像', 'section' => 'musilog_identity', 'mime_type' => 'image' ) ) );
}
add_action( 'customize_register', 'musilog_customize_register' );
function musilog_widgets_init() {
    register_sidebar( array( 'name' => 'ブログサイドバー（プロフィールの下）', 'id' => 'sidebar-blog', 'before_widget' => '<section id="%1$s" class="sidebar-widget %2$s">', 'after_widget' => '</section>', 'before_title' => '<h2 class="sidebar-title">', 'after_title' => '</h2>' ) );
}
add_action( 'widgets_init', 'musilog_widgets_init' );
function musilog_blog_url() {
    $page = (int) get_option( 'page_for_posts' );
    return $page ? get_permalink( $page ) : add_query_arg( 'musilog_blog', '1', home_url( '/' ) );
}
/** Prefer existing local content; use verified public pages in an empty preview site. */
function musilog_public_page_url( $path ) {
    $post_id = url_to_postid( home_url( '/' . ltrim( $path, '/' ) ) );
    $page = $post_id ? get_post( $post_id ) : get_page_by_path( trim( $path, '/' ), OBJECT, array( 'page', 'post' ) );
    if ( $page && 'publish' === $page->post_status ) {
        return get_permalink( $page );
    }
    return 'https://musilog.net/' . ltrim( $path, '/' );
}
function musilog_contact_url() {
    $url = get_theme_mod( 'musilog_contact_url', '' );
    if ( $url ) { return $url; }
    foreach ( array( 'inquiry', 'contact' ) as $slug ) {
        $page = get_page_by_path( $slug );
        if ( $page && 'publish' === $page->post_status ) { return get_permalink( $page ); }
    }
    return 'https://musilog.net/inquiry/';
}
function musilog_profile_url() {
    return get_theme_mod( 'musilog_profile_url', '' ) ?: musilog_public_page_url( '/about/' );
}
function musilog_topics() {
    $topics = array(
        array( 'slug' => 'web-memo', 'path' => 'web-memo', 'name' => 'Webメモ', 'label' => 'WEB & CREATION', 'description' => 'Web制作・WordPress・ブログ運営' ),
        array( 'slug' => 'shigoto-memo', 'path' => 'shigoto-memo', 'name' => 'しごとメモ', 'label' => 'WORK & IDEAS', 'description' => 'AI・ガジェット・効率化・働き方' ),
        array( 'slug' => 'kurashi-memo', 'path' => 'kurashi-memo', 'name' => 'くらしメモ', 'label' => 'LIFE & MUSIC', 'description' => '暮らしの発見・音楽・日々の記録' ),
        array( 'slug' => 'spot', 'path' => 'kurashi-memo/spot', 'name' => 'スポット情報', 'label' => 'PLACES & EXPERIENCES', 'description' => '出かけて、体験して、残すメモ' ),
    );
    foreach ( $topics as &$topic ) {
        $term = get_category_by_slug( $topic['slug'] );
        $url = $term ? get_category_link( $term ) : false;
        $topic['url'] = $url && ! is_wp_error( $url ) ? $url : 'https://musilog.net/category/' . $topic['path'] . '/';
    }
    unset( $topic );
    return $topics;
}
function musilog_reading_picks() {
    $picks = array(
        array( 'label' => 'これからの働き方', 'title' => '個人の名前で、仕事をしていく。', 'description' => '会社経営を経て、フリーランスとしての活動も始めることにした理由。', 'path' => '/shigoto-memo/business-management/17826/', 'date' => '2026.08.31' ),
        array( 'label' => 'Web制作の実践', 'title' => 'Web化の下準備もAIで自動化＆高速化する。', 'description' => '飲食店マップのチラシから、住所の調査、公式Webの調査、Excel一覧化からGoogle Mapへ。', 'path' => '/web-memo/website-management/17906/', 'date' => '2025.12.28' ),
        array( 'label' => '日々の小さな効率化', 'title' => '繰り返す作業を、ひとつ減らす。', 'description' => 'Macのショートカットで、複数の画像サイズをまとめて揃える工夫。', 'path' => '/shigoto-memo/macpc/14924/', 'date' => '2022.12.02' ),
    );
    foreach ( $picks as $index => &$pick ) {
        $n = $index + 1;
        $pick['title'] = get_theme_mod( 'musilog_pick_' . $n . '_title', $pick['title'] );
        $pick['description'] = get_theme_mod( 'musilog_pick_' . $n . '_description', $pick['description'] );
        $pick['url'] = get_theme_mod( 'musilog_pick_' . $n . '_url', '' ) ?: musilog_public_page_url( $pick['path'] );
    }
    unset( $pick );
    return $picks;
}
add_filter( 'query_vars', function( $vars ) { $vars[] = 'musilog_blog'; return $vars; } );
add_action( 'pre_get_posts', function( $query ) {
    if ( ! is_admin() && $query->is_main_query() && '1' === $query->get( 'musilog_blog' ) ) {
        $query->set( 'post_type', 'post' );
        $query->set( 'page_id', 0 );
        $query->set( 'pagename', '' );
        $query->is_page = false;
        $query->is_singular = false;
        $query->is_home = true;
    }
} );
add_filter( 'template_include', function( $template ) {
    return '1' === get_query_var( 'musilog_blog' ) ? get_theme_file_path( '/index.php' ) : $template;
} );
function musilog_default_menu() {
    echo '<ul id="primary-menu">';
    $items = array( home_url( '/' ) => 'ホーム', home_url( '/#services' ) => 'Web制作', musilog_blog_url() => 'ブログ', home_url( '/#about' ) => 'プロフィール' );
    foreach ( $items as $url => $label ) {
        echo '<li><a href="' . esc_url( $url ) . '">' . esc_html( $label ) . '</a></li>';
    }
    echo '</ul>';
}

add_action( 'customize_register', function( $wp_customize ) {
    $wp_customize->add_section( 'musilog_reading', array( 'title' => 'Musilog：はじめての方へ', 'priority' => 31 ) );
    foreach ( musilog_reading_picks() as $index => $pick ) {
        foreach ( array( 'title' => '見出し', 'description' => '紹介文', 'url' => '記事URL' ) as $field => $label ) {
            $id = 'musilog_pick_' . ( $index + 1 ) . '_' . $field;
            $wp_customize->add_setting( $id, array( 'default' => 'url' === $field ? '' : $pick[$field], 'sanitize_callback' => 'url' === $field ? 'esc_url_raw' : 'sanitize_text_field' ) );
            $wp_customize->add_control( $id, array( 'label' => '記事' . ( $index + 1 ) . '：' . $label, 'section' => 'musilog_reading', 'type' => 'url' === $field ? 'url' : 'text' ) );
        }
    }
} );
function musilog_footer_menu() {
    echo '<ul id="footer-menu"><li><a href="' . esc_url( musilog_profile_url() ) . '">ムジログについて</a></li><li><a href="' . esc_url( musilog_contact_url() ) . '">お問い合わせ</a></li></ul>';
}
