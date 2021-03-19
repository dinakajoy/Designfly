<?php
/**
 * The template for displaying all single posts.
 *
 * @package Designfly
 */

get_header();
?>

<div class="content container">
	<div class="main-content">

		<?php
			while ( have_posts() ) :

				the_post();

				designfly_save_post_views( get_the_ID() );

				get_template_part( 'template-parts/content', 'single' );

				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;

			endwhile; // End of the loop.
		?>
	</div> <!-- main-content -->

	<div class="aside-content">
		<?php get_sidebar(); ?>
	</div> <!-- aside-content -->

</div><!-- content -->

<?php
get_footer();
