<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kelas;
use App\Models\Instruktur;

class KelasController extends Controller
{
    public function index()
    {
        $kelas = Kelas::with('instruktur')->orderBy('created_at', 'desc')->get();
        return view('admin.kelas.index', compact('kelas'));
    }

    public function create()
    {
        $instrukturs = Instruktur::all();
        return view('admin.kelas.create', compact('instrukturs'));
    }

    public function show($id)
    {
        $kelas = Kelas::with(['instruktur', 'members'])->findOrFail($id);
        return view('admin.kelas.show', compact('kelas'));
    }
    

    public function store(Request $request)
    {
        $request->validate([
            'nama_kelas' => 'required|string|max:100',
            'hari' => 'required|string|max:50',
            'jam' => 'required|string|max:50',
            'deskripsi' => 'nullable|string',
            'instruktur_id' => 'required|exists:instrukturs,id',
        ]);

        Kelas::create([
            'nama_kelas' => $request->nama_kelas,
            'hari' => $request->hari,
            'jam' => $request->jam,
            'deskripsi' => $request->deskripsi,
            'instruktur_id' => $request->instruktur_id,
        ]);

        return redirect()->route('kelas.index')->with('success', 'Kelas berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $kelas = Kelas::findOrFail($id);
        $instrukturs = Instruktur::all();
        return view('admin.kelas.edit', compact('kelas', 'instrukturs'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_kelas' => 'required|string|max:100',
            'hari' => 'required|string|max:50',
            'jam' => 'required|string|max:50',
            'deskripsi' => 'nullable|string',
            'instruktur_id' => 'required|exists:instrukturs,id',
        ]);

        $kelas = Kelas::findOrFail($id);
        $kelas->update([
            'nama_kelas' => $request->nama_kelas,
            'hari' => $request->hari,
            'jam' => $request->jam,
            'deskripsi' => $request->deskripsi,
            'instruktur_id' => $request->instruktur_id,
        ]);

        return redirect()->route('kelas.index')->with('success', 'Kelas berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $kelas = Kelas::findOrFail($id);
        $kelas->delete();

        return redirect()->route('kelas.index')->with('success', 'Kelas berhasil dihapus.');
    }
}
