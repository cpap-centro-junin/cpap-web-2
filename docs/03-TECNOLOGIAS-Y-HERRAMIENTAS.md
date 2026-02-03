# Tecnologías y Herramientas

## Stack Tecnológico

### Backend

#### PHP 8.x
- **Tipo:** Lenguaje de programación del lado del servidor
- **Ventajas:**
  - Ampliamente utilizado para aplicaciones web dinámicas
  - Alta estabilidad y compatibilidad
  - Gran comunidad y recursos disponibles

#### Laravel Framework
- **Tipo:** Framework PHP basado en arquitectura MVC
- **Características:**
  - Patrón Modelo–Vista–Controlador (MVC)
  - Código estructurado y organizado
  - Facilita trabajo en equipo
  - Buenas prácticas de desarrollo integradas
  - Mecanismos de seguridad incorporados
  - Alta escalabilidad

### Frontend

#### HTML5
- **Propósito:** Estructuración del contenido del sitio web
- **Estándar:** Lenguaje de marcado moderno

#### CSS3
- **Propósito:** Presentación visual y estilos
- **Características:**
  - Diseño moderno y adaptable
  - Soporte para responsive design
  - Animaciones y transiciones

#### JavaScript
- **Propósito:** Interactividad y experiencia de usuario
- **Uso:** Mejoras dinámicas en el frontend

### Base de Datos

#### MySQL
- **Tipo:** Sistema de gestión de bases de datos relacional
- **Función:** Almacenamiento y administración de:
  - Comunicados institucionales
  - Documentos
  - Eventos
  - Otros contenidos del sitio web
- **Ventajas:**
  - Gestión eficiente de datos
  - Alta compatibilidad con Laravel
  - Confiabilidad probada

---

## Herramientas de Desarrollo

### Editor de Código

#### Visual Studio Code
- **Tipo:** Editor de código fuente
- **Ventajas:**
  - Versatilidad
  - Compatibilidad con múltiples lenguajes
  - Extensiones y plugins
  - Integración con herramientas de desarrollo

### Control de Versiones

#### Git
- **Propósito:** Sistema de control de versiones
- **Beneficios:**
  - Gestión del código fuente
  - Historial de cambios
  - Trabajo en ramas (branches)

#### GitHub
- **Propósito:** Repositorio remoto y colaboración
- **Beneficios:**
  - Trabajo colaborativo del equipo
  - Backup del código
  - Gestión de issues y proyectos

### Navegadores para Pruebas

- **Google Chrome**
- **Mozilla Firefox**
- **Otros navegadores modernos**

**Propósito:** Ejecución de pruebas y verificación del correcto funcionamiento en diferentes entornos.

---

## Infraestructura Tecnológica

### Servicio de Hosting

#### Proveedor: Hosting-SSD.com

**Especificaciones del Plan:**

| Característica | Detalle |
|---------------|---------|
| **Costo Anual** | US$ 30 |
| **Almacenamiento** | Ilimitado |
| **Ancho de Banda** | Ilimitado |
| **Cuentas de Email** | Ilimitadas |
| **PHP y MySQL** | ✅ Compatible |
| **Certificado SSL** | ✅ Incluido |

**Capacidades:**
- Alojamiento de aplicaciones Laravel
- Estabilidad y disponibilidad garantizada
- Soporte técnico

### Dominio Web

- **Tipo:** Dominio .com
- **Costo:** Gratuito (incluido en el plan de hosting)
- **Beneficios:**
  - Identificación clara y profesional
  - Fortalecimiento de la identidad institucional
  
**Nota:** El nombre del dominio será definido en coordinación con la institución.

### Certificado de Seguridad SSL

- **Tipo:** Certificado SSL gratuito
- **Protocolo:** HTTPS
- **Beneficios:**
  - Navegación segura
  - Protección de información
  - Mayor confianza y credibilidad
  - Protección de datos intercambiados entre usuario y servidor

---

## Arquitectura del Sistema

### Patrón MVC (Modelo-Vista-Controlador)

```
┌─────────────────────────────────────┐
│          USUARIO / NAVEGADOR        │
└──────────────┬──────────────────────┘
               │
               ▼
┌─────────────────────────────────────┐
│          VISTA (Blade)              │
│  • Templates HTML                   │
│  • CSS y JavaScript                 │
└──────────────┬──────────────────────┘
               │
               ▼
┌─────────────────────────────────────┐
│        CONTROLADOR (Laravel)        │
│  • Lógica de negocio                │
│  • Procesamiento de datos           │
└──────────────┬──────────────────────┘
               │
               ▼
┌─────────────────────────────────────┐
│         MODELO (Eloquent)           │
│  • Gestión de datos                 │
│  • Interacción con BD               │
└──────────────┬──────────────────────┘
               │
               ▼
┌─────────────────────────────────────┐
│       BASE DE DATOS (MySQL)         │
└─────────────────────────────────────┘
```

---

## Requisitos del Sistema

### Servidor de Producción
- PHP >= 8.0
- MySQL >= 5.7
- Composer
- Extensiones PHP requeridas por Laravel

### Entorno de Desarrollo
- PHP >= 8.0
- Composer
- Node.js y npm
- MySQL / MariaDB
- Git
