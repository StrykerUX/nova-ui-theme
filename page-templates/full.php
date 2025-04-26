<?php
/**
 * Template Name: Full
 *
 * Plantilla completa con header, footer, sidebar y contenido principal.
 *
 * @package NovaUI
 */

get_header();
?>

<div class="page-content-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <main id="primary" class="site-main">
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
            
            <div class="col-lg-4">
                <?php get_sidebar(); ?>
            </div>
        </div>
    </div>
</div>

<?php
get_footer();
