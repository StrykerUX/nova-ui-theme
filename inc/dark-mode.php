<?php
/**
 * Funcionalidad de tema oscuro/claro
 *
 * @package NovaUI
 */

/**
 * Clase para manejar la funcionalidad de tema oscuro/claro
 */
class NovaUI_Dark_Mode {

	/**
	 * Constructor
	 */
	public function __construct() {
		// Inicializar funcionalidad de tema oscuro/claro
		add_action( 'after_setup_theme', array( $this, 'initialize' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
		add_action( 'wp_head', array( $this, 'add_dark_mode_support' ) );
		
		// Añadir opción en el customizer
		add_action( 'customize_register', array( $this, 'customize_register' ) );
	}

	/**
	 * Inicializar
	 */
	public function initialize() {
		// Inicialización adicional si es necesaria
	}

	/**
	 * Encolar scripts para manejo de tema oscuro/claro
	 */
	public function enqueue_scripts() {
		// Encolar script de tema oscuro/claro
		wp_enqueue_script(
			'nova-ui-dark-mode',
			get_template_directory_uri() . '/assets/js/dark-mode.js',
			array(),
			NOVA_UI_VERSION,
			true
		);

		// Pasar variables al script
		wp_localize_script(
			'nova-ui-dark-mode',
			'novaDarkMode',
			array(
				'defaultMode' => get_theme_mod( 'nova_ui_dark_mode_default', 'auto' ),
				'toggleEnabled' => get_theme_mod( 'nova_ui_enable_dark_mode', true ),
			)
		);
	}

	/**
	 * Agregar meta tag para soporte de modo oscuro/claro
	 */
	public function add_dark_mode_support() {
		// Agregar meta tag para color-scheme
		echo '<meta name="color-scheme" content="light dark">' . "\n";

		// Agregar script para manejar el tema antes de que cargue el contenido
		// para evitar flash de contenido con color incorrecto
		?>
		<script>
		(function() {
			var getStoredTheme = function() {
				try {
					return localStorage.getItem('theme');
				} catch (e) {
					return null;
				}
			};

			var getPreferredTheme = function() {
				var storedTheme = getStoredTheme();
				if (storedTheme) {
					return storedTheme;
				}

				// Por defecto 'auto' si no hay preferencia guardada
				return 'auto';
			};

			var theme = getPreferredTheme();
			
			// Aplicar tema inmediatamente para evitar flash
			if (theme === 'dark' || (theme === 'auto' && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
				document.documentElement.classList.add('dark-mode');
				document.documentElement.classList.remove('light-mode', 'auto-mode');
			} else if (theme === 'light') {
				document.documentElement.classList.add('light-mode');
				document.documentElement.classList.remove('dark-mode', 'auto-mode');
			} else {
				document.documentElement.classList.add('auto-mode');
				document.documentElement.classList.remove('dark-mode', 'light-mode');
			}
		})();
		</script>
		<?php
	}

	/**
	 * Agregar opciones al customizer
	 *
	 * @param WP_Customize_Manager $wp_customize Objeto customizer.
	 */
	public function customize_register( $wp_customize ) {
		// Sección para opciones de tema oscuro/claro
		$wp_customize->add_section(
			'nova_ui_dark_mode_section',
			array(
				'title' => __( 'Dark Mode Settings', 'nova-ui' ),
				'priority' => 30,
			)
		);

		// Opción para habilitar/deshabilitar el toggle de tema oscuro/claro
		$wp_customize->add_setting(
			'nova_ui_enable_dark_mode',
			array(
				'default' => true,
				'sanitize_callback' => array( $this, 'sanitize_checkbox' ),
			)
		);

		$wp_customize->add_control(
			'nova_ui_enable_dark_mode',
			array(
				'label' => __( 'Enable Dark Mode Toggle', 'nova-ui' ),
				'section' => 'nova_ui_dark_mode_section',
				'type' => 'checkbox',
			)
		);

		// Opción para establecer modo por defecto
		$wp_customize->add_setting(
			'nova_ui_dark_mode_default',
			array(
				'default' => 'auto',
				'sanitize_callback' => array( $this, 'sanitize_select' ),
			)
		);

		$wp_customize->add_control(
			'nova_ui_dark_mode_default',
			array(
				'label' => __( 'Default Theme Mode', 'nova-ui' ),
				'section' => 'nova_ui_dark_mode_section',
				'type' => 'select',
				'choices' => array(
					'light' => __( 'Light Mode', 'nova-ui' ),
					'dark' => __( 'Dark Mode', 'nova-ui' ),
					'auto' => __( 'Auto (follow system)', 'nova-ui' ),
				),
			)
		);

		// Opciones de estilo para modo oscuro
		$wp_customize->add_setting(
			'nova_ui_dark_mode_style',
			array(
				'default' => 'standard',
				'sanitize_callback' => array( $this, 'sanitize_select' ),
			)
		);

		$wp_customize->add_control(
			'nova_ui_dark_mode_style',
			array(
				'label' => __( 'Dark Mode Style', 'nova-ui' ),
				'section' => 'nova_ui_dark_mode_section',
				'type' => 'select',
				'choices' => array(
					'standard' => __( 'Standard Dark', 'nova-ui' ),
					'deep' => __( 'Deep Dark', 'nova-ui' ),
					'blue' => __( 'Dark Blue', 'nova-ui' ),
				),
			)
		);
	}

	/**
	 * Sanitizar checkbox
	 *
	 * @param bool $input Valor a sanitizar.
	 * @return bool Valor sanitizado.
	 */
	public function sanitize_checkbox( $input ) {
		return ( isset( $input ) && true == $input ) ? true : false;
	}

	/**
	 * Sanitizar select
	 *
	 * @param string $input Valor a sanitizar.
	 * @param WP_Customize_Setting $setting Objeto setting.
	 * @return string Valor sanitizado.
	 */
	public function sanitize_select( $input, $setting ) {
		$input = sanitize_key( $input );
		$choices = $setting->manager->get_control( $setting->id )->choices;
		return ( array_key_exists( $input, $choices ) ? $input : $setting->default );
	}

	/**
	 * Obtener el modo actual
	 *
	 * @return string Modo actual ('light', 'dark', 'auto').
	 */
	public static function get_current_mode() {
		// Esta función es para uso interno del tema
		// El modo real se maneja vía JavaScript y CSS
		return get_theme_mod( 'nova_ui_dark_mode_default', 'auto' );
	}
}

// Inicializar la funcionalidad de tema oscuro/claro
new NovaUI_Dark_Mode();

/**
 * Función de ayuda para verificar si el modo oscuro está habilitado
 *
 * @return bool True si el modo oscuro está habilitado, false en caso contrario.
 */
function nova_ui_is_dark_mode_enabled() {
	return get_theme_mod( 'nova_ui_enable_dark_mode', true );
}

/**
 * Función de ayuda para obtener el modo por defecto
 *
 * @return string Modo por defecto ('light', 'dark', 'auto').
 */
function nova_ui_get_default_mode() {
	return get_theme_mod( 'nova_ui_dark_mode_default', 'auto' );
}
