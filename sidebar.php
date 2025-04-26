<?php
/**
 * Barra lateral del tema Nova UI
 *
 * @package Nova_UI
 */

// Evitar acceso directo al archivo
if (!defined('ABSPATH')) {
    exit;
}

// Verificar si el sidebar está colapsado
$sidebar_collapsed = isset($_COOKIE['nova_ui_sidebar_collapsed']) ? $_COOKIE['nova_ui_sidebar_collapsed'] === 'true' : false;
$sidebar_class = $sidebar_collapsed ? 'sidebar sidebar-collapsed' : 'sidebar';
?>

<!-- Menú Lateral -->
<aside id="sidebar" class="<?php echo esc_attr($sidebar_class); ?>">
    <!-- Encabezado del sidebar con logo -->
    <div class="sidebar-header">
        <?php if (has_custom_logo()) : ?>
            <div class="sidebar-logo">
                <?php the_custom_logo(); ?>
            </div>
        <?php else : ?>
            <div class="sidebar-logo text-logo">
                <a href="<?php echo esc_url(home_url('/')); ?>" class="logo-link">
                    <div class="logo-icon">
                        <div class="logo-bg" style="background-color: #FF6B6B;">
                            <i class="ti ti-server"></i>
                        </div>
                    </div>
                </a>
            </div>
        <?php endif; ?>
        
        <div class="site-title-container">
            <a href="<?php echo esc_url(home_url('/')); ?>" class="site-title">
                <?php echo esc_html(get_bloginfo('name')); ?>
            </a>
        </div>
        
        <!-- Botón para colapsar el sidebar -->
        <button id="sidebar-collapse-btn" class="sidebar-toggle-btn" aria-label="<?php esc_attr_e('Colapsar menú', 'nova-ui'); ?>">
            <i class="ti ti-menu-2"></i>
        </button>
    </div>
    
    <!-- Navegación principal -->
    <nav id="sidebar-navigation" class="sidebar-navigation">
        <?php
        // Renderizar el menú lateral si está registrado
        if (has_nav_menu('sidebar')) {
            wp_nav_menu(array(
                'theme_location' => 'sidebar',
                'menu_id'        => 'sidebar-menu',
                'container'      => false,
                'menu_class'     => 'sidebar-menu',
                'fallback_cb'    => false,
                'depth'          => 2,
                'walker'         => new Nova_UI_Walker_Nav_Menu(),
            ));
        } else {
            // Menú predeterminado si no hay menú asignado
            ?>
            <ul class="sidebar-menu">
                <li class="menu-item active">
                    <a href="<?php echo esc_url(admin_url()); ?>" class="menu-link">
                        <span class="menu-icon"><i class="ti ti-home"></i></span>
                        <span class="menu-text"><?php esc_html_e('Dashboard', 'nova-ui'); ?></span>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="<?php echo esc_url(admin_url('edit.php?post_type=page')); ?>" class="menu-link">
                        <span class="menu-icon"><i class="ti ti-chart-bar"></i></span>
                        <span class="menu-text"><?php esc_html_e('Analytics', 'nova-ui'); ?></span>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="<?php echo esc_url(admin_url('edit.php')); ?>" class="menu-link">
                        <span class="menu-icon"><i class="ti ti-message-circle"></i></span>
                        <span class="menu-text"><?php esc_html_e('Chat AI', 'nova-ui'); ?></span>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="<?php echo esc_url(admin_url('upload.php')); ?>" class="menu-link">
                        <span class="menu-icon"><i class="ti ti-link"></i></span>
                        <span class="menu-text"><?php esc_html_e('Quick Links', 'nova-ui'); ?></span>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="<?php echo esc_url(admin_url('edit-comments.php')); ?>" class="menu-link">
                        <span class="menu-icon"><i class="ti ti-file"></i></span>
                        <span class="menu-text"><?php esc_html_e('Documents', 'nova-ui'); ?></span>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="<?php echo esc_url(admin_url('themes.php')); ?>" class="menu-link">
                        <span class="menu-icon"><i class="ti ti-calendar"></i></span>
                        <span class="menu-text"><?php esc_html_e('Calendar', 'nova-ui'); ?></span>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="<?php echo esc_url(admin_url('users.php')); ?>" class="menu-link">
                        <span class="menu-icon"><i class="ti ti-briefcase"></i></span>
                        <span class="menu-text"><?php esc_html_e('Projects', 'nova-ui'); ?></span>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="<?php echo esc_url(admin_url('options-general.php')); ?>" class="menu-link">
                        <span class="menu-icon"><i class="ti ti-settings"></i></span>
                        <span class="menu-text"><?php esc_html_e('Settings', 'nova-ui'); ?></span>
                    </a>
                </li>
            </ul>
            <?php
        }
        ?>
    </nav>
    
    <!-- Área inferior del sidebar -->
    <div class="sidebar-footer">
        <div class="help-widget">
            <span class="help-icon">
                <i class="ti ti-help-circle"></i>
            </span>
            <div class="help-content">
                <h4 class="help-title"><?php esc_html_e('¿Necesitas ayuda?', 'nova-ui'); ?></h4>
                <p class="help-text"><?php esc_html_e('Consulta la documentación', 'nova-ui'); ?></p>
            </div>
        </div>
    </div>
</aside><!-- #sidebar -->
