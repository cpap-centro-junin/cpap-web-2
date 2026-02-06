@extends('layouts.admin')

@section('content')
<div class="container">
    <h2>📰 Crear Noticia</h2>

    <form action="{{ route('admin.noticias.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label>Título</label>
            <input type="text" name="titulo" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Contenido</label>
            <textarea name="contenido" class="form-control" rows="5" required></textarea>
        </div>

        {{-- IMAGEN --}}
        <div class="mb-3">
            <label>Imagen</label>
            <input type="file"
                   name="imagen"
                   class="form-control"
                   accept="image/*"
                   onchange="previewImage(event)">
        </div>

        {{-- PREVIEW --}}
        <div class="mb-3">
            <img id="preview"
                 style="max-width: 200px; display: none;"
                 class="rounded border">
        </div>

        <div class="mb-3">
            <label>Estado</label>
            <select name="activo" class="form-select">
                <option value="1">Activo</option>
                <option value="0">Inactivo</option>
            </select>
        </div>

        <button class="btn btn-success">Guardar</button>
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