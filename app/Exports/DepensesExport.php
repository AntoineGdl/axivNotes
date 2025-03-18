<?php

namespace App\Exports;

use App\Models\Depense;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class DepensesExport implements WithMultipleSheets
{
    protected $depenses;
    protected $monthlyTotals;
    protected $grandTotal;

    public function __construct(Collection $depenses, Collection $monthlyTotals, float $grandTotal)
    {
        $this->depenses = $depenses;
        $this->monthlyTotals = $monthlyTotals;
        $this->grandTotal = $grandTotal;
    }

    public function sheets(): array
    {
        return [
            new DepensesDetailSheet($this->depenses),
            new DepensesSummarySheet($this->monthlyTotals, $this->grandTotal)
        ];
    }
}
