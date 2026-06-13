<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Material;
use Illuminate\Http\Request;

class MaterialController extends Controller
{
    public function index()
    {
        $material = Material::latest()->get();

        return view('Admin.Material.material_view', compact('material'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_material' => 'required|string|max:255',
            'status' => 'required',
            'deskripsi' => 'nullable|string',
        ]);

        // Generate Kode Material Otomatis
        $lastMaterial = Material::latest('id')->first();

        if ($lastMaterial) {
            $lastNumber = (int) substr($lastMaterial->kode_material, 4);
            $newNumber = $lastNumber + 1;
        } else {
            $newNumber = 1;
        }

        $kodeMaterial = 'MTR-' . str_pad($newNumber, 3, '0', STR_PAD_LEFT);

        Material::create([
            'kode_material' => $kodeMaterial,
            'nama_material' => $request->nama_material,
            'status' => $request->status,
            'deskripsi' => $request->deskripsi,
        ]);

        return redirect()->route('material.index')->with('success', 'Material berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_material' => 'required|string|max:255',
            'status' => 'required',
            'deskripsi' => 'nullable|string',
        ]);

        $material = Material::findOrFail($id);

        $material->update([
            'nama_material' => $request->nama_material,
            'status' => $request->status,
            'deskripsi' => $request->deskripsi,
        ]);

        return redirect()->route('material.index')->with('success', 'Material berhasil diupdate');
    }

    public function destroy($id)
    {
        $material = Material::findOrFail($id);

        $material->delete();

        return redirect()->route('material.index')->with('success', 'Material berhasil dihapus');
    }
}
