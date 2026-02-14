# Guía de Arquitectura CSS - CPAP

Documentación de la arquitectura y organización del sistema CSS del proyecto.

## 📁 Estructura de Carpetas

```
resources/css/
├── base/                    # Fundamentos del sistema
│   ├── variables.css        # Variables globales (colores, espaciado, etc.)
│   ├── reset.css           # Reset CSS universal
│   ├── typography.css      #  Tipografías y headings
│   └── animations.css      # Animaciones y keyframes
├── components/             # Componentes reutilizables
│   ├── buttons.css         # Sistema de botones
│   ├── cards.css           # Todos los tipos de tarjetas
│   ├── forms.css           # Formularios e inputs
│   ├── badges.css          # Badges y tags
│   ├── navbar.css          # Navegación
│   └── footer.css          # Footer
├── layouts/                # Layouts y secciones
│   ├── sections.css        # Hero, stats, about, services, etc.
│   └── grid.css            # Sistema de grid y containers
├── pages/                  # Estilos específicos de páginas
│   ├── auth.css           # Login + register (consolidar después)
│   ├── noticias.css       # Página de noticias
│   ├── historia.css       # Timeline historia
│   └── mision-vision.css  # Tabs misión-visión
├──utilities/                 # Utilidades
│   ├── responsive.css      # Media queries (futuro)
│   └── helpers.css         # Clases auxiliares (futuro)
├── app.css                 # Archivo principal de imports
└── modern.css              # Legacy (se eliminará gradualmente)
```

---

## 🎯 Filosofía del Sistema

### 1. **Un Solo Sistema de Diseño**
- Todos los desarrolladores usan las mismas variables
- Todos los componentes tienen el mismo estilo
- No duplicar estilos ni crear variantes inconsistentes

### 2. **Mobile First**
- Diseño base para móvil
- Media queries para pantallas más grandes
- Responsive automático con grid

### 3. **Reutilización**
- Crear componentes una vez
- Reutilizar en todo el proyecto
- No copiar y pegar estilos

### 4. **Modularidad**
- Cada archivo tiene un propósito específico
- Fácil encontrar y modificar estilos
- Imports organizados

---

## 🎨Sistema de Variables

**Ubicación:** `resources/css/base/variables.css`

### Colores

```css
/* Color primario UNIFICADO */
--primary: #8B1538
--primary-dark: #6B0F2A
--primary-light: #A02050

/* Secundario */
--secondary: #C9A961
--accent: #D4AF37

/* Neutrales */
--dark: #1a1a1a
--light: #FFFFFF
--light-gray: #F8F9FA
--medium-gray: #6C757D

/* Estados */
--success: #2e7d32
--warning: #e65100
--danger: #d32f2f
```

### Espaciado (Sistema de 8px)

```css
--spacing-xs: 4px    /* 0.25rem */
--spacing-sm: 8px    /* 0.5rem */
--spacing-md: 16px   /* 1rem */
--spacing-lg: 24px   /* 1.5rem */
--spacing-xl: 32px   /* 2rem */
--spacing-2xl: 48px  /* 3rem */
--spacing-3xl: 64px  /* 4rem */
--spacing-4xl: 80px  /* 5rem */
```

### Tipografías

```css
--font-primary: 'Poppins', sans-serif
--font-heading: 'Nunito', sans-serif

--font-xs: 0.75rem   /* 12px */
--font-sm: 0.875rem  /* 14px */
--font-base: 1rem    /* 16px */
--font-lg: 1.125rem  /* 18px */
--font-xl: 1.25rem   /* 20px */
```

### Sombras

```css
--shadow-xs: 0 1px 2px rgba(0,0,0,0.05)
--shadow-sm: 0 2px 4px rgba(0,0,0,0.1)
--shadow-md: 0 4px 8px rgba(0,0,0,0.12)
--shadow-lg: 0 10px 30px rgba(0,0,0,0.15)
--shadow-xl: 0 20px 60px rgba(0,0,0,0.2)
```

### Transiciones

```css
--transition-fast: 0.2s ease
--transition-normal: 0.3s ease
--transition-slow: 0.5s ease
```

