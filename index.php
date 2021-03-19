<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Designfly
 */

get_header();
?>

<div class="content container">
	<div class="main-content">
		<h1 class="main-content__title"><?php esc_html_e( "Let's Blog", 'designfly' ); ?></h1>
		<?php
			if ( have_posts() ) :

				if ( is_home() && ! is_front_page() ) :
					?>
						<header>
							<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
						</header>

					<?php
				endif;

				/* Start the Loop */
				while ( have_posts() ) :

					the_post();

					/*
					* Include the Post-Format-specific template for the content.
					* If you want to override this in a child theme, then include a file
					* called content-___.php (where ___ is the Post Format name) and that will be used instead.
					*/
					get_template_part( 'template-parts/content', get_post_format() );

				endwhile;

			else :

				get_template_part( 'template-parts/content', 'none' );

			endif;
		?>
		<nav class="wp-assignment-pagination clearfix">
			<?php the_posts_pagination(
				array (
					'show_all'  => false,
					'end_size'  => 1,
					'mid_size'  => 1,
					'prev_text' => __( '<i class="fa fa-caret-left"></i>', 'designfly' ),
					'next_text' => __( '<i class="fa fa-caret-right"></i>', 'designfly' ),
				)
			); ?>
		</nav>

	</div> <!-- main-content -->

	<div class="aside-content">
		<?php get_sidebar(); ?>
	</div> <!-- aside-content -->

</div><!-- .content -->

<?php
get_footer();
