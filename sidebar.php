<?php
/**
 * Sidebar del tema
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package NovaUI
 */

// Si estamos en una plantilla de dashboard, no mostrar el sidebar estándar
if (is_page_template(array('templates/dashboard.php', 'templates/chat-ai.php', 'templates/quick-links.php'))) {
    return;
}

// Si no hay widgets activos en el sidebar, no mostrar nada
if (!is_active_sidebar('sidebar-1')) {
    return;
}
?>

<aside id="secondary" class="widget-area nova-sidebar">
    <div class="nova-sidebar-inner">
        <?php dynamic_sidebar('sidebar-1'); ?>
    </div>
</aside><!-- #secondary -->
