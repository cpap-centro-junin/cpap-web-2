@extends('layouts.app')

@section('title', 'Verificación Fallida')

{{-- Styles en resources/css/pages/verificacion.css --}}

@section('content')

<section class="verificacion-section">
    <div class="container">

        {{-- Estado de Verificación Fallida --}}
        <div class="verificacion-header">
            <div class="verificacion-icon error">
                <i class="fas fa-times-circle"></i>
            </div>
            <h1>Verificación Fallida</h1>
            <p class="subtitle">{{ $mensaje }}</p>
        </div>

        {{-- Card de Error --}}
        <div class="verificacion-card error-card">
            <div class="verificacion-body">
                <div class="error-content">
                    <i class="fas fa-exclamation-triangle error-icon"></i>

                    <h2>No se pudo verificar el documento</h2>

                    <div class="error-details">
                        <p><strong>Código ingresado:</strong></p>
                        <code>{{ $codigo }}</code>
                    </div>

                    @if(isset($habilitacion))
                        <div class="revocado-notice">
                            <i class="fas fa-ban"></i>
                            <div>
                                <h3>Documento Revocado</h3>
                                <p>Este documento de habilitación ha sido anulado o revocado por la institución. Ya no tiene validez oficial.</p>
                            </div>
                        </div>
                    @else
                        <div class="invalido-notice">
                            <h3>Posibles razones:</h3>
                            <ul>
                                <li><i class="fas fa-times"></i> El código ingresado no existe en nuestra base de datos</li>
                                <li><i class="fas fa-times"></i> El código puede estar incompleto o mal escrito</li>
                                <li><i class="fas fa-times"></i> El documento puede haber sido eliminado</li>
                                <li><i class="fas fa-times"></i> Podría tratarse de un documento fraudulento</li>
                            </ul>
                        </div>
                    @endif

                    <div class="acciones">
                        <a href="javascript:history.back()" class="btn btn-secondary btn-lg">
                            <i class="fas fa-arrow-left"></i>
                            Volver
                        </a>
                        <a href="{{ url('/') }}" class="btn btn-primary btn-lg">
                            <i class="fas fa-home"></i>
                            Ir al Inicio
                        </a>
                    </div>
                </div>
            </div>
        </div>

        {{-- Información de Ayuda --}}
        <div class="help-card">
            <div class="help-icon">
                <i class="fas fa-question-circle"></i>
            </div>
            <div class="help-text">
                <h3>¿Necesitas ayuda?</h3>
                <p>Si crees que este es un error o tienes dudas sobre la autenticidad de un documento, por favor contacta directamente con el:</p>
                <div class="contact-box">
                    <strong>Colegio Profesional de Antropólogos del Perú - Región Centro</strong><br>
                    <i class="fas fa-phone"></i> <a href="tel:+51987654321">+51 987 654 321</a><br>
                    <i class="fas fa-envelope"></i> <a href="mailto:info@cpapcentro.org.pe">info@cpapcentro.org.pe</a>
                </div>
            </div>
        </div>

    </div>
</section>


@endsection
