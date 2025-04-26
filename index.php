<?php
/**
 * El archivo principal del tema
 *
 * @package NovaUI
 */

get_header();
?>

<main id="primary" class="site-main">
    <?php
    if ( have_posts() ) :
        while ( have_posts() ) :
            the_post();
            get_template_part( 'inc/template-parts/content', get_post_type() );
        endwhile;

        the_posts_navigation();
    else :
        get_template_part( 'inc/template-parts/content', 'none' );
    endif;
    ?>
</main>

<?php
get_sidebar();
get_footer();