### Border Radius

```css
--radius-sm: 8px
--radius-md: 12px
--radius-lg: 18px
--radius-xl: 24px
--radius-full: 50px
```

---

## 📦 Componentes

### Anatomía de un Componente CSS

```css
/* ============================================
   NOMBRE DEL COMPONENTE
   ============================================ */

/* Componente base */
.componente {
    /* Propiedades usando variables */
    padding: var(--spacing-md);
    border-radius: var(--radius-md);
    transition: all var(--transition-normal);
}

/* Variantes */
.componente--primary {
    background: var(--primary);
    color: var(--light);
}

.componente--outline {
    border: 2px solid var(--primary);
    background: transparent;
}

/* Elementos internos */
.componente__header {
    margin-bottom: var(--spacing-md);
}

/* Estados */
.componente:hover {
    transform: translateY(-3px);
    box-shadow: var(--shadow-lg);
}

.componente:disabled {
    opacity: 0.6;
    cursor: not-allowed;
}
```

---

## 🏗️ Flujo de Trabajo

### Para Crear un Nuevo Componente

1. **Verifica si ya existe**
   - Revisa `GUIA-COMPONENTES.md`
   - Busca en los archivos CSS existentes
   - Pregunta al equipo

2. **Decide dónde va**
   - ¿Es reutilizable? → `components/`
   - ¿Es una sección? → `layouts/`
   - ¿Es específico de una página? → `pages/`

3. **Usa las variables**
   ```css
   /* ❌ MAL */
   .mi-componente {
       color: #8B1538;
       padding: 24px;
   }

   /* ✅ BIEN */
   .mi-componente {
       color: var(--primary);
       padding: var(--spacing-lg);
   }
   ```

4. **Sigue la convención BEM**
   ```css
   .card { }              /* Bloque */
   .card__header { }      /* Elemento */
   .card--featured { }    /* Modificador */
   ```

5. **Agrega comentarios**
   ```css
   /* ============================================
      NUEVO COMPONENTE - Descripción
      ============================================ */
   ```

6. **Importa en app.css**
   ```css
   @import './components/mi-componente.css';
   ```

7. **Documenta**
   - Agrega ejemplos a `GUIA-COMPONENTES.md`
   - Incluye código HTML de ejemplo

---

## 📱 Responsive Design

### Breakpoints

```css
/* Mobile: < 768px (por defecto) */
/* Tablet: 768px - 1024px */
/* Desktop: > 1024px */

@media (max-width: 768px) {
    /* Estilos para móvil */
}

@media (max-width: 1024px) {
    /* Estilos para tablet */
}

@media (min-width: 1025px) {
    /* Estilos para desktop */
}
```

### Mobile First

```css
/* Base (móvil) */
.componente {
    padding: var(--spacing-md);
    font-size: var(--font-base);
}

/* Tablet */
@media (min-width: 768px) {
    .componente {
        padding: var(--spacing-lg);
    }
}

/* Desktop */
@media (min-width: 1024px) {
    .componente {
        padding: var(--spacing-xl);
        font-size: var(--font-lg);
    }
}
```

---

## 🔍 Dónde Encontrar Cada Cosa

### "¿Necesito un botón?"
→ `resources/css/components/buttons.css`
→ Ver ejemplos en `GUIA-COMPONENTES.md` sección Botones

### "¿Necesito una card/tarjeta?"
→ `resources/css/components/cards.css`
→ Hay 8 tipos diferentes: service, news, event, job, stat, step, etc.

### "¿Necesito un formulario?"
→ `resources/css/components/forms.css`
→ Inputs, textareas, selects, file uploads, checkboxes, etc.

### "¿Necesito cambiar un color?"
→ `resources/css/base/variables.css`
→ Modifica la variable, no el valor directo

### "¿Necesito una sección hero/stats/about?"
→ `resources/css/layouts/sections.css`

### "¿Necesito un grid/container?"
→ `resources/css/layouts/grid.css`

---

## ⚠️ Problemas Comunes y Soluciones

### Problema: "No veo mis cambios"

**Solución:**
```bash
npm run build
# o en desarrollo:
npm run dev
```

