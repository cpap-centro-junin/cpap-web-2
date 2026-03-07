@php use Illuminate\Support\Str; @endphp

@extends('layouts.app')

@section('title', $evento->titulo . ' - CPAP')

@section('content')

{{-- PAGE HEADER --}}
<header class="page-header">
    <div class="page-header__overlay"></div>
    <div class="container" style="position:relative;z-index:2;max-width:var(--container-max);margin:0 auto;padding:0 var(--spacing-lg);">
        <div class="page-header__content">
            <h1 class="page-title">
                <i class="fas fa-calendar-alt"></i>
                {{ Str::limit($evento->titulo, 60) }}
            </h1>
            <nav class="breadcrumb" aria-label="breadcrumb">
                <a href="{{ url('/') }}" class="breadcrumb__item"><i class="fas fa-home"></i> Inicio</a>
                <span class="breadcrumb__separator"><i class="fas fa-chevron-right"></i></span>
                <a href="{{ route('eventos.index') }}" class="breadcrumb__item">Eventos</a>
                <span class="breadcrumb__separator"><i class="fas fa-chevron-right"></i></span>
                <span class="breadcrumb__item breadcrumb__item--active">{{ Str::limit($evento->titulo, 40) }}</span>
            </nav>
        </div>
    </div>
</header>

