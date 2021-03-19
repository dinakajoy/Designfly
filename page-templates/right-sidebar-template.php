<?php
/**
 * Template Name: Right Sidebar Template
 *
 * Used for showing right sidebar template
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
			get_template_part( 'template-parts/content', get_post_format() );

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

</div><!-- .content -->

<?php
get_footer();
