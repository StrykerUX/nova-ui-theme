# Nova UI Theme

Un tema moderno con diseño Neo Brutalismo Suave para interfaces tipo SaaS y paneles de administración. Optimizado para WordPress, pero también utilizable como theme independiente.

![Nova UI Theme](/screenshot.png)

## 📋 Características principales

- **Diseño Neo Brutalismo Suave** - Estética moderna con sombras definidas, bordes marcados y paleta vibrante
- **100% Responsivo** - Funciona perfectamente en dispositivos móviles, tablets y escritorio
- **Panel lateral personalizable** - Menú lateral con soporte para iconos y múltiples niveles
- **Tema oscuro/claro** - Soporte nativo para cambiar entre modo claro y oscuro
- **Plantillas especializadas** - Dashboard, Canvas y más para crear interfaces SaaS
- **Widgets modernos** - Tarjetas de estadísticas, chat AI, enlaces rápidos y más
- **Altamente personalizable** - Variables CSS para modificar colores, espaciados y más
- **Efectos visuales** - Animaciones y efectos específicos del estilo neo-brutalista

## 🚀 Instalación como tema HTML

1. Clona este repositorio:
   ```
   git clone https://github.com/StrykerUX/nova-ui-theme.git
   ```

2. Abre `dashboard-static.html` en tu navegador para ver la demo estática del dashboard.

3. Copia los archivos CSS y JS en tu proyecto:
   - `assets/css/main.css` - Estilos principales
   - `assets/css/neo-brutalism.css` - Efectos visuales del estilo neo-brutalista
   - `assets/css/variables.css` - Variables CSS para personalización
   - `assets/js/main.js` - Funcionalidades principales
   - `assets/js/dashboard.js` - Funcionalidades específicas del dashboard

## 🚀 Instalación como tema WordPress

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

## 🎨 Personalización

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

## 📱 Estructura de archivos

```
nova-ui/
├── assets/                      # Recursos estáticos
│   ├── css/                     # Hojas de estilo
│   │   ├── main.css             # Estilos principales
│   │   ├── neo-brutalism.css    # Efectos visuales neo-brutalistas
│   │   └── variables.css        # Variables CSS
│   ├── js/                      # Scripts
│   │   ├── main.js              # Script principal
│   │   └── dashboard.js         # Scripts del dashboard
│   └── images/                  # Imágenes
├── dashboard-static.html        # Demo estática del dashboard
├── sidebar.php                  # Barra lateral (WordPress)
├── header.php                   # Cabecera (WordPress)
├── footer.php                   # Pie de página (WordPress)
├── functions.php                # Funciones principales (WordPress)
├── index.php                    # Archivo principal (WordPress)
└── style.css                    # Hoja de estilos principal (datos del tema WordPress)
```

## 🧩 Componentes clave

### Dashboard
El dashboard incluye varios componentes claves:

- **Tarjetas de estadísticas** - Para mostrar KPIs importantes
- **Widget de Chat AI** - Interfaz para interactuar con inteligencia artificial
- **Enlaces rápidos** - Accesos directos a páginas importantes
- **Help Widget** - Widget de ayuda flotante

### Barra lateral (Sidebar)
La barra lateral incluye:

- **Logo/Marca** - Área superior para logo
- **Menú de navegación** - Menú con íconos y enlaces
- **Funcionalidad para colapsar** - Botón para expandir/contraer la barra
- **Widget de ayuda** - Widget de soporte en la parte inferior

## 🌙 Modo oscuro/claro

El tema incluye soporte nativo para alternar entre modo claro y oscuro:

1. Los usuarios pueden cambiar entre ambos temas usando el botón en la barra superior
2. La preferencia se guarda automáticamente usando localStorage
3. Los colores se adaptan mediante variables CSS

## 📱 Responsividad

El tema está optimizado para diferentes tamaños de pantalla:

- **Escritorio**: Sidebar expandido, visualización completa
- **Tablet**: Sidebar colapsable con iconos
- **Móvil**: Sidebar oculto con menú hamburguesa

## 👨‍💻 Personalización Avanzada

### Añadir nuevos elementos de menú

Para añadir nuevos elementos al menú lateral:

1. Si usas WordPress, simplemente agrega elementos al menú "sidebar" desde el administrador.

2. Si usas la versión HTML, modifica el HTML en la sección `<ul class="side-nav">` en el archivo `dashboard-static.html`:

```html
<li class="side-nav-item">
    <a href="#" class="side-nav-link">
        <span class="menu-icon"><i class="ti ti-nuevo-icono"></i></span>
        <span class="menu-text">Nuevo Elemento</span>
    </a>
</li>
```

### Cambiar la paleta de colores

Para cambiar la paleta de colores del tema, modifica las variables CSS en el archivo `assets/css/variables.css`:

```css
:root {
    --color-primary: #TU_COLOR_PRIMARIO;
    --color-secondary: #TU_COLOR_SECUNDARIO;
    /* otros colores... */
}
```

## 📄 Licencia

Este tema está licenciado bajo [GPL v2 o posterior](https://www.gnu.org/licenses/gpl-2.0.html).

## ❤️ Créditos

- Iconos: [Tabler Icons](https://tabler-icons.io/)
- Diseño basado en elementos de Neo Brutalismo Suave

---

Desarrollado por StrykerUX
