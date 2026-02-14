# Guía de Componentes CSS - CPAP

Documentación completa del sistema de componentes CSS para el equipo de desarrollo.

## 📋 Índice

1. [Colores y Variables](#colores-y-variables)
2. [Botones](#botones)
3. [Cards (Tarjetas)](#cards)
4. [Formularios](#formularios)
5. [Badges y Tags](#badges-y-tags)
6. [Navegación](#navegación)
7. [Secciones](#secciones)
8. [Grid y Layout](#grid-y-layout)

---

## 🎨 Colores y Variables

Todos los colores están centralizados en `resources/css/base/variables.css`.

### Colores Principales

```css
--primary: #8B1538          /* Granate principal */
--primary-dark: #6B0F2A     /* Granate oscuro */
--primary-light: #A02050    /* Granate claro */
--secondary: #C9A961        /* Dorado/Bronce */
--accent: #D4AF37           /* Dorado brillante */
```

### Uso en HTML

```html
<div class="text-primary">Texto granate</div>
<div class="bg-primary">Fondo granate</div>
<div class="bg-gradient-primary">Fondo con gradiente</div>
```

### Espaciado

```css
--spacing-xs: 4px
--spacing-sm: 8px
--spacing-md: 16px
--spacing-lg: 24px
--spacing-xl: 32px
--spacing-2xl: 48px
```

---

## 🔘 Botones

**Archivo:** `resources/css/components/buttons.css`

### Variantes Disponibles

#### 1. Botón Primary (Principal)
```html
<button class="btn btn-primary">Registrarse</button>
<a href="#" class="btn btn-primary">Enlace como botón</a>
```

#### 2. Botón Outline (Sin relleno)
```html
<button class="btn btn-outline">Más información</button>
```

#### 3. Botón Light (Claro)
```html
<button class="btn btn-light">Botón claro</button>
```

#### 4. Botón Text (Solo texto)
```html
<button class="btn btn-text">Ver más <i class="fas fa-arrow-right"></i></button>
```

### Tamaños

```html
<button class="btn btn-primary btn-sm">Pequeño</button>
<button class="btn btn-primary">Normal</button>
<button class="btn btn-primary btn-lg">Grande</button>
```

### Modificadores

```html
<!-- Ancho completo -->
<button class="btn btn-primary btn-block">Botón completo</button>

<!-- Con icono -->
<button class="btn btn-primary">
    <i class="fas fa-user"></i> Registrarse
</button>

<!-- Deshabilitado -->
<button class="btn btn-primary" disabled>Deshabilitado</button>

<!-- En estado de carga -->
<button class="btn btn-primary loading">Cargando...</button>
```

### Estados (Success, Warning, Danger)

```html
<button class="btn btn-success">Guardar</button>
<button class="btn btn-warning">Editar</button>
<button class="btn btn-danger">Eliminar</button>
```

---

## 🃏 Cards (Tarjetas)

**Archivo:** `resources/css/components/cards.css`

### 1. Card de Servicio

```html
<div class="service-card" data-aos="fade-up">
    <div class="service-icon">
        <i class="fas fa-user-tie"></i>
    </div>
    <h3 class="service-title">Título del Servicio</h3>
    <p class="service-description">Descripción del servicio...</p>
    <a href="#" class="service-link">
        Ver más <i class="fas fa-arrow-right"></i>
    </a>
</div>
```

### 2. Card de Noticia

```html
<div class="news-card">
    <div class="news-image">
        <img src="imagen.jpg" alt="Noticia">
        <span class="news-category">Comunicados</span>
    </div>
    <div class="news-content">
        <div class="news-meta">
            <span><i class="far fa-calendar"></i> 12 Feb 2026</span>
            <span><i class="far fa-user"></i> Admin</span>
        </div>
        <h3 class="news-title">Título de la noticia</h3>
        <p class="news-excerpt">Resumen de la noticia...</p>
        <a href="#" class="news-link">Leer más <i class="fas fa-arrow-right"></i></a>
    </div>
</div>
```

### 3. Card de Estadística

```html
<div class="stat-card" data-aos="fade-up">
    <i class="stat-icon fas fa-users"></i>
    <div class="stat-info">
        <h3 class="stat-number">500+</h3>
        <p class="stat-label">Colegiados Activos</p>
    </div>
</div>
```

### 4. Card de Evento

```html
<div class="event-card">
    <div class="event-image">
        <img src="evento.jpg" alt="Evento">
        <div class="event-date">
            <span class="day">15</span>
            <span class="month">Feb</span>
        </div>
        <span class="event-badge">Destacado</span>
    </div>
    <div class="event-content">
        <div class="event-meta">
            <span><i class="fas fa-clock"></i> 19:00 hrs</span>
            <span><i class="fas fa-map-marker-alt"></i> Huancayo</span>
        </div>
        <h3 class="event-title">Nombre del Evento</h3>
        <p class="event-description">Descripción...</p>
    </div>
</div>
```

### 5. Card de Trabajo

```html
<div class="job-card">
    <div class="job-header">
        <div class="job-info">
            <p class="job-company">Nombre de la Empresa</p>
            <h3 class="job-title">Título del Trabajo</h3>
        </div>
        <div class="company-logo">
            <img src="logo.png" alt="Logo">
        </div>
    </div>
    <div class="job-tags">
        <span class="tag tag-fulltime">Tiempo Completo</span>
        <span class="tag tag-remote">Remoto</span>
    </div>
    <p class="job-description">Descripción del trabajo...</p>
    <div class="job-footer">
        <span class="job-salary"><i class="fas fa-dollar-sign"></i> S/. 3,000</span>
        <span class="job-date"><i class="far fa-clock"></i> Hace 2 días</span>
    </div>
</div>
```

---

## 📝 Formularios

**Archivo:** `resources/css/components/forms.css`

### Input Básico

```html
<div class="form-group">
    <label for="nombre">Nombre *</label>
    <input type="text" id="nombre" name="nombre" class="form-control" placeholder="Tu nombre" required>
</div>
```

### Input con Icono

```html
<div class="form-group has-icon">
    <label for="email">Correo Electrónico</label>
    <i class="fas fa-envelope"></i>
    <input type="email" id="email" name="email" class="form-control" placeholder="correo@ejemplo.com">
</div>
```

### Textarea

```html
<div class="form-group">
    <label for="mensaje">Mensaje</label>
    <textarea id="mensaje" name="mensaje" class="form-control" rows="5" placeholder="Escribe tu mensaje"></textarea>
</div>
```

### Select

```html
<div class="form-group">
    <label for="tipo">Tipo de Consulta</label>
    <select id="tipo" name="tipo" class="form-control">
        <option value="">Selecciona una opción</option>
        <option value="1">Colegiatura</option>
        <option value="2">Consulta General</option>
    </select>
</div>
```

### Password con Toggle

```html
<div class="form-group has-icon password-wrapper">
    <label for="password">Contraseña</label>
    <i class="fas fa-lock"></i>
    <input type="password" id="password" name="password" class="form-control" placeholder="••••••••">
    <span class="toggle-pass" onclick="togglePassword('password')">
        <i class="fas fa-eye"></i>
    </span>
</div>
```

### File Upload

```html
<div class="form-group">
    <label>Subir Archivo</label>
    <div class="form-file">
        <input type="file" name="archivo" accept="image/*">
        <label class="form-file-label">
            <i class="fas fa-cloud-upload"></i>
            <span>Seleccionar archivo</span>
        </label>
    </div>
</div>
```

### Checkbox y Radio

```html
<!-- Checkbox -->
<div class="form-check">
    <input type="checkbox" id="terminos" name="terminos" class="form-check-input">
    <label for="terminos" class="form-check-label">
        Acepto los términos y condiciones
    </label>
</div>

<!-- Radio -->
<div class="form-check">
    <input type="radio" id="opcion1" name="opcion" class="form-check-input" value="1">
    <label for="opcion1" class="form-check-label">Opción 1</label>
</div>
```

### Validación

```html
<!-- Input válido -->
<input type="email" class="form-control is-valid">
<div class="valid-feedback">Email correcto</div>

<!-- Input inválido -->
<input type="email" class="form-control is-invalid">
<div class="invalid-feedback">Por favor ingresa un email válido</div>
```

---

## 🏷️ Badges y Tags

**Archivo:** `resources/css/components/badges.css`

### Badges Básicos

```html
<span class="badge badge-primary">Nuevo</span>
<span class="badge badge-success">Activo</span>
<span class="badge badge-warning">Pendiente</span>
<span class="badge badge-danger">Vencido</span>
```

### Section Badge (Para títulos de sección)

```html
<span class="section-badge">Servicios</span>
<h2 class="section-title">¿Qué ofrecemos?</h2>
```

### Tags de Trabajo

```html
<div class="job-tags">
    <span class="tag tag-fulltime">Tiempo Completo</span>
    <span class="tag tag-parttime">Medio Tiempo</span>
    <span class="tag tag-consultoria">Consultoría</span>
    <span class="tag tag-remote">Remoto</span>
    <span class="tag tag-new">Nuevo</span>
</div>
```

### Status Badges

```html
<span class="status-badge status-activo">Publicado</span>
<span class="status-badge status-borrador">Borrador</span>
<span class="status-badge status-pendiente">Pendiente</span>
```

---

## 🧭 Navegación

**Archivo:** `resources/css/components/navbar.css`

### Estructura Básica

```html
<nav class="navbar">
    <div class="navbar-container">
        <!-- Logo -->
        <div class="navbar-brand">
            <a href="/" class="logo-container">
                <img src="logo.png" alt="CPAP" class="logo-image-main">
            </a>
        </div>

        <!-- Menú -->
        <div class="navbar-menu">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a href="/" class="nav-link active">Inicio</a>
                </li>

                <!-- Dropdown -->
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link">
                        Nosotros <i class="fas fa-chevron-down dropdown-icon"></i>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="/mision">Misión y Visión</a></li>
                        <li><a href="/historia">Historia</a></li>
                    </ul>
                </li>
            </ul>

            <!-- Botón CTA -->
            <div class="navbar-cta">
                <a href="/registro" class="btn btn-primary">Registrarse</a>
            </div>
        </div>

        <!-- Toggle para móvil -->
        <button class="navbar-toggle">
            <span></span>
            <span></span>
            <span></span>
        </button>
    </div>
</nav>
```

---

## 📐 Grid y Layout

**Archivo:** `resources/css/layouts/grid.css`

### Container

```html
<div class="container">
    <!-- Contenido con max-width 1200px -->
</div>

<div class="container-wide">
    <!-- Contenido con max-width 1400px -->
</div>

<div class="container-narrow">
    <!-- Contenido con max-width 800px -->
</div>
```

### Grid Systems

```html
<!-- Grid de 2 columnas -->
<div class="grid grid-2">
    <div>Columna 1</div>
    <div>Columna 2</div>
</div>

<!-- Grid de 3 columnas -->
<div class="grid grid-3">
    <div>Col 1</div>
    <div>Col 2</div>
    <div>Col 3</div>
</div>

<!-- Grid auto-fit (responsive automático) -->
<div class="grid grid-auto">
    <div>Item 1</div>
    <div>Item 2</div>
    <div>Item 3</div>
    <!-- Se adapta automáticamente -->
</div>
```

### Section Padding

```html
<section class="section-padding">
    <!-- Padding de 80px arriba y abajo -->
</section>

<section class="section-padding bg-light">
    <!-- Con fondo gris claro -->
</section>
```

###Flexbox Utilities

```html
<div class="flex-center">
    <!-- Centrado completo -->
</div>

<div class="flex-between">
    <!-- Espacio entre elementos -->
</div>

<div class="flex gap-lg">
    <!-- Flex con gap grande -->
</div>
```

---

## 🎯 Secciones Especiales

**Archivo:** `resources/css/layouts/sections.css`

### Hero Section

```html
<section class="hero">
    <div class="hero-overlay"></div>
    <div class="container">
        <div class="hero-content">
            <span class="hero-badge">CPAP - Región Centro</span>
            <h1 class="hero-title">
                Bienvenido al <span class="gradient-text">CPAP</span>
            </h1>
            <p class="hero-subtitle">Descripción...</p>
            <div class="hero-buttons">
                <a href="#" class="btn btn-primary btn-lg">Registrarse</a>
                <a href="#" class="btn btn-outline-light btn-lg">Más información</a>
            </div>
        </div>
    </div>
</section>
```

### Page Header (Para páginas internas)

```html
<div class="page-header">
    <div class="page-header-overlay"></div>
    <div class="page-header-content">
        <i class="page-icon fas fa-briefcase"></i>
        <h1 class="page-title">Bolsa de Trabajo</h1>
        <p class="page-subtitle">Encuentra oportunidades laborales</p>
        <nav class="breadcrumb">
            <a href="/">Inicio</a>
            <span>/</span>
            <span>Bolsa de Trabajo</span>
        </nav>
    </div>
</div>
```

---

## 🎨 Clases Útiles

### Tipografía

```html
<p class="text-primary">Texto en color primario</p>
<p class="text-center">Texto centrado</p>
<p class="font-bold">Texto en negrita</p>
<p class="text-lg">Texto grande</p>
<h2 class="gradient-text">Texto con gradiente</h2>
```

### Espaciado

```html
<div class="mt-3">Margin top</div>
<div class="mb-5">Margin bottom</div>
<div class="py-4">Padding vertical</div>
```

### Efectos

```html
<div class="hover-lift">Se eleva al hover</div>
<div class="animate-fade-in">Animación fade in</div>
```

---

## ✅ Buenas Prácticas

1. **Usa las variables CSS siempre que sea posible**
   - ❌ `color: #8B1538`
   - ✅ `color: var(--primary)`

2. **Usa clases reutilizables**
   - ❌ Crear estilos inline
   - ✅ Usar las clases del sistema

3. **Mantén consistencia**
   - Usa siempre los mismos espaciados
   - Usa siempre los mismos colores
   - Usa siempre las mismas sombras

4. **Sigue la convención de nombres**
   - `.nombre-componente`
   - `.nombre-componente__elemento`
   - `.nombre-componente--variante`

5. **Documenta estilos nuevos**
   - Si creas un componente nuevo, agrégalo a esta guía

---

## 🚀 Próximos Pasos

1. Lee esta guía completamente
2. Revisa `GUIA-CSS.md` para entender la arquitectura
3. Usa los componentes existentes antes de crear nuevos
4. Si necesitas algo nuevo, consulta con el equipo primero

---

**Desarrollado por:** Equipo CPAP
**Última actualización:** Febrero 2026
