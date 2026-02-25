<?php

namespace App\Mail;

use App\Models\BolsaTrabajo;
use Illuminate\Mail\Mailable;

class SolicitudOfertaLaboralMail extends Mailable
{
    public BolsaTrabajo $oferta;

    public function __construct(BolsaTrabajo $oferta)
    {
        $this->oferta = $oferta;
    }

    public function build()
    {
        return $this->subject('Nueva solicitud de oferta laboral - CPAP Región Centro')
                    ->view('emails.solicitud-oferta');
    }
}
