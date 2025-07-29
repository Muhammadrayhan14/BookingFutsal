<?php

namespace App\Http\Controllers;

use App\Models\Paket;
use Illuminate\Http\Request;

class PaketController extends Controller
{
    
    
      
        public function index()
        {
            $pakets = Paket::orderBy('created_at', 'desc')->get();
            return view('admin.paket.index', compact('pakets'));
        }
    
      
        public function create()
        {
            return view('admin.paket.create');
        }
    

        public function store(Request $request)
        {
            $request->validate([
                'nama_paket' => 'required|string|max:100',
                'harga' => 'required|numeric|min:0',
                'durasi_hari' => 'required|integer|min:1',
                'deskripsi' => 'nullable|string',
            ]);
    
            Paket::create($request->all());
    
            return redirect()->route('paket.index')->with('success', 'Paket berhasil ditambahkan.');
        }
    
      
        public function edit($id)
        {
            $paket = Paket::findOrFail($id);
            return view('admin.paket.edit', compact('paket'));
        }
    
        public function update(Request $request, $id)
        {
            $request->validate([
                'nama_paket' => 'required|string|max:100',
                'harga' => 'required|numeric|min:0',
                'durasi_hari' => 'required|integer|min:1',
                'deskripsi' => 'nullable|string',
            ]);
    
            $paket = Paket::findOrFail($id);
            $paket->update($request->all());
    
            return redirect()->route('paket.index')->with('success', 'Paket berhasil diperbarui.');
        }
    
        public function destroy($id)
        {
            $paket = Paket::findOrFail($id);
            $paket->delete();
    
            return redirect()->route('paket.index')->with('success', 'Paket berhasil dihapus.');
        }
    
    
}
