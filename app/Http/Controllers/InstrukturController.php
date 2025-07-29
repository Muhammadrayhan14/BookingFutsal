<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Instruktur;

class InstrukturController extends Controller
{
    public function index()
    {
        $instrukturs = Instruktur::orderBy('created_at', 'desc')->get();
        return view('admin.instruktur.index', compact('instrukturs'));
    }

    public function create()
    {
        return view('admin.instruktur.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:100',
            'spesialisasi' => 'nullable|string|max:255',
            'no_hp' => 'nullable|string|max:20',
        ]);

        Instruktur::create([
            'nama' => $request->nama,
            'spesialisasi' => $request->spesialisasi,
            'no_hp' => $request->no_hp,
        ]);

        return redirect()->route('instruktur.index')->with('success', 'Instruktur berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $instruktur = Instruktur::findOrFail($id);
        return view('admin.instruktur.edit', compact('instruktur'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:100',
            'spesialisasi' => 'nullable|string|max:255',
            'no_hp' => 'nullable|string|max:20',
        ]);

        $instruktur = Instruktur::findOrFail($id);
        $instruktur->update([
            'nama' => $request->nama,
            'spesialisasi' => $request->spesialisasi,
            'no_hp' => $request->no_hp,
        ]);

        return redirect()->route('instruktur.index')->with('success', 'Instruktur berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $instruktur = Instruktur::findOrFail($id);
        $instruktur->delete();

        return redirect()->route('instruktur.index')->with('success', 'Instruktur berhasil dihapus.');
    }
}
