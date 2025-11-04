<?php

namespace App\Exports;

use App\Models\Intern;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Alignment;

class InternsExport implements FromCollection, WithHeadings, WithMapping, WithStyles, ShouldAutoSize, WithTitle
{
    protected $interns;

    public function __construct($interns)
    {
        $this->interns = $interns;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return collect($this->interns);
    }

    public function headings(): array
    {
        return [
            'No',
            'Nama',
            'NIM',
            'Asal Kampus',
            'Program Studi',
            'Email Kampus',
            'No WhatsApp',
            'Status',
            'Alasan Penolakan',
            'Tanggal Dibuat',
        ];
    }

    public function map($intern): array
    {
        static $no = 0;
        $no++;

        $statusMap = [
            'pending' => 'Menunggu Persetujuan',
            'approved' => 'Diterima',
            'rejected' => 'Ditolak',
        ];

        return [
            $no,
            $intern->nama,
            $intern->nim,
            $intern->asal_kampus,
            $intern->program_studi,
            $intern->email_kampus ?? '-',
            $intern->no_wa,
            $statusMap[$intern->status] ?? $intern->status,
            $intern->status === 'rejected' ? ($intern->rejection_reason ?? '-') : '-',
            $intern->created_at->format('d-m-Y H:i'),
        ];
    }

    public function styles(Worksheet $sheet)
    {
        $highestRow = $sheet->getHighestRow();
        $highestColumn = $sheet->getHighestColumn();

        // Style header
        $sheet->getStyle('A1:' . $highestColumn . '1')->applyFromArray([
            'font' => [
                'bold' => true,
                'color' => ['rgb' => 'FFFFFF'],
                'size' => 12,
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

        // Style untuk semua data
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

        // Style khusus untuk kolom No (center)
        $sheet->getStyle('A2:A' . $highestRow)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

        // Style khusus untuk kolom Status
        for ($row = 2; $row <= $highestRow; $row++) {
            $status = $sheet->getCell('H' . $row)->getValue();

            if ($status === 'Diterima') {
                $sheet->getStyle('H' . $row)->applyFromArray([
                    'fill' => [
                        'fillType' => Fill::FILL_SOLID,
                        'startColor' => ['rgb' => 'D1FAE5'], // Light green
                    ],
                    'font' => [
                        'color' => ['rgb' => '065F46'], // Dark green
                        'bold' => true,
                    ],
                    'alignment' => [
                        'horizontal' => Alignment::HORIZONTAL_CENTER,
                    ],
                ]);
            } elseif ($status === 'Ditolak') {
                $sheet->getStyle('H' . $row)->applyFromArray([
                    'fill' => [
                        'fillType' => Fill::FILL_SOLID,
                        'startColor' => ['rgb' => 'FEE2E2'], // Light red
                    ],
                    'font' => [
                        'color' => ['rgb' => '991B1B'], // Dark red
                        'bold' => true,
                    ],
                    'alignment' => [
                        'horizontal' => Alignment::HORIZONTAL_CENTER,
                    ],
                ]);

                // Highlight alasan penolakan
                $sheet->getStyle('I' . $row)->applyFromArray([
                    'fill' => [
                        'fillType' => Fill::FILL_SOLID,
                        'startColor' => ['rgb' => 'FEF3C7'], // Light yellow
                    ],
                    'font' => [
                        'color' => ['rgb' => '92400E'], // Dark yellow
                    ],
                ]);
            } elseif ($status === 'Menunggu Persetujuan') {
                $sheet->getStyle('H' . $row)->applyFromArray([
                    'fill' => [
                        'fillType' => Fill::FILL_SOLID,
                        'startColor' => ['rgb' => 'FEF3C7'], // Light yellow
                    ],
                    'font' => [
                        'color' => ['rgb' => '92400E'], // Dark yellow
                        'bold' => true,
                    ],
                    'alignment' => [
                        'horizontal' => Alignment::HORIZONTAL_CENTER,
                    ],
                ]);
            }
        }

        // Set row height untuk header
        $sheet->getRowDimension(1)->setRowHeight(30);

        // Set row height untuk data rows
        for ($row = 2; $row <= $highestRow; $row++) {
            $sheet->getRowDimension($row)->setRowHeight(25);
        }

        return [];
    }

    public function title(): string
    {
        return 'Data Magang';
    }
}
