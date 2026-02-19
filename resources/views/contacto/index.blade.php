@extends('layouts.app')

@section('title', 'Contacto | CPAP Región Centro')

@section('content')

{{-- PAGE HEADER --}}
<section class="cpap-hero contacto-hero">
    <div class="cpap-hero-content" data-aos="fade-up">
        <div class="cpap-hero-badge">
            <i class="fas fa-envelope-open-text"></i>
            Información Institucional
        </div>
        <h1>Contáctanos</h1>
        <p>Colegio Profesional de Antropólogos del Perú – Región Centro</p>
        <nav class="cpap-breadcrumb">
            <a href="{{ url('/') }}">Inicio</a>
            <span>/</span>
            <span>Contacto</span>
        </nav>
    </div>
</section>

{{-- CANALES RÁPIDOS --}}
<section class="ctc-channels">
    <div class="cpap-container">
        <div class="ctc-channels-grid">
            <a href="https://wa.me/51900000000" target="_blank" class="ctc-channel ctc-channel--whatsapp" data-aos="fade-up" data-aos-delay="0">
                <div class="ctc-channel-icon"><i class="fab fa-whatsapp"></i></div>
                <div class="ctc-channel-body">
                    <span class="ctc-channel-label">WhatsApp</span>
                    <span class="ctc-channel-val">(+51) 900 000 000</span>
                </div>
                <i class="fas fa-arrow-right ctc-channel-arrow"></i>
            </a>
            <a href="mailto:mesadepartes@cpaprc.org.pe" class="ctc-channel ctc-channel--email" data-aos="fade-up" data-aos-delay="80">
                <div class="ctc-channel-icon"><i class="fas fa-envelope"></i></div>
                <div class="ctc-channel-body">
                    <span class="ctc-channel-label">Mesa de Partes</span>
                    <span class="ctc-channel-val">mesadepartes@cpaprc.org.pe</span>
                </div>
                <i class="fas fa-arrow-right ctc-channel-arrow"></i>
            </a>
            <a href="tel:+5164123456" class="ctc-channel ctc-channel--phone" data-aos="fade-up" data-aos-delay="160">
                <div class="ctc-channel-icon"><i class="fas fa-phone-alt"></i></div>
                <div class="ctc-channel-body">
                    <span class="ctc-channel-label">Central Telefónica</span>
                    <span class="ctc-channel-val">(+51 64) 123456 · Anexo 100</span>
                </div>
                <i class="fas fa-arrow-right ctc-channel-arrow"></i>
            </a>
        </div>
    </div>
</section>

