# 🎨 Sistema de Personalización de Diseño

## 📋 Descripción

Sistema completo para personalizar colores y diseño del sitio público desde el panel administrativo.

---

## ✨ Características Implementadas

### 1. **Configuración de Colores**
   - ✅ Colores principales (Primary, Secondary, Accent)
   - ✅ Colores de estado (Success, Warning, Danger)
   - ✅ Colores de texto y neutros
   - ✅ Backgrounds (Body, Secciones alternadas)
   - ✅ Footer (Fondo y texto)
   - ✅ Navbar (Fondo y texto)

### 2. **Interfaz Administrativa**
   - ✅ Formulario intuitivo con color pickers
   - ✅ Preview en tiempo real del código hex
   - ✅ Secciones organizadas por categorías
   - ✅ Botón "Restaurar Predeterminados"
   - ✅ Confirmaciones con SweetAlert2
   - ✅ Diseño responsive y moderno

### 3. **Aplicación Automática**
   - ✅ Los cambios se aplican inmediatamente en el sitio público
   - ✅ Sistema de variables CSS dinámicas
   - ✅ Sin necesidad de recompilar assets
   - ✅ Compatible con todos los componentes existentes

---

## 🚀 Cómo Usar

### Acceder al Panel
1. Ir al panel administrativo: `/admin`
2. En el menú lateral, ir a **Configuración → Diseño del Sitio**
3. O directamente: `/admin/diseno`

### Cambiar Colores
1. Click en cualquier color picker
2. Seleccionar el nuevo color
3. Ver el código hex actualizado en tiempo real
4. Hacer scroll hasta abajo
5. Click en **"Guardar Cambios"**
6. Confirmar en el modal
7. ¡Los cambios se aplican instantáneamente en el sitio público!

### Restaurar Valores Predeterminados
1. Click en **"Restaurar Predeterminados"** (botón naranja)
2. Confirmar en el modal
3. Todos los colores vuelven a los valores originales del CPAP

---

## 🎯 Colores Configurables

### Colores Principales (5)
- **Color Primario**: Granate institucional (`#8B1538`)
- **Primario Oscuro**: Para hover y variaciones (`#6B0F2A`)
- **Primario Claro**: Para fondos sutiles (`#A02050`)
- **Secundario**: Dorado complementario (`#C9A961`)
- **Acento**: Dorado brillante para énfasis (`#D4AF37`)

### Colores de Estado (3)
- **Success**: Verde para mensajes de éxito (`#2e7d32`)
- **Warning**: Naranja para advertencias (`#e65100`)
- **Danger**: Rojo para errores (`#d32f2f`)

### Colores de Texto y Neutros (4)
- **Texto Oscuro**: Color principal de texto (`#1a1a1a`)
- **Gris Medio**: Texto secundario (`#6C757D`)
- **Gris Claro**: Fondos sutiles (`#F8F9FA`)
- **Blanco/Light**: Texto sobre fondos oscuros (`#FFFFFF`)

### Backgrounds (2)
- **Fondo Body**: Fondo principal de toda la página
- **Fondo Alternativo**: Para secciones alternadas

### Footer (2)
- **Fondo Footer**: Color de fondo del pie de página
- **Texto Footer**: Color del texto en el footer

### Navbar (2)
- **Fondo Navbar**: Color de fondo del menú superior
- **Texto Navbar**: Color de los enlaces del menú

**Total: 18 colores configurables**

---

## 📁 Archivos Creados

```
📦 Sistema de Diseño
├── 📄 database/migrations/
│   └── 2026_02_26_000000_create_configuracion_diseno_table.php
├── 📄 app/Models/
│   └── ConfiguracionDiseno.php
├── 📄 app/Http/Controllers/Admin/
│   └── DisenoController.php
├── 📄 resources/views/admin/diseno/
│   └── edit.blade.php
└── 📝 Modificados:
    ├── routes/admin.php (3 rutas nuevas)
    ├── resources/views/layouts/admin.blade.php (menú)
    └── resources/views/layouts/app.blade.php (CSS dinámico)
```

---

## 🔧 Arquitectura Técnica

### Base de Datos
- **Tabla**: `configuracion_diseno`
- **Campos**: 18 campos de colores + timestamps
- **Patrón**: Singleton (solo 1 registro activo)

### Modelo
- **Clase**: `App\Models\ConfiguracionDiseno`
- **Métodos principales**:
  - `obtener()`: Obtiene la configuración activa (singleton)
  - `valoresPredeterminados()`: Array con colores originales
  - `restaurarPredeterminados()`: Restaura a valores default
  - `generarCSSVariables()`: Genera código CSS con las variables

