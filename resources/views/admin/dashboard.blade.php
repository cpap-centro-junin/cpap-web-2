@extends('layouts.admin')

@section('title', 'Dashboard - Panel Administrativo')

@section('content')

<!-- Dashboard Header -->
<div class="dashboard-header">
    <div>
        <h1>¡Bienvenido, {{ auth()->user()->name }}!</h1>
        <p>Panel administrativo del Colegio de Antropólogos del Perú – Región Centro</p>
    </div>
    <div class="dashboard-date">
        <i class="fas fa-calendar-alt"></i>
        <span>{{ \Carbon\Carbon::now()->locale('es')->isoFormat('dddd, D [de] MMMM [de] YYYY') }}</span>
    </div>
</div>

<!-- Stats Overview -->
<div class="stats-overview">
    <div class="stat-box">
        <div class="stat-icon" style="background: linear-gradient(135deg, #2e7d32 0%, #1b5e20 100%);">
            <i class="fas fa-newspaper"></i>
        </div>
        <div class="stat-info">
            <h3>{{ \App\Models\Noticia::count() }}</h3>
            <p>Noticias Publicadas</p>
        </div>
    </div>

    <div class="stat-box">
        <div class="stat-icon" style="background: linear-gradient(135deg, #e65100 0%, #d84315 100%);">
            <i class="fas fa-envelope"></i>
        </div>
        <div class="stat-info">
            <h3>{{ \App\Models\Invitaciones::where('usado', false)->count() }}</h3>
            <p>Invitaciones Pendientes</p>
        </div>
    </div>

    <div class="stat-box">
        <div class="stat-icon" style="background: linear-gradient(135deg, #1565c0 0%, #0d47a1 100%);">
            <i class="fas fa-users"></i>
        </div>
        <div class="stat-info">
            <h3>{{ \App\Models\User::count() }}</h3>
            <p>Usuarios Registrados</p>
        </div>
    </div>

    <div class="stat-box">
        <div class="stat-icon" style="background: linear-gradient(135deg, var(--secondary) 0%, var(--accent) 100%);">
            <i class="fas fa-check-circle"></i>
        </div>
        <div class="stat-info">
            <h3>{{ \App\Models\Noticia::where('activo', true)->count() }}</h3>
            <p>Noticias Activas</p>
        </div>
    </div>
</div>

<!-- Sección Principal -->
<div class="dashboard-section">
    <h2 class="section-title">
        <i class="fas fa-grip-horizontal"></i>
        Accesos Rápidos
    </h2>

    <div class="cards">
        <a href="{{ route('admin.noticias.index') }}" class="card card-featured">
            <div class="card-icon">
                <i class="fas fa-newspaper"></i>
            </div>
            <div class="card-content">
                <strong>Gestión de Noticias</strong>
                <p>Crear, editar y publicar noticias institucionales</p>
            </div>
            <div class="card-arrow">
                <i class="fas fa-arrow-right"></i>
            </div>
        </a>

        <a href="{{ route('admin.invitaciones') }}" class="card card-featured">
            <div class="card-icon">
                <i class="fas fa-envelope-open-text"></i>
            </div>
            <div class="card-content">
                <strong>Sistema de Invitaciones</strong>
                <p>Enviar invitaciones para nuevos usuarios</p>
            </div>
            <div class="card-arrow">
                <i class="fas fa-arrow-right"></i>
            </div>
        </a>

        <a href="{{ route('admin.directivos') }}" class="card">
            <div class="card-icon" style="background: linear-gradient(135deg, #8B1538 0%, #6B0F2A 100%);">
                <i class="fas fa-user-tie"></i>
            </div>
            <div class="card-content">
                <strong>Directivos</strong>
                <p>Gestionar miembros del consejo</p>
            </div>
            <div class="card-arrow">
                <i class="fas fa-arrow-right"></i>
            </div>
        </a>

        <a href="{{ route('admin.usuarios') }}" class="card">
            <div class="card-icon" style="background: linear-gradient(135deg, #1565c0 0%, #0d47a1 100%);">
                <i class="fas fa-users-cog"></i>
            </div>
            <div class="card-content">
                <strong>Usuarios</strong>
                <p>Administrar cuentas de usuario</p>
            </div>
            <div class="card-arrow">
                <i class="fas fa-arrow-right"></i>
            </div>
        </a>

        <a href="{{ route('admin.eventos.index') }}" class="card">
            <div class="card-icon" style="background: linear-gradient(135deg, #e65100 0%, #d84315 100%);">
                <i class="fas fa-calendar-check"></i>
            </div>
            <div class="card-content">
                <strong>Eventos</strong>
                <p>Gestionar eventos y actividades</p>
            </div>
            <div class="card-arrow">
                <i class="fas fa-arrow-right"></i>
            </div>
        </a>

        <a href="{{ route('admin.documentos') }}" class="card">
            <div class="card-icon" style="background: linear-gradient(135deg, #2e7d32 0%, #1b5e20 100%);">
                <i class="fas fa-file-pdf"></i>
            </div>
            <div class="card-content">
                <strong>Documentos</strong>
                <p>Gestionar documentación oficial</p>
            </div>
            <div class="card-arrow">
                <i class="fas fa-arrow-right"></i>
            </div>
        </a>
    </div>
</div>

<!-- Actividad Reciente -->
<div class="dashboard-section">
    <h2 class="section-title">
        <i class="fas fa-clock"></i>
        Actividad Reciente
    </h2>

    <div class="activity-cards">
        @php
            $recentNews = \App\Models\Noticia::latest()->take(3)->get();
        @endphp

        @if($recentNews->count() > 0)
            @foreach($recentNews as $noticia)
            <div class="activity-card">
                <div class="activity-icon">
                    <i class="fas fa-newspaper"></i>
                </div>
                <div class="activity-info">
                    <h4>{{ $noticia->titulo }}</h4>
                    <p>
                        <i class="fas fa-calendar"></i>
                        {{ $noticia->created_at->diffForHumans() }}
                    </p>
                </div>
                <span class="badge {{ $noticia->activo ? 'published' : 'hidden' }}">
                    {{ $noticia->activo ? 'Publicado' : 'Oculto' }}
                </span>
            </div>
            @endforeach
        @else
            <div class="empty-state">
                <i class="fas fa-inbox"></i>
                <p>No hay actividad reciente</p>
            </div>
        @endif
    </div>
</div>

<!-- Acciones Rápidas -->
<div class="quick-actions">
    <a href="{{ route('admin.noticias.create') }}" class="action-btn primary">
        <i class="fas fa-plus-circle"></i>
        <span>Nueva Noticia</span>
    </a>
    <a href="{{ route('admin.invitaciones') }}" class="action-btn secondary">
        <i class="fas fa-paper-plane"></i>
        <span>Enviar Invitación</span>
    </a>
</div>

@endsection
