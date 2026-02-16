<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Panel Administrativo CPAP</title>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    @vite(['resources/css/admin.css'])
</head>

<body>

<div class="admin-wrapper">

    <!-- SIDEBAR MEJORADO -->
    <aside class="sidebar" id="adminSidebar">

        <div class="sidebar-header">
            <div class="logo-box">
                <img src="{{ asset('images/logos/cpap-logo.jpg') }}" alt="CPAP Logo" class="logo">
            </div>
            <div class="logo-text">
                <h3>CPAP Centro</h3>
                <p>Panel Administrativo</p>
            </div>
        </div>

        <nav class="menu">
            <a href="{{ route('admin.dashboard') }}" class="menu-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <i class="fas fa-home"></i>
                <span class="menu-text">Dashboard</span>
            </a>
            <a href="{{ route('admin.directivos') }}" class="menu-item {{ request()->routeIs('admin.directivos') ? 'active' : '' }}">
                <i class="fas fa-user-tie"></i>
                <span class="menu-text">Directivos</span>
            </a>
            <a href="{{ route('admin.invitaciones') }}" class="menu-item {{ request()->routeIs('admin.invitaciones') ? 'active' : '' }}">
                <i class="fas fa-envelope"></i>
                <span class="menu-text">Invitaciones</span>
            </a>
            <a href="{{ route('admin.usuarios') }}" class="menu-item {{ request()->routeIs('admin.usuarios') ? 'active' : '' }}">
                <i class="fas fa-users"></i>
                <span class="menu-text">Usuarios</span>
            </a>
            <a href="{{ route('admin.noticias.index') }}" class="menu-item {{ request()->routeIs('admin.noticias*') ? 'active' : '' }}">
                <i class="fas fa-newspaper"></i>
                <span class="menu-text">Noticias</span>
            </a>
            <a href="{{ route('admin.eventos') }}" class="menu-item {{ request()->routeIs('admin.eventos') ? 'active' : '' }}">
                <i class="fas fa-calendar-alt"></i>
                <span class="menu-text">Eventos</span>
            </a>
            <a href="{{ route('admin.documentos') }}" class="menu-item {{ request()->routeIs('admin.documentos') ? 'active' : '' }}">
                <i class="fas fa-file-pdf"></i>
                <span class="menu-text">Documentos</span>
            </a>
        </nav>

        <div class="sidebar-footer">
            <a href="{{ url('/') }}" class="menu-item">
                <i class="fas fa-globe"></i>
                <span class="menu-text">Ver Sitio Web</span>
            </a>
        </div>

    </aside>

    <div class="overlay" id="overlay"></div>

    <!-- CONTENIDO PRINCIPAL -->
    <main class="content">

        <!-- TOPBAR MEJORADO -->
        <header class="topbar">
            <button class="toggle-sidebar" id="toggleSidebar">
                <i class="fas fa-bars"></i>
            </button>

            <div class="hamburger" id="hamburger">
                <i class="fas fa-bars"></i>
            </div>

            <div class="topbar-center">
                <span class="page-title">@yield('page-title', 'Dashboard')</span>
            </div>

            <div class="user-info">
                <div class="user-avatar">
                    {{ strtoupper(substr(auth()->user()->name, 0, 2)) }}
                </div>
                <span class="user-name">{{ auth()->user()->name }}</span>

                <form action="/logout" method="POST" style="display: inline;">
                    @csrf
                    <button class="logout-btn" type="submit">
                        <i class="fas fa-sign-out-alt"></i>
                        <span>Salir</span>
                    </button>
                </form>
            </div>
        </header>

        <!-- CONTENIDO DE LA PÁGINA -->
        <section class="page-content">
            @yield('content')
        </section>

    </main>

</div>

<script>
// Toggle sidebar
const toggleBtn = document.getElementById('toggleSidebar');
const hamburger = document.getElementById('hamburger');
const sidebar = document.getElementById('adminSidebar');
const overlay = document.getElementById('overlay');

function toggleSidebar() {
    sidebar.classList.toggle('show');
    overlay.classList.toggle('show');
}

function closeSidebar() {
    sidebar.classList.remove('show');
    overlay.classList.remove('show');
}

// Click en botones toggle
if (toggleBtn) {
    toggleBtn.addEventListener('click', toggleSidebar);
}

if (hamburger) {
    hamburger.addEventListener('click', toggleSidebar);
}

// Click en overlay para cerrar
if (overlay) {
    overlay.addEventListener('click', closeSidebar);
}

// Click en items del menu para cerrar (solo en móvil)
const menuItems = document.querySelectorAll('.menu-item');
menuItems.forEach(item => {
    item.addEventListener('click', function() {
        if (window.innerWidth <= 900) {
            closeSidebar();
        }
    });
});

// Cerrar sidebar cuando se redimensiona a pantalla grande
window.addEventListener('resize', function() {
    if (window.innerWidth > 900) {
        closeSidebar();
    }
});
</script>

</body>
</html>
