# Guía de Organización del Proyecto

## 📁 Estructura de Carpetas

Este documento describe la organización completa del proyecto para facilitar el trabajo en equipo, la escalabilidad y el mantenimiento.

---

## 🎨 Frontend - Assets Públicos (`public/`)

Los archivos en `public/` son **directamente accesibles** desde el navegador.

### 📸 Imágenes (`public/images/`)

```
public/images/
├── logos/              # Logos institucionales (PNG, SVG)
├── banners/            # Banners de portada y secciones
├── eventos/            # Imágenes de eventos
├── noticias/           # Imágenes de comunicados y noticias
└── consejo-directivo/  # Fotos de autoridades
```

**Convenciones de nomenclatura:**
- `logo-cpap-principal.svg`
- `banner-inicio-2026.jpg`
- `evento-seminario-antropologia-2026-02.jpg`
- `noticia-comunicado-001.jpg`
- `director-juan-perez.jpg`

**Buenas prácticas:**
- Optimizar imágenes antes de subir (usar TinyPNG, ImageOptim)
- JPG para fotografías (calidad 80-85%)
- PNG para gráficos con transparencia
- SVG para logos e iconos
- Tamaño máximo recomendado: 500KB por imagen

---

### 🎭 Iconos (`public/icons/`)

```
public/icons/
├── redes-sociales/     # Iconos de Facebook, Twitter, etc.
├── navegacion/         # Iconos del menú y UI
└── categorias/         # Iconos de categorías de contenido
```

**Formato preferido:** SVG (escalable y ligero)

---

### 📦 Assets Adicionales (`public/assets/`)

```
public/assets/
├── fonts/              # Fuentes personalizadas (WOFF, WOFF2)
└── documents/          # PDFs y documentos descargables
    ├── reglamentos/
    ├── actas/
    └── normativas/
```

**Nomenclatura de documentos:**
- `reglamento-interno-2026.pdf`
- `acta-sesion-2026-02-15.pdf`

---

## 🎨 Frontend - Recursos de Desarrollo (`resources/`)

Los archivos en `resources/` se **compilan/procesan** con Vite antes de usarse.

### 🎨 Estilos CSS (`resources/css/`)

```
resources/css/
├── app.css              # Estilos principales
├── components/          # Estilos de componentes reutilizables
│   ├── navbar.css
│   ├── footer.css
│   ├── cards.css
│   └── buttons.css
├── pages/               # Estilos específicos por página
│   ├── home.css
│   ├── institucional.css
│   ├── eventos.css
│   └── contacto.css
└── admin/               # Estilos del panel administrativo
    ├── admin.css
    └── dashboard.css
```

**Organización:**
- Un archivo CSS por componente/página
- Usar nombres descriptivos en inglés
- Importar todo en `app.css`

---

### ⚡ JavaScript (`resources/js/`)

```
resources/js/
├── app.js               # Archivo principal
├── bootstrap.js         # Configuración inicial
├── components/          # Componentes JS reutilizables
│   ├── modal.js
│   ├── carousel.js
│   ├── form-validation.js
│   └── search.js
├── pages/               # Scripts específicos por página
│   ├── home.js
│   ├── eventos.js
│   └── contacto.js
└── admin/               # Scripts del panel admin
    ├── admin.js
    ├── editor.js
    └── file-upload.js
```

**Convenciones:**
- Usar ES6+ (const, let, arrow functions)
- Modularizar código
- Comentar funciones complejas

---

### 🖼️ Vistas Blade (`resources/views/`)

