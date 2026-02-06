@extends('layouts.app')

@section('title', $noticia->titulo)

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <h1 class="mb-3">{{ $noticia->titulo }}</h1>

            @if($noticia->imagen)
                <img
                    src="{{ asset('storage/' . $noticia->imagen) }}"
                    class="img-fluid rounded mb-4"
                    alt="{{ $noticia->titulo }}"
                >
            @endif

            <div class="text-muted mb-3">
                Publicado el {{ $noticia->created_at->format('d/m/Y') }}
            </div>

            <div class="contenido">
                {!! $noticia->contenido !!}
            </div>

            <a href="{{ route('noticias.index') }}"
               class="btn btn-secondary mt-4">
                ← Volver a noticias
            </a>

        </div>
    </div>
</div>
@endsection
