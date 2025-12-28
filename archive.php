<?php
/**
 * The template for displaying archive pages
 *
 * @package Musilog
 */

get_header();
?>

	<main id="primary" class="site-main container">

		<?php if ( have_posts() ) : ?>

			<header class="page-header" style="margin-bottom: 3rem; text-align: center; padding: 2rem 0; background: var(--color-bg-secondary); border-radius: var(--border-radius);">
				<?php
				the_archive_title( '<h1 class="page-title" style="margin-bottom: 0.5rem;">', '</h1>' );
				the_archive_description( '<div class="archive-description" style="max-width: 800px; margin: 0 auto; color: var(--color-text-light);">', '</div>' );
				?>
			</header><!-- .page-header -->

            <div class="post-grid">
			<?php
			/* Start the Loop */
			while ( have_posts() ) :
				the_post();
				get_template_part( 'template-parts/content', get_post_type() );
			endwhile;
            ?>
            </div>

            <?php
			the_posts_pagination( array(
                'prev_text' => '<span aria-hidden="true">&larr;</span>',
                'next_text' => '<span aria-hidden="true">&rarr;</span>',
            ) );

		else :
			get_template_part( 'template-parts/content', 'none' );
		endif;
		?>

	</main><!-- #primary -->

<?php
get_footer();
