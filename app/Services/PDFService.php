<?php

namespace App\Services;

use setasign\Fpdi\Fpdi;
use Illuminate\Support\Facades\Storage;
use Exception;

class PDFService
{
    /**
     * Embeber QR Code y código de verificación en el PDF
     *
     * @param string $pdfTempPath Path temporal del PDF subido
     * @param string $qrImagePath Path de la imagen QR
     * @param string $codigoVerificacion Código único
     * @param string $urlVerificacion URL corta
     * @return string Path del PDF modificado temporal
     * @throws Exception Si el PDF no se puede procesar
     */
    public function embederQREnPDFTemporal(
        string $pdfTempPath,
        string $qrImagePath,
        string $codigoVerificacion,
        string $urlVerificacion
    ): string {
        try {
            // Crear instancia FPDI
            $pdf = new Fpdi();

            // Configurar fuente predeterminada
            $pdf->SetFont('Arial', '', 12);

            // Obtener número de páginas del PDF original
            $pageCount = $pdf->setSourceFile($pdfTempPath);

            // Procesar cada página
            for ($pageNo = 1; $pageNo <= $pageCount; $pageNo++) {
                // Importar página original
                $templateId = $pdf->importPage($pageNo);
                $size = $pdf->getTemplateSize($templateId);

                // Agregar página respetando orientación original
                $orientation = ($size['orientation'] ?? 'P') === 'L' ? 'L' : 'P';
                $pdf->AddPage($orientation, [$size['width'], $size['height']]);

                // Usar la plantilla (contenido original)
                $pdf->useTemplate($templateId);

                // Solo en la primera página agregamos el QR y metadata
                if ($pageNo === 1) {
                    $this->agregarQRYMetadata(
                        $pdf,
                        $size,
                        $qrImagePath,
                        $codigoVerificacion,
                        $urlVerificacion
                    );
                }
            }

            // Crear path para PDF modificado temporal
            $pdfModificadoPath = sys_get_temp_dir() . '/' . uniqid('cpap_', true) . '.pdf';

            // Guardar PDF
            $pdf->Output('F', $pdfModificadoPath);

            return $pdfModificadoPath;

        } catch (Exception $e) {
            throw new Exception("Error al procesar PDF: " . $e->getMessage());
        }
    }

    /**
     * Agregar QR Code y metadata al PDF
     *
     * @param Fpdi $pdf Instancia de FPDI
     * @param array $size Dimensiones de la página
     * @param string $qrImagePath Path de la imagen QR
     * @param string $codigoVerificacion Código único
     * @param string $urlVerificacion URL de verificación
     * @return void
     */
    private function agregarQRYMetadata(
        Fpdi $pdf,
        array $size,
        string $qrImagePath,
        string $codigoVerificacion,
        string $urlVerificacion
    ): void {
        // Configuración del QR
        $qrSize = 35; // Tamaño en mm
        $margenDerecho = 10;
        $margenSuperior = 10;

        // Posición del QR (esquina superior derecha)
        $qrX = $size['width'] - $qrSize - $margenDerecho;
        $qrY = $margenSuperior;

        // Insertar imagen QR
        $qrFullPath = public_path($qrImagePath);
        if (file_exists($qrFullPath)) {
            $pdf->Image($qrFullPath, $qrX, $qrY, $qrSize, $qrSize, 'PNG');
        }

        // Agregar código de verificación debajo del QR
        $pdf->SetFont('Arial', 'B', 7);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->SetXY($qrX, $qrY + $qrSize + 2);
        $pdf->MultiCell($qrSize, 3, "Codigo:\n{$codigoVerificacion}", 0, 'C');

        // Agregar URL en texto pequeño
        $pdf->SetFont('Arial', '', 5);
        $pdf->SetXY($qrX, $qrY + $qrSize + 10);
        $pdf->MultiCell($qrSize, 2, $urlVerificacion, 0, 'C');

        // Agregar marca de agua "CPAP - Documento Verificable"
        $pdf->SetFont('Arial', 'I', 8);
        $pdf->SetTextColor(139, 21, 56); // Color vino CPAP
        $pdf->SetXY($qrX - 10, $qrY + $qrSize + 16);
        $pdf->MultiCell($qrSize + 20, 3, "Documento Verificable", 0, 'C');
    }
}
