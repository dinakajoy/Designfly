<?php
/**
 * Designfly Portfolio Widget.
 *
 * @package Designfly
 */

namespace DESIGNFLY\Inc;

use DESIGNFLY\Inc\Traits\Singleton;
use WP_Widget;

/**
 * Custom Portfolio Widget
 */
class Designfly_Portfolio_Widget extends WP_Widget {

	use Singleton;

	/**
	 * Construct method.
	 */
	public function __construct() {

		$widget_ops = array(
			'classname'   => 'designfly-portfolio-widget',
			'description' => 'Portfolio Widget',
		);
		parent::__construct( 'designfly_portfolio_widget', 'Designfly Portfolio', $widget_ops ); // WPCS: XSS OK.

	}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form().
	 *
	 * @param array $instance Previously saved values from database.
	 *
	 * * @return void
	 */
	public function form( $instance ) {

		$title = ( ! empty( $instance['title'] ) ? $instance['title'] :  esc_html__( 'Portfolio', 'designfly' ) );
		$tot   = ( ! empty( $instance['tot'] ) ? absint( $instance['tot'] ) : absint( 8 ) );
		?>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>"><?php esc_html_e( 'Title:', 'designfly' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'title' ) ); ?>"
			       name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text"
				   value="<?php echo esc_attr( $title ); ?>" />
		</p>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_name( 'tot' ) ); ?>"><?php esc_html_e( 'Number of Items:', 'designfly' ); ?></label>
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
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 *
	 * * @return void
	 */
	public function widget( $args, $instance ) {

		$posts_args = array(
			'post_type'      => 'designfly_portfolio',
			'posts_per_page' => 8,
		);
		$the_query  = new \WP_Query( $posts_args );

		$args['before_widget']; // WPCS: XSS OK.

		if ( ! empty( $instance['title'] ) ) :

			echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title']; // WPCS: XSS OK.

		endif;

		if ( $the_query->have_posts() ) {
			?>
			<div class="widget-portfolio">
				<?php
				while ( $the_query->have_posts() ) {

					$the_query->the_post();

					if ( has_post_thumbnail() ) {
						the_post_thumbnail();
					}

				}
				?>
			</div>
				<?php
		} else {
			?>
			<p><?php esc_html_e( 'Please add items to your portfolio', 'designfly' ); ?></p>
			<?php
		}

		echo $args['after_widget']; // WPCS: XSS OK.

	}

}
