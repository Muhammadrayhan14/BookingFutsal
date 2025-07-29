<?php

namespace App\Http\Controllers;


use App\Models\Promo;
use Illuminate\Http\Request;

  
    
    class PromoController extends Controller
    {
        public function index() {
            $promos = Promo::all();
            return view('admin.promos.index', compact('promos'));
        }
    
        public function create() {
            return view('admin.promos.create');
        }
    
        public function store(Request $request) {
            $request->validate([
                'nama_promo' => 'required',
                'tanggal_mulai' => 'required|date',
                'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
                'persentase_diskon' => 'required|integer|min:1|max:100',
                'status' => 'required|in:aktif,nonaktif',
            ]);
    
            Promo::create($request->all());
    
            return redirect()->route('promos.index')->with('success', 'Promo berhasil dibuat.');
        }
    
        public function edit($id) {
            $promo = Promo::findOrFail($id);
            return view('admin.promos.edit', compact('promo'));
        }
    
        public function update(Request $request, $id) {
            $promo = Promo::findOrFail($id);
    
            $request->validate([
                'nama_promo' => 'required',
                'tanggal_mulai' => 'required|date',
                'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
                'persentase_diskon' => 'required|integer|min:1|max:100',
                'status' => 'required|in:aktif,nonaktif',
            ]);
    
            $promo->update($request->all());
    
            return redirect()->route('promos.index')->with('success', 'Promo berhasil diperbarui.');
        }
    
        public function destroy($id) {
            Promo::findOrFail($id)->delete();
            return redirect()->route('promos.index')->with('success', 'Promo berhasil dihapus.');
        }

        public function toggleStatus($id)
{
    $promo = Promo::findOrFail($id);

    // Toggle status
    $promo->status = $promo->status === 'aktif' ? 'nonaktif' : 'aktif';
    $promo->save();

    return redirect()->route('promos.index')->with('success', 'Status promo berhasil diubah.');
}
    }