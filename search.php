<?php
/**
 * The template for displaying search results pages.
 *
 * @package Designfly
 */

get_header();
?>

<div class="content container">
	<div class="main-content">

		<?php if ( have_posts() ) : ?>

			<header class="page-header">
				<h1 class="page-title">
					<?php
					/* translators: %s: search phrase */
					printf( esc_html__( 'Search Results for: %s', 'designfly' ), '<span>' . get_search_query() . '</span>' );
					?>
				</h1>
			</header><!-- .page-header -->

			<?php
			/* Start the Loop */
			while ( have_posts() ) :

				the_post();

				/**
				 * Run the loop for the search to output the results.
				 * If you want to overload this in a child theme then include a file
				 * called content-search.php and that will be used instead.
				 */
				get_template_part( 'template-parts/content', 'search' );

			endwhile;

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif;
		?>

		<nav class="wp-assignment-pagination clearfix">
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

	</div> <!-- main-content -->

	<div class="aside-content">
		<?php get_sidebar(); ?>
	</div> <!-- aside-content -->

</div><!-- .content -->

<?php
get_footer();
