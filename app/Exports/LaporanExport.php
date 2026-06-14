<?php

namespace App\Exports;

use App\Models\HasilKeputusan;
use Maatwebsite\Excel\Concerns\FromCollection;

class LaporanExport implements FromCollection
{
    protected $periodeId;

    public function __construct($periodeId)
    {
        $this->periodeId = $periodeId;
    }

    public function collection()
    {
        return HasilKeputusan::with('material')
            ->where('periode_id', $this->periodeId)
            ->orderBy('ranking')
            ->get()
            ->map(function ($item) {
                return [
                    'Ranking' => $item->ranking,
                    'Kode Material' => $item->material->kode_material,
                    'Nama Material' => $item->material->nama_material,
                    'Nilai Preferensi' => $item->nilai_preferensi,
                ];
            });
    }

    public function headings(): array
    {
        return ['Ranking', 'Kode Material', 'Nama Material', 'Nilai Preferensi'];
    }
}
