<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'CPAP Región Centro')</title>
    
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
