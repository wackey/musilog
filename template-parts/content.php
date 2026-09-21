<?php
/**
 * Template part for displaying posts
 *
 * @package Musilog
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class('post-card'); ?>>

    <?php if ( has_post_thumbnail() ) : ?>
	<header class="entry-header">
        <a href="<?php the_permalink(); ?>" class="post-thumbnail">
            <?php the_post_thumbnail( 'medium_large', array( 'loading' => 'lazy' ) ); ?>
        </a>
	</header><!-- .entry-header -->
    <?php else : ?>
    <a href="<?php the_permalink(); ?>" class="post-thumbnail thumbnail-placeholder" aria-label="<?php echo esc_attr( get_the_title() ); ?>"><span>musilog<span class="placeholder-dot">.</span></span><small>IDEAS, NOTES &amp; EVERYDAY LIFE</small></a>
    <?php endif; ?>

	<div class="entry-content-wrapper">
        <?php
        the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
        ?>

        <div class="entry-meta">
            <span class="posted-on">
                <?php echo get_the_date(); ?>
            </span>
             <span class="cat-links">
                <?php the_category( ', ' ); ?>
            </span>
        </div><!-- .entry-meta -->

        <div class="entry-excerpt">
            <?php the_excerpt(); ?>
        </div>
    </div><!-- .entry-content-wrapper -->

</article><!-- #post-<?php the_ID(); ?> -->
