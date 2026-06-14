<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HasilKeputusan;
use App\Models\Periode;
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
}
