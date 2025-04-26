# NovaUI - Tema WordPress con Estilo Soft Neo-Brutalista

NovaUI es un tema WordPress personalizado con un diseño neo-brutalista suave (Soft Neo-Brutalism) y elementos de interfaz inspirados en videojuegos indie.

## Características Principales

- **Diseño Soft Neo-Brutalista**: Con bordes definidos, sombras características y un estilo visual único.
- **Modo Claro/Oscuro**: Sistema integrado de tema claro y oscuro con detección automática de preferencias.
- **Dashboard Moderno**: Interfaz de dashboard con sidebar colapsable, tarjetas de estadísticas y widgets.
- **Componentes Interactivos**: Botones, tarjetas, badges y elementos UI con estética de videojuegos.
- **Sistema de Variables CSS**: Entre 40 y 50 variables CSS para personalizar todos los aspectos visuales.
- **Plantillas Especializadas**: Templates para diferentes layouts y propósitos.

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

## Estructura del Proyecto

```
nova-ui-theme/
├── assets/
│   ├── css/
│   │   ├── components/            # Estilos de componentes individuales
│   │   ├── templates/             # Estilos específicos para plantillas
│   │   ├── variables.css          # Variables CSS globales
│   │   ├── base.css               # Estilos base (reset, tipografía)
│   │   ├── utilities.css          # Clases utilitarias
│   │   └── main.css               # Archivo principal que importa todos los CSS
│   ├── js/
│   │   ├── components/            # Scripts para componentes específicos
│   │   ├── theme-switcher.js      # Manejo del cambio de tema (claro/oscuro)
│   │   ├── sidebar.js             # Funcionalidad del sidebar
│   │   └── main.js                # Script principal
│   ├── fonts/                     # Archivos de fuentes
│   └── images/                    # Imágenes del tema
├── inc/
│   ├── customizer.php             # Funciones del personalizador
│   ├── template-functions.php     # Funciones auxiliares para templates
│   ├── template-tags.php          # Etiquetas de plantilla reutilizables
│   └── enqueue-scripts.php        # Registro de scripts y estilos
├── template-parts/
│   ├── components/                # Componentes reutilizables (tarjetas, botones)
│   ├── content/                   # Plantillas de contenido
│   └── dashboard/                 # Componentes específicos del dashboard
├── templates/
│   ├── canvas.php                 # Template: Canvas
│   ├── full-width.php             # Template: Full Width
│   ├── no-sidebar.php             # Template: Sin Sidebar
│   ├── dashboard.php              # Template: Dashboard
│   ├── chat-ai.php                # Template: Chat IA
│   └── quick-links.php            # Template: Quick Links
├── functions.php                  # Funciones principales del tema
├── header.php                     # Header del tema
├── footer.php                     # Footer del tema
├── sidebar.php                    # Sidebar del tema
├── index.php                      # Template principal
├── single.php                     # Template para posts individuales
├── page.php                       # Template para páginas
├── archive.php                    # Template para archivos
├── search.php                     # Template para resultados de búsqueda
├── 404.php                        # Template para página 404
└── style.css                      # Información del tema y estilos base
```

## Requerimientos

- WordPress 5.9 o superior
- PHP 7.4 o superior
- PicoCSS (incluido)

## Instalación

1. Descarga el archivo ZIP del tema
2. En tu panel de WordPress, ve a Apariencia > Temas > Añadir nuevo
3. Haz clic en "Subir tema" y selecciona el archivo ZIP descargado
4. Activa el tema

## Desarrollo

Este tema está diseñado de forma modular para facilitar su mantenimiento y extensión. Todos los archivos están estructurados para no exceder las 1200 líneas de código, siguiendo las mejores prácticas de desarrollo.
