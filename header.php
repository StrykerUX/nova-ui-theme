<?php
/**
 * Cabecera del tema Nova UI
 *
 * @package Nova_UI
 */

// Evitar acceso directo al archivo
if (!defined('ABSPATH')) {
    exit;
}

$is_dark_mode = nova_ui_is_dark_mode();
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?> data-theme="<?php echo $is_dark_mode ? 'dark' : 'light'; ?>">
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<div id="page" class="site">
    <div id="content-wrapper" class="content-wrapper">
        <!-- Barra superior -->
        <header id="top-navbar" class="top-navbar">
            <div class="top-navbar-left">
                <!-- Botón de toggle para el menú lateral en móvil -->
                <button id="sidebar-toggle" class="sidebar-toggle" aria-label="<?php esc_attr_e('Alternar menú', 'nova-ui'); ?>">
                    <i class="ti ti-menu-2"></i>
                </button>
                
                <!-- Formulario de búsqueda -->
                <form role="search" method="get" class="search-form" action="<?php echo esc_url(home_url('/')); ?>">
                    <div class="search-container">
                        <i class="ti ti-search search-icon"></i>
                        <input type="search" class="search-input" placeholder="<?php esc_attr_e('Buscar...', 'nova-ui'); ?>" name="s" aria-label="<?php esc_attr_e('Buscar', 'nova-ui'); ?>">
                        <span class="shortcut-hint">⌘K</span>
                    </div>
                </form>
            </div>
            
            <div class="top-navbar-right">
                <!-- Botón de notificaciones -->
                <div class="navbar-item">
                    <button class="navbar-icon-btn" aria-label="<?php esc_attr_e('Notificaciones', 'nova-ui'); ?>">
                        <i class="ti ti-bell"></i>
                    </button>
                </div>
                
                <!-- Botón para cambiar entre modo claro/oscuro -->
                <div class="navbar-item">
                    <button id="theme-toggle" class="navbar-icon-btn" aria-label="<?php esc_attr_e('Cambiar tema', 'nova-ui'); ?>">
                        <i class="ti <?php echo $is_dark_mode ? 'ti-sun' : 'ti-moon'; ?>"></i>
                    </button>
                </div>
                
                <!-- Perfil de usuario -->
                <div class="navbar-item user-profile">
                    <?php 
                    // Mostrar avatar del usuario actual o iniciales si no tiene avatar
                    $current_user = wp_get_current_user();
                    if ($current_user->exists()) {
                        $user_name = $current_user->display_name;
                        $avatar = get_avatar($current_user->ID, 32, '', $user_name, array('class' => 'user-avatar'));
                        
                        if (!$avatar) {
                            $initials = nova_ui_get_initials($user_name);
                            $bg_color = nova_ui_generate_color($user_name);
                            
                            echo '<div class="user-initials" style="background-color: ' . esc_attr($bg_color) . ';">';
                            echo esc_html($initials);
                            echo '</div>';
                        } else {
                            echo $avatar;
                        }
                    } else {
                        // Mostrar avatar genérico si no hay usuario
                        echo '<div class="user-initials" style="background-color: #FF6B6B;">G</div>';
                    }
                    ?>
                </div>
            </div>
        </header><!-- #top-navbar -->
