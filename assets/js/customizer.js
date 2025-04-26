/**
 * Archivo usado para manejar actualizaciones en tiempo real del customizador
 *
 * @package NovaUI
 */

(function($) {
  'use strict';

  // Actualizar título del sitio en tiempo real
  wp.customize('blogname', function(value) {
    value.bind(function(to) {
      $('.site-title a').text(to);
    });
  });

  // Actualizar descripción del sitio en tiempo real
  wp.customize('blogdescription', function(value) {
    value.bind(function(to) {
      $('.site-description').text(to);
    });
  });

  // Actualizar colores principales
  wp.customize('nova_ui_primary_color', function(value) {
    value.bind(function(to) {
      document.documentElement.style.setProperty('--color-primary', to);
      
      // Calcular colores derivados para hover y active
      const lighterColor = adjustColor(to, 20); // 20% más claro para hover
      const darkerColor = adjustColor(to, -20); // 20% más oscuro para active
      
      document.documentElement.style.setProperty('--color-primary-hover', lighterColor);
      document.documentElement.style.setProperty('--color-primary-active', darkerColor);
    });
  });

  wp.customize('nova_ui_secondary_color', function(value) {
    value.bind(function(to) {
      document.documentElement.style.setProperty('--color-secondary', to);
    });
  });

  wp.customize('nova_ui_accent_color', function(value) {
    value.bind(function(to) {
      document.documentElement.style.setProperty('--color-accent', to);
    });
  });

  // Función helper para ajustar color
  function adjustColor(color, percent) {
    // Convertir hex a rgb
    let r = parseInt(color.substring(1, 3), 16);
    let g = parseInt(color.substring(3, 5), 16);
    let b = parseInt(color.substring(5, 7), 16);

    // Ajustar por porcentaje
    r = Math.min(255, Math.max(0, r + percent));
    g = Math.min(255, Math.max(0, g + percent));
    b = Math.min(255, Math.max(0, b + percent));

    // Convertir rgb a hex
    const rr = ((r.toString(16).length === 1) ? '0' + r.toString(16) : r.toString(16));
    const gg = ((g.toString(16).length === 1) ? '0' + g.toString(16) : g.toString(16));
    const bb = ((b.toString(16).length === 1) ? '0' + b.toString(16) : b.toString(16));

    return `#${rr}${gg}${bb}`;
  }

})(jQuery);
