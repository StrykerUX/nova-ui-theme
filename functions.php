<?php
/**
 * Funciones principales del tema NovaUI
 *
 * @package NovaUI
 */

// Información del tema
if ( ! defined( 'NOVAUI_VERSION' ) ) {
    define( 'NOVAUI_VERSION', '0.1.0' );
}

/**
 * Configuración del tema
 */
function nova_ui_setup() {
    // Añadir soporte para traducciones
    load_theme_textdomain( 'nova-ui', get_template_directory() . '/languages' );

    // Añadir soporte para varios features de WordPress
    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'custom-logo', array(
        'height'      => 60,
        'width'       => 200,
        'flex-height' => true,
        'flex-width'  => true,
    ) );
    add_theme_support( 'customize-selective-refresh-widgets' );
    add_theme_support( 'automatic-feed-links' );
    add_theme_support( 'html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'style',
        'script',
    ) );

    // Añadir soporte para tema oscuro/claro
    add_theme_support( 'dark-editor-style' );
    
    // Registrar menús
    register_nav_menus( array(
        'menu-primary'   => esc_html__( 'Menu Principal', 'nova-ui' ),
        'menu-sidebar'   => esc_html__( 'Menu Sidebar', 'nova-ui' ),
        'menu-footer'    => esc_html__( 'Menu Footer', 'nova-ui' ),
    ) );
}
add_action( 'after_setup_theme', 'nova_ui_setup' );

/**
 * Registrar sidebars
 */
