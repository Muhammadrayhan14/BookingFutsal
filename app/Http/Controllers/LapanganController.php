<?php

namespace App\Http\Controllers;

use App\Models\Lapangan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LapanganController extends Controller
{
    public function index()
    {
        $lapangan = Lapangan::all();
        return view('lapangan.index', compact('lapangan'));
    }

    public function create()
    {
        return view('lapangan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_lapangan' => 'required|string|max:255',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'keterangan' => 'nullable|string',    
            'harga' => 'required|numeric|min:0',  
        ]);

        $data = $request->all();

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('lapangan_images', 'public');
        }

        Lapangan::create($data);

        return redirect()->route('lapangan.index')->with('success', 'Lapangan berhasil ditambahkan');
    }

    public function show($id)
    {
        $lapangan = Lapangan::findOrFail($id);
        return view('lapangan.show', compact('lapangan'));
    }

    public function edit($id)
    {
        $lapangan = Lapangan::findOrFail($id);
        return view('lapangan.edit', compact('lapangan'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_lapangan' => 'required|string|max:255',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'keterangan' => 'nullable|string',
            'harga' => 'required|numeric|min:0',
        ]);

        $lapangan = Lapangan::findOrFail($id);
        $data = $request->all();

        if ($request->hasFile('gambar')) {
            // Delete old image if exists
            if ($lapangan->gambar && Storage::disk('public')->exists($lapangan->gambar)) {
                Storage::disk('public')->delete($lapangan->gambar);
            }
            $data['gambar'] = $request->file('gambar')->store('lapangan_images', 'public');
        }

        $lapangan->update($data);

        return redirect()->route('lapangan.index')->with('success', 'Lapangan berhasil diperbarui');
    }

    public function destroy($id)
    {
        $lapangan = Lapangan::findOrFail($id);

        // Delete image if exists
        if ($lapangan->gambar && Storage::disk('public')->exists($lapangan->gambar)) {
            Storage::disk('public')->delete($lapangan->gambar);
        }

        $lapangan->delete();

        return redirect()->route('lapangan.index')->with('success', 'Lapangan berhasil dihapus');
    }
}