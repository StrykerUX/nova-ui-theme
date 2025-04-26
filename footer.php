<?php
/**
 * El template para mostrar el footer
 *
 * Contiene el cierre de las etiquetas <main> y <div id="page">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package NovaUI
 */

?>

	<footer id="colophon" class="site-footer">
    <?php if (!is_page_template('page-templates/canvas.php')) : ?>
        <div class="container">
            <div class="footer-widgets">
                <div class="footer-widget-1">
                    <?php if (is_active_sidebar('footer-1')) : ?>
                        <?php dynamic_sidebar('footer-1'); ?>
                    <?php else : ?>
                        <div class="footer-branding">
                            <?php if (has_custom_logo()) : ?>
                                <div class="footer-logo">
                                    <?php the_custom_logo(); ?>
                                </div>
                            <?php else : ?>
                                <div class="site-name">
                                    <h2 class="footer-title"><?php bloginfo('name'); ?></h2>
                                </div>
                            <?php endif; ?>
                            <p class="footer-description"><?php echo get_bloginfo('description'); ?></p>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="footer-widget-2">
                    <?php if (is_active_sidebar('footer-2')) : ?>
                        <?php dynamic_sidebar('footer-2'); ?>
                    <?php else : ?>
                        <h2 class="footer-title"><?php esc_html_e('Quick Links', 'novaui'); ?></h2>
                        <?php
                        wp_nav_menu(
                            array(
                                'theme_location' => 'menu-2',
                                'menu_id'        => 'footer-menu',
                                'depth'          => 1,
                                'container'      => false,
                                'fallback_cb'    => false,
                            )
                        );
                        ?>
                    <?php endif; ?>
                </div>

                <div class="footer-widget-3">
                    <?php if (is_active_sidebar('footer-3')) : ?>
                        <?php dynamic_sidebar('footer-3'); ?>
                    <?php else : ?>
                        <h2 class="footer-title"><?php esc_html_e('Contact', 'novaui'); ?></h2>
                        <ul class="footer-contact">
                            <li><a href="mailto:<?php echo esc_attr(antispambot('info@example.com')); ?>"><?php echo esc_html(antispambot('info@example.com')); ?></a></li>
                            <li><a href="tel:+123456789"><?php esc_html_e('+1 (234) 567-89', 'novaui'); ?></a></li>
                        </ul>
                        <div class="footer-social">
                            <a href="#" class="social-icon" aria-label="<?php esc_attr_e('Facebook', 'novaui'); ?>"><span class="icon-facebook"></span></a>
                            <a href="#" class="social-icon" aria-label="<?php esc_attr_e('Twitter', 'novaui'); ?>"><span class="icon-twitter"></span></a>
                            <a href="#" class="social-icon" aria-label="<?php esc_attr_e('Instagram', 'novaui'); ?>"><span class="icon-instagram"></span></a>
                            <a href="#" class="social-icon" aria-label="<?php esc_attr_e('LinkedIn', 'novaui'); ?>"><span class="icon-linkedin"></span></a>
                        </div>
                    <?php endif; ?>
                </div>
            </div><!-- .footer-widgets -->

            <div class="site-info">
                <div class="copyright">
                    &copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>. <?php esc_html_e('All rights reserved.', 'novaui'); ?>
                </div>
                <div class="footer-links">
                    <a href="<?php echo esc_url(get_privacy_policy_url()); ?>"><?php esc_html_e('Privacy Policy', 'novaui'); ?></a>
                    <a href="#"><?php esc_html_e('Terms of Service', 'novaui'); ?></a>
                    <a href="#"><?php esc_html_e('Sitemap', 'novaui'); ?></a>
                </div>
                <div class="theme-info">
                    <?php
                    /* translators: %s: Theme name. */
                    printf(esc_html__('Theme: %s', 'novaui'), 'NovaUI');
                    ?>
                </div>
            </div><!-- .site-info -->
        </div><!-- .container -->
    <?php endif; ?>
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
