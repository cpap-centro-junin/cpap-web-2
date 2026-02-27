@extends('layouts.admin')

@section('title', 'Personalizar Diseño')
@section('page-title', 'Personalización de Colores y Diseño')

@vite(['resources/css/admin/diseno.css', 'resources/js/admin/diseno.js'])

@section('content')

<div style="margin-bottom:24px;">
    <a href="{{ route('admin.dashboard') }}" class="secondary-btn">
        <i class="fas fa-arrow-left"></i> Volver al Dashboard
    </a>
</div>

@if(session('success'))
<div class="diseno-success-alert">
    <i class="fas fa-check-circle"></i>
    {{ session('success') }}
</div>
@endif

<!-- Header con descripción -->
<div class="diseno-header">
    <div class="diseno-header-content">
        <div class="diseno-header-icon-wrapper">
            <i class="fas fa-palette" style="font-size:32px;"></i>
        </div>
        <div>
            <h1>Personalizar Diseño del Sitio</h1>
            <p>Configura los colores y estilos generales que se aplicarán en todo el sitio público</p>
        </div>
    </div>
    
    <div class="diseno-features">
        <div class="diseno-feature-card">
            <i class="fas fa-paint-brush"></i>
            <strong>Colores Principales</strong>
            <span>Granate y dorado institucional (botones y enlaces)</span>
        </div>
        <div class="diseno-feature-card">
            <i class="fas fa-palette"></i>
            <strong>Fondos y Secciones</strong>
            <span>Página, menú superior y pie de página</span>
        </div>
        <div class="diseno-feature-card">
            <i class="fas fa-undo"></i>
            <strong>Restaurar Predeterminado</strong>
            <span>Volver a los colores originales del CPAP</span>
        </div>
    </div>
</div>

