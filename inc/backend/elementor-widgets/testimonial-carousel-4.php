<?php
namespace Elementor; // Custom widgets must be defined in the Elementor namespace
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly (security measure)

/**
 * Widget Name: Testimonial Slider
 */
class Valkiriapps_Testimonials4 extends Widget_Base{

 	// The get_name() method is a simple one, you just need to return a widget name that will be used in the code.
	public function get_name() {
		return 'itestimonials4';
	}

	// The get_title() method, which again, is a very simple one, you need to return the widget title that will be displayed as the widget label.
	public function get_title() {
		return __( 'Valkiriapps Testimonial Slider 4', 'valkiriapps' );
	}

	// The get_icon() method, is an optional but recommended method, it lets you set the widget icon. you can use any of the eicon or font-awesome icons, simply return the class name as a string.
	public function get_icon() {
		return 'eicon-testimonial-carousel';
	}

	// The get_categories method, lets you set the category of the widget, return the category name as a string.
	public function get_categories() {
		return [ 'category_valkiriapps' ];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'section_testimonials',
			[
				'label' => __( 'Testimonials', 'valkiriapps' ),
			]
		);
		$repeater = new Repeater();
		$repeater->add_control(
			'ticon',
			[
				'label' => __( 'Image', 'valkiriapps' ),
				'type' => Controls_Manager::MEDIA,
				'default' => []
			]
		);

		$repeater->add_control(
			'tcontent',
			[
				'label' => __( 'Content', 'valkiriapps' ),
				'type' => Controls_Manager::TEXTAREA,
				'rows' => '10',
				'default' => '"I am so happy, my dear friend, so absorbed in the exquisite sense of mere tranquil existence, that I neglect my talents. I should be incapable of drawing a single stroke at the present moment."',
			]
		);

		$repeater->add_control(
			'timage',
			[
				'label' => __( 'Avatar', 'valkiriapps' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				]
			]
		);

		$repeater->add_control(
			'title',
			[
				'label' => __( 'Name', 'valkiriapps' ),
				'type' => Controls_Manager::TEXT,
				'default' => 'Emilia Clarke',
			]
		);

