<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kriteria;
use Illuminate\Http\Request;

class KriteriaController extends Controller
{
    public function index()
    {
        $kriteria = Kriteria::all();
        $totalBobot = Kriteria::sum('bobot');

        return view('Admin.Kriteria.kriteria_view', compact('kriteria', 'totalBobot'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kriteria' => 'required',
            'bobot' => 'required|numeric',
            'atribut' => 'required',
        ]);

        $totalBobot = Kriteria::sum('bobot');

        if ($totalBobot + $request->bobot > 100) {
            return back()->with('error', 'Total bobot tidak boleh melebihi 100%. Sisa bobot yang tersedia adalah ' . (100 - $totalBobot) . '%');
        }

        $last = Kriteria::latest('id')->first();

        if ($last) {
            $number = (int) str_replace('C', '', $last->kode) + 1;
        } else {
            $number = 1;
        }

        $kode = 'C' . $number;

        Kriteria::create([
            'kode' => $kode,
            'nama_kriteria' => $request->nama_kriteria,
            'bobot' => $request->bobot,
            'atribut' => $request->atribut,
        ]);

        return redirect()->route('kriteria.index')->with('success', 'Kriteria berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_kriteria' => 'required',
            'bobot' => 'required|numeric',
            'atribut' => 'required',
        ]);

        $kriteria = Kriteria::findOrFail($id);

        $totalBobot = Kriteria::sum('bobot') - $kriteria->bobot;

        if ($totalBobot + $request->bobot > 100) {
            return back()->with('error', 'Total bobot tidak boleh melebihi 100%.');
        }

        $kriteria->update([
            'nama_kriteria' => $request->nama_kriteria,
            'bobot' => $request->bobot,
            'atribut' => $request->atribut,
        ]);

        return redirect()->route('kriteria.index')->with('success', 'Kriteria berhasil diperbarui');
    }

    public function destroy($id)
    {
        $kriteria = Kriteria::findOrFail($id);

        $kriteria->delete();

        return redirect()->route('kriteria.index')->with('success', 'Kriteria berhasil dihapus');
    }
}
