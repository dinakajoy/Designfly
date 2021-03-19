<?php
/**
 * Template part for displaying posts.
 *
 * @package Designfly
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<div class="entry-date"><span><?php the_time( 'd' ); ?></span> <br /> <span><?php the_time( 'M' ); ?></span> </div>
		<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
	</header><!-- .entry-header -->

	<?php
	if ( has_post_thumbnail() ) {
		?>
		<div class="content__img">
			<?php
			if ( ! is_single() && ! is_page() ) {
				the_post_thumbnail();
			}
			?>
		</div>

		<div class="entry-content clearfix">
			<?php
	} else {
		?>
				<div class="entry-full-content clearfix">
					<?php
	}
	?>

			<?php if ( 'post' === get_post_type() ) : ?>

				<div class="entry-meta">
					<span>
						<?php esc_html_e( 'by ', 'designfly' ); ?> <a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" class="entry-meta__author"> <?php the_author(); ?> </a>
						<?php esc_html_e( 'on ', 'designfly' ); ?> <a href="<?php echo esc_url( get_day_link( get_post_time( 'Y' ), get_post_time( 'm' ), get_post_time( 'j' ) ) ); ?>" class="entry-meta__date"><?php the_time( 'd M Y' ); ?></a>
					</span>
					<span>
						<?php
						$designfly_comments_number = get_comments_number();
						if ( $designfly_comments_number < 1 ) {
							?>
							<a href="<?php echo esc_url( get_comments_link() ); ?>"><?php __( 'Leave a Comment', 'designfly' ); ?></a>
							<?php
						}
						if ( 1 === $designfly_comments_number ) {
							?>
							<a href="<?php echo esc_url( get_comments_link() ); ?>"><?php echo intval( $designfly_comments_number ); ?><?php __( ' comments', 'designfly' ); ?></a>
							<?php
						}
						if ( $designfly_comments_number > 1 ) {
							?>
							<a href="<?php echo esc_url( get_comments_link() ); ?>"><?php echo intval( $designfly_comments_number ); ?><?php __( ' comments', 'designfly' ); ?> </a>
							<?php
						}
						?>
					</span>
				</div><!-- .entry-meta -->

			<?php endif; ?>
			<?php
			the_excerpt(
				sprintf(
					wp_kses(
						/* translators: %s: Name of current post. */
						__( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'designfly' ),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					the_title( '<span class="screen-reader-text">"', '"</span>', false )
				)
			);
			?>

		<?php
		wp_link_pages(
			array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'designfly' ),
				'after'  => '</div>',
			)
		);
		?>
	</div><!-- .entry-content -->
	<div class="clr"></div>
</article><!-- #post-## -->
