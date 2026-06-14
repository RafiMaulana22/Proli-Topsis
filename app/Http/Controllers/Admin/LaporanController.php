<?php

namespace App\Http\Controllers\Admin;

use App\Exports\LaporanExport;
use App\Http\Controllers\Controller;
use App\Models\HasilKeputusan;
use App\Models\Kriteria;
use App\Models\Material;
use App\Models\Penilaian;
use App\Models\Periode;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

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

    public function exportPdf(Request $request)
    {
        $periode = Periode::findOrFail($request->periode_id);

        $hasil = HasilKeputusan::with('material')->where('periode_id', $request->periode_id)->orderBy('ranking')->get();

        $pdf = Pdf::loadView('Admin.Laporan.pdf', compact('hasil', 'periode'));

        return $pdf->download('laporan_topsis.pdf');
    }

    public function print(Request $request)
    {
        $periode = Periode::findOrFail($request->periode_id);

        $hasil = HasilKeputusan::with('material')->where('periode_id', $request->periode_id)->orderBy('ranking')->get();

        return view('Admin.Laporan.print', compact('hasil', 'periode'));
    }

    public function exportExcel(Request $request)
    {
        return Excel::download(new LaporanExport($request->periode_id), 'laporan_topsis.xlsx');
    }
}