```
resources/views/
├── layouts/             # Plantillas base
│   ├── app.blade.php        # Layout principal del sitio
│   └── guest.blade.php      # Layout para páginas sin autenticación
│
├── partials/            # Componentes parciales reutilizables
│   ├── header.blade.php
│   ├── navbar.blade.php
│   ├── footer.blade.php
│   ├── breadcrumbs.blade.php
│   └── sidebar.blade.php
│
├── pages/               # Páginas del sitio web público
│   ├── home.blade.php
│   ├── contacto.blade.php
│   ├── institucional/
│   │   ├── index.blade.php
│   │   ├── mision-vision.blade.php
│   │   └── consejo-directivo.blade.php
│   ├── noticias/
│   │   ├── index.blade.php
│   │   └── show.blade.php
│   ├── eventos/
│   │   ├── index.blade.php
│   │   └── show.blade.php
│   └── documentos/
│       ├── index.blade.php
│       └── categoria.blade.php
│
├── admin/               # Panel administrativo
│   ├── layouts/
│   │   └── admin.blade.php
│   ├── partials/
│   │   ├── sidebar.blade.php
│   │   └── navbar.blade.php
│   ├── dashboard.blade.php
│   ├── noticias/
│   ├── eventos/
│   └── documentos/
│
└── welcome.blade.php    # Página de bienvenida Laravel
```

**Nomenclatura:**
- `index.blade.php` → Listado
- `show.blade.php` → Detalle de un elemento
- `create.blade.php` → Formulario de creación
- `edit.blade.php` → Formulario de edición

---

## 🔧 Backend - Aplicación (`app/`)

### 🎯 Controladores (`app/Http/Controllers/`)

```
app/Http/Controllers/
├── Controller.php       # Controlador base
├── Web/                 # Controladores del sitio público
│   ├── HomeController.php
│   ├── InstitucionalController.php
│   ├── NoticiaController.php
│   ├── EventoController.php
│   ├── DocumentoController.php
│   └── ContactoController.php
│
└── Admin/               # Controladores del panel admin
    ├── DashboardController.php
    ├── NoticiaController.php
    ├── EventoController.php
    ├── DocumentoController.php
    └── UserController.php
```

**Convenciones:**
- Nombres en singular: `NoticiaController` (no NoticiasController)
- Un controlador por modelo/recurso
- Métodos REST: `index`, `create`, `store`, `show`, `edit`, `update`, `destroy`

---

### 📊 Modelos (`app/Models/`)

```
app/Models/
├── User.php
├── Noticia.php
├── Evento.php
├── Documento.php
├── CategoriaDocumento.php
└── Miembro.php          # Consejo Directivo
```

**Convenciones:**
- Nombres en singular: `Noticia` (la tabla será `noticias`)
- Usar Eloquent relationships
- Definir `$fillable` o `$guarded`

---

### 🛠️ Servicios (`app/Services/`)

Lógica de negocio compleja separada de los controladores.

```
app/Services/
├── NoticiaService.php
├── EventoService.php
├── DocumentoService.php
└── EmailService.php
```

**Ejemplo de uso:**
```php
class NoticiaService {
    public function publicarNoticia($data) {
        // Lógica compleja aquí
    }
}
```

---

### 📚 Repositorios (`app/Repositories/`)

Capa de abstracción para acceso a datos (opcional pero recomendado).

```
app/Repositories/
├── NoticiaRepository.php
├── EventoRepository.php
└── DocumentoRepository.php
```

---

### ♻️ Traits (`app/Traits/`)

Código reutilizable entre modelos.

```
app/Traits/
├── Sluggable.php        # Genera slugs automáticamente
├── Publishable.php      # Gestión de publicación/borrador
└── HasImages.php        # Manejo de imágenes
```

---

### 🔧 Helpers (`app/Helpers/`)

Funciones auxiliares globales.

```
app/Helpers/
└── helpers.php          # Funciones helper personalizadas
```

Registrar en `composer.json`:
```json
"autoload": {
    "files": [
        "app/Helpers/helpers.php"
    ]
}
```

---

## 💾 Base de Datos

### 📝 Migraciones (`database/migrations/`)

**Nomenclatura:**
```
YYYY_MM_DD_HHMMSS_create_noticias_table.php
YYYY_MM_DD_HHMMSS_add_slug_to_eventos_table.php
```

**Orden:**
1. Tablas principales (users, categorias)
2. Tablas dependientes (noticias, eventos)
3. Tablas pivote (muchos a muchos)

---

### 🌱 Seeders (`database/seeders/`)

