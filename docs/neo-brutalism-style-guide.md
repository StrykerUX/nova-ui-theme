# Guía de Estilo Neo-Brutalista para NovaUI Theme

## Introducción

NovaUI utiliza un diseño Neo-Brutalista suave combinado con elementos de UI de videojuego indie. Esta guía explica cómo implementar y mantener este estilo visual de manera consistente a través de todo el tema.

## Principios de Diseño

El Neo-Brutalismo se caracteriza por:

1. **Bordes visibles y definidos**: Todos los elementos tienen bordes distintivos.
2. **Esquinas redondeadas**: Usamos bordes redondeados para suavizar la estética.
3. **Sombras características**: Sombras rectangulares (no difuminadas) que dan profundidad.
4. **Colores vibrantes**: Paleta de colores llamativa pero no agresiva.
5. **Tipografía marcada**: Fuentes con buena legibilidad y presencia.

## Implementación Global

El estilo Neo-Brutalista está implementado a través de tres archivos principales:

1. `assets/css/base/neo-brutalism.css`: Estilos fundamentales que definen la estética.
2. `assets/css/base/neo-helpers.css`: Clases de utilidad para aplicación rápida.
3. `assets/css/variables.css`: Variables CSS que definen colores, espaciados, bordes, etc.

Estos estilos se aplican a nivel global y afectan a todos los componentes del tema.

## Uso de Clases CSS

### Clases Base Neo-Brutalistas

Estas clases aplican estilos Neo-Brutalistas básicos:

```html
<div class="neo-container">
  <h2 class="neo-heading">Título Neo-Brutalista</h2>
  <p>Contenido...</p>
</div>

<button class="neo-button neo-button--primary">Botón Primario</button>
```

### Clases de Utilidad

También disponemos de clases auxiliares para aplicaciones rápidas:

```html
<!-- Tarjeta -->
<div class="card card-primary">
  <div class="card-header">
    <h3 class="card-title">Título de Tarjeta</h3>
  </div>
  <div class="card-body">
    <p>Contenido de la tarjeta...</p>
  </div>
  <div class="card-footer">
    <button class="btn btn-primary">Acción</button>
  </div>
</div>

<!-- Botones -->
<button class="btn btn-primary">Primario</button>
<button class="btn btn-secondary">Secundario</button>
<button class="btn btn-accent">Acento</button>
<button class="btn btn-outline">Outline</button>

<!-- Badges -->
<span class="badge badge-primary">Nuevo</span>
<span class="badge badge-secondary">Activo</span>
<span class="badge badge-success">Completado</span>

<!-- Alertas -->
<div class="alert alert-primary">Información importante</div>
<div class="alert alert-warning">Advertencia</div>

<!-- Elementos de juego -->
<div class="progress">
  <div class="progress-bar progress-bar-xp" style="width: 75%"></div>
</div>

<div class="game-list">
  <div class="game-list-item">Elemento de lista</div>
</div>

<!-- Combinaciones rápidas -->
<div class="neo-box">
  Contenedor simple con estilo Neo-Brutalista
</div>

<div class="neo-icon-container">
  <i class="icon"></i>
</div>
```

## Aplicaciones Específicas

### Botones

Los botones deben tener bordes visibles, esquinas redondeadas y sombras características:

```css
.my-button {
  /* Usar las clases existentes */
  border: var(--border-width) solid var(--color-primary);
  border-radius: var(--border-radius-lg);
  box-shadow: var(--shadow-md);
  transition: transform var(--transition-fast), box-shadow var(--transition-fast);
}

.my-button:hover {
  transform: translateY(-2px);
  box-shadow: var(--shadow-lg);
}
```

### Tarjetas / Cards

Las tarjetas deben tener un aspecto sólido y estable:

```css
.my-card {
  background-color: var(--color-background);
  border: var(--border-width) solid var(--color-border);
  border-radius: var(--border-radius-lg);
  box-shadow: var(--shadow-md);
}
```

### Formularios

Los campos de formulario deben mantener la estética neo-brutalista:

```css
.my-input {
  border: var(--border-width) solid var(--color-border);
  border-radius: var(--border-radius-lg);
  padding: var(--spacing-sm) var(--spacing-md);
}

.my-input:focus {
  border-color: var(--color-primary);
  box-shadow: var(--shadow-focus);
}
```

