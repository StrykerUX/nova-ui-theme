<?php
/**
 * Header del tema
 *
 * Este es el template que muestra todo el contenido <head> y abre el <body>
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package NovaUI
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    
    <!-- Añadir preconexión a CDNs externos para mejorar rendimiento -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://cdnjs.cloudflare.com">
    
    <!-- Cargar fuentes Jost y Quicksand -->
    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@300;400;500;600;700&family=Quicksand:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Agregar scripts para detección de preferencia de modo oscuro -->
    <script>
        // Comprobar la preferencia del sistema o la cookie guardada
        function isUserPrefersDark() {
            // Primero verificar si hay una preferencia guardada
            if (localStorage.getItem('novaui_dark_mode') !== null) {
                return localStorage.getItem('novaui_dark_mode') === 'true';
            }
            
            // Si no hay preferencia guardada, comprobar la preferencia del sistema
            return window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches;
        }
        
        // Aplicar clase al documento HTML inmediatamente para evitar flash de luz
        document.documentElement.classList.toggle('dark-mode', isUserPrefersDark());
    </script>
    
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<div id="page" class="site <?php echo is_page_template('templates/dashboard.php') ? 'dashboard-layout' : ''; ?>">
    
    <?php 
    // Mostrar header standard solo si no estamos en una plantilla de dashboard
    if (!is_page_template(array('templates/dashboard.php', 'templates/chat-ai.php', 'templates/quick-links.php'))) : 
    ?>
    <header id="masthead" class="site-header">
        <div class="container">
            <div class="site-header-inner">
                <div class="site-branding">
                    <?php
                    the_custom_logo();
                    if (is_front_page() && is_home()) :
                    ?>
                        <h1 class="site-title"><a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php bloginfo('name'); ?></a></h1>
                    <?php
                    else :
                    ?>
                        <p class="site-title"><a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php bloginfo('name'); ?></a></p>
                    <?php
                    endif;
                    
                    $novaui_description = get_bloginfo('description', 'display');
                    if ($novaui_description || is_customize_preview()) :
                    ?>
                        <p class="site-description"><?php echo $novaui_description; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></p>
                    <?php endif; ?>
                </div><!-- .site-branding -->

                <nav id="site-navigation" class="main-navigation">
                    <button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false">
                        <span class="menu-toggle-icon"></span>
                        <?php esc_html_e('Menú', 'novaui'); ?>
                    </button>
                    <?php
                    wp_nav_menu(
                        array(
                            'theme_location' => 'primary',
                            'menu_id'        => 'primary-menu',
                            'container_class' => 'primary-menu-container',
                        )
                    );
                    ?>
                </nav><!-- #site-navigation -->
                
                <!-- Botón toggle para modo oscuro/claro -->
                <button id="theme-switcher" class="theme-toggle" aria-label="<?php esc_attr_e('Cambiar modo', 'novaui'); ?>">
                    <span class="theme-toggle-dark"><i class="fas fa-moon"></i></span>
                    <span class="theme-toggle-light"><i class="fas fa-sun"></i></span>
                </button>
            </div>
        </div>
    </header><!-- #masthead -->
    <?php 
    // Si estamos en plantilla dashboard, cargar el header específico
    elseif (is_page_template('templates/dashboard.php')) : 
        get_template_part('template-parts/dashboard/header-dashboard');
    else :
        // Para otras plantillas especiales, cargar sus headers específicos
        if (is_page_template('templates/chat-ai.php')) {
            get_template_part('template-parts/dashboard/header-chat-ai');
        } elseif (is_page_template('templates/quick-links.php')) {
            get_template_part('template-parts/dashboard/header-quick-links');
        }
    endif; 
    ?>
