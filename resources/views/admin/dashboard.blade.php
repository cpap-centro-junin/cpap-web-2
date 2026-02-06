@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')

<div class="dashboard-header">
    <h1>Bienvenido, {{ auth()->user()->name }}</h1>
    <p>Panel administrativo del Colegio de Antropólogos del Perú – Región Centro</p>
</div>

<div class="cards">
    <a href="{{ route('admin.directivos') }}" class="card"><span>👥</span> Directivos</a>
    <a href="{{ route('admin.invitaciones') }}" class="card"><span>✉️</span> Invitaciones</a>
    <a href="{{ route('admin.usuarios') }}" class="card"><span>🧑‍💼</span> Usuarios</a>
    <a href="{{ route('admin.noticias.index') }}" class="card"><span>📰</span> Noticias</a>
    <a href="{{ route('admin.eventos') }}" class="card"><span>📅</span> Eventos</a>
    <a href="{{ route('admin.documentos') }}" class="card"><span>📄</span> Documentos</a>
</div>


@endsection
