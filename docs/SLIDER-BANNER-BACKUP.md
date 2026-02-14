# 🎠 Banner Slider - Documentación Completa

**Sistema de slider/carousel implementado en CPAP**

---

## 📋 Descripción General

Sistema de slider robusto con transiciones suaves usando `translateX`, soporte de touch/swipe, drag con mouse, autoplay, indicadores y controles de navegación.

---

## 🏗️ Estructura HTML

**Ubicación:** `resources/views/home.blade.php` (líneas 28-110)

```html
<section class="banner-slider-section">
    <div class="container">
        <div class="banner-slider-wrapper" id="bannerSliderWrapper">
            <div class="banner-slider" id="bannerSlider">

                <!-- Slide 1 -->
                <div class="banner-slide">
                    <div class="banner-content">
                        <div class="banner-image">
                            <img src="{{ asset('images/banners/banner-colegiatura.png') }}"
                                 alt="Proceso de Colegiatura 2026"
                                 loading="lazy"
                                 width="600"
                                 height="500">
                        </div>
                        <div class="banner-info">
                            <span class="banner-category">Proceso de Colegiatura</span>
                            <h3>¡Proceso de Colegiatura 2026 Abierto!</h3>
                            <p>Únete a nuestra comunidad profesional.</p>
                            <a href="#" class="btn btn-primary">
                                <i class="fas fa-arrow-right"></i> Ver Más
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Slide 2, 3, etc... -->

            </div>

            <!-- Controles de Navegación -->
            <button class="slider-control prev" id="sliderPrev" aria-label="Slide anterior">
                <i class="fas fa-chevron-left"></i>
            </button>
            <button class="slider-control next" id="sliderNext" aria-label="Siguiente slide">
                <i class="fas fa-chevron-right"></i>
            </button>

            <!-- Indicadores -->
            <div class="slider-indicators" id="sliderIndicators"></div>
        </div>
    </div>
</section>
```

### IDs Importantes:
- `#bannerSliderWrapper` - Contenedor principal (para eventos)
- `#bannerSlider` - Contenedor de slides
- `#sliderPrev` / `#sliderNext` - Botones de navegación
- `#sliderIndicators` - Contenedor de indicadores (generados dinámicamente)

---

## 🎨 Estilos CSS

**Ubicación:** `resources/css/modern.css` (líneas 725-1011)

### Container Principal
```css
.banner-slider-section {
    padding: 80px 0;
    background: linear-gradient(180deg, #f8f9fa 0%, #ffffff 100%);
    position: relative;
}

.banner-slider-wrapper {
    position: relative;
    max-width: 1200px;
    margin: 0 auto;
    border-radius: 24px;
    overflow: hidden;
    background: white;
    box-shadow: 0 20px 60px rgba(0, 0, 0, 0.12);
    cursor: grab;
}

.banner-slider-wrapper:active {
    cursor: grabbing;
}
```

### Slides
```css
.banner-slider {
    position: relative;
    width: 100%;
    height: 500px;
    overflow: hidden;
}

.banner-slide {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    transition: all 0.6s cubic-bezier(0.4, 0, 0.2, 1);
    opacity: 0;
}

.banner-content {
    display: grid;
    grid-template-columns: 1fr 1fr;
    height: 100%;
    align-items: center;
    gap: 40px;
}

.banner-image {
    height: 100%;
    overflow: hidden;
    display: flex;
    align-items: center;
    justify-content: center;
}

.banner-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.banner-info {
    padding: 60px;
}

.banner-category {
    display: inline-block;
    padding: 8px 20px;
    background: var(--gradient-secondary);
    color: var(--dark);
    font-size: 0.85rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 1px;
    border-radius: 50px;
    margin-bottom: 20px;
}

.banner-info h3 {
    font-size: 2.5rem;
    color: var(--primary-color);
    margin-bottom: 20px;
    line-height: 1.2;
}

.banner-info p {
    color: #555;
    font-size: 1.1rem;
    line-height: 1.7;
    margin-bottom: 30px;
}
```

