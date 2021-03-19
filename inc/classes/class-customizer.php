<?php
/**
 * Customizer.
 *
 * @package Designfly
 */

namespace Designfly\Inc;

use Designfly\Inc\Traits\Singleton;
use WP_Customize_Image_Control;

/**
 * Class Customizer
 */
class Customizer {

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
		add_action( 'customize_register', array( $this, 'customize_register' ) );
		add_action( 'customize_preview_init', array( $this, 'enqueue_customizer_scripts' ) );
		add_action( 'customize_register', array( $this, 'designfly_home_customize_register' ) );
		add_action( 'customize_register', array( $this, 'designfly_featured_content' ) );
		add_action( 'customize_register', array( $this, 'designfly_home_title_customize_register' ) );
		add_action( 'customize_register', array( $this, 'designfly_footer_customize_register' ) );

	}

	/**
	 * Customize register.
	 *
	 * @param \WP_Customize_Manager $wp_customize Theme Customizer object.
	 *
	 * @action customize_register
	 */
	public function customize_register( \WP_Customize_Manager $wp_customize ) {

		$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
		$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
		$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

		if ( isset( $wp_customize->selective_refresh ) ) {

			$wp_customize->selective_refresh->add_partial(
				'blogname',
				array(
					'selector'        => '.site-title a',
					'render_callback' => array( $this, 'customize_partial_blog_name' ),
				)
			);
			$wp_customize->selective_refresh->add_partial(
				'blogdescription',
				array(
					'selector'        => '.site-description',
					'render_callback' => array( $this, 'customize_partial_blog_description' ),
				)
			);

		}

	}

	/**
	 * Render the site title for the selective refresh partial.
	 *
	 * @return void
	 */
	public function customize_partial_blog_name() {
		bloginfo( 'name' );
	}

	/**
	 * Render the site tagline for the selective refresh partial.
	 *
	 * @return void
	 */
	public function customize_partial_blog_description() {
		bloginfo( 'description' );
	}

	/**
	 * Enqueue customizer scripts.
	 *
	 * @action customize_preview_init
	 */
	public function enqueue_customizer_scripts() {

		Assets::get_instance()->register_script( 'designfly-customizer', 'js/admin/customizer.js', array( 'customize-preview' ) );

		wp_enqueue_script( 'designfly-customizer' );
	}

	/**
	 * Customize register.
	 *
	 * @param \WP_Customize_Manager $wp_customize Theme Customizer object.
	 *
	 * @action designfly_home_customize_register
	 */
	public function designfly_home_customize_register( \WP_Customize_Manager $wp_customize ) {
		$wp_customize->add_section(
			'slider',
			array(
				'title'       => __( 'HomePage Slider', 'designfly' ),
				'description' => sprintf( 'Customize The HomePage Slider', 'designfly' ),
				'priority'    => 20,
			)
		);

		$wp_customize->add_setting(
			'slider-image',
			array(
				'default' => get_bloginfo( 'template_directory' ) . '/assets/build/img/slider-image.png',
				'type'    => 'theme_mod',
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Image_Control(
				$wp_customize,
				'showcase_image',
				array(
					'label'    => __( 'Slider Image1', 'designfly' ),
					'section'  => 'slider',
					'settings' => 'slider-image',
					'priority' => 1,
				)
			)
		);

		$wp_customize->add_setting(
			'slider-title',
			array(
				'default' => __( 'Gearing up the ideas', 'designfly' ),
				'type'    => 'theme_mod',
			)
		);
		$wp_customize->add_control(
			'slider-title',
			array(
				'label'    => __( 'Slider Title', 'designfly' ),
				'section'  => 'slider',
				'priority' => 2,
			)
		);

		$wp_customize->add_setting(
			'slider-description',
			array(
				'default' => __( 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'designfly' ),
				'type'    => 'theme_mod',
			)
		);
		$wp_customize->add_control(
			'slider-description',
			array(
				'label'    => __( 'Slider Description', 'designfly' ),
				'section'  => 'slider',
				'priority' => 3,
			)
		);
	}

	/**
	 * Customize register.
	 *
	 * @param \WP_Customize_Manager $wp_customize Theme Customizer object.
	 *
	 * @action designfly_home_customize_register
	 */
	public function designfly_featured_content( \WP_Customize_Manager $wp_customize ) {
		$wp_customize->add_section(
			'featured',
			array(
				'title'       => __( 'Feature Content', 'designfly' ),
				'description' => sprintf( 'Customize The Feature Content', 'designfly' ),
				'priority'    => 21,
			)
		);

		$wp_customize->add_setting(
			'feature1-title',
			array(
				'default' => __( 'Advertising', 'designfly' ),
				'type'    => 'theme_mod',
			)
		);
		$wp_customize->add_control(
			'feature1-title',
			array(
				'label'    => __( 'Feature1 Title', 'designfly' ),
				'section'  => 'featured',
				'priority' => 1,
			)
		);

		$wp_customize->add_setting(
			'feature1-description',
			array(
				'default' => __( 'Advertising is very very good. Advertising is very very good', 'designfly' ),
				'type'    => 'theme_mod',
			)
		);
		$wp_customize->add_control(
			'feature1-description',
			array(
				'label'    => __( 'Feature1 Description', 'designfly' ),
				'section'  => 'featured',
				'priority' => 1,
			)
		);

		$wp_customize->add_setting(
			'feature2-title',
			array(
				'default' => __( 'Multimedia', 'designfly' ),
				'type'    => 'theme_mod',
			)
		);
		$wp_customize->add_control(
			'feature2-title',
			array(
				'label'    => __( 'Feature2 Title', 'designfly' ),
				'section'  => 'featured',
				'priority' => 2,
			)
		);

		$wp_customize->add_setting(
			'feature2-description',
			array(
				'default' => __( 'Multimedia is very very good. Multimedia is very very good', 'designfly' ),
				'type'    => 'theme_mod',
			)
		);
		$wp_customize->add_control(
			'feature2-description',
			array(
				'label'    => __( 'Feature2 Description', 'designfly' ),
				'section'  => 'featured',
				'priority' => 2,
			)
		);

		$wp_customize->add_setting(
			'feature3-title',
			array(
				'default' => __( 'Photography', 'designfly' ),
				'type'    => 'theme_mod',
			)
		);
		$wp_customize->add_control(
			'feature3-title',
			array(
				'label'    => __( 'Feature3 Title', 'designfly' ),
				'section'  => 'featured',
				'priority' => 3,
			)
		);

		$wp_customize->add_setting(
			'feature3-description',
			array(
				'default' => __( 'Photography is very very good. Photography is very very good', 'designfly' ),
				'type'    => 'theme_mod',
			)
		);
		$wp_customize->add_control(
			'feature3-description',
			array(
				'label'    => __( 'Feature3 Description', 'designfly' ),
				'section'  => 'featured',
				'priority' => 3,
			)
		);
	}

	/**
	 * Customize register.
	 *
	 * @param \WP_Customize_Manager $wp_customize Theme Customizer object.
	 *
	 * @action designfly_home_title_customize_register
	 */
	public function designfly_home_title_customize_register( \WP_Customize_Manager $wp_customize ) {
		$wp_customize->add_section(
			'home-title',
			array(
				'title'       => __( 'Home Page Title', 'designfly' ),
				'description' => sprintf( 'Customize The Home Page Title', 'designfly' ),
				'priority'    => 22,
			)
		);

		$wp_customize->add_setting(
			'homepage-title',
			array(
				'default' => __( 'D\'SIGN IS THE SOUL', 'designfly' ),
				'type'    => 'theme_mod',
			)
		);
		$wp_customize->add_control(
			'homepage-title',
			array(
				'label'    => __( 'Home Page Title', 'designfly' ),
				'section'  => 'home-title',
				'priority' => 1,
			)
		);

		$wp_customize->add_setting(
			'homepage-cta-text',
			array(
				'default' => __( 'view all', 'designfly' ),
				'type'    => 'theme_mod',
			)
		);
		$wp_customize->add_control(
			'homepage-cta-text',
			array(
				'label'    => __( 'Home Page Call To Action Text', 'designfly' ),
				'section'  => 'home-title',
				'priority' => 2,
			)
		);

		$wp_customize->add_setting(
			'homepage-cta-url',
			array(
				'default' => __( '#', 'designfly' ),
				'type'    => 'theme_mod',
			)
		);
		$wp_customize->add_control(
			'homepage-cta-url',
			array(
				'label'    => __( 'Home Page Call To Action', 'designfly' ),
				'section'  => 'home-title',
				'priority' => 3,
			)
		);
	}

	/**
	 * Customize register.
	 *
	 * @param \WP_Customize_Manager $wp_customize Theme Customizer object.
	 *
	 * @action designfly_footer_customize_register
	 */
	public function designfly_footer_customize_register( \WP_Customize_Manager $wp_customize ) {
		$wp_customize->add_section(
			'footer-content',
			array(
				'title'       => __( 'Footer Content', 'designfly' ),
				'description' => sprintf( 'Customize The Footer Content', 'designfly' ),
				'priority'    => 23,
			)
		);

		$wp_customize->add_setting(
			'footer-left-title',
			array(
				'default' => __( 'Welcome To DesignFly', 'designfly' ),
				'type'    => 'theme_mod',
			)
		);
		$wp_customize->add_control(
			'footer-left-title',
			array(
				'label'    => __( 'Footer Left Title', 'designfly' ),
				'section'  => 'footer-content',
				'priority' => 1,
			)
		);

		$wp_customize->add_setting(
			'footer-left-description',
			array(
				'default' => __( 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation', 'designfly' ),
				'type'    => 'theme_mod',
			)
		);
		$wp_customize->add_control(
			'footer-left-description',
			array(
				'label'    => __( 'Footer Left Description', 'designfly' ),
				'section'  => 'footer-content',
				'priority' => 1,
			)
		);

		$wp_customize->add_setting(
			'footer-left-link',
			array(
				'default' => __( '#', 'designfly' ),
				'type'    => 'theme_mod',
			)
		);
		$wp_customize->add_control(
			'footer-left-link',
			array(
				'label'    => __( 'Footer Left Link', 'designfly' ),
				'section'  => 'footer-content',
				'priority' => 1,
			)
		);

		$wp_customize->add_setting(
			'footer-right-title',
			array(
				'default' => __( 'Contact Us', 'designfly' ),
				'type'    => 'theme_mod',
			)
		);
		$wp_customize->add_control(
			'footer-right-title',
			array(
				'label'    => __( 'Footer Right Title', 'designfly' ),
				'section'  => 'footer-content',
				'priority' => 2,
			)
		);

		$wp_customize->add_setting(
			'footer-right-address',
			array(
				'default' => __( 'Street 21 Planet, A-11, dapibus tristique, 123 551', 'designfly' ),
				'type'    => 'theme_mod',
			)
		);
		$wp_customize->add_control(
			'footer-right-address',
			array(
				'label'    => __( 'Address', 'designfly' ),
				'section'  => 'footer-content',
				'priority' => 2,
			)
		);

		$wp_customize->add_setting(
			'footer-right-tel',
			array(
				'default' => __( '123 4567890', 'designfly' ),
				'type'    => 'theme_mod',
			)
		);
		$wp_customize->add_control(
			'footer-right-tel',
			array(
				'label'    => __( 'Tel', 'designfly' ),
				'section'  => 'footer-content',
				'priority' => 2,
			)
		);

		$wp_customize->add_setting(
			'footer-right-fax',
			array(
				'default' => __( '123 456789', 'designfly' ),
				'type'    => 'theme_mod',
			)
		);
		$wp_customize->add_control(
			'footer-right-fax',
			array(
				'label'    => __( 'Fax', 'designfly' ),
				'section'  => 'footer-content',
				'priority' => 2,
			)
		);

		$wp_customize->add_setting(
			'footer-right-email',
			array(
				'default' => __( 'contactus@dsignfly.com', 'designfly' ),
				'type'    => 'theme_mod',
			)
		);
		$wp_customize->add_control(
			'footer-right-email',
			array(
				'label'    => __( 'Email', 'designfly' ),
				'section'  => 'footer-content',
				'priority' => 2,
			)
		);

		$wp_customize->add_setting(
			'footer-right-email',
			array(
				'default' => __( 'contactus@dsignfly.com', 'designfly' ),
				'type'    => 'theme_mod',
			)
		);
		$wp_customize->add_control(
			'footer-right-email',
			array(
				'label'    => __( 'Email', 'designfly' ),
				'section'  => 'footer-content',
				'priority' => 2,
			)
		);

		// FooterSocila Links.
		$wp_customize->add_setting(
			'footer-facebook-link',
			array(
				'default' => __( '#', 'designfly' ),
				'type'    => 'theme_mod',
			)
		);
		$wp_customize->add_control(
			'footer-facebook-link',
			array(
				'label'    => __( 'Footer Facebook Link', 'designfly' ),
				'section'  => 'footer-content',
				'priority' => 3,
			)
		);

		$wp_customize->add_setting(
			'footer-googleplus-link',
			array(
				'default' => __( '#', 'designfly' ),
				'type'    => 'theme_mod',
			)
		);
		$wp_customize->add_control(
			'footer-googleplus-link',
			array(
				'label'    => __( 'Footer Google Plus Link', 'designfly' ),
				'section'  => 'footer-content',
				'priority' => 3,
			)
		);

		$wp_customize->add_setting(
			'footer-linkedin-link',
			array(
				'default' => __( '#', 'designfly' ),
				'type'    => 'theme_mod',
			)
		);
		$wp_customize->add_control(
			'footer-linkedin-link',
			array(
				'label'    => __( 'Footer Linkedin Link', 'designfly' ),
				'section'  => 'footer-content',
				'priority' => 3,
			)
		);

		$wp_customize->add_setting(
			'footer-pinterest-link',
			array(
				'default' => __( '#', 'designfly' ),
				'type'    => 'theme_mod',
			)
		);
		$wp_customize->add_control(
			'footer-pinterest-link',
			array(
				'label'    => __( 'Footer Pinterest Link', 'designfly' ),
				'section'  => 'footer-content',
				'priority' => 3,
			)
		);

		$wp_customize->add_setting(
			'footer-twitter-link',
			array(
				'default' => __( '#', 'designfly' ),
				'type'    => 'theme_mod',
			)
		);
		$wp_customize->add_control(
			'footer-twitter-link',
			array(
				'label'    => __( 'Footer Twitter Link', 'designfly' ),
				'section'  => 'footer-content',
				'priority' => 3,
			)
		);
	}

}
