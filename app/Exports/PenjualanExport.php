<?php

namespace App\Exports;

use App\Models\Penjualan;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class PenjualanExport implements FromView, ShouldAutoSize, WithEvents
{
    public function view(): View
    {
        return view('exports.penjualan', [
            'penjualans' => Penjualan::all(),
        ]);
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                // Perform the deletion here
                Penjualan::truncate(); // This will delete all records from the table
            },
        ];
    }
}