### Controles de Navegación
```css
.slider-control {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    width: 56px;
    height: 56px;
    background: rgba(255, 255, 255, 0.95);
    border: none;
    border-radius: 50%;
    color: var(--primary-color);
    font-size: 1.4rem;
    cursor: pointer;
    transition: all 0.3s ease;
    z-index: 10;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.15);
    opacity: 0;
    visibility: hidden;
}

.banner-slider-wrapper:hover .slider-control {
    opacity: 1;
    visibility: visible;
}

.slider-control:hover {
    background: var(--primary-color);
    color: white;
    transform: translateY(-50%) scale(1.15);
    box-shadow: 0 10px 35px rgba(139, 21, 56, 0.4);
}

.slider-control:active {
    transform: translateY(-50%) scale(1);
}

.slider-control.prev {
    left: 24px;
}

.slider-control.next {
    right: 24px;
}
```

### Indicadores
```css
.slider-indicators {
    position: absolute;
    bottom: 30px;
    left: 50%;
    transform: translateX(-50%);
    display: flex;
    gap: 12px;
    z-index: 10;
    background: rgba(0, 0, 0, 0.3);
    padding: 12px 24px;
    border-radius: 50px;
    backdrop-filter: blur(10px);
}

.slider-indicator {
    width: 12px;
    height: 12px;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.5);
    border: none;
    cursor: pointer;
    transition: all 0.3s ease;
    padding: 0;
}

.slider-indicator:hover {
    background: rgba(255, 255, 255, 0.8);
    transform: scale(1.3);
}

.slider-indicator.active {
    background: #ffffff;
    width: 36px;
    border-radius: 12px;
    box-shadow: 0 0 0 4px rgba(255, 255, 255, 0.3);
}

.slider-indicator:focus {
    outline: 2px solid white;
    outline-offset: 3px;
}
```

### Responsive (Mobile)
```css
@media (max-width: 768px) {
    .banner-slider-section {
        padding: 40px 0;
    }

    .banner-slider {
        height: auto;
        min-height: 550px;
    }

    .banner-content {
        grid-template-columns: 1fr;
        grid-template-rows: 300px 1fr;
    }

    .banner-info {
        padding: 30px;
    }

    .banner-info h3 {
        font-size: 1.8rem;
    }

    .slider-control {
        width: 48px;
        height: 48px;
        font-size: 1.2rem;
    }

    .slider-control.prev {
        left: 16px;
    }

    .slider-control.next {
        right: 16px;
    }

    .slider-indicators {
        bottom: 20px;
        padding: 10px 20px;
    }
}

@media (max-width: 480px) {
    .banner-slider {
        min-height: 500px;
    }

    .banner-content {
        grid-template-rows: 200px 1fr;
    }

    .slider-control {
        width: 40px;
        height: 40px;
        font-size: 1rem;
        opacity: 1;
        visibility: visible;
    }

    .slider-control.prev {
        left: 10px;
    }

    .slider-control.next {
        right: 10px;
    }

    .slider-indicators {
        bottom: 10px;
        padding: 8px 15px;
        gap: 8px;
    }
}
```

---

## ⚙️ Funcionalidad JavaScript

**Ubicación:** `resources/js/slider.js`

### Variables de Configuración
```javascript
const AUTOPLAY_DELAY = 5000;         // 5 segundos entre slides
const TRANSITION_DURATION = 600;      // 600ms de transición
const SWIPE_THRESHOLD = 50;           // 50px mínimo para swipe
```

### Funciones Principales

#### 1. Inicialización de Slides
```javascript
function initSlides() {
    slides.forEach((slide, index) => {
        slide.style.transform = `translateX(${index * 100}%)`;
        slide.style.opacity = index === 0 ? '1' : '0';
    });
}
```

