<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DetailPenilaian;
use App\Models\Kriteria;
use App\Models\Material;
use App\Models\Penilaian;
use App\Models\Periode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PenilaianController extends Controller
{
    public function index(Request $request)
    {
        $periode = Periode::all();

        $kriteria = Kriteria::all();

        $material = Material::where('status', 'aktif')->get();

        $penilaian = Penilaian::with(['periode', 'material', 'detailPenilaians']);

        if ($request->periode_id) {
            $penilaian->where('periode_id', $request->periode_id);
        }

        $penilaian = $penilaian->get();

        return view('Admin.Penilaian.penilaian_view', compact('periode', 'material', 'kriteria', 'penilaian'));
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'periode_id' => 'required|exists:periodes,id',
                'material_id' => 'required|exists:materials,id',
                'nilai' => 'required|array',
            ], [
                'periode_id.required' => 'Periode harus diisi',
                'periode_id.exists' => 'Periode tidak valid',
                'material_id.required' => 'Material harus diisi',
                'material_id.exists' => 'Material tidak valid',
                'nilai.required' => 'Nilai harus diisi',
                'nilai.array' => 'Nilai harus berupa array',
            ]);

            $cek = Penilaian::where('periode_id', $request->periode_id)->where('material_id', $request->material_id)->exists();

            if ($cek) {
                return back()->with('error', 'Material sudah digunakan pada periode ini');
            }

            DB::transaction(function () use ($request) {
                $penilaian = Penilaian::create([
                    'periode_id' => $request->periode_id,
                    'material_id' => $request->material_id,
                ]);

                foreach ($request->nilai as $kriteriaId => $nilai) {
                    DetailPenilaian::create([
                        'penilaian_id' => $penilaian->id,
                        'kriteria_id' => $kriteriaId,
                        'nilai' => $nilai,
                    ]);
                }
            });

            return redirect()
                ->route('penilaian.index', [
                    'periode_id' => $request->periode_id,
                ])
                ->with('success', 'Penilaian berhasil ditambahkan');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'nilai' => 'required|array',
            ], [
                'nilai.required' => 'Nilai harus diisi',
                'nilai.array' => 'Nilai harus berupa array',
            ]);

            $penilaian = Penilaian::findOrFail($id);

            DB::transaction(function () use ($request, $penilaian) {
                foreach ($request->nilai as $kriteriaId => $nilai) {
                    DetailPenilaian::updateOrCreate(
                        [
                            'penilaian_id' => $penilaian->id,
                            'kriteria_id' => $kriteriaId,
                        ],
                        [
                            'nilai' => $nilai,
                        ]
                    );
                }
            });

            return redirect()
                ->route('penilaian.index', [
                    'periode_id' => $penilaian->periode_id,
                ])
                ->with('success', 'Penilaian berhasil diperbarui');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $penilaian = Penilaian::findOrFail($id);

            DB::transaction(function () use ($penilaian) {
                $penilaian->detailPenilaians()->delete();
                $penilaian->delete();
            });

            return redirect()
                ->route('penilaian.index', [
                    'periode_id' => $penilaian->periode_id,
                ])
                ->with('success', 'Penilaian berhasil dihapus');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }
}
