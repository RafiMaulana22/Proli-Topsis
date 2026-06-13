<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kriteria;
use App\Models\SubKriteria;
use Illuminate\Http\Request;

class SubKriteriaController extends Controller
{
    public function index(Request $request)
    {
        $kriteria = Kriteria::all();

        if ($request->has('kriteria_id')) {
            $subkriteria = SubKriteria::with('kriteria')->where('kriteria_id', $request->kriteria_id)->get();
        } else {
            $subkriteria = SubKriteria::with('kriteria')->get();
        }

        return view('admin.subkriteria.index', compact('subkriteria', 'kriteria'));
    }

    public function store(Request $request)
    {
        // Validasi data input
        $request->validate([
            'kriteria_id' => 'required|exists:kriterias,id',
            'nama_sub_kriteria' => 'required|string|max:255',
            'nilai' => 'required|integer',
        ]);

        // Menyimpan data ke tabel sub_kriterias
        SubKriteria::create([
            'kriteria_id' => $request->kriteria_id,
            'nama_sub_kriteria' => $request->nama_sub_kriteria,
            'nilai' => $request->nilai,
        ]);

        return redirect()->back()->with('success', 'Data Sub Kriteria berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'kriteria_id' => 'required|exists:kriterias,id',
            'nama_sub_kriteria' => 'required|string|max:255',
            'nilai' => 'required|integer',
        ]);

        $subkriteria = SubKriteria::findOrFail($id);
        $subkriteria->update([
            'kriteria_id' => $request->kriteria_id,
            'nama_sub_kriteria' => $request->nama_sub_kriteria,
            'nilai' => $request->nilai,
        ]);

        return redirect()->back()->with('success', 'Data Sub Kriteria berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $subkriteria = SubKriteria::findOrFail($id);
        $subkriteria->delete();

        return redirect()->back()->with('success', 'Data Sub Kriteria berhasil dihapus!');
    }
}
