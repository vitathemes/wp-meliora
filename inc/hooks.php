<?php
function wp_manifest_enqueue_customizer_style( $hook_suffix ) {
	// Load your css.
	wp_register_style( 'kirki-styles-css', get_template_directory_uri() . '/assets/kirki-controls-style.css', false, '1.0.0' );
	wp_enqueue_style( 'kirki-styles-css' );
}

add_action( 'admin_enqueue_scripts', 'wp_manifest_enqueue_customizer_style' );
