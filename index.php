<?php get_header(); ?>
<main id="primary" class="site-main container">
    <header class="listing-header"><p class="eyebrow">JOURNAL</p><h1><?php
    if ( is_search() ) { printf( '「%s」の検索結果', esc_html( get_search_query() ) ); }
    elseif ( is_archive() ) { the_archive_title(); }
    else { echo 'ブログ'; }
    ?></h1><?php if ( is_archive() ) { the_archive_description( '<div>', '</div>' ); } else { ?><p>Web・AI・仕事の工夫から、音楽や暮らしの記録まで。</p><?php } ?></header>
    <?php get_template_part( 'template-parts/topics' ); ?>
    <div class="blog-layout"><div class="blog-main">
    <?php if ( have_posts() ) : ?><div class="post-grid"><?php while ( have_posts() ) : the_post(); get_template_part( 'template-parts/content' ); endwhile; ?></div>
    <?php the_posts_pagination( array( 'prev_text' => '←', 'next_text' => '→' ) ); else : get_template_part( 'template-parts/content', 'none' ); endif; ?>
    </div><?php get_sidebar(); ?></div>
</main>
<?php get_footer(); ?>
