<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HasilKeputusan;
use App\Models\Kriteria;
use App\Models\Material;
use App\Models\Penilaian;
use App\Models\Periode;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $periode = Periode::all();

        $hasil = collect();

        $materialTerbaik = null;

        if ($request->periode_id) {
            $hasil = HasilKeputusan::with('material')->where('periode_id', $request->periode_id)->orderBy('ranking')->get();

            $materialTerbaik = $hasil->first();
        }

        return view('Admin.Laporan.laporan_view', [
            'periode' => $periode,
            'hasil' => $hasil,
            'materialTerbaik' => $materialTerbaik,
            'totalMaterial' => Material::count(),
            'totalKriteria' => Kriteria::count(),
            'totalPenilaian' => Penilaian::count(),
        ]);
    }
}