```
database/seeders/
├── DatabaseSeeder.php
├── UserSeeder.php
├── NoticiaSeeder.php
└── EventoSeeder.php
```

---

## 📋 Convenciones de Nombres

### Variables y Funciones
```php
// ✅ Correcto - camelCase
$nombreCompleto = "Juan Pérez";
public function obtenerNoticias() { }

// ❌ Incorrecto
$nombre_completo = "Juan Pérez";
public function ObtenerNoticias() { }
```

### Clases
```php
// ✅ Correcto - PascalCase
class NoticiaController { }
class EventoService { }

// ❌ Incorrecto
class noticiaController { }
```

### Rutas
```php
// ✅ Correcto - kebab-case
Route::get('/noticias-recientes', ...);
Route::get('/consejo-directivo', ...);

// ❌ Incorrecto
Route::get('/noticiasRecientes', ...);
```

### Archivos
```
✅ Correcto:
- evento-seminario-2026.jpg
- reglamento-interno.pdf
- navbar.blade.php

❌ Incorrecto:
- Evento Seminario 2026.jpg
- ReglamentoInterno.pdf
```

---

## 🤝 Trabajo en Equipo

### Git Workflow

**Branches:**
```
main              # Producción
develop           # Desarrollo principal
feature/login     # Nueva funcionalidad
fix/navbar        # Corrección de bug
```

**Commits:**
```bash
# ✅ Mensajes claros en español
git commit -m "Agregar sistema de autenticación"
git commit -m "Corregir responsive en navbar"
git commit -m "Actualizar estilos de la página de eventos"

# ❌ Mensajes poco claros
git commit -m "cambios"
git commit -m "fix"
```

---

### División de Tareas

**Por desarrollador:**
- **Dev 1:** Frontend (HTML, CSS, JS)
- **Dev 2:** Backend (Controladores, Modelos, Lógica)
- **Dev 3:** Integración (Vistas Blade, APIs, Testing)

**Por módulo:**
- **Dev 1:** Módulo de Noticias
- **Dev 2:** Módulo de Eventos
- **Dev 3:** Panel Administrativo

---

## 🚀 Comandos Útiles

### Desarrollo
```bash
# Iniciar servidor de desarrollo
php artisan serve

# Compilar assets
npm run dev

# Watch mode (recompila automáticamente)
npm run watch

# Compilar para producción
npm run build
```

### Base de Datos
```bash
# Ejecutar migraciones
php artisan migrate

# Rollback última migración
php artisan migrate:rollback

# Ejecutar seeders
php artisan db:seed

# Refrescar base de datos
php artisan migrate:fresh --seed
```

### Limpiar Caché
```bash
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear
```

---

## 📝 Checklist de Desarrollo

### Antes de crear una nueva funcionalidad:
- [ ] Crear branch desde `develop`
- [ ] Verificar que no exista funcionalidad similar
- [ ] Planificar estructura de archivos necesarios

### Al desarrollar:
- [ ] Seguir convenciones de nombres
- [ ] Comentar código complejo
- [ ] Probar en diferentes navegadores
- [ ] Verificar responsive design

### Antes de hacer commit:
- [ ] Probar que funciona correctamente
- [ ] Eliminar console.logs y código de prueba
- [ ] Verificar que no hay errores en consola
- [ ] Escribir mensaje de commit descriptivo

### Antes de merge:
- [ ] Hacer pull de develop
- [ ] Resolver conflictos si los hay
- [ ] Probar que todo funciona
- [ ] Solicitar code review

---

## 🎯 Resumen de Rutas Importantes

```
public/images/          → Imágenes accesibles públicamente
resources/views/        → Plantillas Blade
resources/css/          → Estilos a compilar
resources/js/           → JavaScript a compilar
app/Http/Controllers/   → Lógica de controladores
app/Models/             → Modelos de base de datos
app/Services/           → Lógica de negocio
database/migrations/    → Estructura de BD
routes/web.php          → Definición de rutas
```

---

**Última actualización:** Febrero 2026  
**Versión:** 1.0
