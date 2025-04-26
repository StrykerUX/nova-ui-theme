<?php
/**
 * Template para mostrar páginas
 *
 * Este es el template que muestra todas las páginas por defecto.
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
        while (have_posts()) :
            the_post();

            get_template_part('template-parts/content', 'page');

            // Si los comentarios están abiertos o tenemos al menos un comentario, cargamos el template de comentarios
            if (comments_open() || get_comments_number()) :
                comments_template();
            endif;

        endwhile; // End of the loop.
        ?>
    </div>
</main><!-- #primary -->

<?php
get_sidebar();
get_footer();
