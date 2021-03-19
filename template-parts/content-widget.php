<?php
/**
 * Template part for displaying widget content
 *
 * @package Designfly
 */

?>

<div class="widget-media">
	<?php the_post_thumbnail(); ?>
	<div class="widget-media-body">
		<a href="<?php echo esc_url( get_the_permalink() ); ?>" title="<?php the_title(); ?>" class="widget-media-title"><?php the_title(); ?></a><br />
		<?php esc_html_e( 'by ', 'designfly' ); ?><a href="<?php esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" class="widget-media-author"><?php the_author(); ?></a>
		<?php esc_html_e( 'on ', 'designfly' ); ?><a href="<?php echo esc_url( get_day_link( get_post_time( 'Y' ), get_post_time( 'm' ), get_post_time( 'j' ) ) ); ?>"><?php the_time( 'd M Y' ); ?> </a>
	</div>
</div>
