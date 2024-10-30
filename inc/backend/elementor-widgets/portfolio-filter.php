<?php

namespace Elementor;

if (! defined('ABSPATH')) exit;

class Valkiriapps_PortfolioFilter extends Widget_Base
{

	public function get_name()
	{
		return 'ipfilter';
	}

	public function get_title()
	{
		return __('Valkiriapps Portfolio Filter', 'valkiriapps');
	}

	public function get_icon()
	{
		return 'eicon-gallery-grid';
	}

	public function get_categories()
	{
		return ['category_valkiriapps'];
	}

	protected function register_controls()
	{
		$this->start_controls_section(
			'content_section',
			[
				'label' => __('General', 'valkiriapps'),
			]
		);
		$this->add_control(
			'project_cat',
			[
				'label' => __('Select Categories', 'valkiriapps'),
				'type' => Controls_Manager::SELECT2,
				'options' => $this->select_param_cate_project(),
				'multiple' => true,
				'label_block' => true,
				'placeholder' => __('All Categories', 'valkiriapps'),
			]
		);
		// Más controles...
		$this->end_controls_section();
	}

	protected function render()
	{
		$settings = $this->get_settings_for_display();
?>
		<div class="project-filter-wrapper">
			<?php if ('yes' === $settings['filter']) { ?>
				<ul class="project_filters">
					<?php if ($settings['all_text']) { ?>
						<li><a href="#" data-filter="*" class="selected"><?php echo esc_html($settings['all_text']); ?></a></li>
					<?php } ?>
					<?php
					if ($settings['project_cat']) {
						$categories = $settings['project_cat'];
						foreach ((array)$categories as $categorie) {
							$cates = get_term_by('slug', $categorie, 'portfolio_cat');
							if ($cates && !is_wp_error($cates)) {
								$cat_name = $cates->name;
								$cat_id   = 'category-' . $cates->term_id;
					?>
								<li><a href='#' data-filter='.<?php echo esc_attr($cat_id); ?>'><?php echo esc_html($cat_name); ?></a></li>
							<?php }
						}
					} else {
						$categories = get_terms('portfolio_cat');
						if (!is_wp_error($categories) && !empty($categories)) {
							foreach ((array)$categories as $categorie) {
								$cat_name = $categorie->name;
								$cat_id   = 'category-' . $categorie->term_id;
							?>
								<li><a href='#' data-filter='.<?php echo esc_attr($cat_id); ?>'><?php echo esc_html($cat_name); ?></a></li>
					<?php }
						}
					}
					?>
				</ul>
			<?php } ?>

			<div class="projects-grid projects-<?php echo esc_attr($settings['layout']); ?>">
				<?php
				$args = [
					'post_type' => 'ot_portfolio',
					'post_status' => 'publish',
					'posts_per_page' => $settings['project_num'],
				];
				if ($settings['project_cat']) {
					$args['tax_query'] = [
						[
							'taxonomy' => 'portfolio_cat',
							'field' => 'slug',
							'terms' => $settings['project_cat'],
						],
					];
				}
				$wp_query = new \WP_Query($args);
				if ($wp_query->have_posts()) :
					while ($wp_query->have_posts()) : $wp_query->the_post();
						$cates = get_the_terms(get_the_ID(), 'portfolio_cat');
						$cate_id = '';
						if (!is_wp_error($cates) && !empty($cates)) {
							foreach ($cates as $cate) {
								$cate_id .= 'category-' . $cate->term_id . ' ';
							}
						}
				?>
						<div class="project-item <?php echo esc_attr($cate_id); ?>">
							<div class="projects-box">
								<div class="projects-thumbnail">
									<a href="<?php the_permalink(); ?>">
										<?php
										if (has_post_thumbnail()) {
											if ($settings['layout'] == 'style-2') {
												the_post_thumbnail('valkiriapps-portfolio-thumbnail-masonry');
											} else {
												the_post_thumbnail('valkiriapps-portfolio-thumbnail-grid');
											}
										}
										?>
									</a>
								</div>
								<div class="portfolio-info">
									<div class="portfolio-info-inner">
										<h5><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
										<?php
										if ('yes' === $settings['show_cat']) {
											$terms = get_the_terms(get_the_ID(), 'portfolio_cat');
											if (! is_wp_error($terms) && ! empty($terms)) :
												echo '<p class="portfolio-cates">';
												foreach ($terms as $term) {
													$term_link = get_term_link($term);
													if (is_wp_error($term_link)) {
														continue;
													}
													echo '<a href="' . esc_url($term_link) . '">' . $term->name . '</a><span>/</span>';
												}
												echo '</p>';
											endif;
										}
										?>
									</div>
								</div>
							</div>
						</div>
				<?php endwhile;
					wp_reset_postdata();
				endif;
				?>
			</div>
		</div>
<?php
	}

	protected function select_param_cate_project()
	{
		$category = get_terms('portfolio_cat');
		$cat = [];
		if (!is_wp_error($category) && !empty($category)) {
			foreach ($category as $item) {
				if ($item) {
					$cat[$item->slug] = $item->name;
				}
			}
		}
		return $cat;
	}
}

Plugin::instance()->widgets_manager->register(new Valkiriapps_PortfolioFilter());
