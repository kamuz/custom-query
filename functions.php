<?php

/**
 * Register scripts and styles
 */
function theme_register_scripts() {
	wp_enqueue_style( 'simple-css', get_stylesheet_uri(), false, '1.0.0' );
	wp_enqueue_script( 'simple-js', get_template_directory_uri() . '/assets/js/main.js', array( 'jquery' ), '1.0.0', true );
}
add_action( 'wp_enqueue_scripts', 'theme_register_scripts', 1 );

/**
 * Add theme support
 */
if ( function_exists( 'add_theme_support' ) ) {
	add_theme_support( 'menus' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
}

/**
 * CPT for videos
 */
function register_movie_post_type() {
	$args = array(
		'label'           => 'Movies',
		'labels'          => array(
			'menu_name'     => 'Movies',
			'name'          => 'Movies',
			'singular_name' => 'Movie',
		),
		'public'          => true,
		'menu_icon'       => 'dashicons-video-alt2',
		'capability_type' => 'post',
		'supports'        => array(
			'title',
			'editor',
			'thumbnail',
		),
	);
	register_post_type( 'movie', $args );
}
add_action( 'init', 'register_movie_post_type' );