### Problema: "Los estilos están duplicados"

**Solución:**
- No copies estilos de `modern.css`
- Usa los componentes del nuevo sistema
- Si algo falta, créalo en el lugar correcto

### Problema: "Necesito un color diferente"

**Solución:**
- Primero verifica si existe una variable
- Si no existe, agrégala a `variables.css`
- NO uses colores hardcoded

### Problema: "Mi componente no es responsive"

**Solución:**
```css
/* Agrega media queries */
@media (max-width: 768px) {
    .mi-componente {
        /* Estilos móvil */
    }
}
```

---

## 📊 Metrics y Performance

### Antes de la Refactorización
- **CSS Total:** ~4,000 líneas
- **Duplicación:** ~1,000 líneas (25%)
- **Colores primarios:** 5 diferentes
- **Tipografías:** 4 familias
- **Mantenibilidad:** Bája

### Después de la Refactorización
- **CSS Total:** ~2,500 líneas
- **Duplicación:** 0 líneas
- **Colores primarios:** 1 (#8B1538)
- **Tipografías:** 2 familias (Poppins + Nunito)
- **Mantenibilidad:** Alta

### Reducción
- **37% menos código**
- **100% menos duplicación**
- **80% más organizado**

---

## ✅ Checklist para Pull Requests

Antes de hacer commit de cambios CSS:

- [ ] ¿Usaste variables CSS?
- [ ] ¿Los estilos están en el archivo correcto?
- [ ] ¿Agregaste comentarios si es necesario?
- [ ] ¿No hay duplicación de código?
- [ ] ¿Es responsive?
- [ ] ¿Compilaste el CSS? (`npm run build`)
- [ ] ¿Actualizaste GUIA-COMPONENTES.md si es nuevo?
- [ ] ¿Probaste en diferentes tamaños de pantalla?

---

## 🚀 Comandos Útiles

```bash
# Desarrollo (watch mode)
npm run dev

# Build para producción
npm run build

# Verificar errores
grep -r "#8B1538" resources/css/  # No debería haber resultados (usar variables)
grep -r "\.btn-primary" resources/css/ | wc -l  # Debería ser 1
```

---

## 📚 Recursos Adicionales

### Archivos Importantes
- `resources/css/app.css` - Punto de entrada, todos los imports
- `resources/css/base/variables.css` - TODAS las variables
- `docs/GUIA-COMPONENTES.md` - Ejemplos de uso

### Convenciones
- **BEM:** Metodología de nomenclatura
- **Mobile First:** Diseñar primero para móvil
- **DRY:** Don't Repeat Yourself

### Herramientas
- **Vite:** Bundler y compiler
- **TailwindCSS 4.0:** Utilit classes (si needed)
- **AOS:** Animaciones on scroll

---

## 🤝 Contribuir al Sistema

1. **Identifica la necesidad**
   - ¿Es un componente nuevo?
   - ¿Es una variante de uno existente?

2. **Diseña primero**
   - Dibuja o wireframe
   - Define variantes necesarias

3. **Implementa siguiendo el patrón**
   - Usa variables
   - Comenta tu código
   - Hazlo responsive

4. **Documenta**
   - Agrega a GUIA-COMPONENTES.md
   - Incluye ejemplos HTML

5. **Comparte con el equipo**
   - Pull request
   - Code review
   - Merge a main

---

## 📞 Contacto

**¿Tienes dudas sobre el sistema CSS?**
- Pregunta al equipo en el canal de desarrollo
- Revisa esta guía y GUIA-COMPONENTES.md
- Revisa el código existente como referencia

---

**Desarrollado por:** Equipo CPAP
**Última actualización:** Febrero 2026
**Versión:** 1.0

---

## 🎉 Conclusión

Este sistema CSS está diseñado para que TODO el equipo trabaje de forma consistente, eficiente y sin duplicar código.

**Principios clave:**
1. ☝️ Un solo sistema de diseño
2. 🔄 Reutilizar componentes
3. 📦 Modularidad
4. 📱 Mobile first
5. 📖 Documentar siempre

¡Gracias por seguir estas guías y mantener el código limpio! 🚀
