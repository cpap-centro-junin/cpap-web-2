@extends('layouts.admin')

@section('title', 'Detalle Solicitud')
@section('page-title', 'Detalle de la Solicitud')

@section('content')

<div class="msg-detail-wrap">

    {{-- CARD SOLICITANTE --}}
    <div class="msg-detail-card msg-sender-card">
        <div class="msg-detail-avatar">
            {{ strtoupper(substr($solicitud->nombre_contacto ?? $solicitud->empresa ?? 'S', 0, 2)) }}
        </div>
        <div class="msg-detail-meta">
            <div class="msg-detail-top">
                <h3>{{ $solicitud->titulo }}</h3>
                <span class="msg-detail-status {{ $solicitud->revisado ? 'msg-detail-status--read' : 'msg-detail-status--new' }}">
                    <i class="fas {{ $solicitud->revisado ? 'fa-check-double' : 'fa-circle' }}"></i>
                    {{ $solicitud->revisado ? 'Revisada' : 'Nueva' }}
                </span>
            </div>
            <div class="msg-detail-info">
                <span><i class="fas fa-user"></i> {{ $solicitud->nombre_contacto ?? 'Sin nombre' }}</span>
                <a href="mailto:{{ $solicitud->email_contacto }}" class="msg-detail-link">
                    <i class="fas fa-envelope"></i> {{ $solicitud->email_contacto }}
                </a>
                <span><i class="fas fa-building"></i> {{ $solicitud->empresa ?? 'Sin empresa' }}</span>
                <span><i class="fas fa-calendar-alt"></i> {{ $solicitud->created_at->format('d/m/Y H:i') }}</span>
            </div>
        </div>
    </div>

    {{-- DATOS DE LA OFERTA --}}
    <div class="msg-detail-card">
        <div class="msg-section-label">
            <i class="fas fa-briefcase"></i> Datos de la oferta
        </div>

        <div class="sol-detail-grid">
            @if($solicitud->tipo)
            <div class="sol-detail-item">
                <span class="sol-detail-label">Tipo de empleo</span>
                <span class="sol-detail-value">{{ $solicitud->tipo_label }}</span>
            </div>
            @endif

            @if($solicitud->area)
            <div class="sol-detail-item">
                <span class="sol-detail-label">Área</span>
                <span class="sol-detail-value">{{ $solicitud->area_label }}</span>
            </div>
            @endif

            @if($solicitud->ubicacion)
            <div class="sol-detail-item">
                <span class="sol-detail-label">Ubicación</span>
                <span class="sol-detail-value">{{ $solicitud->ubicacion }}</span>
            </div>
            @endif

            @if($solicitud->salario)
            <div class="sol-detail-item">
                <span class="sol-detail-label">Salario</span>
                <span class="sol-detail-value">{{ $solicitud->salario }}</span>
            </div>
            @endif

            @if($solicitud->enlace_postulacion)
            <div class="sol-detail-item">
                <span class="sol-detail-label">Enlace de postulación</span>
                <a href="{{ $solicitud->enlace_postulacion }}" target="_blank" class="sol-detail-link">
                    <i class="fas fa-external-link-alt"></i> {{ $solicitud->enlace_postulacion }}
                </a>
            </div>
            @endif
        </div>
    </div>

    {{-- DESCRIPCIÓN --}}
    @if($solicitud->descripcion)
    <div class="msg-detail-card">
        <div class="msg-section-label">
            <i class="fas fa-align-left"></i> Descripción
        </div>
        <div class="msg-body-text">
            {!! nl2br(e($solicitud->descripcion)) !!}
        </div>
    </div>
    @endif

    {{-- ACCIONES: APROBAR / RECHAZAR --}}
    <div class="msg-detail-card">
        <div class="msg-section-label">
            <i class="fas fa-gavel"></i> Acciones
        </div>

        <div class="sol-actions-row">
            @if(!$solicitud->activo)
            <form action="{{ route('admin.solicitudes.aprobar', $solicitud) }}" method="POST" id="form-aprobar">
                @csrf
                @method('PATCH')
                <button type="submit" class="sol-btn sol-btn--aprobar">
                    <i class="fas fa-check-circle"></i> Aprobar y publicar
                </button>
            </form>
            @else
            <span class="sol-status-published">
                <i class="fas fa-check-circle"></i> Ya publicada
            </span>
            @endif

            <form action="{{ route('admin.solicitudes.rechazar', $solicitud) }}" method="POST" id="form-rechazar">
                @csrf
                @method('DELETE')
                <button type="submit" class="sol-btn sol-btn--rechazar">
                    <i class="fas fa-times-circle"></i> Rechazar y eliminar
                </button>
            </form>
        </div>
    </div>

    <div class="msg-back-row">
        <a href="{{ route('admin.solicitudes.index') }}" class="msg-back-link">
            <i class="fas fa-arrow-left"></i> Volver a solicitudes
        </a>
    </div>

</div>

@endsection

@push('scripts')
<script>
document.getElementById('form-aprobar')?.addEventListener('submit', function(e){
    e.preventDefault();
    const form = this;
    Swal.fire({
        title: '¿Aprobar solicitud?',
        text: "La oferta se publicará en el sitio web y será visible para todos los visitantes.",
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#1a9d75',
        cancelButtonColor: '#999',
        confirmButtonText: 'Sí, aprobar',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if(result.isConfirmed) form.submit();
    });
});

document.getElementById('form-rechazar')?.addEventListener('submit', function(e){
    e.preventDefault();
    const form = this;
    Swal.fire({
        title: '¿Rechazar solicitud?',
        text: "Se eliminará la solicitud de oferta. Esta acción no se puede deshacer.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#c1121f',
        cancelButtonColor: '#999',
        confirmButtonText: 'Sí, rechazar',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if(result.isConfirmed) form.submit();
    });
});
</script>
@endpush
