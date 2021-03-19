<?php
/**
 * Template Name: Portfolio Template
 *
 * Used for showing portfolio content
 *
 * @package Designfly
 */

get_header();
?>

<section class="portfolio-meta container">
	<h2>DESIGN IS THE SOUL</h2>
	<div>
		<span>Advertising</span>
		<span>Multimedia</span>
		<span>Photography</span>
	</div>
</section>

<section class="portfolio-wrapper container">
	<?php
	if ( get_query_var( 'paged' ) ) {
		$designfly_paged = get_query_var( 'paged' );
	} elseif ( get_query_var( 'page' ) ) {
		$designfly_paged = get_query_var( 'page' );
	} else {
		$designfly_paged = 1;
	}

		$designfly_args = array(
			'post_type'           => 'designfly_portfolio',
			'posts_per_page'      => get_option( 'posts_per_page' ),
			'paged'               => $designfly_paged,
			'post_status'         => 'publish',
			'ignore_sticky_posts' => true,
			'order'               => 'DESC',
			'orderby'             => 'date',
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
		<p><?php esc_html( 'Sorry, no posts matched your criteria.' ); ?></p>
	<?php endif; ?>


	<?php if ( $designfly_custom_query->max_num_pages > 1 ) : ?>
		<?php
		$designfly_orig_query = $designfly_wp_query;
		$designfly_wp_query   = $designfly_custom_query;
		?>
		<nav class="portfolio-pagination clearfix">
			<?php
			the_posts_pagination(
				array(
					'show_all'  => false,
					'end_size'  => 1,
					'mid_size'  => 1,
					'prev_text' => __( '<i class="fa fa-caret-left"></i>', 'designfly' ),
					'next_text' => __( '<i class="fa fa-caret-right"></i>', 'designfly' ),
				)
			);
			?>
		</nav>
		<?php $designfly_wp_query = $designfly_orig_query; ?>
	<?php endif; ?>

	<?php wp_reset_postdata(); ?>
</section> <!-- .portfolio-pagination -->

<?php
get_footer();
