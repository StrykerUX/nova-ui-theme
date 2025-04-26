# NovaUI Theme

Un tema WordPress personalizado para plataformas SaaS con diseño neo-brutalista suave y elementos de UI de videojuego indie.

## Características

- Tema WordPress personalizado para plataformas SaaS
- Diseño Neo-brutalista suave con elementos de UI de videojuego indie
- Sistema de variables CSS para personalización completa (30-50 variables)
- Soporte para tema claro/oscuro con detección automática de preferencias
- Plantillas especializadas para diferentes contextos:
  - Canvas (página en blanco para máxima flexibilidad)
  - Full (con header, footer, sidebar y contenido principal)
  - Sin Sidebar (contenido a ancho completo)
  - Dashboard (panel especializado para usuario)
- Sistema de shortcodes para creación rápida de contenido
- Integración con WooCommerce y complementos de membresía
- Soporte para plugins propios: Chat IA, Quick Links, y CRM

## Estilo Neo-Brutalista

NovaUI implementa un estilo Neo-Brutalista suave con elementos de UI de videojuego indie de manera consistente en **todos los componentes**. Este estilo se caracteriza por:

- Bordes visibles y definidos
- Esquinas redondeadas
- Sombras características (no difuminadas)
- Colores vibrantes pero no agresivos
- Elementos inspirados en interfaces de videojuegos

Tenemos una [guía completa de estilo Neo-Brutalista](docs/neo-brutalism-style-guide.md) para mantener la consistencia visual en todo el tema.

## Estructura del Proyecto

```
nova-ui-theme/
├── assets/
│   ├── css/
│   │   ├── base/               # Estilos base y reset
│   │   │   ├── neo-brutalism.css  # Base Neo-Brutalista global
│   │   │   └── neo-helpers.css   # Helpers para estilos Neo-Brutalistas
│   │   ├── components/         # Componentes reutilizables
│   │   ├── templates/          # Estilos específicos por plantilla
│   │   ├── woocommerce/        # Personalización WooCommerce
│   │   ├── variables.css       # Variables CSS globales (tema claro)
│   │   └── dark-mode.css       # Variables para tema oscuro
│   ├── js/
│   │   ├── components/         # Scripts para componentes específicos
│   │   ├── theme-customizer.js # Interacción con personalizador
│   │   └── dark-mode.js        # Control de tema oscuro/claro
│   └── fonts/                  # Fuentes locales (si las hay)
├── inc/
│   ├── customizer/             # Funciones del personalizador
│   ├── template-parts/         # Partes reutilizables de templates
│   ├── woocommerce/            # Integraciones con WooCommerce
│   └── shortcodes/             # Sistema de shortcodes
├── templates/
│   ├── canvas.php              # Template en blanco
│   ├── full.php                # Template completo
│   ├── sin-sidebar.php         # Template sin sidebar
│   └── dashboard.php           # Template para dashboard
├── woocommerce/                # Templates sobrescritas de WooCommerce
├── docs/
│   └── neo-brutalism-style-guide.md # Guía de estilo Neo-Brutalista
├── functions.php               # Funciones principales del tema
└── style.css                   # Información del tema
```

## Sistema de Variables CSS

NovaUI implementa un sistema completo de variables CSS que permite una personalización sencilla y coherente. Sigue el estándar de 30-50 variables organizadas en categorías:

- **Colores base** (primario, secundario, acento, éxito, advertencia, error)
- **Estados de componentes interactivos** (hover, active, etc.)
- **Tipografía** (familias, tamaños, pesos)
- **Espaciado y layout** (márgenes, paddings, anchos de contenedor)
- **Componentes específicos** (tarjetas, buttons, inputs, etc.)
- **Tema claro/oscuro** (variables específicas para cada modo)

### Principales Variables

```css
:root {
  /* Colores principales */
  --color-primary: #FF6B6B;     /* Coral */
  --color-secondary: #4ECDC4;   /* Teal suave */
  --color-accent: #FFE66D;      /* Amarillo cálido */
  
  /* Tipografía */
  --font-primary: 'Jost', 'Quicksand', sans-serif;
  --font-size-base: 16px;
  
  /* Espaciado */
  --spacing-base: 1rem;
  
  /* Bordes y esquinas */
  --border-radius-lg: 0.5rem;
  --border-width: 2px;
  
  /* Sombras neo-brutalistas */
  --shadow-md: 6px 6px 0 rgba(0, 0, 0, 0.1);
}
```

## Aplicando el Estilo Neo-Brutalista

El estilo Neo-Brutalista está implementado a nivel global a través de:

