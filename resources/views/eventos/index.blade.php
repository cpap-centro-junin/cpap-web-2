@php use Illuminate\Support\Str; @endphp

@extends('layouts.app')

@section('title', 'Eventos - CPAP')

@section('content')

{{-- PAGE HEADER --}}
<header class="page-header">
    <div class="page-header__overlay"></div>
    <div class="container" style="position:relative;z-index:2;max-width:var(--container-max);margin:0 auto;padding:0 var(--spacing-lg);">
        <div class="page-header__content">
            <h1 class="page-title">
                <i class="fas fa-calendar-alt"></i>
                Eventos
            </h1>
            <nav class="breadcrumb" aria-label="breadcrumb">
                <a href="{{ url('/') }}" class="breadcrumb__item">
                    <i class="fas fa-home"></i> Inicio
                </a>
                <span class="breadcrumb__separator"><i class="fas fa-chevron-right"></i></span>
                <span class="breadcrumb__item breadcrumb__item--active">Eventos</span>
            </nav>
        </div>
    </div>
</header>

{{-- DESTACADOS --}}
@if($destacados->count() > 0)
<section class="actualidad-featured">
    <div class="container" style="max-width:var(--container-max);margin:0 auto;padding:0 var(--spacing-lg);">
        <h2 class="featured-section-title" data-aos="fade-up">
            <i class="fas fa-star"></i>
            Eventos Destacados
        </h2>
        <div class="featured-grid" data-aos="fade-up" data-aos-delay="100">
            @php $main = $destacados->first(); @endphp
            <a href="{{ route('eventos.show', $main) }}" class="featured-card featured-card--main">
                @if($main->imagen_portada)
                    <img src="{{ $main->imagen_portada }}" alt="{{ $main->titulo }}" class="featured-card__image">
                @else
                    <div class="featured-card__placeholder">
                        <i class="fas fa-calendar-alt"></i>
                    </div>
                @endif
                <div class="featured-card__overlay"></div>
                <div class="featured-card__body">
                    <span class="featured-card__badge featured-card__badge--evento">{{ $main->categoria }}</span>
                    <h3 class="featured-card__title">{{ $main->titulo }}</h3>
                    <div class="featured-card__meta">
                        <span><i class="fas fa-calendar-alt"></i> {{ $main->fecha_inicio->format('d M, Y') }}</span>
                        @if($main->lugar)
                        <span><i class="fas fa-map-marker-alt"></i> {{ Str::limit($main->lugar, 30) }}</span>
                        @endif
                    </div>
                </div>
            </a>

            @foreach($destacados->skip(1) as $evento)
            <a href="{{ route('eventos.show', $evento) }}" class="featured-card featured-card--side">
                @if($evento->imagen_portada)
                    <img src="{{ $evento->imagen_portada }}" alt="{{ $evento->titulo }}" class="featured-card__image">
                @else
                    <div class="featured-card__placeholder">
                        <i class="fas fa-calendar-alt"></i>
                    </div>
                @endif
                <div class="featured-card__overlay"></div>
                <div class="featured-card__body">
                    <span class="featured-card__badge featured-card__badge--evento">{{ $evento->categoria }}</span>
                    <h3 class="featured-card__title">{{ $evento->titulo }}</h3>
                    <div class="featured-card__meta">
                        <span><i class="fas fa-calendar-alt"></i> {{ $evento->fecha_inicio->format('d M, Y') }}</span>
                    </div>
                </div>
            </a>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- LISTADO PRINCIPAL --}}
<section class="actualidad-main">
    <div class="container" style="max-width:var(--container-max);margin:0 auto;padding:0 var(--spacing-lg);">

        <div class="section-header" data-aos="fade-up">
            <h2 class="section-title">
                <i class="fas fa-calendar-check"></i>
                Todos los Eventos
            </h2>
            <span style="color:var(--medium-gray);font-size:var(--font-sm);">
                {{ $eventos->total() }} evento{{ $eventos->total() !== 1 ? 's' : '' }}
            </span>
        </div>

        <div class="news-grid">
            @forelse($eventos as $evento)
            <a href="{{ route('eventos.show', $evento) }}" class="evento-card" data-aos="fade-up" data-aos-delay="{{ ($loop->index % 3) * 100 }}">
                <div class="evento-card__image-wrap">
                    @if($evento->imagen_portada)
                        <img src="{{ $evento->imagen_portada }}" alt="{{ $evento->titulo }}" class="evento-card__image">
                    @else
                        <div class="news-card__image-placeholder">
                            <i class="fas fa-calendar-alt" style="color:var(--border);font-size:2.5rem;"></i>
                        </div>
                    @endif

                    <div class="evento-card__date-badge">
                        <span class="day">{{ $evento->fecha_inicio->format('d') }}</span>
                        <span class="month">{{ $evento->fecha_inicio->format('M') }}</span>
                    </div>

                    <span class="evento-card__status {{ $evento->es_proximo ? 'evento-card__status--proximo' : 'evento-card__status--pasado' }}">
                        {{ $evento->es_proximo ? 'Próximo' : 'Realizado' }}
                    </span>
                </div>
                <div class="evento-card__body">
                    <span class="evento-card__category">{{ $evento->categoria }}</span>
                    <h3 class="evento-card__title">{{ $evento->titulo }}</h3>
                    <p class="evento-card__excerpt">
                        {{ $evento->resumen ?: Str::limit(strip_tags($evento->descripcion), 100) }}
                    </p>
                    <div class="evento-card__info">
                        <div class="evento-card__info-item">
                            <i class="fas fa-calendar-alt"></i>
                            @if($evento->fecha_fin && $evento->fecha_fin != $evento->fecha_inicio)
                                {{ $evento->fecha_inicio->format('d M') }} – {{ $evento->fecha_fin->format('d M, Y') }}
                            @else
                                {{ $evento->fecha_inicio->format('d \d\e F, Y') }}
                            @endif
                        </div>
                        @if($evento->hora_inicio)
                        <div class="evento-card__info-item">
                            <i class="fas fa-clock"></i>
                            {{ \Carbon\Carbon::parse($evento->hora_inicio)->format('H:i') }} hrs
                        </div>
                        @endif
                        @if($evento->lugar)
                        <div class="evento-card__info-item">
                            <i class="fas fa-map-marker-alt"></i>
                            {{ Str::limit($evento->lugar, 50) }}
                        </div>
                        @endif
                    </div>
                </div>
            </a>
            @empty
            <div class="actualidad-empty">
                <i class="fas fa-calendar-times"></i>
                <h3>Sin eventos programados</h3>
                <p>Pronto anunciaremos nuevos eventos institucionales.</p>
            </div>
            @endforelse
        </div>

        @if($eventos->hasPages())
        <div class="actualidad-pagination" data-aos="fade-up">
            {{ $eventos->links() }}
        </div>
        @endif

    </div>
</section>

@endsection
