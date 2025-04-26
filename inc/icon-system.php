<?php
/**
 * Sistema de iconos para NovaUI
 *
 * @package NovaUI
 */

/**
 * Clase para manejar el sistema de iconos
 */
class NovaUI_Icon_System {

	/**
	 * Biblioteca de iconos disponibles
	 *
	 * @var array
	 */
	private $icon_library = array();

	/**
	 * Constructor
	 */
	public function __construct() {
		// Inicializar sistema de iconos
		add_action( 'after_setup_theme', array( $this, 'initialize' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_icon_styles' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_admin_icon_styles' ) );
		
		// Añadir shortcode para iconos
		add_shortcode( 'saas_icon', array( $this, 'icon_shortcode' ) );

		// Registrar la biblioteca de iconos
		$this->register_icon_library();
	}

	/**
	 * Inicializar
	 */
	public function initialize() {
		// Inicialización adicional si es necesaria
	}

	/**
	 * Encolar estilos de iconos para el frontend
	 */
	public function enqueue_icon_styles() {
		// Encolar CSS de iconos
		wp_enqueue_style( 'nova-ui-icons', get_template_directory_uri() . '/assets/css/icons.css', array(), NOVA_UI_VERSION );
	}

	/**
	 * Encolar estilos de iconos para el admin
	 */
	public function enqueue_admin_icon_styles() {
		// Encolar CSS de iconos en el admin
		wp_enqueue_style( 'nova-ui-icons-admin', get_template_directory_uri() . '/assets/css/icons.css', array(), NOVA_UI_VERSION );
	}

	/**
	 * Registrar la biblioteca de iconos disponibles
	 */
	private function register_icon_library() {
		// Iconos genéricos/básicos
		$this->icon_library['dashboard'] = 'nova-icon-dashboard';
		$this->icon_library['home'] = 'nova-icon-home';
		$this->icon_library['search'] = 'nova-icon-search';
		$this->icon_library['settings'] = 'nova-icon-settings';
		$this->icon_library['user'] = 'nova-icon-user';
		$this->icon_library['users'] = 'nova-icon-users';
		$this->icon_library['calendar'] = 'nova-icon-calendar';
		$this->icon_library['clock'] = 'nova-icon-clock';
		$this->icon_library['bell'] = 'nova-icon-bell';
		$this->icon_library['mail'] = 'nova-icon-mail';
		$this->icon_library['heart'] = 'nova-icon-heart';
		$this->icon_library['star'] = 'nova-icon-star';
		$this->icon_library['plus'] = 'nova-icon-plus';
		$this->icon_library['minus'] = 'nova-icon-minus';
		$this->icon_library['x'] = 'nova-icon-x';
		$this->icon_library['check'] = 'nova-icon-check';
		$this->icon_library['link'] = 'nova-icon-link';
		$this->icon_library['image'] = 'nova-icon-image';
		$this->icon_library['file'] = 'nova-icon-file';
		$this->icon_library['file-text'] = 'nova-icon-file-text';
		$this->icon_library['folder'] = 'nova-icon-folder';

		// Iconos de navegación
		$this->icon_library['arrow-up'] = 'nova-icon-arrow-up';
		$this->icon_library['arrow-right'] = 'nova-icon-arrow-right';
		$this->icon_library['arrow-down'] = 'nova-icon-arrow-down';
		$this->icon_library['arrow-left'] = 'nova-icon-arrow-left';
		$this->icon_library['chevron-up'] = 'nova-icon-chevron-up';
		$this->icon_library['chevron-right'] = 'nova-icon-chevron-right';
		$this->icon_library['chevron-down'] = 'nova-icon-chevron-down';
		$this->icon_library['chevron-left'] = 'nova-icon-chevron-left';
		$this->icon_library['menu'] = 'nova-icon-menu';
		$this->icon_library['more-horizontal'] = 'nova-icon-more-horizontal';
		$this->icon_library['more-vertical'] = 'nova-icon-more-vertical';

		// Iconos específicos de la aplicación
		$this->icon_library['message-square'] = 'nova-icon-message-square'; // Para Chat IA
		$this->icon_library['message-circle'] = 'nova-icon-message-circle';
		$this->icon_library['send'] = 'nova-icon-send';
		$this->icon_library['link-2'] = 'nova-icon-link-2'; // Para Quick Links
		$this->icon_library['external-link'] = 'nova-icon-external-link';
		$this->icon_library['share'] = 'nova-icon-share';
		$this->icon_library['bookmark'] = 'nova-icon-bookmark';
		$this->icon_library['trash'] = 'nova-icon-trash';
		$this->icon_library['edit'] = 'nova-icon-edit';
		$this->icon_library['save'] = 'nova-icon-save';

		// Iconos para gráficos y datos
		$this->icon_library['bar-chart'] = 'nova-icon-bar-chart';
		$this->icon_library['bar-chart-2'] = 'nova-icon-bar-chart-2';
		$this->icon_library['pie-chart'] = 'nova-icon-pie-chart';
		$this->icon_library['activity'] = 'nova-icon-activity';
		$this->icon_library['trending-up'] = 'nova-icon-trending-up';
		$this->icon_library['trending-down'] = 'nova-icon-trending-down';
		$this->icon_library['dollar-sign'] = 'nova-icon-dollar-sign';

		// Iconos de tema y diseño
		$this->icon_library['sun'] = 'nova-icon-sun'; // Para tema claro
		$this->icon_library['moon'] = 'nova-icon-moon'; // Para tema oscuro
		$this->icon_library['layout'] = 'nova-icon-layout';
		$this->icon_library['grid'] = 'nova-icon-grid';
		$this->icon_library['layers'] = 'nova-icon-layers';
		$this->icon_library['sliders'] = 'nova-icon-sliders';
		$this->icon_library['eye'] = 'nova-icon-eye';
		$this->icon_library['eye-off'] = 'nova-icon-eye-off';

		// Iconos estilo videojuego
		$this->icon_library['gamepad'] = 'nova-icon-gamepad';
		$this->icon_library['zap'] = 'nova-icon-zap'; // Para energía/tokens
		$this->icon_library['award'] = 'nova-icon-award'; // Para logros
		$this->icon_library['gift'] = 'nova-icon-gift'; // Para recompensas
		$this->icon_library['shield'] = 'nova-icon-shield'; // Para protección/membresía
		$this->icon_library['hexagon'] = 'nova-icon-hexagon'; // Forma geométrica para niveles

		// Permitir que los plugins o temas hijo añadan más iconos
		$this->icon_library = apply_filters( 'nova_ui_icon_library', $this->icon_library );
	}

