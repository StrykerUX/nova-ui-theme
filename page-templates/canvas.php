<?php
/**
 * Template Name: Canvas
 *
 * Plantilla sin estructura predefinida para máxima flexibilidad.
 * Ideal para landing pages o páginas personalizadas.
 *
 * @package NovaUI
 */

?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <?php wp_head(); ?>
</head>

<body <?php body_class('canvas-template'); ?>>
<?php wp_body_open(); ?>

<main id="primary" class="site-main">
    <?php
    while (have_posts()) :
        the_post();
        
        // El contenido de la página sin estructura adicional
        the_content();
        
    endwhile;
    ?>
</main>

<?php wp_footer(); ?>
</body>
</html>
