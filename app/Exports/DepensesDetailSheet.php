<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class DepensesDetailSheet implements FromCollection, WithHeadings, WithMapping, WithStyles, WithTitle
{
    protected $depenses;

    public function __construct(Collection $depenses)
    {
        $this->depenses = $depenses;
    }

    public function collection()
    {
        return $this->depenses;
    }

    public function headings(): array
    {
        return [
            'Date',
            'Entreprise',
            'Description',
            'Montant HT (€)',
            'Catégorie'
        ];
    }

    public function map($depense): array
    {
        return [
            $depense->date->format('d/m/Y'),
            $depense->nom_entreprise,
            $depense->description,
            number_format($depense->montant, 2, '.', ''),
            $depense->categorie->nom
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true]]
        ];
    }

    public function title(): string
    {
        return 'Dépenses';
    }
}
