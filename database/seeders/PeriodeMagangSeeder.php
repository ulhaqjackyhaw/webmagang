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
            // Batch Pendaftaran Juni 2026
            [
                'nama_batch' => 'Pendaftaran Magang',
                'nama_periode' => 'Juli - September 2026',
                'tanggal_mulai' => '2026-07-01',
                'tanggal_selesai' => '2026-09-30',
                'is_active' => true,
                'keterangan' => '',
            ],
            [
                'nama_batch' => 'Pendaftaran Magang',
                'nama_periode' => 'Oktober - Desember 2026',
                'tanggal_mulai' => '2026-10-01',
                'tanggal_selesai' => '2026-12-31',
                'is_active' => true,
                'keterangan' => '',
            ],

        ];

        foreach ($periodes as $periode) {
            PeriodeMagang::create($periode);
        }
    }
}
