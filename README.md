# NovaUI - Tema WordPress con Estilo Neo-Brutalista

NovaUI es un tema WordPress personalizado con un diseño neo-brutalista suave (Soft Neo-Brutalism) y elementos de interfaz inspirados en videojuegos indie.

## Características Principales

- **Diseño Neo-Brutalista**: Con bordes definidos, sombras características y un estilo visual único.
- **Modo Claro/Oscuro**: Sistema integrado de tema claro y oscuro con detección automática de preferencias.
- **Dashboard Moderno**: Interfaz de dashboard con sidebar colapsable, tarjetas de estadísticas y widgets.
- **Componentes Interactivos**: Botones, tarjetas, badges y elementos UI con estética de videojuegos.
- **Sistema de Variables CSS**: Más de 40 variables CSS para personalizar todos los aspectos visuales.
- **Plantillas Especializadas**: Templates para diferentes layouts y propósitos.

## Paleta de Colores

El tema utiliza una paleta de colores cuidadosamente seleccionada para crear un diseño atractivo y moderno:

- **Coral (#FF6B6B)**: Color principal para elementos destacados y botones primarios.
- **Teal (#4ECDC4)**: Color secundario para elementos informativos y relacionados con IA.
- **Amarillo (#FFE66D)**: Color de acento para notificaciones y badges.
- **Verde Pastel (#7BC950)**: Para elementos de éxito y métricas positivas.
- **Naranja Suave (#FFA552)**: Para advertencias y elementos que requieren atención.
- **Rosa-Rojo (#F76F8E)**: Para errores y alertas.

## Estructura del Tema

El tema está organizado de la siguiente manera:

```
nova-ui-theme/
├── assets/
│   ├── css/
│   │   ├── base/              # Estilos base como tipografía, reset, etc.
│   │   ├── components/        # Componentes UI (botones, tarjetas, etc.)
│   │   ├── templates/         # Estilos específicos para plantillas
│   │   ├── dark-mode.css      # Estilos para modo oscuro
│   │   ├── main.css           # Archivo principal que importa todo
│   │   └── variables.css      # Variables CSS globales
│   └── js/
│       ├── dashboard.js       # Funcionalidades del dashboard
│       ├── dark-mode.js       # Control de tema oscuro
│       └── navigation.js      # Control de menús y navegación
├── inc/
│   ├── customizer/            # Funciones del personalizador
│   ├── helpers/               # Funciones de utilidad
│   ├── shortcodes/            # Definición de shortcodes
│   └── woocommerce/           # Integración con WooCommerce
├── templates/
│   ├── partials/              # Partes reutilizables de templates
│   ├── template-dashboard.php # Template base para dashboard
│   └── template-dashboard-example.php # Ejemplo completo del dashboard
└── functions.php              # Funciones principales del tema
```

## Dashboard Neo-Brutalista

### Características del Dashboard

- **Sidebar Colapsable**: Menú lateral que puede minimizarse para maximizar el espacio de trabajo.
- **Tema Claro/Oscuro**: Toggle para cambiar entre temas, con guardado de preferencias.
- **Tarjetas de Estadísticas**: Visualización de datos con estilo neo-brutalista.
- **Widgets Interactivos**: Componentes funcionales para chat, enlaces rápidos y más.
- **Interfaz Responsiva**: Adaptable a diferentes tamaños de pantalla.

### Componentes Principales

- **Stats Cards**: Tarjetas para mostrar métricas y estadísticas.
- **Chat Widget**: Componente para interacciones conversacionales con IA.
- **Quick Links**: Gestor de enlaces con estadísticas de visitas.
- **Task Manager**: Organizador de tareas con prioridades y estados.
- **Membership Panel**: Visualización de plan, recursos y límites.

## Instalación

1. Descarga el tema desde este repositorio.
2. Sube la carpeta `nova-ui-theme` al directorio `wp-content/themes/` de tu instalación WordPress.
3. Activa el tema desde el panel de administración de WordPress (Apariencia > Temas).
4. Navega a la página de ejemplo en `/dashboard-ejemplo` para ver el dashboard en acción.

## Uso

### Crear una Página con Dashboard

1. Crea una nueva página en WordPress.
2. En el panel de atributos de página, selecciona "Dashboard Example" como plantilla.
3. Publica la página y visítala para ver el dashboard con todos los componentes.

### Personalizar Colores

El tema utiliza variables CSS que pueden ser modificadas para personalizar todos los aspectos visuales. Puedes cambiar estas variables a través del plugin NovaStudio o editando directamente los archivos CSS.

Las principales variables se encuentran en `assets/css/variables.css` y para el modo oscuro en `assets/css/dark-mode.css`.

## Funcionalidades JavaScript

El tema incluye varias funcionalidades JavaScript:

- **Toggle de Sidebar**: Permite colapsar/expandir el sidebar lateral.
- **Control de Tema Oscuro**: Cambia entre tema claro y oscuro con guardado de preferencia.
- **Animaciones de Estadísticas**: Contador animado para las cifras en tarjetas de stats.
- **Menú de Usuario**: Dropdown con opciones de perfil y cuenta.

## Agradecimientos

- Iconos proporcionados por [Lucide Icons](https://lucide.dev/).
- Framework base: [PicoCSS](https://picocss.com/).

## Licencia

Este tema está licenciado bajo [MIT](LICENSE).
