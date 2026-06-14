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

        return redirect()->back()->with('success', 'Penilaian berhasil disimpan');
    }

    public function update(Request $request, $id)
    {
        DB::transaction(function () use ($request, $id) {
            $penilaian = Penilaian::findOrFail($id);

            $penilaian->update([
                'material_id' => $request->material_id,
            ]);

            foreach ($request->nilai as $kriteriaId => $nilai) {
                DetailPenilaian::updateOrCreate(
                    [
                        'penilaian_id' => $penilaian->id,
                        'kriteria_id' => $kriteriaId,
                    ],
                    [
                        'nilai' => $nilai,
                    ],
                );
            }
        });

        return redirect()
            ->route('penilaian.index', [
                'periode_id' => $request->periode_id,
            ])
            ->with('success', 'Penilaian berhasil diperbarui');
    }

    public function destroy($id)
    {
        DB::transaction(function () use ($id) {
            $penilaian = Penilaian::findOrFail($id);

            DetailPenilaian::where('penilaian_id', $penilaian->id)->delete();

            $penilaian->delete();
        });

        return back()->with('success', 'Penilaian berhasil dihapus');
    }
}