#### 2. Crear Indicadores Dinámicamente
```javascript
function createIndicators() {
    if (!indicatorsContainer) return;

    indicatorsContainer.innerHTML = '';
    slides.forEach((_, index) => {
        const dot = document.createElement('button');
        dot.className = 'slider-indicator';
        dot.setAttribute('aria-label', `Slide ${index + 1}`);
        if (index === 0) dot.classList.add('active');

        dot.addEventListener('click', () => goToSlide(index));
        indicatorsContainer.appendChild(dot);
    });
}
```

#### 3. Navegar a Slide Específico
```javascript
function goToSlide(index) {
    if (isTransitioning) return;
    if (index === currentIndex) return;

    isTransitioning = true;

    // Normalizar índice (loop infinito)
    if (index >= slides.length) index = 0;
    if (index < 0) index = slides.length - 1;

    // Animar slides con translateX
    slides.forEach((slide, i) => {
        const offset = (i - index) * 100;
        slide.style.transform = `translateX(${offset}%)`;
        slide.style.opacity = i === index ? '1' : '0';
    });

    currentIndex = index;
    updateIndicators();

    setTimeout(() => {
        isTransitioning = false;
    }, TRANSITION_DURATION);
}
```

#### 4. Autoplay
```javascript
function startAutoplay() {
    stopAutoplay();
    autoplayTimer = setInterval(nextSlide, AUTOPLAY_DELAY);
}

function stopAutoplay() {
    if (autoplayTimer) {
        clearInterval(autoplayTimer);
        autoplayTimer = null;
    }
}

function resetAutoplay() {
    stopAutoplay();
    startAutoplay();
}
```

### Características Avanzadas

#### Touch/Swipe (Móvil)
```javascript
slider.addEventListener('touchstart', (e) => {
    touchStartX = e.touches[0].clientX;
}, { passive: true });

slider.addEventListener('touchend', (e) => {
    touchEndX = e.changedTouches[0].clientX;
    const diff = touchStartX - touchEndX;

    if (Math.abs(diff) > SWIPE_THRESHOLD) {
        if (diff > 0) {
            nextSlide();
        } else {
            prevSlide();
        }
        resetAutoplay();
    }
}, { passive: true });
```

#### Drag con Mouse (Desktop)
```javascript
// Prevenir drag nativo de imágenes
const images = slider.querySelectorAll('img');
images.forEach(img => {
    img.addEventListener('dragstart', (e) => e.preventDefault());
    img.style.userSelect = 'none';
    img.style.pointerEvents = 'none';
});

sliderWrapper.addEventListener('mousedown', (e) => {
    isDragging = true;
    dragStartX = e.clientX;
    sliderWrapper.style.cursor = 'grabbing';
    e.preventDefault();
});

sliderWrapper.addEventListener('mouseup', (e) => {
    if (!isDragging) return;

    const diff = dragStartX - e.clientX;
    if (Math.abs(diff) > SWIPE_THRESHOLD) {
        if (diff > 0) {
            nextSlide();
        } else {
            prevSlide();
        }
        resetAutoplay();
    }

    isDragging = false;
    sliderWrapper.style.cursor = 'grab';
});
```

#### Pausar en Hover
```javascript
const wrapper = document.getElementById('bannerSliderWrapper');
if (wrapper) {
    wrapper.addEventListener('mouseenter', stopAutoplay);
    wrapper.addEventListener('mouseleave', startAutoplay);
}
```

#### Pausar cuando Tab no está visible
```javascript
document.addEventListener('visibilitychange', () => {
    if (document.hidden) {
        stopAutoplay();
    } else {
        startAutoplay();
    }
});
```

#### Navegación con Teclado
```javascript
document.addEventListener('keydown', (e) => {
    if (e.key === 'ArrowLeft') {
        prevSlide();
        resetAutoplay();
    } else if (e.key === 'ArrowRight') {
        nextSlide();
        resetAutoplay();
    }
});
```

#### API Pública
```javascript
// Exponer controles en window para debugging
window.sliderControls = {
    next: nextSlide,
    prev: prevSlide,
    goto: goToSlide,
    current: () => currentIndex
};
```

---

## 🔧 Importación en Vite

