<?php
namespace Elementor; // Custom widgets must be defined in the Elementor namespace
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly (security measure)

/**
 * Widget Name: Contact Info
 */
class Valkiriapps_CountDown extends Widget_Base{

 	// The get_name() method is a simple one, you just need to return a widget name that will be used in the code.
	public function get_name() {
		return 'icountdown';
	}

	// The get_title() method, which again, is a very simple one, you need to return the widget title that will be displayed as the widget label.
	public function get_title() {
		return __( 'Valkiriapps CountDown', 'valkiriapps' );
	}

	// The get_icon() method, is an optional but recommended method, it lets you set the widget icon. you can use any of the eicon or font-awesome icons, simply return the class name as a string.
	public function get_icon() {
		return 'eicon-countdown';
	}

	// The get_categories method, lets you set the category of the widget, return the category name as a string.
	public function get_categories() {
		return [ 'category_valkiriapps' ];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'content_section',
			[
				'label' => __( 'CountDown', 'valkiriapps' ),
			]
		);

		$this->add_responsive_control(
			'align',
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
				// 'prefix_class' => 'valkiriapps%s-align-',
				'selectors' => [
					'{{WRAPPER}}' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'date',
			[
				'label' => 'Date - Time',
				'type' => Controls_Manager::DATE_TIME,
				'default' => gmdate( 'Y-m-d H:i', strtotime( '+1 month' ) + ( get_option( 'gmt_offset' ) * HOUR_IN_SECONDS ) ),
			]
		);

		$this->add_control(
			'zone',
			[
				'label' => __( 'UTC Timezone Offset', 'valkiriapps' ),
				'type' => Controls_Manager::NUMBER,
				'default' => __( '0', 'valkiriapps' ),
			]
		);

		$this->start_controls_tabs( 'tabs_titles' );

		$this->start_controls_tab(
			'tab_title_normal',
			[
				'label' => __( 'One', 'valkiriapps' ),
			]
		);
		$this->add_control(
			'day',
			[
				'label' => __( 'Day', 'valkiriapps' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Day', 'valkiriapps' ),
			]
		);
		$this->add_control(
			'hour',
			[
				'label' => __( 'Hour', 'valkiriapps' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Hour', 'valkiriapps' ),
			]
		);
		$this->add_control(
			'min',
			[
				'label' => __( 'Minute', 'valkiriapps' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Minute', 'valkiriapps' ),
			]
		);
		$this->add_control(
			'second',
			[
				'label' => __( 'Second', 'valkiriapps' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Second', 'valkiriapps' ),
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_title_active',
			[
				'label' => __( 'Multi', 'valkiriapps' ),
			]
		);
		$this->add_control(
			'days',
			[
				'label' => __( 'Days', 'valkiriapps' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Days', 'valkiriapps' ),
			]
		);
		$this->add_control(
			'hours',
			[
				'label' => __( 'Hours', 'valkiriapps' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Hours', 'valkiriapps' ),
			]
		);
		$this->add_control(
			'mins',
			[
				'label' => __( 'Minutes', 'valkiriapps' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Minutes', 'valkiriapps' ),
			]
		);
		$this->add_control(
			'seconds',
			[
				'label' => __( 'Seconds', 'valkiriapps' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Seconds', 'valkiriapps' ),
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

		$this->start_controls_section(
			'style_content_section',
			[
				'label' => __( 'Style', 'valkiriapps' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		//Number
		$this->add_control(
			'heading_number',
			[
				'label' => __( 'Number', 'valkiriapps' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_control(
			'number_view',
			[
				'label' => esc_html__( 'View', 'valkiriapps' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'default' => esc_html__( 'Default', 'valkiriapps' ),
					'stacked' => esc_html__( 'Stacked', 'valkiriapps' ),
				],
				'default' => 'default',
			]
		);
		$this->add_responsive_control(
			'number_space',
			[
				'label' => __( 'Spacing', 'valkiriapps' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 200,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .ot-countdown li span' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'num_padding',
			[
				'label' => __( 'Padding', 'progrisaas' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .ot-countdown li span' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'number_view' => 'stacked',
				],
			]
		);
		$this->add_responsive_control(
			'num_border_radius',
			[
				'label' => __( 'Border Radius', 'progrisaas' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .ot-countdown li span' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'number_view' => 'stacked',
				],
			]
		);
		$this->add_control(
			'number_bgcolor',
			[
				'label' => __( 'Background', 'valkiriapps' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .ot-countdown li span' => 'background-color: {{VALUE}};',
				],
				'condition' => [
					'number_view' => 'stacked',
				],
			]
		);
		$this->add_control(
			'number_color',
			[
				'label' => __( 'Color', 'valkiriapps' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .ot-countdown li span' => 'color: {{VALUE}};',
				]
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'number_typography',
				'selector' => '{{WRAPPER}} .ot-countdown li span, {{WRAPPER}} .ot-countdown li.seperator',
			]
		);

		//Title
		$this->add_control(
			'heading_titles',
			[
				'label' => __( 'Texts', 'valkiriapps' ),
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
					'{{WRAPPER}} .ot-countdown p' => 'color: {{VALUE}};',
				]
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'selector' => '{{WRAPPER}} .ot-countdown p',
			]
		);

		//Seperator
		$this->add_control(
			'heading_sepe',
			[
				'label' => __( 'Seperator', 'valkiriapps' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_control(
			'sepe_color',
			[
				'label' => __( 'Color', 'valkiriapps' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .ot-countdown li.seperator' => 'color: {{VALUE}};',
				]
			]
		);

		$this->end_controls_section();

	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		$datex = str_replace('-','/',$settings['date']);
		?>
			
		<ul class="ot-countdown unstyle" data-zone="<?php echo $settings['zone']; ?>" data-date="<?php echo $datex; ?>" data-day="<?php echo $settings['day']; ?>" data-days="<?php echo $settings['days']; ?>" data-hour="<?php echo $settings['hour']; ?>" data-hours="<?php echo $settings['hours']; ?>" data-min="<?php echo $settings['min']; ?>" data-mins="<?php echo $settings['mins']; ?>" data-second="<?php echo $settings['second']; ?>" data-seconds="<?php echo $settings['seconds']; ?>">
			<li><span class="days">00</span><p class="days_text">Days</p></li>
			<li class="seperator">:</li>
			<li><span class="hours">00</span><p class="hours_text">Hours</p></li>
			<li class="seperator">:</li>
			<li><span class="minutes">00</span><p class="minutes_text">Minutes</p></li>
			<li class="seperator">:</li>
			<li><span class="seconds">00</span><p class="seconds_text">Seconds</p></li>
		</ul>

	    <?php
	}

	protected function content_template() {}
}
// After the Schedule class is defined, I must register the new widget class with Elementor:
Plugin::instance()->widgets_manager->register( new Valkiriapps_CountDown() );