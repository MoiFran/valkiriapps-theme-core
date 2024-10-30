<?php

/** header desktop **/
if (! function_exists('valkiriapps_header_builder')) {
    function valkiriapps_header_builder()
    {
        $header_builder = '';

        if (is_page()) {
            if (function_exists('rwmb_meta')) {
                global $wp_query;
                $metabox_fb = rwmb_meta('select_header', 'field_type=select_advanced', $wp_query->get_queried_object_id());
                $header_builder = $metabox_fb ?: valkiriapps_get_option('header_select');
            }
        } else {
            $header_builder = valkiriapps_get_option('header_select');
        }

        if (!$header_builder) {
            get_template_part('inc/frontend/header/header-default');
        } else {
            echo '<div class="header-desktop">';
            if (did_action('elementor/loaded')) {
                $translated_header_builder = $header_builder;
                if (is_plugin_active('sitepress-multilingual-cms/sitepress.php') && is_plugin_active('wpml-string-translation/plugin.php')) {
                    $translated_header_builder = apply_filters('wpml_object_id', $header_builder);
                }
                echo \Elementor\Plugin::$instance->frontend->get_builder_content_for_display($translated_header_builder);
            }
            echo '</div>';
        }
    }
}

/** header mobile **/
if (! function_exists('valkiriapps_mobile_builder')) {
    function valkiriapps_mobile_builder()
    {
        $mobile_builder = null;

        if (is_page()) {
            if (function_exists('rwmb_meta')) {
                global $wp_query;
                $metabox_hmb = rwmb_meta('select_header_mobile', 'field_type=select_advanced', $wp_query->get_queried_object_id());
                $mobile_builder = $metabox_hmb ?: valkiriapps_get_option('header_mobile');
            }
        } else {
            $mobile_builder = valkiriapps_get_option('header_mobile');
        }

        if (!$mobile_builder) {
            get_template_part('inc/frontend/header/header-mobile');
        } else {
            echo '<div class="header-mobile">';
            if (did_action('elementor/loaded')) {
                $translated_mheader_builder = $mobile_builder;
                if (is_plugin_active('sitepress-multilingual-cms/sitepress.php') && is_plugin_active('wpml-string-translation/plugin.php')) {
                    $translated_mheader_builder = apply_filters('wpml_object_id', $mobile_builder);
                }
                echo \Elementor\Plugin::$instance->frontend->get_builder_content_for_display($translated_mheader_builder);
            }
            echo '</div>';
        }
    }
}

/** side panel **/
if (! function_exists('valkiriapps_sidepanel_builder')) {
    function valkiriapps_sidepanel_builder()
    {
        $panel_builder = valkiriapps_get_option('sidepanel_layout');

        if (!$panel_builder) {
            return;
        }

        $translated_panel_builder = $panel_builder;
        if (is_plugin_active('sitepress-multilingual-cms/sitepress.php') && is_plugin_active('wpml-string-translation/plugin.php')) {
            $translated_panel_builder = apply_filters('wpml_object_id', $panel_builder);
        }
        echo \Elementor\Plugin::$instance->frontend->get_builder_content_for_display($translated_panel_builder);
    }
}

/** 404 template **/
if (! function_exists('valkiriapps_404_builder')) {
    function valkiriapps_404_builder()
    {
        $error_builder = valkiriapps_get_option('page_404');

        if (!$error_builder) { ?>
            <div class="container">
                <div class="error-404 not-found text-center">
                    <h2><img class="error-image" src="<?php echo esc_url(get_template_directory_uri()); ?>/images/404-error.png" alt="404"></h2>
                    <h1><?php esc_html_e('Sorry! Page Not Found!', 'valkiriapps'); ?></h1>
                    <div class="content-404">
                        <p><?php esc_html_e('Oops! The page you are looking for does not exist. Please return to the homepage.', 'valkiriapps'); ?></p>
                        <?php get_search_form(); ?>
                        <a class="octf-btn" href="<?php echo esc_url(home_url('/')); ?>"><?php esc_html_e('Take Me Home', 'valkiriapps'); ?></a>
                    </div>
                </div>
            </div>
<?php } else {
            $translated_error_builder = $error_builder;
            if (did_action('elementor/loaded')) {
                if (is_plugin_active('sitepress-multilingual-cms/sitepress.php') && is_plugin_active('wpml-string-translation/plugin.php')) {
                    $translated_error_builder = apply_filters('wpml_object_id', $error_builder);
                }
                echo \Elementor\Plugin::$instance->frontend->get_builder_content_for_display($translated_error_builder);
            }
        }
    }
}

/** footer **/
if (! function_exists('valkiriapps_footer_builder')) {
    function valkiriapps_footer_builder()
    {
        $footer_builder = '';

        if (is_page()) {
            if (function_exists('rwmb_meta')) {
                global $wp_query;
                $metabox_fb = rwmb_meta('select_footer', 'field_type=select_advanced', $wp_query->get_queried_object_id());
                $footer_builder = $metabox_fb ?: valkiriapps_get_option('footer_layout');
            }
        } else {
            $footer_builder = valkiriapps_get_option('footer_layout');
        }

        if (!$footer_builder) {
            return;
        }

        echo '<footer id="site-footer" class="site-footer" itemscope="itemscope" itemtype="http://schema.org/WPFooter">';
        $translated_footer_builder = $footer_builder;
        if (did_action('elementor/loaded')) {
            if (is_plugin_active('sitepress-multilingual-cms/sitepress.php') && is_plugin_active('wpml-string-translation/plugin.php')) {
                $translated_footer_builder = apply_filters('wpml_object_id', $footer_builder);
            }
            echo \Elementor\Plugin::$instance->frontend->get_builder_content_for_display($translated_footer_builder);
        }
        echo '</footer>';
    }
}
