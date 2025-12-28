<?php
/**
 * The main template file
 *
 * @package Musilog
 */

get_header();
?>

	<main id="primary" class="site-main container">

		<?php
		if ( have_posts() ) :

			if ( is_home() && ! is_front_page() ) :
				?>
				<header>
					<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
				</header>
				<?php
			endif;
			?>

            <div class="post-grid">
			<?php
			/* Start the Loop */
			while ( have_posts() ) :
				the_post();

				/*
				 * Include the Post-Type-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Type name) and that will be used instead.
				 */
				get_template_part( 'template-parts/content', get_post_type() );

			endwhile;
            ?>
            </div><!-- .post-grid -->
            <?php

			the_posts_navigation( array(
                'prev_text' => __( 'Previous', 'musilog' ),
                'next_text' => __( 'Next', 'musilog' ),
            ) );

		else :

			echo '<p>' . esc_html__( 'Ready to publish your first post? Get started here.', 'musilog' ) . '</p>';

		endif;
		?>

	</main><!-- #primary -->

<?php
get_footer();
