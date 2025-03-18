<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class DepensesSummarySheet implements FromCollection, WithHeadings, WithStyles, WithTitle
{
    protected $monthlyTotals;
    protected $grandTotal;

    public function __construct(Collection $monthlyTotals, float $grandTotal)
    {
        $this->monthlyTotals = $monthlyTotals;
        $this->grandTotal = $grandTotal;
    }

    public function collection()
    {
        $data = $this->monthlyTotals->map(function ($item) {
            return [
                'month' => $item['month'],
                'total' => $item['total']
            ];
        });

        // Add grand total row
        $data->push([
            'month' => 'Total général',
            'total' => $this->grandTotal
        ]);

        return $data;
    }

    public function headings(): array
    {
        return [
            'Mois',
            'Total (€)'
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true]],
            $this->monthlyTotals->count() + 2 => ['font' => ['bold' => true]]
        ];
    }

    public function title(): string
    {
        return 'Résumé';
    }
}
