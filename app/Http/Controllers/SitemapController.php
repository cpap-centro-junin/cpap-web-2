<?php

namespace App\Http\Controllers;

use App\Models\Noticia;
use App\Models\Evento;
use App\Models\Colegiado;
use App\Models\RecursoBiblioteca;
use Illuminate\Http\Response;

class SitemapController extends Controller
{
    public function index(): Response
    {
        $sitemap = '<?xml version="1.0" encoding="UTF-8"?>';
        $sitemap .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';

        // Página principal
        $sitemap .= $this->url('/', '1.0', 'daily', now());

        // Páginas estáticas - Nosotros
        $sitemap .= $this->url('/nosotros/mision-vision', '0.8', 'monthly');
        $sitemap .= $this->url('/nosotros/historia', '0.8', 'monthly');
        $sitemap .= $this->url('/nosotros/consejo-directivo', '0.8', 'monthly');
        $sitemap .= $this->url('/nosotros/normativa-legal', '0.7', 'monthly');
        $sitemap .= $this->url('/nosotros/plan-2026', '0.7', 'monthly');

        // Colegiatura
        $sitemap .= $this->url('/colegiatura', '0.9', 'monthly');

        // Contacto
        $sitemap .= $this->url('/contacto', '0.7', 'monthly');

        // Noticias - Listado
        $sitemap .= $this->url('/noticias', '0.9', 'daily');

        // Noticias - Individuales
        $noticias = Noticia::where('activo', true)->get();
        foreach ($noticias as $noticia) {
            $sitemap .= $this->url(
                '/noticias/' . $noticia->id,
                '0.7',
                'weekly',
                $noticia->updated_at
            );
        }

        // Eventos - Listado
        $sitemap .= $this->url('/eventos', '0.9', 'daily');

        // Eventos - Individuales
        $eventos = Evento::where('activo', true)->get();
        foreach ($eventos as $evento) {
            $sitemap .= $this->url(
                '/eventos/' . $evento->id,
                '0.7',
                'weekly',
                $evento->updated_at
            );
        }

        // Colegiados - Listado
        $sitemap .= $this->url('/colegiados', '0.8', 'weekly');

        // Colegiados - Perfiles públicos
        $colegiados = Colegiado::where('estado', 'activo')
            ->where('perfil_oculto', false)
            ->get();
        foreach ($colegiados as $colegiado) {
            $sitemap .= $this->url(
                '/colegiados/' . $colegiado->codigo_cpap,
                '0.6',
                'monthly',
                $colegiado->updated_at
            );
        }

        // Biblioteca
        $sitemap .= $this->url('/biblioteca', '0.8', 'weekly');

        $recursos = RecursoBiblioteca::where('activo', true)->get();
        foreach ($recursos as $recurso) {
            $sitemap .= $this->url(
                '/biblioteca/' . $recurso->id,
                '0.6',
                'monthly',
                $recurso->updated_at
            );
        }

        // Bolsa de Trabajo
        $sitemap .= $this->url('/bolsa-trabajo', '0.8', 'daily');

        // Galería
        $sitemap .= $this->url('/galeria', '0.7', 'weekly');

        $sitemap .= '</urlset>';

        return response($sitemap, 200)
            ->header('Content-Type', 'application/xml');
    }

    private function url(string $loc, string $priority, string $changefreq, $lastmod = null): string
    {
        $url = '<url>';
        $url .= '<loc>' . url($loc) . '</loc>';

        if ($lastmod) {
            $url .= '<lastmod>' . $lastmod->toAtomString() . '</lastmod>';
        }

        $url .= '<changefreq>' . $changefreq . '</changefreq>';
        $url .= '<priority>' . $priority . '</priority>';
        $url .= '</url>';

        return $url;
    }
}