	/**
	 * Obtener la clase CSS para un icono
	 *
	 * @param string $icon_name Nombre del icono
	 * @return string Clase CSS para el icono o clase por defecto si no existe
	 */
	public function get_icon_class( $icon_name ) {
		if ( isset( $this->icon_library[$icon_name] ) ) {
			return $this->icon_library[$icon_name];
		}

		// Devolver un icono por defecto si no existe el solicitado
		return 'nova-icon-circle';
	}

	/**
	 * Obtener HTML de un icono
	 *
	 * @param string $icon_name Nombre del icono
	 * @param array $args Argumentos adicionales (class, style, etc.)
	 * @return string HTML del icono
	 */
	public function get_icon( $icon_name, $args = array() ) {
		$icon_class = $this->get_icon_class( $icon_name );
		
		$default_args = array(
			'class' => '',
			'style' => '',
			'aria-hidden' => 'true',
		);
		
		$args = wp_parse_args( $args, $default_args );
		
		$classes = $icon_class;
		if ( !empty( $args['class'] ) ) {
			$classes .= ' ' . $args['class'];
		}
		
		$style = '';
		if ( !empty( $args['style'] ) ) {
			$style = ' style="' . esc_attr( $args['style'] ) . '"';
		}
		
		$aria_hidden = '';
		if ( !empty( $args['aria-hidden'] ) ) {
			$aria_hidden = ' aria-hidden="' . esc_attr( $args['aria-hidden'] ) . '"';
		}
		
		return '<i class="' . esc_attr( $classes ) . '"' . $style . $aria_hidden . '></i>';
	}

	/**
	 * Shortcode para mostrar iconos
	 *
	 * @param array $atts Atributos del shortcode
	 * @return string HTML del icono
	 */
	public function icon_shortcode( $atts ) {
		$atts = shortcode_atts(
			array(
				'name' => 'circle',
				'class' => '',
				'style' => '',
				'color' => '',
				'size' => '',
			),
			$atts,
			'saas_icon'
		);

		$style = $atts['style'];
		if ( !empty( $atts['color'] ) ) {
			$style .= 'color:' . $atts['color'] . ';';
		}
		if ( !empty( $atts['size'] ) ) {
			$style .= 'font-size:' . $atts['size'] . ';';
		}

		return $this->get_icon( $atts['name'], array(
			'class' => $atts['class'],
			'style' => $style,
		) );
	}
}

// Inicializar el sistema de iconos
global $nova_ui_icon_system;
$nova_ui_icon_system = new NovaUI_Icon_System();

/**
 * Función de ayuda para mostrar un icono
 *
 * @param string $icon_name Nombre del icono
 * @param array $args Argumentos adicionales
 * @param bool $echo Si se debe imprimir el resultado
 * @return string|void HTML del icono o nada si $echo es true
 */
function nova_ui_icon( $icon_name, $args = array(), $echo = true ) {
	global $nova_ui_icon_system;
	
	if ( !$nova_ui_icon_system ) {
		return '';
	}
	
	$icon_html = $nova_ui_icon_system->get_icon( $icon_name, $args );
	
	if ( $echo ) {
		echo $icon_html;
	} else {
		return $icon_html;
	}
}
