@extends('layouts.admin')

@section('title', 'Nuevo Colegiado')
@section('page-title', 'Registrar Nuevo Colegiado')

@section('content')

<div class="admin-container">

    {{-- Breadcrumb --}}
    <div class="breadcrumb">
        <a href="{{ route('admin.colegiados.index') }}">
            <i class="fas fa-id-card"></i> Colegiados
        </a>
        <span>/</span>
        <span>Nuevo</span>
    </div>

    {{-- Formulario --}}
    <div class="form-card">
        <form action="{{ route('admin.colegiados.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-header">
                <h2><i class="fas fa-user-plus"></i> Datos del Colegiado</h2>
            </div>

            {{-- Identificación --}}
            <div class="form-section">
                <h3 class="section-title">Identificación</h3>
                <div class="form-row">
                    <div class="form-group">
                        <label for="codigo_cpap">Código CPAP <span class="required">*</span></label>
                        <input type="text" class="form-control @error('codigo_cpap') is-invalid @enderror"
                               id="codigo_cpap" name="codigo_cpap" value="{{ old('codigo_cpap') }}"
                               placeholder="CPAP-2026-00001" required>
                        @error('codigo_cpap')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="dni">DNI <span class="required">*</span></label>
                        <input type="text" class="form-control @error('dni') is-invalid @enderror"
                               id="dni" name="dni" value="{{ old('dni') }}"
                               placeholder="12345678" maxlength="8" required>
                        @error('dni')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            {{-- Información Personal --}}
            <div class="form-section">
                <h3 class="section-title">Información Personal</h3>
                <div class="form-row">
                    <div class="form-group">
                        <label for="nombres">Nombres <span class="required">*</span></label>
                        <input type="text" class="form-control @error('nombres') is-invalid @enderror"
                               id="nombres" name="nombres" value="{{ old('nombres') }}" required>
                        @error('nombres')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="apellidos">Apellidos <span class="required">*</span></label>
                        <input type="text" class="form-control @error('apellidos') is-invalid @enderror"
                               id="apellidos" name="apellidos" value="{{ old('apellidos') }}" required>
                        @error('apellidos')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror"
                               id="email" name="email" value="{{ old('email') }}">
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="telefono">Teléfono</label>
                        <input type="text" class="form-control @error('telefono') is-invalid @enderror"
                               id="telefono" name="telefono" value="{{ old('telefono') }}"
                               placeholder="987654321">
                        @error('telefono')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label for="fecha_nacimiento">Fecha de Nacimiento</label>
                        <input type="date" class="form-control @error('fecha_nacimiento') is-invalid @enderror"
                               id="fecha_nacimiento" name="fecha_nacimiento" value="{{ old('fecha_nacimiento') }}">
                        @error('fecha_nacimiento')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="foto">Foto de Perfil</label>
                        <input type="file" class="form-control @error('foto') is-invalid @enderror"
                               id="foto" name="foto" accept="image/*">
                        <small class="form-text">JPG, JPEG o PNG. Máximo 2MB.</small>
                        @error('foto')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            {{-- Información Profesional --}}
            <div class="form-section">
                <h3 class="section-title">Información Profesional</h3>
                <div class="form-row">
                    <div class="form-group">
                        <label for="especialidad">Especialidad</label>
                        <input type="text" class="form-control @error('especialidad') is-invalid @enderror"
                               id="especialidad" name="especialidad" value="{{ old('especialidad') }}"
                               placeholder="Antropología Social">
                        @error('especialidad')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="universidad">Universidad</label>
                        <input type="text" class="form-control @error('universidad') is-invalid @enderror"
                               id="universidad" name="universidad" value="{{ old('universidad') }}"
                               placeholder="Universidad Nacional Mayor de San Marcos">
                        @error('universidad')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label for="anio_graduacion">Año de Graduación</label>
                        <input type="number" class="form-control @error('anio_graduacion') is-invalid @enderror"
                               id="anio_graduacion" name="anio_graduacion" value="{{ old('anio_graduacion') }}"
                               min="1950" max="{{ date('Y') }}" placeholder="{{ date('Y') }}">
                        @error('anio_graduacion')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="cv">Curriculum Vitae (PDF)</label>
                        <input type="file" class="form-control @error('cv') is-invalid @enderror"
                               id="cv" name="cv" accept=".pdf">
                        <small class="form-text">Archivo PDF. Máximo 5MB.</small>
                        @error('cv')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-group">
                    <label for="descripcion">Descripción Profesional</label>
                    <textarea class="form-control @error('descripcion') is-invalid @enderror"
                              id="descripcion" name="descripcion" rows="4"
                              placeholder="Breve descripción de la experiencia y especialización del colegiado...">{{ old('descripcion') }}</textarea>
                    @error('descripcion')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            {{-- Estado y Colegiatura --}}
            <div class="form-section">
                <h3 class="section-title">Estado y Colegiatura</h3>
                <div class="form-row">
                    <div class="form-group">
                        <label for="estado">Estado <span class="required">*</span></label>
                        <select class="form-control @error('estado') is-invalid @enderror"
                                id="estado" name="estado" required>
                            <option value="inactivo" {{ old('estado') == 'inactivo' ? 'selected' : '' }}>Inactivo</option>
                            <option value="activo" {{ old('estado') == 'activo' ? 'selected' : '' }}>Activo</option>
                        </select>
                        @error('estado')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="fecha_colegiatura">Fecha de Colegiatura <span class="required">*</span></label>
                        <input type="date" class="form-control @error('fecha_colegiatura') is-invalid @enderror"
                               id="fecha_colegiatura" name="fecha_colegiatura" value="{{ old('fecha_colegiatura') }}" required>
                        @error('fecha_colegiatura')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            {{-- Botones --}}
            <div class="form-footer">
                <a href="{{ route('admin.colegiados.index') }}" class="btn btn-secondary">
                    <i class="fas fa-times"></i>
                    Cancelar
                </a>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i>
                    Guardar Colegiado
                </button>
            </div>
        </form>
    </div>

</div>

@endsection
