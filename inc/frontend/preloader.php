<?php

if( valkiriapps_get_option('preload') != false ){

    function valkiriapps_body_classes( $classes ) {

    	$classes[] = 'royal_preloader';

    	return $classes;        
    }
    add_filter( 'body_class', 'valkiriapps_body_classes' );

    function valkiriapps_preload_body_open_script() {
        echo '<div id="royal_preloader" data-width="'.valkiriapps_get_option('preload_logo_width').'" data-height="'.valkiriapps_get_option('preload_logo_height').'" data-url="'.valkiriapps_get_option('preload_logo').'" data-color="'.valkiriapps_get_option('preload_text_color').'" data-bgcolor="'.valkiriapps_get_option('preload_bgcolor').'"></div>';
        
    }
    add_action( 'wp_body_open', 'valkiriapps_preload_body_open_script' );

    function valkiriapps_preload_scripts() {
    	wp_enqueue_style('valkiriapps-preload', get_template_directory_uri().'/css/royal-preload.css');
    }
    add_action( 'wp_enqueue_scripts', 'valkiriapps_preload_scripts' );

}