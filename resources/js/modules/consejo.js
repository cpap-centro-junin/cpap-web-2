/**
 * Consejo Directivo - Funcionalidades
 */

document.addEventListener('DOMContentLoaded', function() {
    console.log('✅ Consejo directivo module loaded');

    // Añadir efectos de hover mejorados a las cards del consejo
    const cards = document.querySelectorAll('.consejo-card, .member-card');

    cards.forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-10px)';
        });

        card.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0)';
        });
    });
});
