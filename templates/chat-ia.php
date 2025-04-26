<?php
/**
 * Template Name: Chat IA
 * Description: Template optimizado para el plugin de Chat IA
 *
 * @package NovaUI
 * @subpackage Templates
 */

// Restringir acceso a usuarios logueados
if ( !is_user_logged_in() ) {
    wp_redirect( wp_login_url( get_permalink() ) );
    exit;
}

// Cargar el template de dashboard como base
include_once get_template_directory() . '/templates/dashboard.php';
