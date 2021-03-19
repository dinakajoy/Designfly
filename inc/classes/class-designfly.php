<?php
/**
 * Bootstraps the Theme.
 *
 * @package Designfly
 */

namespace DESIGNFLY\Inc;

use DESIGNFLY\Inc\Traits\Singleton;

/**
 * Main theme bootstrap file.
 */
class DESIGNFLY {

	use Singleton;

	/**
	 * Construct method.
	 */
	protected function __construct() {

		// Load classes.
		Assets::get_instance();
		Customizer::get_instance();
		Widgets::get_instance();

		$this->setup_hooks();

	}

	/**
	 * To setup action/filter.
	 *
	 * @return void
	 */
	protected function setup_hooks() {

		/**
		 * Filters
		 */
		add_filter( 'excerpt_more', array( $this, 'add_read_more_link' ) );
		add_filter( 'body_class', array( $this, 'filter_body_classes' ) );
		add_filter( 'excerpt_length', array( $this, 'set_excerpt_length' ) );

		/**
		 * Actions
		 */
		add_action( 'wp_head', array( $this, 'add_pingback_link' ) );
		add_action( 'after_setup_theme', array( $this, 'setup_theme' ) );
		add_action( 'init', array( $this, 'designfly_portfolio_init' ) );

	}

	/**
	 * Setup theme.
	 *
	 * @return void
	 */
	public function setup_theme() {

		load_theme_textdomain( 'designfly', DESIGNFLY_TEMP_DIR . '/languages' );

		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'title-tag' );
		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'customize-selective-refresh-widgets' );
		add_theme_support( 'jetpack-responsive-videos' );

		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
			)
		);

		add_theme_support(
			'post-formats',
			array(
				'aside',
				'image',
				'video',
				'quote',
				'link',
				'gallery',
				'status',
				'audio',
				'chat',
			)
		);

		add_theme_support(
			'custom-background',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		);

		add_theme_support(
			'custom-logo',
			array(
				'header-text' => array(
					'site-title',
					'site-description',
				),
			)
		);

		add_editor_style();

		// Gutenberg theme support.
		add_theme_support( 'wp-block-styles' );
		add_theme_support( 'align-wide' );

		register_nav_menus(
			array(
				'primary' => esc_html__( 'Primary Menu', 'designfly' ),
			)
		);

		if ( ! isset( $content_width ) ) {
			$content_width = 900;
		}
	}

	/**
	 * Add read more link
	 *
	 * @filter excerpt_more
	 *
	 * @return string
	 */
	public function add_read_more_link() {
		global $post;

		return sprintf( '<a class="moretag" href="%s">%s</a>', get_permalink( $post->ID ), esc_html__( 'Read More', 'designfly' ) );
	}

	/**
	 *
	 * Set Excerpts Length
	 */
	public function set_excerpt_length() {
		return 30;
	}

	/**
	 * Adds custom classes to the array of body classes.
	 *
	 * @param array $classes Classes for the body element.
	 *
	 * @filter body_class
	 *
	 * @return array
	 */
	public function filter_body_classes( $classes ) {

		if ( ! is_singular() ) {
			$classes[] = 'hfeed';
		}

		// Adds a class of no-sidebar when there is no sidebar present.
		if ( ! is_active_sidebar( 'sidebar-1' ) ) {
			$classes[] = 'no-sidebar';
		}

		return $classes;
	}

	/**
	 * Add a ping back url auto-discovery header for single posts, pages, or attachments.
	 *
	 * @action wp_head
	 *
	 * @return void
	 */
	public function add_pingback_link() {
		if ( is_singular() && pings_open() ) {
			printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
		}
	}

	/**
	 *
	 * Register a custom post type called "designfly_custom_portfolio".
	 **/
	public function designfly_portfolio_init() {
		$labels = array(
			'name'                  => __( 'Portfolio', 'designfly' ),
			'singular_name'         => __( 'Portfolio', 'designfly' ),
			'menu_name'             => __( 'Portfolio', 'designfly' ),
			'name_admin_bar'        => __( 'Portfolio', 'designfly' ),
			'add_new'               => __( 'Add New', 'designfly' ),
			'add_new_item'          => __( 'Add New Item', 'designfly' ),
			'new_item'              => __( 'New Item', 'designfly' ),
			'edit_item'             => __( 'Edit Item', 'designfly' ),
			'view_item'             => __( 'View Item', 'designfly' ),
			'all_items'             => __( 'All Items', 'designfly' ),
			'search_items'          => __( 'Search Items', 'designfly' ),
			'parent_item_colon'     => __( 'Parent Items:', 'designfly' ),
			'not_found'             => __( 'No Item Found.', 'designfly' ),
			'not_found_in_trash'    => __( 'No Item Found In Trash.', 'designfly' ),
			'featured_image'        => __( 'Portfolio Cover Image', 'designfly' ),
			'set_featured_image'    => __( 'Set Cover Image', 'designfly' ),
			'remove_featured_image' => __( 'Remove Cover Image', 'designfly' ),
			'use_featured_image'    => __( 'Use As Cover Image', 'designfly' ),
			'archives'              => __( 'Portfolio Archives', 'designfly' ),
			'insert_into_item'      => __( 'Insert Into Portfolio', 'designfly' ),
			'uploaded_to_this_item' => __( 'Uploaded To This Item', 'designfly' ),
			'filter_items_list'     => __( 'Filter Item List', 'designfly' ),
			'items_list_navigation' => __( 'Portfolio Item Navigation', 'designfly' ),
			'items_list'            => __( 'Items List', 'designfly' ),
		);

		$args = array(
			'labels'             => $labels,
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'query_var'          => true,
			'rewrite'            => array( 'slug' => 'portfolio' ),
			'capability_type'    => 'post',
			'has_archive'        => true,
			'hierarchical'       => false,
			'menu_position'      => 5,
			'menu_icon'          => 'dashicons-portfolio',
			'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'revision' ),
			'taxonomies'         => array( 'category', 'post_tag' ),
		);

		register_post_type( 'designfly_portfolio', $args );
	}

}
