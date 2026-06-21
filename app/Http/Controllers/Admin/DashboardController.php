<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Material;
use App\Models\Kriteria;
use App\Models\Penilaian;
use App\Models\HasilKeputusan;

class DashboardController extends Controller
{
    public function index()
    {
        $totalMaterial = Material::count();

        $totalKriteria = Kriteria::count();

        $totalPenilaian = Penilaian::count();

        $periodeTerakhir = HasilKeputusan::latest('periode_id')->first()?->periode_id;

        $materialTerbaik = HasilKeputusan::with('material')->where('periode_id', $periodeTerakhir)->orderBy('ranking')->first();

        $topRanking = HasilKeputusan::with('material')->where('periode_id', $periodeTerakhir)->orderBy('ranking')->limit(5)->get();

        $labelChart = $topRanking->pluck('material.kode_material')->toArray();

        $nilaiChart = $topRanking->pluck('nilai_preferensi')->toArray();

        $sangatBaik = HasilKeputusan::where('nilai_preferensi', '>=', 0.8)->count();

        $baik = HasilKeputusan::whereBetween('nilai_preferensi', [0.6, 0.79])->count();

        $cukup = HasilKeputusan::where('nilai_preferensi', '<', 0.6)->count();

        return view('Admin.Dashboard.dashboard', compact('totalMaterial', 'totalKriteria', 'totalPenilaian', 'materialTerbaik', 'topRanking', 'labelChart', 'nilaiChart', 'sangatBaik', 'baik', 'cukup'));
    }
}
