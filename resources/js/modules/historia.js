/**
 * Historia - Timeline Funcionalidades
 */

document.addEventListener('DOMContentLoaded', function() {
    console.log('✅ Historia module loaded');

    // Efectos de parallax en el timeline
    const timelineItems = document.querySelectorAll('.tl-item');

    window.addEventListener('scroll', function() {
        timelineItems.forEach((item, index) => {
            const rect = item.getBoundingClientRect();
            const isVisible = rect.top < window.innerHeight * 0.8;

            if (isVisible) {
                item.style.opacity = '1';
                item.style.transform = 'translateY(0)';
            }
        });
    });
});
