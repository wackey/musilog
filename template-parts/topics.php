<?php /** Existing Musilog categories, with live fallbacks for local previews. */ ?>
<nav class="topic-grid" aria-label="テーマ別に記事を読む">
<?php foreach ( musilog_topics() as $topic ) : ?>
    <a class="topic-card" href="<?php echo esc_url( $topic['url'] ); ?>"><span class="topic-label"><?php echo esc_html( $topic['label'] ); ?></span><strong><?php echo esc_html( $topic['name'] ); ?><span aria-hidden="true">→</span></strong><span><?php echo esc_html( $topic['description'] ); ?></span></a>
<?php endforeach; ?>
</nav>
