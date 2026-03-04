<?php

namespace Database\Seeders;

use App\Models\PeriodeMagang;
use Illuminate\Database\Seeder;

class PeriodeMagangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $periodes = [
            // Batch I - DITUTUP (pendaftaran sudah lewat)
            [
                'nama_batch' => 'Pendaftaran Magang',
                'nama_periode' => 'Batch I 1 November - 19 Desember 2025',
                'tanggal_mulai' => '2026-01-02', // Periode pelaksanaan magang
                'tanggal_selesai' => '2026-06-30',
                'is_active' => false, // Ditutup
                'keterangan' => 'Pendaftaran: 1 November - 19 Desember 2025. Periode Pelaksanaan Magang: 2 Januari 2026 s.d. 30 Juni 2026',
            ],
            // Batch II - DIBUKA
            [
                'nama_batch' => 'Pendaftaran Magang',
                'nama_periode' => 'Batch II 1 Mei - 15 Juni 2026',
                'tanggal_mulai' => '2026-06-01', // Periode pelaksanaan magang
                'tanggal_selesai' => '2026-12-31',
                'is_active' => true, // Dibuka
                'keterangan' => 'Pendaftaran: 1 Mei - 15 Juni 2026. Periode Pelaksanaan Magang: 1 Juni 2026 s.d. 31 Desember 2026',
            ],
        ];

        foreach ($periodes as $periode) {
            PeriodeMagang::create($periode);
        }
    }
}
