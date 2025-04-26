<?php
/**
 * Soporte para plugins específicos
 *
 * @package NovaUI
 */

/**
 * Clase para manejar la integración con plugins
 */
class NovaUI_Plugins_Support {

	/**
	 * Constructor
	 */
	public function __construct() {
		// Inicializar soporte para plugins
		add_action( 'after_setup_theme', array( $this, 'initialize' ) );
	}

	/**
	 * Inicializar soportes
	 */
	public function initialize() {
		// Detectar plugins activos
		$this->detect_plugins();

		// Añadir hooks específicos
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_plugins_styles' ) );
		
		// Añadir filtros para personalización de plugins
		add_filter( 'body_class', array( $this, 'add_plugin_body_classes' ) );
	}

	/**
	 * Detectar plugins instalados y activos
	 */
	public function detect_plugins() {
		// Chat IA Plugin
		if ( function_exists( 'imstryker_ia_is_active' ) ) {
			$this->init_chat_ia_support();
		}

		// Quick Links Plugin
		if ( class_exists( 'QuickLinks' ) || function_exists( 'ql_get_user_profiles' ) ) {
			$this->init_quick_links_support();
		}

		// WooCommerce
		if ( class_exists( 'WooCommerce' ) ) {
			$this->init_woocommerce_support();
		}
	}

	/**
	 * Inicializar soporte para Chat IA
	 */
	private function init_chat_ia_support() {
		// Añadir filtros para personalizar la interfaz del Chat IA
		add_filter( 'imstryker_ia_chat_container_class', array( $this, 'chat_ia_container_class' ) );
		add_filter( 'imstryker_ia_chat_message_class', array( $this, 'chat_ia_message_class' ), 10, 2 );
		add_filter( 'imstryker_ia_send_button_attributes', array( $this, 'chat_ia_button_attributes' ) );

		// Modificar plantillas del plugin
		add_filter( 'imstryker_ia_template_path', array( $this, 'chat_ia_template_path' ), 10, 2 );

		// Añadir hooks para acciones específicas
		add_action( 'imstryker_ia_before_chat_interface', array( $this, 'chat_ia_before_interface' ) );
		add_action( 'imstryker_ia_after_chat_interface', array( $this, 'chat_ia_after_interface' ) );
	}

	/**
	 * Inicializar soporte para Quick Links
	 */
	private function init_quick_links_support() {
		// Añadir filtros para personalizar la interfaz de Quick Links
		add_filter( 'ql_profile_class', array( $this, 'quick_links_profile_class' ) );
		add_filter( 'ql_link_class', array( $this, 'quick_links_link_class' ), 10, 2 );

		// Modificar plantillas del plugin
		add_filter( 'ql_template_path', array( $this, 'quick_links_template_path' ), 10, 2 );

		// Añadir hooks para acciones específicas
		add_action( 'ql_before_profile_display', array( $this, 'quick_links_before_profile' ) );
		add_action( 'ql_after_profile_display', array( $this, 'quick_links_after_profile' ) );
	}

	/**
	 * Inicializar soporte para WooCommerce
	 */
	private function init_woocommerce_support() {
		// La integración principal de WooCommerce se maneja en inc/woocommerce.php
		// Añadir aquí cualquier función específica adicional
	}

	/**
	 * Encolar estilos para plugins
	 */
	public function enqueue_plugins_styles() {
		// Chat IA Plugin
		if ( function_exists( 'imstryker_ia_is_active' ) ) {
			wp_enqueue_style( 'nova-ui-chat-ia', get_template_directory_uri() . '/assets/css/plugins/chat-ia.css', array('nova-ui-base'), NOVA_UI_VERSION );
		}

		// Quick Links Plugin
		if ( class_exists( 'QuickLinks' ) || function_exists( 'ql_get_user_profiles' ) ) {
			wp_enqueue_style( 'nova-ui-quick-links', get_template_directory_uri() . '/assets/css/plugins/quick-links.css', array('nova-ui-base'), NOVA_UI_VERSION );
		}
	}

	/**
	 * Añadir clases específicas al body según los plugins activos
	 *
	 * @param array $classes Clases actuales
	 * @return array Clases actualizadas
	 */
	public function add_plugin_body_classes( $classes ) {
		// Chat IA Plugin
		if ( function_exists( 'imstryker_ia_is_active' ) ) {
			$classes[] = 'has-chat-ia';
		}

		// Quick Links Plugin
		if ( class_exists( 'QuickLinks' ) || function_exists( 'ql_get_user_profiles' ) ) {
			$classes[] = 'has-quick-links';
		}

		// WooCommerce
		if ( class_exists( 'WooCommerce' ) ) {
			$classes[] = 'has-woocommerce';
		}

		return $classes;
	}

