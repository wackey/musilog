<?php /** Blog sidebar. @package Musilog */ ?>
<aside class="blog-sidebar" aria-label="プロフィールとブログ案内">
    <section id="about" class="profile-card">
        <p class="eyebrow">ABOUT ME</p>
        <div class="profile-photo"><?php
        $profile_image = get_theme_mod( 'musilog_profile_image' );
        if ( $profile_image ) { echo wp_get_attachment_image( $profile_image, 'thumbnail', false, array( 'alt' => '', 'loading' => 'lazy' ) ); }
        else { ?><img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/musilog_logo.png' ); ?>" alt="" loading="lazy"><?php }
        ?></div>
        <h2><?php echo esc_html( get_theme_mod( 'musilog_profile_name', '脇村 隆' ) ); ?></h2>
        <p class="profile-role"><?php echo esc_html( get_theme_mod( 'musilog_profile_role', 'Webディレクター / ブロガー' ) ); ?></p>
        <p class="profile-since">WRITING SINCE 2006</p>
        <div class="profile-bio"><?php echo wpautop( esc_html( get_theme_mod( 'musilog_profile_bio', '脇村 隆（wackey）。Webディレクション・制作を経て、企業の発信やメディア運営に携わってきました。2006年から、Web・AI・仕事の工夫と暮らしの実体験をムジログに綴っています。' ) ) ); ?></div>
        <a class="profile-link" href="<?php echo esc_url( musilog_profile_url() ); ?>">ムジログと脇村 隆について <span aria-hidden="true">→</span></a>
    </section>
    <?php if ( is_active_sidebar( 'sidebar-blog' ) ) : dynamic_sidebar( 'sidebar-blog' ); else : ?>
    <section class="sidebar-widget"><h2 class="sidebar-title">記事を探す <span>SEARCH</span></h2><?php get_search_form(); ?></section>
    <section class="sidebar-widget"><h2 class="sidebar-title">カテゴリー <span>CATEGORY</span></h2><ul class="category-list"><?php foreach ( musilog_topics() as $topic ) : ?><li><a href="<?php echo esc_url( $topic['url'] ); ?>"><?php echo esc_html( $topic['name'] ); ?></a><span aria-hidden="true">→</span></li><?php endforeach; ?></ul></section>
    <section class="sidebar-widget"><h2 class="sidebar-title">最近の記事 <span>RECENT POSTS</span></h2><ul class="recent-list"><?php
    $recent = new WP_Query( array( 'posts_per_page' => 3, 'ignore_sticky_posts' => true, 'no_found_rows' => true ) );
    while ( $recent->have_posts() ) : $recent->the_post(); ?><li><a href="<?php the_permalink(); ?>"><time datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>"><?php echo esc_html( get_the_date( 'Y.m.d' ) ); ?></time><?php the_title(); ?></a></li><?php endwhile; wp_reset_postdata(); ?></ul></section>
    <?php endif; ?>
    <a class="sidebar-cta" href="<?php echo esc_url( musilog_contact_url() ); ?>"><span>LET’S CREATE SOMETHING</span><strong>Web制作のご相談 <span aria-hidden="true">↗︎</span></strong><span>想いが伝わるサイトを、一緒に。</span></a>
</aside>
