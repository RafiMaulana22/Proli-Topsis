<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalMaterial = 125;
        $totalKriteria = 8;
        $totalPenilaian = 1250;

        $materialTerbaik = (object) [
            'kode_material' => 'MTR-001',
            'nama_material' => 'Beton K-500',
            'nilai_preferensi' => 0.9125,
        ];

        $topRanking = collect([
            (object) [
                'kode_material' => 'MTR-001',
                'nama_material' => 'Beton K-500',
                'nilai_preferensi' => 0.9125,
            ],
            (object) [
                'kode_material' => 'MTR-002',
                'nama_material' => 'Baja Ringan',
                'nilai_preferensi' => 0.8912,
            ],
            (object) [
                'kode_material' => 'MTR-003',
                'nama_material' => 'Keramik Premium',
                'nilai_preferensi' => 0.8754,
            ],
            (object) [
                'kode_material' => 'MTR-004',
                'nama_material' => 'Granit',
                'nilai_preferensi' => 0.8501,
            ],
            (object) [
                'kode_material' => 'MTR-005',
                'nama_material' => 'Aspal Hotmix',
                'nilai_preferensi' => 0.8233,
            ],
        ]);

        $labelChart = ['MTR-001', 'MTR-002', 'MTR-003', 'MTR-004', 'MTR-005'];

        $nilaiChart = [0.9125, 0.8912, 0.8754, 0.8501, 0.8233];

        return view('Admin.Dashboard.dashboard', compact('totalMaterial', 'totalKriteria', 'totalPenilaian', 'materialTerbaik', 'topRanking', 'labelChart', 'nilaiChart'));
    }
}
