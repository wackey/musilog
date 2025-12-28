<?php
/**
 * The template for displaying all single posts
 *
 * @package Musilog
 */

get_header();
?>

	<main id="primary" class="site-main container">

		<?php
		while ( have_posts() ) :
			the_post();
            ?>

            <article id="post-<?php the_ID(); ?>" <?php post_class('single-post-card'); ?>>

                <header class="entry-header">
                    <div class="entry-meta">
                        <span class="posted-on"><?php echo get_the_date(); ?></span>
                        <span class="cat-links"><?php the_category( ', ' ); ?></span>
                    </div>

                    <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

                    <?php if ( has_post_thumbnail() ) : ?>
                    <div class="post-thumbnail">
                        <?php the_post_thumbnail( 'large' ); ?>
                    </div>
                    <?php endif; ?>
                </header>

                <!-- Ad Placeholder: Before Content -->
                <div class="ad-placeholder ad-before-content">
                    <p>Advertisement Space (Concept)</p>
                </div>

                <div class="entry-content">
                    <?php
                    the_content();

                    wp_link_pages(
                        array(
                            'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'musilog' ),
                            'after'  => '</div>',
                        )
                    );
                    ?>
                </div><!-- .entry-content -->

                <!-- Ad Placeholder: After Content -->
                <div class="ad-placeholder ad-after-content">
                    <p>Advertisement Space (Concept)</p>
                </div>

                <footer class="entry-footer">
                    <?php
                        // Tags if needed
                        the_tags( '<span class="tags-links">', ' ', '</span>' );
                    ?>
                </footer>

            </article>

            <?php
            // Related Posts (Simple implementation based on category)
            $categories = get_the_category();
            if ( $categories ) {
                $category_ids = array();
                foreach ( $categories as $individual_category ) {
                    $category_ids[] = $individual_category->term_id;
                }

                $args = array(
                    'category__in'     => $category_ids,
                    'post__not_in'     => array( get_the_ID() ),
                    'posts_per_page'   => 3,
                    'caller_get_posts' => 1,
                );

                $related_query = new WP_Query( $args );

                if ( $related_query->have_posts() ) {
                    echo '<div class="related-posts">';
                    echo '<h3>' . esc_html__( 'Related Posts', 'musilog' ) . '</h3>';
                    echo '<div class="post-grid">';
                    while ( $related_query->have_posts() ) {
                        $related_query->the_post();
                        get_template_part( 'template-parts/content', 'related' ); // Reusing content part or similar
                    }
                    echo '</div>';
                    echo '</div>';
                    wp_reset_postdata();
                }
            }

            // Navigation
            echo '<div class="navigation-spacer" style="height: 100px; width: 100%; clear: both;"></div>';
            the_post_navigation(
                array(
                    'prev_text' => '<span class="nav-subtitle">' . esc_html__( 'Previous:', 'musilog' ) . '</span> <span class="nav-title">%title</span>',
                    'next_text' => '<span class="nav-subtitle">' . esc_html__( 'Next:', 'musilog' ) . '</span> <span class="nav-title">%title</span>',
                )
            );

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

		endwhile; // End of the loop.
		?>

	</main><!-- #primary -->

<?php
get_footer();
