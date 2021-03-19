<?php
/**
 * The template for displaying archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Designfly
 */

get_header();
?>

<div class="content container">
	<div class="main-content">
		<?php
		if ( have_posts() ) :
			?>
			<header class="page-header">
				<?php
				the_archive_title( '<h1 class="page-title">', '</h1>' );
				the_archive_description( '<div class="taxonomy-description">', '</div>' );
				?>
			</header><!-- .page-header -->

			<?php
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

			?>
		<?php else : ?>

			<?php get_template_part( 'template-parts/content', 'none' ); ?>

		<?php endif; ?>

		<nav class="designfly-pagination clearfix">
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
