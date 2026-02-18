@extends('layouts.admin')

@section('title', 'Detalle del Colegiado')
@section('page-title', 'Detalle del Colegiado')

@section('content')

<div class="admin-container">

    {{-- Mensajes de éxito --}}
    @if(session('success'))
        <div class="alert alert-success">
            <i class="fas fa-check-circle"></i>
            {{ session('success') }}

            @if(session('codigo_generado'))
                <div class="alert-code-block">
                    <strong>Código de verificación generado:</strong>
                    <code>{{ session('codigo_generado') }}</code>
                    <br>
                    <strong>URL de verificación:</strong><br>
                    <a href="{{ session('url_verificacion') }}" target="_blank">
                        {{ session('url_verificacion') }}
                    </a>
                </div>
            @endif
        </div>
    @endif

    {{-- Breadcrumb --}}
    <div class="breadcrumb">
        <a href="{{ route('admin.colegiados.index') }}">
            <i class="fas fa-id-card"></i> Colegiados
        </a>
        <span>/</span>
        <span>{{ $colegiado->codigo_cpap }}</span>
    </div>

    {{-- Header con acciones --}}
    <div class="page-header">
        <div>
            <h1 class="page-title">{{ $colegiado->nombre_completo }}</h1>
            <p class="page-subtitle">{{ $colegiado->codigo_cpap }} &mdash; {{ $colegiado->dni }}</p>
        </div>
        <div class="d-flex gap-3">
            <a href="{{ route('admin.colegiados.edit', $colegiado) }}" class="btn btn-warning">
                <i class="fas fa-edit"></i>
                Editar
            </a>
            <a href="{{ route('admin.habilitaciones.create', $colegiado) }}" class="btn btn-primary">
                <i class="fas fa-file-upload"></i>
                Subir Habilitación
            </a>
        </div>
    </div>

    {{-- Grid de tarjetas --}}
    <div class="detail-grid">

        {{-- Información Personal --}}
        <div class="detail-card">
            <div class="card-header">
                <h3><i class="fas fa-user"></i> Información Personal</h3>
            </div>
            <div class="card-body">
                @if($colegiado->foto)
                    <div class="profile-photo">
                        <img src="{{ asset($colegiado->foto) }}" alt="{{ $colegiado->nombre_completo }}">
                    </div>
                @endif

                <div class="info-group">
                    <label>Nombres completos</label>
                    <p>{{ $colegiado->nombres }} {{ $colegiado->apellidos }}</p>
                </div>

                <div class="info-group">
                    <label>DNI</label>
                    <p>{{ $colegiado->dni }}</p>
                </div>

                @if($colegiado->email)
                    <div class="info-group">
                        <label>Email</label>
                        <p><a href="mailto:{{ $colegiado->email }}">{{ $colegiado->email }}</a></p>
                    </div>
                @endif

                @if($colegiado->telefono)
                    <div class="info-group">
                        <label>Teléfono</label>
                        <p><a href="tel:{{ $colegiado->telefono }}">{{ $colegiado->telefono }}</a></p>
                    </div>
                @endif

                @if($colegiado->fecha_nacimiento)
                    <div class="info-group">
                        <label>Fecha de Nacimiento</label>
                        <p>{{ $colegiado->fecha_nacimiento->format('d/m/Y') }}</p>
                    </div>
                @endif

                <div class="info-group">
                    <label>Estado</label>
                    <p>
                        @if($colegiado->estado === 'activo')
                            <span class="badge badge-success">
                                <i class="fas fa-check-circle"></i> ACTIVO
                            </span>
                        @else
                            <span class="badge badge-danger">
                                <i class="fas fa-times-circle"></i> INACTIVO
                            </span>
                        @endif
                    </p>
                </div>

                <div class="info-group">
                    <label>Fecha de Colegiatura</label>
                    <p>{{ $colegiado->fecha_colegiatura->format('d/m/Y') }}</p>
                </div>
            </div>
        </div>

        {{-- Información Profesional --}}
        <div class="detail-card">
            <div class="card-header">
                <h3><i class="fas fa-briefcase"></i> Información Profesional</h3>
            </div>
            <div class="card-body">
                @if($colegiado->especialidad)
                    <div class="info-group">
                        <label>Especialidad</label>
                        <p>{{ $colegiado->especialidad }}</p>
                    </div>
                @endif

                @if($colegiado->universidad)
                    <div class="info-group">
                        <label>Universidad</label>
                        <p>{{ $colegiado->universidad }}</p>
                    </div>
                @endif

                @if($colegiado->anio_graduacion)
                    <div class="info-group">
                        <label>Año de Graduación</label>
                        <p>{{ $colegiado->anio_graduacion }}</p>
                    </div>
                @endif

                @if($colegiado->descripcion)
                    <div class="info-group">
                        <label>Descripción Profesional</label>
                        <p>{{ $colegiado->descripcion }}</p>
                    </div>
                @endif

                @if($colegiado->cv_path)
                    <div class="info-group">
                        <label>Curriculum Vitae</label>
                        <p>
                            <a href="{{ Storage::url($colegiado->cv_path) }}" target="_blank" class="btn-link">
                                <i class="fas fa-file-pdf text-danger"></i>
                                Descargar CV
                            </a>
                        </p>
                    </div>
                @endif
            </div>
        </div>

    </div>

    {{-- Sección de Habilitaciones --}}
    <div class="detail-card detail-card-full">
        <div class="card-header">
            <h3><i class="fas fa-certificate"></i> Documento de Habilitación</h3>
            <a href="{{ route('admin.habilitaciones.create', $colegiado) }}" class="btn btn-sm btn-primary">
                <i class="fas fa-plus"></i>
                Nueva Habilitación
            </a>
        </div>
        <div class="card-body">
            @if($colegiado->habilitaciones->count() > 0)
                <div class="habilitaciones-list">
                    @foreach($colegiado->habilitaciones as $habilitacion)
                        <div class="habilitacion-item {{ $habilitacion->activo ? '' : 'inactive' }}">
                            <div class="habilitacion-header">
                                <h4>
                                    @if($habilitacion->activo)
                                        <span class="badge badge-success"><i class="fas fa-check-circle"></i> ACTIVO</span>
                                    @else
                                        <span class="badge badge-secondary"><i class="fas fa-ban"></i> REVOCADO</span>
                                    @endif
                                </h4>
                                <span class="habilitacion-date">
                                    <i class="fas fa-calendar"></i>
                                    {{ $habilitacion->fecha_subida->format('d/m/Y H:i') }}
                                </span>
                            </div>

                            <div class="habilitacion-code">
                                <strong>Código de Verificación:</strong>
                                <code>{{ $habilitacion->codigo_verificacion }}</code>
                                <button onclick="navigator.clipboard.writeText('{{ $habilitacion->codigo_verificacion }}')" class="btn-copy" title="Copiar código">
                                    <i class="fas fa-copy"></i>
                                </button>
                            </div>

                            <div class="habilitacion-url">
                                <strong>URL de Verificación:</strong>
                                <a href="{{ $habilitacion->url_corta }}" target="_blank">{{ $habilitacion->url_corta }}</a>
                                <button onclick="navigator.clipboard.writeText('{{ $habilitacion->url_corta }}')" class="btn-copy" title="Copiar URL">
                                    <i class="fas fa-copy"></i>
                                </button>
                            </div>

                            <div class="habilitacion-qr">
                                <strong>Código QR:</strong>
                                <img src="{{ asset($habilitacion->qr_path) }}" alt="QR Code">
                            </div>

                            <div class="habilitacion-actions">
                                <a href="{{ route('admin.habilitaciones.descargar', $habilitacion) }}"
                                   class="btn btn-sm btn-info"
                                   target="_blank"
                                   rel="noopener">
                                    <i class="fas fa-file-download"></i>
                                    Documento
                                </a>
                                <a href="{{ route('admin.habilitaciones.descargar-qr', $habilitacion) }}" class="btn btn-sm btn-secondary">
                                    <i class="fas fa-qrcode"></i>
                                    QR
                                </a>

                                @if($habilitacion->activo)
                                    <form action="{{ route('admin.habilitaciones.revocar', $habilitacion) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="btn btn-sm btn-warning" onclick="return confirm('¿Revocar este documento?')">
                                            <i class="fas fa-ban"></i>
                                            Revocar
                                        </button>
                                    </form>
                                @else
                                    <form action="{{ route('admin.habilitaciones.reactivar', $habilitacion) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="btn btn-sm btn-success">
                                            <i class="fas fa-check"></i>
                                            Reactivar
                                        </button>
                                    </form>
                                @endif

                                <form action="{{ route('admin.habilitaciones.destroy', $habilitacion) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Eliminar permanentemente?')">
                                        <i class="fas fa-trash"></i>
                                        Eliminar
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="empty-state-small">
                    <i class="fas fa-certificate"></i>
                    <p>No hay documentos de habilitación cargados</p>
                    <a href="{{ route('admin.habilitaciones.create', $colegiado) }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i>
                        Subir Primer Documento
                    </a>
                </div>
            @endif
        </div>
    </div>

</div>

@endsection
