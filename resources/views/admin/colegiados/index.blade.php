@extends('layouts.admin')

@section('title', 'Colegiados')
@section('page-title', 'Gestión de Colegiados')

@section('content')

<div class="admin-container">

    {{-- Mensajes de éxito --}}
    @if(session('success'))
        <div class="alert alert-success">
            <i class="fas fa-check-circle"></i>
            {{ session('success') }}
        </div>
    @endif

    {{-- Header con botón crear --}}
    <div class="page-header">
        <div>
            <h1 class="page-title">Colegiados CPAP</h1>
            <p class="page-subtitle">Gestiona los miembros colegiados del CPAP Región Centro</p>
        </div>
        <a href="{{ route('admin.colegiados.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i>
            Nuevo Colegiado
        </a>
    </div>

    {{-- Filtros y búsqueda --}}
    <div class="filters-card">
        <form action="{{ route('admin.colegiados.index') }}" method="GET" class="filters-form">
            <div class="filter-group">
                <input
                    type="text"
                    name="buscar"
                    class="form-control"
                    placeholder="Buscar por DNI, código o nombre..."
                    value="{{ request('buscar') }}"
                >
            </div>
            <div class="filter-group">
                <select name="estado" class="form-control">
                    <option value="">Todos los estados</option>
                    <option value="activo" {{ request('estado') == 'activo' ? 'selected' : '' }}>Activos</option>
                    <option value="inactivo" {{ request('estado') == 'inactivo' ? 'selected' : '' }}>Inactivos</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-search"></i>
                Buscar
            </button>
            @if(request()->anyFilled(['buscar', 'estado']))
                <a href="{{ route('admin.colegiados.index') }}" class="btn btn-secondary">
                    <i class="fas fa-times"></i>
                    Limpiar
                </a>
            @endif
        </form>
    </div>

    {{-- Tabla de colegiados --}}
    <div class="table-card">
        @if($colegiados->count() > 0)
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Código CPAP</th>
                            <th>DNI</th>
                            <th>Nombre Completo</th>
                            <th>Especialidad</th>
                            <th>Estado</th>
                            <th>Fecha Colegiatura</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($colegiados as $colegiado)
                            <tr>
                                <td>
                                    <strong class="text-primary">{{ $colegiado->codigo_cpap }}</strong>
                                </td>
                                <td>{{ $colegiado->dni }}</td>
                                <td>
                                    <div class="user-cell">
                                        @if($colegiado->foto)
                                            <img src="{{ asset($colegiado->foto) }}" alt="{{ $colegiado->nombre_completo }}" class="user-avatar-small">
                                        @else
                                            <div class="user-avatar-small">
                                                {{ strtoupper(substr($colegiado->nombres, 0, 1) . substr($colegiado->apellidos, 0, 1)) }}
                                            </div>
                                        @endif
                                        <span>{{ $colegiado->nombre_completo }}</span>
                                    </div>
                                </td>
                                <td>
                                    <span class="text-muted">{{ $colegiado->especialidad ?? 'No especificada' }}</span>
                                </td>
                                <td>
                                    @if($colegiado->estado === 'activo')
                                        <span class="badge badge-success">
                                            <i class="fas fa-check-circle"></i> ACTIVO
                                        </span>
                                    @else
                                        <span class="badge badge-danger">
                                            <i class="fas fa-times-circle"></i> INACTIVO
                                        </span>
                                    @endif
                                </td>
                                <td>{{ $colegiado->fecha_colegiatura->format('d/m/Y') }}</td>
                                <td>
                                    <div class="action-buttons">
                                        <a href="{{ route('admin.colegiados.show', $colegiado) }}" class="btn-icon btn-info" title="Ver detalle">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('admin.colegiados.edit', $colegiado) }}" class="btn-icon btn-warning" title="Editar">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.colegiados.toggle-estado', $colegiado) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="btn-icon {{ $colegiado->estado === 'activo' ? 'btn-secondary' : 'btn-success' }}" title="Cambiar estado">
                                                <i class="fas fa-toggle-{{ $colegiado->estado === 'activo' ? 'off' : 'on' }}"></i>
                                            </button>
                                        </form>
                                        <form action="{{ route('admin.colegiados.destroy', $colegiado) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Estás seguro de eliminar este colegiado?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn-icon btn-danger" title="Eliminar">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- Paginación --}}
            <div class="pagination-wrapper">
                {{ $colegiados->links() }}
            </div>
        @else
            <div class="empty-state">
                <i class="fas fa-users"></i>
                <h3>No se encontraron colegiados</h3>
                <p>{{ request('buscar') || request('estado') ? 'Intenta con otros filtros de búsqueda.' : 'Comienza agregando el primer colegiado.' }}</p>
                @if(!request()->anyFilled(['buscar', 'estado']))
                    <a href="{{ route('admin.colegiados.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i>
                        Agregar Primer Colegiado
                    </a>
                @endif
            </div>
        @endif
    </div>

</div>

@endsection
