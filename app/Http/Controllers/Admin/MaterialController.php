<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Material;
use Illuminate\Http\Request;

class MaterialController extends Controller
{
    public function index()
    {
        $material = Material::all();
        return view('Admin.Material.material_view', compact('material'));
    }

    public function store(Request $request)
    {
        Material::create($request->all());
        return redirect()->route('material.index')->with('success', 'Material berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
         $material = Material::findOrFail($id);
        $material->update($request->all());
        return redirect()->route('material.index')->with('success', 'Material berhasil diupdate');
    }

    public function destroy($id)
    {
        $material = Material::findOrFail($id);
        $material->delete();

        return redirect()->route('material.index')->with('success', 'Material berhasil dihapus.');
    }
}
