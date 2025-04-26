<?php
/**
 * Template Name: Canvas
 * Description: Una plantilla sin estructura predefinida para máxima flexibilidad
 *
 * @package NovaUI
 */

/**
 * Este template (Canvas) no incluye header ni footer, permitiendo crear estructuras
 * completamente personalizadas desde cero. Ideal para landing pages, checkout, o
 * cualquier página que requiera un diseño totalmente personalizado.
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>

<body <?php body_class('canvas-layout'); ?>>
<?php wp_body_open(); ?>

<main id="primary" class="canvas-main">
	<?php
	while ( have_posts() ) :
		the_post();
		the_content();
	endwhile;
	?>
</main>

<?php wp_footer(); ?>
</body>
</html>
