<?php
/**
 * Footer específico para el dashboard
 *
 * @package NovaUI
 */

if (!defined('ABSPATH')) {
    exit; // Salir si se accede directamente
}
?>

</div><!-- #page .site .dashboard-layout -->

<?php wp_footer(); ?>

<!-- Scripts adicionales específicos para el dashboard -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Manejar el menú de usuario en el dashboard
        const userBtn = document.querySelector('.user-btn');
        const userDropdown = document.querySelector('.user-dropdown');
        
        if (userBtn && userDropdown) {
            userBtn.addEventListener('click', function(event) {
                event.stopPropagation();
                userDropdown.classList.toggle('active');
            });
            
            // Cerrar menú de usuario al hacer clic fuera
            document.addEventListener('click', function(event) {
                if (userDropdown.classList.contains('active') && 
                    !userDropdown.contains(event.target) && 
                    !userBtn.contains(event.target)) {
                    userDropdown.classList.remove('active');
                }
            });
            
            // Cerrar menú de usuario con Escape
            document.addEventListener('keydown', function(event) {
                if (event.key === 'Escape' && userDropdown.classList.contains('active')) {
                    userDropdown.classList.remove('active');
                }
            });
        }
        
        // Efectos Neo-brutalistas para tarjetas y botones
        const neoElements = document.querySelectorAll('.stats-card, .widget, .page-action-btn');
        
        neoElements.forEach(element => {
            element.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-2px)';
                this.style.transition = 'transform 0.2s ease-out, box-shadow 0.2s ease-out';
                
                // Solo aplicar a algunos elementos
                if (this.classList.contains('page-action-btn')) {
                    this.style.boxShadow = 'var(--shadow-large)';
                }
            });
            
            element.addEventListener('mouseleave', function() {
                this.style.transform = '';
                this.style.boxShadow = '';
            });
        });
        
        // Efecto de "click" para botones
        const neoButtons = document.querySelectorAll('.page-action-btn, .chat-send, .quick-link-edit, .membership-upgrade');
        
        neoButtons.forEach(button => {
            button.addEventListener('mousedown', function() {
                this.style.transform = 'translateY(2px)';
                this.style.boxShadow = 'var(--shadow-active)';
            });
            
            button.addEventListener('mouseup', function() {
                this.style.transform = 'translateY(-2px)';
                this.style.boxShadow = 'var(--shadow-large)';
            });
            
            button.addEventListener('mouseleave', function() {
                this.style.transform = '';
                this.style.boxShadow = '';
            });
        });
    });
</script>

</body>
</html>
