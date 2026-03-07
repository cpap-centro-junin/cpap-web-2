/**
 * Slider de Anuncios (Popups) - Optimizado
 * Autoplay cada 3 segundos, drag/swipe, pausado en hover
 * Versión simplificada inspirada en banner-slider
 */

document.addEventListener('DOMContentLoaded', function () {
    const modal = document.getElementById('anunciosModal');
    const slider = document.getElementById('anunciosSlider');
    const wrapper = document.getElementById('anunciosSliderWrapper');
    const slides = document.querySelectorAll('.anuncio-slide');
    const prevBtn = document.getElementById('anunciosPrev');
    const nextBtn = document.getElementById('anunciosNext');
    const indicatorsCt = document.getElementById('anunciosIndicators');
    const counterCurrent = document.getElementById('anunciosCurrent');

    if (!modal || !slider || slides.length === 0) return;

    // ── Estado ──────────────────────────────────
    let currentIndex = 0;
    let isTransitioning = false;
    let autoplayTimer = null;
    let touchStartX = 0;
    let touchEndX = 0;
    let dragStartX = 0;
    let dragCurrentX = 0;
    let isDragging = false;
    let startTranslate = 0;

    const AUTOPLAY_DELAY = 3000;        // 3 segundos (más rápido que banner)
    const TRANSITION_DURATION = 500;    // 0.5s
    const SWIPE_THRESHOLD = 50;         // px mínimos para swipe
    const DRAG_THRESHOLD = 10;          // px para considerar que se está arrastrando

    // ── Inicialización ──────────────────────────────
    function init() {
        if (slides.length > 1) {
            createIndicators();
            updateUI();
            startAutoplay();
            setupEventListeners();
        }
        goToSlide(0, false); // Sin transición en inicio
    }

    // ── Indicadores (Dots) ──────────────────────────
    function createIndicators() {
        if (!indicatorsCt) return;
        indicatorsCt.innerHTML = '';
        slides.forEach((_, i) => {
            const dot = document.createElement('button');
            dot.className = 'anuncio-indicator';
            dot.setAttribute('aria-label', `Anuncio ${i + 1}`);
            dot.addEventListener('click', () => {
                goToSlide(i);
                resetAutoplay();
            });
            indicatorsCt.appendChild(dot);
        });
    }

    function updateIndicators() {
        if (!indicatorsCt) return;
        const dots = indicatorsCt.querySelectorAll('.anuncio-indicator');
        dots.forEach((dot, i) => {
            dot.classList.toggle('active', i === currentIndex);
        });
    }

    // ── Actualizar UI (contador + indicadores) ──────
    function updateUI() {
        if (counterCurrent) {
            counterCurrent.textContent = currentIndex + 1;
        }
        updateIndicators();
    }

    // ── Ir a Slide Específico ──────────────────────
    function goToSlide(index, animate = true) {
        if (index === currentIndex && animate) return;
        
        // Normalizar índice circular
        if (index >= slides.length) index = 0;
        if (index < 0) index = slides.length - 1;

        currentIndex = index;

        // Aplicar transformación
        const offset = -currentIndex * 100;
        
        if (animate) {
            slider.style.transition = 'transform 0.5s cubic-bezier(0.4, 0, 0.2, 1)';
            isTransitioning = true;
            setTimeout(() => {
                isTransitioning = false;
            }, TRANSITION_DURATION);
        } else {
            slider.style.transition = 'none';
        }

        slider.style.transform = `translateX(${offset}%)`;
        updateUI();
    }

    const nextSlide = () => goToSlide(currentIndex + 1);
    const prevSlide = () => goToSlide(currentIndex - 1);

    // ── Autoplay ────────────────────────────────────
    function startAutoplay() {
        if (slides.length <= 1) return;
        clearAutoplay();
        autoplayTimer = setInterval(() => {
            nextSlide();
        }, AUTOPLAY_DELAY);
    }

    function clearAutoplay() {
        if (autoplayTimer) {
            clearInterval(autoplayTimer);
            autoplayTimer = null;
        }
    }

    function pauseAutoplay() {
        clearAutoplay();
    }

    function resumeAutoplay() {
        startAutoplay();
    }

    function resetAutoplay() {
        startAutoplay();
    }

    // ── Event Listeners ─────────────────────────────

    function setupEventListeners() {
        // Botones prev/next
        if (prevBtn) {
            prevBtn.addEventListener('click', () => {
                prevSlide();
                resetAutoplay();
            });
        }
        if (nextBtn) {
            nextBtn.addEventListener('click', () => {
                nextSlide();
                resetAutoplay();
            });
        }

        // Pausar en hover (desktop)
        if (wrapper) {
            wrapper.addEventListener('mouseenter', pauseAutoplay);
            wrapper.addEventListener('mouseleave', resumeAutoplay);
        }

        // Touch events (móvil)
        if (slider) {
            slider.addEventListener('touchstart', handleTouchStart, { passive: true });
            slider.addEventListener('touchmove', handleTouchMove, { passive: false });
            slider.addEventListener('touchend', handleTouchEnd, { passive: true });

            // Mouse drag (desktop)
            slider.addEventListener('mousedown', handleDragStart);
            slider.addEventListener('mousemove', handleDragMove);
            slider.addEventListener('mouseup', handleDragEnd);
            slider.addEventListener('mouseleave', handleDragEnd);
        }
    }

    // ── Touch Handlers ──────────────────────────────
    function handleTouchStart(e) {
        if (isTransitioning) return;
        touchStartX = e.touches[0].clientX;
        pauseAutoplay();
    }

    function handleTouchMove(e) {
        if (isTransitioning) return;
        touchEndX = e.touches[0].clientX;
    }

    function handleTouchEnd() {
        if (isTransitioning) return;
        
        const diff = touchStartX - touchEndX;
        
        if (Math.abs(diff) > SWIPE_THRESHOLD) {
            if (diff > 0) {
                nextSlide();
            } else {
                prevSlide();
            }
            resetAutoplay();
        } else {
            resumeAutoplay();
        }

        touchStartX = 0;
        touchEndX = 0;
    }

    // ── Drag Handlers (Mouse) ───────────────────────
    function handleDragStart(e) {
        if (isTransitioning || e.button !== 0) return;
        
        e.preventDefault();
        isDragging = true;
        dragStartX = e.clientX;
        startTranslate = -currentIndex * 100;
        
        wrapper.classList.add('grabbing');
        slider.style.transition = 'none';
        pauseAutoplay();
    }

    function handleDragMove(e) {
        if (!isDragging || isTransitioning) return;
        
        e.preventDefault();
        dragCurrentX = e.clientX;
        const diff = dragCurrentX - dragStartX;
        const wrapperWidth = wrapper.offsetWidth;
        const percentMove = (diff / wrapperWidth) * 100;
        
        // Limitar el arrastre a -/+ 1 slide
        const maxDrag = 100; // 1 slide completo
        const clampedPercent = Math.max(-maxDrag, Math.min(maxDrag, percentMove));
        
        slider.style.transform = `translateX(${startTranslate + clampedPercent}%)`;
    }

    function handleDragEnd(e) {
        if (!isDragging) return;
        
        e.preventDefault();
        isDragging = false;
        wrapper.classList.remove('grabbing');
        
        const diff = dragCurrentX - dragStartX;
        
        if (Math.abs(diff) > DRAG_THRESHOLD) {
            if (diff < -SWIPE_THRESHOLD) {
                nextSlide();
            } else if (diff > SWIPE_THRESHOLD) {
                prevSlide();
            } else {
                goToSlide(currentIndex); // Volver a posición original
            }
            resetAutoplay();
        } else {
            goToSlide(currentIndex); // Volver a posición original
            resumeAutoplay();
        }
        
        dragStartX = 0;
        dragCurrentX = 0;
    }

    // ── Teclado (accesibilidad) ─────────────────────
    document.addEventListener('keydown', (e) => {
        if (!modal.classList.contains('active')) return;
        
        if (e.key === 'ArrowLeft') {
            prevSlide();
            resetAutoplay();
        } else if (e.key === 'ArrowRight') {
            nextSlide();
            resetAutoplay();
        } else if (e.key === 'Escape') {
            cerrarAnuncios();
        }
    });

    // ── Inicializar ─────────────────────────────────
    init();
});
