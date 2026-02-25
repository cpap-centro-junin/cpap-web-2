<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
</head>
<body style="margin:0; padding:0; background:#f4f4f4; font-family:Arial, Helvetica, sans-serif;">

<table width="100%" cellpadding="0" cellspacing="0" style="background:#f4f4f4; padding:30px 0;">
<tr>
<td align="center">

<table width="600" cellpadding="0" cellspacing="0" style="background:#ffffff; border-radius:12px; overflow:hidden; box-shadow:0 8px 25px rgba(0,0,0,0.1);">

<!-- HEADER -->
<tr>
<td align="center" style="background:linear-gradient(135deg,#7b1e3a,#4a0f23); padding:25px;">
    <img src="{{ url('images/logos/cpap-logo.jpg') }}"
         alt="CPAP Logo"
         width="70"
         style="display:block; margin-bottom:10px;">
    <h2 style="color:#ffffff; margin:0; font-size:18px;">
        Colegio Profesional de Antropólogos del Perú
    </h2>
    <p style="color:#f8d7da; margin:5px 0 0 0; font-size:13px;">
        Región Centro
    </p>
</td>
</tr>

<!-- BODY -->
<tr>
<td style="padding:30px;">

<h3 style="color:#7b1e3a; margin-top:0;">
    <span style="font-size:20px;">📋</span> Nueva solicitud de oferta laboral
</h3>

<p style="font-size:14px; color:#555; line-height:1.6;">
    Se ha recibido una nueva solicitud para publicar una oferta de trabajo en la bolsa laboral del sitio web.
</p>

<table width="100%" cellpadding="0" cellspacing="0" style="margin-top:20px; font-size:14px; border-collapse:collapse;">
<tr style="background:#f9f9f9;">
    <td style="padding:12px 15px; font-weight:bold; color:#7b1e3a; border-bottom:1px solid #eee; width:160px;">Título del puesto</td>
    <td style="padding:12px 15px; border-bottom:1px solid #eee;">{{ $oferta->titulo }}</td>
</tr>
<tr>
    <td style="padding:12px 15px; font-weight:bold; color:#7b1e3a; border-bottom:1px solid #eee;">Empresa</td>
    <td style="padding:12px 15px; border-bottom:1px solid #eee;">{{ $oferta->empresa }}</td>
</tr>
<tr style="background:#f9f9f9;">
    <td style="padding:12px 15px; font-weight:bold; color:#7b1e3a; border-bottom:1px solid #eee;">Ubicación</td>
    <td style="padding:12px 15px; border-bottom:1px solid #eee;">{{ $oferta->ubicacion }}</td>
</tr>
<tr>
    <td style="padding:12px 15px; font-weight:bold; color:#7b1e3a; border-bottom:1px solid #eee;">Tipo</td>
    <td style="padding:12px 15px; border-bottom:1px solid #eee;">{{ $oferta->tipo_label }}</td>
</tr>
<tr style="background:#f9f9f9;">
    <td style="padding:12px 15px; font-weight:bold; color:#7b1e3a; border-bottom:1px solid #eee;">Área</td>
    <td style="padding:12px 15px; border-bottom:1px solid #eee;">{{ $oferta->area_label }}</td>
</tr>
<tr>
    <td style="padding:12px 15px; font-weight:bold; color:#7b1e3a; border-bottom:1px solid #eee;">Salario</td>
    <td style="padding:12px 15px; border-bottom:1px solid #eee;">{{ $oferta->salario ?? 'No especificado' }}</td>
</tr>
<tr style="background:#f9f9f9;">
    <td style="padding:12px 15px; font-weight:bold; color:#7b1e3a; border-bottom:1px solid #eee;">Email contacto</td>
    <td style="padding:12px 15px; border-bottom:1px solid #eee;">{{ $oferta->email_contacto ?? 'No proporcionado' }}</td>
</tr>
</table>

<div style="margin-top:25px; padding:15px; background:#f9f9f9; border-left:4px solid #7b1e3a; border-radius:8px;">
    <strong>Descripción:</strong>
    <p style="margin-top:10px; line-height:1.6; white-space:pre-line;">{{ $oferta->descripcion }}</p>
</div>

<div style="margin-top:25px; text-align:center;">
    <a href="{{ url('/admin/bolsa') }}"
       style="display:inline-block; padding:12px 30px; background:#7b1e3a; color:#ffffff; text-decoration:none; border-radius:8px; font-weight:bold; font-size:14px;">
        Revisar en el Panel Admin
    </a>
</div>

<p style="margin-top:20px; font-size:12px; color:#999; text-align:center;">
    Esta oferta requiere aprobación antes de ser visible en el sitio web.
</p>

</td>
</tr>

<!-- FOOTER -->
<tr>
<td align="center" style="background:#f4f4f4; padding:15px; font-size:12px; color:#777;">
    Este mensaje fue enviado automáticamente desde el sitio web oficial del CPAP Región Centro.
</td>
</tr>

</table>

</td>
</tr>
</table>

</body>
</html>
