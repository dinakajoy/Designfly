<?php
/**
 * The template for displaying the footer.
 * Contains the closing of the #content div and all content after.
 *
 * @package Designfly
 */

?>

			</main><!-- #main -->
		</div><!-- #primary -->
	</div><!-- #content -->

	<footer id="colophon" class="site-footer" role="contentinfo">

		<div class="container footer">
			<div class="footer-welcome">
				<h3><?php echo esc_html( get_theme_mod( 'footer-left-title', 'Welcome To DesignFly' ) ); ?></h3>
				<p>
					<?php
					echo esc_html( get_theme_mod( 'footer-left-description', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation' ) );
					?>
				</p>
				<a href="<?php echo esc_html( get_theme_mod( 'footer-left-link', '#' ) ); ?>"><?php __( 'Read More', 'designfly' ); ?></a>
			</div>

			<div class="footer-welcome">
				<h3><?php echo esc_html( get_theme_mod( 'footer-right-title', 'Contact Us' ) ); ?></h3>
				<div class="footer__contact">
					<address><?php echo esc_html( get_theme_mod( 'footer-right-address', 'Street 21 Planet, A-11, dapibus tristique, 123 551' ) ); ?></address>
					<div>
						<span><?php esc_html_e( 'Tel:', 'designfly' ); ?></span><?php echo esc_html( get_theme_mod( 'footer-right-tel', '123 4567890' ) ); ?>
						<span><?php esc_html_e( 'Fax:', 'designfly' ); ?></span><?php echo esc_html( get_theme_mod( 'footer-right-fax', '123 456789' ) ); ?>
					</div>
					<div><span><?php esc_html_e( 'Email', 'designfly' ); ?></span><a href="mailto:contactus@dsignfly.com"><?php echo esc_html( get_theme_mod( 'footer-right-email', 'contactus@dsignfly.com' ) ); ?></a></div>
				</div>
				<div class="socials">
					<a href="<?php echo esc_html( get_theme_mod( 'footer-facebook-link', '#' ) ); ?>" class="facebook"></a>
					<a href="<?php echo esc_html( get_theme_mod( 'footer-googleplus-link', '#' ) ); ?>" class="googleplus"></a>
					<a href="<?php echo esc_html( get_theme_mod( 'footer-linkedin-link', '#' ) ); ?>" class="linkedin"></a>
					<a href="<?php echo esc_html( get_theme_mod( 'footer-pinterest-link', '#' ) ); ?>" class="pinterest"></a>
					<a href="<?php echo esc_html( get_theme_mod( 'footer-twitter-link', '#' ) ); ?>" class="twitter"></a>
				</div>
			</div>
		</div><!-- .footer -->

		<?php
		if ( is_active_sidebar( 'sidebar-2' ) ) {
			?>
			<aside>
				<?php dynamic_sidebar( 'sidebar-2' ); ?>
			</aside>
		<?php } ?>

		<div class="site-info text-center">
			<span><?php designfly_copyright_text(); ?></span>
		</div><!-- .site-info -->

	</footer><!-- #colophon -->

</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
