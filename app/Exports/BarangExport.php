<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\BeforeExport;

class BarangExport implements ShouldAutoSize, WithHeadings, FromView, WithEvents
{
    public function __construct(private Collection $barangs)
    {
    }

    public function view(): View
    {
        $data = $this->barangs;

        return view('exports.barang_export')
            ->with(compact('data'));
    }

    public function headings(): array
    {
        return ['No', 'Nama Barang', 'Satuan', 'Stok', 'Harga Beli', 'Harga Jual'];
    }


    /**
     * @return array
     */
    public function registerEvents(): array
    {
        return [
            BeforeExport::class => function ($event) {
                $event->sheet->setpaperSize(1);
            }
        ];
    }
}
