<?php
/**
 * Template Name: Sin Sidebar
 *
 * Plantilla con header, footer y contenido a ancho completo.
 *
 * @package NovaUI
 */

get_header();
?>

<div class="page-content-wrapper">
    <div class="container">
        <main id="primary" class="site-main full-width">
            <?php
            while (have_posts()) :
                the_post();
                
                get_template_part('template-parts/content', 'page');
                
                // Si hay comentarios, mostrarlos
                if (comments_open() || get_comments_number()) :
                    comments_template();
                endif;
                
            endwhile;
            ?>
        </main><!-- #primary -->
    </div>
</div>

<?php
get_footer();
