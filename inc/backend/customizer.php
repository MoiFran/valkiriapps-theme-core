<?php
/**
 * Theme customizer
 *
 * @package Valkiriapps
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Valkiriapps_Customize {
	/**
	 * Customize settings
	 *
	 * @var array
	 */
	protected $config = array();

	/**
	 * The class constructor
	 *
	 * @param array $config
	 */
	public function __construct( $config ) {
		$this->config = $config;

		if ( ! class_exists( 'Kirki' ) ) {
			return;
		}

		$this->register();
	}

	/**
	 * Register settings
	 */
	public function register() {

		/**
		 * Add the theme configuration
		 */
		if ( ! empty( $this->config['theme'] ) ) {
			Kirki::add_config(
				$this->config['theme'], array(
					'capability'  => 'edit_theme_options',
					'option_type' => 'theme_mod',
				)
			);
		}

		/**
		 * Add panels
		 */
		if ( ! empty( $this->config['panels'] ) ) {
			foreach ( $this->config['panels'] as $panel => $settings ) {
				Kirki::add_panel( $panel, $settings );
			}
		}

		/**
		 * Add sections
		 */
		if ( ! empty( $this->config['sections'] ) ) {
			foreach ( $this->config['sections'] as $section => $settings ) {
				Kirki::add_section( $section, $settings );
			}
		}

		/**
		 * Add fields
		 */
		if ( ! empty( $this->config['theme'] ) && ! empty( $this->config['fields'] ) ) {
			foreach ( $this->config['fields'] as $name => $settings ) {
				if ( ! isset( $settings['settings'] ) ) {
					$settings['settings'] = $name;
				}

				Kirki::add_field( $this->config['theme'], $settings );
			}
		}
	}

	/**
	 * Get config ID
	 *
	 * @return string
	 */
	public function get_theme() {
		return $this->config['theme'];
	}

	/**
	 * Get customize setting value
	 *
	 * @param string $name
	 *
	 * @return bool|string
	 */
	public function get_option( $name ) {

		$default = $this->get_option_default( $name );

		return get_theme_mod( $name, $default );
	}

	/**
	 * Get default option values
	 *
	 * @param $name
	 *
	 * @return mixed
	 */
	public function get_option_default( $name ) {
		if ( ! isset( $this->config['fields'][ $name ] ) ) {
			return false;
		}

		return isset( $this->config['fields'][ $name ]['default'] ) ? $this->config['fields'][ $name ]['default'] : false;
	}
}

/**
 * This is a short hand function for getting setting value from customizer
 *
 * @param string $name
 *
 * @return bool|string
 */
function valkiriapps_get_option( $name ) {
	global $valkiriapps_customize;

	$value = false;

	if ( class_exists( 'Kirki' ) ) {
		$value = Kirki::get_option( 'valkiriapps', $name );
	} elseif ( ! empty( $valkiriapps_customize ) ) {
		$value = $valkiriapps_customize->get_option( $name );
	}

	return apply_filters( 'valkiriapps_get_option', $value, $name );
}

/**
 * Get default option values
 *
 * @param $name
 *
 * @return mixed
 */
function valkiriapps_get_option_default( $name ) {
	global $valkiriapps_customize;

	if ( empty( $valkiriapps_customize ) ) {
		return false;
	}

	return $valkiriapps_customize->get_option_default( $name );
}

/**
 * Move some default sections to `general` panel that registered by theme
 *
 * @param object $wp_customize
 */
function valkiriapps_customize_modify( $wp_customize ) {
	$wp_customize->get_section( 'title_tagline' )->panel     = 'general';
	$wp_customize->get_section( 'static_front_page' )->panel = 'general';
}

add_action( 'customize_register', 'valkiriapps_customize_modify' );


/**
 * Get customize settings
 *
 * Priority (Order) WordPress Live Customizer default: 
 * @link https://developer.wordpress.org/themes/customize-api/customizer-objects/
 *
 * @return array
 */
