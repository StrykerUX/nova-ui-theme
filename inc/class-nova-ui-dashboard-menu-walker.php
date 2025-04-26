<?php
/**
 * Clase personalizada para el menú del dashboard
 *
 * @package NovaUI
 */

/**
 * Clase Nova_UI_Dashboard_Menu_Walker
 * 
 * Personaliza el renderizado del menú de navegación en el dashboard
 * para usar la estructura de clases y elementos del tema NovaUI.
 */
class Nova_UI_Dashboard_Menu_Walker extends Walker_Nav_Menu {

	/**
	 * Starts the list before the elements are added.
	 *
	 * @param string   $output Used to append additional content (passed by reference).
	 * @param int      $depth  Depth of menu item. Used for padding.
	 * @param stdClass $args   An object of wp_nav_menu() arguments.
	 */
	public function start_lvl( &$output, $depth = 0, $args = null ) {
		if ( isset( $args->item_spacing ) && 'discard' === $args->item_spacing ) {
			$t = '';
			$n = '';
		} else {
			$t = "\t";
			$n = "\n";
		}
		$indent = str_repeat( $t, $depth );

		// Cambio: usar clases personalizadas para el submenú
		$classes = array( 'sidebar-submenu' );
		$class_names = join( ' ', apply_filters( 'nav_menu_submenu_css_class', $classes, $args, $depth ) );
		$class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

		$output .= "{$n}{$indent}<ul$class_names>{$n}";
	}

