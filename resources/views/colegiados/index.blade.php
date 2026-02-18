@extends('layouts.app')

@section('title', 'Directorio de Colegiados | CPAP')

{{-- Styles en resources/css/pages/colegiados.css --}}

@section('content')

{{-- HERO CON BUSCADOR --}}
<section class="cpap-hero">
    <div class="cpap-hero-content" data-aos="fade-up">
        <div class="cpap-hero-badge">
            <i class="fas fa-id-badge"></i>
            Sección CPAP &mdash; Directorio Oficial
        </div>
        <h1>Directorio de <span>Colegiados</span></h1>
        <p>Consulta el estado de habilitación de los miembros del Colegio Profesional de Antropólogos del Perú &mdash; Región Centro</p>

        {{-- Formulario de búsqueda --}}
        <form action="{{ route('colegiados.index') }}" method="GET">
            @if(request('estado'))
                <input type="hidden" name="estado" value="{{ request('estado') }}">
            @endif
            <div class="search-box">
                <i class="fas fa-search" style="color: var(--medium-gray);"></i>
                <input
                    type="text"
                    name="buscar"
                    value="{{ $buscar }}"
                    placeholder="Buscar por nombre, DNI o código CPAP..."
                    autocomplete="off"
                >
                <button type="submit" class="btn-search">
                    <i class="fas fa-search"></i>
                    Buscar
                </button>
            </div>
        </form>
    </div>
</section>

{{-- FILTROS PEGAJOSOS --}}
<div class="filters-section">
    <div class="filters-inner">
        <span class="filter-label">Filtrar:</span>
        <div class="filter-chips">
            <a href="{{ route('colegiados.index', array_filter(['buscar' => $buscar])) }}"
               class="filter-chip {{ !$estado ? 'active' : '' }}">
                <i class="fas fa-users"></i> Todos
            </a>
            <a href="{{ route('colegiados.index', array_filter(['buscar' => $buscar, 'estado' => 'activo'])) }}"
               class="filter-chip {{ $estado === 'activo' ? 'active-success' : '' }}">
                <i class="fas fa-check-circle"></i> Habilitados
            </a>
            <a href="{{ route('colegiados.index', array_filter(['buscar' => $buscar, 'estado' => 'inactivo'])) }}"
               class="filter-chip {{ $estado === 'inactivo' ? 'active-danger' : '' }}">
                <i class="fas fa-times-circle"></i> No Habilitados
            </a>
        </div>

        @if($colegiados)
            <span class="results-count">
                {{ $colegiados->total() }} resultado{{ $colegiados->total() !== 1 ? 's' : '' }}
            </span>
        @endif
    </div>
</div>

{{-- CONTENIDO --}}
<section class="cpap-main">
    <div class="cpap-container">

        {{-- Estado inicial sin búsqueda --}}
        @if(!$colegiados)
            <div class="empty-state" data-aos="fade-up">
                <div class="empty-state-icon">
                    <i class="fas fa-search"></i>
                </div>
                <h3>Busca un colegiado</h3>
                <p>Ingresa el nombre, DNI o código CPAP del profesional que deseas consultar, o usa los filtros para explorar el directorio.</p>
                <a href="{{ route('colegiados.index', ['estado' => 'activo']) }}" class="btn btn-primary">
                        <i class="fas fa-check-circle"></i>
                        Ver Habilitados
                    </a>
            </div>

        @elseif($colegiados->total() === 0)
            {{-- Sin resultados --}}
            <div class="no-results" data-aos="fade-up">
                <i class="fas fa-user-times"></i>
                <h3 style="font-family:'Nunito',sans-serif; font-weight:700; margin-bottom:8px;">
                    Sin resultados para "{{ $buscar }}"
                </h3>
                <p style="color:var(--medium-gray); margin-bottom:24px;">
                    Intenta con el DNI completo, apellidos o código CPAP exacto.
                </p>
                <a href="{{ route('colegiados.index') }}" class="btn btn-outline">
                    <i class="fas fa-arrow-left"></i> Nueva búsqueda
                </a>
            </div>

        @else
            {{-- GRID DE RESULTADOS --}}
            <div class="colegiados-grid">
                @foreach($colegiados as $index => $colegiado)
                    <a href="{{ route('colegiados.show', $colegiado) }}"
                       class="colegiado-card"
                       data-aos="fade-up"
                       data-aos-delay="{{ min(($index % 4) * 80, 300) }}">

                        <div class="card-header-bg">
                            <div class="card-avatar-wrapper">
                                @if($colegiado->foto)
                                    <img src="{{ asset($colegiado->foto) }}"
                                         alt="{{ $colegiado->nombre_completo }}"
                                         class="card-avatar">
                                @else
                                    <div class="card-avatar-placeholder">
                                        {{ strtoupper(substr($colegiado->nombres, 0, 1) . substr($colegiado->apellidos, 0, 1)) }}
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="card-name">{{ $colegiado->nombre_completo }}</div>
                            <div class="card-code">{{ $colegiado->codigo_cpap }}</div>
                            <div class="card-specialty">
                                {{ $colegiado->especialidad ?? 'Antropólogo Profesional' }}
                            </div>
                            <div>
                                @if($colegiado->estado === 'activo')
                                    <span class="estado-badge activo">
                                        <i class="fas fa-circle" style="font-size:7px;"></i>
                                        HABILITADO
                                    </span>
                                @else
                                    <span class="estado-badge inactivo">
                                        <i class="fas fa-circle" style="font-size:7px;"></i>
                                        NO HABILITADO
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="card-footer-action">
                            <i class="fas fa-eye"></i>
                            Ver Perfil
                        </div>
                    </a>
                @endforeach
            </div>

            {{-- PAGINACIÓN --}}
            @if($colegiados->hasPages())
                <div class="pagination-wrapper">
                    {{ $colegiados->links() }}
                </div>
            @endif
        @endif

    </div>
</section>

@endsection