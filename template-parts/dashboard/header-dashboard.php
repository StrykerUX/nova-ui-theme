<?php
/**
 * Header específico para el dashboard
 *
 * @package NovaUI
 */

if (!defined('ABSPATH')) {
    exit; // Salir si se accede directamente
}
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
    
    <!-- Cargar Font Awesome para iconos -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    
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

<body <?php body_class('dashboard-page'); ?>>
<?php wp_body_open(); ?>

<div id="page" class="site dashboard-layout">
