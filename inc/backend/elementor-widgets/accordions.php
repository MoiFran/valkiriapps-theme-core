<?php
namespace Elementor; // Custom widgets must be defined in the Elementor namespace
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly (security measure)

/**
 * Widget Name: Section Heading 
 */
class Valkiriapps_Accordions extends Widget_Base{

 	// The get_name() method is a simple one, you just need to return a widget name that will be used in the code.
	public function get_name() {
		return 'iaccordions';
	}

	// The get_title() method, which again, is a very simple one, you need to return the widget title that will be displayed as the widget label.
	public function get_title() {
		return __( 'Valkiriapps Accordions', 'valkiriapps' );
	}

	// The get_icon() method, is an optional but recommended method, it lets you set the widget icon. you can use any of the eicon or font-awesome icons, simply return the class name as a string.
	public function get_icon() {
		return 'eicon-accordion';
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
				'label' => __( 'Accordions', 'valkiriapps' ),
			]
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'acc_title',
			[
				'label' => __( 'Title & Content', 'valkiriapps' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Accordion Title', 'valkiriapps' ),
				'placeholder' => __( 'Accordion Title', 'valkiriapps' ),
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'acc_content',
			[
				'label' => __( 'Content', 'valkiriapps' ),
				'default' => __( 'Accordion Content', 'valkiriapps' ),
				'placeholder' => __( 'Accordion Content', 'valkiriapps' ),
				'type' => Controls_Manager::WYSIWYG,
				'show_label' => false,
			]
		);

		$this->add_control(
			'ot_accs',
			[
				'label' => __( 'Accordion Items', 'valkiriapps' ),
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'acc_title' => __( 'Accordion #1', 'valkiriapps' ),
						'acc_content' => __( 'We help ambitious businesses like yours generate more profits by building awareness, driving web traffic, connecting with customers, and growing overall sales. Give us a call.', 'valkiriapps' ),
					],
					[
						'acc_title' => __( 'Accordion #2', 'valkiriapps' ),
						'acc_content' => __( 'We help ambitious businesses like yours generate more profits by building awareness, driving web traffic, connecting with customers, and growing overall sales. Give us a call.', 'valkiriapps' ),
					],
				],
				'title_field' => '{{{ acc_title }}}',
			]
		);

		$this->add_control(
			'default_active',
			[
				'label'   => esc_html__( 'Default Active', 'valkiriapps' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes'
			]
		);
		$this->add_control(
			'item_active',
			[
				'label' => esc_html__( 'Item Active', 'valkiriapps' ),
				'type' => Controls_Manager::NUMBER,
				'min' => 1,
				'step' => 1,
				'default' => 1,
				'condition' => [
					'default_active' => 'yes'
				]
			]
		);
		$this->end_controls_section();

		//Style
		$this->start_controls_section(
			'style_section',
			[
				'label' => __( 'Accordions', 'valkiriapps' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'accs_space',
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
					'{{WRAPPER}} .acc-item' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'accs_border',
				'selector' => '{{WRAPPER}} .acc-item',
			]
		);
		$this->add_control(
			'accs_radius',
			[
				'label' => __( 'Border Radius', 'valkiriapps' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .acc-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'accs_box_shadow',
				'selector' => '{{WRAPPER}} .acc-item',
			]
		);

		$this->add_control(
			'heading_accs_bg',
			[
				'label' => __( 'Background', 'valkiriapps' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'accs_bg',
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .acc-item:not(.current)',
			]
		);
		$this->add_control(
			'heading_accs_active',
			[
				'label' => __( 'Background Active', 'valkiriapps' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'accs_bg_active',
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .acc-item.current',
			]
		);

		$this->end_controls_section();

		//Title
		$this->start_controls_section(
			'style_title',
			[
				'label' => __( 'Title', 'valkiriapps' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'title_color',
			[
				'label' => __( 'Color', 'valkiriapps' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .acc-item:not(.current) .acc-toggle' => 'color: {{VALUE}};',
				]
			]
		);
		$this->add_control(
			'title_color_active',
			[
				'label' => __( 'Color Active', 'valkiriapps' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .acc-item.current .acc-toggle' => 'color: {{VALUE}};',
				]
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'selector' => '{{WRAPPER}} .acc-toggle',
			]
		);

		//Icon
		$this->add_control(
			'heading_icon',
			[
				'label' => __( 'Icon', 'valkiriapps' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->start_controls_tabs( 'tabs_icon_style' );

		$this->start_controls_tab(
			'icon_normal',
			[
				'label' => __( 'Normal', 'valkiriapps' ),
			]
		);

		$this->add_control(
			'icon_close',
			[
				'label' => __( 'Icon', 'valkiriapps' ),
				'type' => Controls_Manager::ICONS,
				'label_block' => true,
				'fa4compatibility' => 'icon',
			]
		);
		$this->add_control(
			'icon_bg',
			[
				'label' => __( 'Background', 'valkiriapps' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .acc-item:not(.current) i' => 'background: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'icon_color',
			[
				'label' => __( 'Color', 'valkiriapps' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .acc-item:not(.current) i' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'icon_open',
			[
				'label' => __( 'Active', 'valkiriapps' ),
			]
		);
		
		$this->add_control(
			'icon_active',
			[
				'label' => __( 'Icon', 'valkiriapps' ),
				'type' => Controls_Manager::ICONS,
				'label_block' => true,
				'fa4compatibility' => 'icon',
			]
		);
		$this->add_control(
			'icon_bg_active',
			[
				'label' => __( 'Background', 'valkiriapps' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .acc-item.current i' => 'background: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'icon_color_active',
			[
				'label' => __( 'Color', 'valkiriapps' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .acc-item.current i' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

		//Title
		$this->start_controls_section(
			'style_content',
			[
				'label' => __( 'Content', 'valkiriapps' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'content_color',
			[
				'label' => __( 'Color', 'valkiriapps' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .acc-content' => 'color: {{VALUE}};',
				]
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'content_typography',
				'selector' => '{{WRAPPER}} .acc-content',
			]
		);
		$this->add_responsive_control(
			'content_padding',
			[
				'label' => __( 'Padding', 'valkiriapps' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .acc-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		$icon = $settings['icon_close']['value'] ? $settings['icon_close']['value'] : 'flaticon-download-arrow';
		$icon_active = $settings['icon_active']['value'] ? $settings['icon_active']['value'] : 'flaticon-up-arrow';
		?>

		<div class="ot-accordions">
			<?php if ( $settings['ot_accs'] ) : foreach ( $settings['ot_accs'] as $key => $accs ) { ?>
			<div class="acc-item">
				<span class="acc-toggle" data-default="<?php if( $settings['item_active'] == $key + 1 ) echo esc_attr('yes') ?>"><?php echo $accs['acc_title']; ?> <i class="down <?php echo esc_attr($icon); ?>"></i><i class="up <?php echo esc_attr($icon_active); ?>"></i></span>
				<div class="acc-content">
					<?php echo $accs['acc_content']; ?>
				</div>
			</div>
			<?php } endif; ?>
	    </div>

	    <?php
	}

}
// After the Schedule class is defined, I must register the new widget class with Elementor:
Plugin::instance()->widgets_manager->register( new Valkiriapps_Accordions() );