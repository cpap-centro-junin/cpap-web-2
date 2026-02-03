# 🎨 Prototipo Web Moderno - CPAP Región Centro

## ✨ Diseño Implementado

Diseño moderno, elegante y profesional para presentar a la decana.

### 🎯 Características del Diseño:

#### Paleta de Colores:
- **Granate Principal:** #8B1538
- **Granate Oscuro:** #6B0F2A  
- **Dorado/Beige:** #C9A961 (acentos elegantes)
- **Gris Oscuro:** #2C3E50
- **Blanco:** #FFFFFF

#### Componentes Incluidos:
- ✅ **Hero Section** - Banner impactante con gradiente y animaciones
- ✅ **Stats Section** - Estadísticas animadas con efecto counter
- ✅ **About Section** - Sección "Sobre Nosotros" con diseño moderno
- ✅ **Events Section** - Cards de eventos con hover effects
- ✅ **News Section** - Tarjetas de noticias con imágenes
- ✅ **Services Section** - Grid de servicios con iconos
- ✅ **CTA Section** - Llamado a la acción con parallax
- ✅ **Contact Section** - Formulario de contacto moderno
- ✅ **Navbar** - Navegación sticky con dropdown
- ✅ **Footer** - Footer completo con redes sociales

#### Efectos y Animaciones:
- ✅ Animaciones con AOS (Animate On Scroll)
- ✅ Hover effects en cards
- ✅ Parallax en secciones hero y CTA
- ✅ Counter animado en estadísticas
- ✅ Smooth scroll
- ✅ Botón "Volver arriba"
- ✅ Navbar responsive con menú hamburguesa
- ✅ Dropdown menus animados

---

## 🚀 Cómo Ejecutar el Prototipo

### Opción 1: Servidor de Desarrollo Laravel

```bash
# 1. Instalar dependencias
composer install
npm install

# 2. Copiar archivo de entorno
cp .env.example .env

# 3. Generar key de aplicación
php artisan key:generate

# 4. Compilar assets
npm run dev

# 5. Iniciar servidor (en otra terminal)
php artisan serve
```

Luego abre: **http://localhost:8000**

---

### Opción 2: Compilar para Producción

```bash
# Compilar assets optimizados
npm run build

# Iniciar servidor
php artisan serve
```

---

## 📁 Archivos del Prototipo

```
resources/
├── views/
│   ├── layouts/
│   │   └── app.blade.php         # Layout principal
│   ├── partials/
│   │   ├── navbar.blade.php      # Barra de navegación
│   │   └── footer.blade.php      # Footer
│   └── home.blade.php             # Página de inicio
│
├── css/
│   ├── app.css                    # Imports CSS
│   └── modern.css                 # Estilos modernos (✨ NUEVO)
│
└── js/
    ├── app.js                     # Imports JS
    └── modern.js                  # JavaScript interactivo (✨ NUEVO)
```

---

## 🎨 Secciones de la Página

### 1. Hero Section
- Imagen de fondo de Huancayo
- Gradiente granate elegante
- Título impactante con texto degradado
- Botones de CTA

### 2. Estadísticas
- 4 contadores animados
- Fondo oscuro con glass effect
- Iconos representativos

### 3. Nosotros
- Imagen + contenido lado a lado
- Features con iconos
- Diseño limpio y profesional

### 4. Eventos
- Grid responsive
- Card destacada más grande
- Hover effects con zoom
- Badges de fecha

### 5. Noticias
- Cards con imágenes
- Categorías en badges
- Meta información (fecha, autor)

### 6. Servicios
- 6 servicios principales
- Iconos con gradiente
- Animaciones al hover

### 7. CTA (Call to Action)
- Fondo con parallax
- Botones destacados
- Gradiente overlay

### 8. Contacto
- Formulario con validación
- Cards de información de contacto
- Iconos elegantes

### 9. Footer
- 4 columnas informativas
- Redes sociales
- Enlaces organizados
- Copyright y legal

---

## 📱 Responsive Design

El diseño es **completamente responsive**:

- **Desktop** (1024px+): Grid completo
- **Tablet** (768px-1024px): Grid adaptado
- **Mobile** (< 768px): Menú hamburguesa, columna única

---

## 🎯 Presentación a la Decana

### Puntos a Destacar:

1. **Diseño Moderno y Profesional**
   - Usa las mejores prácticas de UX/UI
   - Colores institucionales mejorados
   - Tipografía elegante (Montserrat + Playfair Display)

2. **Experiencia de Usuario**
   - Navegación intuitiva
   - Animaciones sutiles que no molestan
   - Carga rápida
   - Responsive en todos los dispositivos

3. **Funcionalidades**
   - Sistema de eventos
   - Noticias y comunicados
   - Formulario de contacto
   - Bolsa de trabajo
   - Colegiatura online

4. **Escalabilidad**
   - Fácil agregar nuevas secciones
   - Sistema de backend con Laravel
   - Panel administrativo (próximamente)

---

## 🔄 Próximos Pasos

Después de la aprobación:

1. ✅ Aprobar diseño con la decana
2. ⏳ Implementar base de datos
3. ⏳ Desarrollar panel administrativo
4. ⏳ Agregar sistema de autenticación
5. ⏳ Implementar CRUD de noticias/eventos
6. ⏳ Deploy en hosting

---

## 💡 Notas Técnicas

- **Framework:** Laravel 11
- **CSS:** Custom + Variables CSS modernas
- **JS:** Vanilla JavaScript (sin dependencias pesadas)
- **Animaciones:** AOS Library
- **Iconos:** Font Awesome 6.5
- **Fonts:** Google Fonts (Montserrat, Playfair Display)

---

## 📸 Capturas

Al ejecutar verás:
- Hero con imagen de Huancayo
- Diseño elegante granate y dorado
- Cards modernas con efectos
- Footer completo y profesional

---

**Desarrollado por:**
- Aroni Salazar, Jhon Edison
- Chahuayo Martinez, Juan Carlos  
- Rojas Cerron, Zair Ken

**Fecha:** Febrero 2026  
**Versión:** 1.0 (Prototipo Frontend)
