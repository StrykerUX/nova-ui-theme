<?php
/**
 * La barra lateral que contiene los widgets principales.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package NovaUI
 */

// Si estamos en una página sin sidebar, no mostramos nada
if (is_page_template('page-templates/sin-sidebar.php') || is_page_template('page-templates/canvas.php')) {
    return;
}

// Si estamos en el template de dashboard, mostramos la sidebar de dashboard
if (is_page_template('page-templates/dashboard.php')) {
    get_template_part('template-parts/sidebar', 'dashboard');
    return;
}

if (!is_active_sidebar('sidebar-1')) {
    return;
}
?>

<aside id="secondary" class="widget-area sidebar">
    <div class="sidebar-inner">
        <?php dynamic_sidebar('sidebar-1'); ?>
    </div>
</aside><!-- #secondary -->
