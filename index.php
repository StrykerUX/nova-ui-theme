<?php
/**
 * El template principal.
 *
 * Este es el template más genérico y uno de los dos archivos requeridos para un tema WordPress
 * (el otro es style.css). Se utiliza para mostrar una página cuando nada más específico coincide con una consulta.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package NovaUI
 */

get_header();
?>

<main id="primary" class="site-main">
    <div class="container">
        <?php
        if ( have_posts() ) :

            /* Comenzar el Loop */
            while ( have_posts() ) :
                the_post();

                /*
                 * Incluir el template parcial para el contenido.
                 * Si quieres sobreescribir esto en un child theme, entonces incluye un archivo
                 * llamado content.php en la carpeta /template-parts/ de tu child theme.
                 */
                get_template_part( 'template-parts/content', get_post_type() );

            endwhile;

            the_posts_navigation();

        else :

            get_template_part( 'template-parts/content', 'none' );

        endif;
        ?>
    </div>
</main><!-- #primary -->

<?php
get_sidebar();
get_footer();