## Elementos de UI de Videojuego

Para reforzar la estética de videojuego indie:

### Barras de Progreso

```html
<div class="progress">
  <div class="progress-bar progress-bar-xp" style="width: 75%"></div>
</div>
```

### Contadores de Recursos

```html
<div class="game-ui-stat">
  <svg><!-- Icono --></svg>
  <span class="game-ui-resource">500/2000</span>
</div>
```

### Badges de Estado

```html
<span class="badge badge-primary">ONLINE</span>
<span class="badge badge-success">ACTIVO</span>
```

## Tema Oscuro

El tema oscuro mantiene la estética neo-brutalista pero con colores adaptados. Para asegurar compatibilidad:

1. Siempre usa variables CSS para colores y propiedades que pueden cambiar.
2. Prueba todos los componentes en ambos modos.
3. Asegúrate de que los contrastes sean adecuados en modo oscuro.

## Breakpoints y Responsividad

El diseño Neo-Brutalista se adapta a diferentes tamaños de pantalla. Usa los breakpoints definidos:

```css
@media (max-width: var(--breakpoint-lg)) {
  /* Ajustes para tablets */
}

@media (max-width: var(--breakpoint-md)) {
  /* Ajustes para móviles */
}
```

## Transiciones y Animaciones

Las transiciones deben ser suaves pero perceptibles:

```css
.my-element {
  transition: transform var(--transition-normal), 
              box-shadow var(--transition-normal),
              background-color var(--transition-normal);
}
```

## Creación de Nuevos Componentes

Al crear nuevos componentes:

1. Consulta primero esta guía y los componentes existentes.
2. Utiliza las variables CSS definidas en `variables.css`.
3. Aplica los principios Neo-Brutalistas: bordes, esquinas, sombras.
4. Añade elementos de UI de videojuego cuando sea apropiado.
5. Asegura la compatibilidad con el tema oscuro.

## Errores Comunes a Evitar

1. **Bordes demasiado sutiles**: Los bordes deben ser visibles y definidos.
2. **Sombras difuminadas**: Usar sombras con valores de desplazamiento en lugar de difuminado.
3. **Colores inconsistentes**: Usar siempre las variables CSS.
4. **Olvidar el tema oscuro**: Todos los componentes deben verse bien en ambos modos.
5. **Transiciones abruptas**: Las transiciones deben ser suaves pero perceptibles.

## Ejemplos de Componentes

### Dashboard Widget Neo-Brutalista

```html
<div class="neo-card">
  <h3 class="neo-card__title">
    <svg><!-- Icono --></svg>
    Título del Widget
  </h3>
  <div class="neo-card__content">
    <p>Contenido del widget...</p>
    
    <!-- Barra de progreso estilo juego -->
    <div class="progress">
      <div class="progress-bar progress-bar-primary" style="width: 65%"></div>
    </div>
    
    <!-- Estadísticas estilo juego -->
    <div class="game-ui-stat">
      <span class="game-ui-resource">650/1000</span>
    </div>
  </div>
  <div class="neo-card__footer">
    <button class="neo-button neo-button--primary">Acción Principal</button>
    <button class="neo-button neo-button--outline">Acción Secundaria</button>
  </div>
</div>
```

### Formulario Neo-Brutalista

```html
<form class="neo-form">
  <div class="neo-form-group">
    <label class="neo-label">Nombre</label>
    <input type="text" class="neo-form-control" placeholder="Tu nombre">
  </div>
  
  <div class="neo-form-group">
    <label class="neo-label">Mensaje</label>
    <textarea class="neo-form-control" rows="4" placeholder="Tu mensaje"></textarea>
  </div>
  
  <button type="submit" class="neo-button neo-button--primary">Enviar</button>
</form>
```

## Conclusión

El estilo Neo-Brutalista suave con elementos de UI de videojuego indie es una característica distintiva de NovaUI. Siguiendo esta guía, podrás mantener una experiencia visual consistente y atractiva en todo el tema.

Recuerda que este estilo no solo se aplica al dashboard, sino a todos los componentes del tema.