function valkiriapps_customize_settings() {
	/**
	 * Customizer configuration
	 */

	$settings = array(
		'theme' => 'valkiriapps',
	);

	$panels = array(
		'general'     => array(
			'priority' => 5,
			'title'    => esc_html__( 'General', 'valkiriapps' ),
		),
		'header'        => array(
			'title'      => esc_html__( 'Header', 'valkiriapps' ),
			'priority'   => 9,
			'capability' => 'edit_theme_options',
		),
        'blog'        => array(
			'title'      => esc_html__( 'Blog', 'valkiriapps' ),
			'priority'   => 10,
			'capability' => 'edit_theme_options',
		),
		'portfolio'           => array(
			'title'       => esc_html__( 'Portfolio', 'valkiriapps' ),
			'priority'    => 10,
			'capability'  => 'edit_theme_options',			
		),
	);

	$sections = array(
		//Header
		'builder_header'        => array(
            'title'       => esc_html__( 'Header Builder', 'valkiriapps' ),
            'description' => '',
            'priority'    => 14,
            'capability'  => 'edit_theme_options',
            'panel'       => 'header',
        ),
		'main_header'           => array(
            'title'       => esc_html__( 'General', 'valkiriapps' ),
            'description' => '',
            'priority'    => 15,
            'capability'  => 'edit_theme_options',
            'panel'       => 'header',
        ),
		'topbar_header'           => array(
			'title'       => esc_html__( 'Top Bar', 'valkiriapps' ),
			'description' => '',
			'priority'    => 16,
			'capability'  => 'edit_theme_options',
			'panel'       => 'header',
		),
        'logo_header'           => array(
            'title'       => esc_html__( 'Logo', 'valkiriapps' ),
            'description' => '',
            'priority'    => 17,
            'capability'  => 'edit_theme_options',
            'panel'       => 'header',
        ),
        'menu_header'           => array(
            'title'       => esc_html__( 'Menu', 'valkiriapps' ),
            'description' => '',
            'priority'    => 18,
            'capability'  => 'edit_theme_options',
            'panel'       => 'header',
        ),
        'cta_header'           => array(
            'title'       => esc_html__( 'Call To Action', 'valkiriapps' ),
            'description' => '',
            'priority'    => 19,
            'capability'  => 'edit_theme_options',
            'panel'       => 'header',
        ),
	    'header_styling'           => array(
			'title'       => esc_html__( 'Styling', 'valkiriapps' ),
			'description' => '',
			'priority'    => 19,
			'capability'  => 'edit_theme_options',
			'panel'       => 'header',
        ),
        'menu_mobile'           => array(
            'title'       => esc_html__( 'Mobile Menu', 'valkiriapps' ),
            'description' => '',
            'priority'    => 21,
            'capability'  => 'edit_theme_options',
            'panel'       => 'header',
        ),
		//Page Header
		'page_header'     => array(
            'title'       => esc_html__( 'Page Header', 'valkiriapps' ),
            'description' => '',
            'priority'    => 9,
            'capability'  => 'edit_theme_options',
        ),
		//Blog
		'blog_page'           => array(
			'title'       => esc_html__( 'Blog Page', 'valkiriapps' ),
			'description' => '',
			'priority'    => 10,
			'capability'  => 'edit_theme_options',
			'panel'       => 'blog',
		),
        'single_post'           => array(
			'title'       => esc_html__( 'Single Post', 'valkiriapps' ),
			'description' => '',
			'priority'    => 10,
			'capability'  => 'edit_theme_options',
			'panel'       => 'blog',
		),
		//Project
		'portfolio_page'           => array(
			'title'       => esc_html__( 'Archive Page', 'valkiriapps' ),
			'priority'    => 10,
			'capability'  => 'edit_theme_options',
			'panel'       => 'portfolio',			
		),
		'portfolio_post'           => array(
			'title'       => esc_html__( 'Single Page', 'valkiriapps' ),
			'priority'    => 10,
			'capability'  => 'edit_theme_options',
			'panel'       => 'portfolio',			
		),
		//Footer
		'footer'         => array(
			'title'      => esc_html__( 'Footer', 'valkiriapps' ),
			'priority'   => 10,
			'capability' => 'edit_theme_options',
		),
		//Custom 404
		'error_404'       => array(
            'title'       => esc_html__( '404', 'valkiriapps' ),
            'description' => '',
            'priority'    => 11,
            'capability'  => 'edit_theme_options',
        ),
		//Typography
		'typography'           => array(
            'title'       => esc_html__( 'Typography', 'valkiriapps' ),
            'description' => '',
            'priority'    => 15,
            'capability'  => 'edit_theme_options',
        ),
		//Preloader
        'preload_section'     => array(
			'title'       => esc_attr__( 'Preloader', 'valkiriapps' ),
			'description' => '',
			'priority'    => 22,
			'capability'  => 'edit_theme_options',
		),
		//Color Scheme
		'color_scheme'   => array(
			'title'      => esc_html__( 'Color Scheme', 'valkiriapps' ),
			'priority'   => 200,
			'capability' => 'edit_theme_options',
		),
		//GG Analytics
		'script_code'   => array(
			'title'      => esc_html__( 'Google Analytics(Script Code)', 'valkiriapps' ),
			'priority'   => 210,
			'capability' => 'edit_theme_options',
		),
	);

	$fields = array(
		/* header settings */
		'header_select'   => array(
			'type'        => 'select',  
	 		'label'       => esc_attr__( 'Select Header Desktop', 'valkiriapps' ), 
	 		'description' => esc_attr__( 'Choose the header on desktop.', 'valkiriapps' ), 
	 		'section'     => 'builder_header', 
	 		'default'     => '', 
	 		'priority'    => 3,
	 		'placeholder' => esc_attr__( 'Select a header', 'valkiriapps' ), 
	 		'choices'     => ( class_exists( 'Kirki_Helper' ) ) ? Kirki_Helper::get_posts( array( 'post_type' => 'ot_header_builders', 'posts_per_page' => -1 ) ) : array(),
		),
		'header_fixed'    => array(
            'type'        => 'toggle',
			'label'       => esc_html__( 'Header Transparent?', 'valkiriapps' ),
	 		'description' => esc_attr__( 'Enable when your header is transparent.', 'valkiriapps' ), 
            'section'     => 'builder_header',
			'default'     => '0',
			'priority'    => 4,
        ),
        'header_mobile'   => array(
			'type'        => 'select',  
	 		'label'       => esc_attr__( 'Select Header Mobile', 'valkiriapps' ), 
	 		'description' => esc_attr__( 'Choose the header on mobile.', 'valkiriapps' ), 
	 		'section'     => 'builder_header', 
	 		'default'     => '', 
	 		'priority'    => 5,
	 		'placeholder' => esc_attr__( 'Select a header', 'valkiriapps' ), 
	 		'choices'     => ( class_exists( 'Kirki_Helper' ) ) ? Kirki_Helper::get_posts( array( 'post_type' => 'ot_header_builders', 'posts_per_page' => -1 ) ) : array(),
        ),
        'is_sidepanel'    => array(
            'type'        => 'toggle',
			'label'       => esc_html__( 'Side Panel for all site?', 'valkiriapps' ),
			'section'     => 'builder_header',
			'default'     => '1',
			'priority'    => 6,
        ), 
        'sidepanel_layout'     => array(
			'type'        => 'select',  
	 		'label'       => esc_attr__( 'Select Side Panel', 'valkiriapps' ), 
	 		'description' => esc_attr__( 'Choose the side panel on header.', 'valkiriapps' ), 
	 		'section'     => 'builder_header', 
	 		'default'     => '', 
	 		'priority'    => 6,
	 		'placeholder' => esc_attr__( 'Select a panel', 'valkiriapps' ), 
	 		'choices'     => ( class_exists( 'Kirki_Helper' ) ) ? Kirki_Helper::get_posts( array( 'post_type' => 'ot_header_builders', 'posts_per_page' => -1 ) ) : array(),
	 		'active_callback' => array(
				array(
					'setting'  => 'is_sidepanel',
					'operator' => '!=',
					'value'    => '',
				),
			),
		),
		'panel_left'     => array(
            'type'        => 'toggle',
			'label'       => esc_html__( 'Side Panel On Left', 'valkiriapps' ),
            'section'     => 'builder_header',
			'default'     => '0',
			'priority'    => 7,
			'active_callback' => array(
				array(
					'setting'  => 'is_sidepanel',
					'operator' => '!=',
					'value'    => '',
				),
				array(
					'setting'  => 'sidepanel_layout',
					'operator' => '!=',
					'value'    => '',
				),
			),
        ),

        /* Main Header */
		'header_layout'    => array(
            'type'        => 'radio-image',
            'label'       => esc_attr__( 'Header Layout', 'valkiriapps' ),
            'section'     => 'main_header',
            'default'     => 'header1',
            'priority'    => 1,
            'multiple'    => 1,
            'choices'     => array(
                'header1' => get_template_directory_uri() . '/inc/backend/images/header1.jpg',
                'header2' => get_template_directory_uri() . '/inc/backend/images/header2.jpg',
                'header3' => get_template_directory_uri() . '/inc/backend/images/header3.jpg',
            ),
            'active_callback' => array(
				array(
					'setting'  => 'header_select',
					'operator' => '==',
					'value'    => '',
				),
			), 
        ),
        'header_homepage'    => array(
            'type'        => 'toggle',
			'label'       => esc_html__( 'Header Transparent for Homepage?', 'valkiriapps' ),
			'section'     => 'main_header',
			'default'     => '0',
			'priority'    => 2,
			'active_callback' => array(
				array(
					'setting'  => 'header_select',
					'operator' => '==',
					'value'    => '',
				),
			),
        ), 
        'header_width'    => array(
            'type'        => 'toggle',
			'label'       => esc_html__( 'Header Width: Wide/Boxes', 'valkiriapps' ),
			'section'     => 'main_header',
			'default'     => '1',
            'priority'    => 2,
            'active_callback' => array(
            	array(
					'setting'  => 'header_select',
					'operator' => '==',
					'value'    => '',
				),
				array(
					'setting'  => 'header_layout',
					'operator' => '==',
					'value'    => 'header2',
				),
			), 
        ),    
        'header_spacing' => array(
            'type'     => 'dimensions',
            'label'    => esc_html__( 'Header Padding (ex: 10px)', 'valkiriapps' ),
            'section'  => 'main_header',
            'priority' => 3,
            'default'  => array(
                'padding-left'   => '',
				'padding-right'  => '',
            ),
            'choices'     => array(
				'labels'  => array(
					'padding-left'  => esc_html__( 'Padding Left', 'valkiriapps' ),
					'padding-right' => esc_html__( 'Padding Right', 'valkiriapps' ),
				),
			),           
			'active_callback' => array(
				array(
					'setting'  => 'header_select',
					'operator' => '==',
					'value'    => '',
				),
                array(
					'setting'  => 'header_layout',
					'operator' => '==',
					'value'    => 'header2',
				),
				array(
					'setting'  => 'header_width',
					'operator' => '==',
					'value'    => '1',
				),
			), 
			'output'    => array(
                array(
                    'element'  => '.header-fullwidth .octf-area-wrap'
                ),
            ),
        ),
        'header_desktop_sticky'        => array(
            'type'     => 'toggle',
            'label'    => esc_html__( 'Sticky Header', 'valkiriapps' ),
            'section'  => 'main_header',
            'default'  => '1',
            'priority' => 4,
            'active_callback' => array(
				array(
					'setting'  => 'header_select',
					'operator' => '==',
					'value'    => '',
				),
			),
        ), 
         
        /* Header TopBar */
		'topbar_switch'     => array(
			'type'        => 'toggle',
			'label'       => esc_attr__( 'Top Bar On/Off', 'valkiriapps' ),
			'section'     => 'topbar_header',
			'default'     => 1,
			'priority'    => 1,
			'active_callback' => array(
				array(
					'setting'  => 'header_select',
					'operator' => '==',
					'value'    => '',
				),
			),
		),
		'topbar_mobile'     => array(
			'type'        => 'toggle',
			'label'       => esc_attr__( 'Top Bar Mobile On/Off', 'valkiriapps' ),
			'section'     => 'topbar_header',
			'default'     => 0,
			'priority'    => 1,
			'active_callback' => array(
				array(
					'setting'  => 'header_select',
					'operator' => '==',
					'value'    => '',
				),
			),
        ),
        'topbar_layout'    => array(
            'type'        => 'select',
			'label'       => esc_html__( 'Top Bar Style', 'valkiriapps' ),
			'section'     => 'topbar_header',
			'default'     => 'style1',
			'priority'    => 1,
			'choices'     => array(
				'style1' => esc_attr__( 'Contacts - Socials', 'valkiriapps' ),
				'style2' => esc_attr__( 'Socials - Contacts', 'valkiriapps' ),
			),
			'active_callback' => array(
				array(
					'setting'  => 'header_select',
					'operator' => '==',
					'value'    => '',
				),
			),
        ),

		// Contact Info
		'info_separator'     => array(
			'type'        => 'custom',
			'label'       => '',
			'section'     => 'topbar_header',
			'default'     => '<hr>',
			'priority'    => 2,
			'active_callback' => array(
				array(
					'setting'  => 'header_select',
					'operator' => '==',
					'value'    => '',
				),
			),
		),
		'info_switch'     => array(
			'type'        => 'toggle',
			'label'       => esc_attr__( 'Contact Info On/Off', 'valkiriapps' ),
			'section'     => 'topbar_header',
			'default'     => 1,
			'priority'    => 3,
			'active_callback' => array(
				array(
					'setting'  => 'header_select',
					'operator' => '==',
					'value'    => '',
				),
			),
		),
		'header_contact_info'     => array(
			'type'     => 'repeater',
			'label'    => esc_html__( 'Contact Info', 'valkiriapps' ),
			'section'  => 'topbar_header',
			'priority' => 4,
			'active_callback' => array(
				array(
					'setting'  => 'header_select',
					'operator' => '==',
					'value'    => '',
				),
				array(
					'setting'  => 'info_switch',
					'operator' => '==',
					'value'    => 1,
				),
			),
			'row_label' => array(
				'type' => 'field',
				'value' => esc_attr__('Contact Info', 'valkiriapps' ),
				'field' => 'info_name',
			),
			'default'  => array(),
			'fields'   => array(
				'info_name' => array(
					'type'        => 'text',
					'label'       => esc_html__( 'Contact info name', 'valkiriapps' ),
					'description' => esc_html__( 'This will be the contact info name', 'valkiriapps' ),
					'default'     => '',
				),
				'info_icon' => array(
					'type'        => 'text',
					'label'       => esc_html__( 'Icon class name', 'valkiriapps' ),
					'description' => esc_html__( 'This will be the contact info icon: https://fontawesome.com/icons?d=gallery , ex: fas fa-phone', 'valkiriapps' ),
					'default'     => '',
				),
				'info_content' => array(
					'type'        => 'textarea',
					'label'       => esc_html__( 'Contact info content', 'valkiriapps' ),
					'description' => esc_html__( 'This will be the contact info content', 'valkiriapps' ),
					'default'     => '',
				),				
			),
		),

		//Social
		'social_separator'     => array(
			'type'        => 'custom',
			'label'       => '',
			'section'     => 'topbar_header',
			'default'     => '<hr>',
			'priority'    => 5,
			'active_callback' => array(
				array(
					'setting'  => 'header_select',
					'operator' => '==',
					'value'    => '',
				),
			),
		),
		'social_switch'     => array(
			'type'        => 'toggle',
			'label'       => esc_attr__( 'Social Network On/Off', 'valkiriapps' ),
			'section'     => 'topbar_header',
			'default'     => 1,
			'priority'    => 6,
			'active_callback' => array(
				array(
					'setting'  => 'header_select',
					'operator' => '==',
					'value'    => '',
				),
			),
		),
		'header_socials'     => array(
			'type'     => 'repeater',
			'label'    => esc_html__( 'Socials Network', 'valkiriapps' ),
			'section'  => 'topbar_header',
			'priority' => 7,
			'active_callback' => array(
				array(
					'setting'  => 'header_select',
					'operator' => '==',
					'value'    => '',
				),
				array(
					'setting'  => 'social_switch',
					'operator' => '==',
					'value'    => 1,
				),
			),
			'row_label' => array(
				'type' => 'field',
				'value' => esc_attr__('social', 'valkiriapps' ),
				'field' => 'social_name',
			),
			'default'  => array(),
			'fields'   => array(
				'social_name' => array(
					'type'        => 'text',
					'label'       => esc_html__( 'Social network name', 'valkiriapps' ),
					'description' => esc_html__( 'This will be the social network name', 'valkiriapps' ),
					'default'     => '',
				),
				'social_icon' => array(
					'type'        => 'text',
					'label'       => esc_html__( 'Icon class name', 'valkiriapps' ),
					'description' => esc_html__( 'This will be the social icon: https://fontawesome.com/icons?d=gallery , ex: fab fa-facebook', 'valkiriapps' ),
					'default'     => '',
				),
				'social_link' => array(
					'type'        => 'text',
					'label'       => esc_html__( 'Link url', 'valkiriapps' ),
					'description' => esc_html__( 'This will be the social link', 'valkiriapps' ),
					'default'     => '',
				),
			),
		),
		'social_target_link'    => array(
			'type'        => 'select',
			'label'       => esc_attr__( 'HTML a target Attribute for Socials.', 'valkiriapps' ),
			'section'     => 'topbar_header',
			'default'     => '_self',
			'priority'    => 8,
			'multiple'    => 1,
			'active_callback' => array(
				array(
					'setting'  => 'header_select',
					'operator' => '==',
					'value'    => '',
				),
				array(
					'setting'  => 'social_switch',
					'operator' => '==',
					'value'    => 1,
				),
			),
			'choices'     => array(
				'_self' => esc_attr__( 'Same Frame', 'valkiriapps' ),
				'_blank' => esc_attr__( 'New Window', 'valkiriapps' ),
			),
        ),

        //More Text
        'extra_separator'     => array(
			'type'        => 'custom',
			'label'       => '',
			'section'     => 'topbar_header',
			'default'     => '<hr>',
			'priority'    => 9,
			'active_callback' => array(
				array(
					'setting'  => 'header_select',
					'operator' => '==',
					'value'    => '',
				),
			),
		),
        'extra_topbar'    => array(
            'type'     => 'textarea',
            'label'    => esc_html__( 'Extra Text', 'valkiriapps' ),
            'section'  => 'topbar_header',
            'default'  => '',
            'priority' => 9,
            'active_callback' => array(
				array(
					'setting'  => 'header_select',
					'operator' => '==',
					'value'    => '',
				),
			),
        ),
        
		/* Call To Action Header */
        'search_switch'     => array(
            'type'        => 'toggle',
            'label'       => esc_attr__( 'Search Button On/Off', 'valkiriapps' ),
            'section'     => 'cta_header',
            'default'     => 0,
            'priority'    => 1,
            'active_callback' => array(
				array(
					'setting'  => 'header_select',
					'operator' => '==',
					'value'    => '',
				),
			),
        ),     
        'cart_switch'     => array(
            'type'        => 'toggle',
            'label'       => esc_attr__( 'Cart Button On/Off', 'valkiriapps' ),
            'section'     => 'cta_header',
            'default'     => 0,
            'priority'    => 2,
            'active_callback' => array(
				array(
					'setting'  => 'header_select',
					'operator' => '==',
					'value'    => '',
				),
			),
        ),    
        'header_cta_switch'     => array(
            'type'        => 'toggle',
            'label'       => esc_attr__( 'Call To Action Button On/Off', 'valkiriapps' ),
            'section'     => 'cta_header',
            'default'     => 0,
            'priority'    => 4,
            'active_callback' => array(
				array(
					'setting'  => 'header_select',
					'operator' => '==',
					'value'    => '',
				),
			),
        ),
        'contact_switch'     => array(
            'type'        => 'toggle',
            'label'       => esc_attr__( 'Contact Info On/Off', 'valkiriapps' ),
            'section'     => 'cta_header',
            'default'     => 0,
            'priority'    => 4,
            'active_callback' => array(
				array(
					'setting'  => 'header_select',
					'operator' => '==',
					'value'    => '',
				),
			),
        ),  
        'separator_ctahead'     => array(
            'type'        => 'custom',
            'label'       => '',
            'section'     => 'cta_header',
            'default'     => '<hr>',
            'priority'    => 4,
            'active_callback' => array(
				array(
					'setting'  => 'header_select',
					'operator' => '==',
					'value'    => '',
				),
			),
        ), 
        'cta_text_header'    => array(
            'type'     => 'text',
            'label'    => esc_html__( 'CTA Button Text', 'valkiriapps' ),
            'section'  => 'cta_header',
            'default'  => '',
            'priority' => 5,            
            'active_callback' => array(
            	array(
					'setting'  => 'header_select',
					'operator' => '==',
					'value'    => '',
				),
				array(
					'setting'  => 'header_cta_switch',
					'operator' => '==',
					'value'    => 1,
				),
			),
        ),
        'cta_link_header'    => array(
            'type'     => 'link',
            'label'    => esc_html__( 'CTA Button Link', 'valkiriapps' ),
            'section'  => 'cta_header',
            'default'  => '',
            'priority' => 6,            
            'active_callback' => array(
            	array(
					'setting'  => 'header_select',
					'operator' => '==',
					'value'    => '',
				),
				array(
					'setting'  => 'header_cta_switch',
					'operator' => '==',
					'value'    => 1,
				),
			),
        ),
        'separator2_ctahead'     => array(
            'type'        => 'custom',
            'label'       => '',
            'section'     => 'cta_header',
            'default'     => '<hr>',
            'priority'    => 7,
            'active_callback' => array(
            	array(
					'setting'  => 'header_select',
					'operator' => '==',
					'value'    => '',
				),
				array(
					'setting'  => 'contact_switch',
					'operator' => '==',
					'value'    => 1,
				),
			),
        ), 
        'contact_icon' => array(
            'type'        => 'text',
            'label'       => esc_html__( 'Contact Icon', 'valkiriapps' ),
            'section'     => 'cta_header',
            'description' => esc_html__( 'This will be the social icon: https://fontawesome.com/icons?d=gallery , ex: fas fa-phone', 'valkiriapps' ),
            'default'     => 'fas fa-phone',
            'priority'    => 7,   
            'active_callback' => array(
            	array(
					'setting'  => 'header_select',
					'operator' => '==',
					'value'    => '',
				),
				array(
					'setting'  => 'contact_switch',
					'operator' => '==',
					'value'    => 1,
				),
			),
        ),
        'contact_text'    => array(
            'type'     => 'textarea',
            'label'    => esc_html__( 'Contact Text', 'valkiriapps' ),
            'section'  => 'cta_header',
            'default'  => '',
            'priority' => 7,            
            'active_callback' => array(
            	array(
					'setting'  => 'header_select',
					'operator' => '==',
					'value'    => '',
				),
				array(
					'setting'  => 'contact_switch',
					'operator' => '==',
					'value'    => 1,
				),
			),
        ),
        'contact_num'    => array(
            'type'     => 'textarea',
            'label'    => esc_html__( 'Contact Info', 'valkiriapps' ),
            'section'  => 'cta_header',
            'default'  => '',
            'priority' => 7,            
            'active_callback' => array(
            	array(
					'setting'  => 'header_select',
					'operator' => '==',
					'value'    => '',
				),
				array(
					'setting'  => 'contact_switch',
					'operator' => '==',
					'value'    => 1,
				),
			),
        ),

		/* Header Logos Setting */
		'logo'         => array(
			'type'     => 'image',
			'label'    => esc_attr__( 'Upload Your Static Logo Image on Header Static (.jpg, .png, .svg)', 'valkiriapps' ),
			'section'  => 'logo_header',
			'default'  => trailingslashit( get_template_directory_uri() ) . 'images/logo.svg',
			'priority' => 2,
			'active_callback' => array(
				array(
					'setting'  => 'header_select',
					'operator' => '==',
					'value'    => '',
				),
			),
		),
		'logo_scroll'  => array(
			'type'     => 'image',
			'label'    => esc_attr__( 'Upload Your Logo Image on Header Scroll (.jpg, .png, .svg)', 'valkiriapps' ),
			'section'  => 'logo_header',
			'default'  => trailingslashit( get_template_directory_uri() ) . 'images/logo-light.svg',
			'priority' => 3,
			'active_callback' => array(
				array(
					'setting'  => 'header_select',
					'operator' => '==',
					'value'    => '',
				),
			),
		),
        'logo_width'   => array(
            'type'     => 'number',
            'label'    => esc_html__( 'Logo Width(px)', 'valkiriapps' ),
            'section'  => 'logo_header',
            'priority' => 4,
            'default'  => 145,
            'output'    => array(
                array(
                    'element'  => '#site-logo a img',
                    'property' => 'width',
                    'units'	   => 'px'
                ),
            ),
            'active_callback' => array(
				array(
					'setting'  => 'header_select',
					'operator' => '==',
					'value'    => '',
				),
			),
        ),
        'logo_height'  => array(
            'type'     => 'number',
            'label'    => esc_html__( 'Logo Height(px)', 'valkiriapps' ),
            'section'  => 'logo_header',
            'priority' => 5,
            'default'  => '',
            'output'    => array(
                array(
                    'element'  => '#site-logo a img',
                    'property' => 'height',
                    'units'	   => 'px'
                ),
            ),
            'active_callback' => array(
				array(
					'setting'  => 'header_select',
					'operator' => '==',
					'value'    => '',
				),
			),
        ),
        'logo_spacing' => array(
            'type'     => 'dimensions',
            'label'    => esc_html__( 'Logo Margin (ex: 10px)', 'valkiriapps' ),
            'section'  => 'logo_header',
            'priority' => 6,
            'default'  => array(
                'top'    => '30px',
                'bottom' => '30px',
                'left'   => '0',
                'right'  => '0',
            ),
            'output'    => array(
                array(
                    'element'  => '#site-logo',
                    'property' => 'padding',
                    'units'	   => 'px'
                ),
            ),
            'active_callback' => array(
				array(
					'setting'  => 'header_select',
					'operator' => '==',
					'value'    => '',
				),
			),
        ),

        //Header Styling  
        'title1'     => array(
            'type'        => 'custom',
            'label'       => '',
            'section'     => 'header_styling',
            'default'     => '<h2>Top Bar</h2><hr>',
            'priority'    => 1,
            'active_callback' => array(
				array(
					'setting'  => 'header_select',
					'operator' => '==',
					'value'    => '',
				),
			),
        ),
        'bg_topbar'    => array(
            'type'     => 'color',
            'label'    => esc_html__( 'Background Color', 'valkiriapps' ),
            'section'  => 'header_styling',
            'default'  => '',
            'priority' => 1,
            'output'    => array(
                array(
                    'element'  => '#site-header .header-topbar',
                    'property' => 'background'
                ),
            ),
            'active_callback' => array(
				array(
					'setting'  => 'header_select',
					'operator' => '==',
					'value'    => '',
				),
			),
        ),        
        'color_topbar'    => array(
            'type'     => 'color',
            'label'    => esc_html__( 'Text Color', 'valkiriapps' ),
            'section'  => 'header_styling',
            'default'  => '',
            'priority' => 2,
            'output'    => array(
                array(
                    'element'  => '#site-header .header-topbar, #site-header .header-topbar a, #site-header .header-topbar .topbar-info li i',
                    'property' => 'color'
                ),
            ),
            'active_callback' => array(
				array(
					'setting'  => 'header_select',
					'operator' => '==',
					'value'    => '',
				),
			),
        ),
        'border_topbar'    => array(
            'type'     => 'color',
            'label'    => esc_html__( 'Border Bottom Color', 'valkiriapps' ),
            'section'  => 'header_styling',
            'default'  => '',
            'priority' => 3,
            'output'    => array(
                array(
                    'element'  => '#site-header .header-topbar',
                    'property' => 'border-color'
                ),
            ),
            'active_callback' => array(
				array(
					'setting'  => 'header_select',
					'operator' => '==',
					'value'    => '',
				),
			),
        ),
        'title2'     => array(
            'type'        => 'custom',
            'label'       => '',
            'section'     => 'header_styling',
            'default'     => '<h2>Main Navigation</h2><hr>',
            'priority'    => 4,
            'active_callback' => array(
				array(
					'setting'  => 'header_select',
					'operator' => '==',
					'value'    => '',
				),
			),
        ),
        'bg_menu'    => array(
            'type'     => 'color',
            'label'    => esc_html__( 'Background Color', 'valkiriapps' ),
            'section'  => 'header_styling',
            'default'  => '',
            'priority' => 5,
            'output'    => array(
                array(
                    'element'  => '.site-header .octf-main-header',
                    'property' => 'background'
                ),
            ),
            'active_callback' => array(
				array(
					'setting'  => 'header_select',
					'operator' => '==',
					'value'    => '',
				),
			),
        ),
        'color_menu'    => array(
            'type'     => 'color',
            'label'    => esc_html__( 'Text Color', 'valkiriapps' ),
            'section'  => 'header_styling',
            'default'  => '',
            'priority' => 6,
            'output'    => array(
                array(
                    'element'  => '.site-header #site-navigation > ul > li > a, .octf-btn-cta .octf-cta-icons i, .octf-btn-cta .contact-header span a',
                    'property' => 'color'
                ),
            ),
            'active_callback' => array(
				array(
					'setting'  => 'header_select',
					'operator' => '==',
					'value'    => '',
				),
			),
        ),
        'arrow_smenu'    => array(
            'type'     => 'color',
            'label'    => esc_html__( 'Arrow Color', 'valkiriapps' ),
            'section'  => 'header_styling',
            'default'  => '',
            'priority' => 6,
            'output'    => array(
                array(
                    'element'  => '#site-navigation > ul > li.menu-item-has-children > a:after, #site-navigation ul > li li.menu-item-has-children > a:after',
                    'property' => 'color'
                ),
            ),
            'active_callback' => array(
				array(
					'setting'  => 'header_select',
					'operator' => '==',
					'value'    => '',
				),
			),
        ),
        'title3'     => array(
            'type'        => 'custom',
            'label'       => '',
            'section'     => 'header_styling',
            'default'     => '<h2>Main Navigation Scroll</h2><hr>',
            'priority'    => 7,
            'active_callback' => array(
				array(
					'setting'  => 'header_select',
					'operator' => '==',
					'value'    => '',
				),
			),
        ),
        'bg_menu_scroll'    => array(
            'type'     => 'color',
            'label'    => esc_html__( 'Background Color', 'valkiriapps' ),
            'section'  => 'header_styling',
            'default'  => '',
            'priority' => 8,
            'output'    => array(
                array(
                    'element'  => '.site-header .octf-main-header.is-stuck',
                    'property' => 'background'
                ),
            ),
            'active_callback' => array(
				array(
					'setting'  => 'header_select',
					'operator' => '==',
					'value'    => '',
				),
			),
        ),
        'color_menu_scroll'    => array(
            'type'     => 'color',
            'label'    => esc_html__( 'Text Color', 'valkiriapps' ),
            'section'  => 'header_styling',
            'default'  => '',
            'priority' => 9,
            'output'    => array(
                array(
                    'element'  => '.site-header .octf-main-header.is-stuck #site-navigation > ul > li > a, .is-stuck .octf-btn-cta .octf-cta-icons i, .is-stuck .octf-btn-cta .contact-header span a',
                    'property' => 'color'
                ),
            ),
            'active_callback' => array(
				array(
					'setting'  => 'header_select',
					'operator' => '==',
					'value'    => '',
				),
			),
        ),
        'arrow_ssmenu'    => array(
            'type'     => 'color',
            'label'    => esc_html__( 'Arrow Color', 'valkiriapps' ),
            'section'  => 'header_styling',
            'default'  => '',
            'priority' => 9,
            'output'    => array(
                array(
                    'element'  => '.is-stuck #site-navigation > ul > li.menu-item-has-children > a:after, .is-stuck #site-navigation ul > li li.menu-item-has-children > a:after',
                    'property' => 'color'
                ),
            ),
            'active_callback' => array(
				array(
					'setting'  => 'header_select',
					'operator' => '==',
					'value'    => '',
				),
			),
        ),
        'title4'     => array(
            'type'        => 'custom',
            'label'       => '',
            'section'     => 'header_styling',
            'default'     => '<h2>Dropdown Menu</h2><hr>',
            'priority'    => 10,
            'active_callback' => array(
				array(
					'setting'  => 'header_select',
					'operator' => '==',
					'value'    => '',
				),
			),
        ),
        'bg_smenu'    => array(
            'type'     => 'color',
            'label'    => esc_html__( 'Background Color', 'valkiriapps' ),
            'section'  => 'header_styling',
            'default'  => '',
            'priority' => 11,
            'output'    => array(
                array(
                    'element'  => '#site-navigation ul ul',
                    'property' => 'background'
                ),                
            ),
            'active_callback' => array(
				array(
					'setting'  => 'header_select',
					'operator' => '==',
					'value'    => '',
				),
			),
        ),        
        'color_smenu'    => array(
            'type'     => 'color',
            'label'    => esc_html__( 'Text Color', 'valkiriapps' ),
            'section'  => 'header_styling',
            'default'  => '',
            'priority' => 12,
            'output'    => array(
                array(
                    'element'  => '#site-navigation ul li li a',
                    'property' => 'color'
                ),
            ),
            'active_callback' => array(
				array(
					'setting'  => 'header_select',
					'operator' => '==',
					'value'    => '',
				),
			),
        ),
        'color_hover_smenu'    => array(
            'type'     => 'color',
            'label'    => esc_html__( 'Text Hover Color', 'valkiriapps' ),
            'section'  => 'header_styling',
            'default'  => '',
            'priority' => 12,
            'output'    => array(
                array(
                    'element'  => '#site-navigation ul li li a:hover, #site-navigation ul ul li.current-menu-item > a, #site-navigation ul li li a:before',
                    'property' => 'color'
                )
            ),
            'active_callback' => array(
				array(
					'setting'  => 'header_select',
					'operator' => '==',
					'value'    => '',
				),
			),
        ),
        'title5'     => array(
            'type'        => 'custom',
            'label'       => '',
            'section'     => 'header_styling',
            'default'     => '<h2>Call To Action</h2><hr>',
            'priority'    => 12,
            'active_callback' => array(
				array(
					'setting'  => 'header_select',
					'operator' => '==',
					'value'    => '',
				),
			),
        ),
        'cta_bgcolor_header'    => array(
            'type'     => 'color',
            'label'    => esc_html__( 'Background Color', 'valkiriapps' ),
            'section'  => 'header_styling',
            'default'  => '',
            'priority' => 13,
            'output'    => array(
                array(
                    'element'  => '.site-header .octf-btn',
                    'property' => 'background'
                ),
            ),
            'active_callback' => array(
            	array(
					'setting'  => 'header_select',
					'operator' => '==',
					'value'    => '',
				),
				array(
					'setting'  => 'header_cta_switch',
					'operator' => '==',
					'value'    => 1,
				),
			),
        ),
        'cta_textcolor_header'    => array(
            'type'     => 'color',
            'label'    => esc_html__( 'Text Color', 'valkiriapps' ),
            'section'  => 'header_styling',
            'default'  => '',
            'priority' => 13,
            'output'    => array(
                array(
                    'element'  => '.site-header .octf-btn',
                    'property' => 'color'
                ),
            ),
            'active_callback' => array(
            	array(
					'setting'  => 'header_select',
					'operator' => '==',
					'value'    => '',
				),
				array(
					'setting'  => 'header_cta_switch',
					'operator' => '==',
					'value'    => 1,
				),
			),
        ),

        /*** Mobile Menu ***/
        'header_mobile_sticky' => array(
            'type'     => 'toggle',
            'label'    => esc_html__( 'Sticky Header', 'valkiriapps' ),
            'section'  => 'menu_mobile',
            'default'  => '0',
            'priority' => 5,
            'active_callback' => array(
				array(
					'setting'  => 'header_mobile',
					'operator' => '==',
					'value'    => '',
				),
			),
        ),
        'cta_mobile' => array(
            'type'     => 'toggle',
            'label'    => esc_html__( 'Call To Action Button', 'valkiriapps' ),
            'section'  => 'menu_mobile',
            'default'  => '0',
            'priority' => 6,
            'active_callback' => array(
				array(
					'setting'  => 'header_mobile',
					'operator' => '==',
					'value'    => '',
				),
			),
        ),
        'logo_mobile'         => array(
			'type'     => 'image',
			'label'    => esc_attr__( 'Mobile Logo', 'valkiriapps' ),
			'section'  => 'menu_mobile',
			'default'  => trailingslashit( get_template_directory_uri() ) . 'images/logo.svg',
			'priority' => 11,
			'active_callback' => array(
				array(
					'setting'  => 'header_mobile',
					'operator' => '==',
					'value'    => '',
				),
			),
		),
        'mlogo_height' => array(
            'type'     => 'number',
            'label'    => esc_html__( 'Logo Height(px)', 'valkiriapps' ),
            'section'  => 'menu_mobile',
            'priority' => 11,
            'default'  => '',
            'output'    => array(
                array(
                    'element'  => '.header_mobile .mlogo_wrapper img',
                    'property' => 'height',
                    'units'	   => 'px'
                ),
            ),
            'active_callback' => array(
				array(
					'setting'  => 'header_mobile',
					'operator' => '==',
					'value'    => '',
				),
			),
        ),
        'bg_mmenu'    => array(
            'type'     => 'color',
            'label'    => esc_html__( 'Background Color', 'valkiriapps' ),
            'section'  => 'menu_mobile',
            'default'  => '',
            'priority' => 11,
            'output'    => array(
                array(
                    'element'  => '#site-header .header_mobile, .header_mobile .mobile_nav',
                    'property' => 'background'
                ),                
            ),
            'active_callback' => array(
				array(
					'setting'  => 'header_mobile',
					'operator' => '==',
					'value'    => '',
				),
			),
        ), 
        'color_mmenu'    => array(
            'type'     => 'color',
            'label'    => esc_html__( 'Text Color', 'valkiriapps' ),
            'section'  => 'menu_mobile',
            'default'  => '',
            'priority' => 11,
            'output'    => array(
                array(
                    'element'  => '.header_mobile .mobile_nav .mobile_mainmenu li a',
                    'property' => 'color'
                ),                
            ),
            'active_callback' => array(
				array(
					'setting'  => 'header_mobile',
					'operator' => '==',
					'value'    => '',
				),
			),
        ),
        'color_hover_mmenu'    => array(
            'type'     => 'color',
            'label'    => esc_html__( 'Text Hover Color', 'valkiriapps' ),
            'section'  => 'menu_mobile',
            'default'  => '',
            'priority' => 11,
            'output'    => array(
                array(
                    'element'  => '.header_mobile .mobile_nav .mobile_mainmenu li a:hover, .header_mobile .mobile_nav .mobile_mainmenu > li.current-menu-item > a, .header_mobile .mobile_nav .mobile_mainmenu li li a:hover',
                    'property' => 'color'
                ),                
            ),
            'active_callback' => array(
				array(
					'setting'  => 'header_mobile',
					'operator' => '==',
					'value'    => '',
				),
			),
        ),
        'border_mmenu'    => array(
            'type'     => 'color',
            'label'    => esc_html__( 'Border Color', 'valkiriapps' ),
            'section'  => 'menu_mobile',
            'default'  => '',
            'priority' => 11,
            'output'    => array(
                array(
                    'element'  => '.header_mobile .mobile_nav .mobile_mainmenu li a',
                    'property' => 'border-color'
                ),                
            ),
            'active_callback' => array(
				array(
					'setting'  => 'header_mobile',
					'operator' => '==',
					'value'    => '',
				),
			),
        ),  
        'color_toggle'    => array(
            'type'     => 'color',
            'label'    => esc_html__( 'Toggle Button Color', 'valkiriapps' ),
            'section'  => 'menu_mobile',
            'default'  => '',
            'priority' => 11,
            'output'    => array(
                array(
                    'element'  => '#mmenu_toggle button, #mmenu_toggle button:after, #mmenu_toggle button:before',
                    'property' => 'background'
                ),
                array(
                    'element'  => '.header_mobile .mobile_nav .mobile_mainmenu > li.menu-item-has-children .arrow i',
                    'property' => 'color'
                ),                
            ),
            'active_callback' => array(
				array(
					'setting'  => 'header_mobile',
					'operator' => '==',
					'value'    => '',
				),
			),
        ),

        //Page Header
        'pheader_switch'  => array(
            'type'        => 'toggle',
            'label'       => esc_html__( 'Page Header On/Off', 'valkiriapps' ),
            'section'     => 'page_header',
            'default'     => 1,
            'priority'    => 10,
        ),
        'breadcrumbs'     => array(
            'type'        => 'toggle',
            'label'       => esc_html__( 'Breadcrumbs On/Off', 'valkiriapps' ),
            'section'     => 'page_header',
            'default'     => 1,
            'priority'    => 10,
            'active_callback' => array(
                array(
                    'setting'  => 'pheader_switch',
                    'operator' => '==',
                    'value'    => 1,
                ),
            ),
        ),
        'left_bread'     => array(
            'type'        => 'toggle',
            'label'       => esc_html__( 'Breadcrumbs On Left', 'valkiriapps' ),
            'section'     => 'page_header',
            'default'     => 0,
            'priority'    => 10,
            'active_callback' => array(
                array(
                    'setting'  => 'pheader_switch',
                    'operator' => '==',
                    'value'    => 1,
                ),
                array(
                    'setting'  => 'breadcrumbs',
                    'operator' => '==',
                    'value'    => 1,
                ),
            ),
        ),
        'pheader_img'  => array(
            'type'     => 'image',
            'label'    => esc_html__( 'Background Image', 'valkiriapps' ),
            'section'  => 'page_header',
            'default'  => get_template_directory_uri() . '/images/bg-pheader.jpg',
            'priority' => 10,
            'output'    => array(
                array(
                    'element'  => '.page-header',
                    'property' => 'background-image'
                ),
            ),
            'active_callback' => array(
                array(
                    'setting'  => 'pheader_switch',
                    'operator' => '==',
                    'value'    => 1,
                ),
            ),
        ),
        'pheader_color'    => array(
            'type'     => 'color',
            'label'    => esc_html__( 'Background Color', 'valkiriapps' ),
            'section'  => 'page_header',
            'default'  => '',
            'priority' => 10,
            'output'    => array(
                array(
                    'element'  => '.page-header',
                    'property' => 'background-color'
                ),
            ),
            'active_callback' => array(
                array(
                    'setting'  => 'pheader_switch',
                    'operator' => '==',
                    'value'    => 1,
                ),
            ),
        ),
        'ptitle_color'    => array(
            'type'     => 'color',
            'label'    => esc_html__( 'Page Title Color', 'valkiriapps' ),
            'section'  => 'page_header',
            'default'  => '',
            'priority' => 10,
            'output'    => array(
                array(
                    'element'  => '.page-header .page-title, .page-header .breadcrumbs li, .page-header .breadcrumbs li a, .page-header .breadcrumbs li a:hover, .page-header .breadcrumbs li:before',
                    'property' => 'color'
                ),
            ),
            'active_callback' => array(
                array(
                    'setting'  => 'pheader_switch',
                    'operator' => '==',
                    'value'    => 1,
                ),
            ),
        ),
        'pheader_top'  => array(
            'type'     => 'number',
            'label'    => esc_html__( 'Padding Top(px)', 'valkiriapps' ),
            'section'  => 'page_header',
            'priority' => 10,
            'default'  => '',
            'output'    => array(
                array(
                    'element'  => '.page-header .inner',
                    'property' => 'padding-top',
                    'units'	   => 'px'
                ),
            ),
            'active_callback' => array(
                array(
                    'setting'  => 'pheader_switch',
                    'operator' => '==',
                    'value'    => 1,
                ),
                array(
                    'setting'  => 'header_fixed',
                    'operator' => '==',
                    'value'    => 1,
                ),
            ),
        ),
        'pheader_height'  => array(
            'type'     => 'dimensions',
            'label'    => esc_html__( 'Page Header Height', 'valkiriapps' ),
            'section'  => 'page_header',
            'transport' => 'auto',
            'priority' => 10,
            'choices'   => array(
                'desktop' => esc_attr__( 'Desktop', 'valkiriapps' ),
                'tablet'  => esc_attr__( 'Tablet', 'valkiriapps' ),
                'mobile'  => esc_attr__( 'Mobile', 'valkiriapps' ),
            ),
            'output'   => array(
                array(
                    'choice'      => 'mobile',
                    'element'     => '.page-header',
                    'property'    => 'min-height',
                    'media_query' => '@media (max-width: 767px)',
                ),
                array(
                    'choice'      => 'tablet',
                    'element'     => '.page-header',
                    'property'    => 'min-height',
                    'media_query' => '@media (min-width: 768px) and (max-width: 1024px)',
                ),
                array(
                    'choice'      => 'desktop',
                    'element'     => '.page-header',
                    'property'    => 'min-height',
                    'media_query' => '@media (min-width: 1024px)',
                ),
            ),
            'default' => array(
                'desktop' => '',
                'tablet'  => '',
                'mobile'  => '',
            ),
            'active_callback' => array(
                array(
                    'setting'  => 'pheader_switch',
                    'operator' => '==',
                    'value'    => 1,
                ),
            ),
        ),
        'head_size'  => array(
            'type'     => 'dimensions',
            'label'    => esc_html__( 'Page Title Size', 'valkiriapps' ),
            'section'  => 'page_header',
            'transport' => 'auto',
            'priority' => 10,
            'choices'   => array(
                'desktop' => esc_attr__( 'Desktop', 'valkiriapps' ),
                'tablet'  => esc_attr__( 'Tablet', 'valkiriapps' ),
                'mobile'  => esc_attr__( 'Mobile', 'valkiriapps' ),
            ),
            'output'   => array(
                array(
                    'choice'      => 'mobile',
                    'element'     => '.page-header .page-title',
                    'property'    => 'font-size',
                    'media_query' => '@media (max-width: 767px)',
                ),
                array(
                    'choice'      => 'tablet',
                    'element'     => '.page-header .page-title',
                    'property'    => 'font-size',
                    'media_query' => '@media (min-width: 768px) and (max-width: 1024px)',
                ),
                array(
                    'choice'      => 'desktop',
                    'element'     => '.page-header .page-title',
                    'property'    => 'font-size',
                    'media_query' => '@media (min-width: 1024px)',
                ),
            ),
            'default' => array(
                'desktop' => '',
                'tablet'  => '',
                'mobile'  => '',
            ),
            'active_callback' => array(
                array(
                    'setting'  => 'pheader_switch',
                    'operator' => '==',
                    'value'    => 1,
                ),
            ),
        ),
        'pheader_htmltag'   => array(
            'type'     		=> 'select',
            'label'    		=> esc_html__( 'Page Title HTML Tag', 'valkiriapps' ),
            'section'  		=> 'page_header',
            'default'     	=> 'h1',
            'priority' 		=> 10,            
			'placeholder' 	=> esc_html__( 'Choose an html tag', 'valkiriapps' ),
			'choices'     	=> array(
				'h1' 		=> esc_html__( 'H1', 'valkiriapps' ),
				'h2' 		=> esc_html__( 'H2', 'valkiriapps' ),
				'h3' 		=> esc_html__( 'H3', 'valkiriapps' ),
				'h4' 		=> esc_html__( 'H4', 'valkiriapps' ),
				'h5' 		=> esc_html__( 'H5', 'valkiriapps' ),
				'h6' 		=> esc_html__( 'H6', 'valkiriapps' ),
				'span' 		=> esc_html__( 'SPAN', 'valkiriapps' ),
				'p' 		=> esc_html__( 'P', 'valkiriapps' ),
				'div' 		=> esc_html__( 'DIV', 'valkiriapps' ),				
			),
            'active_callback' => array(
                array(
                    'setting'  => 'pheader_switch',
                    'operator' => '==',
                    'value'    => 1,
                ),
            ),
        ),

        // Blog Page
		'blog_layout'           => array(
			'type'        => 'radio-image',
			'label'       => esc_html__( 'Blog Layout', 'valkiriapps' ),
			'section'     => 'blog_page',
			'default'     => 'content-sidebar',
			'priority'    => 7,
			'description' => esc_html__( 'Select default sidebar for the blog page.', 'valkiriapps' ),
			'choices'     => array(
				'content-sidebar' 	=> get_template_directory_uri() . '/inc/backend/images/right.png',
				'sidebar-content' 	=> get_template_directory_uri() . '/inc/backend/images/left.png',
				'full-content' 		=> get_template_directory_uri() . '/inc/backend/images/full.png',
			)
		),
		'blog_style'           => array(
			'type'        => 'select',
			'label'       => esc_html__( 'Blog Style', 'valkiriapps' ),
			'section'     => 'blog_page',
			'default'     => 'list',
			'priority'    => 8,
			'description' => esc_html__( 'Select style default for the blog page.', 'valkiriapps' ),
			'choices'     => array(
				'list' => esc_attr__( 'Blog List', 'valkiriapps' ),
				'grid' => esc_attr__( 'Blog Grid', 'valkiriapps' ),
			),
		),
		'blog_columns'           => array(
			'type'        => 'select',
			'label'       => esc_html__( 'Blog Columns', 'valkiriapps' ),
			'section'     => 'blog_page',
			'default'     => 'pf_2_cols',
			'priority'    => 8,
			'description' => esc_html__( 'Select columns default for the blog page.', 'valkiriapps' ),
			'choices'     => array(
				'pf_2_cols' => esc_attr__( '2 Columns', 'valkiriapps' ),
				'pf_3_cols' => esc_attr__( '3 Columns', 'valkiriapps' ),
				'pf_4_cols' => esc_attr__( '4 Columns', 'valkiriapps' ),
			),
			'active_callback' => array(
				array(
					'setting'  => 'blog_style',
					'operator' => '==',
					'value'    => 'grid',
				),
			),
		),
		'post_entry_meta'              => array(
            'type'     => 'multicheck',
            'label'    => esc_html__( 'Entry Meta', 'valkiriapps' ),
            'section'  => 'blog_page',
            'default'  => array( 'author', 'date', 'comm' ),
            'choices'  => array(
                'author'  => esc_html__( 'Author', 'valkiriapps' ),
                'date'    => esc_html__( 'Date', 'valkiriapps' ),
                'comm'     => esc_html__( 'Comments', 'valkiriapps' ),
            ),
            'priority' => 10,
        ),
        'blog_read_more'               => array(
			'type'            => 'text',
			'label'           => esc_html__( 'Details Button', 'valkiriapps' ),
			'section'         => 'blog_page',
			'default'         => esc_html__( 'LEARN MORE', 'valkiriapps' ),
			'priority'        => 11,
		),

        // Single Post
        'single_post_layout'           => array(
            'type'        => 'radio-image',
            'label'       => esc_html__( 'Layout', 'valkiriapps' ),
            'section'     => 'single_post',
            'default'     => 'content-sidebar',
            'priority'    => 10,
            'choices'     => array(
				'content-sidebar' 	=> get_template_directory_uri() . '/inc/backend/images/right.png',
				'sidebar-content' 	=> get_template_directory_uri() . '/inc/backend/images/left.png',
				'full-content' 		=> get_template_directory_uri() . '/inc/backend/images/full.png',
			)
        ),
        'ptitle_post'               => array(
			'type'            => 'text',
			'label'           => esc_html__( 'Page Title', 'valkiriapps' ),
			'section'         => 'single_post',
			'default'         => esc_html__( 'Blog Post', 'valkiriapps' ),
			'priority'        => 10,
		),
        'single_separator1'     => array(
			'type'        => 'custom',
			'label'       => esc_html__( 'Social Share', 'valkiriapps' ),
			'section'     => 'single_post',
			'default'     => '<hr>',
			'priority'    => 10,
		),
        'post_socials'              => array(
            'type'     => 'multicheck',
            'section'  => 'single_post',
            'default'  => array( 'twitter', 'facebook', 'pinterest', 'linkedin' ),
            'choices'  => array(
                'twit'  	=> esc_html__( 'Twitter', 'valkiriapps' ),
                'face'    	=> esc_html__( 'Facebook', 'valkiriapps' ),
                'pint'     	=> esc_html__( 'Pinterest', 'valkiriapps' ),
                'link'     	=> esc_html__( 'Linkedin', 'valkiriapps' ),
                'google'  	=> esc_html__( 'Google Plus', 'valkiriapps' ),
                'tumblr'    => esc_html__( 'Tumblr', 'valkiriapps' ),
                'reddit'    => esc_html__( 'Reddit', 'valkiriapps' ),
                'vk'     	=> esc_html__( 'VK', 'valkiriapps' ),
            ),
            'priority' => 10,
        ),
        'single_separator2'     => array(
			'type'        => 'custom',
			'label'       => esc_html__( 'Entry Footer', 'valkiriapps' ),
			'section'     => 'single_post',
			'default'     => '<hr>',
			'priority'    => 10,
		),
		'like_post'     => array(
			'type'        => 'checkbox',
			'label'       => esc_attr__( 'Like Post', 'valkiriapps' ),
			'section'     => 'single_post',
			'default'     => true,
			'priority'    => 10,
		),
        'author_box'     => array(
			'type'        => 'checkbox',
			'label'       => esc_attr__( 'Author Info Box', 'valkiriapps' ),
			'section'     => 'single_post',
			'default'     => true,
			'priority'    => 10,
		),
		'post_nav'     => array(
			'type'        => 'checkbox',
			'label'       => esc_attr__( 'Post Navigation', 'valkiriapps' ),
			'section'     => 'single_post',
			'default'     => true,
			'priority'    => 10,
		),
		// Portfolio Page
		'portfolio_archive'           => array(
			'type'        => 'select',
			'label'       => esc_html__( 'Portfolio Archive', 'valkiriapps' ),
			'section'     => 'portfolio_page',
			'default'     => 'archive_default',
			'priority'    => 1,
			'description' => esc_html__( 'Select page default for the portfolio archive page.', 'valkiriapps' ),
			'choices'     => array(
				'archive_default' => esc_attr__( 'Archive page default', 'valkiriapps' ),
				'archive_custom' => esc_attr__( 'Archive page custom', 'valkiriapps' ),
			),
		),
		'archive_page_custom'     => array(
			'type'        => 'dropdown-pages',  
	 		'label'       => esc_attr__( 'Select Page', 'valkiriapps' ), 
	 		'description' => esc_attr__( 'Choose a custom page for archive portfolio page.', 'valkiriapps' ), 
	 		'section'     => 'portfolio_page', 
	 		'default'     => '', 
	 		'priority'    => 2,	 		
	 		'active_callback' => array(
				array(
					'setting'  => 'portfolio_archive',
					'operator' => '==',
					'value'    => 'archive_custom',
				),
			),
		),
		'portfolio_column'           => array(
			'type'        => 'select',
			'label'       => esc_html__( 'Portfolio Column', 'valkiriapps' ),
			'section'     => 'portfolio_page',
			'default'     => '3cl',
			'priority'    => 3,
			'description' => esc_html__( 'Select default column for the portfolio page.', 'valkiriapps' ),
			'choices'     => array(
				'2cl' => esc_attr__( '2 Column', 'valkiriapps' ),
				'3cl' => esc_attr__( '3 Column', 'valkiriapps' ),
				'4cl' => esc_attr__( '4 Column', 'valkiriapps' ),
				'5cl' => esc_attr__( '5 Column', 'valkiriapps' ),
			),
			'active_callback' => array(
				array(
					'setting'  => 'portfolio_archive',
					'operator' => '==',
					'value'    => 'archive_default',
				),
			),
		),
		'portfolio_style'           => array(
			'type'        => 'select',
			'label'       => esc_html__( 'Portfolio Style', 'valkiriapps' ),
			'section'     => 'portfolio_page',
			'default'     => 'style1',
			'priority'    => 4,
			'description' => esc_html__( 'Select default style for the portfolio page.', 'valkiriapps' ),
			'choices'     => array(
				'style1' => esc_attr__( 'Grid Normal', 'valkiriapps' ),
				'style2' => esc_attr__( 'Grid Masonry', 'valkiriapps' ),
			),
			'active_callback' => array(
				array(
					'setting'  => 'portfolio_archive',
					'operator' => '==',
					'value'    => 'archive_default',
				),
			),
		),
		'portfolio_posts_per_page' => array(
			'type'        => 'number',
			'section'     => 'portfolio_page',
			'priority'    => 5,
			'label'       => esc_html__( 'Posts per page', 'valkiriapps' ),			
			'description' => esc_html__( 'Change Posts Per Page for Portfolio Archive, Taxonomy.', 'valkiriapps' ),
			'default'     => '',
			'active_callback' => array(
				array(
					'setting'  => 'portfolio_archive',
					'operator' => '==',
					'value'    => 'archive_default',
				),
			),
		),
		'pf_nav'     => array(
			'type'        => 'toggle',
			'label'       => esc_attr__( 'Projects Navigation On/Off', 'valkiriapps' ),
			'section'     => 'portfolio_post',
			'default'     => 1,
			'priority'    => 7,
		),
		'pf_related_switch'     => array(
			'type'        => 'toggle',
			'label'       => esc_attr__( 'Related Projects On/Off', 'valkiriapps' ),
			'section'     => 'portfolio_post',
			'default'     => 1,
			'priority'    => 7,
		),
		// Footer Layout
		'footer_layout'     => array(
			'type'        => 'select',  
	 		'label'       => esc_attr__( 'Select Footer', 'valkiriapps' ), 
	 		'description' => esc_attr__( 'Choose a footer for all site here.', 'valkiriapps' ), 
	 		'section'     => 'footer', 
	 		'default'     => '', 
	 		'priority'    => 1,
	 		'placeholder' => esc_attr__( 'Select a footer', 'valkiriapps' ), 
	 		'choices'     => ( class_exists( 'Kirki_Helper' ) ) ? Kirki_Helper::get_posts( array( 'post_type' => 'ot_footer_builders', 'posts_per_page' => -1 ) ) : array(),
		),
		'backtotop_separator'     => array(
			'type'        => 'custom',
			'label'       => '',
			'section'     => 'footer',
			'default'     => '<hr>',
			'priority'    => 2,
		),
		'backtotop'  => array(
            'type'        => 'toggle',
            'label'       => esc_html__( 'Back To Top On/Off?', 'valkiriapps' ),
            'section'     => 'footer',
            'default'     => 1,
            'priority'    => 3,
        ),
        'bg_backtotop'    => array(
            'type'     => 'color',
            'label'    => esc_html__( 'Back-To-Top Background Color', 'valkiriapps' ),
            'section'  => 'footer',
            'priority' => 4,
            'default'     => '',
            'output'    => array(
                array(
                    'element'  => '#back-to-top',
                    'property' => 'background',
                ),
            ),
            'active_callback' => array(
				array(
					'setting'  => 'backtotop',
					'operator' => '==',
					'value'    => 1,
				),
			),
        ),
        'color_backtotop' => array(
            'type'     => 'color',
            'label'    => esc_html__( 'Back-To-Top Color', 'valkiriapps' ),
            'section'  => 'footer',
            'priority' => 5,
            'default'     => '',
            'output'    => array(
                array(
                    'element'  => '#back-to-top > i:before',
                    'property' => 'color',
                )
            ),
            'active_callback' => array(
				array(
					'setting'  => 'backtotop',
					'operator' => '==',
					'value'    => 1,
				),
			),
        ),
        'spacing_backtotop' => array(
            'type'     => 'dimensions',
            'label'    => esc_html__( 'Back-To-Top Spacing', 'valkiriapps' ),
            'section'  => 'footer',
            'priority' => 6,
            'default'     => array(
				'bottom'  => '',
				'left' => '',
				'right' => '',
			),
			'choices'     => array(
				'labels' => array(
					'bottom'  => esc_html__( 'Bottom', 'valkiriapps' ),
					'left' => esc_html__( 'Left', 'valkiriapps' ),
					'right' => esc_html__( 'Right', 'valkiriapps' ),
				),
			),
            'output'    => array(
                array(
                    'element'  => '#back-to-top.show',
                )
            ),
            'active_callback' => array(
				array(
					'setting'  => 'backtotop',
					'operator' => '==',
					'value'    => 1,
				),
			),
        ),
        /* 404 */
		'page_404'   	  => array(
			'type'        => 'dropdown-pages',  
	 		'label'       => esc_attr__( 'Select Page', 'valkiriapps' ), 
	 		'description' => esc_attr__( 'Choose a custom page for page 404.', 'valkiriapps' ),
	 		'placeholder' => esc_attr__( 'Select a page 404', 'valkiriapps' ), 
	 		'section'     => 'error_404', 
	 		'default'     => '', 
			'priority'    => 3,
		),
        // Typography
        'body_typo'    => array(
            'type'     => 'typography',
            'label'    => esc_html__( 'Body Font 1', 'valkiriapps' ),
            'section'  => 'typography',
            'priority' => 10,
            'default'  => array(
                'font-family'    => '',
                'variant'        => '',
                'font-size'      => '',
                'line-height'    => '',
                'letter-spacing' => '',
                'text-transform' => '',
            ),
            'output'      => array(
                array(
                    'element' => 'body, p, button, input, select, optgroup, textarea, .font-main, .elementor-element .elementor-widget-text-editor, .elementor-element .elementor-widget-icon-list .elementor-icon-list-item',
                ),
            ),
        ),
        'second_font'    => array(
            'type'     => 'typography',
            'label'    => esc_html__( 'Body Font 2', 'valkiriapps' ),
            'section'  => 'typography',
            'priority' => 10,
            'default'  => array(
                'font-family'  	 => '',
            ),
        ),
        'heading1_typo'                           => array(
            'type'     => 'typography',
            'label'    => esc_html__( 'Heading 1', 'valkiriapps' ),
            'section'  => 'typography',
            'priority' => 10,
            'default'  => array(
                'font-family'    => '',
                'variant'        => '',
                'font-size'      => '',
                'line-height'    => '',
                'letter-spacing' => '',
                'text-transform' => '',
            ),
            'output'      => array(
                array(
                    'element' => 'h1, .elementor-widget.elementor-widget-heading h1.elementor-heading-title',
                ),
            ),
        ),
        'heading2_typo'                           => array(
            'type'     => 'typography',
            'label'    => esc_html__( 'Heading 2', 'valkiriapps' ),
            'section'  => 'typography',
            'priority' => 10,
            'default'  => array(
                'font-family'    => '',
                'variant'        => '',
                'font-size'      => '',
                'line-height'    => '',
                'letter-spacing' => '',
                'text-transform' => '',
            ),
            'output'      => array(
                array(
                    'element' => 'h2, .elementor-widget.elementor-widget-heading h2.elementor-heading-title',
                ),
            ),
        ),
        'heading3_typo'                           => array(
            'type'     => 'typography',
            'label'    => esc_html__( 'Heading 3', 'valkiriapps' ),
            'section'  => 'typography',
            'priority' => 10,
            'default'  => array(
                'font-family'    => '',
                'variant'        => '',
                'font-size'      => '',
                'line-height'    => '',
                'letter-spacing' => '',
                'text-transform' => '',
            ),
            'output'      => array(
                array(
                    'element' => 'h3, .elementor-widget.elementor-widget-heading h3.elementor-heading-title',
                ),
            ),
        ),
        'heading4_typo'                           => array(
            'type'     => 'typography',
            'label'    => esc_html__( 'Heading 4', 'valkiriapps' ),
            'section'  => 'typography',
            'priority' => 10,
            'default'  => array(
                'font-family'    => '',
                'variant'        => '',
                'font-size'      => '',
                'line-height'    => '',
                'letter-spacing' => '',
                'text-transform' => '',
            ),
            'output'      => array(
                array(
                    'element' => 'h4, .elementor-widget.elementor-widget-heading h4.elementor-heading-title',
                ),
            ),
        ),
        'heading5_typo'                           => array(
            'type'     => 'typography',
            'label'    => esc_html__( 'Heading 5', 'valkiriapps' ),
            'section'  => 'typography',
            'priority' => 10,
            'default'  => array(
                'font-family'    => '',
                'variant'        => '',
                'font-size'      => '',
                'line-height'    => '',
                'letter-spacing' => '',
                'text-transform' => '',
            ),
            'output'      => array(
                array(
                    'element' => 'h5, .elementor-widget.elementor-widget-heading h5.elementor-heading-title',
                ),
            ),
        ),
        'heading6_typo'                           => array(
            'type'     => 'typography',
            'label'    => esc_html__( 'Heading 6', 'valkiriapps' ),
            'section'  => 'typography',
            'priority' => 10,
            'default'  => array(
                'font-family'    => '',
                'variant'        => '',
                'font-size'      => '',
                'line-height'    => '',
                'letter-spacing' => '',
                'text-transform' => '',
            ),
            'output'      => array(
                array(
                    'element' => 'h6, .elementor-widget.elementor-widget-heading h6.elementor-heading-title',
                ),
            ),
        ),
        'menu_typo'    => array(
            'type'     => 'typography',
            'label'    => esc_html__( 'Menu', 'valkiriapps' ),
            'section'  => 'typography',
            'priority' => 10,
            'default'  => array(
                'font-family'    => '',
                'variant'        => '',
                'font-size'      => '',
                'line-height'    => '',
                'letter-spacing' => '',
                'text-transform' => '',
            ),
            'output'      => array(
                array(
                    'element' => '.main-navigation a',
                ),
            ),
        ),
        // Preloader Setting
        'preload'     => array(
            'type'        => 'toggle',
            'label'       => esc_attr__( 'Preloader', 'valkiriapps' ),
            'section'     => 'preload_section',
            'default'     => '1',
            'priority'    => 10,
        ),
        'preload_logo'    => array(
            'type'     => 'image',
            'label'    => esc_html__( 'Logo Preload', 'valkiriapps' ),
            'section'  => 'preload_section',
            'default'  => trailingslashit( get_template_directory_uri() ) . 'images/logo.svg',
            'priority' => 11,
            'active_callback' => array(
                array(
                    'setting'  => 'preload',
                    'operator' => '==',
                    'value'    => 1,
                ),
            ),
        ),
        'preload_logo_width'     => array(
            'type'     => 'slider',
            'label'    => esc_html__( 'Logo Width', 'valkiriapps' ),
            'section'  => 'preload_section',
            'default'  => 175,
            'priority' => 12,
            'choices'   => array(
                'min'  => 0,
                'max'  => 400,
                'step' => 1,
            ),
            'active_callback' => array(
                array(
                    'setting'  => 'preload',
                    'operator' => '==',
                    'value'    => 1,
                ),
            ),
        ),
        'preload_logo_height'    => array(
            'type'     => 'slider',
            'label'    => esc_html__( 'Logo Height', 'valkiriapps' ),
            'section'  => 'preload_section',
            'default'  => 50,
            'priority' => 13,
            'choices'   => array(
                'min'  => 0,
                'max'  => 200,
                'step' => 1,
            ),
            'active_callback' => array(
                array(
                    'setting'  => 'preload',
                    'operator' => '==',
                    'value'    => 1,
                ),
            ),
        ),
        'preload_text_color'    => array(
            'type'     => 'color',
            'label'    => esc_html__( 'Percent Text Color', 'valkiriapps' ),
            'section'  => 'preload_section',
            'default'  => '#0a0f2b',
            'priority' => 14,
            'active_callback' => array(
                array(
                    'setting'  => 'preload',
                    'operator' => '==',
                    'value'    => 1,
                ),
            ),
        ),
        'preload_bgcolor'    => array(
            'type'     => 'color',
            'label'    => esc_html__( 'Background Color', 'valkiriapps' ),
            'section'  => 'preload_section',
            'default'  => '#fff',
            'priority' => 15,
            'active_callback' => array(
                array(
                    'setting'  => 'preload',
                    'operator' => '==',
                    'value'    => 1,
                ),
            ),
        ),
        'preload_typo' => array(
            'type'        => 'typography',
            'label'       => esc_attr__( 'Percent Preload Font', 'valkiriapps' ),
            'section'     => 'preload_section',
            'default'     => array(
                'font-family'    => 'Roboto',
                'variant'        => 'regular',
                'font-size'      => '13px',
                'line-height'    => '40px',
                'letter-spacing' => '2px',
                'subsets'        => array( 'latin-ext' ),                
                'text-transform' => 'none',
                'text-align'     => 'center'
            ),
            'priority'    => 16,
            'output'      => array(
                array(
                    'element' => '#royal_preloader.royal_preloader_logo .royal_preloader_percentage',
                ),
            ),
            'active_callback' => array(
                array(
                    'setting'  => 'preload',
                    'operator' => '==',
                    'value'    => 1,
                ),
            ),
        ),
        //Color Scheme
        'bg_body'      => array(
            'type'     => 'color',
            'label'    => esc_html__( 'Background Body', 'valkiriapps' ),
            'section'  => 'color_scheme',
            'default'  => '',
            'priority' => 10,
            'output'   => array(
                array(
                    'element'  => 'body, .site-content',
                    'property' => 'background-color',
                ),
            ),
        ),
        'main_color'   => array(
            'type'     => 'color',
            'label'    => esc_html__( 'Primary Color', 'valkiriapps' ),
            'section'  => 'color_scheme',
            'default'  => '#43baff',
            'priority' => 10,
        ),
        'second_color' => array(
            'type'     => 'color',
            'label'    => esc_html__( 'Second Color', 'valkiriapps' ),
            'section'  => 'color_scheme',
            'default'  => '#7141b1',
            'priority' => 10,
        ),

        //GG Atlantic
        'js_code'  => array(
            'type'        => 'code',
            'label'       => esc_html__( 'Code', 'valkiriapps' ),
            'section'     => 'script_code',
            'choices'     => [
				'language' => 'js',
			],
            'priority'    => 3,
        ),
	);
	$settings['panels']   = apply_filters( 'valkiriapps_customize_panels', $panels );
	$settings['sections'] = apply_filters( 'valkiriapps_customize_sections', $sections );
	$settings['fields']   = apply_filters( 'valkiriapps_customize_fields', $fields );

	return $settings;
}

$valkiriapps_customize = new Valkiriapps_Customize( valkiriapps_customize_settings() );