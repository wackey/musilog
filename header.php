<?php
/**
 * The header for our theme
 *
 * @package Musilog
 */
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'musilog' ); ?></a>

	<header id="masthead" class="site-header">
        <div class="container header-container">
            <div class="site-branding">
                <?php
                if ( has_custom_logo() ) {
                    the_custom_logo();
                } else {
                    // Default to the provided Musilog logo if available
                    $logo_url = get_template_directory_uri() . '/assets/images/musilog_logo.png';
                    ?>
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="custom-logo-link" rel="home">
                        <img src="<?php echo esc_url( $logo_url ); ?>" class="custom-logo" alt="<?php bloginfo( 'name' ); ?>">
                    </a>
                    <?php
                }
                ?>
            </div><!-- .site-branding -->

            <nav id="site-navigation" class="main-navigation">
                <button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false">
                    <span class="screen-reader-text"><?php esc_html_e( 'Primary Menu', 'musilog' ); ?></span>
                    <span class="bar"></span>
                    <span class="bar"></span>
                    <span class="bar"></span>
                </button>
                <?php
                wp_nav_menu(
                    array(
                        'theme_location' => 'menu-1',
                        'menu_id'        => 'primary-menu',
                        'container_class'=> 'primary-menu-container',
                    )
                );
                ?>
                <button id="search-toggle" class="search-toggle" aria-label="Open Search">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                </button>
            </nav><!-- #site-navigation -->

            <div id="header-search-overlay" class="header-search-overlay">
                 <button id="search-close" class="search-close">&times;</button>
                 <div class="search-container">
                    <?php get_search_form(); ?>
                 </div>
            </div>
        </div><!-- .container -->
	</header><!-- #masthead -->
