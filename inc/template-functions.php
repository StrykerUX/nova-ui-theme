<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package NovaUI
 */

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function novaui_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}
add_action( 'wp_head', 'novaui_pingback_header' );

/**
 * Adds custom classes to the array of body classes.
 * 
 * @param array $classes Classes for the body element.
 * @return array
 */
// Esta función se trasladó a functions.php, por lo que no la definimos aquí para evitar duplicación
// function novaui_body_classes( $classes ) {
// 	// Añade una clase si es singular
// 	if ( is_singular() ) {
// 		$classes[] = 'singular';
// 	}
// 
// 	// Añade una clase si no es la página principal
// 	if ( ! is_front_page() ) {
// 		$classes[] = 'interior-page';
// 	}
// 
// 	// Verificar preferencia de tema oscuro
// 	if ( get_theme_mod( 'default_dark_mode', false ) ) {
// 		$classes[] = 'dark-mode';
// 	}
// 
// 	return $classes;
// }
// add_filter( 'body_class', 'novaui_body_classes' );

/**
 * Add a class to the Gutenberg editor
 */
function novaui_add_editor_styles() {
    // Verificar preferencia de tema oscuro
    if ( get_theme_mod( 'default_dark_mode', false ) ) {
        add_editor_class( 'dark-mode' );
    }
}
add_action( 'enqueue_block_editor_assets', 'novaui_add_editor_styles' );

/**
 * Enhance the theme by hooking into WordPress.
 */
function novaui_theme_setup() {
    // Añadir soporte para estilos de bloques Gutenberg
    add_theme_support( 'wp-block-styles' );
    
    // Añadir soporte para alineación amplia
    add_theme_support( 'align-wide' );
    
    // Añadir soporte para HTML5
    add_theme_support(
        'html5',
        array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
            'script',
            'style',
        )
    );
}
add_action( 'after_setup_theme', 'novaui_theme_setup' );
