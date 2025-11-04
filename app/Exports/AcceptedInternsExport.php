<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Alignment;

class AcceptedInternsExport implements
    FromCollection,
    WithHeadings,
    WithMapping,
    WithStyles,
    ShouldAutoSize,
    WithTitle
{
    protected $acceptedInterns;
    protected $selectedUnit;

    public function __construct($acceptedInterns, $unitStats = null, $totalInterns = null, $selectedUnit = null)
    {
        $this->acceptedInterns = $acceptedInterns;
        $this->selectedUnit = $selectedUnit;
    }

    public function collection()
    {
        return collect($this->acceptedInterns);
    }

    public function headings(): array
    {
        return [
            'No',
            'Nama Lengkap',
            'NIM',
            'Asal Kampus',
            'Program Studi',
            'Email Kampus',
            'No WhatsApp',
            'Unit Magang',
            'Periode Awal',
            'Periode Akhir',
            'Durasi (Hari)',
            'Tanggal Terdaftar',
        ];
    }

    public function map($acceptedIntern): array
    {
        static $no = 0;
        $no++;

        $periodeAwal = $acceptedIntern->periode_awal;
        $periodeAkhir = $acceptedIntern->periode_akhir;
        $durasi = $periodeAwal->diffInDays($periodeAkhir);

        return [
            $no,
            $acceptedIntern->intern->nama,
            $acceptedIntern->intern->nim,
            $acceptedIntern->intern->asal_kampus,
            $acceptedIntern->intern->program_studi,
            $acceptedIntern->intern->email_kampus ?? '-',
            $acceptedIntern->intern->no_wa,
            $acceptedIntern->unit_magang,
            $periodeAwal->format('d-m-Y'),
            $periodeAkhir->format('d-m-Y'),
            $durasi,
            $acceptedIntern->created_at->format('d-m-Y H:i'),
        ];
    }

    public function styles(Worksheet $sheet)
    {
        $highestRow = $sheet->getHighestRow();
        $highestColumn = $sheet->getHighestColumn();

        // Style header row (row 1)
        $sheet->getStyle('A1:' . $highestColumn . '1')->applyFromArray([
            'font' => [
                'bold' => true,
                'color' => ['rgb' => 'FFFFFF'],
                'size' => 11,
            ],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['rgb' => '2563EB'], // Blue
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical' => Alignment::VERTICAL_CENTER,
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['rgb' => '000000'],
                ],
            ],
        ]);

        // Style data rows
        if ($highestRow > 1) {
            $sheet->getStyle('A2:' . $highestColumn . $highestRow)->applyFromArray([
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => Border::BORDER_THIN,
                        'color' => ['rgb' => 'CCCCCC'],
                    ],
                ],
                'alignment' => [
                    'vertical' => Alignment::VERTICAL_CENTER,
                    'wrapText' => true,
                ],
            ]);

            // Center align No column
            $sheet->getStyle('A2:A' . $highestRow)
                ->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

            // Center align Durasi and dates columns (I, J, K)
            $sheet->getStyle('I2:K' . $highestRow)
                ->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

            // Alternate row colors
            for ($row = 2; $row <= $highestRow; $row++) {
                if (($row - 1) % 2 == 0) {
                    $sheet->getStyle('A' . $row . ':' . $highestColumn . $row)->applyFromArray([
                        'fill' => [
                            'fillType' => Fill::FILL_SOLID,
                            'startColor' => ['rgb' => 'F9FAFB'], // Light gray
                        ],
                    ]);
                }
            }
        }

        // Set row heights
        $sheet->getRowDimension(1)->setRowHeight(30);
        for ($row = 2; $row <= $highestRow; $row++) {
            $sheet->getRowDimension($row)->setRowHeight(25);
        }

        return [];
    }

    public function title(): string
    {
        if ($this->selectedUnit) {
            return substr('Unit ' . $this->selectedUnit, 0, 31); // Excel limit 31 chars
        }
        return 'Database Magang';
    }
}
