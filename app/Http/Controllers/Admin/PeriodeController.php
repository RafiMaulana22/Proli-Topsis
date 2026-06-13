<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Periode;
use Illuminate\Http\Request;

class PeriodeController extends Controller
{
    public function index()
    {
        $periode = Periode::withCount('penilaians')->get();

        return view('Admin.Periode.periode_view', compact('periode'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_periode' => 'required',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
        ]);

        Periode::create([
            'nama_periode' => $request->nama_periode,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
        ]);

        return redirect()->route('periode.index')->with('success', 'Periode berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_periode' => 'required',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
        ]);

        $periode = Periode::findOrFail($id);

        $periode->update([
            'nama_periode' => $request->nama_periode,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
        ]);

        return redirect()->route('periode.index')->with('success', 'Periode berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $periode = Periode::findOrFail($id);

        $periode->delete();

        return redirect()->route('periode.index')->with('success', 'Periode berhasil dihapus.');
    }
}
