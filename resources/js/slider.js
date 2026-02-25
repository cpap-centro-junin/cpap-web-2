/**
 * Banner Slider - Full Image Cinematic
 * Crossfade con clase .active para Ken Burns + animación de texto
 * Progress bar de autoplay con pausa/reanudación precisa
 */

document.addEventListener('DOMContentLoaded', function () {
    const slider        = document.getElementById('bannerSlider');
    const slides        = document.querySelectorAll('.banner-slide');
    const prevBtn       = document.getElementById('sliderPrev');
    const nextBtn       = document.getElementById('sliderNext');
    const indicatorsCt  = document.getElementById('sliderIndicators');
    const progressBar   = document.querySelector('.slider-progress-bar');

    if (!slider || slides.length === 0) return;

    // ── Estado ──────────────────────────────────
    let currentIndex    = 0;
    let isTransitioning = false;
    let autoplayTimer   = null;     // setTimeout o setInterval activo
    let isInterval      = false;    // true cuando autoplayTimer es un setInterval
    let slideStartedAt  = null;     // cuándo empezó el ciclo del slide actual
    let pausedAt        = null;     // cuándo se pausó (hover)
    let touchStartX     = 0;
    let touchEndX       = 0;
    let isDragging      = false;
    let dragStartX      = 0;

    const AUTOPLAY_DELAY      = 4000;   // ms entre slides
    const TRANSITION_DURATION = 850;    // debe coincidir con CSS opacity transition
    const SWIPE_THRESHOLD     = 50;     // px mínimos para considerar swipe

    // ── Inicializar slides ───────────────────────
    function initSlides() {
        slides.forEach((slide, i) => {
            slide.style.opacity = i === 0 ? '1' : '0';
            if (i === 0) slide.classList.add('active');
        });
    }

    // ── Indicadores ────────────────────────────
    function createIndicators() {
        if (!indicatorsCt) return;
        indicatorsCt.innerHTML = '';
        slides.forEach((_, i) => {
            const dot = document.createElement('button');
            dot.className = 'slider-indicator' + (i === 0 ? ' active' : '');
            dot.setAttribute('aria-label', `Slide ${i + 1}`);
            dot.setAttribute('role', 'tab');
            dot.addEventListener('click', () => { goToSlide(i); resetAutoplay(); });
            indicatorsCt.appendChild(dot);
        });
    }

    function updateIndicators() {
        if (!indicatorsCt) return;
        indicatorsCt.querySelectorAll('.slider-indicator').forEach((dot, i) => {
            dot.classList.toggle('active', i === currentIndex);
            dot.setAttribute('aria-selected', i === currentIndex ? 'true' : 'false');
        });
    }

    // ── Ir a slide ──────────────────────────────
    function goToSlide(index) {
        if (isTransitioning || index === currentIndex) return;
        isTransitioning = true;

        // Normalizar índice circular
        if (index >= slides.length) index = 0;
        if (index < 0)              index = slides.length - 1;

        // Saliente: quitar active + ocultar
        slides[currentIndex].classList.remove('active');
        slides[currentIndex].style.opacity = '0';

        // Entrante: activar
        slides[index].classList.add('active');
        slides[index].style.opacity = '1';

        currentIndex = index;
        updateIndicators();

        setTimeout(() => { isTransitioning = false; }, TRANSITION_DURATION);
    }

    const nextSlide = () => goToSlide(currentIndex + 1);
    const prevSlide = () => goToSlide(currentIndex - 1);

    // ── Autoplay ────────────────────────────────
    function clearAutoplayTimer() {
        if (autoplayTimer === null) return;
        if (isInterval) clearInterval(autoplayTimer);
        else            clearTimeout(autoplayTimer);
        autoplayTimer = null;
        isInterval    = false;
    }

    /**
     * Inicia un ciclo completamente nuevo desde 0.
     * Usar cuando se cambia de slide manualmente o al inicializar.
     */
    function startAutoplay() {
        clearAutoplayTimer();
        slideStartedAt = Date.now();
        pausedAt       = null;
        startProgress();
        autoplayTimer = setInterval(() => {
            nextSlide();
            slideStartedAt = Date.now();
            resetProgress();
        }, AUTOPLAY_DELAY);
        isInterval = true;
    }

    /**
     * Pausa el autoplay guardando el instante de pausa.
     * La barra de progreso queda congelada en su posición actual.
     */
    function pauseAutoplay() {
        clearAutoplayTimer();
        pausedAt = Date.now();
        pauseProgress();
    }

    /**
     * Reanuda el autoplay desde donde se pausó.
     * Calcula el tiempo restante y usa setTimeout + setInterval.
     */
    function resumeAutoplay() {
        clearAutoplayTimer();

        // Calcular tiempo ya transcurrido antes de la pausa
        const elapsed  = (slideStartedAt && pausedAt)
                           ? Math.max(0, pausedAt - slideStartedAt)
                           : 0;
        const remaining = Math.max(200, AUTOPLAY_DELAY - elapsed);

        pausedAt = null;
        resumeProgress(remaining);

        // Esperar el tiempo restante → cambiar slide → continuar con cadencia normal
        autoplayTimer = setTimeout(() => {
            nextSlide();
            slideStartedAt = Date.now();
            startProgress();
            autoplayTimer = setInterval(() => {
                nextSlide();
                slideStartedAt = Date.now();
                resetProgress();
            }, AUTOPLAY_DELAY);
            isInterval = true;
        }, remaining);
        isInterval = false;
    }

    /**
     * Reinicio completo (al pulsar prev/next o un indicador).
     */
    function resetAutoplay() {
        pausedAt = null;
        startAutoplay();
    }

    // ── Progress bar ────────────────────────────
    function startProgress() {
        if (!progressBar) return;
        progressBar.style.transition = 'none';
        progressBar.style.width = '0%';
        progressBar.offsetHeight; // eslint-disable-line no-unused-expressions
        progressBar.style.transition = `width ${AUTOPLAY_DELAY}ms linear`;
        progressBar.style.width = '100%';
    }

    function resetProgress() {
        if (!progressBar) return;
        progressBar.style.transition = 'none';
        progressBar.style.width = '0%';
        progressBar.offsetHeight; // eslint-disable-line no-unused-expressions
        progressBar.style.transition = `width ${AUTOPLAY_DELAY}ms linear`;
        progressBar.style.width = '100%';
    }

    function pauseProgress() {
        if (!progressBar) return;
        const computed = parseFloat(getComputedStyle(progressBar).width);
        const parentW  = progressBar.parentElement.offsetWidth;
        const pct      = parentW > 0 ? (computed / parentW) * 100 : 0;
        progressBar.style.transition = 'none';
        progressBar.style.width = pct + '%';
    }

    /**
     * Continúa la barra desde su posición actual hasta el 100%
     * usando exactamente `remaining` milisegundos.
     */
    function resumeProgress(remaining) {
        if (!progressBar) return;
        // La barra está congelada (pauseProgress ya la fijó)
        progressBar.offsetHeight; // eslint-disable-line no-unused-expressions
        progressBar.style.transition = `width ${remaining}ms linear`;
        progressBar.style.width = '100%';
    }

    // ── Botones prev / next ─────────────────────
    if (prevBtn) prevBtn.addEventListener('click', () => { prevSlide(); resetAutoplay(); });
    if (nextBtn) nextBtn.addEventListener('click', () => { nextSlide(); resetAutoplay(); });

    // ── Touch / Swipe ───────────────────────────
    slider.addEventListener('touchstart', (e) => {
        touchStartX = e.touches[0].clientX;
    }, { passive: true });

    slider.addEventListener('touchend', (e) => {
        touchEndX = e.changedTouches[0].clientX;
        const diff = touchStartX - touchEndX;
        if (Math.abs(diff) > SWIPE_THRESHOLD) {
            diff > 0 ? nextSlide() : prevSlide();
            resetAutoplay();
        }
    }, { passive: true });

    // ── Mouse drag ──────────────────────────────
    const sliderWrapper = document.getElementById('bannerSliderWrapper');

    // Prevenir drag nativo de imágenes
    slider.querySelectorAll('img').forEach(img => {
        img.addEventListener('dragstart', e => e.preventDefault());
        img.style.userSelect    = 'none';
        img.style.pointerEvents = 'none';
    });

    sliderWrapper.addEventListener('mousedown', (e) => {
        isDragging  = true;
        dragStartX  = e.clientX;
        sliderWrapper.style.cursor = 'grabbing';
        e.preventDefault();
    });

    sliderWrapper.addEventListener('mousemove', (e) => {
        if (isDragging) e.preventDefault();
    });

    sliderWrapper.addEventListener('mouseup', (e) => {
        if (!isDragging) return;
        const diff = dragStartX - e.clientX;
        if (Math.abs(diff) > SWIPE_THRESHOLD) {
            diff > 0 ? nextSlide() : prevSlide();
            resetAutoplay();
        }
        isDragging = false;
        sliderWrapper.style.cursor = 'grab';
    });

    sliderWrapper.addEventListener('mouseleave', () => {
        if (isDragging) { isDragging = false; sliderWrapper.style.cursor = 'grab'; }
    });

    // ── Pausa en hover / Reanudación al salir ───
    sliderWrapper.addEventListener('mouseenter', pauseAutoplay);
    sliderWrapper.addEventListener('mouseleave', resumeAutoplay);

    // ── Pausa cuando la pestaña está oculta ─────
    document.addEventListener('visibilitychange', () => {
        document.hidden ? pauseAutoplay() : resumeAutoplay();
    });

    // ── Teclado ─────────────────────────────────
    document.addEventListener('keydown', (e) => {
        if (e.key === 'ArrowLeft')  { prevSlide(); resetAutoplay(); }
        if (e.key === 'ArrowRight') { nextSlide(); resetAutoplay(); }
    });

    // ── Inicializar ─────────────────────────────
    initSlides();
    createIndicators();
    startAutoplay();

    // Exponer controles globalmente (útil para debug o integración futura)
    window.sliderControls = {
        next    : nextSlide,
        prev    : prevSlide,
        goto    : goToSlide,
        current : () => currentIndex,
    };
});
