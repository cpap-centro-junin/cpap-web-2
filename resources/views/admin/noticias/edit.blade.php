@extends('layouts.admin')

@section('content')
<div class="container">
    <h2>✏️ Editar Noticia</h2>

    <form action="{{ route('admin.noticias.update', $noticia) }}"
          method="POST"
          enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Título</label>
            <input type="text"
                   name="titulo"
                   class="form-control"
                   value="{{ $noticia->titulo }}"
                   required>
        </div>

        <div class="mb-3">
            <label>Contenido</label>
            <textarea name="contenido"
                      class="form-control"
                      rows="5"
                      required>{{ $noticia->contenido }}</textarea>
        </div>

        {{-- IMAGEN --}}
        <div class="mb-3">
            <label>Cambiar Imagen</label>
            <input type="file"
                   name="imagen"
                   class="form-control"
                   accept="image/*"
                   onchange="previewImage(event)">
        </div>

        {{-- IMAGEN ACTUAL / PREVIEW --}}
        <div class="mb-3">
            <img id="preview"
                 src="{{ $noticia->imagen ? asset('storage/'.$noticia->imagen) : '' }}"
                 style="max-width: 200px; {{ $noticia->imagen ? '' : 'display:none;' }}"
                 class="rounded border">
        </div>

        <div class="mb-3">
            <label>Estado</label>
            <select name="activo" class="form-select">
                <option value="1" {{ $noticia->activo ? 'selected' : '' }}>Activo</option>
                <option value="0" {{ !$noticia->activo ? 'selected' : '' }}>Inactivo</option>
            </select>
        </div>

        <button class="btn btn-primary">Actualizar</button>
    </form>
</div>

{{-- SCRIPT --}}
<script>
function previewImage(event) {
    const img = document.getElementById('preview');
    img.src = URL.createObjectURL(event.target.files[0]);
    img.style.display = 'block';
}
</script>
@endsection
