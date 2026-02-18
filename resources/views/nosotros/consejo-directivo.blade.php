{{-- resources/views/nosotros/consejo-directivo.blade.php --}}
@extends('layouts.app')

@section('title', 'Consejo Directivo - CPAP Región Centro')

@vite(['resources/js/modules/consejo.js'])

@section('content')

<!-- Page Header -->
<section class="page-header">
    <div class="page-header-overlay"></div>
    <div class="container">
        <div class="page-header-content" data-aos="fade-up">
            <h1 class="page-title">
                <i class="fas fa-users"></i>
                Consejo Directivo
            </h1>
            <p class="page-subtitle">
                Equipo responsable de la dirección y representación institucional del CPAP – Región Centro
            </p>
            <nav class="breadcrumb">
                <a href="{{ url('/') }}">Inicio</a>
                <span>/</span>
                <span>Consejo Directivo</span>
            </nav>
        </div>
    </div>
</section>

<!-- Equipo de Gobierno -->
<section class="section-padding bg-light" id="consejo">
    <div class="container">

        <!-- Header de sección -->
        <div class="section-header text-center" data-aos="fade-up">
            <span class="section-badge">Gestión 2024 – 2026</span>
            <h2 class="section-title">Equipo de Gobierno</h2>
            <p class="section-subtitle">
                Conoce a los profesionales que lideran el Colegio Profesional de Antropólogos del Perú – Región Centro
            </p>
        </div>

        @php
            $periodo = $consejo->first()?->periodo ?? '2024 – 2026';
        @endphp

        <!-- Grid de Cards -->
        @if($consejo->isEmpty())
        <div class="text-center" style="padding:60px 20px;color:var(--medium-gray);">
            <i class="fas fa-users" style="font-size:48px;margin-bottom:16px;opacity:0.3;display:block;"></i>
            <p style="font-size:16px;">El Consejo Directivo se publicará próximamente.</p>
        </div>
        @else
        <div class="consejo-grid">
            @foreach($consejo as $miembro)
            <div class="consejo-card" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">

                <!-- Foto -->
                <div class="consejo-card__photo" id="photo-{{ $loop->index }}">
                    <div class="consejo-card__photo-fallback">
                        <i class="fas fa-user-tie"></i>
                    </div>
                    @if($miembro->foto)
                    <img src="{{ asset('storage/' . $miembro->foto) }}"
                         alt="{{ $miembro->nombre }}"
                         loading="lazy"
                         onerror="document.getElementById('photo-{{ $loop->index }}').classList.add('no-photo')">
                    @endif
                </div>

                <!-- Cargo badge -->
                <div class="consejo-card__cargo">
                    <i class="fas {{ $miembro->icon }}"></i>
                    {{ $miembro->cargo }}
                </div>

                <!-- Cuerpo -->
                <div class="consejo-card__body">
                    <h3 class="consejo-card__nombre">{{ $miembro->nombre }}</h3>
                    @if($miembro->especialidad)
                    <p class="consejo-card__especialidad">
                        <i class="fas fa-graduation-cap"></i>
                        {{ $miembro->especialidad }}
                    </p>
                    @endif
                </div>

                <!-- Decoración bottom -->
                <div class="consejo-card__footer">
                    <span class="consejo-card__periodo">
                        <i class="fas fa-calendar-alt"></i>
                        Gestión {{ $miembro->periodo }}
                    </span>
                </div>

            </div>
            @endforeach
        </div>
        @endif

        <!-- CTA volver -->
        <div class="text-center mt-5" data-aos="fade-up">
            <a href="{{ route('home') }}" class="btn btn-outline">
                <i class="fas fa-arrow-left"></i>
                Volver al inicio
            </a>
        </div>

    </div>
</section>

@endsection
