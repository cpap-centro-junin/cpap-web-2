# 📄 Cómo Crear Nuevos Landing Pages

**Guía completa para crear páginas con la nueva arquitectura CPAP**

---

## 🎯 Nueva Estructura del Proyecto

Con la reorganización completada, crear nuevos landing pages es muy sencillo y mantenible.

---

## 📁 Estructura de Archivos

```
resources/
├── views/
│   ├── layouts/
│   │   └── app.blade.php          # Layout base (navbar + footer globales)
│   ├── components/
│   │   ├── navbar.blade.php        # Componente global navbar
│   │   └── footer.blade.php        # Componente global footer
│   └── mi-nuevo-landing.blade.php  # 🆕 Tu nuevo landing page
├── css/
│   ├── app.css                     # Archivo principal de imports
│   ├── base/                       # CSS base (variables, reset, typography)
│   ├── components/                 # Componentes reutilizables
│   ├── layouts/                    # Layouts y secciones
│   └── pages/                      # 🆕 CSS específico de tu página
│       └── mi-landing.css
└── js/
    ├── app.js                      # JS principal
    ├── slider.js                   # Slider global
    └── modules/                    # 🆕 JS específico de tu página
        └── mi-landing.js
```

---

## 🚀 Pasos para Crear un Nuevo Landing Page

### **Paso 1: Crear el Archivo Blade**

Crea tu archivo en `resources/views/mi-nuevo-landing.blade.php`:

```blade
@extends('layouts.app')

@section('title', 'Mi Nuevo Landing - CPAP')

{{-- Si necesitas CSS específico --}}
@push('styles')
    <link rel="stylesheet" href="{{ asset('css/mi-landing.css') }}">
@endpush

@section('content')
<!-- Hero Section -->
<section class="hero" id="inicio">
    <div class="hero-overlay"></div>
    <div class="container">
        <div class="hero-content" data-aos="fade-up">
            <span class="hero-badge">Nuevo Servicio</span>
            <h1 class="hero-title">Título del<br><span class="gradient-text">Nuevo Landing</span></h1>
            <p class="hero-subtitle">Descripción atractiva del servicio o contenido</p>
            <div class="hero-buttons">
                <a href="#contacto" class="btn btn-primary btn-lg">
                    <i class="fas fa-rocket"></i>
                    Empezar Ahora
                </a>
                <a href="#info" class="btn btn-outline-light btn-lg">
                    <i class="fas fa-info-circle"></i>
                    Más Información
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Sección de Contenido -->
<section class="section-padding bg-light" id="info">
    <div class="container">
        <div class="section-header text-center" data-aos="fade-up">
            <span class="section-badge">Información</span>
            <h2 class="section-title">Título de la Sección</h2>
            <p class="section-subtitle">Subtítulo descriptivo</p>
        </div>

        <div class="services-grid">
            <div class="service-card" data-aos="fade-up" data-aos-delay="100">
                <div class="service-icon">
                    <i class="fas fa-check-circle"></i>
                </div>
                <h3>Característica 1</h3>
                <p>Descripción de la característica principal</p>
            </div>

            <div class="service-card" data-aos="fade-up" data-aos-delay="200">
                <div class="service-icon">
                    <i class="fas fa-star"></i>
                </div>
                <h3>Característica 2</h3>
                <p>Otra gran característica</p>
            </div>

            <div class="service-card" data-aos="fade-up" data-aos-delay="300">
                <div class="service-icon">
                    <i class="fas fa-bolt"></i>
                </div>
                <h3>Característica 3</h3>
                <p>Más beneficios increíbles</p>
            </div>
        </div>
    </div>
</section>

<!-- Sección de CTA -->
<section class="section-padding" id="contacto">
    <div class="container">
        <div class="text-center" data-aos="fade-up">
            <h2 class="section-title">¿Listo para Comenzar?</h2>
            <p class="section-subtitle">Contáctanos para más información</p>
            <a href="{{ url('/#contacto') }}" class="btn btn-primary btn-lg">
                <i class="fas fa-envelope"></i>
                Contáctanos Ahora
            </a>
        </div>
    </div>
</section>
@endsection

{{-- JS específico (opcional) --}}
@push('scripts')
<script>
console.log('Mi landing page cargado correctamente');
// Tu código JavaScript aquí
</script>
@endpush
```

