<?php
/**
 * Template part for displaying featured content.
 *
 * @package Designfly
 */

?>

<section class="feature-area">
	<div class="container">
		<div class="feature-area__container">
			<div class="feature">
				<div class="feature__icon1"></div>
				<div class="feature__content">
					<h2><?php echo esc_html( get_theme_mod( 'feature1-title', 'Advertising' ) ); ?></h2>
					<p><?php echo esc_html( get_theme_mod( 'feature1-description', 'Advertising is very very good. Advertising is very very good' ) ); ?></p>
				</div>
			</div>

			<div class="feature">
				<div class="feature__icon2"></div>
				<div class="feature__content">
					<h2><?php echo esc_html( get_theme_mod( 'feature2-title', 'Multimedia' ) ); ?></h2>
					<p><?php echo esc_html( get_theme_mod( 'feature2-description', 'Multimedia is very very good. Multimedia is very very good' ) ); ?></p>
				</div>
			</div>

			<div class="feature">
				<div class="feature__icon3"></div>
				<div class="feature__content">
					<h2><?php echo esc_html( get_theme_mod( 'feature3-title', 'Photography' ) ); ?></h2>
					<p><?php echo esc_html( get_theme_mod( 'feature3-description', 'Photography is very very good. Photography is very very good' ) ); ?></p>
				</div>
			</div>
		</div><!-- .feature-area__container -->
	</div><!-- .container -->
</section><!-- .feature-area -->