		$repeater->add_control(
			'tjob',
			[
				'label' => __( 'Job/Address', 'valkiriapps' ),
				'type' => Controls_Manager::TEXT,
				'default' => 'Developer',
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
		             	'tcontent' => __( '"I am so happy, my dear friend, so absorbed in the exquisite sense of mere tranquil existence, that I neglect my talents. I should be incapable of drawing a single stroke at the present moment."', 'valkiriapps' ),
		                'timage'  => [
							'url' => '',
						],
						'title'	  => 'Emilia Clarke',
						'tjob'	  => 'Developer'
		            ],
		            [
		             	'tcontent' => __( '"I am so happy, my dear friend, so absorbed in the exquisite sense of mere tranquil existence, that I neglect my talents. I should be incapable of drawing a single stroke at the present moment."', 'valkiriapps' ),
		                'timage'  => [
							'url' => '',
						],
						'title'	  => 'Emilia Clarke',
						'tjob'	  => 'Developer'
		            ],
		            [
		             	'tcontent' => __( '"I am so happy, my dear friend, so absorbed in the exquisite sense of mere tranquil existence, that I neglect my talents. I should be incapable of drawing a single stroke at the present moment."', 'valkiriapps' ),
		                'timage'  => [
							'url' => '',
						],
						'title'	  => 'Emilia Clarke',
						'tjob'	  => 'Developer'
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
				'default' => '2',
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
			'tscroll',
			[
				'label' => __( 'Slides to Scroll', 'valkiriapps' ),
				'type' => Controls_Manager::SELECT,
				'default' => '1',
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
				'default' => 'false',
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
				'default' => 'true',
				'options' => [
					'true' => __( 'Yes', 'valkiriapps' ),
					'false' => __( 'No', 'valkiriapps' ),
				]
			]
		);

		$this->end_controls_section();

		// Styling.
		$this->start_controls_section(
			'style_tcontent',
			[
				'label' => __( 'General', 'valkiriapps' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'heading_cbox',
			[
				'label' => __( 'Content Box', 'valkiriapps' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_control(
			'tcontent_bg',
			[
				'label' => __( 'Background Color', 'valkiriapps' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .ot-testimonials-4 .ttext' => 'background: {{VALUE}};',
					'{{WRAPPER}} .ot-testimonials-4 .ttext:after' => 'background: {{VALUE}}; border-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'tcontent_color',
			[
				'label' => __( 'Text Color', 'valkiriapps' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .ot-testimonials-4 .ttext' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'content_typography',
				'selector' => '{{WRAPPER}} .ot-testimonials-4 .ttext',
			]
		);

		$this->add_control(
			'tcontent_padding',
			[
				'label' => __( 'Padding', 'valkiriapps' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .ot-testimonials-4 .ttext' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'tcontent_radius',
			[
				'label' => __( 'Border Radius', 'valkiriapps' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .ttext' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		// Icon Image.
		$this->start_controls_section(
			'style_ticon',
			[
				'label' => __( 'Icon Image', 'valkiriapps' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'spacing_ticon',
			[
				'label' => __( 'Spacing', 'valkiriapps' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .ticon' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'ticon_size',
			[
				'label' => __( 'Size', 'valkiriapps' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 10,
						'max' => 300,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .ticon' => 'max-width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		// Image.
		$this->start_controls_section(
			'style_timage',
			[
				'label' => __( 'Avatars', 'valkiriapps' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'spacing_img',
			[
				'label' => __( 'Spacing', 'valkiriapps' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 200,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .t-head img' => 'margin-right: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'image_size',
			[
				'label' => __( 'Size', 'valkiriapps' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 20,
						'max' => 200,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .t-head img' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'image_border_radius',
			[
				'label' => __( 'Border Radius', 'valkiriapps' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .t-head img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		// Name.
		$this->start_controls_section(
			'style_tname',
			[
				'label' => __( 'Name', 'valkiriapps' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'name_color',
			[
				'label' => __( 'Text Color', 'valkiriapps' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .ot-testimonials-4 h6' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'name_typography',
				'selector' => '{{WRAPPER}} .ot-testimonials-4 h6',
			]
		);

		$this->add_control(
			'spacing_name',
			[
				'label' => __( 'Spacing', 'valkiriapps' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 200,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .ot-testimonials-4 h6' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		// Job/Address.
		$this->start_controls_section(
			'style_tjob',
			[
				'label' => __( 'Job/Address', 'valkiriapps' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'job_color',
			[
				'label' => __( 'Text Color', 'valkiriapps' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .ot-testimonials-4 span' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'job_typography',
				'selector' => '{{WRAPPER}} .ot-testimonials-4 span',
			]
		);		

		$this->end_controls_section();

		// Dots.
		$this->start_controls_section(
			'style_dots',
			[
				'label' => __( 'Dots', 'valkiriapps' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'spacing_dots',
			[
				'label' => __( 'Spacing', 'valkiriapps' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => -200,
						'max' => 200,
					],
					'%' => [
						'min' => -100,
						'max' => 200,
					],
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
					'{{WRAPPER}} .slick-dots button:before' => 'color: {{VALUE}};',
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
					'{{WRAPPER}} .slick-active button:before' => 'color: {{VALUE}};',
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
			'spacing_nav',
			[
				'label' => __( 'Spacing', 'valkiriapps' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => -200,
						'max' => 200,
					],
					'%' => [
						'min' => -100,
						'max' => 200,
					],
				],
				'selectors' => [					
					'{{WRAPPER}} .prev-nav' => 'left: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .next-nav' => 'right: {{SIZE}}{{UNIT}};',
				]
			]
		);
		$this->add_control(
			'arrow_color',
			[
				'label' => __( 'Color', 'valkiriapps' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .slick-arrow' => 'color: {{VALUE}};',
				]
			]
		);
		$this->add_control(
			'arrow_hcolor',
			[
				'label' => __( 'Hover Color', 'valkiriapps' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .slick-arrow:hover' => 'color: {{VALUE}};',
				]
			]
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		?>

		<div class="ot-testimonials-4">						
			<div class="testimonial-inner ot-testimonials-slider" data-show="<?php echo $settings['tshow']; ?>" data-scroll="<?php echo $settings['tscroll']; ?>" data-dots="<?php echo $settings['tdots']; ?>" data-arrow="<?php echo $settings['tarrow']; ?>">
				<?php if ( ! empty( $settings['testi_slider'] ) ) : foreach ( $settings['testi_slider'] as $testi ) : ?>
				<div>
					<div class="testi-item">
						<div class="ttext">
							<?php if($testi['ticon']['url']) { ?>
				        		<img class="ticon" src="<?php echo $testi['ticon']['url']; ?>" alt="">
				        	<?php } ?>
				        	<?php echo $testi['tcontent']; ?>
				        </div>
						<div class="t-head flex-middle">
							<?php if($testi['timage']['url']) { ?>
				        		<img src="<?php echo $testi['timage']['url']; ?>" alt="<?php echo $testi['title']; ?>">
				        	<?php } ?>
				        	<div class="tinfo">
				        		<h6><?php echo $testi['title']; ?></h6>
				        		<?php if($testi['tjob']) { ?><span><?php echo $testi['tjob']; ?></span><?php } ?>
				        	</div>
			        	</div>
				        
		        	</div>
				</div>
				<?php endforeach; endif; ?>
			</div>				
	    </div>

	    <?php
	}

	protected function content_template() {}
}
// After the Valkiriapps_Testimonials4 class is defined, I must register the new widget class with Elementor:
Plugin::instance()->widgets_manager->register( new Valkiriapps_Testimonials4() );