@php
    use Illuminate\Support\Str;
@endphp

@extends('layouts.app')

@section('title', 'Noticias')

@section('content')

<header class="noticias-header">
    <h1>📰 Noticias</h1>
</header>

<main class="cards">

    @forelse($noticias as $noticia)
        <article
            class="prog-blur"
            style="--image: url('{{ $noticia->imagen
                ? asset('storage/' . $noticia->imagen)
                : 'https://via.placeholder.com/600x800?text=Sin+Imagen' }}');"
        >
            <div class="text">
                {{ $noticia->titulo }}
                <small>
                    {{ Str::limit(strip_tags($noticia->contenido), 80) }}
                </small>
            </div>
        </article>
    @empty
        <p class="text-center">No hay noticias publicadas.</p>
    @endforelse

</main>

<div class="pagination-wrapper">
    {{ $noticias->links() }}
</div>

@endsection
