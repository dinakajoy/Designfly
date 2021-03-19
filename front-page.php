<?php
/**
 * This is the custom homepage
 *
 * It can be edited through the customizer
 *
 * @package Designfly
 */

get_header();
?>

<section>
	<div class="intro container">
		<h2 class="intro__title"><?php echo esc_html( get_theme_mod( 'homepage-title', 'D\'SIGN IS THE SOUL' ) ); ?></h2>
		<a href="<?php echo esc_html( get_theme_mod( 'homepage-cta-url', '#' ) ); ?>" class="intro__cta"><?php echo esc_html( get_theme_mod( 'homepage-cta-text', 'view all' ) ); ?></a>
	</div>
</section>

<section class="portfolio-wrapper container">
	<?php
	$designfly_args      = array(
		'post_type'      => 'designfly_portfolio',
		'posts_per_page' => 6,
	);
	$designfly_the_query = new WP_Query( $designfly_args );
	?>

	<?php if ( $designfly_the_query->have_posts() ) : ?>

		<?php
		while ( $designfly_the_query->have_posts() ) :
			$designfly_the_query->the_post();
			?>

			<?php get_template_part( 'template-parts/content', 'portfolio' ); ?>

		<?php endwhile; ?>

	<?php else : ?>

		<p><?php __( 'Sorry, no posts matched your criteria.', 'designfly' ); ?></p>

	<?php endif; ?>

</section> <!-- .portfolio-wrapper -->

<?php
get_footer();
