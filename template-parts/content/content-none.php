<?php
/**
 * Template part para mostrar un mensaje cuando no se encuentra contenido
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package NovaUI
 */

?>

<section class="no-results not-found nova-card">
    <header class="page-header">
        <h1 class="page-title"><?php esc_html_e('No se encontró nada', 'novaui'); ?></h1>
    </header><!-- .page-header -->

    <div class="page-content">
        <?php
        if (is_home() && current_user_can('publish_posts')) :

            printf(
                '<p>' . wp_kses(
                    /* translators: 1: link to WP admin new post page. */
                    __('¿Listo para publicar tu primer post? <a href="%1$s">Comienza aquí</a>.', 'novaui'),
                    array(
                        'a' => array(
                            'href' => array(),
                        ),
                    )
                ) . '</p>',
                esc_url(admin_url('post-new.php'))
            );

        elseif (is_search()) :
            ?>

            <p><?php esc_html_e('Lo sentimos, pero no se encontró nada que coincida con tus términos de búsqueda. Por favor, intenta nuevamente con algunas palabras clave diferentes.', 'novaui'); ?></p>
            <?php
            get_search_form();

        else :
            ?>

            <p><?php esc_html_e('Parece que no podemos encontrar lo que estás buscando. Tal vez la búsqueda pueda ayudar.', 'novaui'); ?></p>
            <?php
            get_search_form();

        endif;
        ?>
    </div><!-- .page-content -->
</section><!-- .no-results -->