---

### **Paso 2: Crear Ruta en Laravel**

Agrega la ruta en `routes/web.php`:

```php
Route::get('/mi-nuevo-landing', function () {
    return view('mi-nuevo-landing');
})->name('mi-landing');
```

**O con controlador:**

```php
Route::get('/mi-nuevo-landing', [MiLandingController::class, 'index'])->name('mi-landing');
```

---

### **Paso 3: CSS Específico (Opcional)**

Si necesitas estilos específicos, crea `resources/css/pages/mi-landing.css`:

```css
/* ============================================
   MI NUEVO LANDING - Estilos Específicos
   ============================================ */

.mi-landing-section {
    padding: 80px 0;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
}

.mi-landing-card {
    background: white;
    padding: 40px;
    border-radius: var(--radius-lg);
    box-shadow: var(--shadow-lg);
    transition: transform var(--transition-normal);
}

.mi-landing-card:hover {
    transform: translateY(-10px);
}

/* Responsive */
@media (max-width: 768px) {
    .mi-landing-section {
        padding: 40px 0;
    }
}
```

**Luego agrégalo a** `resources/css/app.css`:

```css
/* ============================================
   PAGES - Estilos específicos de páginas
   ============================================ */
@import './pages/bolsa-trabajo.css';
@import './pages/biblioteca.css';
@import './pages/mi-landing.css';  /* 🆕 Nuevo */
```

---

### **Paso 4: JavaScript Específico (Opcional)**

Si necesitas JS específico, crea `resources/js/modules/mi-landing.js`:

```javascript
// Mi Landing Page - Funcionalidades
console.log('Mi Landing JS cargado');

document.addEventListener('DOMContentLoaded', function() {
    // Ejemplo: Contador animado
    const counters = document.querySelectorAll('.counter');

    counters.forEach(counter => {
        const target = parseInt(counter.getAttribute('data-count'));
        let count = 0;
        const speed = 2000 / target;

        const updateCount = () => {
            if (count < target) {
                count++;
                counter.textContent = count;
                setTimeout(updateCount, speed);
            } else {
                counter.textContent = target;
            }
        };

        updateCount();
    });
});
```

**Cárgalo en tu Blade:**

```blade
@vite(['resources/js/modules/mi-landing.js'])
```

---

### **Paso 5: Build y Verificación**

```bash
# Compilar assets
npm run build

# O en desarrollo con hot reload
npm run dev
```

Verifica tu landing visitando: `http://localhost:8000/mi-nuevo-landing`

---

## 🎨 Clases y Componentes Disponibles

### **Layout y Secciones**

```blade
{{-- Sección con padding estándar --}}
<section class="section-padding">
    ...
</section>

{{-- Sección con fondo claro --}}
<section class="section-padding bg-light">
    ...
</section>

{{-- Header de sección --}}
<div class="section-header text-center">
    <span class="section-badge">Badge</span>
    <h2 class="section-title">Título</h2>
    <p class="section-subtitle">Subtítulo</p>
</div>
```

### **Botones**

```blade
{{-- Botón primario --}}
<a href="#" class="btn btn-primary">Primario</a>

{{-- Botón outline --}}
<a href="#" class="btn btn-outline">Outline</a>

{{-- Botón secundario --}}
<a href="#" class="btn btn-secondary">Secundario</a>

{{-- Botón grande --}}
<a href="#" class="btn btn-primary btn-lg">Grande</a>

{{-- Botón pequeño --}}
<a href="#" class="btn btn-primary btn-sm">Pequeño</a>
```

### **Cards**

