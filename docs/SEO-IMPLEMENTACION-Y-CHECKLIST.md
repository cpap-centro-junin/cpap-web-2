# Guia SEO Completa - CPAP Region Centro

Fecha: 19-03-2026
Dominio objetivo: https://cpapregioncentro.com

## 1. Estado actual del proyecto (ya implementado)

Se completo base SEO tecnica dentro del codigo:

- Sitemap dinamico disponible en `/sitemap.xml`.
- Robots dinamico disponible en `/robots.txt` con referencia al sitemap.
- Metadatos base globales en layout:
  - `title`, `description`, `robots`, `canonical`
  - Open Graph
  - Twitter Cards
- Datos estructurados base (Organization + WebSite) en layout.
- Metadatos SEO por pagina (on-page) en vistas publicas clave:
  - Inicio, Noticias, Eventos, Biblioteca, Bolsa de Trabajo, Colegiados, Contacto, Galeria y secciones de Nosotros.
- Paginas de verificacion configuradas con `noindex,nofollow` para no ensuciar indice de Google con URLs de codigo.

## 2. Lo que falta (prioridad alta)

Estas tareas son criticas para que Google te posicione por marca y empiece a subirte:

1. Publicar dominio final con HTTPS
- Debe responder solo una version canonica:
  - O `https://cpapregioncentro.com`
  - O `https://www.cpapregioncentro.com`
- La otra version debe redirigir 301 a la principal.

2. Definir APP_URL en produccion
- En `.env` de produccion:
  - `APP_URL=https://cpapregioncentro.com`
  - `GOOGLE_SITE_VERIFICATION=tu_token_de_search_console`
  - `GOOGLE_ANALYTICS_ID=G-XXXXXXXXXX`
- Luego ejecutar:
  - `php artisan config:clear`
  - `php artisan cache:clear`

Nota tecnica:
- El proyecto ya esta preparado para leer esos valores desde `config/services.php`.
- Se inyectan automaticamente en `resources/views/layouts/app.blade.php`:
  - meta `google-site-verification`
  - script de Google Analytics 4 (si existe `GOOGLE_ANALYTICS_ID`)

3. Alta en Google Search Console
- Verificar propiedad de dominio.
- Enviar sitemap:
  - `https://cpapregioncentro.com/sitemap.xml`
- Solicitar indexacion de:
  - Home
  - Noticias
  - Eventos
  - Bolsa de Trabajo
  - Biblioteca
  - Directorio de Colegiados

4. Crear/optimizar Google Business Profile (si aplica local)
- Nombre consistente: CPAP Region Centro.
- URL oficial del sitio.
- Categoria correcta.
- Horarios, telefono, direccion (si corresponde).

5. Conseguir enlaces institucionales (backlinks)
- UNCP o facultades relacionadas.
- Colegios profesionales o entidades culturales.
- Directorios institucionales.
- Notas de prensa con enlace al dominio.

## 3. Lo que falta (prioridad media)

1. Schema por tipo de contenido
- `NewsArticle` en detalle de noticias.
- `Event` en detalle de eventos.
- `Person` o `ProfilePage` en perfil de colegiado.
- `BreadcrumbList` en paginas con migas.

2. Imagen OG institucional dedicada
- Crear imagen social de 1200x630.
- Usar una imagen optimizada para compartir en redes.

3. Medicion
- Integrar Google Analytics 4.
- Conectar Search Console + GA4.
- Medir CTR, impresiones, consultas y paginas de entrada.

4. Performance SEO
- Comprimir imagenes pesadas (WebP/AVIF cuando sea posible).
- Revisar Core Web Vitals:
  - LCP
  - INP
  - CLS

## 4. Lo que falta (contenido y autoridad)

Google no posiciona solo por meta tags. Necesitas contenido + autoridad:

1. Publicacion semanal
- 1 noticia institucional por semana.
- 1 evento o actividad por semana (si aplica).
- Actualizar biblioteca con nuevos recursos periodicamente.

2. Keywords de marca y locales
- Ejemplos:
  - `cpap region centro`
  - `colegio profesional de antropologos region centro`
  - `colegiados antropologia huancayo`
  - `habilitacion cpap region centro`

3. Estructura editorial minima
- Titulos claros.
- Introduccion con contexto.
- Fecha visible.
- CTA institucional.

## 5. Checklist operativo (paso a paso)

## Paso A - Antes de lanzar

- [ ] Dominio `cpapregioncentro.com` activo.
- [ ] SSL valido.
- [ ] Redireccion 301 definida (www o no-www).
- [ ] `APP_URL` correcto en produccion.
- [ ] `https://cpapregioncentro.com/sitemap.xml` responde 200.
- [ ] `https://cpapregioncentro.com/robots.txt` responde 200.
- [ ] No hay `noindex` en paginas publicas principales.

## Paso B - Dia 1 (Google)

- [ ] Crear propiedad en Search Console.
- [ ] Verificar dominio (DNS TXT).
- [ ] Enviar sitemap.
- [ ] Solicitar indexacion de URLs principales.
- [ ] Revisar cobertura de indexacion.

## Paso C - Semana 1

- [ ] Publicar 2 a 4 contenidos nuevos.
- [ ] Conseguir al menos 3 backlinks institucionales.
- [ ] Revisar consultas en Search Console.
- [ ] Ajustar titulos y descripciones segun CTR.

## Paso D - Mes 1

- [ ] Llegar a 8 a 12 contenidos indexables.
- [ ] Conseguir 8 a 15 backlinks de calidad.
- [ ] Optimizar paginas con mas impresiones y bajo CTR.
- [ ] Revisar rendimiento movil y Core Web Vitals.

## 6. Comandos utiles de despliegue Laravel

Ejecutar en produccion despues de publicar:

```bash
php artisan optimize:clear
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

Si hay cambios de `.env`:

```bash
php artisan config:clear
php artisan cache:clear
```

## 7. Verificaciones rapidas (manuales)

Comprobar en navegador:

- `https://cpapregioncentro.com/`
- `https://cpapregioncentro.com/sitemap.xml`
- `https://cpapregioncentro.com/robots.txt`
- `view-source:https://cpapregioncentro.com/` para validar:
  - `title`
  - `meta description`
  - `canonical`
  - `og:*`

## 8. Objetivo realista de posicionamiento

Meta realista en 30-60 dias:

1. Top 1 para busquedas de marca (`cpap region centro`, `cpapregioncentro`).
2. Top 3-10 para consultas locales especificas de antropologia/colegiatura.

Para keywords genericas competitivas, el plazo es mayor y depende de autoridad del dominio.

## 9. Limitacion importante

Ningun ajuste tecnico por si solo garantiza ser primero siempre.
SEO es resultado de:

- Calidad tecnica
- Autoridad (backlinks)
- Contenido constante
- Relevancia para la intencion de busqueda

Con este proyecto, la base tecnica ya esta bien encaminada. Lo que sigue es ejecucion sostenida de contenido + autoridad.