<form action="{{ route('admin.diseno.update') }}" method="POST" id="disenoForm">
    @csrf
    @method('PUT')

    <!-- SECCIÓN 1: COLORES PRINCIPALES -->
    <div class="section-card">
        <div class="section-header">
            <div class="section-icon">
                <i class="fas fa-swatchbook"></i>
            </div>
            <div>
                <h2 style="font-size:22px;font-weight:700;margin:0;color:var(--dark);">Colores Principales</h2>
                <p style="font-size:14px;color:var(--medium-gray);margin:4px 0 0;">Colores institucionales del CPAP (botones, enlaces y elementos destacados)</p>
            </div>
        </div>

        <div class="color-group">
            <div class="color-item">
                <label class="color-label">🎨 Color Primario</label>
                <div class="color-input-wrapper">
                    <input type="color" name="color_primary" id="color_primary" value="{{ old('color_primary', $config->color_primary) }}" class="color-preview" required>
                    <span class="color-code" id="code_primary">{{ $config->color_primary }}</span>
                </div>
                <p class="color-description">Color granate principal del sitio</p>
            </div>

            <div class="color-item">
                <label class="color-label">🌑 Primario Oscuro</label>
                <div class="color-input-wrapper">
                    <input type="color" name="color_primary_dark" id="color_primary_dark" value="{{ old('color_primary_dark', $config->color_primary_dark) }}" class="color-preview" required>
                    <span class="color-code" id="code_primary_dark">{{ $config->color_primary_dark }}</span>
                </div>
                <p class="color-description">Para hover y variaciones oscuras</p>
            </div>

            <div class="color-item">
                <label class="color-label">🌟 Primario Claro</label>
                <div class="color-input-wrapper">
                    <input type="color" name="color_primary_light" id="color_primary_light" value="{{ old('color_primary_light', $config->color_primary_light) }}" class="color-preview" required>
                    <span class="color-code" id="code_primary_light">{{ $config->color_primary_light }}</span>
                </div>
                <p class="color-description">Para fondos sutiles y highlights</p>
            </div>

            <div class="color-item">
                <label class="color-label">✨ Color Secundario</label>
                <div class="color-input-wrapper">
                    <input type="color" name="color_secondary" id="color_secondary" value="{{ old('color_secondary', $config->color_secondary) }}" class="color-preview" required>
                    <span class="color-code" id="code_secondary">{{ $config->color_secondary }}</span>
                </div>
                <p class="color-description">Dorado complementario</p>
            </div>

            <div class="color-item">
                <label class="color-label">💫 Color de Acento</label>
                <div class="color-input-wrapper">
                    <input type="color" name="color_accent" id="color_accent" value="{{ old('color_accent', $config->color_accent) }}" class="color-preview" required>
                    <span class="color-code" id="code_accent">{{ $config->color_accent }}</span>
                </div>
                <p class="color-description">Dorado brillante para énfasis</p>
            </div>
        </div>
    </div>

    <!-- SECCIÓN 2: COLORES DE ESTADO -->
    <div class="section-card">
        <div class="section-header">
            <div class="section-icon" style="background:linear-gradient(135deg,#4caf50,#2e7d32);">
                <i class="fas fa-traffic-light"></i>
            </div>
            <div>
                <h2 style="font-size:22px;font-weight:700;margin:0;color:var(--dark);">Mensajes y Notificaciones</h2>
                <p style="font-size:14px;color:var(--medium-gray);margin:4px 0 0;">Colores para mensajes de éxito, advertencias y errores del sistema</p>
            </div>
        </div>

        <div class="color-group">
            <div class="color-item">
                <label class="color-label">✅ Éxito / Success</label>
                <div class="color-input-wrapper">
                    <input type="color" name="color_success" id="color_success" value="{{ old('color_success', $config->color_success) }}" class="color-preview" required>
                    <span class="color-code" id="code_success">{{ $config->color_success }}</span>
                </div>
                <p class="color-description">Verde para mensajes de éxito</p>
            </div>

            <div class="color-item">
                <label class="color-label">⚠️ Advertencia / Warning</label>
                <div class="color-input-wrapper">
                    <input type="color" name="color_warning" id="color_warning" value="{{ old('color_warning', $config->color_warning) }}" class="color-preview" required>
                    <span class="color-code" id="code_warning">{{ $config->color_warning }}</span>
                </div>
                <p class="color-description">Naranja para advertencias</p>
            </div>

            <div class="color-item">
                <label class="color-label">❌ Error / Danger</label>
                <div class="color-input-wrapper">
                    <input type="color" name="color_danger" id="color_danger" value="{{ old('color_danger', $config->color_danger) }}" class="color-preview" required>
                    <span class="color-code" id="code_danger">{{ $config->color_danger }}</span>
                </div>
                <p class="color-description">Rojo para errores</p>
            </div>
        </div>
    </div>

    <!-- SECCIÓN 3: COLORES DE TEXTO -->
    <div class="section-card">
        <div class="section-header">
            <div class="section-icon" style="background:linear-gradient(135deg,#607d8b,#455a64);">
                <i class="fas fa-font"></i>
            </div>
            <div>
                <h2 style="font-size:22px;font-weight:700;margin:0;color:var(--dark);">Textos Generales</h2>
                <p style="font-size:14px;color:var(--medium-gray);margin:4px 0 0;">Colores de los textos principales, subtítulos y descripciones</p>
            </div>
        </div>

        <div class="color-group">
            <div class="color-item">
                <label class="color-label">⚫ Texto Oscuro</label>
                <div class="color-input-wrapper">
                    <input type="color" name="color_dark" id="color_dark" value="{{ old('color_dark', $config->color_dark) }}" class="color-preview" required>
                    <span class="color-code" id="code_dark">{{ $config->color_dark }}</span>
                </div>
                <p class="color-description">Texto principal del sitio</p>
            </div>

            <div class="color-item">
                <label class="color-label">⚪ Texto Gris Medio</label>
                <div class="color-input-wrapper">
                    <input type="color" name="color_medium_gray" id="color_medium_gray" value="{{ old('color_medium_gray', $config->color_medium_gray) }}" class="color-preview" required>
                    <span class="color-code" id="code_medium_gray">{{ $config->color_medium_gray }}</span>
                </div>
                <p class="color-description">Texto secundario y descripciones</p>
            </div>

            <div class="color-item">
                <label class="color-label">◻️ Gris Claro</label>
                <div class="color-input-wrapper">
                    <input type="color" name="color_light_gray" id="color_light_gray" value="{{ old('color_light_gray', $config->color_light_gray) }}" class="color-preview" required>
                    <span class="color-code" id="code_light_gray">{{ $config->color_light_gray }}</span>
                </div>
                <p class="color-description">Fondos sutiles y separadores</p>
            </div>

            <div class="color-item">
                <label class="color-label">⬜ Blanco / Light</label>
                <div class="color-input-wrapper">
                    <input type="color" name="color_light" id="color_light" value="{{ old('color_light', $config->color_light) }}" class="color-preview" required>
                    <span class="color-code" id="code_light">{{ $config->color_light }}</span>
                </div>
                <p class="color-description">Texto sobre fondos oscuros</p>
            </div>
        </div>
    </div>

    <!-- SECCIÓN 4: BACKGROUNDS -->
    <div class="section-card">
        <div class="section-header">
            <div class="section-icon" style="background:linear-gradient(135deg,#2196f3,#1976d2);">
                <i class="fas fa-layer-group"></i>
            </div>
            <div>
                <h2 style="font-size:22px;font-weight:700;margin:0;color:var(--dark);">Fondos de Página</h2>
                <p style="font-size:14px;color:var(--medium-gray);margin:4px 0 0;">Colores de fondo general del sitio y secciones</p>
            </div>
        </div>

        <div class="color-group">
            <div class="color-item">
                <label class="color-label">📄 Fondo General</label>
                <div class="color-input-wrapper">
                    <input type="color" name="bg_body" id="bg_body" value="{{ old('bg_body', $config->bg_body) }}" class="color-preview" required>
                    <span class="color-code" id="code_bg_body">{{ $config->bg_body }}</span>
                </div>
                <p class="color-description">Color de fondo de todo el sitio web</p>
            </div>

            <div class="color-item">
                <label class="color-label">📦 Fondo Alternativo</label>
                <div class="color-input-wrapper">
                    <input type="color" name="bg_section_alt" id="bg_section_alt" value="{{ old('bg_section_alt', $config->bg_section_alt) }}" class="color-preview" required>
                    <span class="color-code" id="code_bg_section_alt">{{ $config->bg_section_alt }}</span>
                </div>
                <p class="color-description">Para secciones intercaladas (ej: noticias, eventos)</p>
            </div>
        </div>
    </div>

    <!-- SECCIÓN 5: FOOTER -->
    <div class="section-card">
        <div class="section-header">
            <div class="section-icon" style="background:linear-gradient(135deg,#424242,#212121);">
                <i class="fas fa-shoe-prints"></i>
            </div>
            <div>
                <h2 style="font-size:22px;font-weight:700;margin:0;color:var(--dark);">Pie de Página</h2>
                <p style="font-size:14px;color:var(--medium-gray);margin:4px 0 0;">Sección inferior del sitio (contacto, redes sociales, información)</p>
            </div>
        </div>

        <div class="color-group">
            <div class="color-item">
                <label class="color-label">🦶 Fondo del Pie de Página</label>
                <div class="color-input-wrapper">
                    <input type="color" name="footer_bg" id="footer_bg" value="{{ old('footer_bg', $config->footer_bg) }}" class="color-preview" required>
                    <span class="color-code" id="code_footer_bg">{{ $config->footer_bg }}</span>
                </div>
                <p class="color-description">Color de fondo del pie de página</p>
            </div>

            <div class="color-item">
                <label class="color-label">📝 Texto del Pie de Página</label>
                <div class="color-input-wrapper">
                    <input type="color" name="footer_text" id="footer_text" value="{{ old('footer_text', $config->footer_text) }}" class="color-preview" required>
                    <span class="color-code" id="code_footer_text">{{ $config->footer_text }}</span>
                </div>
                <p class="color-description">Color de texto en el pie de página</p>
            </div>
        </div>
    </div>

    <!-- SECCIÓN 6: NAVBAR -->
    <div class="section-card">
        <div class="section-header">
            <div class="section-icon" style="background:linear-gradient(135deg,#8B1538,#6A1029);">
                <i class="fas fa-bars"></i>
            </div>
            <div>
                <h2 style="font-size:22px;font-weight:700;margin:0;color:var(--dark);">Menú de Navegación Superior</h2>
                <p style="font-size:14px;color:var(--medium-gray);margin:4px 0 0;">Barra superior con logo y enlaces (Inicio, Colegiatura, Noticias, etc.)</p>
            </div>
        </div>

        <div class="color-group">
            <div class="color-item">
                <label class="color-label">🔝 Fondo del Menú</label>
                <div class="color-input-wrapper">
                    <input type="color" name="navbar_bg" id="navbar_bg" value="{{ old('navbar_bg', $config->navbar_bg) }}" class="color-preview" required>
                    <span class="color-code" id="code_navbar_bg">{{ $config->navbar_bg }}</span>
                </div>
                <p class="color-description">Color de fondo de la barra de navegación superior</p>
            </div>

            <div class="color-item">
                <label class="color-label">📝 Texto de los Enlaces</label>
                <div class="color-input-wrapper">
                    <input type="color" name="navbar_text" id="navbar_text" value="{{ old('navbar_text', $config->navbar_text) }}" class="color-preview" required>
                    <span class="color-code" id="code_navbar_text">{{ $config->navbar_text }}</span>
                </div>
                <p class="color-description">Color de los enlaces del menú (Inicio, Colegiatura, etc.)</p>
            </div>
        </div>
    </div>

    <!-- BARRA DE ACCIONES STICKY -->
    <div class="actions-bar">
        <div>
            <p style="margin:0;font-size:14px;color:var(--medium-gray);">
                <i class="fas fa-info-circle" style="color:var(--primary);"></i>
                Los cambios se aplicarán inmediatamente en el sitio público
            </p>
        </div>
        <div style="display:flex;gap:16px;align-items:center;">
            <button type="button" onclick="confirmarRestaurar()" class="restore-btn">
                <i class="fas fa-undo"></i>
                Restaurar Predeterminados
            </button>
            <button type="submit" class="save-btn">
                <i class="fas fa-save"></i>
                Guardar Cambios
            </button>
        </div>
    </div>

</form>

<!-- Formulario oculto para restaurar -->
<form id="restaurarForm" action="{{ route('admin.diseno.restaurar') }}" method="POST" style="display:none;">
    @csrf
    @method('POST')
</form>

@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endpush
