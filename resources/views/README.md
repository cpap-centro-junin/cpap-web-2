# Directorio de Vistas Blade

## 🖼️ Organización de Vistas

Este directorio contiene todas las plantillas Blade del proyecto.

### Estructura

```
views/
├── layouts/        # Plantillas base (esqueleto HTML)
├── partials/       # Componentes reutilizables
├── pages/          # Páginas del sitio público
├── admin/          # Panel administrativo
└── welcome.blade.php
```

---

## 📋 Convenciones de Nomenclatura

### Archivos Blade
```
✅ Correcto:
- index.blade.php       (listado)
- show.blade.php        (detalle)
- create.blade.php      (crear)
- edit.blade.php        (editar)

❌ Incorrecto:
- lista.blade.php
- detalle.blade.php
```

---

## 🎨 Layouts

### Layout Principal (`layouts/app.blade.php`)
Plantilla base para todo el sitio.

**Estructura:**
```blade
<!DOCTYPE html>
<html>
<head>
    @yield('title')
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    @include('partials.navbar')
    
    @yield('content')
    
    @include('partials.footer')
</body>
</html>
```

---

## 🧩 Partials

Componentes reutilizables:
- `header.blade.php` - Cabecera del sitio
- `navbar.blade.php` - Menú de navegación
- `footer.blade.php` - Pie de página
- `breadcrumbs.blade.php` - Migas de pan
- `sidebar.blade.php` - Barra lateral

**Uso:**
```blade
@include('partials.navbar')
```

---

## 📄 Páginas

### Estructura de una página típica:

```blade
@extends('layouts.app')

@section('title')
    <title>Eventos - CPAP Región Centro</title>
@endsection

@section('content')
    <div class="container">
        <h1>Eventos</h1>
        
        @foreach($eventos as $evento)
            <div class="evento-card">
                <h2>{{ $evento->titulo }}</h2>
                <p>{{ $evento->descripcion }}</p>
            </div>
        @endforeach
    </div>
@endsection
```

---

## 🔐 Panel Administrativo

Vistas del admin separadas en `admin/`:
- Usa `layouts/admin.blade.php`
- Estilos independientes
- Navegación propia

---

## 💡 Tips

### Pasar datos desde Controller
```php
return view('pages.eventos.index', compact('eventos'));
```

### Blade Directives útiles
```blade
@if($user->isAdmin())
    <!-- Contenido solo para admin -->
@endif

@foreach($items as $item)
    {{ $item->nombre }}
@endforeach

@isset($variable)
    {{ $variable }}
@endisset

@auth
    <!-- Usuario autenticado -->
@endauth
```

---

## ✅ Checklist

Antes de crear una vista:
- [ ] Verificar si existe un partial reutilizable
- [ ] Extender del layout correcto
- [ ] Usar nombres descriptivos
- [ ] Escapar output: `{{ $var }}` (no `{!! $var !!}`)
- [ ] Agregar meta tags si es necesario
