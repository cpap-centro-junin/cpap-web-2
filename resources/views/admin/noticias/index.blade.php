@extends('layouts.admin')



@section('content')
<div class="container">
    <h1>Noticias</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('admin.noticias.create') }}" class="btn btn-primary mb-3">
        + Nueva Noticia
    </a>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Título</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse($noticias as $noticia)
                <tr>
                    <td>{{ $noticia->titulo }}</td>
                    <td>
                        <span class="badge {{ $noticia->activo ? 'bg-success' : 'bg-secondary' }}">
                            {{ $noticia->activo ? 'Publicado' : 'Oculto' }}
                        </span>
                    </td>
                    <td>
                        <a href="{{ route('admin.noticias.edit', $noticia) }}"
                           class="btn btn-sm btn-warning">
                            Editar
                        </a>

                        <form action="{{ route('admin.noticias.destroy', $noticia) }}"
                              method="POST"
                              class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger"
                                    onclick="return confirm('¿Eliminar esta noticia?')">
                                Eliminar
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3">No hay noticias registradas</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection

