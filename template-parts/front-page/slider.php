<?php
/**
 * Displays the slider content on the homepage.
 *
 * @package Designfly
 */

?>

	<section class="slider-container">
		<div class="slider">
			<div class="slider__content fade">
				<h1><?php echo esc_html( get_theme_mod( 'slider-title', 'Gearing up the ideas' ) ); ?></h1>
				<p><?php echo esc_html( get_theme_mod( 'slider-description', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.' ) ); ?></p>
			</div>

			<div class="slider__content fade">
				<h1><?php esc_html_e( 'Gearing up the ideas again', 'designfly' ); ?></h1>
				<p><?php esc_html_e( 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'designfly' ); ?></p>
			</div>
		</div>

		<a class="prev-slider" id="prev"></a>
		<a class="next-slider" id="next"></a>
	</section>
