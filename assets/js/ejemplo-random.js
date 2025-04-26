/**
 * Script para la página de ejemplo - NovaUI Theme
 * 
 * Añade interacciones específicas para la página de demostración
 */

document.addEventListener('DOMContentLoaded', function() {
    // Añadir efectos visuales a los botones
    const buttons = document.querySelectorAll('.neo-button');
    buttons.forEach(button => {
        // Efecto de presión al hacer clic
        button.addEventListener('mousedown', function() {
            this.style.transform = 'translateY(0)';
            this.style.boxShadow = '2px 2px 0 rgba(0, 0, 0, 0.1)';
        });
        
        // Restaurar al soltar
        button.addEventListener('mouseup', function() {
            this.style.transform = 'translateY(-2px)';
            this.style.boxShadow = '6px 6px 0 rgba(0, 0, 0, 0.1)';
        });
        
        // También restaurar si el mouse sale del botón
        button.addEventListener('mouseleave', function() {
            this.style.transform = '';
            this.style.boxShadow = '';
        });
    });
    
    // Añadir efecto de hover a las tarjetas
    const cards = document.querySelectorAll('.neo-card');
    cards.forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-5px)';
            this.style.boxShadow = '8px 8px 0 rgba(0, 0, 0, 0.1)';
            this.style.transition = 'transform 0.3s ease, box-shadow 0.3s ease';
        });
        
        card.addEventListener('mouseleave', function() {
            this.style.transform = '';
            this.style.boxShadow = '';
        });
    });
    
    // Inicializar una animación simple para los badges
    const badges = document.querySelectorAll('.neo-badge');
    badges.forEach(badge => {
        // Añadir una pulsación sutil
        setInterval(() => {
            badge.classList.add('pulse');
            
            setTimeout(() => {
                badge.classList.remove('pulse');
            }, 1000);
        }, 3000);
    });
    
    // Añadir estilos CSS para la animación de pulso
    const style = document.createElement('style');
    style.textContent = `
        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
        }
        
        .pulse {
            animation: pulse 1s ease;
        }
    `;
    document.head.appendChild(style);
});
