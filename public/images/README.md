# Directorio de Imágenes

## 📸 Organización

Este directorio contiene todas las imágenes públicas del sitio web.

### Estructura

```
images/
├── logos/              # Logos institucionales
├── banners/            # Banners de portada
├── eventos/            # Imágenes de eventos
├── noticias/           # Imágenes de comunicados
└── consejo-directivo/  # Fotos de autoridades
```

---

## ✅ Buenas Prácticas

### Optimización
- ✅ Optimizar antes de subir (TinyPNG, ImageOptim)
- ✅ Tamaño máximo: 500KB por imagen
- ✅ JPG para fotos (calidad 80-85%)
- ✅ PNG para transparencias
- ✅ SVG para logos

### Nomenclatura
```
✅ Correcto:
- logo-cpap-principal.svg
- banner-inicio-2026.jpg
- evento-seminario-antropologia-2026-02-15.jpg

❌ Incorrecto:
- Logo CPAP Principal.svg
- BannerInicio.jpg
- IMG_20260215.jpg
```

### Dimensiones Recomendadas
- **Banners:** 1920x600px
- **Eventos:** 800x600px
- **Noticias:** 600x400px
- **Fotos perfil:** 400x400px
- **Logos:** SVG o PNG 500x500px

---

## 🔗 Uso en Blade

```blade
<!-- Imagen estática -->
<img src="{{ asset('images/logos/logo-cpap-principal.svg') }}" alt="Logo CPAP">

<!-- Imagen dinámica -->
<img src="{{ asset('images/eventos/' . $evento->imagen) }}" alt="{{ $evento->titulo }}">
```

---

## 🚫 NO subir

- ❌ Imágenes sin optimizar
- ❌ Imágenes con dimensiones excesivas
- ❌ Archivos RAW o PSD
- ❌ Imágenes con derechos de autor no verificados
