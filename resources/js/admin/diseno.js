/* ========================================== */
/* ADMIN - PERSONALIZACIÓN DE DISEÑO DEL SITIO */
/* ========================================== */

// Importar SweetAlert2 desde CDN (ya cargado en el layout)

/**
 * Inicializar funcionalidad de personalización de diseño
 */
document.addEventListener('DOMContentLoaded', function() {
    initColorPickers();
    initRestoreButton();
    initFormSubmit();
});

/**
 * Actualizar códigos hex en tiempo real al cambiar colores
 */
function initColorPickers() {
    const colorInputs = document.querySelectorAll('input[type="color"]');
    
    colorInputs.forEach(input => {
        input.addEventListener('input', function() {
            updateHexCode(this);
        });
    });
}

/**
 * Actualizar el código hexadecimal mostrado
 */
function updateHexCode(input) {
    const codeId = input.id
        .replace('color_', 'code_')
        .replace('bg_', 'code_bg_')
        .replace('footer_', 'code_footer_')
        .replace('navbar_', 'code_navbar_');
    
    const codeElement = document.getElementById(codeId);
    
    if (codeElement) {
        codeElement.textContent = input.value.toUpperCase();
    }
}

/**
 * Confirmar restauración de valores predeterminados
 */
function initRestoreButton() {
    // Función global para que pueda ser llamada desde el onclick del botón
    window.confirmarRestaurar = function() {
        Swal.fire({
            title: '¿Restaurar valores predeterminados?',
            html: 'Se restablecerán todos los colores originales del diseño CPAP.<br><strong>Esta acción no se puede deshacer.</strong>',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#ff9800',
            cancelButtonColor: '#6c757d',
            confirmButtonText: '<i class="fas fa-undo"></i> Sí, restaurar',
            cancelButtonText: 'Cancelar',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('restaurarForm').submit();
            }
        });
    };
}

/**
 * Confirmación antes de guardar cambios
 */
function initFormSubmit() {
    const form = document.getElementById('disenoForm');
    
    if (!form) return;
    
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        
        Swal.fire({
            title: '¿Guardar cambios de diseño?',
            text: 'Se aplicarán los nuevos colores en todo el sitio público',
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#2e7d32',
            cancelButtonColor: '#6c757d',
            confirmButtonText: '<i class="fas fa-save"></i> Sí, guardar',
            cancelButtonText: 'Cancelar',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        });
    });
}
