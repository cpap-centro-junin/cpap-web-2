/**
 * Consejo Directivo - Efectos de interacción
 */

document.addEventListener('DOMContentLoaded', function () {
    const cards = document.querySelectorAll('.consejo-card');

    cards.forEach(card => {
        card.addEventListener('mouseenter', function () {
            this.style.transform = 'translateY(-10px)';
        });

        card.addEventListener('mouseleave', function () {
            this.style.transform = '';
        });
    });
});
