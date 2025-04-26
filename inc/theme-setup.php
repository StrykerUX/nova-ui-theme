<?php
/**
 * Configuración principal del tema
 *
 * @package NovaUI
 */

/**
 * Clase para gestionar la configuración del tema
 */
class NovaUI_Theme_Setup {

	/**
	 * Constructor
	 */
	public function __construct() {
		// Inicializar configuraciones del tema
		add_action( 'after_setup_theme', array( $this, 'setup' ) );
		add_action( 'after_setup_theme', array( $this, 'content_width' ), 0 );
		add_action( 'widgets_init', array( $this, 'widgets_init' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
		add_action( 'enqueue_block_editor_assets', array( $this, 'editor_assets' ) );
	}

	/**
	 * Configuración principal del tema
	 */
	public function setup() {
		// Hacer que el tema esté disponible para traducción
		load_theme_textdomain( 'nova-ui', get_template_directory() . '/languages' );

		// Añadir soporte por defecto para diversos elementos de WordPress
		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'title-tag' );
		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'responsive-embeds' );
		add_theme_support( 'align-wide' );
		add_theme_support( 'editor-styles' );
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		) );
		
		// Logo personalizado
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );

		// Refresh selectivo de widgets
		add_theme_support( 'customize-selective-refresh-widgets' );

		// Formatos de entrada
		add_theme_support( 'post-formats', array(
			'aside',
			'gallery',
			'link',
			'image',
			'quote',
			'status',
			'video',
			'audio',
			'chat',
		) );

		// Menús de navegación
		register_nav_menus(
			array(
				'menu-1' => esc_html__( 'Primary Menu', 'nova-ui' ),
				'menu-2' => esc_html__( 'Dashboard Sidebar Menu', 'nova-ui' ),
				'menu-3' => esc_html__( 'Footer Menu', 'nova-ui' ),
			)
		);
	}

	/**
	 * Establecer el ancho de contenido predeterminado
	 */
	public function content_width() {
		$GLOBALS['content_width'] = apply_filters( 'nova_ui_content_width', 1200 );
	}

	/**
	 * Registrar widgets
	 */
	public function widgets_init() {
		register_sidebar(
			array(
				'name'          => esc_html__( 'Sidebar', 'nova-ui' ),
				'id'            => 'sidebar-1',
				'description'   => esc_html__( 'Add widgets here.', 'nova-ui' ),
				'before_widget' => '<section id="%1$s" class="widget %2$s">',
				'after_widget'  => '</section>',
				'before_title'  => '<h2 class="widget-title">',
				'after_title'   => '</h2>',
			)
		);

		register_sidebar(
			array(
				'name'          => esc_html__( 'Dashboard Sidebar', 'nova-ui' ),
				'id'            => 'dashboard-sidebar',
				'description'   => esc_html__( 'Widgets for dashboard sidebar.', 'nova-ui' ),
				'before_widget' => '<div id="%1$s" class="dashboard-sidebar-widget %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<h3 class="dashboard-sidebar-widget-title">',
				'after_title'   => '</h3>',
			)
		);

		register_sidebar(
			array(
				'name'          => esc_html__( 'Footer Widgets', 'nova-ui' ),
				'id'            => 'footer-widgets',
				'description'   => esc_html__( 'Add widgets here to appear in your footer.', 'nova-ui' ),
				'before_widget' => '<div id="%1$s" class="footer-widget %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<h3 class="footer-widget-title">',
				'after_title'   => '</h3>',
			)
		);
	}

	/**
	 * Encolar scripts y estilos
	 */
	public function enqueue_scripts() {
		// Encolar estilos principales
		wp_enqueue_style( 'nova-ui-style', get_stylesheet_uri(), array(), NOVA_UI_VERSION );

		// Encolar Pico CSS como base
		wp_register_style( 'pico-css', 'https://cdn.jsdelivr.net/npm/@picocss/pico@1/css/pico.min.css', array(), '1.5.10' );
		wp_enqueue_style( 'pico-css' );

		// Encolar estilos personalizados
		wp_enqueue_style( 'nova-ui-variables', get_template_directory_uri() . '/assets/css/variables.css', array(), NOVA_UI_VERSION );
		wp_enqueue_style( 'nova-ui-base', get_template_directory_uri() . '/assets/css/base.css', array('pico-css', 'nova-ui-variables'), NOVA_UI_VERSION );
		wp_enqueue_style( 'nova-ui-components', get_template_directory_uri() . '/assets/css/components.css', array('nova-ui-base'), NOVA_UI_VERSION );
		wp_enqueue_style( 'nova-ui-layout', get_template_directory_uri() . '/assets/css/layout.css', array('nova-ui-base'), NOVA_UI_VERSION );
		wp_enqueue_style( 'nova-ui-icons', get_template_directory_uri() . '/assets/css/icons.css', array('nova-ui-base'), NOVA_UI_VERSION );

		// Encolar scripts
		wp_enqueue_script( 'nova-ui-navigation', get_template_directory_uri() . '/assets/js/navigation.js', array(), NOVA_UI_VERSION, true );

		// Script de búsqueda
		wp_enqueue_script( 'nova-ui-search', get_template_directory_uri() . '/assets/js/search.js', array(), NOVA_UI_VERSION, true );

		// Script para comentarios
		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}

		// Scripts condicionales para plantillas específicas
		if ( is_page_template( 'templates/dashboard.php' ) ) {
			wp_enqueue_script( 'nova-ui-dashboard', get_template_directory_uri() . '/assets/js/dashboard.js', array(), NOVA_UI_VERSION, true );
		}

		if ( is_page_template( 'templates/chat-ia.php' ) ) {
			wp_enqueue_script( 'nova-ui-chat-ia', get_template_directory_uri() . '/assets/js/chat-ia.js', array(), NOVA_UI_VERSION, true );
		}

		if ( is_page_template( 'templates/quick-links-profile.php' ) ) {
			wp_enqueue_script( 'nova-ui-quick-links', get_template_directory_uri() . '/assets/js/quick-links.js', array(), NOVA_UI_VERSION, true );
		}
	}

	/**
	 * Encolar assets para el editor de bloques
	 */
	public function editor_assets() {
		// Estilos para el editor
		wp_enqueue_style( 'nova-ui-editor-styles', get_template_directory_uri() . '/assets/css/editor-styles.css', array(), NOVA_UI_VERSION );
	}
}

