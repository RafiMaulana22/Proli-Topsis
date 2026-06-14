<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HasilKeputusan;
use App\Models\Periode;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class HasilController extends Controller
{
    public function index(Request $request)
    {
        $periode = Periode::all();

        $hasil = collect();

        $terbaik = null;

        if ($request->periode_id) {
            $hasil = HasilKeputusan::with('material')->where('periode_id', $request->periode_id)->orderBy('ranking')->get();

            $terbaik = $hasil->first();
        }

        return view('Admin.Hasil.hasil_view', compact('periode', 'hasil', 'terbaik'));
    }

    public function exportPdf(Request $request)
    {
        if (!$request->periode_id) {
            return back()->with('error', 'Pilih periode terlebih dahulu');
        }

        $hasil = HasilKeputusan::with('material')->where('periode_id', $request->periode_id)->orderBy('ranking')->get();

        if ($hasil->isEmpty()) {
            return back()->with('error', 'Data ranking belum tersedia');
        }

        $periode = Periode::find($request->periode_id);

        $pdf = Pdf::loadView('Admin.Hasil.pdf', compact('hasil', 'periode'));

        return $pdf->stream('hasil.pdf');
    }
}
