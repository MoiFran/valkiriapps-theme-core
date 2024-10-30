<?php
namespace Elementor; // Custom widgets must be defined in the Elementor namespace
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly (security measure)

/**
 * Widget Name: Service Slider
 */
class Valkiriapps_Testimonials5 extends Widget_Base{

 	// The get_name() method is a simple one, you just need to return a widget name that will be used in the code.
	public function get_name() {
		return 'itestimonials5';
	}

	// The get_title() method, which again, is a very simple one, you need to return the widget title that will be displayed as the widget label.
	public function get_title() {
		return __( 'Valkiriapps Testimonial Slider 5', 'valkiriapps' );
	}

	// The get_icon() method, is an optional but recommended method, it lets you set the widget icon. you can use any of the eicon or font-awesome icons, simply return the class name as a string.
	public function get_icon() {
		return 'eicon-carousel';
	}

	// The get_categories method, lets you set the category of the widget, return the category name as a string.
	public function get_categories() {
		return [ 'category_valkiriapps' ];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'section_services',
			[
				'label' => __( 'Services', 'valkiriapps' ),
			]
		);
		$this->add_control(
			'show_title',
			[
				'label' => __( 'Show Title', 'valkiriapps' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'valkiriapps' ),
				'label_off' => __( 'Hide', 'valkiriapps' ),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);
		$this->add_control(
			'subtitle',
			[
				'label' => 'Sub Title',
				'type' => Controls_Manager::TEXT,
				'default' => '',
				'placeholder' => __( 'Enter your subtitle', 'valkiriapps' ),
				'label_block' => true,
				'show_label' => false,
				'condition' => [
					'show_title' => 'yes',
				]
			]
		);
		$this->add_control(
			'title',
			[
				'label' => 'Title',
				'type' => Controls_Manager::TEXTAREA,
				'default' => '',
				'placeholder' => __( 'Enter your title', 'valkiriapps' ),
				'show_label' => false,
				'label_block' => true,
				'condition' => [
					'show_title' => 'yes',
				]
			]
		);
		
		$this->add_control(
			'description',
			[
				'label' => __( 'Description', 'valkiriapps' ),
				'type' => Controls_Manager::TEXTAREA,
				'default' => __( 'Work with you to understand your business specifics and your target audience to our marketing fully strategy.', 'valkiriapps' ),
				'condition' => [
					'show_title' => 'yes',
				]
			]
		);
		$this->add_control(
			'heading_size',
			[
				'label' => __( 'Title HTML Tag', 'valkiriapps' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'h1'  => __( 'H1', 'valkiriapps' ),
					'h2'  => __( 'H2', 'valkiriapps' ),
					'h3'  => __( 'H3', 'valkiriapps' ),
					'h4'  => __( 'H4', 'valkiriapps' ),
					'h5'  => __( 'H5', 'valkiriapps' ),
					'h6'  => __( 'H6', 'valkiriapps' ),
					'div'  => __( 'div', 'valkiriapps' ),
					'span'  => __( 'span', 'valkiriapps' ),
					'p'  => __( 'p', 'valkiriapps' ),
				],
				'default' => 'h2',
				'condition' => [
					'show_title' => 'yes',
				]
			]
		);
		
		$repeater = new Repeater();		
		$repeater->add_control(
			'image',
			[
				'label' => __( 'Icon', 'valkiriapps' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				]
			]
		);
		$repeater->add_control(
			'title',
			[
				'label' => __( 'Title', 'valkiriapps' ),
				'type' => Controls_Manager::TEXT,
				'default' => 'Awesome Results',
			]
		);
		$repeater->add_control(
			'content',
			[
				'label' => __( 'Content', 'valkiriapps' ),
				'type' => Controls_Manager::TEXTAREA,
				'rows' => '10',
				'default' => 'Create and manage top-performing social campaigns and start.',
			]
		);
		$repeater->add_control(
			'tjob',
			[
				'label' => __( 'Job', 'valkiriapps' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'P. Desiger of (Meta)', 'valkiriapps' ),
			]
		);
		$repeater->add_control(
			'rating',
			[
				'label' => __( 'Rating <span class="elementor-control-field-description">( 0-5 )</span>', 'valkiriapps' ),
				'type' => Controls_Manager::NUMBER,
				'min' => 0,
				'max' => 5,
				'step' => 1,
				'default' => 5,
			]
		);

		$this->add_control(
		    'testi_slider',
		    [
		        'label'       => '',
		        'type'        => Controls_Manager::REPEATER,
		        'show_label'  => false,
		        'default'     => [
		            [		             	
		                'image'  => [
							'url' => Utils::get_placeholder_image_src(),
						],
						'content' => __( 'Create and manage top-performing social campaigns and start.', 'valkiriapps' ),
		 
		            ],
		            [
		                'image'  => [
							'url' => Utils::get_placeholder_image_src(),
						],
						'content' => __( 'Create and manage top-performing social campaigns and start.', 'valkiriapps' ),
		 
		            ],
		            [
		                'image'  => [
							'url' => Utils::get_placeholder_image_src(),
						],
						'content' => __( 'Create and manage top-performing social campaigns and start.', 'valkiriapps' ),
		 
		            ]
		            
		        ],
		        'fields'      => $repeater->get_controls(),
		        'title_field' => '{{{title}}}',
		    ]
		);
		$this->add_control(
			'tshow',
			[
				'label' => __( 'Slides to Show', 'valkiriapps' ),
				'type' => Controls_Manager::SELECT,
				'default' => '4',
				'options' => [
					'1' => __( '1', 'valkiriapps' ),
					'2' => __( '2', 'valkiriapps' ),
					'3' => __( '3', 'valkiriapps' ),
					'4' => __( '4', 'valkiriapps' ),
					'5' => __( '5', 'valkiriapps' ),
				]
			]
		);
		$this->add_control(
			'scroll',
			[
				'label' => __( 'Slides to Scroll', 'valkiriapps' ),
				'type' => Controls_Manager::SELECT,
				'default' => __( '3', 'valkiriapps' ),
				'options' => [
					'1' => __( '1', 'valkiriapps' ),
					'2' => __( '2', 'valkiriapps' ),
					'3' => __( '3', 'valkiriapps' ),
					'4' => __( '4', 'valkiriapps' ),
					'5' => __( '5', 'valkiriapps' ),
				]
			]
		);
		$this->add_control(
			'tarrow',
			[
				'label' => __( 'Nav Slider', 'valkiriapps' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'true',
				'options' => [
					'true' => __( 'Yes', 'valkiriapps' ),
					'false' => __( 'No', 'valkiriapps' ),
				]
			]
		);
		$this->add_control(
			'tdots',
			[
				'label' => __( 'Dots Slider', 'valkiriapps' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'false',
				'options' => [
					'true' => __( 'Yes', 'valkiriapps' ),
					'false' => __( 'No', 'valkiriapps' ),
				]
			]
		);
		$this->add_control(
			'autoplay',
			[
				'label' 	=> __( 'Autoplay', 'valkiriapps' ),
				'type' 		=> Controls_Manager::SELECT,
				'default' 	=> 'false',
				'options' 	=> [
					'true' 	=> __( 'Yes', 'valkiriapps' ),
					'false' => __( 'No', 'valkiriapps' ),
				]
			]
		);
		$this->add_control(
			'autoplaySpeed',
			[
				'label' 	=> __( 'Autoplay Speed', 'valkiriapps' ),
				'type' 		=> Controls_Manager::NUMBER,
				'min' 		=> 1000,
				'max' 		=> 10000,
				'step' 		=> 100,
				'default' 	=> 6000,
				'condition' => [
					'autoplay' => 'true',
				]
			]
		);

		$this->end_controls_section();

		// Styling.
		$this->start_controls_section(
			'style_tcontent',
			[
				'label' => __( 'Genaral', 'valkiriapps' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_responsive_control(
			'align_tcontent',
			[
				'label' => __( 'Alignment', 'valkiriapps' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left'    => [
						'title' => __( 'Left', 'valkiriapps' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'valkiriapps' ),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => __( 'Right', 'valkiriapps' ),
						'icon' => 'eicon-text-align-right',
					],
					'justify' => [
						'title' => __( 'Justified', 'valkiriapps' ),
						'icon' => 'eicon-text-align-justify',
					],
				],
				'selectors' => [
					'{{WRAPPER}} .testi-item' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'content_bg',
			[
				'label' => __( 'Background Color', 'valkiriapps' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .testi-item' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'content_padding',
			[
				'label' => __( 'Padding', 'valkiriapps' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .testi-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'content_radius',
			[
				'label' => __( 'Border Radius', 'valkiriapps' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .testi-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'content_box_shadow',
				'selector' => '{{WRAPPER}} .testi-item',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'service_style_section',
			[
				'label' => __( 'Heading', 'valkiriapps' ),
				'tab'   => Controls_Manager::TAB_STYLE,
				'condition' => [
					'show_title' => 'yes',
				]
			]
		);

		//Subtitle
		$this->add_control(
			'heading_stitle',
			[
				'label' => __( 'Subtitle', 'valkiriapps' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_responsive_control(
			'stitle_bottom_space',
			[
				'label' => __( 'Spacing', 'valkiriapps' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .ot-heading > span' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'stitle_color',
			[
				'label' => __( 'Color', 'valkiriapps' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .ot-heading > span' => 'color: {{VALUE}};',
				]
			]
		);
		$this->add_control(
			'stitle_dots',
			[
				'label'   => esc_html__( 'Is Dots', 'valkiriapps' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => '',
			]
		);
		$this->add_responsive_control(
			'dots_space',
			[
				'label' => __( 'Spacing', 'valkiriapps' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .ot-heading .stitle-dots:before' => 'left: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .ot-heading .stitle-dots:after' => 'right: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'stitle_dots'	=> 'yes'
				]
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'stitle_dots_bg',
				'label' => esc_html__( 'Color', 'valkiriapps' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .ot-heading .stitle-dots:before, {{WRAPPER}} .ot-heading .stitle-dots:after',
				'condition' => [
					'stitle_dots'	=> 'yes'
				]
			]
		);
		$this->add_control(
			'stitle_padd',
			[
				'label' => __( 'Padding', 'valkiriapps' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'selectors' => [
					'{{WRAPPER}} .ot-heading > span' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'stitle_radius',
			[
				'label' => __( 'Border Radius', 'valkiriapps' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'selectors' => [
					'{{WRAPPER}} .ot-heading > span' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'stitle_bg',
				'label' => esc_html__( 'Background', 'valkiriapps' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .ot-heading > span',
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'stitle_border',
				'selector' => '{{WRAPPER}} .ot-heading > span',
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'stitle_box_shadow',
				'label' => esc_html__( 'Box Shadow', 'valkiriapps' ),
				'selector' => '{{WRAPPER}} .ot-heading > span',
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'stitle_typography',
				'selector' => '{{WRAPPER}} .ot-heading > span',
			]
		);

		//Title
		$this->add_control(
			'heading_title',
			[
				'label' => __( 'Title', 'valkiriapps' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_control(
			'title_color',
			[
				'label' => __( 'Color', 'valkiriapps' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .ot-heading .main-heading' => 'color: {{VALUE}};',
				]
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'selector' => '{{WRAPPER}} .ot-heading .main-heading',
			]
		);

		//Desc
		$this->add_control(
			'heading_desc',
			[
				'label' => __( 'Description', 'valkiriapps' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_control(
			'desc_color',
			[
				'label' => __( 'Color', 'valkiriapps' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .ot-heading .heading-desc' => 'color: {{VALUE}};',
				]
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'desc_typography',
				'selector' => '{{WRAPPER}} .ot-heading .heading-desc',
			]
		);
		
		$this->end_controls_section();	

		$this->start_controls_section(
			'content_box_style',
			[
				'label' => __( 'Content Box', 'valkiriapps' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'heading_content',
			[
				'label' => __( 'Content', 'valkiriapps' ),
				'type' => Controls_Manager::HEADING,
			]
		);
		$this->add_control(
			'content_color',
			[
				'label' => __( 'Text Color', 'valkiriapps' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .testi-item .ttext' => 'color: {{VALUE}};',
				],
			]
		);	

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'content_typography',
				'selector' => '{{WRAPPER}} .testi-item .ttext',
			]
		);

		$this->add_control(
			'info_style',
			[
				'label' => __( 'Info', 'valkiriapps' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_control(
			'info_color',
			[
				'label' => __( 'Info Color', 'valkiriapps' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tinfo h6' => 'color: {{VALUE}};',
				],
			]
		);	

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'info_typography',
				'selector' => '{{WRAPPER}} .tinfo h6',
			]
		);

		$this->end_controls_section();	

		// Dots.
		$this->start_controls_section(
			'style_dots',
			[
				'label' => __( 'Dots', 'valkiriapps' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'tdots' => 'true'
				]
			]
		);

		$this->add_responsive_control(
			'spacing_dots',
			[
				'label' => __( 'Spacing', 'valkiriapps' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => -200,
						'max' => 200,
					]
				],
				'default' => [
					'unit' => 'px',
					'size' => -50,
				],
				'selectors' => [
					'{{WRAPPER}} .slick-dots' => 'bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'dots_bgcolor',
			[
				'label' => __( 'Background', 'valkiriapps' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .slick-dots li button:before' => 'color: {{VALUE}};',
				]
			]
		);
		$this->add_control(
			'dots_active_bgcolor',
			[
				'label' => __( 'Background Active', 'valkiriapps' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .slick-dots li.slick-active button:before' => 'color: {{VALUE}};',
				]
			]
		);

		$this->end_controls_section();

		// Arrow.
		$this->start_controls_section(
			'style_nav',
			[
				'label' => __( 'Arrow', 'valkiriapps' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'tarrow' => 'true',
				]
			]
		);		
		$this->add_control(
			'size_nav',
			[
				'label' => __( 'Size', 'valkiriapps' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 40,
						'max' => 100,
					],
				],
				'selectors' => [					
					'{{WRAPPER}} .slick-arrow' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',
				]
			]
		);
		
		$this->start_controls_tabs( 'tabs_style_arrow' );
		$this->start_controls_tab(
			'tab_arrow_normal',
			[
				'label' => __( 'Normal', 'valkiriapps' ),
			]
		);
		$this->add_control(
			'arrow_color',
			[
				'label' => __( 'Color', 'valkiriapps' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .slick-arrow svg path' => 'fill: {{VALUE}};',
				]
			]
		);

		$this->add_control(
			'arrow_bgcolor',
			[
				'label' => __( 'Background', 'valkiriapps' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .slick-arrow' => 'background: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_arrow_hover',
			[
				'label' => __( 'Hover', 'valkiriapps' ),
			]
		);
		$this->add_control(
			'arrow_hcolor',
			[
				'label' => __( 'Color Hover', 'valkiriapps' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .slick-arrow:hover svg path' => 'fill: {{VALUE}};',
				]
			]
		);
		$this->add_control(
			'arrow_hbgcolor',
			[
				'label' => __( 'Background Hover', 'valkiriapps' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .slick-arrow:hover' => 'background: {{VALUE}};',
				]
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();	

		$this->end_controls_section();
	}

	protected function get_class_rating( $rating ) {
		$number_rating = [
			'1' => 'one',
			'2' => 'two',
			'3' => 'three',
			'4' => 'four',
			'5' => 'five',
		];
		return isset( $number_rating[ $rating ] ) ? $number_rating[ $rating ] : 'empty';
	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		$css_classes = '';
		$css_classes = $settings['show_title'] === 'yes' ? 'col-md-8' : 'col-md-12';
	?>

		<div class="ot-testimonials-5">
			<div class="container">
				<div class="row">
					<?php if ( 'yes' === $settings['show_title'] ) { ?>
						
					<div class="col-md-4">
						<div class="ot-wrapper-heading">
							<div class="ot-heading">
						        <?php if( !empty($settings['subtitle']) ) { ?>
						        <span class="<?php if( !empty($settings['stitle_dots']) ) { echo esc_attr('stitle-dots'); } ?>"><?php echo $settings['subtitle']; ?></span>
						        <?php }if($settings['title']) echo '<'.$settings['heading_size'].' class="main-heading">'.$settings['title'].'</'.$settings['heading_size'].'>' ?>
						        <p class="heading-desc"><?php echo $settings['description']; ?></p>
						    </div>
						    <?php if ( 'true' === $settings['tarrow'] ) {echo '<div class="testi-slider-nav-1"></div>';} ?>
						</div>
					</div>
							
					<?php } ?>
					<div class="<?php echo esc_attr($css_classes); ?>">
						<div class="testimonials-slider-wrap">	
							<div class="ot-testimonials-slider" <?php if ( is_rtl() ) { echo'dir="rtl"'; } ?> data-show="<?php echo $settings['tshow']; ?>" data-scroll="<?php echo $settings['scroll']; ?>" data-dots="<?php echo $settings['tdots']; ?>" data-arrow="<?php echo $settings['tarrow']; ?>" data-autoplay="<?php echo $settings['autoplay']; ?>" data-autoplaySpeed="<?php echo $settings['autoplaySpeed']; ?>">
								<?php if ( ! empty( $settings['testi_slider'] ) ) : foreach ( $settings['testi_slider'] as $testi_item ) : ?>
								<div>
									<div class="testi-item">
										<?php if($testi_item['image']['url']) { ?>
							        		<img class="image" src="<?php echo $testi_item['image']['url']; ?>" alt="">
							        	<?php } ?>
							        	<hr>
										<div class="ttext">
								        	<?php echo $testi_item['content']; ?>
								        </div>
										<div class="tinfo">
											<span class="ot-ratings <?php echo esc_attr( $this->get_class_rating( $testi_item['rating'] ) ) ?>"></span>
								        	<?php if($testi_item['tjob']) { ?><h6><?php echo $testi_item['tjob']; ?></h6><?php } ?>
							        	</div>	        
									</div>
								</div>
								<?php endforeach; endif; ?>
							</div>
							<?php if ( 'true' === $settings['tarrow'] && 'yes' !== $settings['show_title'] ) { echo '<div class="testi-slider-nav-2"></div>';}?>
						</div>
					</div>
				</div>
			</div>
		</div>

	    <?php
	}
	
}
// After the Valkiriapps_Testimonials5 class is defined, I must register the new widget class with Elementor:
Plugin::instance()->widgets_manager->register( new Valkiriapps_Testimonials5() );