### Controlador
- **Clase**: `App\Http\Controllers\Admin\DisenoController`
- **Métodos**:
  - `edit()`: Muestra formulario de edición
  - `update()`: Guarda cambios (con validación regex)
  - `restaurar()`: Restaura valores predeterminados

### Rutas
- `GET /admin/diseno` → Formulario de edición
- `PUT /admin/diseno` → Guardar cambios
- `POST /admin/diseno/restaurar` → Restaurar defaults

### Vista
- **Ubicación**: `resources/views/admin/diseno/edit.blade.php`
- **Características**:
  - Color pickers HTML5
  - Preview de códigos hex en tiempo real
  - Secciones organizadas con cards
  - Sticky action bar con botones
  - JavaScript para sincronización de colores
  - SweetAlert2 para confirmaciones

---

## 🎨 Cómo Funciona el CSS Dinámico

1. **En cada carga de página pública**, el layout `app.blade.php`:
   - Obtiene la configuración de diseño desde la BD
   - Genera un bloque `<style>` con variables CSS
   - Inyecta las variables en `:root`
   - Aplica los colores a elementos específicos

2. **Variables CSS generadas**:
```css
:root {
    --primary: #8B1538;
    --secondary: #C9A961;
    --footer-bg: #1a1a1a;
    --navbar-text: #1a1a1a;
    /* ... etc */
}
```

3. **Elementos afectados**:
   - `body`: Fondo principal
   - `.navbar`: Fondo y texto del menú
   - `.footer`: Fondo y texto del footer
   - Todas las clases que usan `var(--primary)`, etc.

---

## ✅ Ventajas del Sistema

1. **🚀 Sin Recompilación**: Los cambios son instantáneos, no requiere `npm run build`
2. **🎯 Limitado pero Funcional**: Solo colores generales, evita complejidad innecesaria
3. **🔄 Restaurable**: Siempre se puede volver a los valores originales
4. **📱 Compatible**: Funciona con todo el diseño responsive existente
5. **🛡️ Validado**: Regex valida que los colores sean hexadecimales válidos
6. **🎨 Intuitivo**: Color pickers HTML5 nativos
7. **💾 Persistente**: Los cambios se guardan en base de datos
8. **🔒 Seguro**: Solo accesible desde el panel admin

---

## 🚨 Limitaciones (Por Diseño)

- ❌ No modifica tipografías (fuentes)
- ❌ No cambia espaciados o tamaños
- ❌ No modifica border-radius
- ❌ No cambia sombras
- ❌ Solo colores generales y backgrounds

**Estas limitaciones son intencionales** para mantener el sistema simple, manejable y evitar que se rompa el diseño.

---

## 🎓 Valores Predeterminados del CPAP

```php
'color_primary'       => '#8B1538',  // Granate
'color_primary_dark'  => '#6B0F2A',  // Granate oscuro
'color_primary_light' => '#A02050',  // Granate claro
'color_secondary'     => '#C9A961',  // Dorado
'color_accent'        => '#D4AF37',  // Dorado brillante
'color_success'       => '#2e7d32',  // Verde
'color_warning'       => '#e65100',  // Naranja
'color_danger'        => '#d32f2f',  // Rojo
'color_dark'          => '#1a1a1a',  // Negro
'color_medium_gray'   => '#6C757D',  // Gris medio
'color_light_gray'    => '#F8F9FA',  // Gris claro
'color_light'         => '#FFFFFF',  // Blanco
'bg_body'             => '#FFFFFF',  // Fondo body
'bg_section_alt'      => '#F8F9FA',  // Fondo alternativo
'footer_bg'           => '#1a1a1a',  // Fondo footer
'footer_text'         => '#FFFFFF',  // Texto footer
'navbar_bg'           => '#FFFFFF',  // Fondo navbar
'navbar_text'         => '#1a1a1a',  // Texto navbar
```

---

## 🔮 Posibles Extensiones Futuras

Si en el futuro se quisiera ampliar, se podría agregar:

- 🎨 Temas predefinidos (Modo oscuro, Contraste alto, etc.)
- 📝 Tipografías personalizables
- 📏 Ajustes de espaciado (padding, margin)
- 🖼️ Border-radius personalizable
- 🌈 Gradientes personalizados
- 💾 Múltiples configuraciones guardadas
- 👁️ Vista previa en vivo dentro del admin
- 📅 Programación de cambios de diseño
- 🎯 A/B testing de colores

---

## 📞 Soporte

Si algo no funciona:
1. Verificar que la migración se ejecutó: `php artisan migrate`
2. Comprobar que existe el registro: `SELECT * FROM configuracion_diseno`
3. Limpiar cache: `php artisan cache:clear`
4. Verificar que el modelo se carga correctamente en el layout

---

**¡Sistema completamente funcional y listo para usar!** 🎉