	/**
	 * Modificar clase del contenedor de Chat IA
	 *
	 * @param string $class Clase original
	 * @return string Clase modificada
	 */
	public function chat_ia_container_class( $class ) {
		return $class . ' nova-ui-chat-container';
	}

	/**
	 * Modificar clase de mensajes de Chat IA
	 *
	 * @param string $class Clase original
	 * @param string $role Rol del mensaje (assistant o user)
	 * @return string Clase modificada
	 */
	public function chat_ia_message_class( $class, $role ) {
		if ( $role === 'assistant' ) {
			$class .= ' nova-ui-chat-message-ai';
		} else {
			$class .= ' nova-ui-chat-message-user';
		}
		
		return $class;
	}

	/**
	 * Modificar atributos de botón de envío en Chat IA
	 *
	 * @param array $attributes Atributos originales
	 * @return array Atributos modificados
	 */
	public function chat_ia_button_attributes( $attributes ) {
		$attributes['class'] = isset( $attributes['class'] ) ? $attributes['class'] . ' nova-ui-chat-send-button' : 'nova-ui-chat-send-button';
		
		return $attributes;
	}

	/**
	 * Cambiar ruta de plantillas para Chat IA
	 *
	 * @param string $default_path Ruta por defecto
	 * @param string $template_name Nombre de la plantilla
	 * @return string Ruta modificada
	 */
	public function chat_ia_template_path( $default_path, $template_name ) {
		// Comprobar si existe una plantilla personalizada en el tema
		$theme_template = get_template_directory() . '/plugins/chat-ia/' . $template_name;
		
		if ( file_exists( $theme_template ) ) {
			return $theme_template;
		}
		
		return $default_path;
	}

	/**
	 * Añadir contenido antes de la interfaz de Chat IA
	 */
	public function chat_ia_before_interface() {
		// Comprobar si estamos en una página dedicada al chat
		if ( is_page_template( 'templates/chat-ia.php' ) ) {
			echo '<div class="nova-ui-chat-ia-header">';
			echo '<h2>' . esc_html__( 'Chat with AI Assistant', 'nova-ui' ) . '</h2>';
			echo '</div>';
		}
	}

	/**
	 * Añadir contenido después de la interfaz de Chat IA
	 */
	public function chat_ia_after_interface() {
		// Añadir algún contenido después de la interfaz si es necesario
	}

	/**
	 * Modificar clase del perfil de Quick Links
	 *
	 * @param string $class Clase original
	 * @return string Clase modificada
	 */
	public function quick_links_profile_class( $class ) {
		return $class . ' nova-ui-quick-links-profile';
	}

	/**
	 * Modificar clase de enlaces en Quick Links
	 *
	 * @param string $class Clase original
	 * @param array $link_data Datos del enlace
	 * @return string Clase modificada
	 */
	public function quick_links_link_class( $class, $link_data ) {
		// Añadir clases según el tipo de enlace
		if ( isset( $link_data['type'] ) && $link_data['type'] === 'button' ) {
			$class .= ' nova-ui-quick-link-button';
		} elseif ( isset( $link_data['type'] ) && $link_data['type'] === 'outline' ) {
			$class .= ' nova-ui-quick-link-outline';
		} else {
			$class .= ' nova-ui-quick-link-default';
		}
		
		return $class;
	}

	/**
	 * Cambiar ruta de plantillas para Quick Links
	 *
	 * @param string $default_path Ruta por defecto
	 * @param string $template_name Nombre de la plantilla
	 * @return string Ruta modificada
	 */
	public function quick_links_template_path( $default_path, $template_name ) {
		// Comprobar si existe una plantilla personalizada en el tema
		$theme_template = get_template_directory() . '/plugins/quick-links/' . $template_name;
		
		if ( file_exists( $theme_template ) ) {
			return $theme_template;
		}
		
		return $default_path;
	}

	/**
	 * Añadir contenido antes del perfil de Quick Links
	 */
	public function quick_links_before_profile() {
		// Añadir algún contenido antes del perfil si es necesario
	}

	/**
	 * Añadir contenido después del perfil de Quick Links
	 */
	public function quick_links_after_profile() {
		// Añadir el botón de regresar al dashboard si el usuario está logueado
		if ( is_user_logged_in() ) {
			echo '<div class="nova-ui-quick-links-back">';
			echo '<a href="' . esc_url( home_url( '/dashboard/' ) ) . '" class="nova-ui-quick-links-back-button">';
			echo '<i class="nova-icon-arrow-left"></i> ' . esc_html__( 'Back to Dashboard', 'nova-ui' );
			echo '</a>';
			echo '</div>';
		}
	}
}

// Inicializar la clase
new NovaUI_Plugins_Support();
