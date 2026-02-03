# 📸 Guía para Cambiar Imágenes del Sitio

## 🎯 Dónde están las imágenes

Actualmente, el prototipo usa imágenes temporales de **Wikipedia Commons** (imágenes libres). Estas son solo de ejemplo y **se pueden cambiar fácilmente**.

---

## 🔄 Cómo Cambiar las Imágenes

### Opción 1: Usar Imágenes Locales (Recomendado)

1. **Coloca tus imágenes** en las carpetas correspondientes:
   ```
   public/images/
   ├── banners/           ← Imagen principal del hero
   ├── eventos/           ← Imágenes de eventos
   ├── noticias/          ← Imágenes de noticias
   └── institucional/     ← Foto de la institución
   ```

2. **Abre el archivo** `resources/views/home.blade.php`

3. **Busca y reemplaza** las URLs:

#### Hero (Banner Principal):
```blade
<!-- ANTES: -->
style="background: ..., url('https://upload.wikimedia.org/...')

<!-- DESPUÉS: -->
style="background: ..., url('{{ asset('images/banners/hero-huancayo.jpg') }}')
```

#### Sección Nosotros:
```blade
<!-- ANTES: -->
<img src="https://upload.wikimedia.org/..." alt="CPAP">

<!-- DESPUÉS: -->
<img src="{{ asset('images/institucional/edificio-cpap.jpg') }}" alt="CPAP">
```

#### Eventos:
```blade
<!-- ANTES: -->
<img src="https://upload.wikimedia.org/..." alt="Evento">

<!-- DESPUÉS: -->
<img src="{{ asset('images/eventos/congreso-2026.jpg') }}" alt="Evento">
```

#### Noticias:
```blade
<!-- ANTES: -->
<img src="https://upload.wikimedia.org/..." alt="Noticia">

<!-- DESPUÉS: -->
<img src="{{ asset('images/noticias/colegiatura-2026.jpg') }}" alt="Noticia">
```

---

### Opción 2: Usar URLs Externas

Si prefieres usar imágenes desde internet:

```blade
<img src="URL_DE_LA_IMAGEN_EXTERNA" alt="Descripción">
```

---

## 📏 Dimensiones Recomendadas

Para mejor rendimiento, usa estas dimensiones:

| Sección | Ancho | Alto | Formato | Peso |
|---------|-------|------|---------|------|
| **Hero (Banner)** | 1920px | 800px | JPG | < 500KB |
| **Eventos** | 800px | 600px | JPG | < 300KB |
| **Noticias** | 800px | 600px | JPG | < 300KB |
| **Nosotros** | 1000px | 800px | JPG | < 400KB |
| **Logos** | 500px | 500px | PNG/SVG | < 100KB |

---

## 🛠️ Herramientas para Optimizar Imágenes

Antes de subir tus imágenes, optimízalas:

### Online (Gratis):
- **TinyPNG**: https://tinypng.com/
- **Squoosh**: https://squoosh.app/
- **Compressor.io**: https://compressor.io/

### Software:
- **GIMP** (Gratis)
- **Photoshop**
- **IrfanView** (Windows)

---

## 📝 Lista de Imágenes que Debes Preparar

### Prioridad Alta:
- [ ] **Banner Principal** - Vista panorámica de Huancayo o sede CPAP
- [ ] **Foto Institucional** - Edificio o sede del colegio
- [ ] **Logo CPAP** - Logo oficial en alta calidad (SVG preferiblemente)

### Prioridad Media:
- [ ] **Foto Consejo Directivo** - Foto grupal de las autoridades
- [ ] **3 Eventos** - Fotos de eventos recientes
- [ ] **3 Noticias** - Imágenes relacionadas con comunicados

### Prioridad Baja:
- [ ] **Banners secundarios** - Para otras secciones
- [ ] **Galería** - Fotos adicionales

---

## 🎨 Consejos para Buenas Imágenes

### ✅ Hacer:
- Usar fotos de alta calidad y bien iluminadas
- Mantener un estilo visual coherente
- Optimizar el peso de las imágenes
- Usar fotos reales de la institución
- Incluir personas (genera conexión)

### ❌ Evitar:
- Imágenes borrosas o pixeladas
- Fotos con marcas de agua
- Imágenes muy pesadas (> 1MB)
- Stock photos genéricos si es posible
- Fotos oscuras o mal encuadradas

---

## 💡 Donde Conseguir Imágenes Gratis

Si no tienes fotos propias:

### Bancos de Imágenes Gratis:
- **Unsplash**: https://unsplash.com/
- **Pexels**: https://pexels.com/
- **Pixabay**: https://pixabay.com/
- **Wikimedia Commons**: https://commons.wikimedia.org/

### Buscar por Términos:
- "university students peru"
- "academic conference"
- "professional meeting"
- "huancayo peru"
- "andean culture"

---

## 🔧 Ejemplo Completo de Cambio

### Archivo: `resources/views/home.blade.php`

```blade
<!-- SECCIÓN HERO -->
<div class="hero-slide active" style="background: linear-gradient(...), url('{{ asset('images/banners/hero-principal.jpg') }}') center/cover;">
    ...
</div>

<!-- SECCIÓN NOSOTROS -->
<div class="about-image">
    <img src="{{ asset('images/institucional/sede-cpap.jpg') }}" alt="Sede CPAP">
</div>

<!-- EVENTO 1 -->
<div class="event-image">
    <img src="{{ asset('images/eventos/congreso-internacional.jpg') }}" alt="Congreso">
</div>

<!-- EVENTO 2 -->
<div class="event-image">
    <img src="{{ asset('images/eventos/seminario-antropologia.jpg') }}" alt="Seminario">
</div>

<!-- EVENTO 3 -->
<div class="event-image">
    <img src="{{ asset('images/eventos/taller-metodologia.jpg') }}" alt="Taller">
</div>

<!-- NOTICIA 1 -->
<div class="news-image">
    <img src="{{ asset('images/noticias/colegiatura-2026.jpg') }}" alt="Colegiatura">
</div>

<!-- NOTICIA 2 -->
<div class="news-image">
    <img src="{{ asset('images/noticias/seminario-visual.jpg') }}" alt="Seminario">
</div>

<!-- NOTICIA 3 -->
<div class="news-image">
    <img src="{{ asset('images/noticias/reconocimiento.jpg') }}" alt="Reconocimiento">
</div>
```

---

## 🚀 Después de Cambiar las Imágenes

1. Guarda el archivo
2. Refresca el navegador (Ctrl + F5)
3. Verifica que las imágenes carguen correctamente
4. Ajusta dimensiones si es necesario

---

## ⚡ Optimización Adicional

### En Producción:
- Usar formatos modernos: WebP, AVIF
- Implementar lazy loading
- Usar CDN para imágenes
- Generar thumbnails automáticamente

### Código para Lazy Loading:
```blade
<img src="{{ asset('images/evento.jpg') }}" 
     alt="Evento" 
     loading="lazy">
```

---

**Nota:** Las imágenes actuales son solo placeholders de Wikipedia Commons. Reemplázalas con fotos reales del CPAP para mejor impacto visual.
