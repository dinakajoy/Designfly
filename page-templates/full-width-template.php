<?php
/**
 * Template Name: Full Width Template
 *
 * Used for showing full width template
 *
 * @package Designfly
 */

get_header();

?>

	<div class="container">
		<div class="main-content">
			<?php
			while ( have_posts() ) :
				the_post();
				?>

				<?php get_template_part( 'template-parts/content', 'page' ); ?>
				<?php
				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;

			endwhile; // End of the loop.
			?>
		</div><!-- .main-content -->
	</div><!-- .container -->

<?php
get_footer();