// Inicializar la configuración del tema
new NovaUI_Theme_Setup();

/**
 * Funciones de ayuda para el tema
 */

/**
 * Comprobar si estamos en una página de dashboard
 *
 * @return bool True si estamos en una página de dashboard
 */
function nova_ui_is_dashboard() {
	return is_page_template( 'templates/dashboard.php' ) ||
		   is_page_template( 'templates/chat-ia.php' ) ||
		   ( function_exists( 'is_woocommerce' ) && is_account_page() );
}

/**
 * Obtener URL base para el dashboard
 *
 * @return string URL base del dashboard
 */
function nova_ui_get_dashboard_url() {
	$dashboard_page_id = get_option( 'nova_ui_dashboard_page_id' );
	
	if ( $dashboard_page_id ) {
		return get_permalink( $dashboard_page_id );
	}
	
	return home_url( '/dashboard/' );
}

/**
 * Obtener URL para el chat IA
 *
 * @return string URL del chat IA
 */
function nova_ui_get_chat_ia_url() {
	$chat_page_id = get_option( 'nova_ui_chat_page_id' );
	
	if ( $chat_page_id ) {
		return get_permalink( $chat_page_id );
	}
	
	return home_url( '/chat-ia/' );
}

/**
 * Obtener URL base para perfiles de Quick Links
 *
 * @return string URL base para perfiles
 */
function nova_ui_get_quicklinks_base_url() {
	return home_url( '/quicklinks/' );
}
