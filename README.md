# Nova UI Theme para WordPress

Un tema moderno de WordPress con diseño Neo Brutalismo Suave para interfaces tipo SaaS y paneles de administración.

![Nova UI Theme](https://github.com/StrykerUX/nova-ui-theme/raw/main/screenshot.png)

## 📋 Características principales

- **Diseño Neo Brutalismo Suave** - Estética moderna con sombras duras, bordes marcados y paleta vibrante
- **100% Responsivo** - Funciona perfectamente en dispositivos móviles, tablets y escritorio
- **Panel lateral personalizable** - Menú lateral con soporte para iconos Tabler y múltiples niveles
- **Tema oscuro/claro** - Soporte nativo para cambiar entre modo claro y oscuro
- **Plantillas especializadas** - Dashboard, Canvas y más para crear interfaces SaaS
- **Widgets modernos** - Tarjetas de estadísticas, chat AI, enlaces rápidos y más
- **Altamente personalizable** - Variables CSS para modificar colores, espaciados y más
- **Optimizado para SEO** - Estructura semántica y código limpio

## 🚀 Instalación

### Requisitos previos
- WordPress 5.8+
- PHP 7.4+
- MySQL 5.6+ o MariaDB 10.1+

### Instalación manual
1. Descarga la última versión del tema desde GitHub.
2. Ve al panel de administración de WordPress > Apariencia > Temas > Añadir nuevo.
3. Haz clic en "Subir tema".
4. Selecciona el archivo ZIP descargado y haz clic en "Instalar ahora".
5. Una vez instalado, haz clic en "Activar".

### Instalación mediante FTP
1. Extrae el archivo ZIP descargado en tu computadora.
2. Sube la carpeta extraída al directorio `/wp-content/themes/` de tu servidor.
3. Ve al panel de administración de WordPress > Apariencia > Temas.
4. Busca "Nova UI" y haz clic en "Activar".

## 📂 Estructura del tema

```
nova-ui/
├── assets/                      # Recursos estáticos
│   ├── css/                     # Hojas de estilo
│   │   └── main.css             # Estilos principales
│   ├── js/                      # Scripts
│   │   └── main.js              # Script principal
│   └── images/                  # Imágenes
├── inc/                         # Funciones y clases adicionales
│   ├── class-nova-ui-walker-nav-menu.php  # Walker para el menú
│   ├── template-functions.php   # Funciones de plantilla
│   └── template-tags.php        # Etiquetas de plantilla
├── page-templates/              # Plantillas de página
│   ├── dashboard.php            # Plantilla para dashboard
│   └── (otras plantillas)
├── footer.php                   # Pie de página
├── functions.php                # Funciones principales
├── header.php                   # Cabecera
├── index.php                    # Archivo principal
├── sidebar.php                  # Barra lateral
└── style.css                    # Hoja de estilos principal (datos del tema)
```

## 🛠️ Personalización

### Variables CSS
El tema utiliza variables CSS personalizables que puedes modificar para adaptar el aspecto visual:

```css
:root {
    --color-background: #f8f9fc;
    --color-surface: #ffffff;
    --color-primary: #FF6B6B;
    --color-secondary: #4ECDC4;
    --color-accent: #FF8A5B;
    /* más variables... */
}
```

Puedes sobrescribir estas variables en tu CSS personalizado para cambiar colores, espaciados, tipografía y más.

### Modo oscuro
Para personalizar el modo oscuro, puedes modificar las variables dentro del selector `[data-theme="dark"]`:

```css
[data-theme="dark"] {
    --color-background: #1f2937;
    --color-surface: #2c3849;
    /* más variables... */
}
```

## 📱 Plantillas disponibles

### Dashboard (dashboard.php)
Una plantilla completa para crear un dashboard administrativo con:

- **Tarjetas de estadísticas** - Muestra KPIs importantes como ventas, usuarios, etc.
- **Widget de Chat AI** - Interfaz para interactuar con inteligencia artificial
- **Enlaces rápidos** - Accesos directos a páginas importantes
- **Actividades recientes** - Cronología de eventos

#### Uso:
1. Crea una nueva página en WordPress
2. En el panel de atributos de página, selecciona "Dashboard" como plantilla
3. Publica la página

## 🌙 Modo oscuro/claro

El tema incluye soporte para cambiar entre modo claro y oscuro:

1. Los usuarios pueden alternar entre ambos temas usando el botón en la barra superior
2. La preferencia se guarda automáticamente usando localStorage
3. Los colores se adaptan automáticamente mediante variables CSS

## 📱 Responsividad

El tema está optimizado para diferentes tamaños de pantalla:

- **Escritorio**: Sidebar expandido, visualización completa
- **Tablet**: Sidebar colapsable con iconos
- **Móvil**: Sidebar oculto con menú hamburguesa

## 🔍 SEO

Nova UI está optimizado para SEO con:

- Markup HTML5 semántico
- Microdata para mejorar la visibilidad en motores de búsqueda
- Código limpio y optimizado
- Estructura de encabezados adecuada

## 👨‍💻 Desarrollo

Para desarrollar o personalizar el tema:

1. Clona el repositorio
2. Realiza tus modificaciones
3. Envía un pull request con tus cambios

## 📄 Licencia

Este tema está licenciado bajo [GPL v2 o posterior](https://www.gnu.org/licenses/gpl-2.0.html).

## ❤️ Créditos

- Iconos: [Tabler Icons](https://tabler-icons.io/)
- Diseño basado en elementos de Neo Brutalismo Suave

---

Desarrollado por StrykerUX
