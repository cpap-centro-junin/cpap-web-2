/**
 * Historia - Timeline Funcionalidades
 * Usa IntersectionObserver en lugar de scroll handler para mejor rendimiento
 */

document.addEventListener('DOMContentLoaded', function() {
    const timelineItems = document.querySelectorAll('.tl-item');
    if (!timelineItems.length) return;

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('tl-visible');
                // Dejar de observar una vez visible (no necesita re-dispararse)
                observer.unobserve(entry.target);
            }
        });
    }, {
        threshold: 0.15,
        rootMargin: '0px 0px -50px 0px'
    });

    timelineItems.forEach(item => observer.observe(item));
});
