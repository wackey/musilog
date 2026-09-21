<?php
/** Freelance creator home. @package Musilog */
get_header();
?>
<main id="primary" class="home-main">
    <section class="creator-hero container">
        <div class="hero-copy">
            <p class="eyebrow"><span></span> TAKASHI WAKIMURA / MUSILOG</p>
            <h1><?php echo nl2br( esc_html( get_theme_mod( 'musilog_hero_title', "つくる。伝える。\n日々を、少しよくする。" ) ) ); ?></h1>
            <p class="hero-description"><?php echo esc_html( get_theme_mod( 'musilog_hero_description', 'Webディレクター・ブロガーの脇村 隆です。Web制作と運用の経験をもとに、目的の整理からWordPressの構築・改善まで。事業の「こんなことをしたい」を、一緒にかたちにします。' ) ); ?></p>
            <div class="hero-actions"><a class="button button-dark" href="<?php echo esc_url( musilog_contact_url() ); ?>">Web制作を相談する <span aria-hidden="true">↗︎</span></a><a class="text-link" href="<?php echo esc_url( musilog_blog_url() ); ?>">ブログを読む <span aria-hidden="true">→</span></a></div>
            <p class="hero-note">WEB DIRECTION / WORDPRESS / BLOGGING</p>
        </div>
        <div class="hero-art" aria-hidden="true">
            <div class="art-orbit"></div><span class="art-star">✳︎</span>
            <div class="browser-art"><div class="browser-bar"><i></i><i></i><i></i><span>MUSILOG — SINCE 2006</span></div><div class="browser-body"><div class="art-mini-brand">Web, work, and everyday life.</div><div class="art-headline">Make it.<br>Share it<span>.</span></div><div class="art-rule"></div><div class="art-rule short"></div><div class="art-button">LET’S CREATE <span>↗︎</span></div><div class="art-flower">✳︎</div></div></div>
            <div class="code-art"><span>&lt; / &gt;</span> Written from experience.</div><div class="art-caption">CREATE. TRY. WRITE.</div>
        </div>
    </section>
    <div class="expertise-strip"><div class="container"><span>2006年から、試して、書いて、積み重ねる。</span><span>Web <b>＋</b> AI <b>＋</b> Work <b>＋</b> Life</span></div></div>
    <section id="services" class="services-section container">
        <div class="section-heading"><div><p class="eyebrow">WHAT I DO</p><h2>相談から、制作・運用まで。</h2></div><p>Web制作・メディア運営の経験を、あなたの事業に。<br>まだ要件が固まっていない段階からご相談いただけます。</p></div>
        <div class="service-grid">
            <article class="service-card"><div class="service-top"><span class="service-icon" aria-hidden="true">▤</span><span>01</span></div><h3>企画・Webディレクション</h3><p>誰に、何を届けたいのか。事業の目的と情報を整理して、サイトの構成や制作の進め方から一緒に考えます。</p><span class="service-tag">要件整理 / サイト設計 / 制作進行</span></article>
            <article class="service-card"><div class="service-top"><span class="service-icon" aria-hidden="true">W</span><span>02</span></div><h3>Web制作・WordPress構築</h3><p>更新しやすく、育てていけるサイトへ。オリジナルテーマの制作から、既存サイトのカスタマイズまで。</p><span class="service-tag">テーマ制作 / CMS導入 / カスタマイズ</span></article>
            <article class="service-card"><div class="service-top"><span class="service-icon" aria-hidden="true">↗︎</span><span>03</span></div><h3>運用・発信のサポート</h3><p>公開後も更新し、育てていけるように。ブログやメディアの運営経験を活かし、日々の更新や改善をお手伝いします。</p><span class="service-tag">サイト改善 / コンテンツ整理 / 更新支援</span></article>
        </div>
    </section>
    <section class="topic-section container" aria-labelledby="topics-heading">
        <div class="section-heading"><div><p class="eyebrow">EXPLORE MUSILOG</p><h2 id="topics-heading">気になるテーマから。</h2></div><p>Webも、仕事も、音楽も、暮らしも。</p></div>
        <?php get_template_part( 'template-parts/topics' ); ?>
    </section>
    <section class="home-journal"><div class="container blog-layout"><div class="blog-main">
        <div class="section-heading"><div><p class="eyebrow">START HERE</p><h2>はじめての方へ。</h2></div></div>
        <p class="section-description">ムジログの仕事と実践が伝わる、3つの読みもの。</p>
        <div class="reading-picks"><?php foreach ( musilog_reading_picks() as $index => $pick ) : ?>
            <article class="reading-pick"><span class="pick-number" aria-hidden="true"><?php echo esc_html( sprintf( '%02d', $index + 1 ) ); ?></span><div><p class="pick-label"><?php echo esc_html( $pick['label'] ); ?></p><h3><a href="<?php echo esc_url( $pick['url'] ); ?>"><?php echo esc_html( $pick['title'] ); ?></a></h3><p><?php echo esc_html( $pick['description'] ); ?></p></div><span class="pick-arrow" aria-hidden="true">↗︎</span></article>
        <?php endforeach; ?></div>
        <div class="section-heading journal-heading"><div><p class="eyebrow">LATEST JOURNAL</p><h2>最近のメモ。</h2></div><a class="text-link" href="<?php echo esc_url( musilog_blog_url() ); ?>">記事一覧 <span aria-hidden="true">→</span></a></div>
        <p class="section-description">AIやWebの実践、仕事の工夫、暮らしの記録を更新しています。</p>
        <div class="post-grid"><?php
        $journal = new WP_Query( array( 'posts_per_page' => 6, 'ignore_sticky_posts' => true, 'no_found_rows' => true ) );
        if ( $journal->have_posts() ) : while ( $journal->have_posts() ) : $journal->the_post();
            get_template_part( 'template-parts/content' );
        endwhile; else : get_template_part( 'template-parts/content', 'none' ); endif;
        wp_reset_postdata();
        ?></div>
    </div><?php get_sidebar(); ?></div></section>
    <?php if ( 'page' === get_option( 'show_on_front' ) ) : while ( have_posts() ) : the_post(); if ( trim( get_the_content() ) ) : ?>
    <section class="container home-page-content entry-content"><?php the_content(); wp_link_pages(); ?></section>
    <?php endif; endwhile; endif; ?>
    <section id="contact" class="contact-section container"><div><p class="eyebrow">LET’S WORK TOGETHER</p><h2>Webのこと、<br>まずは話してみませんか。</h2><p>新規制作・リニューアル・運用改善のご相談を、脇村 隆がお受けします。</p></div>
    <a class="button button-dark" href="<?php echo esc_url( musilog_contact_url() ); ?>">制作・お仕事のお問い合わせ <span aria-hidden="true">↗︎</span></a>
    </section>
</main>
<?php get_footer(); ?>