```blade
{{-- Card de servicio --}}
<div class="service-card">
    <div class="service-icon">
        <i class="fas fa-rocket"></i>
    </div>
    <h3>Título</h3>
    <p>Descripción</p>
    <a href="#" class="btn-text">Ver Más →</a>
</div>

{{-- Card de noticia --}}
<article class="news-card">
    <div class="news-image">
        <img src="..." alt="...">
        <div class="news-category">Categoría</div>
    </div>
    <div class="news-content">
        <h3>Título</h3>
        <p>Descripción</p>
        <a href="#" class="btn-text">Leer Más →</a>
    </div>
</article>
```

### **Grids**

```blade
{{-- Grid de servicios (3 columnas) --}}
<div class="services-grid">
    <div class="service-card">...</div>
    <div class="service-card">...</div>
    <div class="service-card">...</div>
</div>

{{-- Grid de noticias (3 columnas) --}}
<div class="news-grid">
    <article class="news-card">...</article>
    <article class="news-card">...</article>
    <article class="news-card">...</article>
</div>
```

### **Animaciones AOS**

```blade
{{-- Fade up --}}
<div data-aos="fade-up">...</div>

{{-- Con delay --}}
<div data-aos="fade-up" data-aos-delay="100">...</div>
<div data-aos="fade-up" data-aos-delay="200">...</div>

{{-- Zoom in --}}
<div data-aos="zoom-in">...</div>

{{-- Fade right/left --}}
<div data-aos="fade-right">...</div>
<div data-aos="fade-left">...</div>
```

---

## ✅ Checklist de Creación

- [ ] Crear archivo Blade en `resources/views/`
- [ ] Extender layout base `@extends('layouts.app')`
- [ ] Definir title `@section('title', '...')`
- [ ] Usar clases y componentes existentes
- [ ] Crear ruta en `routes/web.php`
- [ ] (Opcional) Crear CSS en `resources/css/pages/`
- [ ] (Opcional) Agregar import en `app.css`
- [ ] (Opcional) Crear JS en `resources/js/modules/`
- [ ] (Opcional) Cargar JS con `@vite()`
- [ ] Ejecutar `npm run build`
- [ ] Verificar en navegador
- [ ] Probar responsive (mobile, tablet, desktop)

---

## 🎯 Ventajas de esta Arquitectura

✅ **Navbar y Footer globales** - No necesitas repetirlos en cada página
✅ **CSS modular** - Solo importas lo que necesitas
✅ **JS organizado** - Cada página tiene su propio módulo
✅ **Componentes reutilizables** - Clases CSS predefinidas
✅ **Animaciones incluidas** - AOS ya configurado
✅ **Responsive** - Todo optimizado para móvil
✅ **Build optimizado** - Vite compila todo eficientemente

---

## 📝 Ejemplo Completo: Landing de Eventos

```blade
@extends('layouts.app')

@section('title', 'Eventos CPAP - CPAP Región Centro')

@section('content')
<section class="hero">
    <div class="hero-overlay"></div>
    <div class="container">
        <div class="hero-content" data-aos="fade-up">
            <span class="hero-badge">Próximos Eventos</span>
            <h1 class="hero-title">Eventos y<br><span class="gradient-text">Capacitaciones</span></h1>
            <p class="hero-subtitle">Participa en nuestras actividades académicas y profesionales</p>
        </div>
    </div>
</section>

<section class="section-padding bg-light">
    <div class="container">
        <div class="section-header text-center" data-aos="fade-up">
            <span class="section-badge">Calendario</span>
            <h2 class="section-title">Próximos Eventos</h2>
        </div>

        <div class="events-timeline">
            <div class="event-item" data-aos="fade-right">
                <div class="event-content">
                    <h3>15 Feb - Taller de Investigación</h3>
                    <p>Metodología cualitativa aplicada</p>
                    <div class="event-meta">
                        <span><i class="fas fa-clock"></i> 6:00 PM</span>
                        <span><i class="fas fa-map-marker-alt"></i> Zoom</span>
                    </div>
                    <a href="#" class="btn btn-primary btn-sm">Inscribirse</a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
```

---

**¡Listo!** Con esta estructura puedes crear landing pages profesionales rápidamente. 🚀

**Desarrollado para:** CPAP Región Centro
**Fecha:** Febrero 2026
