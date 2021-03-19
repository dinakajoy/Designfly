<?php
/**
 * Theme widgets.
 *
 * @package Designfly
 */

namespace DESIGNFLY\Inc;

use Designfly\Inc\Traits\Singleton;

/**
 * Class Assets
 */
class Widgets {

	use Singleton;

	/**
	 * Construct method.
	 */
	protected function __construct() {
		$this->setup_hooks();
	}

	/**
	 * To register action/filter.
	 *
	 * @return void
	 */
	protected function setup_hooks() {

		/**
		 * Actions
		 */
		add_action( 'widgets_init', array( $this, 'register_widgets' ) );
		add_action( 'widgets_init', [ $this, 'register_portfolio_widget' ] );
		add_action( 'widgets_init', [ $this, 'register_popular_posts_widget' ] );
		add_action( 'widgets_init', [ $this, 'register_recent_posts_widget' ] );

	}

	/**
	 * Register widgets.
	 *
	 * @action widgets_init
	 */
	public function register_widgets() {

		register_sidebar(
			array(
				'name'          => esc_html__( 'Sidebar', 'designfly' ),
				'id'            => 'sidebar-1',
				'description'   => '',
				'before_widget' => '<div id="%1$s" class="widget widget-sidebar %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<h4 class="widget-title">',
				'after_title'   => '</h4>',
			)
		);

		register_sidebar(
			array(
				'name'          => esc_html__( 'Footer', 'designfly' ),
				'id'            => 'sidebar-2',
				'description'   => '',
				'before_widget' => '<div id="%1$s" class="widget widget-footer cell column %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<h4 class="widget-title">',
				'after_title'   => '</h4>',
			)
		);

	}

	/**
	 * Register portfolio widget
	 */
	public function register_portfolio_widget() {
		register_widget( 'DESIGNFLY\Inc\Designfly_Portfolio_Widget' );
	}

	/**
	 * Register popular post widget
	 */
	public function register_popular_posts_widget() {
		register_widget( 'DESIGNFLY\Inc\Designfly_Popular_Posts_Widget' );
	}

	/**
	 * Register recent post widget
	 */
	public function register_recent_posts_widget() {
		register_widget( 'DESIGNFLY\Inc\Designfly_Recent_Posts_Widget' );
	}
}
