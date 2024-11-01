<?php 
namespace Elementor; // Custom widgets must be defined in the Elementor namespace
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly (security measure)

/**
 * Widget Name: News Grid
 */
class Valkiriapps_Post_Grid extends Widget_Base{

 	// The get_name() method is a simple one, you just need to return a widget name that will be used in the code.
	public function get_name() {
		return 'ipost_grid';
	}

	// The get_title() method, which again, is a very simple one, you need to return the widget title that will be displayed as the widget label.
	public function get_title() {
		return __( 'Valkiriapps Post Grid', 'valkiriapps' );
	}

	// The get_icon() method, is an optional but recommended method, it lets you set the widget icon. you can use any of the eicon or font-awesome icons, simply return the class name as a string.
	public function get_icon() {
		return 'eicon-gallery-grid';
	}

	// The get_categories method, lets you set the category of the widget, return the category name as a string.
	public function get_categories() {
		return [ 'category_valkiriapps' ];
	}

	protected function register_controls() {

		//Content Service box
		$this->start_controls_section(
			'content_section',
			[
				'label' => __( 'Post Grid', 'valkiriapps' ),
			]
		);

		$this->add_control(
			'post_cat',
			[
				'label' => __( 'Select Categories', 'valkiriapps' ),
				'type' => Controls_Manager::SELECT2,
				'options' => $this->select_param_cate_post(),
				'multiple' => true,
				'label_block' => true,
				'placeholder' => __( 'All Categories', 'valkiriapps' ),
			]
		);
		$this->add_control(
			'column',
			[
				'label' => __( 'Columns', 'valkiriapps' ),
				'type' => Controls_Manager::SELECT,
				'default' => '3',
				'options' => [
					'2'  	=> __( '2 Column', 'valkiriapps' ),
					'3' 	=> __( '3 Column', 'valkiriapps' ),
					'4' 	=> __( '4 Column', 'valkiriapps' ),
					'5' 	=> __( '5 Column', 'valkiriapps' ),
				],
			]
		);	
		$this->add_control(
			'number_show',
			[
				'label' => __( 'Show Number Posts', 'valkiriapps' ),
				'type' => Controls_Manager::NUMBER,
				'default' => '3',
			]
		);	
		$this->add_control(
			'excerpt',
			[
				'label' => __( 'Show Excerpt', 'valkiriapps' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'valkiriapps' ),
				'label_off' => __( 'Hide', 'valkiriapps' ),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);
        $this->add_control(
			'detail_btn',
			[
				'label' => 'Button',
				'type' => Controls_Manager::TEXTAREA,
				'default' => __( '<i class="flaticon-right-arrow-1"></i>LEARN MORE', 'valkiriapps' ),
			]
		);

		$this->end_controls_section();

		/*Style*/
		$this->start_controls_section(
			'style_section',
			[
				'label' => __( 'General', 'valkiriapps' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_responsive_control(
			'info_padd',
			[
				'label' => __( 'Padding', 'valkiriapps' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'selectors' => [
					'{{WRAPPER}} .post-box .inner-post' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'info_border',
			[
				'label' => __( 'Border Color', 'valkiriapps' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .post-box .inner-post' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();

		//Content Style
		$this->start_controls_section(
			'content_style',
			[
				'label' => __( 'Content', 'valkiriapps' ),
				'tab'   => Controls_Manager::TAB_STYLE
			]
		);
		$this->add_control(
			'heading_meta',
			[
				'label' => __( 'Entry Meta', 'valkiriapps' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_responsive_control(
			'meta_spacing',
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
					'{{WRAPPER}} .post-box .entry-meta' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'meta_typography',
				'selector' => '{{WRAPPER}} .post-box .entry-meta',
			]
		);

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
					'{{WRAPPER}} .post-box .inner-post h3' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'selector' => '{{WRAPPER}} .post-box .inner-post h3',
			]
		);

		$this->add_control(
			'heading_exc',
			[
				'label' => __( 'Excerpt', 'valkiriapps' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => [
					'excerpt' => 'yes',
				]
			]
		);
		$this->add_responsive_control(
			'exc_spacing',
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
					'{{WRAPPER}} .post-box .the-excerpt' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'excerpt' => 'yes',
				]
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'exc_typography',
				'selector' => '{{WRAPPER}} .post-box .the-excerpt',
				'condition' => [
					'excerpt' => 'yes',
				]
			]
		);

		$this->end_controls_section();

		//Button
		$this->start_controls_section(
			'btn_section',
			[
				'label' => __( 'Button', 'valkiriapps' ),
				'tab'   => Controls_Manager::TAB_STYLE,
				'condition' => [
					'detail_btn[value]!' => '',
				]
			]
		);
		$this->add_control(
			'btn_readmore_color',
			[
				'label' => __( 'Color', 'valkiriapps' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .btn-readmore a' => 'color: {{VALUE}};',
				]
			]
		);
		$this->add_control(
			'btn_readmore_color_hover',
			[
				'label' => __( 'Color Hover', 'valkiriapps' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .btn-readmore a:hover' => 'color: {{VALUE}};',
				]
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'btn_readmore_typography',
				'selector' => '{{WRAPPER}} .btn-readmore a'
			]
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		?>

		<div class="post-grid pgrid row <?php if( $settings['column'] == '5' ){ echo ' pf_5_cols'; }elseif( $settings['column'] == '4' ){ echo ' pf_4_cols'; }elseif( $settings['column'] == '2' ){ echo ' pf_2_cols'; }else{ echo ''; } ?>">
			<?php
			$number_show = (!empty($settings['number_show']) ? $settings['number_show'] : 9);
			$exc = (!empty($settings['exc']) ? $settings['exc'] : 15);

			if( $settings['post_cat'] ){
				$args = array(
					'post_type' => 'post',
					'post_status' => 'publish',
					'posts_per_page' => $number_show,
					'tax_query' => array(
						array(
							'taxonomy' => 'category',
							'field'    => 'slug',
							'terms'    => $settings['post_cat']
						),
					),
				);
			}else{
				$args = array(
					'post_type' => 'post',
					'post_status' => 'publish',
					'posts_per_page' => $number_show,
				);
			}

			$blogpost = new \WP_Query($args);
			if ( $blogpost->have_posts() ) : while ( $blogpost->have_posts() ) : $blogpost->the_post(); ?> 
				<div class="pgrid-box">
				<article class="post-box blog-item">
					<div class="post-inner">
						<?php 
							$format = get_post_format();
							$link_video  = get_post_meta(get_the_ID(),'post_video', true);
							$link_audio  = get_post_meta(get_the_ID(),'post_audio', true);
							$link_link   = get_post_meta(get_the_ID(),'post_link', true);
							$text_link   = get_post_meta(get_the_ID(),'text_link', true);
							$quote_text  = get_post_meta(get_the_ID(),'post_quote', true);
							$quote_name  = get_post_meta(get_the_ID(),'quote_name', true);
						?>
						<?php if ( $format == 'gallery' ) { ?>

							<div class="entry-media">
								<?php valkiriapps_posted_in(); ?>
								<div class="gallery-post img-slider">
								<?php if( function_exists( 'rwmb_meta' ) ) { ?>
						            <?php $images = rwmb_meta( 'post_gallery', array( 'size' => 'valkiriapps-slider-post-thumbnail' ) ); ?>
						            <?php if($images){ ?>              
						                <?php foreach ( $images as $image ) {  ?>		                    
						                    <div>
						                    	<div class="item-image">
							                    	<img src="<?php echo esc_url( $image['url'] ); ?>" alt="<?php echo esc_attr( $image['alt'] ); ?>" width="<?php echo esc_attr( $image['width'] ); ?>" height="<?php echo esc_attr( $image['height'] ); ?>">
							                    </div>
						                    </div>
						                <?php } ?>                
						            <?php } ?>
						        <?php } ?>
						        </div>
							</div>			

					    <?php } elseif ( $format == 'image' ) { ?>

					    	<div class="entry-media">
								<?php valkiriapps_posted_in(); ?>
								<?php if( function_exists( 'rwmb_meta' ) ) { ?>
								    <?php $images = rwmb_meta( 'post_image', array( 'size' => 'valkiriapps-slider-post-thumbnail' ) ); ?>
								    <?php if($images){ ?>              
								        <?php foreach ( $images as $image ) {  ?>				            
								            <a href="<?php the_permalink(); ?>">
								            	<img src="<?php echo esc_url( $image['url'] ); ?>" alt="<?php echo esc_attr( $image['alt'] ); ?>" width="<?php echo esc_attr( $image['width'] ); ?>" height="<?php echo esc_attr( $image['height'] ); ?>">
								            </a>
								        <?php } ?>                
								    <?php } ?>
								<?php } ?>
							</div>
							
					    <?php } elseif ( $format == 'audio' ){ ?>
							<div class="entry-media">
					        	<?php valkiriapps_posted_in(); ?>
					        </div>
							<div class="audio-box padding-box">
								<iframe scrolling="no" frameborder="no" src="<?php echo esc_url( $link_audio ); ?>"></iframe>
							</div>

					    <?php } elseif ( $format == 'video' ){ ?>

							<div class="entry-media">
								<?php valkiriapps_posted_in(); ?>
								<?php if( function_exists( 'rwmb_meta' ) ) { ?>
								    <?php $images = rwmb_meta( 'bg_video', array( 'size' => 'valkiriapps-slider-post-thumbnail' ) ); ?>
								    <?php if($images){ ?>             
								    	<a class="btn-play" href="<?php echo esc_url( $link_video ); ?>">
											<i class="flaticon-play"></i>
										</a> 
								        <?php foreach ( $images as $image ) {  ?>
								            <img src="<?php echo esc_url( $image['url'] ); ?>" alt="<?php echo esc_attr( $image['alt'] ); ?>" width="<?php echo esc_attr( $image['width'] ); ?>" height="<?php echo esc_attr( $image['height'] ); ?>">
								        <?php } ?>                
								    <?php } ?>
								<?php } ?>
							</div>

					    <?php } elseif ( $format == 'link' ){ ?>
							<div class="entry-media">
					        	<?php valkiriapps_posted_in(); ?>
					        </div>
							<div class="link-box padding-box">
								<i class="flaticon-chain"></i>
								<a href="<?php echo esc_url( $link_link ); ?>"><?php echo esc_html( $text_link ); ?></a>
							</div>

					    <?php } elseif ( $format == 'quote' ){ ?>
							<div class="entry-media">
					        	<?php valkiriapps_posted_in(); ?>
					        </div>
							<div class="quote-box padding-box font-second">
								<i class="flaticon-edit-tools-1"></i>
								<div class="quote-text">
									<?php echo esc_html( $quote_text ); ?>
									<span><?php echo esc_html( $quote_name ); ?></span>
								</div>
							</div>

					    <?php } elseif ( has_post_thumbnail() ) { ?>

					        <div class="entry-media">
					        	<?php valkiriapps_posted_in(); ?>
					            <a href="<?php the_permalink(); ?>">
					                <?php the_post_thumbnail('valkiriapps-slider-post-thumbnail'); ?>
					            </a>
					        </div>
					        
					    <?php } else { ?>
							
							<div class="entry-media">
					        	<?php valkiriapps_posted_in(); ?>
					        </div>

					    <?php } ?>

						<div class="inner-post">
							<div class="entry-header">

								<?php if ( 'post' === get_post_type() ) : if( valkiriapps_get_option( 'post_entry_meta' ) ) { ?>
								<div class="entry-meta">
									<?php valkiriapps_post_meta(); ?>
								</div><!-- .entry-meta -->
								<?php } endif; ?>

								<?php the_title( '<h3 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h3>' ); ?>

							</div><!-- .entry-header -->
							
							<?php if( $settings['excerpt'] == 'yes' ) { ?>
							<div class="entry-summary the-excerpt">

					            <?php the_excerpt(); ?>

					        </div><!-- .entry-content -->
							<?php } ?>
							<div class="btn-readmore">
								<?php if( $settings['detail_btn'] ){ ?><a href="<?php the_permalink(); ?>"><?php echo $settings['detail_btn']; ?></a><?php } ?>
							</div>
						</div>
					</div>
				</article>
				</div>
			<?php endwhile; wp_reset_postdata(); endif; ?>
	    </div>
		<?php
	}

	protected function select_param_cate_post() {
		$args = array( 'orderby=name&order=ASC&hide_empty=0' );
		$terms = get_terms( 'category', $args );
		$cat = array();
		if ( ! empty( $terms ) && ! is_wp_error( $terms ) ){		    
		    foreach ( $terms as $term ) {
		        $cat[$term->slug] = $term->name;
		    }
		}
	  	return $cat;
	}
}
// After the Valkiriapps_Post_Grid class is defined, I must register the new widget class with Elementor:
Plugin::instance()->widgets_manager->register( new Valkiriapps_Post_Grid() );