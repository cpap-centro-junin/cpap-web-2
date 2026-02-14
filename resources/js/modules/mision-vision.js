/**
 * Misión y Visión - Tabs Funcionalidades
 */

document.addEventListener('DOMContentLoaded', function() {
    console.log('✅ Misión-Visión module loaded');

    // Los tabs ya funcionan con CSS puro (input radio + label)
    // Este archivo existe para futuras mejoras

    // Detectar cambio de tab para analytics o animaciones
    const tabs = document.querySelectorAll('input[name="mv-tabs"]');

    tabs.forEach((tab, index) => {
        tab.addEventListener('change', function() {
            if (this.checked) {
                console.log('Tab ' + (index + 1) + ' seleccionado');

                // Animar contenido del tab
                const content = this.nextElementSibling;
                if (content) {
                    content.style.animation = 'fadeIn 0.5s ease';
                }
            }
        });
    });
});
