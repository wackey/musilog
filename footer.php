<?php
/**
 * The template for displaying the footer
 *
 * @package Musilog
 */
?>

	<footer id="colophon" class="site-footer">
        <div class="container footer-container">

            <div class="footer-branding">
                <div class="site-info">
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
                        &copy; <?php echo date( 'Y' ); ?> <?php bloginfo( 'name' ); ?>
                    </a>
                </div><!-- .site-info -->
            </div>

            <nav class="footer-navigation">
                <?php
                wp_nav_menu(
                    array(
                        'theme_location' => 'menu-footer',
                        'menu_id'        => 'footer-menu',
                        'depth'          => 1,
                    )
                );
                ?>
            </nav>

        </div><!-- .container -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