function nova_ui_widgets_init() {
    register_sidebar( array(
        'name'          => esc_html__( 'Sidebar', 'nova-ui' ),
        'id'            => 'sidebar-1',
        'description'   => esc_html__( 'Añade widgets aquí.', 'nova-ui' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ) );
    
    register_sidebar( array(
        'name'          => esc_html__( 'Footer 1', 'nova-ui' ),
        'id'            => 'footer-1',
        'description'   => esc_html__( 'Añade widgets en la primera columna del footer.', 'nova-ui' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ) );
    
    register_sidebar( array(
        'name'          => esc_html__( 'Footer 2', 'nova-ui' ),
        'id'            => 'footer-2',
        'description'   => esc_html__( 'Añade widgets en la segunda columna del footer.', 'nova-ui' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ) );
    
    register_sidebar( array(
        'name'          => esc_html__( 'Footer 3', 'nova-ui' ),
        'id'            => 'footer-3',
        'description'   => esc_html__( 'Añade widgets en la tercera columna del footer.', 'nova-ui' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ) );
}
add_action( 'widgets_init', 'nova_ui_widgets_init' );

/**
 * Cargar scripts y estilos
 */
function nova_ui_scripts() {
    // Estilos principales
    wp_enqueue_style( 'nova-ui-style', get_stylesheet_uri(), array(), NOVAUI_VERSION );
    wp_enqueue_style( 'nova-ui-main', get_template_directory_uri() . '/assets/css/main.css', array(), NOVAUI_VERSION );
    
    // Scripts
    wp_enqueue_script( 'nova-ui-navigation', get_template_directory_uri() . '/assets/js/navigation.js', array(), NOVAUI_VERSION, true );
    wp_enqueue_script( 'nova-ui-dark-mode', get_template_directory_uri() . '/assets/js/dark-mode.js', array(), NOVAUI_VERSION, true );
    
    // Cargar scripts específicos para los templates de dashboard
    if ( is_page_template( array(
        'templates/template-dashboard.php',
        'templates/template-dashboard-example.php' 
    ) ) ) {
        wp_enqueue_script( 'nova-ui-dashboard', get_template_directory_uri() . '/assets/js/dashboard.js', array(), NOVAUI_VERSION, true );
    }
    
    // Si es la página de ejemplo aleatorio, cargar estilos adicionales
    if ( is_page( 'ejemplo-random' ) ) {
        wp_enqueue_script( 'nova-ui-ejemplo', get_template_directory_uri() . '/assets/js/ejemplo-random.js', array(), NOVAUI_VERSION, true );
    }
    
    // Pasar variables a JavaScript
    wp_localize_script( 'nova-ui-dark-mode', 'novaUISettings', array(
        'ajaxurl' => admin_url( 'admin-ajax.php' ),
        'themeDir' => get_template_directory_uri(),
    ) );
}
add_action( 'wp_enqueue_scripts', 'nova_ui_scripts' );

/**
 * Añadir la clase al body para tema oscuro
 */
function nova_ui_body_classes( $classes ) {
    // Añadir clase para tema oscuro si está habilitado
    $dark_mode = isset( $_COOKIE['nova_ui_dark_mode'] ) ? $_COOKIE['nova_ui_dark_mode'] : 'auto';
    
    if ( $dark_mode === 'dark' ) {
        $classes[] = 'dark-mode';
    }
    
    // Añadir clase para las páginas de dashboard
    if ( is_page_template( array( 
        'templates/template-dashboard.php',
        'templates/template-dashboard-example.php'
    ) ) ) {
        $classes[] = 'dashboard-page';
    }
    
    return $classes;
}
add_filter( 'body_class', 'nova_ui_body_classes' );

/**
 * Implementar handler AJAX para guardar preferencia de tema oscuro
 */
function nova_ui_set_dark_mode() {
    if ( isset( $_POST['mode'] ) ) {
        $mode = sanitize_text_field( $_POST['mode'] );
        setcookie( 'nova_ui_dark_mode', $mode, time() + YEAR_IN_SECONDS, COOKIEPATH, COOKIE_DOMAIN );
    }
    
    wp_die();
}
add_action( 'wp_ajax_nova_ui_set_dark_mode', 'nova_ui_set_dark_mode' );
add_action( 'wp_ajax_nopriv_nova_ui_set_dark_mode', 'nova_ui_set_dark_mode' );

/**
 * Incluir archivos adicionales
 */

// Helpers y funciones de utilidad
require get_template_directory() . '/inc/helpers/helpers.php';

// Personalización del tema
require get_template_directory() . '/inc/customizer/customizer.php';

// Shortcodes
require get_template_directory() . '/inc/shortcodes/shortcodes.php';

// Funciones para WooCommerce (si está activo)
if ( class_exists( 'WooCommerce' ) ) {
    require get_template_directory() . '/inc/woocommerce/woocommerce.php';
}

/**
 * Crear la página de ejemplo aleatorio cuando se active el tema
 */
function nova_ui_create_example_page() {
    // Comprobar si ya existen las páginas de ejemplo
    $example_page = get_page_by_path( 'ejemplo-random' );
    $dashboard_example = get_page_by_path( 'dashboard-ejemplo' );
    
    if ( ! $example_page ) {
        // Crear la página de ejemplo random
        $page_id = wp_insert_post( array(
            'post_title'     => 'Ejemplo-random',
            'post_name'      => 'ejemplo-random',
            'post_status'    => 'publish',
            'post_type'      => 'page',
            'post_content'   => '<!-- wp:shortcode -->[nova_ui_example_content]<!-- /wp:shortcode -->',
            'comment_status' => 'closed',
        ) );
    }
    
    if ( ! $dashboard_example ) {
        // Crear la página de ejemplo del dashboard
        $page_id = wp_insert_post( array(
            'post_title'     => 'Dashboard Ejemplo',
            'post_name'      => 'dashboard-ejemplo',
            'post_status'    => 'publish',
            'post_type'      => 'page',
            'page_template'  => 'templates/template-dashboard-example.php',
            'comment_status' => 'closed',
        ) );
    }
}
add_action( 'after_switch_theme', 'nova_ui_create_example_page' );

/**
 * Añadir shortcodes específicos para la página de ejemplo
 */
function nova_ui_example_content_shortcode() {
    ob_start();
    ?>
    <div class="ejemplo-random-container">
        <h1 class="ejemplo-random-title">Ejemplo de Componentes NovaUI</h1>
        <p class="ejemplo-random-subtitle">Diseño Neo-brutalista con estilo de UI de videojuegos</p>
        
        <section class="example-section">
            <h2 class="example-section__title">Cards y Tarjetas</h2>
            <div class="neo-grid">
                <div class="neo-card">
                    <h3 class="neo-card__title">
                        <?php nova_ui_svg_icon( 'heart', 'md' ); ?>
                        Tarjeta Principal
                    </h3>
                    <p>Este es un ejemplo de tarjeta con estilo neo-brutalista. Tiene bordes definidos, esquinas redondeadas y una sombra característica.</p>
                    <div class="example-demo">
                        <a href="#" class="neo-button neo-button--primary">Botón Primario</a>
                    </div>
                </div>
                
                <div class="neo-card">
                    <h3 class="neo-card__title">
                        <?php nova_ui_svg_icon( 'bar-chart-2', 'md' ); ?>
                        Estadísticas
                    </h3>
                    <p>Este componente muestra datos estadísticos con un estilo visual llamativo, ideal para dashboards.</p>
                    <div class="example-demo">
                        <a href="#" class="neo-button neo-button--secondary">Ver Datos</a>
                    </div>
                </div>
                
                <div class="neo-card">
                    <h3 class="neo-card__title">
                        <?php nova_ui_svg_icon( 'message-square', 'md' ); ?>
                        Mensajes
                    </h3>
                    <p>Sistema de chat con burbújas de mensaje y indicadores de estado para conversaciones en tiempo real.</p>
                    <div class="example-demo">
                        <a href="#" class="neo-button neo-button--accent">Iniciar Chat</a>
                    </div>
                </div>
            </div>
        </section>
        
        <section class="example-section">
            <h2 class="example-section__title">Botones y Acciones</h2>
            <div class="neo-card">
                <h3 class="neo-card__title">
                    <?php nova_ui_svg_icon( 'plus', 'md' ); ?>
                    Variantes de Botones
                </h3>
                <p>Los botones tienen diferentes estilos según su propósito e importancia. Todos comparten características como bordes definidos, esquinas redondeadas y sombras.</p>
                <div class="example-demo">
                    <a href="#" class="neo-button neo-button--primary">Primario</a>
                    <a href="#" class="neo-button neo-button--secondary">Secundario</a>
                    <a href="#" class="neo-button neo-button--accent">Acento</a>
                    <a href="#" class="neo-button neo-button--outline">Outline</a>
                </div>
            </div>
        </section>
        
        <section class="example-section">
            <h2 class="example-section__title">Badges e Indicadores</h2>
            <div class="neo-card">
                <h3 class="neo-card__title">
                    <?php nova_ui_svg_icon( 'alert-circle', 'md' ); ?>
                    Estados y Notificaciones
                </h3>
                <p>Los badges permiten mostrar estados, cantidades o categorías con un formato compacto y visualmente llamativo.</p>
                <div class="example-demo">
                    <span class="neo-badge neo-badge--primary">Nuevo</span>
                    <span class="neo-badge neo-badge--secondary">Activo</span>
                    <span class="neo-badge neo-badge--accent">Premium</span>
                </div>
            </div>
        </section>
        
        <section class="example-section">
            <h2 class="example-section__title">Panel de Dashboard</h2>
            <div class="neo-card">
                <h3 class="neo-card__title">
                    <?php nova_ui_svg_icon( 'layout-grid', 'md' ); ?>
                    Ejemplo de Dashboard
                </h3>
                <p>El tema incluye un diseño de dashboard completo con sidebar, menú de navegación, estadísticas y widgets para visualización de datos.</p>
                <div class="example-demo">
                    <a href="<?php echo esc_url( get_permalink( get_page_by_path( 'dashboard-ejemplo' ) ) ); ?>" class="neo-button neo-button--primary">Ver Dashboard</a>
                </div>
            </div>
        </section>
    </div>
    <?php
    return ob_get_clean();
}
add_shortcode( 'nova_ui_example_content', 'nova_ui_example_content_shortcode' );

/**
 * Función para imprimir iconos SVG
 */
function nova_ui_svg_icon( $icon, $size = 'md' ) {
    $sizes = array(
        'sm' => 16,
        'md' => 18,
        'lg' => 24,
        'xl' => 32
    );
    
    $icon_size = isset( $sizes[$size] ) ? $sizes[$size] : $sizes['md'];
    
    switch ( $icon ) {
        case 'heart':
            echo '<svg xmlns="http://www.w3.org/2000/svg" width="' . $icon_size . '" height="' . $icon_size . '" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path></svg>';
            break;
        case 'bar-chart-2':
            echo '<svg xmlns="http://www.w3.org/2000/svg" width="' . $icon_size . '" height="' . $icon_size . '" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="20" x2="18" y2="10"></line><line x1="12" y1="20" x2="12" y2="4"></line><line x1="6" y1="20" x2="6" y2="14"></line></svg>';
            break;
        case 'message-square':
            echo '<svg xmlns="http://www.w3.org/2000/svg" width="' . $icon_size . '" height="' . $icon_size . '" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path></svg>';
            break;
        case 'plus':
            echo '<svg xmlns="http://www.w3.org/2000/svg" width="' . $icon_size . '" height="' . $icon_size . '" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>';
            break;
        case 'alert-circle':
            echo '<svg xmlns="http://www.w3.org/2000/svg" width="' . $icon_size . '" height="' . $icon_size . '" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12.01" y2="16"></line></svg>';
            break;
        case 'layout-grid':
            echo '<svg xmlns="http://www.w3.org/2000/svg" width="' . $icon_size . '" height="' . $icon_size . '" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="7" height="7"></rect><rect x="14" y="3" width="7" height="7"></rect><rect x="14" y="14" width="7" height="7"></rect><rect x="3" y="14" width="7" height="7"></rect></svg>';
            break;
        default:
            echo '<svg xmlns="http://www.w3.org/2000/svg" width="' . $icon_size . '" height="' . $icon_size . '" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle></svg>';
            break;
    }
}
