<?php
/**
 * Footer del tema
 *
 * Contiene el cierre de <body> y <html>
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package NovaUI
 */

?>

    <?php 
    // Mostrar footer standard solo si no estamos en una plantilla de dashboard
    if (!is_page_template(array('templates/dashboard.php', 'templates/chat-ai.php', 'templates/quick-links.php'))) : 
    ?>
        <footer id="colophon" class="site-footer">
            <div class="container">
                <div class="site-footer-widgets">
                    <?php 
                    if (is_active_sidebar('footer-widgets')) {
                        dynamic_sidebar('footer-widgets');
                    }
                    ?>
                </div>
                
                <div class="site-footer-navigation">
                    <?php 
                    wp_nav_menu(
                        array(
                            'theme_location' => 'footer',
                            'menu_id'        => 'footer-menu',
                            'container_class' => 'footer-menu-container',
                            'depth'          => 1,
                        )
                    );
                    ?>
                </div>
                
                <div class="site-info">
                    <div class="site-credit">
                        <p>
                            <?php
                            /* translators: %1$s: theme name, %2$s: theme author */
                            printf(esc_html__('%1$s por %2$s', 'novaui'), 'NovaUI', '<a href="https://github.com/StrykerUX">StrykerUX</a>');
                            ?>
                        </p>
                    </div>
                    
                    <!-- Branding del tema con estilo neo-brutalista -->
                    <div class="nova-branding">
                        <div class="nova-brand-box">
                            <span class="nova-brand-text">Nova<span class="nova-brand-accent">UI</span></span>
                        </div>
                    </div>
                </div><!-- .site-info -->
            </div>
        </footer><!-- #colophon -->
    <?php 
    // Si estamos en plantilla dashboard, cargar el footer específico
    elseif (is_page_template('templates/dashboard.php')) : 
        get_template_part('template-parts/dashboard/footer-dashboard');
    else :
        // Para otras plantillas especiales, cargar sus footers específicos
        if (is_page_template('templates/chat-ai.php')) {
            get_template_part('template-parts/dashboard/footer-chat-ai');
        } elseif (is_page_template('templates/quick-links.php')) {
            get_template_part('template-parts/dashboard/footer-quick-links');
        }
    endif; 
    ?>
    
</div><!-- #page -->

<?php wp_footer(); ?>

<!-- Script para activar animaciones de Soft Neobrutalism -->
<script>
    (function() {
        // Activar animaciones de hover para componentes neo-brutalistas
        const neoElements = document.querySelectorAll('.nova-card, .nova-button, .nova-box');
        
        neoElements.forEach(element => {
            element.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-2px)';
                this.style.transition = 'transform 0.2s ease-out, box-shadow 0.2s ease-out';
            });
            
            element.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0)';
            });
        });
        
        // Efecto de "click" para botones neo-brutalistas
        const neoButtons = document.querySelectorAll('.nova-button');
        
        neoButtons.forEach(button => {
            button.addEventListener('mousedown', function() {
                this.style.transform = 'translateY(2px)';
                this.style.boxShadow = '2px 2px 0 rgba(0, 0, 0, 0.1)';
            });
            
            button.addEventListener('mouseup', function() {
                this.style.transform = 'translateY(-2px)';
                this.style.boxShadow = '6px 6px 0 rgba(0, 0, 0, 0.1)';
            });
            
            button.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0)';
                this.style.boxShadow = '4px 4px 0 rgba(0, 0, 0, 0.1)';
            });
        });
    })();
</script>

</body>
</html>