**Ubicación:** `resources/js/app.js`

```javascript
import './slider.js';
```

---

## ✅ Características del Sistema

✅ **Transiciones suaves** - translateX con cubic-bezier
✅ **Autoplay** - Avanza automáticamente cada 5 segundos
✅ **Touch/Swipe** - Soporte completo para móviles
✅ **Drag con mouse** - Arrastrar slides en desktop
✅ **Indicadores dinámicos** - Generados automáticamente por cada slide
✅ **Controles de navegación** - Flechas prev/next con hover effect
✅ **Navegación por teclado** - ArrowLeft y ArrowRight
✅ **Pausar en hover** - Autoplay se pausa al pasar el mouse
✅ **Pausar en tab oculto** - No consume recursos cuando no está visible
✅ **Loop infinito** - Vuelve al inicio al llegar al final
✅ **Prevención de spam** - Bloqueo durante transición (`isTransitioning`)
✅ **Accesibilidad** - ARIA labels, focus visible, navegación por teclado
✅ **Responsive** - Adaptado para desktop, tablet y móvil
✅ **Lazy loading** - Imágenes con `loading="lazy"`
✅ **SEO friendly** - Alt text en todas las imágenes

---

## 🎯 Buenas Prácticas Implementadas

1. **Passive listeners** para touch events (mejor performance)
2. **Prevención de drag nativo** en imágenes
3. **Normalización de índices** para loop infinito
4. **Debounce implícito** con `isTransitioning`
5. **Cursor visual** (grab/grabbing)
6. **Console logs** para debugging
7. **Validación de elementos** antes de usar
8. **API pública** para testing/debugging

---

## 📊 Performance

- **No usa jQuery** - Vanilla JS puro
- **No recalcula layout** - Solo transform y opacity
- **GPU accelerated** - transform usa GPU
- **Passive listeners** - No bloquea scroll
- **Lazy loading** - Carga diferida de imágenes

---

## 🔄 Cómo Agregar un Nuevo Slide

1. Duplicar estructura HTML de un slide existente
2. Cambiar imagen, categoría, título, descripción y enlace
3. El JS detecta automáticamente nuevos slides
4. Los indicadores se generan automáticamente

```html
<div class="banner-slide">
    <div class="banner-content">
        <div class="banner-image">
            <img src="{{ asset('images/banners/nuevo-banner.jpg') }}"
                 alt="Descripción del banner"
                 loading="lazy"
                 width="600"
                 height="500">
        </div>
        <div class="banner-info">
            <span class="banner-category">Nueva Categoría</span>
            <h3>Título del Nuevo Banner</h3>
            <p>Descripción del nuevo contenido.</p>
            <a href="#" class="btn btn-primary">
                <i class="fas fa-arrow-right"></i> Ver Más
            </a>
        </div>
    </div>
</div>
```

---

## 🐛 Troubleshooting

### El slider no funciona
- Verificar que `slider.js` esté importado en `app.js`
- Verificar que los IDs coincidan (`bannerSlider`, `sliderPrev`, etc.)
- Abrir console y buscar errores

### Las transiciones no son suaves
- Verificar que el CSS tenga `transition: all 0.6s cubic-bezier(0.4, 0, 0.2, 1)`
- Verificar que no haya otros estilos sobrescribiendo

### El autoplay no se pausa
- Verificar event listeners de hover en wrapper
- Verificar visibility change listener

### El drag no funciona
- Verificar que las imágenes tengan `pointer-events: none`
- Verificar que el wrapper tenga el ID correcto

---

## 📝 Notas Finales

Este slider es:
- ✅ **Robusto** - Maneja todos los casos edge
- ✅ **Accesible** - ARIA, keyboard, focus
- ✅ **Performante** - GPU, passive, lazy loading
- ✅ **Responsive** - Mobile, tablet, desktop
- ✅ **Mantenible** - Código limpio y comentado

**Última actualización:** Febrero 2026
**Versión:** 1.0
**Desarrollado para:** CPAP Región Centro
