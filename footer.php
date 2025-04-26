<?php
/**
 * Pie de página del tema Nova UI
 *
 * @package Nova_UI
 */

// Evitar acceso directo al archivo
if (!defined('ABSPATH')) {
    exit;
}
?>

    </div><!-- #content-wrapper -->
    
    <footer id="site-footer" class="site-footer">
        <div class="footer-content">
            <div class="copyright">
                <?php
                printf(
                    /* translators: %1$s: Año actual, %2$s: Nombre del sitio */
                    esc_html__('© %1$s %2$s. Todos los derechos reservados.', 'nova-ui'),
                    date_i18n('Y'),
                    get_bloginfo('name')
                );
                ?>
            </div>
            
            <?php if (has_nav_menu('footer')) : ?>
                <nav class="footer-navigation">
                    <?php
                    wp_nav_menu(array(
                        'theme_location' => 'footer',
                        'menu_id'        => 'footer-menu',
                        'container'      => false,
                        'depth'          => 1,
                        'fallback_cb'    => false,
                    ));
                    ?>
                </nav>
            <?php endif; ?>
        </div>
    </footer><!-- #site-footer -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