{{-- ARTÍCULO EVENTO --}}
<div class="article-layout">

    {{-- CONTENIDO PRINCIPAL --}}
    <article class="article-main" data-aos="fade-up">

        @if($evento->imagen_portada)
            <img
                src="{{ $evento->imagen_portada }}"
                alt="{{ $evento->titulo }}"
                class="article-cover"
            >
        @endif

        <div class="article-meta-bar">
            <span class="article-badge" style="background:var(--accent);color:var(--dark);">
                <i class="fas fa-tag"></i>
                {{ $evento->categoria }}
            </span>
            <span class="article-meta-item">
                <i class="fas fa-calendar-alt"></i>
                {{ $evento->fecha_inicio->translatedFormat('d \d\e F, Y') }}
            </span>
            @if($evento->hora_inicio)
            <span class="article-meta-item">
                <i class="fas fa-clock"></i>
                {{ \Carbon\Carbon::parse($evento->hora_inicio)->format('H:i') }} hrs
            </span>
            @endif
            @if($evento->lugar)
            <span class="article-meta-item">
                <i class="fas fa-map-marker-alt"></i>
                {{ $evento->lugar }}
            </span>
            @endif
            <span class="article-meta-item"
                  style="margin-left:auto;background:{{ $evento->es_proximo ? 'var(--success-light)' : 'var(--light-gray)' }};color:{{ $evento->es_proximo ? 'var(--success)' : 'var(--medium-gray)' }};padding:4px 14px;border-radius:var(--radius-full);font-weight:600;">
                <i class="fas fa-circle" style="font-size:8px;"></i>
                {{ $evento->es_proximo ? 'Próximo' : 'Realizado' }}
            </span>
        </div>

        <h1 class="article-title">{{ $evento->titulo }}</h1>

        @if($evento->resumen)
        <div class="article-summary">
            {{ $evento->resumen }}
        </div>
        @endif

        <div class="article-body">
            {!! $evento->descripcion !!}
        </div>

        <a href="{{ route('eventos.index') }}" class="article-back">
            <i class="fas fa-arrow-left"></i>
            Volver a Eventos
        </a>

    </article>

    {{-- SIDEBAR --}}
    <aside class="article-sidebar">

        {{-- Info del Evento --}}
        <div class="evento-info-box" data-aos="fade-left">
            <h3 class="evento-info-box__title">
                <i class="fas fa-info-circle"></i>
                Detalles del Evento
            </h3>

            <div class="evento-info-row">
                <div class="evento-info-row__icon"><i class="fas fa-calendar-alt"></i></div>
                <div class="evento-info-row__content">
                    <div class="evento-info-row__label">Fecha de inicio</div>
                    <div class="evento-info-row__value">{{ $evento->fecha_inicio->translatedFormat('d \d\e F, Y') }}</div>
                </div>
            </div>

            @if($evento->fecha_fin && $evento->fecha_fin != $evento->fecha_inicio)
            <div class="evento-info-row">
                <div class="evento-info-row__icon"><i class="fas fa-calendar-check"></i></div>
                <div class="evento-info-row__content">
                    <div class="evento-info-row__label">Fecha de fin</div>
                    <div class="evento-info-row__value">{{ $evento->fecha_fin->translatedFormat('d \d\e F, Y') }}</div>
                </div>
            </div>
            @endif

            @if($evento->hora_inicio)
            <div class="evento-info-row">
                <div class="evento-info-row__icon"><i class="fas fa-clock"></i></div>
                <div class="evento-info-row__content">
                    <div class="evento-info-row__label">Hora</div>
                    <div class="evento-info-row__value">{{ \Carbon\Carbon::parse($evento->hora_inicio)->format('H:i') }} hrs</div>
                </div>
            </div>
            @endif

            @if($evento->lugar)
            <div class="evento-info-row">
                <div class="evento-info-row__icon"><i class="fas fa-map-marker-alt"></i></div>
                <div class="evento-info-row__content">
                    <div class="evento-info-row__label">Lugar</div>
                    <div class="evento-info-row__value">{{ $evento->lugar }}</div>
                </div>
            </div>
            @endif

            <div class="evento-info-row">
                <div class="evento-info-row__icon"><i class="fas fa-layer-group"></i></div>
                <div class="evento-info-row__content">
                    <div class="evento-info-row__label">Categoría</div>
                    <div class="evento-info-row__value">{{ $evento->categoria }}</div>
                </div>
            </div>
        </div>

        {{-- CTA Inscripción (solo si es próximo) --}}
        @if($evento->es_proximo)
        <div class="evento-cta" data-aos="fade-left" data-aos-delay="100">
            <h4 style="color: white;"><i class="fas fa-user-plus" style="color: white;"></i> ¡Participa!</h4>
            <p style="color: white;">No te pierdas este evento. Contáctanos para más información.</p>
            <a href="{{ url('/#contacto') }}" class="btn-inscribir">
                <i class="fas fa-envelope"></i>
                Contactar
            </a>
        </div>
        @endif

        {{-- Eventos relacionados --}}
        @if($relacionados->count() > 0)
        <div class="sidebar-widget" data-aos="fade-left" data-aos-delay="150">
            <div class="sidebar-widget__header">
                <i class="fas fa-calendar-alt"></i>
                Otros Eventos
            </div>
            <div class="sidebar-widget__body">
                @foreach($relacionados as $rel)
                <a href="{{ route('eventos.show', $rel) }}" class="mini-card">
                    @if($rel->imagen_portada)
                        <img src="{{ $rel->imagen_portada }}" alt="{{ $rel->titulo }}" class="mini-card__image">
                    @else
                        <div class="mini-card__placeholder">
                            <i class="fas fa-calendar-alt"></i>
                        </div>
                    @endif
                    <div class="mini-card__content">
                        <div class="mini-card__title">{{ $rel->titulo }}</div>
                        <div class="mini-card__date">
                            <i class="fas fa-calendar-alt"></i>
                            {{ $rel->fecha_inicio->format('d M, Y') }}
                        </div>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
        @endif

        {{-- Compartir --}}
        <div class="sidebar-widget" data-aos="fade-left" data-aos-delay="200">
            <div class="sidebar-widget__header">
                <i class="fas fa-share-alt"></i>
                Compartir Evento
            </div>
            <div class="sidebar-widget__body" style="display:flex;gap:10px;flex-wrap:wrap;">
                <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->fullUrl()) }}"
                   target="_blank" rel="noopener"
                   style="flex:1;display:inline-flex;align-items:center;justify-content:center;gap:6px;padding:10px;background:#1877f2;color:#fff;border-radius:var(--radius-sm);font-size:var(--font-sm);font-weight:600;text-decoration:none;min-width:80px;">
                    <i class="fab fa-facebook-f"></i> Facebook
                </a>
                <a href="https://api.whatsapp.com/send?text={{ urlencode($evento->titulo . ' ' . request()->fullUrl()) }}"
                   target="_blank" rel="noopener"
                   style="flex:1;display:inline-flex;align-items:center;justify-content:center;gap:6px;padding:10px;background:#25d366;color:#fff;border-radius:var(--radius-sm);font-size:var(--font-sm);font-weight:600;text-decoration:none;min-width:80px;">
                    <i class="fab fa-whatsapp"></i> WhatsApp
                </a>
            </div>
        </div>

    </aside>

</div>

@endsection
