<?php
/**
 * Designfly Popular Posts Widget.
 *
 * @package Designfly
 */

namespace DESIGNFLY\Inc;

use DESIGNFLY\Inc\Traits\Singleton;
use WP_Widget;
class Designfly_Popular_Posts_Widget extends WP_Widget {

	use Singleton;

	/**
	 * Construct method.
	 */
	public function __construct() {

		$widget_ops = array(
			'classname'   => 'designfly-popular-posts-widget',
			'description' => 'Popular Posts Widget',
		);
		parent::__construct( 'designfly_popular_posts', 'Designfly Popular Posts', $widget_ops ); // WPCS: XSS OK.

	}

	/**
	 * Back-end display of widget.
	 *
	 * @param array $instance Details of a post.
	 *
	 * @return void
	 */
	public function form( $instance ) {

		$title = ( ! empty( $instance['title'] ) ? $instance['title'] : 'Popular Posts' );
		$tot   = ( ! empty( $instance['tot'] ) ? absint( $instance['tot'] ) : absint( 5 ) );
		?>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>"><?php esc_html_e( 'Title:', 'designfly' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'title' ) ); ?>"
			       name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text"
				   value="<?php echo esc_attr( $title ); ?>" />
		</p>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_name( 'tot' ) ); ?>"><?php esc_html_e( 'Number of Posts:', 'designfly' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'tot' ) ); ?>"
			       name="<?php echo esc_attr( $this->get_field_name( 'tot' ) ); ?>" type="text"
				   value="<?php echo esc_attr( $tot ); ?>" />
		</p>
		<?php

	}

	/**
	 * Update widget.
	 *
	 * @param array $new_instance Details of post changed data.
	 * @param array $old_instance Original details of post data.
	 *
	 * @return $instance
	 */
	public function update( $new_instance, $old_instance ) {

		$instance          = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ? wp_strip_all_tags( $new_instance['title'] ) : '' );
		$instance['tot']   = ( ! empty( $new_instance['tot'] ) ? absint( wp_strip_all_tags( $new_instance['tot'] ) ) : 0 );

		return $instance;

	}

	/**
	 * Front-end display of widget
	 *
	 * @param array $args Default widget args.
	 * @param array $instance Details of post data.
	 *
	 * @return void
	 */
	public function widget( $args, $instance ) {

		$tot = absint( $instance['tot'] );

		$posts_args = array(
			'post_type'      => 'post',
			'posts_per_page' => $tot,
			'meta_key'       => 'designfly_post_views',
			'orderby'        => 'meta_value_num',
			'order'          => 'DESC',
		);

		$posts_query = new \WP_Query( $posts_args );

		echo $args['before_widget']; // WPCS: XSS OK.

		if ( ! empty( $instance['title'] ) ) :

			echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title']; // WPCS: XSS OK.

		endif;

		if ( $posts_query->have_posts() ) :

			while ( $posts_query->have_posts() ) :
				$posts_query->the_post();

				if ( has_post_thumbnail() ) {
					get_template_part( 'template-parts/content', 'widget' );
				}

			endwhile;

		endif;

		echo $args['after_widget']; // WPCS: XSS OK.

	}

}
