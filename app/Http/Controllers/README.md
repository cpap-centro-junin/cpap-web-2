# Directorio de Controladores

## 🎯 Organización

Este directorio contiene todos los controladores del proyecto.

### Estructura

```
Controllers/
├── Controller.php      # Controlador base
├── Web/                # Sitio público
│   ├── HomeController.php
│   ├── NoticiaController.php
│   └── EventoController.php
└── Admin/              # Panel administrativo
    ├── DashboardController.php
    ├── NoticiaController.php
    └── EventoController.php
```

---

## 📝 Convenciones

### Nomenclatura
```
✅ Correcto:
- NoticiaController (singular)
- EventoController
- DocumentoController

❌ Incorrecto:
- NoticiasController (plural)
- noticia_controller
```

### Métodos REST Estándar

```php
public function index()     // GET /eventos - Listado
public function create()    // GET /eventos/create - Formulario crear
public function store()     // POST /eventos - Guardar nuevo
public function show($id)   // GET /eventos/{id} - Ver detalle
public function edit($id)   // GET /eventos/{id}/edit - Formulario editar
public function update($id) // PUT/PATCH /eventos/{id} - Actualizar
public function destroy($id)// DELETE /eventos/{id} - Eliminar
```

---

## 📋 Ejemplo de Controlador

```php
<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Evento;
use Illuminate\Http\Request;

class EventoController extends Controller
{
    /**
     * Listado de eventos
     */
    public function index()
    {
        $eventos = Evento::where('publicado', true)
            ->orderBy('fecha', 'desc')
            ->paginate(10);
            
        return view('pages.eventos.index', compact('eventos'));
    }
    
    /**
     * Detalle de un evento
     */
    public function show($id)
    {
        $evento = Evento::findOrFail($id);
        
        return view('pages.eventos.show', compact('evento'));
    }
}
```

---

## 🔐 Controladores Admin

Los controladores en `Admin/` deben:
- Usar middleware de autenticación
- Validar permisos
- Incluir operaciones CRUD completas

```php
<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Noticia;
use Illuminate\Http\Request;

class NoticiaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    // Métodos CRUD...
}
```

---

## ✅ Buenas Prácticas

### 1. Controladores Delgados
❌ **Evitar:**
```php
public function store(Request $request)
{
    // 50 líneas de lógica de negocio aquí...
}
```

✅ **Usar Services:**
```php
public function store(Request $request)
{
    $this->noticiaService->crear($request->validated());
    return redirect()->route('noticias.index');
}
```

### 2. Validación
```php
public function store(Request $request)
{
    $validated = $request->validate([
        'titulo' => 'required|max:255',
        'contenido' => 'required',
        'fecha' => 'required|date',
    ]);
    
    Noticia::create($validated);
    
    return redirect()->route('noticias.index')
        ->with('success', 'Noticia creada exitosamente');
}
```

### 3. Inyección de Dependencias
```php
public function __construct(NoticiaService $noticiaService)
{
    $this->noticiaService = $noticiaService;
}
```

---

## 🚀 Comandos Útiles

```bash
# Crear controlador básico
php artisan make:controller Web/EventoController

# Crear controlador con métodos REST
php artisan make:controller Admin/NoticiaController --resource

# Crear controlador API
php artisan make:controller Api/EventoController --api
```

---

## 📌 Separación Web/Admin

### Web Controllers
- Sin autenticación (mayormente)
- Solo lectura (index, show)
- Para usuarios públicos

### Admin Controllers
- Con autenticación obligatoria
- CRUD completo
- Para administradores
