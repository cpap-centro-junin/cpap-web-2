/**
 * Misión y Visión - Gestión de tabs navegables
 */

document.addEventListener('DOMContentLoaded', function () {
    const navItems = document.querySelectorAll('.mv-nav-item');
    const radios   = document.querySelectorAll('input[name="mv-tabs"]');

    if (!navItems.length || !radios.length) return;

    // Sincroniza el estado .active de los labels con el radio seleccionado
    function syncActive() {
        radios.forEach((radio, i) => {
            if (navItems[i]) {
                navItems[i].classList.toggle('active', radio.checked);
            }
        });
    }

    // Al hacer clic en un label se marca el radio por el atributo for;
    // esperamos un tick para leer el nuevo estado
    navItems.forEach((label) => {
        label.addEventListener('click', () => {
            requestAnimationFrame(syncActive);
        });
    });

    // Soporte para navegación por teclado
    radios.forEach(radio => {
        radio.addEventListener('change', syncActive);
    });

    // Estado inicial
    syncActive();
});