{{-- MAIN LAYOUT --}}
<section class="ctc-main-section">
    <div class="cpap-container">
        <div class="ctc-main-grid">

            {{-- FORMULARIO --}}
            <div class="ctc-form-col" data-aos="fade-right">
                <div class="ctc-form-card">
                    <div class="ctc-form-header">
                        <div class="ctc-form-icon"><i class="fas fa-paper-plane"></i></div>
                        <div>
                            <h2>Envíanos un mensaje</h2>
                            <p>Te responderemos a la brevedad posible en horario de atención.</p>
                        </div>
                    </div>

                    <form action="{{ route('contact.send') }}" method="POST" id="contactForm">
                        @csrf
                        @if ($errors->any())
                            <div class="ctc-form-errors">
                                @foreach ($errors->all() as $error)
                                    <p><i class="fas fa-exclamation-circle"></i> {{ $error }}</p>
                                @endforeach
                            </div>
                        @endif

                        <div class="ctc-form-row">
                            <div class="ctc-field">
                                <label for="ctc-nombre"><i class="fas fa-user"></i> Nombre completo</label>
                                <input type="text" name="nombre" id="ctc-nombre" placeholder="Tu nombre completo" required>
                            </div>
                            <div class="ctc-field">
                                <label for="ctc-email"><i class="fas fa-envelope"></i> Correo electrónico</label>
                                <input type="email" name="email" id="ctc-email" placeholder="correo@ejemplo.com" required>
                            </div>
                        </div>

                        <div class="ctc-form-row">
                            <div class="ctc-field">
                                <label for="ctc-asunto"><i class="fas fa-tag"></i> Asunto</label>
                                <input type="text" name="asunto" id="ctc-asunto" placeholder="¿Sobre qué nos escribes?" required>
                            </div>
                            <div class="ctc-field">
                                <label for="ctc-telefono"><i class="fas fa-phone"></i> Teléfono <span class="ctc-optional">(opcional)</span></label>
                                <input type="text" name="telefono" id="ctc-telefono" placeholder="+51 900 000 000">
                            </div>
                        </div>

                        <div class="ctc-field">
                            <label for="ctc-mensaje"><i class="fas fa-comment-alt"></i> Mensaje</label>
                            <textarea name="mensaje" id="ctc-mensaje" rows="6"
                                      placeholder="Escribe tu consulta o comentario aquí..."
                                      required></textarea>
                        </div>

                        <button type="submit" class="ctc-submit-btn" id="submitBtn">
                            <span class="btn-text-inner">
                                <i class="fas fa-paper-plane"></i>
                                Enviar Mensaje
                            </span>
                            <span class="btn-loader-inner">
                                <span class="ctc-spinner"></span>
                                Enviando...
                            </span>
                        </button>
                    </form>
                </div>
            </div>

            {{-- INFO + MAPA --}}
            <div class="ctc-info-col" data-aos="fade-left">

                <div class="ctc-info-card">
                    <h3><i class="fas fa-building"></i> Información Institucional</h3>
                    <div class="ctc-info-list">
                        <div class="ctc-info-item">
                            <div class="ctc-info-item-icon ctc-icon--primary"><i class="fas fa-clock"></i></div>
                            <div class="ctc-info-item-body">
                                <strong>Horario de Atención</strong>
                                <span>Lunes a viernes · 09:00 a.m. – 06:00 p.m.</span>
                            </div>
                        </div>
                        <div class="ctc-info-item">
                            <div class="ctc-info-item-icon ctc-icon--gold"><i class="fas fa-map-marker-alt"></i></div>
                            <div class="ctc-info-item-body">
                                <strong>Dirección</strong>
                                <span>Jr. Arequipa 734, Huancayo – Junín – Perú</span>
                            </div>
                        </div>
                        <div class="ctc-info-item">
                            <div class="ctc-info-item-icon ctc-icon--primary"><i class="fas fa-building"></i></div>
                            <div class="ctc-info-item-body">
                                <strong>Razón Social</strong>
                                <span>Colegio Profesional de Antropólogos del Perú – Región Centro</span>
                            </div>
                        </div>
                        <div class="ctc-info-item">
                            <div class="ctc-info-item-icon ctc-icon--gold"><i class="fas fa-id-card"></i></div>
                            <div class="ctc-info-item-body">
                                <strong>RUC</strong>
                                <span>20123456789</span>
                            </div>
                        </div>
                        <div class="ctc-info-item">
                            <div class="ctc-info-item-icon ctc-icon--primary"><i class="fab fa-whatsapp"></i></div>
                            <div class="ctc-info-item-body">
                                <strong>Atención al Colegiado</strong>
                                <span>WhatsApp: (+51) 900 000 000</span>
                            </div>
                        </div>
                        <div class="ctc-info-item">
                            <div class="ctc-info-item-icon ctc-icon--gold"><i class="fas fa-envelope"></i></div>
                            <div class="ctc-info-item-body">
                                <strong>Mesa de Partes</strong>
                                <span>mesadepartes@cpaprc.org.pe</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="ctc-map-card">
                    <div class="ctc-map-label">
                        <i class="fas fa-map-marked-alt"></i> Nuestra ubicación
                    </div>
                    <div class="ctc-map-frame">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3901.600194787139!2d-75.21245392597189!3d-12.071005942350432!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x910e964e2ce1cb1d%3A0x1d856d73fe8eb871!2sJr.%20Arequipa%20734%2C%20Huancayo%2012001!5e0!3m2!1ses-419!2spe!4v1771480292132!5m2!1ses-419!2spe"
                            width="100%" height="100%"
                            style="border:0;" allowfullscreen="" loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade">
                        </iframe>
                    </div>
                    <a href="https://maps.google.com/?q=Jr+Arequipa+734+Huancayo" target="_blank" class="ctc-map-btn">
                        <i class="fas fa-directions"></i> Cómo llegar
                    </a>
                </div>

            </div>
        </div>
    </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.addEventListener("DOMContentLoaded", function(){
    const form = document.getElementById("contactForm");
    const btn  = document.getElementById("submitBtn");
    form.addEventListener("submit", function(e){
        e.preventDefault();
        btn.classList.add("loading");
        btn.disabled = true;
        fetch(form.action, {
            method: "POST",
            body: new FormData(form),
            headers: { "X-CSRF-TOKEN": "{{ csrf_token() }}" }
        })
        .then(r => { if(!r.ok) throw new Error(); return r.json(); })
        .then(data => {
            btn.classList.remove("loading");
            btn.disabled = false;
            if(data.success){
                form.reset();
                Swal.fire({ icon: "success", title: "Mensaje enviado", text: data.message, confirmButtonColor: "#8B1538" });
            }
        })
        .catch(() => {
            btn.classList.remove("loading");
            btn.disabled = false;
            Swal.fire({ icon: "error", title: "Error", text: "Hubo un problema al enviar el mensaje." });
        });
    });
});
</script>

@endsection
