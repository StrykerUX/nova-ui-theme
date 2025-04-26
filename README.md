# NovaUI - Tema WordPress con Estilo Soft Neo-Brutalista

NovaUI es un tema WordPress personalizado con un diseño neo-brutalista suave (Soft Neo-Brutalism) y elementos de interfaz inspirados en videojuegos indie.

## Características Principales

- **Diseño Soft Neo-Brutalista**: Con bordes definidos, sombras características y un estilo visual único.
- **Modo Claro/Oscuro**: Sistema integrado de tema claro y oscuro con detección automática de preferencias.
- **Dashboard Moderno**: Interfaz de dashboard con sidebar colapsable, tarjetas de estadísticas y widgets.
- **Componentes Interactivos**: Botones, tarjetas, badges y elementos UI con estética de videojuegos.
- **Sistema de Variables CSS**: Más de 50 variables CSS para personalizar todos los aspectos visuales.
- **Plantillas Especializadas**: Templates para diferentes layouts y propósitos (Dashboard, Chat AI, Quick Links).

## Paleta de Colores

- **Primarios**: 
  - Coral (#FF6B6B)
  - Teal (#4ECDC4)
  - Amarillo (#FFE66D)
- **Estados**: 
  - Verde (#7BC950)
  - Naranja (#FFA552)
  - Rosa-rojo (#F76F8E)
- **Base**: 
  - Gris-púrpura (#505168)
  - Blanco hueso (#F7F9F9)

## Demostración

El tema incluye una plantilla de dashboard que muestra la interfaz Soft Neo-Brutalista con todos los componentes principales. Para verlo:

1. Crea una nueva página
2. Selecciona la plantilla "Dashboard" 
3. Publica la página y visítala para ver la interfaz completa

## Estructura del Proyecto

```
nova-ui-theme/
├── assets/
│   ├── css/
│   │   ├── components/
│   │   │   ├── buttons.css        # Estilos para botones neo-brutalistas
│   │   │   ├── cards.css          # Estilos para tarjetas y contenedores
│   │   │   ├── dashboard.css      # Estilos específicos del dashboard
│   │   │   ├── forms.css          # Estilos para formularios
│   │   │   ├── modals.css         # Estilos para ventanas modales
│   │   │   └── widgets.css        # Estilos para widgets del dashboard
│   │   ├── templates/
│   │   │   ├── dashboard.css      # Estilos específicos para plantilla dashboard
│   │   │   ├── chat-ai.css        # Estilos específicos para plantilla chat AI
│   │   │   ├── quick-links.css    # Estilos específicos para plantilla quick links
│   │   │   └── canvas.css         # Estilos para plantilla canvas (blank)
│   │   ├── variables.css          # Variables CSS globales y paleta de colores
│   │   ├── base.css               # Estilos base (reset, tipografía)
│   │   ├── utilities.css          # Clases utilitarias
│   │   ├── main.css               # Archivo principal que importa todos los CSS
│   │   └── editor-style.css       # Estilos para el editor Gutenberg
│   ├── js/
│   │   ├── components/
│   │   │   ├── dashboard.js       # Funcionalidad del dashboard
│   │   │   ├── sidebar.js         # Funcionalidad del sidebar colapsable
│   │   │   └── charts.js          # Gráficos y visualizaciones
│   │   ├── theme-switcher.js      # Script para cambio de tema claro/oscuro
│   │   ├── customizer.js          # Script para el personalizador
│   │   └── main.js                # Script principal del tema
│   ├── fonts/                     # Archivos de fuentes
│   └── images/                    # Imágenes del tema
├── inc/
│   ├── customizer.php             # Opciones del personalizador
│   ├── template-functions.php     # Funciones auxiliares para templates
│   ├── template-tags.php          # Etiquetas de plantilla reutilizables
│   └── enqueue-scripts.php        # Registro de scripts y estilos
├── template-parts/
│   ├── dashboard/                 # Partes específicas para el dashboard
│   │   ├── header-dashboard.php   # Header específico del dashboard
│   │   └── footer-dashboard.php   # Footer específico del dashboard
│   ├── content/                   # Plantillas de contenido
│   │   ├── content-page.php       # Contenido para páginas
│   │   └── content-none.php       # Cuando no hay contenido
│   └── components/                # Componentes reutilizables
├── templates/
│   ├── dashboard.php              # Plantilla del Dashboard
│   ├── chat-ai.php                # Plantilla de Chat IA
│   ├── quick-links.php            # Plantilla de Quick Links
│   ├── canvas.php                 # Plantilla Canvas (sin estructura)
│   ├── full-width.php             # Plantilla de ancho completo
│   └── no-sidebar.php             # Plantilla sin sidebar
├── functions.php                  # Funciones principales del tema
├── header.php                     # Header del tema
├── footer.php                     # Footer del tema
├── sidebar.php                    # Sidebar del tema
├── index.php                      # Template principal
├── page.php                       # Template para páginas
├── single.php                     # Template para posts individuales
├── archive.php                    # Template para archivos
├── search.php                     # Template para resultados de búsqueda
├── 404.php                        # Template para página 404
└── style.css                      # Información del tema y estilos base
```

## Guía de Desarrollo

### Principios de Diseño Soft Neo-Brutalista

Este tema sigue los principios del diseño "Soft Neo-Brutalism":

1. **Bordes Visibles**: Elementos con bordes definidos de 2px por defecto
2. **Sombras Características**: Sombras con desplazamiento en lugar de difuminado (6px 6px 0)
3. **Colores Vibrantes**: Paleta de colores vibrante y contrastante
4. **Simplicidad Honesta**: Interfaces directas y legibles
5. **Elementos de UI de Videojuego**: Barras de progreso, contadores y elementos interactivos

### Variables CSS

El tema utiliza un sistema completo de variables CSS, lo que permite personalizar fácilmente todos los aspectos visuales. Las variables principales están en `assets/css/variables.css`.

Ejemplos:

```css
/* Colores */
--color-primary: #FF6B6B;
--color-secondary: #4ECDC4;

/* Espaciado */
--spacing-sm: 0.5rem;
--spacing-md: 1rem;

/* Sombras */
--shadow-normal: 6px 6px 0 rgba(0, 0, 0, 0.1);
```

### Modificación de la Intensidad Neo-Brutalista

El tema permite 3 niveles de intensidad del estilo Neo-Brutalista, configurable desde el personalizador:

- **Light**: Bordes finos (1px), sombras sutiles
- **Medium**: Equilibrado, bordes estándar (2px), sombras moderadas
- **Strong**: Bordes gruesos (3px), sombras pronunciadas

### Sistema de Componentes

Todos los componentes visuales siguen estos patrones de nomenclatura:

- Tarjetas: `.nova-card`, `.nova-card-primary`, etc.
- Botones: `.nova-button`, `.nova-button-accent`, etc.
- Elementos de dashboard: `.dashboard-header`, `.dashboard-sidebar`, etc.

### Creación de Páginas Personalizadas

Para añadir una página con el estilo dashboard:

1. Crear una nueva página en WordPress
2. Seleccionar la plantilla "Dashboard" en el panel lateral
3. Personalizar el contenido según necesidades

## Requerimientos

- WordPress 5.9 o superior
- PHP 7.4 o superior
- PicoCSS (incluido)

## Instalación

1. Descarga el archivo ZIP del tema
2. En tu panel de WordPress, ve a Apariencia > Temas > Añadir nuevo
3. Haz clic en "Subir tema" y selecciona el archivo ZIP descargado
4. Activa el tema

## Personalización

Navega a Apariencia > Personalizar y encontrarás opciones para:

- Colores primarios, secundarios y de acento
- Modo de tema predeterminado (claro/oscuro/auto)
- Intensidad del estilo Neo-Brutalista
- Activar/desactivar elementos de UI de videojuego

## Contribuir

Si deseas contribuir al desarrollo de NovaUI:

1. Haz un fork del repositorio
2. Crea una rama para tu función (`git checkout -b feature/amazing-feature`)
3. Haz commit de tus cambios (`git commit -m 'Add some amazing feature'`)
4. Envía la rama (`git push origin feature/amazing-feature`)
5. Abre un Pull Request

## Licencia

Distribuido bajo licencia GPL v2 o posterior. Consulta el archivo `LICENSE` para más información.
