<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @package Musilog
 */

get_header();
?>

	<main id="primary" class="site-main container">

		<section class="error-404 not-found" style="text-align: center; padding: 5rem 0;">
			<header class="page-header" style="margin-bottom: 2rem;">
				<h1 class="page-title" style="font-size: 4rem; color: var(--color-primary); margin-bottom: 1rem;">404</h1>
                <h2 style="font-size: 1.5rem;"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'musilog' ); ?></h2>
			</header><!-- .page-header -->

			<div class="page-content" style="max-width: 600px; margin: 0 auto;">
				<p style="margin-bottom: 2rem;"><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try a search?', 'musilog' ); ?></p>
				<?php get_search_form(); ?>
			</div><!-- .page-content -->
		</section><!-- .error-404 -->

	</main><!-- #primary -->

<?php
get_footer();
