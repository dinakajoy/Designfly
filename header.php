<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package Designfly
 */

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="preconnect" href="https://fonts.gstatic.com">
	<?php wp_head(); ?>
	<style>
		.slider {
			background-image: url(<?php echo esc_html( get_theme_mod( 'slider-image', get_bloginfo( 'template_directory' ) . '/assets/build/img/slider-image.png' ) ); ?>);
		}
	</style>
</head>

<body <?php body_class(); ?>>

<div id="page" class="hfeed site">

	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'designfly' ); ?></a>

	<header id="masthead" class="site-header" role="banner">
		<div class="site-branding">
			<?php
			if ( get_theme_mod( 'custom_logo' ) ) {
				the_custom_logo();
				designfly_site_title( 'screen-reader-text' );
			} else {
				designfly_site_title();
			}

			designfly_site_description();
			?>
		</div><!-- .site-branding -->
		<nav id="site-navigation" class="designfly-main-navigation" role="navigation" aria-label="<?php esc_attr_e( 'Primary Menu', 'designfly' ); ?>">
			<div class="mobile-nav">
				<div id="myNav" class="overlay">
					<a href="javascript:void(0)" id="closebtn" class="closebtn" onclick="closeNav()">&times;</a>
					<div class="overlay-content">
						<?php
						wp_nav_menu(
							array(
								'theme_location' => 'primary',
								'menu_class'     => 'primary-menu menu overlay-content mobile',
								'depth'          => 3,
							)
						);
						?>
					</div>
				</div>
				<span class="dashicons dashicons-menu" id="menu-open"></span>
			</div>

			<div class="desktop-nav">
				<?php
				wp_nav_menu(
					array(
						'theme_location' => 'primary',
						'menu_id'        => 'primary-menu',
						'menu_class'     => 'primary-menu menu desktop',
						'depth'          => 3,
					)
				);
				?>

				<div class="header-search">
					<?php get_search_form(); ?>
				</div>
			</div>
		</nav><!-- #site-navigation -->
	</header><!-- #masthead -->

	<div id="content" class="site-content">
		<div id="primary">
			<main id="main" role="main">
				<?php
				if ( is_front_page() ) {

					get_template_part( 'template-parts/front-page/slider' );

				};

				get_template_part( 'template-parts/featured-content' );
				?>
