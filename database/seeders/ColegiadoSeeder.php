<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Colegiado;
use Carbon\Carbon;

class ColegiadoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $colegiados = [
            [
                'codigo_cpap' => 'CPAP-2026-00001',
                'dni' => '12345678',
                'nombres' => 'Juan Carlos',
                'apellidos' => 'Pérez López',
                'email' => 'juan.perez@cpap.org.pe',
                'telefono' => '987654321',
                'fecha_nacimiento' => '1985-03-15',
                'especialidad' => 'Antropología Social',
                'universidad' => 'Universidad Nacional Mayor de San Marcos',
                'anio_graduacion' => 2008,
                'descripcion' => 'Especialista en antropología urbana y desarrollo comunitario con más de 15 años de experiencia en proyectos de desarrollo social.',
                'estado' => 'activo',
                'fecha_colegiatura' => '2009-01-10',
            ],
            [
                'codigo_cpap' => 'CPAP-2026-00002',
                'dni' => '23456789',
                'nombres' => 'María Elena',
                'apellidos' => 'García Torres',
                'email' => 'maria.garcia@cpap.org.pe',
                'telefono' => '987654322',
                'fecha_nacimiento' => '1990-07-22',
                'especialidad' => 'Antropología Forense',
                'universidad' => 'Universidad Nacional del Centro del Perú',
                'anio_graduacion' => 2013,
                'descripcion' => 'Antropóloga forense especializada en identificación de restos óseos y análisis bioarqueológico.',
                'estado' => 'activo',
                'fecha_colegiatura' => '2014-03-20',
            ],
            [
                'codigo_cpap' => 'CPAP-2026-00003',
                'dni' => '34567890',
                'nombres' => 'Carlos Alberto',
                'apellidos' => 'Ramírez Mendoza',
                'email' => 'carlos.ramirez@cpap.org.pe',
                'telefono' => '987654323',
                'fecha_nacimiento' => '1988-12-05',
                'especialidad' => 'Antropología Cultural',
                'universidad' => 'Pontificia Universidad Católica del Perú',
                'anio_graduacion' => 2011,
                'descripcion' => 'Investigador en antropología cultural andina y patrimonio cultural inmaterial.',
                'estado' => 'inactivo',
                'fecha_colegiatura' => '2012-06-15',
            ],
            [
                'codigo_cpap' => 'CPAP-2026-00004',
                'dni' => '45678901',
                'nombres' => 'Ana Lucía',
                'apellidos' => 'Flores Vásquez',
                'email' => 'ana.flores@cpap.org.pe',
                'telefono' => '987654324',
                'fecha_nacimiento' => '1992-09-18',
                'especialidad' => 'Antropología Médica',
                'universidad' => 'Universidad Nacional de San Cristóbal de Huamanga',
                'anio_graduacion' => 2015,
                'descripcion' => 'Especialista en salud intercultural y medicina tradicional andina.',
                'estado' => 'activo',
                'fecha_colegiatura' => '2016-02-28',
            ],
            [
                'codigo_cpap' => 'CPAP-2026-00005',
                'dni' => '56789012',
                'nombres' => 'Roberto Miguel',
                'apellidos' => 'Sánchez Huamán',
                'email' => 'roberto.sanchez@cpap.org.pe',
                'telefono' => '987654325',
                'fecha_nacimiento' => '1987-05-30',
                'especialidad' => 'Antropología Económica',
                'universidad' => 'Universidad Nacional Mayor de San Marcos',
                'anio_graduacion' => 2010,
                'descripcion' => 'Consultor en desarrollo económico local y emprendimientos comunitarios.',
                'estado' => 'activo',
                'fecha_colegiatura' => '2011-08-12',
            ],
        ];

        foreach ($colegiados as $colegiadoData) {
            Colegiado::create($colegiadoData);
        }

        $this->command->info('✅ 5 colegiados de prueba creados exitosamente.');
    }
}
