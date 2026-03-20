<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @php
        $siteName = 'CPAP Región Centro';
        $defaultTitle = 'CPAP Región Centro | Colegio Profesional de Antropólogos del Perú';
        $defaultDescription = 'Sitio oficial del Colegio Profesional de Antropólogos del Perú - Región Centro. Noticias, eventos, colegiados, habilitaciones, normativa, bolsa de trabajo y contacto institucional.';
        $seoTitle = trim($__env->yieldContent('seo_title')) ?: $defaultTitle;
        $seoDescription = trim($__env->yieldContent('seo_description')) ?: $defaultDescription;
        $seoImage = trim($__env->yieldContent('seo_image')) ?: asset('images/logos/cpap-logo.jpg');
        $seoCanonical = trim($__env->yieldContent('seo_canonical')) ?: url()->current();
        $seoRobots = trim($__env->yieldContent('seo_robots')) ?: 'index,follow,max-image-preview:large,max-snippet:-1,max-video-preview:-1';

        $organizationSchema = [
            '@context' => 'https://schema.org',
            '@type' => 'Organization',
            'name' => 'CPAP Región Centro',
            'url' => 'https://cpapregioncentro.com',
            'logo' => asset('images/logos/cpap-logo.jpg'),
        ];

        $websiteSchema = [
            '@context' => 'https://schema.org',
            '@type' => 'WebSite',
            'name' => 'CPAP Región Centro',
            'url' => 'https://cpapregioncentro.com',
        ];
    @endphp

    <title>{{ $seoTitle }}</title>

    <!-- SEO Básico -->
    <meta name="description" content="{{ $seoDescription }}">
    <meta name="robots" content="{{ $seoRobots }}">
    <link rel="canonical" href="{{ $seoCanonical }}">

    <!-- Open Graph -->
    <meta property="og:locale" content="es_PE">
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="{{ $siteName }}">
    <meta property="og:title" content="{{ $seoTitle }}">
    <meta property="og:description" content="{{ $seoDescription }}">
    <meta property="og:url" content="{{ $seoCanonical }}">
    <meta property="og:image" content="{{ $seoImage }}">

    <!-- Twitter -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $seoTitle }}">
    <meta name="twitter:description" content="{{ $seoDescription }}">
    <meta name="twitter:image" content="{{ $seoImage }}">

    @if(config('services.google.site_verification'))
    <meta name="google-site-verification" content="{{ config('services.google.site_verification') }}">
    @endif
    
    <!-- Favicon -->
    <link rel="icon" type="image/jpeg" href="{{ asset('images/logos/cpap-logo.jpg') }}">
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700;800;900&family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- AOS Animation -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    
    <!-- Vite Assets -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @if(config('services.google.analytics_id'))
    <!-- Google Analytics 4 -->
    <script async src="https://www.googletagmanager.com/gtag/js?id={{ config('services.google.analytics_id') }}"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag() { dataLayer.push(arguments); }
        gtag('js', new Date());
        gtag('config', '{{ config('services.google.analytics_id') }}');
    </script>
    @endif

    <!-- Datos estructurados -->
    <script type="application/ld+json">{!! json_encode($organizationSchema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) !!}</script>
    <script type="application/ld+json">{!! json_encode($websiteSchema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) !!}</script>
    
    {{-- CSS Personalizado desde configuración de diseño --}}
    @php
        $disenoConfig = \App\Models\ConfiguracionDiseno::obtener();
    @endphp
    <style>
        {!! $disenoConfig->generarCSSVariables() !!}
        
        /* ========================================== */
        /* APLICAR COLORES PERSONALIZADOS */
        /* ========================================== */
        
        /* Body */
        body {
            background-color: var(--bg-body);
        }
        
        /* ========================================== */
        /* NAVBAR - Aplicar fondo personalizado */
        /* ========================================== */
        .navbar {
            background: var(--navbar-bg) !important;
        }
        
        /* Enlaces del navbar - Solo color base, NO sobrescribir active/hover */
        .navbar-nav .nav-link:not(.active):not(:hover),
        .navbar-menu .nav-link:not(.active):not(:hover) {
            color: var(--navbar-text) !important;
        }
        
        /* Enlaces de dropdown - Color base */
        .dropdown-menu li a:not(.active):not(:hover) {
            color: var(--navbar-text) !important;
        }
        
        /* Mantener los estados active y hover con color primary (rojo) */
        .navbar-nav .nav-link.active,
        .navbar-nav .nav-link:hover,
        .dropdown-menu li a.active,
        .dropdown-menu li a:hover {
            color: var(--primary) !important;
        }
        
        /* Íconos de los dropdowns también en primary cuando están activos/hover */
        .dropdown-menu li a.active i,
        .dropdown-menu li a:hover i {
            color: var(--primary) !important;
        }
        
        /* Botones CTA del navbar - Mantener texto blanco */
        .navbar-cta .btn,
        .navbar-cta .btn-primary {
            background: linear-gradient(135deg, var(--primary), var(--primary-dark)) !important;
            color: #FFFFFF !important;
            border: none !important;
        }
        
        .navbar-cta .btn:hover,
        .navbar-cta .btn-primary:hover {
            background: linear-gradient(135deg, var(--primary-dark), var(--primary)) !important;
            color: #FFFFFF !important;
        }
        
        /* ========================================== */
        /* FOOTER - Colores personalizados */
        /* ========================================== */
        .footer {
            background: var(--footer-bg) !important;
            color: var(--footer-text) !important;
        }
        
        .footer a {
            color: var(--footer-text) !important;
            opacity: 0.9;
        }
        
        .footer a:hover {
            opacity: 1;
        }
        
        /* ========================================== */
        /* BACKGROUNDS GENERALES */
        /* ========================================== */
        .bg-light-gray,
        .section-padding.bg-light {
            background-color: var(--bg-section-alt) !important;
        }
    </style>
    
    @yield('styles')
</head>
<body class="app-layout">
    <!-- Navbar Component -->
    <x-navbar />

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer Component -->
    <x-footer />

    <!-- WhatsApp Flotante -->
    <x-whatsapp-float />

    @stack('styles')
    @stack('scripts')
    
    <!-- AOS Animation Script -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    
    <script>
        // Initialize AOS
        AOS.init({
            duration: 800,
            easing: 'ease-in-out',
            once: true,
            offset: 100
        });
    </script>
    
    @yield('scripts')
</body>
</html>
