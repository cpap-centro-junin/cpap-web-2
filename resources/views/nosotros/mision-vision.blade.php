@extends('layouts.app')

@section('title', 'Misión y Visión - CPAP Región Centro')

@vite(['resources/js/modules/mision-vision.js'])

@section('content')

<!-- Page Header -->
<section class="page-header">
    <div class="page-header-overlay"></div>
    <div class="container">
        <div class="page-header-content" data-aos="fade-up">
            <h1 class="page-title">
                <i class="fas fa-university"></i>
                Nosotros
            </h1>
            <p class="page-subtitle">
                Conoce los principios que guían al Colegio Profesional de Antropólogos del Perú – Región Centro
            </p>
            <nav class="breadcrumb">
                <a href="{{ url('/') }}">Inicio</a>
                <span>/</span>
                <span>Misión y Visión</span>
            </nav>
        </div>
    </div>
</section>

<!-- Tabs Section -->
<section class="mv-section">

    <!-- Navigation de tabs (labels vinculados a los radio inputs) -->
    <div class="mv-nav">
        <label for="tab1" class="mv-nav-item active" data-tab="tab1">
            <i class="fas fa-bullseye"></i>
            <span>Misión</span>
        </label>
        <label for="tab2" class="mv-nav-item" data-tab="tab2">
            <i class="fas fa-user-shield"></i>
            <span>Ética</span>
        </label>
        <label for="tab3" class="mv-nav-item" data-tab="tab3">
            <i class="fas fa-eye"></i>
            <span>Visión</span>
        </label>
        <label for="tab4" class="mv-nav-item" data-tab="tab4">
            <i class="fas fa-globe-americas"></i>
            <span>Proyección</span>
        </label>
    </div>

    <!-- Contenido Tab (inputs intercalados con contenidos - necesario para CSS selector +) -->
    <div class="mv-tabs">

        <!-- TAB 1 - MISIÓN -->
        <input type="radio" name="mv-tabs" id="tab1" checked>
        <div class="mv-content">
            <div class="mv-grid">
                <div class="mv-text">
                    <span class="mv-tag">
                        <i class="fas fa-bullseye"></i> Misión
                    </span>
                    <h2>Misión Institucional</h2>
                    <p>
                        Velar por el ejercicio y defensa profesional de los antropólogos,
                        promoviendo su capacitación permanente y fortaleciendo el rol de la
                        antropología en el desarrollo social, académico y científico del país.
                    </p>
                    <ul class="mv-list">
                        <li><i class="fas fa-check-circle"></i> Defensa del ejercicio profesional</li>
                        <li><i class="fas fa-check-circle"></i> Capacitación continua y actualización</li>
                        <li><i class="fas fa-check-circle"></i> Fortalecimiento académico y científico</li>
                    </ul>
                </div>
                <div class="mv-image">
                    <img src="{{ asset('images/noticias/ceremonia-juramentacion.png') }}"
                         alt="Misión CPAP"
                         loading="lazy"
                         onerror="this.src='https://images.unsplash.com/photo-1523580846011-d3a5bc25702b?w=900'">
                    <div class="mv-image-badge">
                        <i class="fas fa-bullseye"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- TAB 2 - ÉTICA -->
        <input type="radio" name="mv-tabs" id="tab2">
        <div class="mv-content">
            <div class="mv-grid">
                <div class="mv-text">
                    <span class="mv-tag">
                        <i class="fas fa-user-shield"></i> Ética
                    </span>
                    <h2>Compromiso Profesional</h2>
                    <p>
                        Defender el ejercicio ético de la profesión, garantizando calidad,
                        responsabilidad social y respeto a la diversidad cultural del Perú.
                        Nuestro código deontológico rige la conducta de todos los colegiados.
                    </p>
                    <ul class="mv-list">
                        <li><i class="fas fa-check-circle"></i> Responsabilidad social y ética</li>
                        <li><i class="fas fa-check-circle"></i> Respeto a la diversidad cultural</li>
                        <li><i class="fas fa-check-circle"></i> Código deontológico riguroso</li>
                    </ul>
                </div>
                <div class="mv-image">
                    <img src="{{ asset('images/noticias/ceremonia-juramentacion.png') }}"
                         alt="Ética CPAP"
                         loading="lazy"
                         onerror="this.src='https://images.unsplash.com/photo-1556761175-5973dc0f32e7?w=900'">
                    <div class="mv-image-badge">
                        <i class="fas fa-user-shield"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- TAB 3 - VISIÓN -->
        <input type="radio" name="mv-tabs" id="tab3">
        <div class="mv-content">
            <div class="mv-grid">
                <div class="mv-text">
                    <span class="mv-tag">
                        <i class="fas fa-eye"></i> Visión
                    </span>
                    <h2>Visión Institucional</h2>
                    <p>
                        Ser una institución moderna, sólida y organizada, con miembros
                        altamente capacitados y proyectos de impacto nacional, reconocida
                        como referente de la antropología peruana.
                    </p>
                    <ul class="mv-list">
                        <li><i class="fas fa-check-circle"></i> Institución moderna y sólida</li>
                        <li><i class="fas fa-check-circle"></i> Miembros altamente capacitados</li>
                        <li><i class="fas fa-check-circle"></i> Proyectos de impacto nacional</li>
                    </ul>
                </div>
                <div class="mv-image">
                    <img src="{{ asset('images/noticias/ceremonia-juramentacion.png') }}"
                         alt="Visión CPAP"
                         loading="lazy"
                         onerror="this.src='https://images.unsplash.com/photo-1500530855697-b586d89ba3ee?w=900'">
                    <div class="mv-image-badge">
                        <i class="fas fa-eye"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- TAB 4 - PROYECCIÓN -->
        <input type="radio" name="mv-tabs" id="tab4">
        <div class="mv-content">
            <div class="mv-grid">
                <div class="mv-text">
                    <span class="mv-tag">
                        <i class="fas fa-globe-americas"></i> Proyección
                    </span>
                    <h2>Proyección Nacional</h2>
                    <p>
                        Consolidarnos como un órgano de jerarquía nacional con presencia
                        activa en todo el territorio peruano, liderando el desarrollo
                        de la antropología como ciencia social transformadora.
                    </p>
                    <ul class="mv-list">
                        <li><i class="fas fa-check-circle"></i> Presencia en todo el territorio nacional</li>
                        <li><i class="fas fa-check-circle"></i> Liderazgo en investigación social</li>
                        <li><i class="fas fa-check-circle"></i> Articulación con academia y Estado</li>
                    </ul>
                </div>
                <div class="mv-image">
                    <img src="{{ asset('images/proyeccion.jpg') }}"
                         alt="Proyección Nacional CPAP"
                         loading="lazy"
                         onerror="this.src='https://images.unsplash.com/photo-1506784983877-45594efa4cbe?w=900'">
                    <div class="mv-image-badge">
                        <i class="fas fa-globe-americas"></i>
                    </div>
                </div>
            </div>
        </div>

    </div><!-- /.mv-tabs -->

</section>

@endsection
