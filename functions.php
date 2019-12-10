<?php

/**
 * Register Scripts and Style
 */
function theme_register_scripts() {
	wp_enqueue_style( 'simple-css', get_stylesheet_uri() );
	wp_enqueue_script( 'simple-js', get_template_directory_uri() . '/assets/js/main.js', array( 'jquery' ), '1.0', true );
}
add_action( 'wp_enqueue_scripts', 'theme_register_scripts', 1 );

/**
 * Add menu support
 */
if (function_exists('add_theme_support')) {
	add_theme_support('menus');
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
}