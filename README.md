# NovaUI WordPress Theme

Un tema de WordPress personalizado con un diseño Soft Neobrutalism e inspiración en interfaces de videojuegos indie.

## Características Principales

- **Diseño Soft Neobrutalism**: Elementos visuales con bordes marcados, esquinas redondeadas y sombras distintivas
- **Elementos UI de Videojuego**: Barras de progreso, contadores y componentes visuales inspirados en juegos indie
- **Modo Claro/Oscuro**: Implementación de tema con detección automática de preferencias del sistema
- **Sistema de Variables CSS**: Extensa personalización a través de variables CSS
- **Optimización Desktop-first**: Diseñado principalmente para experiencias de escritorio

## Estructura de Carpetas

```
nova-ui-theme/
├── assets/                  # Recursos estáticos (CSS, JS, imágenes)
│   ├── css/                 # Archivos CSS compilados y fuentes
│   │   ├── components/      # Estilos de componentes individuales
│   │   ├── layouts/         # Estilos para diferentes layouts
│   │   ├── variables/       # Variables CSS para personalización
│   │   └── main.css         # Archivo CSS principal compilado
│   ├── js/                  # Archivos JavaScript
│   │   ├── components/      # Scripts para componentes específicos
│   │   ├── theme/           # Scripts relacionados con la funcionalidad del tema
│   │   └── main.js          # Archivo JS principal
│   └── images/              # Imágenes e iconos del tema
├── inc/                     # Archivos PHP de funcionalidad
│   ├── customizer/          # Ajustes del personalizador de WordPress
│   ├── template-functions/  # Funciones auxiliares para templates
│   ├── template-tags/       # Tags de plantilla reutilizables
│   └── theme-setup.php      # Configuración inicial del tema
├── template-parts/          # Partes reutilizables de plantillas
│   ├── components/          # Componentes UI reutilizables
│   ├── content/             # Partes de contenido (blog, página, etc.)
│   ├── header/              # Variaciones de cabeceras
│   ├── footer/              # Variaciones de pies de página
│   └── sidebar/             # Variaciones de barras laterales
├── templates/               # Plantillas de página específicas
│   ├── canvas.php           # Plantilla Canvas sin cabecera/pie
│   ├── full.php             # Plantilla de ancho completo
│   ├── no-sidebar.php       # Plantilla sin barra lateral
│   ├── dashboard.php        # Plantilla tipo Dashboard
│   ├── chat-ai.php          # Plantilla para Chat IA
│   └── quicklinks.php       # Plantilla para Quick Links
├── woocommerce/             # Plantillas personalizadas para WooCommerce
├── functions.php            # Funciones principales del tema
├── style.css                # Hoja de estilo principal y metadatos
├── index.php                # Plantilla principal
├── header.php               # Cabecera del sitio
├── footer.php               # Pie de página del sitio
├── sidebar.php              # Barra lateral predeterminada
└── screenshot.png           # Captura de pantalla del tema
```

## Paleta de Colores

- **Primarios**:
  - Coral: `#FF6B6B`
  - Teal: `#4ECDC4`
  - Amarillo: `#FFE66D`
- **Estados**:
  - Verde: `#7BC950` (Éxito)
  - Naranja: `#FFA552` (Advertencia)
  - Rosa-rojo: `#F76F8E` (Error)
- **Base**:
  - Gris-púrpura: `#505168` (Modo oscuro)
  - Blanco hueso: `#F7F9F9` (Modo claro)

## Tipografía

- **Fuentes principales**: Jost, Quicksand

## Requisitos Técnicos

- WordPress 5.8+
- PHP 7.4+
- Base CSS: PicoCSS

## Instalación

1. Descarga el tema
2. Sube la carpeta `nova-ui-theme` a la carpeta `/wp-content/themes/` de tu instalación WordPress
3. Activa el tema a través del menú 'Apariencia > Temas' en WordPress

## Personalización

El tema NovaUI está diseñado para ser altamente personalizable. La mayoría de los ajustes visuales pueden modificarse a través del personalizador de WordPress.

Para personalizaciones avanzadas, se recomienda utilizar un tema hijo.

## Licencia

GPL v2 o posterior