	/**
	 * Starts the element output.
	 *
	 * @param string   $output Used to append additional content (passed by reference).
	 * @param WP_Post  $item   Menu item data object.
	 * @param int      $depth  Depth of menu item. Used for padding.
	 * @param stdClass $args   An object of wp_nav_menu() arguments.
	 * @param int      $id     Current item ID.
	 */
	public function start_el( &$output, $item, $depth = 0, $args = null, $id = 0 ) {
		if ( isset( $args->item_spacing ) && 'discard' === $args->item_spacing ) {
			$t = '';
			$n = '';
		} else {
			$t = "\t";
			$n = "\n";
		}
		$indent = ( $depth ) ? str_repeat( $t, $depth ) : '';

		$classes = empty( $item->classes ) ? array() : (array) $item->classes;
		
		// Cambio: usar clases personalizadas para elementos de menú
		$classes[] = 'sidebar-menu-item';
		
		// Verificar si el elemento tiene elementos hijos
		$has_children = in_array( 'menu-item-has-children', $classes );
		
		// Verificar si el elemento está activo
		$is_active = in_array( 'current-menu-item', $classes ) || in_array( 'current-menu-parent', $classes );
		
		if ( $is_active ) {
			$classes[] = 'active';
		}

		/**
		 * Filters the arguments for a single nav menu item.
		 *
		 * @param stdClass $args  An object of wp_nav_menu() arguments.
		 * @param WP_Post  $item  Menu item data object.
		 * @param int      $depth Depth of menu item. Used for padding.
		 */
		$args = apply_filters( 'nav_menu_item_args', $args, $item, $depth );

		/**
		 * Filters the CSS classes applied to a menu item's list item element.
		 *
		 * @param string[] $classes Array of the CSS classes that are applied to the menu item's `<li>` element.
		 * @param WP_Post  $item    The current menu item.
		 * @param stdClass $args    An object of wp_nav_menu() arguments.
		 * @param int      $depth   Depth of menu item. Used for padding.
		 */
		$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args, $depth ) );
		$class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

		/**
		 * Filters the ID applied to a menu item's list item element.
		 *
		 * @param string   $menu_id The ID that is applied to the menu item's `<li>` element.
		 * @param WP_Post  $item    The current menu item.
		 * @param stdClass $args    An object of wp_nav_menu() arguments.
		 * @param int      $depth   Depth of menu item. Used for padding.
		 */
		$id = apply_filters( 'nav_menu_item_id', 'menu-item-' . $item->ID, $item, $args, $depth );
		$id = $id ? ' id="' . esc_attr( $id ) . '"' : '';

		$output .= $indent . '<li' . $id . $class_names . '>';

		$atts = array();
		$atts['title']  = ! empty( $item->attr_title ) ? $item->attr_title : '';
		$atts['target'] = ! empty( $item->target ) ? $item->target : '';
		$atts['rel']    = ! empty( $item->xfn ) ? $item->xfn : '';
		$atts['href']   = ! empty( $item->url ) ? $item->url : '';
		
		// Cambio: añadir clase para el enlace del menú
		$atts['class']  = 'sidebar-menu-link' . ($is_active ? ' active' : '');

		/**
		 * Filters the HTML attributes applied to a menu item's anchor element.
		 *
		 * @param array $atts {\n*     The HTML attributes applied to the menu item's `<a>` element, empty strings are ignored.
		 *
		 *     @type string $title        Title attribute.
		 *     @type string $target       Target attribute.
		 *     @type string $rel          The rel attribute.
		 *     @type string $href         The href attribute.
		 *     @type string $aria_current The aria-current attribute.
		 * }
		 * @param WP_Post  $item  The current menu item.
		 * @param stdClass $args  An object of wp_nav_menu() arguments.
		 * @param int      $depth Depth of menu item. Used for padding.
		 */
		$atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args, $depth );

		$attributes = '';
		foreach ( $atts as $attr => $value ) {
			if ( is_scalar( $value ) && '' !== $value && false !== $value ) {
				$value       = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
				$attributes .= ' ' . $attr . '="' . $value . '"';
			}
		}

		/** This filter is documented in wp-includes/post-template.php */
		$title = apply_filters( 'the_title', $item->title, $item->ID );

		/**
		 * Filters a menu item's title.
		 *
		 * @param string   $title The menu item's title.
		 * @param WP_Post  $item  The current menu item.
		 * @param stdClass $args  An object of wp_nav_menu() arguments.
		 * @param int      $depth Depth of menu item. Used for padding.
		 */
		$title = apply_filters( 'nav_menu_item_title', $title, $item, $args, $depth );

		// Cambio: estructura personalizada para el enlace con icono
		$item_output = $args->before;
		$item_output .= '<a' . $attributes . '>';
		
		// Obtener el icono del meta field personalizado si existe
		$icon = get_post_meta( $item->ID, '_menu_item_icon', true );
		
		// Si no hay icono personalizado, usar uno predeterminado o basado en el título
		if ( empty( $icon ) ) {
			// Mapeo básico de nombres comunes a iconos
			$icon_map = array(
				'dashboard' => 'nova-icon-dashboard',
				'home' => 'nova-icon-home',
				'profile' => 'nova-icon-user',
				'settings' => 'nova-icon-settings',
				'chat' => 'nova-icon-message-square',
				'links' => 'nova-icon-link',
				'analytics' => 'nova-icon-bar-chart',
				'documents' => 'nova-icon-file-text',
				'calendar' => 'nova-icon-calendar',
				'projects' => 'nova-icon-briefcase',
				'logout' => 'nova-icon-log-out',
			);
			
			$icon = 'nova-icon-circle'; // Icono por defecto
			
			// Buscar coincidencias en el título
			$title_lower = strtolower($title);
			foreach ($icon_map as $keyword => $icon_class) {
				if (strpos($title_lower, $keyword) !== false) {
					$icon = $icon_class;
					break;
				}
			}
		}
		
		$item_output .= '<span class="sidebar-menu-icon"><i class="' . esc_attr($icon) . '"></i></span>';
		$item_output .= '<span class="sidebar-menu-text">' . $args->link_before . $title . $args->link_after . '</span>';
		
		// Si tiene hijos, añadir flecha de despliegue
		if ( $has_children ) {
			$item_output .= '<span class="sidebar-submenu-toggle"><i class="nova-icon-chevron-down"></i></span>';
		}
		
		$item_output .= '</a>';
		$item_output .= $args->after;

		/**
		 * Filters a menu item's starting output.
		 *
		 * The menu item's starting output only includes `$args->before`, the opening `<a>`,
		 * the menu item's title, the closing `</a>`, and `$args->after`. Currently, there is
		 * no filter for modifying the opening and closing `<li>` for a menu item.
		 *
		 * @param string   $item_output The menu item's starting HTML output.
		 * @param WP_Post  $item        Menu item data object.
		 * @param int      $depth       Depth of menu item. Used for padding.
		 * @param stdClass $args        An object of wp_nav_menu() arguments.
		 */
		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}
}

// Registrar la clase para cargarla
if ( ! function_exists( 'nova_ui_register_dashboard_menu_walker' ) ) {
	/**
	 * Registra la clase del Walker para el menú de dashboard
	 */
	function nova_ui_register_dashboard_menu_walker() {
		// Si la clase ya está definida, no hacer nada
		if ( class_exists( 'Nova_UI_Dashboard_Menu_Walker' ) ) {
			return;
		}
		
		// Si no está definida, cargar el archivo (aunque debería estar ya cargado)
		$file_path = get_template_directory() . '/inc/class-nova-ui-dashboard-menu-walker.php';
		if ( file_exists( $file_path ) ) {
			require_once $file_path;
		}
	}
	// Registrar la clase en el gancho apropiado
	add_action( 'after_setup_theme', 'nova_ui_register_dashboard_menu_walker' );
}
