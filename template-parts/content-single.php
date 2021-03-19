<?php
/**
 * Template part for displaying single posts.
 *
 * @package Designfly
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="single-entry-header">
		<?php the_title( '<h1 class="single-entry-title">', '</h1>' ); ?>
		<div class="entry-content clearfix">
			<?php if ( 'post' === get_post_type() ) : ?>
				<div class="entry-meta">
					<span>
						<?php esc_html_e( 'by ', 'designfly' ); ?><a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" class="entry-meta__author"> <?php the_author(); ?> </a>
						<?php esc_html_e( 'on ', 'designfly' ); ?><a href="<?php echo esc_url( get_day_link( get_post_time( 'Y' ), get_post_time( 'm' ), get_post_time( 'j' ) ) ); ?>" class="entry-meta__date"><?php the_time( 'd M Y' ); ?></a>
					</span>
					<span>
						<?php
						$designfly_comments_number = get_comments_number();
						if ( $designfly_comments_number < 1 ) {
							?>
							<a href="<?php echo esc_url( get_comments_link() ); ?>"><?php esc_html_e( 'Leave a Comment', 'designfly' ); ?></a>
							<?php
						}
						if ( 1 === $designfly_comments_number ) {
							?>
							<a href="<?php echo esc_url( get_comments_link() ); ?>"><?php echo intval( $designfly_comments_number ); ?><?php esc_html_e( 'comments', 'designfly' ); ?></a>
							<?php
						}
						if ( $designfly_comments_number > 1 ) {
							?>
							<a href="<?php echo esc_url( get_comments_link() ); ?>"><?php echo intval( $designfly_comments_number ); ?><?php esc_html_e( 'comments', 'designfly' ); ?></a>
							<?php
						}
						?>
					</span>
				</div><!-- .entry-meta -->

			<?php endif; ?>
		</div><!-- .entry-content -->
	</header><!-- .entry-header -->

	<div class="single-entry-content clearfix">
		<?php the_content(); ?>
		<?php
		wp_link_pages(
			array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'designfly' ),
				'after'  => '</div>',
			)
		);
		?>
	</div><!-- ."single-entry-content -->
</article><!-- #post-## -->
