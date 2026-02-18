@extends('layouts.admin')

@section('title', 'Subir Documento de Habilitación')
@section('page-title', 'Generar Documento de Habilitación')

@section('content')

<div class="admin-container">

    {{-- Breadcrumb --}}
    <div class="breadcrumb">
        <a href="{{ route('admin.colegiados.index') }}">
            <i class="fas fa-id-card"></i> Colegiados
        </a>
        <span>/</span>
        <a href="{{ route('admin.colegiados.show', $colegiado) }}">
            {{ $colegiado->codigo_cpap }}
        </a>
        <span>/</span>
        <span>Nueva Habilitación</span>
    </div>

    {{-- Banner del colegiado --}}
    <div class="colegiado-banner">
        <div class="colegiado-banner__avatar">
            @if($colegiado->foto)
                <img src="{{ asset($colegiado->foto) }}" alt="{{ $colegiado->nombre_completo }}">
            @else
                <div class="colegiado-banner__avatar-placeholder">
                    {{ strtoupper(substr($colegiado->nombres, 0, 1) . substr($colegiado->apellidos, 0, 1)) }}
                </div>
            @endif
        </div>
        <div class="colegiado-banner__info">
            <h2>{{ $colegiado->nombre_completo }}</h2>
            <p>{{ $colegiado->codigo_cpap }}{{ $colegiado->especialidad ? ' — ' . $colegiado->especialidad : '' }}</p>
            <p>
                @if($colegiado->estado === 'activo')
                    <span class="badge badge-success"><i class="fas fa-check-circle"></i> ACTIVO</span>
                @else
                    <span class="badge badge-danger"><i class="fas fa-times-circle"></i> INACTIVO</span>
                @endif
            </p>
        </div>
    </div>

    {{-- Advertencia: ya existe habilitación --}}
    @if($habilitacionActual)
        <div class="alert alert-warning">
            <i class="fas fa-exclamation-triangle"></i>
            <div>
                <strong>Este colegiado ya tiene un documento de habilitación.</strong>
                Al subir uno nuevo, el anterior será <strong>reemplazado y eliminado permanentemente</strong>
                (archivos + QR + código anterior). El colegiado conservará solo el nuevo documento.
                <div style="margin-top: 6px; font-size: 13px; opacity: 0.9;">
                    Código actual: <code>{{ $habilitacionActual->codigo_verificacion }}</code>
                </div>
            </div>
        </div>
    @endif

    {{-- Formulario de Upload --}}
    <div class="form-card">
        <form action="{{ route('admin.habilitaciones.store', $colegiado) }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-header">
                <h2><i class="fas fa-file-upload"></i> Subir Documento de Habilitación</h2>
                <p>Al subir el documento, se generará automáticamente un código QR único para verificación pública.</p>
            </div>

            <div class="form-section">
                <label for="documento" class="upload-area">
                    <i class="fas fa-file-pdf upload-icon"></i>
                    <h3>Selecciona el documento PDF</h3>
                    <p>El sistema generará automáticamente:</p>
                    <ul>
                        <li><i class="fas fa-check"></i> Código único de verificación (UUID)</li>
                        <li><i class="fas fa-check"></i> Código QR para escanear</li>
                        <li><i class="fas fa-check"></i> URL corta de verificación pública</li>
                    </ul>

                    <span class="btn btn-primary">
                        <i class="fas fa-cloud-upload-alt"></i>
                        Seleccionar Documento PDF
                    </span>

                    <p class="file-selected-name" id="nombreArchivo"></p>
                    <small class="form-text">Formato: PDF. Tamaño máximo: 10MB.</small>

                    <input
                        type="file"
                        name="documento"
                        id="documento"
                        class="file-input-hidden @error('documento') is-invalid @enderror"
                        accept=".pdf"
                        required
                    >
                </label>
                @error('documento')
                    <div class="invalid-feedback" style="display: block; margin-top: 8px;">{{ $message }}</div>
                @enderror
            </div>

            <div class="alert alert-info">
                <i class="fas fa-info-circle"></i>
                <div>
                    <strong>¿Qué sucederá después?</strong>
                    <ul>
                        <li>Se generará un código único irrepetible (HC-xxxxxxxx-xxxx-xxxx-...)</li>
                        <li>Se creará un QR Code apuntando a la URL de verificación pública</li>
                        <li><strong>El QR y código serán embebidos dentro del PDF</strong></li>
                        <li>El colegiado pasará automáticamente a estado <strong>ACTIVO</strong></li>
                        <li>El público podrá verificar la autenticidad escaneando el QR del documento</li>
                    </ul>
                </div>
            </div>

            {{-- Botones --}}
            <div class="form-footer">
                <a href="{{ route('admin.colegiados.show', $colegiado) }}" class="btn btn-secondary">
                    <i class="fas fa-times"></i>
                    Cancelar
                </a>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-magic"></i>
                    Generar Habilitación con QR
                </button>
            </div>
        </form>
    </div>

</div>

@push('scripts')
<script>
document.getElementById('documento').addEventListener('change', function () {
    const display = document.getElementById('nombreArchivo');
    display.textContent = this.files.length ? this.files[0].name : '';
});
</script>
@endpush

@endsection
