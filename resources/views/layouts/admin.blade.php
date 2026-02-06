<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>@yield('title') - Panel Administrativo</title>

    @vite(['resources/css/admin.css'])
</head>

<body>

<div class="admin-wrapper">

    <!-- SIDEBAR -->
    <aside class="sidebar">

        <div class="sidebar-header">
            <div class="logo-box">
                <img src="{{ asset('images/logos/cpap-logo.jpg') }}" class="logo">
            </div>

            <h3>CPAP</h3>
            <p>Colegio de Antropólogos</p>
        </div>

        <nav class="menu">
            <a href="{{ route('admin.dashboard') }}" class="menu-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">🏠 <span>Dashboard</span></a>
            <a href="{{ route('admin.directivos') }}" class="menu-item {{ request()->routeIs('admin.directivos') ? 'active' : '' }}">👥 <span>Directivos</span></a>
            <a href="{{ route('admin.invitaciones') }}" class="menu-item {{ request()->routeIs('admin.invitaciones') ? 'active' : '' }}">✉️ <span>Invitaciones</span></a>
            <a href="{{ route('admin.usuarios') }}" class="menu-item {{ request()->routeIs('admin.usuarios') ? 'active' : '' }}">🧑‍💼 <span>Usuarios</span></a>
            <a href="{{ route('admin.noticias.index') }}" class="menu-item {{ request()->routeIs('admin.noticias.index') ? 'active' : '' }}">📰 <span>Noticias</span></a>
            <a href="{{ route('admin.eventos') }}" class="menu-item {{ request()->routeIs('admin.eventos') ? 'active' : '' }}">📅 <span>Eventos</span></a>
            <a href="{{ route('admin.documentos') }}" class="menu-item {{ request()->routeIs('admin.documentos') ? 'active' : '' }}">📄 <span>Documentos</span></a>
        </nav>

    </aside>
    <div class="overlay" onclick="toggleSidebar()"></div>

    <!-- CONTENIDO -->
    <main class="content">

        <header class="topbar">
            <div class="hamburger" onclick="toggleSidebar()">
                ☰
            </div>
            <div class="user-info">
                <span class="user-name">{{ auth()->user()->name }}</span>

                <form action="/logout" method="POST">
                    @csrf
                    <button class="logout-btn">Salir</button>
                </form>
            </div>
        </header>

        <section class="page-content">
            @yield('content')
        </section>

    </main>

</div>

<script>

function toggleSidebar(){

    const sidebar = document.querySelector(".sidebar");
    const overlay = document.querySelector(".overlay");

    sidebar.classList.toggle("show");
    overlay.classList.toggle("show");

}

</script>



</body>
</html>