1. **Base global**: En `assets/css/base/neo-brutalism.css` que define la estética fundamental.
2. **Helpers utilitarios**: En `assets/css/base/neo-helpers.css` con clases para aplicación rápida.
3. **Variables CSS**: En `assets/css/variables.css` con los valores que definen el aspecto visual.

### Clases Principales

```html
<!-- Usando componentes Neo-Brutalistas -->
<div class="neo-container">
  <h2 class="neo-heading">Título</h2>
  <p>Contenido de ejemplo...</p>
  <button class="neo-button neo-button--primary">Acción</button>
</div>

<!-- Usando helpers utilitarios -->
<div class="card card-primary">
  <div class="card-header">
    <h3 class="card-title">Título de Tarjeta</h3>
  </div>
  <div class="card-body">
    <p>Contenido...</p>
  </div>
  <div class="card-footer">
    <button class="btn btn-primary">Acción</button>
  </div>
</div>
```

Para más detalles, consulta la [guía de estilo Neo-Brutalista](docs/neo-brutalism-style-guide.md).

## Sistema de Shortcodes

NovaUI incluye un completo sistema de shortcodes para facilitar la creación de contenido estructurado:

### Shortcodes de Layout

- `[saas_section]` - Para contenedores principales
- `[saas_row]` y `[saas_column]` - Para sistema de grid

### Shortcodes de Componentes

- `[saas_heading]` - Para títulos y encabezados
- `[saas_button]` - Para botones y llamados a la acción
- `[saas_feature]` - Para bloques de características
- `[saas_testimonial]` - Para testimonios
- `[saas_cta]` - Para llamadas a la acción

### Ejemplo de Uso

```
[saas_section layout="hero" padding="xl" background="#f5f8ff"]
    [saas_row align="center"]
        [saas_column width="50%"]
            [saas_heading size="2xl"]Potencia tu Negocio con IA Especializada[/saas_heading]
            [saas_text]Nuestros chatbots con IA pre-entrenada están diseñados específicamente para emprendedores y PyMEs en México y Latinoamérica. Automatiza la atención al cliente, genera contenido y más.[/saas_text]
            [saas_button url="/registro" style="primary" size="lg"]Comenzar Ahora[/saas_button] [saas_button url="/demos" style="outline" size="lg"]Ver Demos[/saas_button]
        [/saas_column]
        [saas_column width="50%"]
            [saas_image src="/wp-content/uploads/2025/04/dashboard-preview.png" alt="Dashboard de IA" class="rounded-xl shadow-lg"]
        [/saas_column]
    [/saas_row]
[/saas_section]
```

## Requisitos

- WordPress 5.5 o superior
- PHP 7.4 o superior
- Navegadores modernos (2 últimas versiones)

## Instalación

1. Descarga el archivo zip del tema
2. Ve a tu panel de administración de WordPress > Apariencia > Temas > Añadir nuevo > Subir tema
3. Selecciona el archivo zip y haz clic en "Instalar ahora"
4. Activa el tema

## Personalización

NovaUI está diseñado para trabajar con el plugin NovaStudio que permite personalización extensiva. También puedes personalizar el tema a través del Personalizador de WordPress incluido:

1. Ve a Apariencia > Personalizar
2. Explora las opciones en el panel "NovaUI Theme Options":
   - Colores
   - Tipografía
   - Layout
   - Características adicionales

## Desarrollo

### Requisitos para desarrollo

- Node.js 14.x o superior
- npm 6.x o superior

### Instrucciones para desarrollo

1. Clona este repositorio:
   ```bash
   git clone https://github.com/StrykerUX/nova-ui-theme.git
   cd nova-ui-theme
   ```

2. Instala las dependencias (cuando se implemente el sistema de build):
   ```bash
   npm install
   ```

3. Para desarrollo (watches y compilación automática):
   ```bash
   npm run dev
   ```

4. Para compilar para producción:
   ```bash
   npm run build
   ```

## WooCommerce

NovaUI incluye soporte completo para WooCommerce con estilos personalizados para:

- Páginas de productos
- Carrito
- Checkout
- Mi cuenta
- Membresías (si está activo WooCommerce Memberships)

## Integraciones con Plugins Propios

### Chat IA
- Estilos para interfaz de chat
- Componentes para asistentes de IA
- Visualización de tokens y recursos

### Quick Links
- Estilos para tarjetas de enlaces
- Sistemas de edición y estadísticas
- Templates personalizados para perfiles

### Futuro CRM
- Estructura base para componentes
- Preparación para integración fluida

## Licencia

Este tema está licenciado bajo la [GNU General Public License v2 o posterior](https://www.gnu.org/licenses/gpl-2.0.html).

## Créditos

- Diseñado y desarrollado por StrykerUX
- Utiliza [PicoCSS](https://picocss.com/) como framework base
- Iconos de [Lucide Icons](https://lucide.dev/)
