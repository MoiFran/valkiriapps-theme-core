<?php
namespace Elementor; // Custom widgets must be defined in the Elementor namespace
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly (security measure)

/**
 * Widget Name: Projects Carousel
 */
class Valkiriapps_PortfolioSliders2 extends Widget_Base{

 	// The get_name() method is a simple one, you just need to return a widget name that will be used in the code.
	public function get_name() {
		return 'irprojects2';
	}

	// The get_title() method, which again, is a very simple one, you need to return the widget title that will be displayed as the widget label.
	public function get_title() {
		return __( 'Valkiriapps Portfolio Carousel 2', 'valkiriapps' );
	}

	// The get_icon() method, is an optional but recommended method, it lets you set the widget icon. you can use any of the eicon or font-awesome icons, simply return the class name as a string.
	public function get_icon() {
		return 'eicon-slider-push';
	}

	// The get_categories method, lets you set the category of the widget, return the category name as a string.
	public function get_categories() {
		return [ 'category_valkiriapps' ];
	}

	protected function register_controls() {

		//Content
		$this->start_controls_section(
			'content_section',
			[
				'label' => __( 'Projects', 'valkiriapps' ),
			]
		);
		$this->add_control(
			'project_cat',
			[
				'label' => __( 'Select Categories', 'valkiriapps' ),
				'type' => Controls_Manager::SELECT2,
				'options' => $this->select_param_cate_project(),
				'multiple' => true,
				'label_block' => true,
				'placeholder' => __( 'All Categories', 'valkiriapps' ),
			]
		);
		$this->add_control(
			'project_num',
			[
				'label' => __( 'Show Number Projects', 'valkiriapps' ),
				'type' => Controls_Manager::NUMBER,
				'default' => '9',
			]
		);	
		$this->add_control(
			'heading_slider',
			[
				'label' => __( 'Slider', 'valkiriapps' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_control(
			'center_mode',
			[
				'label' => __( 'Center Mode', 'valkiriapps' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'false',
				'options' => [
					'true' => __( 'Yes', 'valkiriapps' ),
					'false' => __( 'No', 'valkiriapps' ),
				]
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
			'scroll',
			[
				'label' => __( 'Slides to Scroll', 'valkiriapps' ),
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
		$this->add_responsive_control(
			'w_gaps',
			[
				'label' => __( 'Gap Width', 'valkiriapps' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .project-item' => 'padding: 0 calc({{SIZE}}{{UNIT}}/2);',
					'{{WRAPPER}} .project-slider' => 'margin: 0 calc(-{{SIZE}}{{UNIT}}/2);',
				],
			]
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'overlay_style_section',
			[
				'label' => __( 'Info Box', 'valkiriapps' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_responsive_control(
			'overlay_align',
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
				],				
				'selectors' => [
					'{{WRAPPER}} .projects-box .portfolio-info' => 'text-align: {{VALUE}};',
				],
			]
		);
		
		$this->add_responsive_control(
			'overlay_padd',
			[
				'label' => __( 'Padding', 'valkiriapps' ),
				'type' => Controls_Manager::DIMENSIONS,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .projects-box .portfolio-info' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'overlay_radius',
			[
				'label' => __( 'Border Radius', 'valkiriapps' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .projects-box .portfolio-info' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'overlay_background',
				'label' => __( 'Background', 'valkiriapps' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .projects-box .portfolio-info',
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
		$this->add_responsive_control(
			'title_spacing',
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
					'{{WRAPPER}} .projects-box .portfolio-info h5' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'title_color',
			[
				'label' => __( 'Color', 'valkiriapps' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .projects-box .portfolio-info h5 a' => 'color: {{VALUE}};',
				]
			]
		);
		$this->add_control(
			'title_hcolor',
			[
				'label' => __( 'Hover', 'valkiriapps' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .projects-box .portfolio-info h5 a:hover' => 'color: {{VALUE}};',
				]
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'selector' => '{{WRAPPER}} .projects-box .portfolio-info h5 a',
			]
		);

		//Category
		$this->add_control(
			'heading_overlay',
			[
				'label' => __( 'Category', 'valkiriapps' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_control(
			'show_cat',
			[
				'label' => __( 'Show Category', 'valkiriapps' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'valkiriapps' ),
				'label_off' => __( 'Hide', 'valkiriapps' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
		
		$this->add_control(
			'cat_color',
			[
				'label' => __( 'Color', 'valkiriapps' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .projects-box .portfolio-info .portfolio-cates a, {{WRAPPER}} .projects-box .portfolio-info .portfolio-cates span' => 'color: {{VALUE}};',
				],
				'condition' => [
					'show_cat' => 'yes',
				]
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'cat_typography',
				'selector' => '{{WRAPPER}} .projects-box .portfolio-info .portfolio-cates a, {{WRAPPER}} .projects-box .portfolio-info .portfolio-cates span',
				'condition' => [
					'show_cat' => 'yes',
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
		$this->add_responsive_control(
			'spacing_nav',
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
			'arrow_bgcolor',
			[
				'label' => __( 'Background', 'valkiriapps' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .slick-arrow' => 'background: {{VALUE}};',
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
			'dots_color',
			[
				'label' => __( 'Color', 'valkiriapps' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .slick-dots li button:before' => 'color: {{VALUE}};',
				]
			]
		);
		$this->add_control(
			'dots_hcolor',
			[
				'label' => __( 'Color Active', 'valkiriapps' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .slick-dots li.slick-active button:before' => 'color: {{VALUE}};',
				]
			]
		);

		$this->end_controls_section();

	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		$showpost = (!empty($settings['project_num']) ? $settings['project_num'] : 9 )
		?>
		<div class="project-slider" data-center="<?php echo $settings['center_mode']; ?>" data-show="<?php echo $settings['tshow']; ?>" data-scroll="<?php echo $settings['scroll']; ?>" data-arrow="<?php echo $settings['tarrow']; ?>" data-dots="<?php echo $settings['tdots']; ?>">
			<?php 
				if( $settings['project_cat'] ){
	                $args = array(	                    
	                    'post_type' => 'ot_portfolio',
	                    'post_status' => 'publish',
	                    'posts_per_page' => $settings['project_num'],
	                    'tax_query' => array(
	                        array(
	                            'taxonomy' => 'portfolio_cat',
	                            'field' => 'slug',
	                            'terms' => $settings['project_cat'],
	                        ),
	                    ),              
	                );
	            }else{
	                $args = array(
	                    'post_type' => 'ot_portfolio',
	                    'post_status' => 'publish',
	                    'posts_per_page' => $settings['project_num'],
	                );
	            }			
				$wp_query = new \WP_Query($args);					
				while ($wp_query -> have_posts()) : $wp_query -> the_post(); 
			?>
			<div class="project-item projects-style-3">
				<div class="projects-box">
					<div class="projects-thumbnail">
						<a href="<?php the_permalink(); ?>">
							<?php
								if ( has_post_thumbnail() ) {
									the_post_thumbnail( 'valkiriapps-portfolio-thumbnail-carousel');		
								}
							?>
							<span class="overlay"><i class="flaticon-right-arrow-1"></i></span>
						</a>
					</div>
					<div class="portfolio-info full-width">
						<div class="portfolio-info-inner">
							<h5><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
							<?php 
								if( 'yes' === $settings['show_cat'] ) {
									$terms = get_the_terms( get_the_ID(), 'portfolio_cat' );	
									if ( ! is_wp_error( $terms ) && ! empty( $terms ) ) :
										echo '<p class="portfolio-cates">';	 
									    foreach ( $terms as $term ) {
									    	// The $term is an object, so we don't need to specify the $taxonomy.
							    			$term_link = get_term_link( $term );
							    			// If there was an error, continue to the next term.
										    if ( is_wp_error( $term_link ) ) {
										        continue;
										    }
									        // We successfully got a link. Print it out.
							    			echo '<a href="' . esc_url( $term_link ) . '">' . $term->name . '</a><span>/ </span>';
									    }		                         
									    
										echo '</p>';    
									endif; 
								}
							?> 
						</div>
					</div>
				</div>
			</div>

			<?php endwhile; wp_reset_postdata(); ?>
	    </div>
	    <?php
	}

	protected function content_template() {}

	protected function select_param_cate_project() {
	  	$category = get_terms( 'portfolio_cat' );
	  	$cat = array();
	  	foreach( $category as $item ) {
	     	if( $item ) {
	        	$cat[$item->slug] = $item->name;
	     	}
	  	}
	  	return $cat;
	}
}
// After the Valkiriapps_PortfolioSliders2 class is defined, I must register the new widget class with Elementor:
Plugin::instance()->widgets_manager->register( new Valkiriapps_PortfolioSliders2() );